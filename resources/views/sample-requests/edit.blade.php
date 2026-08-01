@extends('layouts.admin')
@section('title', 'Edit Sample Request')

@section('content')
@include('sample-requests._form', ['sampleRequest' => $sampleRequest])
@endsection
