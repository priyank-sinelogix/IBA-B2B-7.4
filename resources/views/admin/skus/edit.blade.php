@extends('admin.layouts.admin')
@section('title', 'Edit SKU')

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header"><h3 class="card-title">Edit SKU — {{ $sku->style_name }}</h3></div>
    <form method="POST" action="{{ url('/admin/skus/'.$sku->id) }}">
        @csrf @method('PUT')
        <div class="card-body">
            @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

            <div class="form-group">
                <label>SKU Code</label>
                <input type="text" name="sku_code" class="form-control" value="{{ old('sku_code', $sku->sku_code) }}" required>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Fabric</label>
                    <input type="text" name="fabric" class="form-control" value="{{ old('fabric', $sku->fabric) }}">
                </div>
                <div class="form-group col-4">
                    <label>Print</label>
                    <input type="text" name="print" class="form-control" value="{{ old('print', $sku->print) }}">
                </div>
                <div class="form-group col-4">
                    <label>Colour</label>
                    <input type="text" name="colour" class="form-control" value="{{ old('colour', $sku->colour) }}">
                </div>
            </div>
            <div class="form-group">
                <label>Size</label>
                <input type="text" name="size" class="form-control" value="{{ old('size', $sku->size) }}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('/admin/skus?sample_id='.$sku->sample_id) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
