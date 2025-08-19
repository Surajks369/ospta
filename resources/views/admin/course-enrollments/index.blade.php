@extends('admin.layouts.app')

@section('title', 'Course Enrollments')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')

    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-user-graduate me-2 text-primary"></i>Course Enrollments Management</h2>
            <a href="{{ route('admin.course-enrollments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Enrollment
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Course Enrollments</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Student</th>
                                <th>Course</th>
                                <th>Enrollment Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrollments as $enrollment)
                            <tr>
                                <td class="ps-4">
                                    @if($enrollment->userRegistration)
                                        <div>
                                            <strong>{{ $enrollment->userRegistration->name }}</strong>
                                            <br><small class="text-muted">{{ $enrollment->userRegistration->email }}</small>
                                        </div>
                                    @else
                                        <span class="text-muted">User not found</span>
                                    @endif
                                </td>
                                <td>
                                    @if($enrollment->course)
                                        <div>
                                            <strong>{{ $enrollment->course->title }}</strong>
                                            @if($enrollment->course->category)
                                                <br><small class="text-muted">{{ $enrollment->course->category->name }}</small>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">Course not found</span>
                                    @endif
                                </td>
                                <td>{{ $enrollment->enrollment_date ? \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') : $enrollment->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($enrollment->amount_paid)
                                        <span class="text-success">${{ number_format($enrollment->amount_paid, 2) }}</span>
                                    @else
                                        <span class="text-muted">Free</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $enrollment->enrollment_status_badge }}">{{ ucfirst($enrollment->enrollment_status) }}</span>
                                </td>
                                <td>
                                    @if($enrollment->progress_percentage !== null)
                                        <div class="progress" style="width: 100px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $enrollment->progress_percentage ?? 0 }}%">
                                                {{ $enrollment->progress_percentage ?? 0 }}%
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.course-enrollments.show', $enrollment) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.course-enrollments.edit', $enrollment) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.course-enrollments.destroy', $enrollment) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this enrollment?')">
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
                                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">No enrollments found</h5>
                                        <p class="text-muted mb-3">Start by creating your first enrollment</p>
                                        <a href="{{ route('admin.course-enrollments.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Add First Enrollment
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($enrollments->hasPages())
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-center">
                            {{ $enrollments->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
