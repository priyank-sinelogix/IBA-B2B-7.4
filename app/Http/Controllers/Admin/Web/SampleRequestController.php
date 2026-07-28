<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Company;
use App\Models\Sample;
use App\Models\SampleRequest;
use App\Models\SampleVersion;
use Illuminate\Http\Request;

class SampleRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = SampleRequest::with('company', 'requestedBy');
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        $requests = $query->latest()->paginate(15);

        return view('admin.sample-requests.index', compact('requests'));
    }

    public function show(SampleRequest $sampleRequest)
    {
        $sampleRequest->load('company', 'requestedBy', 'convertedSample', 'images');
        return view('admin.sample-requests.show', compact('sampleRequest'));
    }

    public function updateStatus(Request $request, SampleRequest $sampleRequest)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,in_review,rejected',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $sampleRequest->update($data);
        AuditLog::record('sample_request.status_updated', $sampleRequest, null, $data);

        return back()->with('success', 'Request updated.');
    }

    /**
     * Turns an accepted request into a real Sample so it enters the normal
     * approve / revise workflow. Uses the request's reference images as v1
     * if the admin doesn't upload fresh ones.
     */
    public function convert(Request $request, SampleRequest $sampleRequest)
    {
        $data = $request->validate([
            'sample_code' => 'required|string|max:100|unique:samples,sample_code',
            'fabric' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
        ]);

        $sample = Sample::create([
            'company_id' => $sampleRequest->company_id,
            'sample_code' => $data['sample_code'],
            'style_name' => $sampleRequest->style_name,
            'fabric' => $data['fabric'] ?? $sampleRequest->fabric_preference,
            'color' => $data['color'] ?? $sampleRequest->colour_preference,
            'status' => 'pending',
            'submitted_by' => $request->user()->id,
            'submitted_at' => now(),
        ]);

        $uploaded = $request->file('images', []);

        if (count($uploaded)) {
            // Admin uploaded fresh development images — use those
            $paths = [];
            foreach ($uploaded as $file) {
                $paths[] = $file->store('samples/'.$sample->id, 'public');
            }
        } else {
            // Fall back to the client's original reference image(s)
            $paths = $sampleRequest->images->count()
                ? $sampleRequest->images->pluck('image_path')->all()
                : array_filter([$sampleRequest->reference_image_path]);
        }

        if (count($paths)) {
            $version = SampleVersion::create([
                'sample_id' => $sample->id,
                'version_no' => 1,
                'image_path' => $paths[0],
                'notes' => 'Created from client sample request #'.$sampleRequest->id,
                'uploaded_by' => $request->user()->id,
            ]);

            foreach ($paths as $i => $path) {
                \App\Models\SampleVersionImage::create([
                    'sample_version_id' => $version->id,
                    'image_path' => $path,
                    'sort_order' => $i,
                ]);
            }
        }

        $sampleRequest->update([
            'status' => 'converted',
            'converted_sample_id' => $sample->id,
        ]);

        AuditLog::record('sample_request.converted', $sampleRequest, null, ['sample_id' => $sample->id]);

        return redirect('/admin/samples/'.$sample->id)->with('success', 'Request converted into a sample.');
    }
}
