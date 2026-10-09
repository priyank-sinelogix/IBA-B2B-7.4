<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\BrandingAsset;
use App\Models\BrandingAssetComment;
use App\Models\BrandingAssetRequest;
use App\Models\BrandingAssetRequestImage;
use Illuminate\Http\Request;

class BrandingAssetWebController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        $base = BrandingAsset::where('company_id', $companyId);

        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $base->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)->orWhere('applicable_to', 'like', $term);
            });
        }

        $query = clone $base;
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        $assets = $query->with('latestVersion')->latest('submitted_at')->get();

        $pending = $assets->whereIn('status', ['pending', 'revision_requested'])->values();
        $approved = $assets->where('status', 'approved')->values();

        // Summary cards: one per category, counted off the unfiltered company set
        // (not the current search/tab) so the cards always reflect the whole picture.
        $summary = collect(BrandingAsset::CATEGORIES)->map(function ($label, $key) use ($companyId) {
            $total = BrandingAsset::where('company_id', $companyId)->where('category', $key)->count();
            $approvedCount = BrandingAsset::where('company_id', $companyId)->where('category', $key)->where('status', 'approved')->count();

            return [
                'key' => $key,
                'label' => $label,
                'total' => $total,
                'approved' => $approvedCount,
                'pending' => $total - $approvedCount,
            ];
        })->values();

        // The client's own submitted requests (not yet real assets) — shown
        // separately so they can track pending/in_review/rejected/converted
        // without it being confused with the actual asset approval list above.
        $myRequests = BrandingAssetRequest::where('company_id', $companyId)->latest()->take(10)->get();

        return view('branding-assets.index', compact('pending', 'approved', 'summary', 'myRequests'));
    }

    public function show(Request $request, BrandingAsset $brandingAsset)
    {
        $this->authorizeCompany($request, $brandingAsset);
        $brandingAsset->load(['versions.images', 'comments.user']);

        return view('branding-assets.show', compact('brandingAsset'));
    }

    public function approve(Request $request, BrandingAsset $brandingAsset)
    {
        $this->authorizeCompany($request, $brandingAsset);

        if ($brandingAsset->status === 'approved') {
            return back()->with('error', 'This asset has already been approved.');
        }

        $before = $brandingAsset->only('status');
        $brandingAsset->update(['status' => 'approved']);

        BrandingAssetComment::create([
            'branding_asset_id' => $brandingAsset->id,
            'branding_asset_version_id' => optional($brandingAsset->latestVersion)->id,
            'user_id' => $request->user()->id,
            'comment' => $request->input('comment', ''),
            'action' => 'approve',
        ]);

        AuditLog::record('branding_asset.approved', $brandingAsset, $before, $brandingAsset->only('status'));

        return back()->with('success', 'Branding asset approved.');
    }

    public function requestRevision(Request $request, BrandingAsset $brandingAsset)
    {
        $this->authorizeCompany($request, $brandingAsset);
        $request->validate(['comment' => 'required|string|max:2000']);

        $before = $brandingAsset->only('status');
        $brandingAsset->update(['status' => 'revision_requested']);

        BrandingAssetComment::create([
            'branding_asset_id' => $brandingAsset->id,
            'branding_asset_version_id' => optional($brandingAsset->latestVersion)->id,
            'user_id' => $request->user()->id,
            'comment' => $request->input('comment'),
            'action' => 'revise',
        ]);

        AuditLog::record('branding_asset.revision_requested', $brandingAsset, $before, $brandingAsset->only('status'));

        return back()->with('success', 'Revision request sent.');
    }

    /**
     * The "+ Request New Asset" modal on the Branding & Labels page posts
     * straight here — no separate create page, per how this module is meant
     * to stay lighter-weight than the full Sample Request flow.
     */
    public function storeRequest(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|in:'.implode(',', array_keys(BrandingAsset::CATEGORIES)),
            'name' => 'required|string|max:255',
            'applicable_to' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'reference_images' => 'nullable|array',
            'reference_images.*' => 'image|max:5120',
        ]);

        $brandingAssetRequest = BrandingAssetRequest::create([
            'company_id' => $request->user()->company_id,
            'requested_by' => $request->user()->id,
            'category' => $data['category'],
            'name' => $data['name'],
            'applicable_to' => $data['applicable_to'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => 'pending',
        ]);

        $files = $request->file('reference_images', []);
        foreach ($files as $i => $file) {
            $path = $file->store('branding-asset-requests', 'public');

            if ($i === 0) {
                $brandingAssetRequest->update(['reference_image_path' => $path]);
            }

            BrandingAssetRequestImage::create([
                'branding_asset_request_id' => $brandingAssetRequest->id,
                'image_path' => $path,
                'sort_order' => $i,
            ]);
        }

        AuditLog::record('branding_asset_request.created', $brandingAssetRequest, null, $brandingAssetRequest->only('name', 'category'));

        return redirect('/branding-assets')->with('success', 'Your request has been submitted to IBA.');
    }

    private function authorizeCompany(Request $request, BrandingAsset $brandingAsset): void
    {
        if ($brandingAsset->company_id !== $request->user()->company_id) {
            abort(403, 'Forbidden');
        }
    }
}
