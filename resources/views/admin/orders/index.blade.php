@extends('admin.layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Orders <small class="text-muted">(live from VMS, matched by SKU)</small></h3>
        {{-- Manual order creation disabled for now — orders are sourced from VMS.
        <a href="{{ url('/admin/orders/create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i> New Order</a>
        --}}
    </div>
    <div class="card-body p-0">
        <form class="d-flex p-3 border-bottom" method="GET">
            <select name="company_id" class="form-control" style="max-width:220px;" onchange="this.form.submit()">
                <option value="">All Clients</option>
                @foreach($companies as $c)
                    <option value="{{ $c->id }}" {{ request('company_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </form>
        <table class="table table-hover mb-0">
            <thead><tr><th>Client</th><th>Style / Sample</th><th>SKU</th><th>VMS Order ID</th><th>Size</th><th>Qty</th><th>Status</th><th>Order Date</th><th>Dispatch Date</th></tr></thead>
            <tbody>
            @forelse($orders as $row)
                <tr>
                    <td>{{ optional($row->company)->name ?? '—' }}</td>
                    <td>{{ optional($row->sample)->style_name ?? '—' }}</td>
                    <td>{{ $row->sku_code }}</td>
                    <td>{{ $row->orderid }}</td>
                    <td>{{ $row->size }}</td>
                    <td>{{ number_format((float) $row->qty) }}</td>
                    <td><span class="badge badge-info">{{ \App\Support\VmsOrderMatcher::statusLabel($row->status) }}</span></td>
                    <td>{{ $row->order_date }}</td>
                    <td>{{ $row->dispatch_date }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center text-muted p-4">No VMS orders found yet for any generated SKU.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $orders->links() }}</div>
</div>
@endsection
