<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SampleRequest;
use Illuminate\Http\Request;

class SampleRequestWebController extends Controller
{
    public function index(Request $request)
    {
        $requests = SampleRequest::where('company_id', $request->user()->company_id)
            ->with('images')
            ->latest()->paginate(15);

        return view('sample-requests.index', compact('requests'));
    }

    public function create()
    {
        return view('sample-requests.create');
    }

    public function edit(Request $request, SampleRequest $sampleRequest)
    {
        $this->authorizeCompany($request, $sampleRequest);

        if ($sampleRequest->status !== 'pending') {
            return redirect('/sample-requests')->with('error', 'This request is already being reviewed and can no longer be edited.');
        }

        $sampleRequest->load('images', 'sizeChartRows');

        return view('sample-requests.edit', compact('sampleRequest'));
    }

    public function update(Request $request, SampleRequest $sampleRequest)
    {
        $this->authorizeCompany($request, $sampleRequest);

        if ($sampleRequest->status !== 'pending') {
            return redirect('/sample-requests')->with('error', 'This request is already being reviewed and can no longer be edited.');
        }

        $data = $request->validate([
            'style_name' => 'required|string|max:255',
            'fabric_preference' => 'nullable|string|max:255',
            'colour_preference' => 'nullable|string|max:255',
            'print_preference' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'reference_images' => 'nullable|array',
            'reference_images.*' => 'image|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:sample_request_images,id',
        ]);

        $sampleRequest->update([
            'style_name' => $data['style_name'],
            'fabric_preference' => $data['fabric_preference'] ?? null,
            'colour_preference' => $data['colour_preference'] ?? null,
            'print_preference' => $data['print_preference'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        // Remove any images the client unchecked, making sure they belong to this request
        if (! empty($data['delete_images'])) {
            $sampleRequest->images()->whereIn('id', $data['delete_images'])->delete();
        }

        // Append newly uploaded images
        $files = $request->file('reference_images', []);
        $nextOrder = ($sampleRequest->images()->max('sort_order') ?? -1) + 1;
        foreach ($files as $i => $file) {
            $path = $file->store('sample-requests', 'public');

            if (! $sampleRequest->reference_image_path) {
                $sampleRequest->update(['reference_image_path' => $path]);
            }

            \App\Models\SampleRequestImage::create([
                'sample_request_id' => $sampleRequest->id,
                'image_path' => $path,
                'sort_order' => $nextOrder + $i,
            ]);
        }

        // Replace the size chart wholesale with whatever was submitted
        $sampleRequest->sizeChartRows()->delete();
        $specs = $request->input('specification', []);
        foreach ($specs as $i => $spec) {
            if (! trim($spec ?? '')) {
                continue;
            }

            \App\Models\SizeChartRow::create([
                'sample_request_id' => $sampleRequest->id,
                'specification' => $spec,
                'xs' => $request->input('xs.'.$i),
                's' => $request->input('s.'.$i),
                'm' => $request->input('m.'.$i),
                'l' => $request->input('l.'.$i),
                'xl' => $request->input('xl.'.$i),
                'xxl' => $request->input('xxl.'.$i),
                'xxxl' => $request->input('xxxl.'.$i),
                'xxxxl' => $request->input('xxxxl.'.$i),
                'xxxxxl' => $request->input('xxxxxl.'.$i),
                'sort_order' => $i,
            ]);
        }

        return redirect('/sample-requests')->with('success', 'Your sample request has been updated.');
    }

    private function authorizeCompany(Request $request, SampleRequest $sampleRequest): void
    {
        if ($sampleRequest->company_id !== $request->user()->company_id) {
            abort(403, 'Forbidden');
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'style_name' => 'required|string|max:255',
            'fabric_preference' => 'nullable|string|max:255',
            'colour_preference' => 'nullable|string|max:255',
            'print_preference' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'reference_images' => 'nullable|array',
            'reference_images.*' => 'image|max:5120',
        ]);

        $sampleRequest = SampleRequest::create([
            'company_id' => $request->user()->company_id,
            'requested_by' => $request->user()->id,
            'style_name' => $data['style_name'],
            'fabric_preference' => $data['fabric_preference'] ?? null,
            'colour_preference' => $data['colour_preference'] ?? null,
            'print_preference' => $data['print_preference'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => 'pending',
        ]);

        $files = $request->file('reference_images', []);
        foreach ($files as $i => $file) {
            $path = $file->store('sample-requests', 'public');

            // First uploaded image also fills the legacy single-image column,
            // used elsewhere (e.g. "Convert to Sample") as the default cover image.
            if ($i === 0) {
                $sampleRequest->update(['reference_image_path' => $path]);
            }

            \App\Models\SampleRequestImage::create([
                'sample_request_id' => $sampleRequest->id,
                'image_path' => $path,
                'sort_order' => $i,
            ]);
        }

        // Same Specifications x XS..5XL grid used on the Sample — filled in here at request time.
        $specs = $request->input('specification', []);
        foreach ($specs as $i => $spec) {
            if (! trim($spec ?? '')) {
                continue;
            }

            \App\Models\SizeChartRow::create([
                'sample_request_id' => $sampleRequest->id,
                'specification' => $spec,
                'xs' => $request->input('xs.'.$i),
                's' => $request->input('s.'.$i),
                'm' => $request->input('m.'.$i),
                'l' => $request->input('l.'.$i),
                'xl' => $request->input('xl.'.$i),
                'xxl' => $request->input('xxl.'.$i),
                'xxxl' => $request->input('xxxl.'.$i),
                'xxxxl' => $request->input('xxxxl.'.$i),
                'xxxxxl' => $request->input('xxxxxl.'.$i),
                'sort_order' => $i,
            ]);
        }

        return redirect('/sample-requests')->with('success', 'Your sample request has been submitted to IBA.');
    }
}
