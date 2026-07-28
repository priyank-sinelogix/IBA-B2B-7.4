<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Sample;
use App\Models\Sku;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    private array $sizes = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'];

    public function index(Request $request)
    {
        $query = Sku::with('sample.company');
        if ($request->filled('sample_id')) {
            $query->where('sample_id', $request->get('sample_id'));
        }
        $skus = $query->latest()->paginate(20);
        $samples = Sample::where('status', 'approved')->orderBy('style_name')->get();

        return view('admin.skus.index', compact('skus', 'samples'));
    }

    public function create(Request $request)
    {
        $samples = Sample::where('status', 'approved')->orderBy('style_name')->get();
        $selectedSample = $request->filled('sample_id') ? Sample::find($request->get('sample_id')) : null;

        return view('admin.skus.form', compact('samples', 'selectedSample'))->with('sizes', $this->sizes);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sample_id' => 'required|exists:samples,id',
            'fabric' => 'nullable|string|max:255',
            'print' => 'nullable|string|max:255',
            'colour' => 'nullable|string|max:255',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'string',
            'sku_prefix' => 'nullable|string|max:100',
        ]);

        $sample = Sample::findOrFail($data['sample_id']);
        $created = [];

        foreach ($data['sizes'] as $size) {
            $code = $data['sku_prefix']
                ? strtoupper($data['sku_prefix']).'-'.$size
                : Sku::suggestCode($sample->style_name, $data['fabric'] ?? null, $data['colour'] ?? null, $size);

            // Ensure uniqueness even if the suggested code collides
            $baseCode = $code;
            $i = 1;
            while (Sku::where('sku_code', $code)->exists()) {
                $code = $baseCode.'-'.$i;
                $i++;
            }

            $sku = Sku::create([
                'sample_id' => $sample->id,
                'sku_code' => $code,
                'style_name' => $sample->style_name,
                'fabric' => $data['fabric'] ?? null,
                'print' => $data['print'] ?? null,
                'colour' => $data['colour'] ?? null,
                'size' => $size,
                'generated_by' => $request->user()->id,
            ]);

            $created[] = $sku->sku_code;
        }

        AuditLog::record('sku.generated', $sample, null, ['skus' => $created]);

        return redirect('/admin/skus?sample_id='.$sample->id)->with('success', count($created).' SKU(s) generated.');
    }

    public function edit(Sku $sku)
    {
        return view('admin.skus.edit', compact('sku'));
    }

    public function update(Request $request, Sku $sku)
    {
        $data = $request->validate([
            'sku_code' => 'required|string|max:100|unique:skus,sku_code,'.$sku->id,
            'fabric' => 'nullable|string|max:255',
            'print' => 'nullable|string|max:255',
            'colour' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:20',
        ]);

        $sku->update($data);

        return redirect('/admin/skus?sample_id='.$sku->sample_id)->with('success', 'SKU updated.');
    }

    public function destroy(Sku $sku)
    {
        $sampleId = $sku->sample_id;
        $sku->delete();

        return redirect('/admin/skus?sample_id='.$sampleId)->with('success', 'SKU deleted.');
    }
}
