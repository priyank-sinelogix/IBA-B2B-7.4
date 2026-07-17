@extends('admin.layouts.admin')
@section('title', $user->name)

@section('content')
<div class="card col-lg-6 p-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">User Profile</h3>
        <a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-outline-secondary">Edit</a>
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-4">Name</dt><dd class="col-8">{{ $user->name }}</dd>
            <dt class="col-4">Email</dt><dd class="col-8">{{ $user->email }}</dd>
            <dt class="col-4">Designation</dt><dd class="col-8">{{ $user->designation ?? '—' }}</dd>
            <dt class="col-4">Role</dt><dd class="col-8"><span class="badge badge-light border text-capitalize">{{ str_replace('_',' ',$user->role) }}</span></dd>
            <dt class="col-4">Company</dt>
            <dd class="col-8">
                @if($user->company)
                    <a href="{{ url('/admin/companies/'.$user->company->id) }}">{{ $user->company->name }}</a>
                @else — @endif
            </dd>
            <dt class="col-4">Status</dt>
            <dd class="col-8">{!! $user->is_active ? '<span class="badge badge-approved">Active</span>' : '<span class="badge badge-changes">Inactive</span>' !!}</dd>
            <dt class="col-4">Last Login</dt><dd class="col-8">{{ optional($user->last_login_at)->format('d M Y, h:i A') ?? 'Never' }}</dd>
            <dt class="col-4">Joined</dt><dd class="col-8">{{ $user->created_at->format('d M Y') }}</dd>
        </dl>
    </div>
</div>
@endsection
