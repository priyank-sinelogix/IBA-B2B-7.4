<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Company;
use App\Models\LedgerEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $query = LedgerEntry::with('company.currency');
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->get('company_id'));
        }
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where(function ($q) use ($term) {
                $q->where('reference_no', 'like', $term)->orWhere('description', 'like', $term);
            });
        }
        $entries = $query->latest()->paginate($this->perPage($request));
        $selectedCompany = $request->filled('company_id') ? Company::find($request->get('company_id')) : null;

        return view('admin.finance.index', compact('entries', 'selectedCompany'));
    }

    public function create()
    {
        return view('admin.finance.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'target' => 'required|in:used_balance,credit_limit',
            'direction' => 'required|in:increase,decrease',
            'reference_no' => 'nullable|string|max:100',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:1000',
        ]);

        $type = $data['target'].'_'.$data['direction'];
        $signedAmount = $data['direction'] === 'increase' ? $data['amount'] : -$data['amount'];

        DB::transaction(function () use ($data, $type, $signedAmount, &$entry) {
            $company = Company::lockForUpdate()->findOrFail($data['company_id']);

            $newValue = (float) $company->{$data['target']} + $signedAmount;
            $company->update([$data['target'] => $newValue]);

            $entry = LedgerEntry::create([
                'company_id' => $company->id,
                'type' => $type,
                'reference_no' => $data['reference_no'] ?? null,
                'amount' => $data['amount'],
                'value_after' => $newValue,
                'description' => $data['description'] ?? null,
            ]);
        });

        AuditLog::record('ledger.entry_created', $entry, null, $entry->only('type', 'amount', 'value_after'));

        return redirect('/admin/finance')->with('success', 'Ledger entry recorded.');
    }

    public function destroy(LedgerEntry $entry)
    {
        // Deliberately no delete — financial records should stay immutable for audit purposes.
        // Post a reversing entry (credit_note/debit_note) instead.
        abort(405, 'Ledger entries are immutable. Post a reversing entry instead.');
    }
}
