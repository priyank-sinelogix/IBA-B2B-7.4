@extends('admin.layouts.admin')
@section('title', 'Sample Requests')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">New Sample Requests — All Clients</h3></div>
    <div class="card-body p-0">
        <form class="d-flex p-3 border-bottom" method="GET">
            <select name="status" class="form-control" style="max-width:220px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="in_review" {{ request('status')=='in_review'?'selected':'' }}>In Review</option>
                <option value="converted" {{ request('status')=='converted'?'selected':'' }}>Converted</option>
                <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
            </select>
        </form>
        <table class="table table-hover mb-0">
            <thead><tr><th>Client</th><th>Style</th><th>Fabric Pref.</th><th>Requested By</th><th>Status</th><th>Date</th><th></th></tr></thead>
            <tbody>
            @forelse($requests as $r)
                <tr>
                    <td>{{ $r->company->name }}</td>
                    <td>{{ $r->style_name }}</td>
                    <td>{{ $r->fabric_preference ?? '—' }}</td>
                    <td>{{ $r->requestedBy->name ?? '—' }}</td>
                    <td>
                        @if($r->status == 'pending') <span class="badge badge-pending">Pending</span>
                        @elseif($r->status == 'in_review') <span class="badge badge-info">In Review</span>
                        @elseif($r->status == 'converted') <span class="badge badge-approved">Converted</span>
                        @else <span class="badge badge-changes">Rejected</span> @endif
                    </td>
                    <td>{{ $r->created_at->format('d M Y') }}</td>
                    <td><a href="{{ url('/admin/sample-requests/'.$r->id) }}" class="btn btn-sm btn-outline-primary">Review</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted p-4">No sample requests yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $requests->links() }}</div>
</div>
@endsection
