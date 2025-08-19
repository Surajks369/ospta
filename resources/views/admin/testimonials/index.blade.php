@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
<div class="admin-wrapper">
     @include('admin.partials.navigation')
    

    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-quote-left me-2 text-primary"></i>Testimonials</h2>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Testimonial
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Testimonials</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Company</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $testimonial)
                            <tr>
                                <td class="ps-4">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><div class="fw-bold">{{ $testimonial->name }}</div></td>
                                <td>{{ $testimonial->designation ?? 'N/A' }}</td>
                                <td>{{ $testimonial->company ?? 'N/A' }}</td>
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
                                <td>
                                    <span class="badge bg-{{ $testimonial->status ? 'success' : 'secondary' }}">
                                        {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <a href="{{ route('admin.testimonials.show', $testimonial->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No testimonials found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($testimonials->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $testimonials->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
