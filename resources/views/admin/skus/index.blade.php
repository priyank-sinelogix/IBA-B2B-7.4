@extends('admin.layouts.admin')
@section('title', 'SKU Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Generated SKUs</h3>
        <a href="{{ url('/admin/skus/create'.(request('sample_id') ? '?sample_id='.request('sample_id') : '')) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-1"></i> Generate SKUs
        </a>
    </div>
    <div class="card-body p-0">
        <form class="d-flex p-3 border-bottom" method="GET">
            <select name="sample_id" class="form-control" style="max-width:280px;" onchange="this.form.submit()">
                <option value="">All Approved Samples</option>
                @foreach($samples as $s)
                    <option value="{{ $s->id }}" {{ request('sample_id') == $s->id ? 'selected' : '' }}>{{ $s->sample_code }} — {{ $s->style_name }}</option>
                @endforeach
            </select>
        </form>
        <table class="table table-hover mb-0">
            <thead><tr><th>SKU Code</th><th>Style</th><th>Fabric</th><th>Print</th><th>Colour</th><th>Size</th><th></th></tr></thead>
            <tbody>
            @forelse($skus as $sku)
                <tr>
                    <td><strong>{{ $sku->sku_code }}</strong></td>
                    <td>{{ $sku->style_name }}</td>
                    <td>{{ $sku->fabric ?? '—' }}</td>
                    <td>{{ $sku->print ?? '—' }}</td>
                    <td>{{ $sku->colour ?? '—' }}</td>
                    <td>{{ $sku->size ?? '—' }}</td>
                    <td>
                        <a href="{{ url('/admin/skus/'.$sku->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form method="POST" action="{{ url('/admin/skus/'.$sku->id) }}" class="d-inline" onsubmit="return confirm('Delete this SKU?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted p-4">No SKUs generated yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $skus->links() }}</div>
</div>
@endsection
