<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\Sku;
use App\Models\Message;
use App\Support\VmsOrderMatcher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;
        $company = $request->user()->company()->with('currency')->first();

        $skuCodes = Sku::whereHas('sample', function ($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->pluck('sku_code');

        $stats = [
            'samples_pending' => Sample::where('company_id', $companyId)->where('status', 'pending')->count(),
            'active_orders' => VmsOrderMatcher::orderCount($skuCodes),
            'balance' => $company->current_balance ?? 0,
            'credit_limit' => $company->credit_limit ?? 0,
            'credit_used_pct' => $company->creditUsedPercent() ?? 0,
            'shipments_in_transit' => \App\Models\Shipment::where('company_id', $companyId)->where('status', 'in_transit')->count(),
        ];

        $pendingSamples = Sample::with('latestVersion')
            ->where('company_id', $companyId)
            ->whereIn('status', ['pending', 'changes_requested'])
            ->latest('submitted_at')->take(5)->get();

        $orders = VmsOrderMatcher::recentOrders($skuCodes, 5);

        $recentMessages = Message::with('sender')
            ->where('company_id', $companyId)
            ->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'pendingSamples', 'orders', 'recentMessages', 'company'));
    }
}
