@extends('admin.layouts.admin')
@section('title', 'Generate SKUs')

@section('content')
<div class="card col-lg-7 p-0">
    <div class="card-header"><h3 class="card-title">Generate SKUs for an Approved Style</h3></div>
    <form method="POST" action="{{ url('/admin/skus') }}">
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

            <div class="form-group">
                <label>Approved Sample / Style</label>
                <select name="sample_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    @foreach($samples as $s)
                        <option value="{{ $s->id }}" {{ optional($selectedSample)->id == $s->id ? 'selected' : '' }}>{{ $s->sample_code }} — {{ $s->style_name }}</option>
                    @endforeach
                </select>
                @if($samples->isEmpty())
                    <small class="text-muted">No approved samples yet — a sample must be client-approved before SKUs can be generated.</small>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Fabric</label>
                    <input type="text" name="fabric" class="form-control" placeholder="Moss Crepe Spandex">
                </div>
                <div class="form-group col-4">
                    <label>Print</label>
                    <input type="text" name="print" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label>Colour</label>
                    <input type="text" name="colour" class="form-control" placeholder="Black">
                </div>
            </div>
            <div class="form-group">
                <label>SKU Prefix (optional — auto-generated from style/fabric/colour if left blank)</label>
                <input type="text" name="sku_prefix" class="form-control" placeholder="LBD-LUCREZIA-MCS-BLK">
            </div>
            <div class="form-group">
                <label>Sizes to generate</label>
                <div>
                    @foreach($sizes as $size)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="sizes[]" value="{{ $size }}" id="size{{ $size }}">
                        <label class="form-check-label" for="size{{ $size }}">{{ $size }}</label>
                    </div>
                    @endforeach
                </div>
                <small class="text-muted">One SKU code will be generated per selected size.</small>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Generate SKUs</button>
            <a href="{{ url('/admin/skus') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
