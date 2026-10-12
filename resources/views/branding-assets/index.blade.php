@extends('layouts.admin')
@section('title', 'Branding & Labels')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Branding & Labels</h4>
        <div class="text-muted small">Manage and review all approved branding, label and packaging assets used for your products.</div>
    </div>
    <div class="d-flex">
        <form method="GET" class="mr-2">
            @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search branding assets..." value="{{ request('search') }}">
                <div class="input-group-append"><button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button></div>
            </div>
        </form>
        <button type="button" class="btn btn-iba" data-toggle="modal" data-target="#requestAssetModal"><i class="fas fa-plus mr-1"></i> Request New Asset</button>
    </div>
</div>

<!-- Summary cards -->
<div class="row">
    @foreach($summary as $cat)
    <div class="col-lg col-6 mb-3">
        <a href="?category={{ $cat['key'] }}" class="text-decoration-none">
            <div class="small-box bg-white p-3 h-100">
                <div class="text-muted small">{{ $cat['label'] }}s</div>
                <div class="h3 mb-1">{{ $cat['total'] }}</div>
                <div class="small">
                    <span class="text-success"><i class="fas fa-circle" style="font-size:.5rem;"></i> {{ $cat['approved'] }} Approved</span>
                    &nbsp;•&nbsp;
                    <span class="text-warning"><i class="fas fa-circle" style="font-size:.5rem;"></i> {{ $cat['pending'] }} Pending</span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Filter tabs -->
<div class="mb-3">
    <a href="?" class="btn btn-sm {{ !request('status') && !request('category') ? 'btn-iba' : 'btn-outline-secondary' }} mb-1">All</a>
    <a href="?status=pending" class="btn btn-sm {{ request('status')=='pending' ? 'btn-iba' : 'btn-outline-secondary' }} mb-1">Pending Approval</a>
    <a href="?status=approved" class="btn btn-sm {{ request('status')=='approved' ? 'btn-iba' : 'btn-outline-secondary' }} mb-1">Approved</a>
    <a href="?status=revision_requested" class="btn btn-sm {{ request('status')=='revision_requested' ? 'btn-iba' : 'btn-outline-secondary' }} mb-1">Revision Requested</a>
    @foreach(\App\Models\BrandingAsset::CATEGORIES as $key => $label)
        <a href="?category={{ $key }}" class="btn btn-sm {{ request('category')==$key ? 'btn-iba' : 'btn-outline-secondary' }} mb-1">{{ $label }}s</a>
    @endforeach
</div>

<div class="row">
    <!-- Pending Approval -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Pending Approval</h3></div>
            <div class="card-body p-0">
                @forelse($pending as $asset)
                <div class="d-flex align-items-center p-3 border-bottom">
                    <img src="{{ optional($asset->latestVersion)->coverUrl() ?? 'https://via.placeholder.com/56' }}" width="56" height="56" style="object-fit:cover;border-radius:8px;" class="mr-3">
                    <div class="flex-grow-1">
                        <div class="font-weight-bold">{{ $asset->name }}</div>
                        <div class="text-muted small">Category: {{ $asset->categoryLabel() }}</div>
                        <div class="text-muted small">For: {{ $asset->applicable_to ?? '—' }}</div>
                        <div class="text-muted small">Version: v{{ optional($asset->latestVersion)->version_no ?? 1 }}</div>
                    </div>
                    <span class="badge badge-{{ $asset->status == 'pending' ? 'pending' : 'changes' }} mr-3">
                        {{ $asset->status == 'pending' ? 'Pending Approval' : 'Revision Requested' }}
                    </span>
                    <form method="POST" action="{{ url('/branding-assets/'.$asset->id.'/approve') }}" class="mr-2">
                        @csrf
                        <button class="btn btn-sm btn-outline-success">Approve</button>
                    </form>
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-revise" data-action="{{ url('/branding-assets/'.$asset->id.'/revise') }}">Revise</button>
                </div>
                @empty
                <div class="p-4 text-center text-muted">Nothing pending approval right now.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Approved for Production -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Approved for Production</h3></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th></th><th>Asset ID</th><th>Type</th><th>Version</th><th>Status</th><th>Updated</th></tr></thead>
                    <tbody>
                    @forelse($approved as $asset)
                        <tr>
                            <td><img src="{{ optional($asset->latestVersion)->coverUrl() ?? 'https://via.placeholder.com/40' }}" width="36" height="36" style="object-fit:cover;border-radius:6px;"></td>
                            <td><a href="{{ url('/branding-assets/'.$asset->id) }}">{{ $asset->name }}</a></td>
                            <td>{{ $asset->categoryLabel() }}</td>
                            <td>v{{ optional($asset->latestVersion)->version_no ?? 1 }}</td>
                            <td><span class="badge badge-approved">Approved</span></td>
                            <td>{{ $asset->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted p-4">Nothing approved yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($myRequests->count())
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><h3 class="card-title">My Requests</h3></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Name</th><th>Category</th><th>Applicable To</th><th>Status</th><th>Submitted</th><th></th></tr></thead>
                    <tbody>
                    @foreach($myRequests as $r)
                        <tr>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->categoryLabel() }}</td>
                            <td>{{ $r->applicable_to ?? '—' }}</td>
                            <td>
                                @if($r->status == 'pending') <span class="badge badge-pending">Pending Review</span>
                                @elseif($r->status == 'in_review') <span class="badge badge-info">In Review</span>
                                @elseif($r->status == 'converted') <span class="badge badge-approved">Converted</span>
                                @else <span class="badge badge-changes">Rejected</span> @endif
                            </td>
                            <td>{{ $r->created_at->format('d M Y') }}</td>
                            <td>
                                @if($r->status == 'converted' && $r->converted_asset_id)
                                    <a href="{{ url('/branding-assets/'.$r->converted_asset_id) }}" class="small">View Asset</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Request New Asset modal -->
<div class="modal fade" id="requestAssetModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('/branding-assets/request') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Request New Branding & Labels</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control" required>
                            <option value="">Select category</option>
                            @foreach(\App\Models\BrandingAsset::CATEGORIES as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Main Neck Label – Woven" required>
                    </div>
                    <div class="form-group">
                        <label>Applicable Style / Product</label>
                        <input type="text" name="applicable_to" class="form-control" placeholder="6AM Worksuit / All Styles">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Reference Images (optional)</label>
                        <input type="file" name="reference_images[]" class="form-control-file" accept="image/*" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Revise comment modal -->
<div class="modal fade" id="reviseAssetModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="reviseAssetForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Request a Revision</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>What needs to change?</label>
                        <textarea name="comment" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Send Revision Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.btn-revise', function () {
            document.getElementById('reviseAssetForm').action = $(this).data('action');
            $('#reviseAssetModal').modal('show');
        });
    });
</script>
@endsection
