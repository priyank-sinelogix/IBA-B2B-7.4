@extends('layouts.admin')
@section('title', 'New Sample Request')

@section('content')
<div class="card col-lg-7 p-0">
    <div class="card-header"><h3 class="card-title">Request a New Sample Development</h3></div>
    <form method="POST" action="{{ url('/sample-requests') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

            <div class="form-group">
                <label>Style Name</label>
                <input type="text" name="style_name" class="form-control" value="{{ old('style_name') }}" required>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label>Fabric Preference</label>
                    <input type="text" name="fabric_preference" class="form-control" value="{{ old('fabric_preference') }}" placeholder="e.g. Moss Crepe Spandex">
                </div>
                <div class="form-group col-4">
                    <label>Colour Preference</label>
                    <input type="text" name="colour_preference" class="form-control" value="{{ old('colour_preference') }}">
                </div>
                <div class="form-group col-4">
                    <label>Print Preference</label>
                    <input type="text" name="print_preference" class="form-control" value="{{ old('print_preference') }}">
                </div>
            </div>
            <div class="form-group">
                <label>Description / Notes</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Describe the style, fit, references, inspiration...">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Reference Images (optional — you can select multiple)</label>
                <input type="file" name="reference_images[]" class="form-control-file" accept="image/*" multiple>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-iba">Submit Request</button>
            <a href="{{ url('/sample-requests') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
