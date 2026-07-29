@extends('admin.layouts.admin')
@section('title', isset($pricing) ? 'Edit Pricing' : 'Add Pricing Entry')

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header"><h3 class="card-title">{{ isset($pricing) ? 'Edit' : 'New' }} Pricing Entry</h3></div>
    <form method="POST" action="{{ isset($pricing) ? url('/admin/pricing/'.$pricing->id) : url('/admin/pricing') }}">
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
                    <label>Fabric Cost + Accessories (₹)</label>
                    <input type="number" step="0.01" id="fabricCost" name="fabric_cost" class="form-control" value="{{ old('fabric_cost', $pricing->fabric_cost ?? 0) }}" required>
                </div>
                <div class="form-group col-6">
                    <label>Stitching Cost (₹)</label>
                    <input type="number" step="0.01" id="stitchingCost" name="stitching_cost" class="form-control" value="{{ old('stitching_cost', $pricing->stitching_cost ?? 0) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>COGP (auto: Fabric Cost + Stitching Cost)</label>
                <input type="text" id="cogpDisplay" class="form-control" readonly value="{{ number_format(old('fabric_cost', $pricing->fabric_cost ?? 0) + old('stitching_cost', $pricing->stitching_cost ?? 0), 2) }}">
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label>Margin (₹)</label>
                    <input type="number" step="0.01" name="margin" class="form-control" value="{{ old('margin', $pricing->margin ?? 0) }}" required>
                </div>
                <div class="form-group col-6">
                    <label>Price (₹)</label>
                    <input type="number" step="0.01" name="price_usd" class="form-control" value="{{ old('price_usd', $pricing->price_usd ?? 0) }}" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('/admin/pricing') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Just a visual convenience — the server recalculates COGP from the actual submitted values.
    (function () {
        var fabricCost = document.getElementById('fabricCost');
        var stitchingCost = document.getElementById('stitchingCost');
        var cogpDisplay = document.getElementById('cogpDisplay');

        function recalc() {
            var f = parseFloat(fabricCost.value) || 0;
            var s = parseFloat(stitchingCost.value) || 0;
            cogpDisplay.value = (f + s).toFixed(2);
        }

        fabricCost.addEventListener('input', recalc);
        stitchingCost.addEventListener('input', recalc);
    })();
</script>
@endsection
