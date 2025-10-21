@extends('admin.layouts.app')

@section('title', 'Create Course')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-plus me-2 text-primary"></i>Create Course</h2>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Courses
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Course Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" required placeholder="Course Title">
                                <label for="title">Course Title <span class="text-danger">*</span></label>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required aria-label="Select Category">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                  id="short_description" name="short_description" style="height: 80px" placeholder="Short Description">{{ old('short_description') }}</textarea>
                        <label for="short_description">Short Description</label>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" style="height: 150px" required placeholder="Description">{{ old('description') }}</textarea>
                        <label for="description">Description <span class="text-danger">*</span></label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" required placeholder="Price">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('discounted_price') is-invalid @enderror" 
                                       id="discounted_price" name="discounted_price" value="{{ old('discounted_price') }}" placeholder="Discounted Price">
                                <label for="discounted_price">Discounted Price</label>
                                @error('discounted_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" name="duration" value="{{ old('duration') }}" placeholder="Duration">
                                <label for="duration">Duration</label>
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('level') is-invalid @enderror" id="level" name="level" aria-label="Select Level">
                                    <option value="">Select Level</option>
                                    <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                                <label for="level">Level</label>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Course Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Upload an image for this course (JPG, PNG, GIF max 2MB)</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course Features</label>
                        <div id="features-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
                                <button type="button" class="btn btn-outline-primary" onclick="addFeature()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Add course features one by one</small>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Select Status">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" placeholder="Sort Order">
                                <label for="sort_order">Sort Order</label>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const newFeature = document.createElement('div');
    newFeature.className = 'input-group mb-2';
    newFeature.innerHTML = `
        <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
        <button type="button" class="btn btn-outline-danger" onclick="removeFeature(this)">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(newFeature);
}

function removeFeature(button) {
    button.parentElement.remove();
}
</script>
@endpush
@endsection
