@extends('admin.layouts.admin')
@section('title', 'Sample Request — '.$sampleRequest->style_name)

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Request Details</h3></div>
            <div class="card-body">
                @if($sampleRequest->images->count())
                <img src="{{ $sampleRequest->images->first()->url() }}" class="img-fluid rounded mb-2" style="max-height:240px;object-fit:cover;">
                @if($sampleRequest->images->count() > 1)
                <div class="mb-3">
                    @foreach($sampleRequest->images as $img)
                        <a href="{{ $img->url() }}" target="_blank">
                            <img src="{{ $img->url() }}" width="56" height="56" style="object-fit:cover;border-radius:6px;" class="mr-1 mb-1 border">
                        </a>
                    @endforeach
                </div>
                @endif
                @elseif($sampleRequest->reference_image_path)
                <img src="{{ $sampleRequest->referenceImageUrl() }}" class="img-fluid rounded mb-3" style="max-height:240px;object-fit:cover;">
                @endif
                <dl class="row mb-0">
                    <dt class="col-4">Client</dt><dd class="col-8">{{ $sampleRequest->company->name }}</dd>
                    <dt class="col-4">Requested By</dt><dd class="col-8">{{ $sampleRequest->requestedBy->name ?? '—' }}</dd>
                    <dt class="col-4">Style Name</dt><dd class="col-8">{{ $sampleRequest->style_name }}</dd>
                    <dt class="col-4">Fabric Pref.</dt><dd class="col-8">{{ $sampleRequest->fabric_preference ?? '—' }}</dd>
                    <dt class="col-4">Colour Pref.</dt><dd class="col-8">{{ $sampleRequest->colour_preference ?? '—' }}</dd>
                    <dt class="col-4">Print Pref.</dt><dd class="col-8">{{ $sampleRequest->print_preference ?? '—' }}</dd>
                    <dt class="col-4">Description</dt><dd class="col-8">{{ $sampleRequest->description ?? '—' }}</dd>
                    <dt class="col-4">Status</dt>
                    <dd class="col-8">
                        @if($sampleRequest->status == 'pending') <span class="badge badge-pending">Pending</span>
                        @elseif($sampleRequest->status == 'in_review') <span class="badge badge-info">In Review</span>
                        @elseif($sampleRequest->status == 'converted') <span class="badge badge-approved">Converted</span>
                        @else <span class="badge badge-changes">Rejected</span> @endif
                    </dd>
                </dl>
            </div>
        </div>

        @if($sampleRequest->status != 'converted')
        <div class="card">
            <div class="card-header"><h3 class="card-title">Update Status</h3></div>
            <form method="POST" action="{{ url('/admin/sample-requests/'.$sampleRequest->id.'/status') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $sampleRequest->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="in_review" {{ $sampleRequest->status=='in_review'?'selected':'' }}>In Review</option>
                            <option value="rejected" {{ $sampleRequest->status=='rejected'?'selected':'' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Admin Notes</label>
                        <textarea name="admin_notes" class="form-control" rows="2">{{ $sampleRequest->admin_notes }}</textarea>
                    </div>
                </div>
                <div class="card-footer"><button class="btn btn-outline-secondary">Save</button></div>
            </form>
        </div>
        @endif
    </div>

    <div class="col-lg-6">
        @if($sampleRequest->status == 'converted')
        <div class="card">
            <div class="card-header"><h3 class="card-title">Converted</h3></div>
            <div class="card-body">
                <p class="text-muted">This request has already been converted into a sample.</p>
                <a href="{{ url('/admin/samples/'.$sampleRequest->converted_sample_id) }}" class="btn btn-primary">View Sample</a>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header"><h3 class="card-title">Accept & Convert to Sample</h3></div>
            <form method="POST" action="{{ url('/admin/sample-requests/'.$sampleRequest->id.'/convert') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
                    <div class="form-group">
                        <label>Sample Code (unique)</label>
                        <input type="text" name="sample_code" class="form-control" placeholder="SMP-0250" required>
                    </div>
                    <div class="form-group">
                        <label>Fabric (leave blank to use client's preference)</label>
                        <input type="text" name="fabric" class="form-control" value="{{ $sampleRequest->fabric_preference }}">
                    </div>
                    <div class="form-group">
                        <label>Colour (leave blank to use client's preference)</label>
                        <input type="text" name="color" class="form-control" value="{{ $sampleRequest->colour_preference }}">
                    </div>
                    <div class="form-group">
                        <label>Development Images (optional — multiple allowed; uses client's reference images if left blank)</label>
                        <input type="file" name="images[]" class="form-control-file" accept="image/*" multiple>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Convert to Sample</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

@if($sampleRequest->sizeChartRows->count())
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Size Chart (submitted by client)</h3></div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Specifications</th>
                            <th>XS</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th><th>5XL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sampleRequest->sizeChartRows as $row)
                        <tr>
                            <td>{{ $row->specification }}</td>
                            <td>{{ $row->xs }}</td><td>{{ $row->s }}</td><td>{{ $row->m }}</td><td>{{ $row->l }}</td>
                            <td>{{ $row->xl }}</td><td>{{ $row->xxl }}</td><td>{{ $row->xxxl }}</td><td>{{ $row->xxxxl }}</td><td>{{ $row->xxxxxl }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted small">This will be carried over automatically when you convert this request into a Sample.</div>
        </div>
    </div>
</div>
@endif
@endsection
