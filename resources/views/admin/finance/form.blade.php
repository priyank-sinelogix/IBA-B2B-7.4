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
                <select name="company_id" id="companySelect" class="form-control" required onchange="updateAmountCurrency()">
                    <option value="">-- Select --</option>
                    @foreach($companies as $c)
                        <option value="{{ $c->id }}"
                            data-currency-code="{{ optional($c->currency)->code }}"
                            data-currency-symbol="{{ optional($c->currency)->symbol ?? '₹' }}">
                            {{ $c->name }} ({{ optional($c->currency)->code }}) — Balance: {{ \App\Support\Currency::display($c->current_balance, $c->currency) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Entry Type</label>
                <select name="type" class="form-control" required>
                    <option value="invoice">Invoice (increases balance owed)</option>
                    <option value="payment">Payment (reduces balance owed)</option>
                    <option value="credit_note">Credit Note (reduces balance owed)</option>
                    <option value="debit_note">Debit Note (increases balance owed)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Linked Order (optional)</label>
                <select name="order_id" class="form-control">
                    <option value="">-- None --</option>
                    @foreach($orders as $o)
                        <option value="{{ $o->id }}">{{ $o->order_no }} — {{ $o->style_name }}</option>
                    @endforeach
                </select>
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
    function updateAmountCurrency() {
        var select = document.getElementById('companySelect');
        var opt = select.options[select.selectedIndex];
        var code = (opt && opt.dataset.currencyCode) ? opt.dataset.currencyCode : '';
        var symbol = (opt && opt.dataset.currencySymbol) ? opt.dataset.currencySymbol : '₹';
        document.getElementById('amountCurrencyLabel').textContent = code || 'select company first';
        document.getElementById('amountCurrencySymbol').textContent = symbol;
    }
</script>
@endsection
