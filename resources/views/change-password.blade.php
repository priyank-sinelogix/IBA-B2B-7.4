@extends('layouts.admin')
@section('title', 'Change Password')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card p-4">
            <h5 class="mb-3">Change Password</h5>

            <form method="POST" action="{{ url('/change-password') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required minlength="8">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                </div>

                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
