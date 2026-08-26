@extends('admin.layouts.admin')
@section('title', $shipment->awb_number)

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Shipment Details</h3>
                <a href="{{ url('/admin/shipments/'.$shipment->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">AWB / Tracking No.</dt><dd class="col-7">{{ $shipment->awb_number }}</dd>
                    <dt class="col-5">Carrier</dt><dd class="col-7">{{ $shipment->carrier }}</dd>
                    <dt class="col-5">Origin</dt><dd class="col-7">{{ $shipment->origin ?? '—' }}</dd>
                    <dt class="col-5">Destination</dt><dd class="col-7">{{ $shipment->destination ?? '—' }}</dd>
                    <dt class="col-5">Shipping Price</dt>
                    <dd class="col-7">{{ $shipment->shipping_price !== null ? \App\Support\Currency::display($shipment->shipping_price, $shipment->company->currency) : '—' }}</dd>
                    <dt class="col-5">Status</dt>
                    <dd class="col-7"><span class="badge badge-info text-capitalize">{{ str_replace('_',' ',$shipment->status) }}</span></dd>
                    <dt class="col-5">Last Updated</dt><dd class="col-7">{{ optional($shipment->status_updated_at)->format('d M Y, h:i A') }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Client Company</h3>
                <a href="{{ url('/admin/companies/'.$shipment->company->id) }}" class="btn btn-sm btn-outline-secondary">View Company</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Name</dt><dd class="col-7">{{ $shipment->company->name }}</dd>
                    <dt class="col-5">Code</dt><dd class="col-7">{{ $shipment->company->code }}</dd>
                </dl>
            </div>
        </div>

        @if($shipment->order)
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Linked Order</h3>
                <a href="{{ url('/admin/orders/'.$shipment->order->id) }}" class="btn btn-sm btn-outline-secondary">View Order</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Order No.</dt><dd class="col-7">{{ $shipment->order->order_no }}</dd>
                    <dt class="col-5">Style</dt><dd class="col-7">{{ $shipment->order->style_name }}</dd>
                </dl>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tracking Timeline</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($shipment->trackingEvents as $event)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span class="text-capitalize font-weight-bold">{{ str_replace('_',' ',$event->status) }}</span>
                                <span class="text-muted small">{{ $event->event_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div class="text-muted small">{{ $event->location }} — {{ $event->remarks }}</div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">No tracking events yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
