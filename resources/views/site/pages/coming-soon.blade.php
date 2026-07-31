@extends('site.layouts.app')
@section('title', $title)

@section('content')
<div class="wrap" style="padding:120px 24px; text-align:center;">
    <h1 style="font-size:2rem; margin-bottom:12px;">{{ $title }}</h1>
    <p style="color:var(--muted); font-size:1.05rem;">This page is being built next and will match the Sewgo design shortly.</p>
</div>
@endsection
