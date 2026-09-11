@extends('admin.layouts.admin')
@section('title', $shipment->exists ? 'Edit Shipment' : 'New Shipment')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card p-0">
            <div class="card-header"><h3 class="card-title">{{ $shipment->exists ? 'Edit' : 'New' }} Shipment</h3></div>
            <form method="POST" action="{{ $shipment->exists ? url('/admin/shipments/'.$shipment->id) : url('/admin/shipments') }}">
                @csrf
                @if($shipment->exists) @method('PUT') @endif
                <div class="card-body">
                    @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

                    <div class="form-group">
                        <label>Client Company</label>
                        <select name="company_id" id="companySelect" class="form-control">
                            @if($shipment->exists && $shipment->company)
                                <option value="{{ $shipment->company->id }}" selected>{{ $shipment->company->name }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Order (VMS)</label>
                        <select name="vms_orderid" id="vmsOrderSelect" class="form-control">
                            @if($shipment->exists && $shipment->vms_orderid)
                                <option value="{{ $shipment->vms_orderid }}" selected>{{ $shipment->vms_orderid }}</option>
                            @endif
                        </select>
                        <small class="text-muted">Company select karne ke baad uske VMS orders yahan search ho sakenge.</small>
                    </div>
                    <div class="form-group">
                        <label>SKUs in this shipment</label>
                        <div id="skuChecklist" class="border rounded p-2" style="max-height:220px; overflow-y:auto;">
                            @forelse($orderSkuRows as $row)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="sku_ids[]" value="{{ $row->sku_id }}" id="sku{{ $row->sku_id }}"
                                        {{ $shipment->exists && $shipment->skus->contains('id', $row->sku_id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sku{{ $row->sku_id }}">
                                        {{ $row->sku_code }}@if($row->size) — {{ $row->size }}@endif
                                        <span class="text-muted small">(Qty: {{ $row->qty }}, {{ \App\Support\VmsOrderMatcher::statusLabel($row->status) }})</span>
                                    </label>
                                </div>
                            @empty
                                <div class="text-muted small">Pehle Company aur Order select karo.</div>
                            @endforelse
                        </div>
                        <small class="text-muted">Order ke saare SKUs me se sirf wahi tick karo jo is shipment mein ja rahe hain (order ke SKUs alag shipments mein split ho sakte hain).</small>
                    </div>
                    <div class="form-group">
                        <label>AWB / Tracking No.</label>
                        <input type="text" name="awb_number" class="form-control" value="{{ old('awb_number', $shipment->awb_number) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Carrier</label>
                        <input type="text" name="carrier" class="form-control" value="{{ old('carrier', $shipment->carrier) }}" placeholder="MAERSK / MSC / CMA CGM" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Origin</label>
                            <input type="text" name="origin" class="form-control" value="{{ old('origin', $shipment->origin) }}">
                        </div>
                        <div class="form-group col-6">
                            <label>Destination</label>
                            <input type="text" name="destination" class="form-control" value="{{ old('destination', $shipment->destination) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Shipping Price <span class="text-muted">(optional)</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" id="shippingPriceSymbol">₹</span></div>
                            <input type="number" step="0.01" min="0" name="shipping_price" class="form-control" value="{{ old('shipping_price', $shipment->shipping_price) }}">
                        </div>
                        <small class="text-muted">In the selected client's own currency.</small>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            @foreach(['booked','in_transit','arrived_at_port','delivered'] as $s)
                                <option value="{{ $s }}" {{ old('status', $shipment->status ?? 'booked') == $s ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($shipment->exists)
                    <hr>
                    <p class="text-muted small mb-1">If you change the status above, these fields log the tracking event:</p>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Event Location</label>
                            <input type="text" name="event_location" class="form-control" placeholder="e.g. Los Angeles Port">
                        </div>
                        <div class="form-group col-6">
                            <label>Remarks</label>
                            <input type="text" name="event_remarks" class="form-control" placeholder="e.g. Cleared customs">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Save</button>
                    <a href="{{ url('/admin/shipments') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @if($shipment->exists)
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Tracking Timeline</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($shipment->trackingEvents as $event)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span class="text-capitalize font-weight-bold">{{ str_replace('_',' ',$event->status) }}</span>
                                <span class="text-muted small">{{ $event->event_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div class="text-muted small">{{ $event->location }} — {{ $event->remarks }}</div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">No tracking events yet.</li>
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

        function currentCompanyId() {
            return $('#companySelect').val() || '';
        }

        function renderSkuChecklist(rows, checkedIds) {
            checkedIds = checkedIds || [];
            var container = $('#skuChecklist');
            if (!rows.length) {
                container.html('<div class="text-muted small">Is order me is company ke liye koi SKU nahi mila.</div>');
                return;
            }
            var html = '';
            rows.forEach(function (row) {
                var checked = checkedIds.indexOf(row.sku_id) !== -1 ? 'checked' : '';
                var sizeText = row.size ? ' — ' + row.size : '';
                html += '<div class="form-check">'
                    + '<input class="form-check-input" type="checkbox" name="sku_ids[]" value="' + row.sku_id + '" id="sku' + row.sku_id + '" ' + checked + '>'
                    + '<label class="form-check-label" for="sku' + row.sku_id + '">' + row.sku_code + sizeText
                    + ' <span class="text-muted small">(Qty: ' + row.qty + ', ' + (row.status_label || '') + ')</span></label>'
                    + '</div>';
            });
            container.html(html);
        }

        $('#vmsOrderSelect').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Search VMS order...',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: '{{ url('/admin/ajax/vms-orders') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { company_id: currentCompanyId(), q: params.term || '' };
                },
                processResults: function (data) {
                    return { results: data.results };
                },
                cache: true
            }
        });

        $('#companySelect').on('select2:select', function (e) {
            var symbol = (e.params.data && e.params.data.currency_symbol) ? e.params.data.currency_symbol : '₹';
            document.getElementById('shippingPriceSymbol').textContent = symbol;

            // Company changed — the previously selected order/SKUs no longer apply.
            $('#vmsOrderSelect').val(null).trigger('change');
            renderSkuChecklist([], []);
        });

        $('#vmsOrderSelect').on('select2:select select2:clear', function () {
            var orderid = $('#vmsOrderSelect').val();
            if (!orderid) {
                renderSkuChecklist([], []);
                return;
            }
            $.getJSON('{{ url('/admin/ajax/vms-order-skus') }}', { company_id: currentCompanyId(), orderid: orderid })
                .done(function (data) { renderSkuChecklist(data.skus || [], []); })
                .fail(function () { renderSkuChecklist([], []); });
        });

        @if($shipment->exists && $shipment->company)
            document.getElementById('shippingPriceSymbol').textContent = '{{ optional($shipment->company->currency)->symbol ?? '₹' }}';
        @endif
    });
</script>
@endsection
