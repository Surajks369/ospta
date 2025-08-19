@extends('admin.layouts.app')

@section('title', 'View Category')

@section('content')
<div class="admin-wrapper">
    <!-- Navigation -->
     @include('admin.partials.navigation')

    <!-- Main Content -->
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>View Category</h2>
            <div>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Categories
                </a>
            </div>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Category Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid rounded">
                        @else
                            <div class="text-center p-5 bg-light rounded">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="text-muted mt-2">No image available</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Name:</th>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug:</th>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $category->description ?: 'No description provided' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $category->status ? 'success' : 'danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Sort Order:</th>
                                <td>{{ $category->sort_order }}</td>
                            </tr>
                            <tr>
                                <th>Created At:</th>
                                <td>{{ $category->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At:</th>
                                <td>{{ $category->updated_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($category->courses->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Courses in this Category ({{ $category->courses->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>${{ $course->discounted_price ?: $course->price }}</td>
                                <td>
                                    <span class="badge bg-{{ $course->status ? 'success' : 'danger' }}">
                                        {{ $course->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
