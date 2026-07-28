@extends('layouts.admin')
@section('title', 'New Sample Requests')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">My Sample Development Requests</h3>
        <a href="{{ url('/sample-requests/create') }}" class="btn btn-sm btn-iba"><i class="fas fa-plus mr-1"></i> New Request</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead><tr><th>Style</th><th>Fabric Pref.</th><th>Colour Pref.</th><th>Images</th><th>Status</th><th>Submitted</th></tr></thead>
            <tbody>
            @forelse($requests as $r)
                <tr>
                    <td>{{ $r->style_name }}</td>
                    <td>{{ $r->fabric_preference ?? '—' }}</td>
                    <td>{{ $r->colour_preference ?? '—' }}</td>
                    <td>{{ $r->images->count() }}</td>
                    <td>
                        @if($r->status == 'pending') <span class="badge badge-pending">Pending Review</span>
                        @elseif($r->status == 'in_review') <span class="badge badge-info">In Review</span>
                        @elseif($r->status == 'converted') <span class="badge badge-approved">Converted to Sample</span>
                        @else <span class="badge badge-changes">Rejected</span> @endif
                    </td>
                    <td>{{ $r->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted p-4">
                    No sample requests yet. Click "New Request" to ask IBA to develop a new style for you.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $requests->links() }}</div>
</div>
@endsection
