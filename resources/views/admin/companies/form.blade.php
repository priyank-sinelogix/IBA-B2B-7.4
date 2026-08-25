@extends('admin.layouts.admin')
@section('title', $company->exists ? 'Edit Company' : 'Add Company')

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header"><h3 class="card-title">{{ $company->exists ? 'Edit' : 'New' }} Client Company</h3></div>
    <form method="POST" action="{{ $company->exists ? url('/admin/companies/'.$company->id) : url('/admin/companies') }}">
        @csrf
        @if($company->exists) @method('PUT') @endif
        <div class="card-body">
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
            </div>
            <div class="form-group">
                <label>Company Code (unique)</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $company->code) }}" placeholder="e.g. OCEANIC-APPAREL" required>
            </div>
            <div class="form-group">
                <label>Currency</label>
                <select name="currency_id" class="form-control" required>
                    <option value="">Select currency</option>
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" {{ old('currency_id', $company->currency_id ?? '') == $currency->id ? 'selected' : '' }}>
                            {{ $currency->code }} ({{ $currency->symbol }}) — {{ $currency->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Used for this client's credit limit, balance, and pricing. <a href="{{ url('/admin/currencies') }}" target="_blank">Manage currencies</a></small>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label>Credit Limit</label>
                    <input type="number" step="0.01" name="credit_limit" class="form-control" value="{{ old('credit_limit', $company->credit_limit ?? 0) }}" required>
                </div>
                <div class="form-group col-6">
                    <label>Current Balance</label>
                    <input type="number" step="0.01" name="current_balance" class="form-control" value="{{ old('current_balance', $company->current_balance ?? 0) }}" required>
                </div>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ old('is_active', $company->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">Active</label>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('/admin/companies') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
