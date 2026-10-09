<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\BrandingAsset;
use App\Models\BrandingAssetVersion;
use App\Models\BrandingAssetVersionImage;
use App\Models\Company;
use Illuminate\Http\Request;

class BrandingAssetController extends Controller
{
    public function index(Request $request)
    {
        $query = BrandingAsset::with(['company', 'latestVersion']);

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->get('company_id'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)->orWhere('applicable_to', 'like', $term);
            });
        }

        $assets = $query->latest('submitted_at')->paginate($this->perPage($request));
        $selectedCompany = $request->filled('company_id') ? Company::find($request->get('company_id')) : null;

        return view('admin.branding-assets.index', compact('assets', 'selectedCompany'));
    }

    public function show(BrandingAsset $brandingAsset)
    {
        $brandingAsset->load(['company', 'versions.images', 'comments.user']);

        return view('admin.branding-assets.show', compact('brandingAsset'));
    }

    public function create()
    {
        $brandingAsset = new BrandingAsset();

        return view('admin.branding-assets.form', compact('brandingAsset'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'category' => 'required|in:'.implode(',', array_keys(BrandingAsset::CATEGORIES)),
            'name' => 'required|string|max:255',
            'applicable_to' => 'nullable|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:5120',
            'notes' => 'nullable|string|max:1000',
        ]);

        $asset = BrandingAsset::create([
            'company_id' => $data['company_id'],
            'category' => $data['category'],
            'name' => $data['name'],
            'applicable_to' => $data['applicable_to'] ?? null,
            'status' => 'pending',
            'submitted_by' => $request->user()->id,
            'submitted_at' => now(),
        ]);

        $this->storeVersion($request, $asset, 1);

        AuditLog::record('branding_asset.created', $asset, null, $asset->only('name', 'category', 'status'));

        return redirect('/admin/branding-assets')->with('success', 'Branding asset created and sent to client for approval.');
    }

    public function edit(BrandingAsset $brandingAsset)
    {
        $brandingAsset->load(['company', 'versions.images', 'comments.user']);

        return view('admin.branding-assets.form', ['brandingAsset' => $brandingAsset]);
    }

    public function update(Request $request, BrandingAsset $brandingAsset)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'category' => 'required|in:'.implode(',', array_keys(BrandingAsset::CATEGORIES)),
            'name' => 'required|string|max:255',
            'applicable_to' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'notes' => 'nullable|string|max:1000',
        ]);

        $before = $brandingAsset->only('name', 'category', 'applicable_to', 'status');

        $brandingAsset->update([
            'company_id' => $data['company_id'],
            'category' => $data['category'],
            'name' => $data['name'],
            'applicable_to' => $data['applicable_to'] ?? null,
        ]);

        // Uploading new images = new version + resets status to pending for re-approval
        if ($request->hasFile('images')) {
            $nextVersion = ($brandingAsset->versions()->max('version_no') ?? 0) + 1;
            $this->storeVersion($request, $brandingAsset, $nextVersion);
            $brandingAsset->update(['status' => 'pending']);
        }

        AuditLog::record('branding_asset.updated', $brandingAsset, $before, $brandingAsset->fresh()->only('name', 'category', 'applicable_to', 'status'));

        return back()->with('success', 'Branding asset updated.');
    }

    public function destroy(BrandingAsset $brandingAsset)
    {
        AuditLog::record('branding_asset.deleted', $brandingAsset, $brandingAsset->only('name', 'status'), null);
        $brandingAsset->delete();

        return back()->with('success', 'Branding asset deleted.');
    }

    public function storeComment(Request $request, BrandingAsset $brandingAsset)
    {
        $request->validate(['comment' => 'required|string|max:2000']);

        \App\Models\BrandingAssetComment::create([
            'branding_asset_id' => $brandingAsset->id,
            'branding_asset_version_id' => optional($brandingAsset->latestVersion)->id,
            'user_id' => $request->user()->id,
            'comment' => $request->input('comment'),
            'action' => 'comment',
        ]);

        AuditLog::record('branding_asset.comment_added', $brandingAsset, null, ['comment' => $request->input('comment')]);

        return back()->with('success', 'Comment added.');
    }

    private function storeVersion(Request $request, BrandingAsset $asset, int $versionNo): void
    {
        $files = $request->file('images', []);

        $coverPath = $files[0]->store('branding-assets/'.$asset->id, 'public');

        $version = BrandingAssetVersion::create([
            'branding_asset_id' => $asset->id,
            'version_no' => $versionNo,
            'image_path' => $coverPath,
            'notes' => $request->input('notes'),
            'uploaded_by' => $request->user()->id,
        ]);

        BrandingAssetVersionImage::create([
            'branding_asset_version_id' => $version->id,
            'image_path' => $coverPath,
            'sort_order' => 0,
        ]);

        foreach (array_slice($files, 1) as $i => $file) {
            $path = $file->store('branding-assets/'.$asset->id, 'public');
            BrandingAssetVersionImage::create([
                'branding_asset_version_id' => $version->id,
                'image_path' => $path,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
