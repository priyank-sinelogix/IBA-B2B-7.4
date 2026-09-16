@extends('admin.layouts.admin')
@section('title', 'New Ledger Entry')

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header"><h3 class="card-title">New Ledger Entry</h3></div>
    <form method="POST" action="{{ url('/admin/finance') }}">
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

            <div class="form-group">
                <label>Client Company</label>
                <select name="company_id" id="companySelect" class="form-control">
                </select>
            </div>
            <div class="form-group">
                <label>What are you updating?</label>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="targetUsedBalance" name="target" value="used_balance" class="custom-control-input" checked>
                        <label class="custom-control-label" for="targetUsedBalance">Used Balance <small class="text-muted">— what the client currently owes</small></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="targetCreditLimit" name="target" value="credit_limit" class="custom-control-input">
                        <label class="custom-control-label" for="targetCreditLimit">Credit Limit <small class="text-muted">— the max credit allowed</small></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Direction</label>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="dirIncrease" name="direction" value="increase" class="custom-control-input" checked>
                        <label class="custom-control-label" for="dirIncrease">Increase</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="dirDecrease" name="direction" value="decrease" class="custom-control-input">
                        <label class="custom-control-label" for="dirDecrease">Decrease</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label>Amount (<span id="amountCurrencyLabel">select company first</span>)</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text" id="amountCurrencySymbol">₹</span></div>
                        <input type="number" step="0.01" name="amount" class="form-control" required>
                    </div>
                    <small class="text-muted">Entered in the selected client's own currency — not converted.</small>
                </div>
                <div class="form-group col-6">
                    <label>Reference No.</label>
                    <input type="text" name="reference_no" class="form-control" placeholder="INV-2024-001">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save Entry</button>
            <a href="{{ url('/admin/finance') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        ibaAjaxSelect2('#companySelect', 'companies', { placeholder: 'Search client company...' });

        $('#companySelect').on('select2:select', function (e) {
            var data = e.params.data || {};
            document.getElementById('amountCurrencyLabel').textContent = data.currency_code || 'select company first';
            document.getElementById('amountCurrencySymbol').textContent = data.currency_symbol || '₹';
        });
    });
</script>
@endsection
