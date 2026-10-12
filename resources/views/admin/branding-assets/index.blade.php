@extends('admin.layouts.admin')
@section('title', 'Branding & Labels')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Branding & Labels</h3>
        <a href="{{ url('/admin/branding-assets/create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i> New Asset</a>
    </div>
    <div class="card-body p-0">
        <form class="d-flex flex-wrap p-3 border-bottom" method="GET" style="row-gap:.5rem;">
            <select name="company_id" id="companyFilterSelect" class="form-control mr-2" style="max-width:220px;">
                <option value=""></option>
                @if($selectedCompany ?? null)
                    <option value="{{ $selectedCompany->id }}" selected>{{ $selectedCompany->name }}</option>
                @endif
            </select>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    ibaAjaxSelect2('#companyFilterSelect', 'companies', { placeholder: 'All Clients', allowClear: true });
                    $('#companyFilterSelect').on('select2:select select2:clear', function () { $(this).closest('form').submit(); });
                });
            </script>
            <select name="category" class="form-control mr-2" style="max-width:200px;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach(\App\Models\BrandingAsset::CATEGORIES as $key => $label)
                    <option value="{{ $key }}" {{ request('category')==$key?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
            <select name="status" class="form-control mr-2" style="max-width:200px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending Approval</option>
                <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                <option value="revision_requested" {{ request('status')=='revision_requested'?'selected':'' }}>Revision Requested</option>
            </select>
            @include('admin.partials.list-toolbar', ['searchPlaceholder' => 'Search name, applicable style...'])
        </form>

        <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th></th><th>Name</th><th>Category</th><th>Client</th><th>Applicable To</th><th>Version</th><th>Status</th><th>Submitted</th><th></th></tr></thead>
            <tbody>
            @forelse($assets as $asset)
                <tr>
                    <td><img src="{{ optional($asset->latestVersion)->coverUrl() ?? 'https://via.placeholder.com/44' }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;"></td>
                    <td><a href="{{ url('/admin/branding-assets/'.$asset->id) }}">{{ $asset->name }}</a></td>
                    <td>{{ $asset->categoryLabel() }}</td>
                    <td>{{ $asset->company->name }}</td>
                    <td>{{ $asset->applicable_to ?? '—' }}</td>
                    <td>v{{ optional($asset->latestVersion)->version_no ?? '—' }}</td>
                    <td>
                        @if($asset->status == 'pending') <span class="badge badge-pending">Pending Approval</span>
                        @elseif($asset->status == 'approved') <span class="badge badge-approved">Approved</span>
                        @else <span class="badge badge-changes">Revision Requested</span> @endif
                    </td>
                    <td>{{ optional($asset->submitted_at)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ url('/admin/branding-assets/'.$asset->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ url('/admin/branding-assets/'.$asset->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form method="POST" action="{{ url('/admin/branding-assets/'.$asset->id) }}" class="d-inline" onsubmit="return confirm('Delete this branding asset?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center text-muted p-4">No branding assets yet.</td></tr>
            @endforelse
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer">{{ $assets->appends(request()->query())->links() }}</div>
</div>
@endsection
