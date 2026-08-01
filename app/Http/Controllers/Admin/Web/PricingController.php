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
        $query = SamplePricing::with('sample.company');
        if ($request->filled('sample_id')) {
            $query->where('sample_id', $request->get('sample_id'));
        }
        $pricings = $query->latest()->paginate(20);
        $samples = Sample::orderBy('style_name')->get();

        return view('admin.pricing.index', compact('pricings', 'samples'));
    }

    public function create(Request $request)
    {
        $samples = Sample::orderBy('style_name')->get();
        $selectedSample = $request->filled('sample_id') ? Sample::find($request->get('sample_id')) : null;

        return view('admin.pricing.form', compact('samples', 'selectedSample'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cogp'] = SamplePricing::calculateCogp($data);
        $data['price_usd'] = $data['cogp'] + $data['margin'];

        $pricing = SamplePricing::create($data);
        AuditLog::record('pricing.created', $pricing, null, $pricing->only('style', 'price_usd'));

        return redirect('/admin/pricing?sample_id='.$data['sample_id'])->with('success', 'Pricing entry added.');
    }

    public function edit(SamplePricing $pricing)
    {
        $samples = Sample::orderBy('style_name')->get();
        return view('admin.pricing.form', compact('pricing', 'samples'));
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
