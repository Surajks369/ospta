@extends('admin.layouts.app')
@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>View Testimonial</h2>
            <div>
                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Testimonials
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-fluid rounded">
                        @else
                            <div class="text-center p-5 bg-light rounded">
                                <i class="fas fa-user fa-3x text-muted"></i>
                                <p class="text-muted mt-2">No image available</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Name:</th>
                                <td>{{ $testimonial->name }}</td>
                            </tr>
                            <tr>
                                <th>Designation:</th>
                                <td>{{ $testimonial->designation ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Company:</th>
                                <td>{{ $testimonial->company ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Testimonial:</th>
                                <td>{{ $testimonial->testimonial }}</td>
                            </tr>
                            <tr>
                                <th>Rating:</th>
                                <td>
                                    @if($testimonial->rating)
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimonial->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $testimonial->status ? 'success' : 'secondary' }}">
                                        {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Sort Order:</th>
                                <td>{{ $testimonial->sort_order ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
