@extends('admin.layouts.app')

@section('title', 'Course Details')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>View Course</h2>
            <div>
                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Courses
                </a>
            </div>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Course Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded">
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
                                <th width="150">Short Description:</th>
                                <td>{{ $course->short_description ?: 'No short description provided' }}</td>
                            </tr>
                            <tr>
                                <th>Slug:</th>
                                <td>{{ $course->slug }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>{{ $course->category ? $course->category->name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $course->description }}</td>
                            </tr>
                            <tr>
                                <th>Price:</th>
                                <td><strong>${{ number_format($course->price, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Discounted Price:</th>
                                <td>
                                    @if($course->discounted_price)
                                        <strong class="text-success">${{ number_format($course->discounted_price, 2) }}</strong>
                                        <span class="badge bg-warning ms-2">{{ $course->discount_percentage }}% OFF</span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Duration:</th>
                                <td>{{ $course->duration ?: 'Not specified' }}</td>
                            </tr>
                            <tr>
                                <th>Level:</th>
                                <td>
                                    @if($course->level)
                                        <span class="badge bg-info">{{ $course->level }}</span>
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Features:</th>
                                <td>
                                    @php
                                        $features = is_array($course->features) ? $course->features : explode(',', $course->features);
                                    @endphp
                                    @if(!empty($features) && !empty(array_filter($features)))
                                        <ul class="mb-0">
                                            @foreach($features as $feature)
                                                @if(trim($feature))
                                                    <li>{{ trim($feature) }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No features listed</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Sort Order:</th>
                                <td>{{ $course->sort_order }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $course->status ? 'success' : 'danger' }}">
                                        {{ $course->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created At:</th>
                                <td>{{ $course->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At:</th>
                                <td>{{ $course->updated_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
