@extends('admin.layouts.admin')
@section('title', $order->order_no)

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Order Details</h3>
                <a href="{{ url('/admin/orders/'.$order->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Order No.</dt><dd class="col-7">{{ $order->order_no }}</dd>
                    <dt class="col-5">Style Name</dt><dd class="col-7">{{ $order->style_name }}</dd>
                    <dt class="col-5">Quantity</dt><dd class="col-7">{{ number_format($order->quantity) }} Pcs</dd>
                    <dt class="col-5">Current Stage</dt>
                    <dd class="col-7"><span class="badge badge-info text-capitalize">{{ str_replace('_',' ',$order->current_stage) }}</span></dd>
                    <dt class="col-5">ETA</dt><dd class="col-7">{{ optional($order->eta)->format('d M Y') ?? '—' }}</dd>
                    <dt class="col-5">Created</dt><dd class="col-7">{{ $order->created_at->format('d M Y') }}</dd>
                </dl>
            </div>
        </div>

        <!-- Company details, as requested: order's client company shown here -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Client Company</h3>
                <a href="{{ url('/admin/companies/'.$order->company->id) }}" class="btn btn-sm btn-outline-secondary">View Company</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Name</dt><dd class="col-7">{{ $order->company->name }}</dd>
                    <dt class="col-5">Code</dt><dd class="col-7">{{ $order->company->code }}</dd>
                    <dt class="col-5">Credit Limit</dt><dd class="col-7">₹{{ \App\Support\Currency::format($order->company->credit_limit) }}</dd>
                    <dt class="col-5">Current Balance</dt><dd class="col-7">₹{{ \App\Support\Currency::format($order->company->current_balance) }}</dd>
                    <dt class="col-5">Status</dt>
                    <dd class="col-7">{!! $order->company->is_active ? '<span class="badge badge-approved">Active</span>' : '<span class="badge badge-changes">Inactive</span>' !!}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Production Stage History</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($order->stageLogs as $log)
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-capitalize">{{ str_replace('_',' ',$log->stage) }}</span>
                            <span class="text-muted small">{{ $log->changed_at->format('d M Y, h:i A') }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">No stage history yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Linked Shipments</h3></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>AWB</th><th>Carrier</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    @forelse($order->shipments as $sh)
                        <tr>
                            <td>{{ $sh->awb_number }}</td>
                            <td>{{ $sh->carrier }}</td>
                            <td class="text-capitalize">{{ str_replace('_',' ',$sh->status) }}</td>
                            <td><a href="{{ url('/admin/shipments/'.$sh->id) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted p-3">No shipments linked yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
