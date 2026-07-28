@extends('admin.layouts.admin')
@section('title', 'Pricing')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Pricing Table</h3>
        <a href="{{ url('/admin/pricing/create'.(request('sample_id') ? '?sample_id='.request('sample_id') : '')) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-1"></i> Add Pricing Entry
        </a>
    </div>
    <div class="card-body p-0">
        <form class="d-flex p-3 border-bottom" method="GET">
            <select name="sample_id" class="form-control" style="max-width:280px;" onchange="this.form.submit()">
                <option value="">All Samples</option>
                @foreach($samples as $s)
                    <option value="{{ $s->id }}" {{ request('sample_id') == $s->id ? 'selected' : '' }}>{{ $s->sample_code }} — {{ $s->style_name }}</option>
                @endforeach
            </select>
        </form>
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Style</th><th>Fabric</th>
                    <th class="text-right">Fabric Cost + Accessories</th>
                    <th class="text-right">Stitching Cost</th>
                    <th class="text-right">COGP</th>
                    <th class="text-right">Margin</th>
                    <th class="text-right">Price USD</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse($pricings as $p)
                <tr>
                    <td>{{ $p->style }}</td>
                    <td>{{ $p->fabric }}</td>
                    <td class="text-right">{{ number_format($p->fabric_cost, 2) }}</td>
                    <td class="text-right">{{ number_format($p->stitching_cost, 2) }}</td>
                    <td class="text-right">{{ number_format($p->cogp, 2) }}</td>
                    <td class="text-right">{{ number_format($p->margin, 2) }}</td>
                    <td class="text-right"><strong>{{ number_format($p->price_usd, 2) }}</strong></td>
                    <td>
                        <a href="{{ url('/admin/pricing/'.$p->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form method="POST" action="{{ url('/admin/pricing/'.$p->id) }}" class="d-inline" onsubmit="return confirm('Delete this pricing entry?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted p-4">No pricing entries yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $pricings->links() }}</div>
</div>
@endsection
