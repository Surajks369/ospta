@extends('admin.layouts.app')

@section('title', 'Server Error')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="display-6 text-danger">500 — Server Error</h1>
    <p class="lead">Something went wrong on the server. Please try again or contact support.</p>
    <div class="mt-3">
        <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Gallery List</a>
    </div>
    <div class="mt-4 text-muted small">If the problem persists, check server logs or contact your hosting provider.</div>
</div>
@endsection
