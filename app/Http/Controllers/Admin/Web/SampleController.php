<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Company;
use App\Models\Sample;
use App\Models\SampleVersion;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sample::with(['company', 'latestVersion']);

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->get('company_id'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $samples = $query->latest('submitted_at')->paginate(15);
        $companies = Company::orderBy('name')->get();

        return view('admin.samples.index', compact('samples', 'companies'));
    }

    public function show(Sample $sample)
    {
        $sample->load(['company', 'versions.images', 'comments.user', 'sizeChartRows', 'sizeChartApprovedBy', 'skus', 'pricings']);
        return view('admin.samples.show', compact('sample'));
    }

    /**
     * Saves the full Specifications x XS..5XL grid in one go (client-side "+" adds
     * blank rows, this replaces the whole set on submit). Re-opens approval since
     * the chart changed.
     */
    public function updateSizeChart(Request $request, Sample $sample)
    {
        $data = $request->validate([
            'specification' => 'array',
            'specification.*' => 'nullable|string|max:255',
            'xs' => 'array', 's' => 'array', 'm' => 'array', 'l' => 'array', 'xl' => 'array',
            'xxl' => 'array', 'xxxl' => 'array', 'xxxxl' => 'array', 'xxxxxl' => 'array',
        ]);

        $sample->sizeChartRows()->delete();

        $specs = $data['specification'] ?? [];
        foreach ($specs as $i => $spec) {
            if (! trim($spec ?? '')) {
                continue;
            }

            \App\Models\SizeChartRow::create([
                'sample_id' => $sample->id,
                'specification' => $spec,
                'xs' => $data['xs'][$i] ?? null,
                's' => $data['s'][$i] ?? null,
                'm' => $data['m'][$i] ?? null,
                'l' => $data['l'][$i] ?? null,
                'xl' => $data['xl'][$i] ?? null,
                'xxl' => $data['xxl'][$i] ?? null,
                'xxxl' => $data['xxxl'][$i] ?? null,
                'xxxxl' => $data['xxxxl'][$i] ?? null,
                'xxxxxl' => $data['xxxxxl'][$i] ?? null,
                'sort_order' => $i,
            ]);
        }

        // Any change to the chart re-opens it for client approval
        $sample->update(['size_chart_status' => 'pending', 'size_chart_approved_by' => null, 'size_chart_approved_at' => null]);

        AuditLog::record('sample.size_chart_updated', $sample, null, ['rows' => count($specs)]);

        return back()->with('success', 'Size chart saved and sent to client for approval.');
    }

    /**
     * Bulk-replaces the size chart from an uploaded CSV. Expected columns:
     * Specification,XS,S,M,L,XL,XXL,XXXL,XXXXL,XXXXXL (header row required).
     */
    public function importSizeChartCsv(Request $request, Sample $sample)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $handle = fopen($request->file('csv_file')->getRealPath(), 'r');
        if (! $handle) {
            return back()->with('error', 'Could not read the uploaded file.');
        }

        $rows = [];
        fgetcsv($handle); // skip header row

        while (($line = fgetcsv($handle)) !== false) {
            $specification = trim($line[0] ?? '');
            if ($specification === '') {
                continue;
            }

            $rows[] = [
                'specification' => $specification,
                'xs' => $this->csvNum($line[1] ?? null),
                's' => $this->csvNum($line[2] ?? null),
                'm' => $this->csvNum($line[3] ?? null),
                'l' => $this->csvNum($line[4] ?? null),
                'xl' => $this->csvNum($line[5] ?? null),
                'xxl' => $this->csvNum($line[6] ?? null),
                'xxxl' => $this->csvNum($line[7] ?? null),
                'xxxxl' => $this->csvNum($line[8] ?? null),
                'xxxxxl' => $this->csvNum($line[9] ?? null),
            ];
        }
        fclose($handle);

        if (empty($rows)) {
            return back()->with('error', 'No valid rows found in the CSV file.');
        }

        $sample->sizeChartRows()->delete();

        foreach ($rows as $i => $row) {
            \App\Models\SizeChartRow::create($row + ['sample_id' => $sample->id, 'sort_order' => $i]);
        }

        $sample->update(['size_chart_status' => 'pending', 'size_chart_approved_by' => null, 'size_chart_approved_at' => null]);

        AuditLog::record('sample.size_chart_imported', $sample, null, ['rows' => count($rows)]);

        return back()->with('success', count($rows).' size chart row(s) imported from CSV and sent to client for approval.');
    }

    private function csvNum($value)
    {
        $value = trim((string) $value);
        return $value === '' ? null : (float) $value;
    }

    public function storeComment(Request $request, Sample $sample)
    {
        $request->validate(['comment' => 'required|string|max:2000']);

        \App\Models\SampleComment::create([
            'sample_id' => $sample->id,
            'sample_version_id' => optional($sample->latestVersion)->id,
            'user_id' => $request->user()->id,
            'comment' => $request->input('comment'),
            'action' => 'comment',
        ]);

        AuditLog::record('sample.comment_added', $sample, null, ['comment' => $request->input('comment')]);

        return back()->with('success', 'Comment added.');
    }

    public function create()
    {
        $sample = new Sample();
        $companies = Company::orderBy('name')->get();
        return view('admin.samples.form', compact('sample', 'companies'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'sample_code' => 'required|string|max:100|unique:samples,sample_code',
            'style_name' => 'required|string|max:255',
            'fabric' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:5120',
            'notes' => 'nullable|string|max:1000',
        ]);

        $sample = Sample::create([
            'company_id' => $data['company_id'],
            'sample_code' => $data['sample_code'],
            'style_name' => $data['style_name'],
            'fabric' => $data['fabric'] ?? null,
            'color' => $data['color'] ?? null,
            'status' => 'pending',
            'submitted_by' => $request->user()->id,
            'submitted_at' => now(),
        ]);

        $this->storeVersion($request, $sample, 1);

        AuditLog::record('sample.created', $sample, null, $sample->only('sample_code', 'status'));

        return redirect('/admin/samples')->with('success', 'Sample created and sent to client for approval.');
    }

    public function edit(Sample $sample)
    {
        $companies = Company::orderBy('name')->get();
        $sample->load(['versions.images', 'comments.user']);
        return view('admin.samples.form', compact('sample', 'companies'));
    }

    public function update(Request $request, Sample $sample)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'style_name' => 'required|string|max:255',
            'fabric' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120',
            'notes' => 'nullable|string|max:1000',
        ]);

        $before = $sample->only('style_name', 'fabric', 'color', 'status');

        $sample->update([
            'company_id' => $data['company_id'],
            'style_name' => $data['style_name'],
            'fabric' => $data['fabric'] ?? null,
            'color' => $data['color'] ?? null,
        ]);

        // Uploading new images = new version + resets status to pending for re-approval
        if ($request->hasFile('images')) {
            $nextVersion = ($sample->versions()->max('version_no') ?? 0) + 1;
            $this->storeVersion($request, $sample, $nextVersion);
            $sample->update(['status' => 'pending']);
        }

        AuditLog::record('sample.updated', $sample, $before, $sample->fresh()->only('style_name', 'fabric', 'color', 'status'));

        return redirect('/admin/samples')->with('success', 'Sample updated.');
    }

    public function destroy(Sample $sample)
    {
        AuditLog::record('sample.deleted', $sample, $sample->only('sample_code', 'status'), null);
        $sample->delete();

        return back()->with('success', 'Sample deleted.');
    }

    private function storeVersion(Request $request, Sample $sample, int $versionNo): void
    {
        $files = $request->file('images', []);

        // First image becomes the "cover" (image_path) for backward-compatible thumbnails;
        // every image (including the first) is also saved into the version's gallery.
        $coverPath = $files[0]->store('samples/'.$sample->id, 'public');

        $version = SampleVersion::create([
            'sample_id' => $sample->id,
            'version_no' => $versionNo,
            'image_path' => $coverPath,
            'notes' => $request->input('notes'),
            'uploaded_by' => $request->user()->id,
        ]);

        \App\Models\SampleVersionImage::create([
            'sample_version_id' => $version->id,
            'image_path' => $coverPath,
            'sort_order' => 0,
        ]);

        foreach (array_slice($files, 1) as $i => $file) {
            $path = $file->store('samples/'.$sample->id, 'public');
            \App\Models\SampleVersionImage::create([
                'sample_version_id' => $version->id,
                'image_path' => $path,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
