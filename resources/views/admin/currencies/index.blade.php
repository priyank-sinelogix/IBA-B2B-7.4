@extends('admin.layouts.admin')
@section('title', 'Currencies')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Currencies</h3>
        <a href="{{ url('/admin/currencies/create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i> Add Currency</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th>Code</th><th>Symbol</th><th>Name</th><th class="text-right">Exchange Rate</th><th>Companies</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse($currencies as $currency)
                <tr>
                    <td>{{ $currency->code }} @if($currency->is_base) <span class="badge badge-approved ml-1">Base</span> @endif</td>
                    <td>{{ $currency->symbol }}</td>
                    <td>{{ $currency->name }}</td>
                    <td class="text-right">
                        @if($currency->is_base)
                            1.000000
                        @else
                            1 {{ $currency->code }} = {{ \App\Support\Currency::format($currency->exchange_rate, 4) }} {{ optional(\App\Models\Currency::base())->code }}
                        @endif
                    </td>
                    <td>{{ $currency->companies_count }}</td>
                    <td>{!! $currency->is_active ? '<span class="badge badge-approved">Active</span>' : '<span class="badge badge-changes">Inactive</span>' !!}</td>
                    <td>
                        <a href="{{ url('/admin/currencies/'.$currency->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        @if(!$currency->is_base)
                        <form method="POST" action="{{ url('/admin/currencies/'.$currency->id) }}" class="d-inline" onsubmit="return confirm('Delete this currency?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted p-4">No currencies yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
