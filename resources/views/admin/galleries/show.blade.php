
@extends('admin.layouts.app')

@section('title', 'Gallery Details')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-images me-2 text-primary"></i>Gallery Item Details</h2>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Gallery
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-5 text-center">
                                @if($gallery->image)
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Image" class="img-thumbnail rounded mb-2" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 300px; height: 300px;">
                                        <i class="fas fa-image fa-4x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <h4 class="fw-bold mb-3">{{ $gallery->title }}</h4>
                                <p class="mb-2"><strong>Type:</strong> <span class="badge bg-{{ $gallery->type == 'video' ? 'info' : 'secondary' }}">{{ ucfirst($gallery->type) }}</span></p>
                                <p class="mb-2"><strong>Status:</strong> <span class="badge bg-{{ $gallery->status ? 'success' : 'danger' }}">{{ $gallery->status ? 'Active' : 'Inactive' }}</span></p>
                                @if($gallery->type == 'video' && $gallery->video_url)
                                    <p class="mb-2"><strong>Video URL:</strong> <a href="{{ $gallery->video_url }}" target="_blank">{{ $gallery->video_url }}</a></p>
                                @endif
                                <p class="mb-2"><strong>Order Position:</strong> {{ $gallery->order_position }}</p>
                                <p class="mb-2"><strong>Description:</strong> {{ $gallery->description }}</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to Gallery
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
