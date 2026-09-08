@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">My Orders <small class="text-muted">(live from VMS, matched by SKU)</small></h3></div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th>Style / Sample</th><th>SKU</th><th>Order ID</th><th>Size</th><th>Qty</th><th>Status</th><th>Order Date</th><th>Dispatch Date</th></tr></thead>
            <tbody>
            @forelse($orders ?? [] as $row)
                <tr>
                    <td>{{ optional($row->sample)->style_name ?? '—' }}</td>
                    <td>{{ $row->sku_code }}</td>
                    <td>{{ $row->orderid }}</td>
                    <td>{{ $row->size }}</td>
                    <td>{{ number_format((float) $row->qty) }}</td>
                    <td><span class="badge badge-info">{{ $row->status }}</span></td>
                    <td>{{ $row->order_date }}</td>
                    <td>{{ $row->dispatch_date }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted p-4">
                    No orders found yet in VMS for your samples' SKUs.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ optional($orders ?? null)->links() }}</div>
</div>
@endsection
