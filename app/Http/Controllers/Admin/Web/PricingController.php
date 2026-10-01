<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Sample;
use App\Models\SamplePricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index(Request $request)
    {
        $query = SamplePricing::with('sample.company.currency');
        if ($request->filled('sample_id')) {
            $query->where('sample_id', $request->get('sample_id'));
        }
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->whereHas('sample', function ($q) use ($term) {
                $q->where('style_name', 'like', $term)->orWhere('sample_code', 'like', $term);
            });
        }
        $pricings = $query->latest()->paginate($this->perPage($request));
        $selectedSample = $request->filled('sample_id') ? Sample::find($request->get('sample_id')) : null;

        return view('admin.pricing.index', compact('pricings', 'selectedSample'));
    }

    public function create(Request $request)
    {
        $selectedSample = $request->filled('sample_id') ? Sample::find($request->get('sample_id')) : null;

        return view('admin.pricing.form', compact('selectedSample'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sample_id' => 'required|exists:samples,id',
            'styles' => 'required|array|min:1',
            'styles.*' => 'string|max:255',
            'fabric' => 'nullable|string|max:255',
            'fabric_cost' => 'required|numeric|min:0',
            'accessories_cost' => 'required|numeric|min:0',
            'operational_cost' => 'required|numeric|min:0',
            'stitching_cost' => 'required|numeric|min:0',
            'margin' => 'required|numeric|min:0',
        ]);
        $cogp = SamplePricing::calculateCogp($data);
        $priceUsd = $cogp + $data['margin'];

        // One SKU can be selected, or several at once (e.g. every size under a
        // sample that shares the same cost breakdown) — each gets its own
        // pricing row so unitPriceForSku() can resolve it individually.
        foreach (array_unique($data['styles']) as $style) {
            $pricing = SamplePricing::create([
                'sample_id' => $data['sample_id'],
                'style' => $style,
                'fabric' => $data['fabric'] ?? null,
                'fabric_cost' => $data['fabric_cost'],
                'accessories_cost' => $data['accessories_cost'],
                'operational_cost' => $data['operational_cost'],
                'stitching_cost' => $data['stitching_cost'],
                'cogp' => $cogp,
                'margin' => $data['margin'],
                'price_usd' => $priceUsd,
            ]);
            AuditLog::record('pricing.created', $pricing, null, $pricing->only('style', 'price_usd'));
        }

        $count = count(array_unique($data['styles']));

        return redirect('/admin/pricing?sample_id='.$data['sample_id'])->with('success', $count.' pricing '.($count === 1 ? 'entry' : 'entries').' added.');
    }

    public function edit(SamplePricing $pricing)
    {
        return view('admin.pricing.form', compact('pricing'));
    }

    public function update(Request $request, SamplePricing $pricing)
    {
        $data = $this->validated($request);
        $data['cogp'] = SamplePricing::calculateCogp($data);
        $data['price_usd'] = $data['cogp'] + $data['margin'];

        $before = $pricing->only('style', 'price_usd');
        $pricing->update($data);

        AuditLog::record('pricing.updated', $pricing, $before, $pricing->only('style', 'price_usd'));

        return redirect('/admin/pricing?sample_id='.$data['sample_id'])->with('success', 'Pricing entry updated.');
    }

    public function destroy(SamplePricing $pricing)
    {
        $sampleId = $pricing->sample_id;
        $pricing->delete();

        return redirect('/admin/pricing?sample_id='.$sampleId)->with('success', 'Pricing entry deleted.');
    }

    // price_usd and cogp are no longer accepted from the form — both are server-calculated.
    private function validated(Request $request): array
    {
        return $request->validate([
            'sample_id' => 'required|exists:samples,id',
            'style' => 'required|string|max:255',
            'fabric' => 'nullable|string|max:255',
            'fabric_cost' => 'required|numeric|min:0',
            'accessories_cost' => 'required|numeric|min:0',
            'operational_cost' => 'required|numeric|min:0',
            'stitching_cost' => 'required|numeric|min:0',
            'margin' => 'required|numeric|min:0',
        ]);
    }
}
