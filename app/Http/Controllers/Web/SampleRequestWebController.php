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

        return redirect('/sample-requests')->with('success', 'Your sample request has been submitted to IBA.');
    }
}
