@extends('admin.layouts.admin')
@section('title', $brandingAsset->name)

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Current Image</h3>
                <a href="{{ url('/admin/branding-assets/'.$brandingAsset->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            <div class="card-body text-center">
                <img src="{{ optional($brandingAsset->latestVersion)->coverUrl() ?? 'https://via.placeholder.com/300' }}"
                     class="img-fluid rounded mb-3 lightbox-img" style="max-height:300px;object-fit:cover;">
                @if($brandingAsset->latestVersion && $brandingAsset->latestVersion->images->count() > 1)
                <div class="mb-3">
                    @foreach($brandingAsset->latestVersion->images as $img)
                        <img src="{{ $img->url() }}" style="width:56px;height:56px;object-fit:cover;border-radius:6px;" class="mr-1 mb-1 border lightbox-img">
                    @endforeach
                </div>
                @endif
                <h5 class="mb-1">{{ $brandingAsset->name }}</h5>
                <p class="text-muted mb-0">Category: {{ $brandingAsset->categoryLabel() }}</p>
                <p class="text-muted mb-0">Applicable To: {{ $brandingAsset->applicable_to ?? '—' }}</p>
                <p class="text-muted">Version: v{{ optional($brandingAsset->latestVersion)->version_no ?? '—' }}</p>
                <p>
                    @if($brandingAsset->status == 'pending') <span class="badge badge-pending">Pending Approval</span>
                    @elseif($brandingAsset->status == 'approved') <span class="badge badge-approved">Approved</span>
                    @else <span class="badge badge-changes">Revision Requested</span> @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Client Company</h3></div>
            <div class="card-body">
                <strong>{{ $brandingAsset->company->name }}</strong><br>
                <span class="text-muted">{{ $brandingAsset->company->code }}</span>
            </div>
        </div>

        @if($brandingAsset->versions->count() > 1)
        <div class="card">
            <div class="card-header"><h3 class="card-title">Version History</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($brandingAsset->versions->reverse() as $v)
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ $v->coverUrl() }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;" class="mr-2 border lightbox-img">
                        <div>
                            <strong>v{{ $v->version_no }}</strong>
                            <div class="text-muted small">{{ $v->notes ?: 'No notes' }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $v->created_at->format('d M Y, h:i A') }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Comments & Approval History</h3></div>
            <div class="card-body">
                @forelse($brandingAsset->comments as $comment)
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
                @empty
                <p class="text-muted text-center">No comments yet.</p>
                @endforelse

                <hr>
                <form method="POST" action="{{ url('/admin/branding-assets/'.$brandingAsset->id.'/comment') }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="comment" class="form-control" rows="2" placeholder="Add a note or reply to the client's feedback..." required></textarea>
                    </div>
                    <button class="btn btn-primary btn-sm">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
