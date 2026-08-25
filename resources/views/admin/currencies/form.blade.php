@extends('admin.layouts.admin')
@section('title', $currency->exists ? 'Edit Currency' : 'Add Currency')

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header"><h3 class="card-title">{{ $currency->exists ? 'Edit' : 'New' }} Currency</h3></div>
    <form method="POST" action="{{ $currency->exists ? url('/admin/currencies/'.$currency->id) : url('/admin/currencies') }}">
        @csrf
        @if($currency->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control text-uppercase" value="{{ old('code', $currency->code) }}" placeholder="e.g. USD" maxlength="10" required>
                </div>
                <div class="form-group col-4">
                    <label>Symbol</label>
                    <input type="text" name="symbol" class="form-control" value="{{ old('symbol', $currency->symbol) }}" placeholder="e.g. $" maxlength="10" required>
                </div>
                <div class="form-group col-4">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $currency->name) }}" placeholder="e.g. US Dollar" required>
                </div>
            </div>

            @if($currency->exists && $currency->is_base)
                <input type="hidden" name="exchange_rate" value="1">
                <div class="form-group">
                    <label>Exchange Rate</label>
                    <input type="text" class="form-control" value="1.000000 (base currency)" disabled>
                    <small class="text-muted">This is the base currency — every other rate is measured against it, so it always stays 1.</small>
                </div>
            @else
                <div class="form-group">
                    <label>Exchange Rate <span class="text-muted">(1 {{ $currency->code ?: 'this currency' }} = ? {{ optional(\App\Models\Currency::base())->code ?? 'base currency' }})</span></label>
                    <input type="number" step="0.000001" min="0.000001" name="exchange_rate" class="form-control" value="{{ old('exchange_rate', $currency->exchange_rate ?? '') }}" required>
                </div>
            @endif

            <div class="form-group form-check">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ old('is_active', $currency->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">Active (selectable for companies)</label>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('/admin/currencies') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
