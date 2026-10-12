@extends('admin.layouts.admin')
@section('title', 'Branding & Labels Request — '.$brandingAssetRequest->name)

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Request Details</h3></div>
            <div class="card-body">
                @if($brandingAssetRequest->images->count())
                <img src="{{ $brandingAssetRequest->images->first()->url() }}" class="img-fluid rounded mb-2 lightbox-img" style="max-height:240px;object-fit:cover;">
                @if($brandingAssetRequest->images->count() > 1)
                <div class="mb-3">
                    @foreach($brandingAssetRequest->images as $img)
                        <img src="{{ $img->url() }}" width="56" height="56" style="object-fit:cover;border-radius:6px;" class="mr-1 mb-1 border lightbox-img">
                    @endforeach
                </div>
                @endif
                @endif
                <dl class="row mb-0">
                    <dt class="col-4">Client</dt><dd class="col-8">{{ $brandingAssetRequest->company->name }}</dd>
                    <dt class="col-4">Requested By</dt><dd class="col-8">{{ $brandingAssetRequest->requestedBy->name ?? '—' }}</dd>
                    <dt class="col-4">Category</dt><dd class="col-8">{{ $brandingAssetRequest->categoryLabel() }}</dd>
                    <dt class="col-4">Name</dt><dd class="col-8">{{ $brandingAssetRequest->name }}</dd>
                    <dt class="col-4">Applicable To</dt><dd class="col-8">{{ $brandingAssetRequest->applicable_to ?? '—' }}</dd>
                    <dt class="col-4">Description</dt><dd class="col-8">{{ $brandingAssetRequest->description ?? '—' }}</dd>
                    <dt class="col-4">Status</dt>
                    <dd class="col-8">
                        @if($brandingAssetRequest->status == 'pending') <span class="badge badge-pending">Pending</span>
                        @elseif($brandingAssetRequest->status == 'in_review') <span class="badge badge-info">In Review</span>
                        @elseif($brandingAssetRequest->status == 'converted') <span class="badge badge-approved">Converted</span>
                        @else <span class="badge badge-changes">Rejected</span> @endif
                    </dd>
                </dl>
            </div>
        </div>

        @if($brandingAssetRequest->status != 'converted')
        <div class="card">
            <div class="card-header"><h3 class="card-title">Update Status</h3></div>
            <form method="POST" action="{{ url('/admin/branding-asset-requests/'.$brandingAssetRequest->id.'/status') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $brandingAssetRequest->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="in_review" {{ $brandingAssetRequest->status=='in_review'?'selected':'' }}>In Review</option>
                            <option value="rejected" {{ $brandingAssetRequest->status=='rejected'?'selected':'' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Admin Notes</label>
                        <textarea name="admin_notes" class="form-control" rows="2">{{ $brandingAssetRequest->admin_notes }}</textarea>
                    </div>
                </div>
                <div class="card-footer"><button class="btn btn-outline-secondary">Save</button></div>
            </form>
        </div>
        @endif
    </div>

    <div class="col-lg-6">
        @if($brandingAssetRequest->status == 'converted')
        <div class="card">
            <div class="card-header"><h3 class="card-title">Converted</h3></div>
            <div class="card-body">
                <p class="text-muted">This request has already been converted into a branding asset.</p>
                <a href="{{ url('/admin/branding-assets/'.$brandingAssetRequest->converted_asset_id) }}" class="btn btn-primary">View Asset</a>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header"><h3 class="card-title">Accept & Convert to Branding & Labels</h3></div>
            <form method="POST" action="{{ url('/admin/branding-asset-requests/'.$brandingAssetRequest->id.'/convert') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
                    <div class="form-group">
                        <label>Development Images (optional — multiple allowed; uses client's reference images if left blank)</label>
                        <input type="file" name="images[]" class="form-control-file" accept="image/*" multiple>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Convert to Branding & Labels</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
