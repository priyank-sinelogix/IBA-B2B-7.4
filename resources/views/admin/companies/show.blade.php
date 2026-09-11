@extends('admin.layouts.admin')
@section('title', $company->name)

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Company Details</h3>
                <a href="{{ url('/admin/companies/'.$company->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Name</dt><dd class="col-7">{{ $company->name }}</dd>
                    <dt class="col-5">Code</dt><dd class="col-7">{{ $company->code }}</dd>
                    <dt class="col-5">Status</dt>
                    <dd class="col-7">{!! $company->is_active ? '<span class="badge badge-approved">Active</span>' : '<span class="badge badge-changes">Inactive</span>' !!}</dd>
                    <dt class="col-5">Currency</dt><dd class="col-7">{{ optional($company->currency)->code }} ({{ optional($company->currency)->name }})</dd>
                    <dt class="col-5">Credit Limit</dt>
                    <dd class="col-7">
                        {{ \App\Support\Currency::display($company->credit_limit, $company->currency) }}
                        @if($company->currency && !$company->currency->is_base)
                            <span class="text-muted small d-block">≈ {{ \App\Support\Currency::display(\App\Support\Currency::convert($company->credit_limit, $company->currency, \App\Models\Currency::base()), \App\Models\Currency::base()) }}</span>
                        @endif
                    </dd>
                    <dt class="col-5">Current Balance</dt>
                    <dd class="col-7">
                        {{ \App\Support\Currency::display($company->current_balance, $company->currency) }}
                        @if($company->currency && !$company->currency->is_base)
                            <span class="text-muted small d-block">≈ {{ \App\Support\Currency::display(\App\Support\Currency::convert($company->current_balance, $company->currency, \App\Models\Currency::base()), \App\Models\Currency::base()) }}</span>
                        @endif
                    </dd>
                    <dt class="col-5">Credit Used</dt><dd class="col-7">{{ $company->creditUsedPercent() }}%</dd>
                    <dt class="col-5">Created</dt><dd class="col-7">{{ $company->created_at->format('d M Y') }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Users ({{ $company->users->count() }})</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($company->users as $user)
                        <li class="list-group-item">
                            <a href="{{ url('/admin/users/'.$user->id) }}">{{ $user->name }}</a>
                            <div class="text-muted small">{{ $user->email }} — {{ $user->designation }}</div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">No users yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Recent Samples</h3></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Code</th><th>Style</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    @forelse($samples as $s)
                        <tr>
                            <td>{{ $s->sample_code }}</td>
                            <td>{{ $s->style_name }}</td>
                            <td class="text-capitalize">{{ str_replace('_',' ',$s->status) }}</td>
                            <td><a href="{{ url('/admin/samples/'.$s->id) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted p-3">No samples yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Recent Orders <small class="text-muted">(live from VMS)</small></h3>
                <a href="{{ url('/admin/orders?company_id='.$company->id) }}" class="small">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Order ID</th><th>SKUs</th><th>Status</th><th>Order Date</th></tr></thead>
                    <tbody>
                    @forelse($orders as $o)
                        <tr>
                            <td>{{ $o->orderid }}</td>
                            <td>{{ $o->sku_count }}</td>
                            <td><span class="badge badge-info">{{ \App\Support\VmsOrderMatcher::statusLabel($o->status) }}</span></td>
                            <td>{{ $o->order_date }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted p-3">No orders found yet in VMS for this company's SKUs.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Recent Shipments</h3></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>AWB</th><th>Carrier</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                    @forelse($shipments as $sh)
                        <tr>
                            <td>{{ $sh->awb_number }}</td>
                            <td>{{ $sh->carrier }}</td>
                            <td class="text-capitalize">{{ str_replace('_',' ',$sh->status) }}</td>
                            <td><a href="{{ url('/admin/shipments/'.$sh->id) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted p-3">No shipments yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Recent Ledger Entries</h3></div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Date</th><th>Type</th><th class="text-right">Amount</th><th class="text-right">Balance</th></tr></thead>
                    <tbody>
                    @forelse($ledgerEntries as $le)
                        <tr>
                            <td>{{ $le->created_at->format('d M Y') }}</td>
                            <td class="text-capitalize">{{ str_replace('_',' ',$le->type) }}</td>
                            <td class="text-right">{{ \App\Support\Currency::display($le->amount, $company->currency) }}</td>
                            <td class="text-right">{{ \App\Support\Currency::display($le->balance_after, $company->currency) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted p-3">No ledger entries yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
