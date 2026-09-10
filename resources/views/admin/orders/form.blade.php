@extends('admin.layouts.admin')
@section('title', $order->exists ? 'Edit Order' : 'New Order')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card p-0">
            <div class="card-header"><h3 class="card-title">{{ $order->exists ? 'Edit' : 'New' }} Order</h3></div>
            <form method="POST" action="{{ $order->exists ? url('/admin/orders/'.$order->id) : url('/admin/orders') }}">
                @csrf
                @if($order->exists) @method('PUT') @endif
                <div class="card-body">
                    @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

                    <div class="form-group">
                        <label>Client Company</label>
                        <select name="company_id" id="companySelect" class="form-control">
                            @if($order->exists && $order->company)
                                <option value="{{ $order->company->id }}" selected>{{ $order->company->name }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sample (for SKU / VMS matching)</label>
                        <select name="sample_id" id="sampleSelect" class="form-control">
                            @if($order->exists && $order->sample)
                                <option value="{{ $order->sample->id }}" selected>{{ $order->sample->sample_code }} — {{ $order->sample->style_name }}</option>
                            @endif
                        </select>
                        <small class="form-text text-muted">Linking a sample lets the order auto-match its generated SKUs against VMS production data.</small>
                    </div>
                    <div class="form-group">
                        <label>Order No.</label>
                        <input type="text" name="order_no" class="form-control" value="{{ old('order_no', $order->order_no) }}" placeholder="ORD-240512" required>
                    </div>
                    <div class="form-group">
                        <label>Style Name</label>
                        <input type="text" name="style_name" class="form-control" value="{{ old('style_name', $order->style_name) }}" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $order->quantity) }}" required>
                        </div>
                        <div class="form-group col-6">
                            <label>ETA</label>
                            <input type="date" name="eta" class="form-control" value="{{ old('eta', optional($order->eta)->format('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Production Stage</label>
                        <select name="current_stage" class="form-control" required>
                            @foreach($stages as $s)
                                <option value="{{ $s }}" {{ old('current_stage', $order->current_stage ?? 'cutting') == $s ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_',' ',$s)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Save</button>
                    <a href="{{ url('/admin/orders') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @if($order->exists)
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Stage History</h3></div>
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
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        ibaAjaxSelect2('#companySelect', 'companies', { placeholder: 'Search client company...' });
        ibaAjaxSelect2('#sampleSelect', 'samples', { placeholder: 'Search sample / style...', allowClear: true, approvedOnly: true });
    });
</script>
@endsection
