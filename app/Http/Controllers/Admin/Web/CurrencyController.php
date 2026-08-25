<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::withCount('companies')->orderByDesc('is_base')->orderBy('code')->get();
        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        $currency = new Currency();
        return view('admin.currencies.form', compact('currency'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $currency = Currency::create($data);

        AuditLog::record('currency.created', $currency, null, $currency->only('code', 'exchange_rate'));

        return redirect('/admin/currencies')->with('success', 'Currency added.');
    }

    public function edit(Currency $currency)
    {
        return view('admin.currencies.form', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $data = $this->validated($request, $currency->id);

        // The base currency always has exchange_rate = 1 — every other rate is
        // stored relative to it, so letting it drift would silently break every
        // conversion in the app.
        if ($currency->is_base) {
            $data['exchange_rate'] = 1;
        }

        $before = $currency->only('code', 'exchange_rate');
        $currency->update($data);

        AuditLog::record('currency.updated', $currency, $before, $currency->only('code', 'exchange_rate'));

        return redirect('/admin/currencies')->with('success', 'Currency updated.');
    }

    public function destroy(Currency $currency)
    {
        if ($currency->is_base) {
            return back()->with('error', 'The base currency cannot be deleted.');
        }

        if ($currency->companies()->exists()) {
            return back()->with('error', 'This currency is assigned to one or more companies and cannot be deleted.');
        }

        $currency->delete();

        return back()->with('success', 'Currency deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'code' => 'required|string|max:10|unique:currencies,code'.($ignoreId ? ",$ignoreId" : ''),
            'symbol' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'exchange_rate' => 'required|numeric|min:0.000001',
            'is_active' => 'boolean',
        ]);
    }
}
