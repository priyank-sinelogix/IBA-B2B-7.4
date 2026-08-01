@extends('admin.layouts.admin')
@section('title', isset($pricing) ? 'Edit Pricing' : 'Add Pricing Entry')

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header"><h3 class="card-title">{{ isset($pricing) ? 'Edit' : 'New' }} Pricing Entry</h3></div>
    <form method="POST" action="{{ isset($pricing) ? url('/admin/pricing/'.$pricing->id) : url('/admin/pricing') }}" id="pricingForm">
        @csrf
        @if(isset($pricing)) @method('PUT') @endif
        <div class="card-body">
            @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

            <div class="form-group">
                <label>Sample / Style</label>
                <select name="sample_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    @foreach($samples as $s)
                        <option value="{{ $s->id }}" {{ old('sample_id', isset($pricing) ? $pricing->sample_id : optional($selectedSample ?? null)->id) == $s->id ? 'selected' : '' }}>
                            {{ $s->sample_code }} — {{ $s->style_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Style (SKU / display code)</label>
                <input type="text" name="style" class="form-control" value="{{ old('style', $pricing->style ?? '') }}" placeholder="LBD-LUCREZIA-MCS-BLK-1802" required>
            </div>
            <div class="form-group">
                <label>Fabric</label>
                <input type="text" name="fabric" class="form-control" value="{{ old('fabric', $pricing->fabric ?? '') }}" placeholder="Moss Crepe Spandex">
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label>Fabric Cost (₹)</label>
                    <input type="number" step="0.01" class="form-control cost-input" name="fabric_cost" value="{{ old('fabric_cost', $pricing->fabric_cost ?? 0) }}" required>
                </div>
                <div class="form-group col-6">
                    <label>Accessories (₹)</label>
                    <input type="number" step="0.01" class="form-control cost-input" name="accessories_cost" value="{{ old('accessories_cost', $pricing->accessories_cost ?? 0) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label>Operational Cost (₹)</label>
                    <input type="number" step="0.01" class="form-control cost-input" name="operational_cost" value="{{ old('operational_cost', $pricing->operational_cost ?? 0) }}" required>
                </div>
                <div class="form-group col-6">
                    <label>Stitching Cost (₹)</label>
                    <input type="number" step="0.01" class="form-control cost-input" name="stitching_cost" value="{{ old('stitching_cost', $pricing->stitching_cost ?? 0) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>COGP — auto: Fabric + Accessories + Operational + Stitching (₹)</label>
                <input type="text" id="cogpDisplay" class="form-control" readonly style="background:#f2f4f7; font-weight:700;">
            </div>

            <div class="form-group">
                <label>Margin (₹)</label>
                <input type="number" step="0.01" id="marginInput" class="form-control" name="margin" value="{{ old('margin', $pricing->margin ?? 0) }}" required>
            </div>

            <div class="form-group">
                <label>Price — auto: COGP + Margin (₹)</label>
                <input type="text" id="priceDisplay" class="form-control" readonly style="background:#eaf9f2; font-weight:800; color:#0a7a52;">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('/admin/pricing') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Visual convenience only — the server recalculates COGP/Price from the actual submitted values.
    (function () {
        var costInputs = document.querySelectorAll('.cost-input');
        var marginInput = document.getElementById('marginInput');
        var cogpDisplay = document.getElementById('cogpDisplay');
        var priceDisplay = document.getElementById('priceDisplay');

        function recalc() {
            var cogp = 0;
            costInputs.forEach(function (input) {
                cogp += parseFloat(input.value) || 0;
            });
            var margin = parseFloat(marginInput.value) || 0;
            cogpDisplay.value = cogp.toFixed(2);
            priceDisplay.value = (cogp + margin).toFixed(2);
        }

        costInputs.forEach(function (input) { input.addEventListener('input', recalc); });
        marginInput.addEventListener('input', recalc);
        recalc();
    })();
</script>
@endsection
