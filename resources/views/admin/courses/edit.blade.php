@extends('admin.layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-edit me-2 text-primary"></i>Edit Course</h2>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Courses
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Course Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $course->title) }}" required placeholder="Title">
                                <label for="title">Title <span class="text-danger">*</span></label>
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
                                        <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" style="height: 80px" placeholder="Short Description">{{ old('short_description', $course->short_description) }}</textarea>
                        <label for="short_description">Short Description</label>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" style="height: 120px" placeholder="Description">{{ old('description', $course->description) }}</textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $course->price) }}" required placeholder="Price">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('discounted_price') is-invalid @enderror" id="discounted_price" name="discounted_price" value="{{ old('discounted_price', $course->discounted_price) }}" placeholder="Discounted Price">
                                <label for="discounted_price">Discounted Price</label>
                                @error('discounted_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $course->duration) }}" placeholder="Duration">
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
                                    <option value="Beginner" {{ old('level', $course->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="Intermediate" {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                                <label for="level">Level</label>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="img-thumbnail mt-2" style="height:80px;">
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('features') is-invalid @enderror" id="features" name="features" value="{{ old('features', is_array($course->features) ? implode(',', $course->features) : $course->features) }}" placeholder="Comma separated">
                        <label for="features">Features (comma separated)</label>
                        @error('features')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" aria-label="Select Status">
                                    <option value="1" {{ $course->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$course->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <label for="status">Status</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $course->sort_order) }}" placeholder="Sort Order">
                                <label for="sort_order">Sort Order</label>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i>Update Course
                        </button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
