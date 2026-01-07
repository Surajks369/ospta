@extends('admin.layouts.app')

@section('title', 'Request Too Large')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="display-6 text-danger">413 — Request Entity Too Large</h1>
    <p class="lead">The file you tried to upload exceeds the allowed size. Maximum allowed size is {{ config('gallery.max_upload_mb', 10) }} MB.</p>
    <p>Please reduce the file size and try again.</p>
    <div class="mt-3">
        <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Gallery List</a>
    </div>
    <div class="mt-4 text-muted small">If this keeps happening, ask your server admin to increase POST/upload size limits.</div>
</div>
@endsection
