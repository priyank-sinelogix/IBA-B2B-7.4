@extends('admin.layouts.admin')
@section('title', 'Messages — '.$company->name)

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">{{ $company->name }}</h3>
        <a href="{{ url('/admin/messages') }}" class="btn btn-sm btn-outline-secondary">&larr; All Conversations</a>
    </div>
    <div class="card-body p-0" style="max-height:520px; overflow-y:auto;">
        @forelse($messages as $msg)
            @php $isAdmin = optional($msg->sender)->isAdmin(); @endphp
            <div class="d-flex p-3 border-bottom {{ $isAdmin ? 'flex-row-reverse' : '' }}">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center {{ $isAdmin ? 'ml-3' : 'mr-3' }}" style="width:38px;height:38px;flex-shrink:0;">
                    {{ substr($msg->sender->name ?? 'U', 0, 1) }}
                </div>
                <div style="max-width:70%;">
                    <div class="font-weight-bold small {{ $isAdmin ? 'text-right' : '' }}">
                        {{ $isAdmin ? 'You' : ($msg->sender->name ?? 'Client') }}
                        @if($msg->linked_type)
                            <span class="badge badge-light text-capitalize ml-1">{{ $msg->linked_type }} #{{ $msg->linked_id }}</span>
                        @endif
                    </div>
                    <div class="p-2 rounded" style="{{ $isAdmin ? 'background:#eaf6ff;' : 'background:#f7f8fa;' }}">{{ $msg->body }}</div>
                    <div class="text-muted {{ $isAdmin ? 'text-right' : '' }}" style="font-size:.7rem;">{{ $msg->created_at->format('d M Y, h:i A') }}</div>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-muted">No messages with this client yet.</div>
        @endforelse
    </div>
    <div class="card-footer">
        <form method="POST" action="{{ url('/admin/messages/'.$company->id) }}" class="d-flex">
            @csrf
            <input type="text" name="body" class="form-control mr-2" placeholder="Type a reply..." required>
            <button class="btn btn-iba">Send</button>
        </form>
    </div>
</div>
@endsection
