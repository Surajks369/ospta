@extends('admin.layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-images me-2 text-primary"></i>Gallery Management</h2>
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Item
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Gallery Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galleries as $gallery)
                            <tr>
                                <td class="ps-4">
                                    @if($gallery->image)
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $gallery->title }}</td>
                                <td>
                                    <span class="badge bg-{{ $gallery->type == 'video' ? 'info' : 'secondary' }}">
                                        {{ ucfirst($gallery->type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $gallery->status ? 'success' : 'danger' }}">
                                        {{ $gallery->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.galleries.show', $gallery) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">No gallery items found</h5>
                                        <p class="text-muted mb-3">Start by creating your first gallery item</p>
                                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Add First Item
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($galleries->hasPages())
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-center">
                            {{ $galleries->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
