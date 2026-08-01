@extends('layouts.admin')
@section('title', 'New Sample Request')

@section('content')
@include('sample-requests._form', ['sampleRequest' => new \App\Models\SampleRequest()])
@endsection
