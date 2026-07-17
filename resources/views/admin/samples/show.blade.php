@extends('admin.layouts.admin')
@section('title', $sample->sample_code)

@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Current Image</h3>
                <a href="{{ url('/admin/samples/'.$sample->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            <div class="card-body text-center">
                <img src="{{ optional($sample->latestVersion)->signedImageUrl() ?? 'https://via.placeholder.com/300' }}"
                     class="img-fluid rounded mb-3" style="max-height:300px;object-fit:cover;">
                <h5 class="mb-1">{{ $sample->style_name }}</h5>
                <p class="text-muted mb-0">Code: {{ $sample->sample_code }}</p>
                <p class="text-muted mb-0">Fabric: {{ $sample->fabric }}</p>
                <p class="text-muted">Color: {{ $sample->color }}</p>
                <p>
                    @if($sample->status == 'pending') <span class="badge badge-pending">Pending</span>
                    @elseif($sample->status == 'approved') <span class="badge badge-approved">Approved</span>
                    @else <span class="badge badge-changes">Changes Requested</span> @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Client Company</h3>
                <a href="{{ url('/admin/companies/'.$sample->company->id) }}" class="btn btn-sm btn-outline-secondary">View Company</a>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5">Name</dt><dd class="col-7">{{ $sample->company->name }}</dd>
                    <dt class="col-5">Code</dt><dd class="col-7">{{ $sample->company->code }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Version History</h3></div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($sample->versions as $version)
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ $version->signedImageUrl() }}" width="40" height="40" style="object-fit:cover;border-radius:6px;" class="mr-3">
                        <div>
                            <div class="font-weight-bold small">Version {{ $version->version_no }}</div>
                            <div class="text-muted small">{{ $version->notes }}</div>
                        </div>
                        <span class="text-muted small ml-auto">{{ $version->created_at->format('d M Y') }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center">No versions yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Comments & Approval History</h3></div>
            <div class="card-body" style="max-height:480px;overflow-y:auto;">
                @forelse($sample->comments as $comment)
                <div class="d-flex mb-3 {{ $comment->action == 'revise' ? 'p-2' : '' }}" style="{{ $comment->action == 'revise' ? 'background:#fff5f2;border-radius:8px;' : '' }}">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" style="width:36px;height:36px;flex-shrink:0;">
                        {{ substr($comment->user->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <div class="font-weight-bold small">
                            {{ $comment->user->name ?? 'User' }}
                            @if($comment->user && $comment->user->isAdmin())
                                <span class="badge badge-light border ml-1">IBA Team</span>
                            @endif
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
            </div>

            <!-- Admin adds their own point/reply here, same thread the client sees -->
            <div class="card-footer">
                <form method="POST" action="{{ url('/admin/samples/'.$sample->id.'/comment') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <textarea name="comment" class="form-control" rows="2" placeholder="Add a note or reply to the client's feedback..." required></textarea>
                    </div>
                    <button class="btn btn-sm btn-primary">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
