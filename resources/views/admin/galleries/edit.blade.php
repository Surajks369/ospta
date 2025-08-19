
@extends('admin.layouts.app')

@section('title', 'Edit Gallery Item')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-images me-2 text-primary"></i>Edit Gallery Item</h2>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Gallery
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                        <select class="form-control @error('type') is-invalid @enderror" 
                                                id="type" name="type" required>
                                            <option value="">Select Type</option>
                                            <option value="image" {{ old('type', $gallery->type) == 'image' ? 'selected' : '' }}>Image</option>
                                            <option value="video" {{ old('type', $gallery->type) == 'video' ? 'selected' : '' }}>Video</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" id="imageField">
                                <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Supported formats: JPG, PNG, GIF. Max size: 2MB</div>
                                @if($gallery->image)
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Image" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>

                            <div class="mb-3" id="videoField" style="display: none;">
                                <label for="video_url" class="form-label">Video URL</label>
                                <input type="url" class="form-control @error('video_url') is-invalid @enderror" 
                                       id="video_url" name="video_url" value="{{ old('video_url', $gallery->video_url) }}" 
                                       placeholder="https://youtube.com/watch?v=...">
                                @error('video_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">YouTube, Vimeo or direct video URL</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="order_position" class="form-label">Order Position</label>
                                        <input type="number" class="form-control @error('order_position') is-invalid @enderror" 
                                               id="order_position" name="order_position" value="{{ old('order_position', $gallery->order_position) }}" min="0">
                                        @error('order_position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                                   {{ old('status', $gallery->status) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">
                                                Active Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Update Gallery Item
                                </button>
                                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tips</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use high-quality images for better display</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Optimize images before uploading</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use descriptive titles for better SEO</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Set order position to control display sequence</li>
                            <li><i class="fas fa-check text-success me-2"></i>For videos, use YouTube or Vimeo URLs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const imageField = document.getElementById('imageField');
    const videoField = document.getElementById('videoField');
    const imageInput = document.getElementById('image');
    const videoInput = document.getElementById('video_url');

    function toggleFields() {
        const selectedType = typeSelect.value;
        if (selectedType === 'video') {
            imageField.style.display = 'none';
            videoField.style.display = 'block';
            imageInput.removeAttribute('required');
            videoInput.setAttribute('required', '');
        } else {
            imageField.style.display = 'block';
            videoField.style.display = 'none';
            imageInput.setAttribute('required', '');
            videoInput.removeAttribute('required');
        }
    }

    typeSelect.addEventListener('change', toggleFields);
    toggleFields(); // Initialize on page load
});
</script>
@endsection
