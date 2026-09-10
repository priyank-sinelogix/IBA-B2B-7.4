@extends('admin.layouts.admin')
@section('title', 'Messages')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Client Conversations</h3></div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
        @forelse($companies as $company)
            @php $last = $company->messages->first(); @endphp
            <a href="{{ url('/admin/messages/'.$company->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" style="width:40px;height:40px;flex-shrink:0;">
                    {{ substr($company->name, 0, 1) }}
                </div>
                <div class="flex-grow-1" style="min-width:0;">
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold {{ $company->unread_count > 0 ? '' : 'text-muted' }}">{{ $company->name }}</span>
                        <span class="text-muted small">{{ $last ? $last->created_at->diffForHumans() : '' }}</span>
                    </div>
                    <div class="text-muted small text-truncate" style="max-width:500px;">{{ $last->body ?? '' }}</div>
                </div>
                @if($company->unread_count > 0)
                    <span class="badge badge-danger ml-3">{{ $company->unread_count }}</span>
                @endif
            </a>
        @empty
            <div class="p-4 text-center text-muted">No client messages yet.</div>
        @endforelse
        </div>
    </div>
</div>
@endsection
