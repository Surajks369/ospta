@extends('admin.layouts.app')

@section('title', 'User Registrations')

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
            <h2><i class="fas fa-user-plus me-2 text-primary"></i>User Registrations</h2>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.user-registrations.index') }}">All</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.user-registrations.index', ['status' => 'pending']) }}">Pending</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.user-registrations.index', ['status' => 'approved']) }}">Approved</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.user-registrations.index', ['status' => 'rejected']) }}">Rejected</a></li>
                    </ul>
                </div>
                <a href="{{ route('admin.user-registrations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Registration
                </a>
            </div>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All User Registrations</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course Interest</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $registration)
                            <tr>
                                <td class="ps-4 fw-bold">{{ $registration->name }}</td>
                                <td>{{ $registration->email }}</td>
                                <td>{{ $registration->phone ?? 'N/A' }}</td>
                                <td>{{ $registration->course_interest ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $registration->status == 'approved' ? 'success' : ($registration->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </td>
                                <td>{{ $registration->created_at->format('M d, Y') }}</td>
                                <td class="pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.user-registrations.show', $registration) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.user-registrations.edit', $registration) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.user-registrations.destroy', $registration) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this registration?')">
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
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-user-plus fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">No user registrations found</h5>
                                        <p class="text-muted mb-3">Start by creating your first registration</p>
                                        <a href="{{ route('admin.user-registrations.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Add First Registration
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
