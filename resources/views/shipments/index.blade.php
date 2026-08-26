@extends('layouts.admin')
@section('title', 'Shipments & Tracking')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Recent Tracking Reports</h3></div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th>AWB / Tracking ID</th><th>Carrier</th><th>Origin</th><th>Destination</th><th class="text-right">Shipping Price</th><th>Status</th><th>Updated</th></tr></thead>
            <tbody>
            @forelse($shipments ?? [] as $shipment)
                <tr>
                    <td>{{ $shipment->awb_number }}</td>
                    <td>{{ $shipment->carrier }}</td>
                    <td>{{ $shipment->origin }}</td>
                    <td>{{ $shipment->destination }}</td>
                    <td class="text-right">{{ $shipment->shipping_price !== null ? \App\Support\Currency::display($shipment->shipping_price, $shipment->company->currency) : '—' }}</td>
                    <td><span class="badge badge-info text-capitalize">{{ str_replace('_',' ',$shipment->status) }}</span></td>
                    <td>{{ optional($shipment->status_updated_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted p-4">
                    No records yet. Connect <code>$shipments</code> from <code>ShipmentWebController@index</code>.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ optional($shipments ?? null)->links() }}</div>
</div>
@endsection
