@extends('admin.layouts.admin')
@section('title', $brandingAsset->exists ? 'Edit Branding & Labels' : 'New Branding & Labels')

@section('content')
<div class="card col-lg-7 p-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">{{ $brandingAsset->exists ? 'Edit' : 'New' }} Branding & Labels</h3>
        @if($brandingAsset->exists)
        <a href="{{ url('/admin/branding-assets/'.$brandingAsset->id) }}" class="btn btn-sm btn-outline-primary">View</a>
        @endif
    </div>
    <form method="POST" action="{{ $brandingAsset->exists ? url('/admin/branding-assets/'.$brandingAsset->id) : url('/admin/branding-assets') }}" enctype="multipart/form-data">
        @csrf
        @if($brandingAsset->exists) @method('PUT') @endif
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            @if($brandingAsset->exists && $brandingAsset->latestVersion)
            <div class="text-center mb-3">
                <img src="{{ $brandingAsset->latestVersion->coverUrl() }}" class="img-fluid rounded" style="max-height:220px;object-fit:cover;">
                <div class="text-muted small mt-1">Cover image (version {{ $brandingAsset->latestVersion->version_no }})</div>
                @if($brandingAsset->latestVersion->images->count() > 1)
                <div class="mt-2">
                    @foreach($brandingAsset->latestVersion->images as $img)
                        <img src="{{ $img->url() }}" style="width:50px;height:50px;object-fit:cover;border-radius:6px;" class="mr-1 border">
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <div class="form-group">
                <label>Client Company</label>
                <select name="company_id" id="companySelect" class="form-control">
                    @if($brandingAsset->exists && $brandingAsset->company)
                        <option value="{{ $brandingAsset->company->id }}" selected>{{ $brandingAsset->company->name }}</option>
                    @endif
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-12 col-sm-6">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Select category</option>
                        @foreach(\App\Models\BrandingAsset::CATEGORIES as $key => $label)
                            <option value="{{ $key }}" {{ old('category', $brandingAsset->category) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Applicable Style / Product</label>
                    <input type="text" name="applicable_to" class="form-control" value="{{ old('applicable_to', $brandingAsset->applicable_to) }}" placeholder="6AM Worksuit / All Styles">
                </div>
            </div>

            <div class="form-group">
                <label>Asset Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $brandingAsset->name) }}" placeholder="Main Neck Label – Woven" required>
            </div>

            <div class="form-group">
                <label>{{ $brandingAsset->exists ? 'Upload New Version — Multiple Images (optional — resets to Pending)' : 'Asset Images (multiple allowed)' }}</label>
                <input type="file" name="images[]" id="assetImagesInput" class="form-control-file" accept="image/*" multiple {{ $brandingAsset->exists ? '' : 'required' }}>
                <small class="text-muted">First image becomes the cover thumbnail.</small>
                <div id="assetImagePreview" class="d-flex flex-wrap mt-2"></div>
            </div>

            <div class="form-group">
                <label>Version Notes</label>
                <textarea name="notes" class="form-control" rows="2" placeholder="What changed in this version...">{{ old('notes') }}</textarea>
            </div>

            @if($brandingAsset->exists && $brandingAsset->versions->count())
            <div class="mt-3">
                <label class="d-block">Existing Versions</label>
                @foreach($brandingAsset->versions as $v)
                    <span class="badge badge-light border mr-1">v{{ $v->version_no }}</span>
                @endforeach
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ url('/admin/branding-assets') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>

@if($brandingAsset->exists && $brandingAsset->comments->count())
<div class="card col-lg-7 p-0 mt-3">
    <div class="card-header"><h3 class="card-title">Client Comments & Revision Requests</h3></div>
    <div class="card-body">
        @foreach($brandingAsset->comments as $comment)
        <div class="d-flex mb-3 {{ $comment->action == 'revise' ? 'p-2' : '' }}" style="{{ $comment->action == 'revise' ? 'background:#fff5f2;border-radius:8px;' : '' }}">
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;flex-shrink:0;">
                {{ substr($comment->user->name ?? 'U', 0, 1) }}
            </div>
            <div>
                <div class="font-weight-bold small">
                    {{ $comment->user->name ?? 'User' }}
                    @if($comment->action == 'approve') <span class="badge badge-approved ml-1">Approved</span>
                    @elseif($comment->action == 'revise') <span class="badge badge-changes ml-1">Requested Revision</span>
                    @endif
                </div>
                <div class="text-muted small">{{ $comment->comment }}</div>
                <div class="text-muted" style="font-size:.75rem;">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        ibaAjaxSelect2('#companySelect', 'companies', { placeholder: 'Search client company...' });
    });
    var assetImagesInput = document.getElementById('assetImagesInput');
    if (assetImagesInput) {
        assetImagesInput.addEventListener('change', function (e) {
            var preview = document.getElementById('assetImagePreview');
            preview.innerHTML = '';
            Array.from(e.target.files).forEach(function (file) {
                var reader = new FileReader();
                reader.onload = function (ev) {
                    var img = document.createElement('img');
                    img.src = ev.target.result;
                    img.width = 64; img.height = 64;
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '6px';
                    img.className = 'mr-2 mb-2 border';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    }
</script>
@endsection
