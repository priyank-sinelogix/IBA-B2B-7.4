<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\BrandingAsset;
use App\Models\BrandingAssetRequest;
use App\Models\BrandingAssetVersion;
use App\Models\BrandingAssetVersionImage;
use Illuminate\Http\Request;

class BrandingAssetRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = BrandingAssetRequest::with('company', 'requestedBy');

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)->orWhere('applicable_to', 'like', $term);
            });
        }

        $requests = $query->latest()->paginate($this->perPage($request));

        return view('admin.branding-asset-requests.index', compact('requests'));
    }

    public function show(BrandingAssetRequest $brandingAssetRequest)
    {
        $brandingAssetRequest->load('company', 'requestedBy', 'convertedAsset', 'images');

        return view('admin.branding-asset-requests.show', compact('brandingAssetRequest'));
    }

    public function updateStatus(Request $request, BrandingAssetRequest $brandingAssetRequest)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,in_review,rejected',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $brandingAssetRequest->update($data);
        AuditLog::record('branding_asset_request.status_updated', $brandingAssetRequest, null, $data);

        return back()->with('success', 'Request updated.');
    }

    /**
     * Turns an accepted request into a real BrandingAsset so it enters the
     * normal approve / revise workflow. Uses the request's reference images
     * as v1 if the admin doesn't upload fresh ones.
     */
    public function convert(Request $request, BrandingAssetRequest $brandingAssetRequest)
    {
        $data = $request->validate([
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
        ]);

        $asset = BrandingAsset::create([
            'company_id' => $brandingAssetRequest->company_id,
            'category' => $brandingAssetRequest->category,
            'name' => $brandingAssetRequest->name,
            'applicable_to' => $brandingAssetRequest->applicable_to,
            'status' => 'pending',
            'submitted_by' => $request->user()->id,
            'submitted_at' => now(),
        ]);

        $uploaded = $request->file('images', []);

        if (count($uploaded)) {
            $paths = [];
            foreach ($uploaded as $file) {
                $paths[] = $file->store('branding-assets/'.$asset->id, 'public');
            }
        } else {
            $paths = $brandingAssetRequest->images->count()
                ? $brandingAssetRequest->images->pluck('image_path')->all()
                : array_filter([$brandingAssetRequest->reference_image_path]);
        }

        if (count($paths)) {
            $version = BrandingAssetVersion::create([
                'branding_asset_id' => $asset->id,
                'version_no' => 1,
                'image_path' => $paths[0],
                'notes' => 'Created from client request #'.$brandingAssetRequest->id,
                'uploaded_by' => $request->user()->id,
            ]);

            foreach ($paths as $i => $path) {
                BrandingAssetVersionImage::create([
                    'branding_asset_version_id' => $version->id,
                    'image_path' => $path,
                    'sort_order' => $i,
                ]);
            }
        }

        $brandingAssetRequest->update([
            'status' => 'converted',
            'converted_asset_id' => $asset->id,
        ]);

        AuditLog::record('branding_asset_request.converted', $brandingAssetRequest, null, ['branding_asset_id' => $asset->id]);

        return redirect('/admin/branding-assets/'.$asset->id)->with('success', 'Request converted into a branding asset.');
    }
}
