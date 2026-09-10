<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentWebController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::with('company.currency')
            ->where('company_id', $request->user()->company_id);

        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where(function ($q) use ($term) {
                $q->where('awb_number', 'like', $term)
                    ->orWhere('carrier', 'like', $term)
                    ->orWhere('destination', 'like', $term);
            });
        }

        $shipments = $query->latest('status_updated_at')->paginate($this->perPage($request));

        return view('shipments.index', compact('shipments'));
    }
}
