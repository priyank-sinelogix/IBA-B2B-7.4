<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LedgerEntry;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FinanceWebController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()->company()->with('currency')->first();

        $ledgerEntries = LedgerEntry::where('company_id', $company->id)
            ->latest()->paginate(20);

        return view('finance.index', compact('company', 'ledgerEntries'));
    }

    public function downloadStatement(Request $request)
    {
        $company = $request->user()->company()->with('currency')->first();

        $ledgerEntries = LedgerEntry::where('company_id', $company->id)
            ->oldest()->get();

        $pdf = Pdf::loadView('finance.statement-pdf', compact('company', 'ledgerEntries'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('statement-'.$company->code.'-'.now()->format('Y-m-d').'.pdf');
    }
}
