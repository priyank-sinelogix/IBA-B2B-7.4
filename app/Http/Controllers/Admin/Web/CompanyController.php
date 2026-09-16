<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Sku;
use App\Support\VmsOrderMatcher;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::with('currency')->withCount('users');
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)->orWhere('code', 'like', $term);
            });
        }
        $companies = $query->latest()->paginate($this->perPage($request));
        return view('admin.companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $company->load('users', 'currency');
        $samples = $company->samples()->latest('submitted_at')->take(10)->get();
        $skuCodes = Sku::whereHas('sample', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->pluck('sku_code');
        $orders = VmsOrderMatcher::recentOrders($skuCodes, 10);
        $shipments = $company->shipments()->latest('status_updated_at')->take(10)->get();
        $ledgerEntries = $company->ledgerEntries()->latest()->take(10)->get();

        return view('admin.companies.show', compact('company', 'samples', 'orders', 'shipments', 'ledgerEntries'));
    }

    public function create()
    {
        $company = new Company();
        $currencies = Currency::where('is_active', true)->orderByDesc('is_base')->orderBy('code')->get();
        return view('admin.companies.form', compact('company', 'currencies'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        // A brand-new company always starts with a clean ledger — used_balance is
        // never accepted from the form, only ever moved by a Finance/Ledger entry.
        $data['used_balance'] = 0;
        Company::create($data);

        return redirect('/admin/companies')->with('success', 'Client company created.');
    }

    public function edit(Company $company)
    {
        $currencies = Currency::where('is_active', true)->orderByDesc('is_base')->orderBy('code')->get();
        return view('admin.companies.form', compact('company', 'currencies'));
    }

    public function update(Request $request, Company $company)
    {
        $data = $this->validated($request, $company->id, $company->exists);
        $company->update($data);

        return redirect('/admin/companies')->with('success', 'Client company updated.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('success', 'Client company deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null, bool $isExistingCompany = false): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:companies,code'.($ignoreId ? ",$ignoreId" : ''),
            'currency_id' => 'required|exists:currencies,id',
            'is_active' => 'boolean',
        ];

        // credit_limit and used_balance are only settable at creation time (the
        // starting limit). Once a company exists, both can only move through a
        // Finance/Ledger entry — never accepted here, even if a request is tampered
        // with, so the ledger and the company record can never disagree.
        if (! $isExistingCompany) {
            $rules['credit_limit'] = 'required|numeric|min:0';
        }

        return $request->validate($rules);
    }
}
