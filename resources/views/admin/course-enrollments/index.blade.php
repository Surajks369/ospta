@extends('admin.layouts.app')

@section('title', 'Course Enrollments')

@section('content')
<style>
    .enrollments-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    .enrollments-header h2 {
        color: white;
        margin: 0;
        font-weight: 700;
    }
    .btn-add-enrollment {
        background: white;
        color: #667eea;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-add-enrollment:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: #667eea;
        background: #f8f9fa;
    }
    .enrollments-card {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }
    .enrollments-table {
        margin: 0;
    }
    .enrollments-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .enrollments-table thead th {
        border: none;
        padding: 1.2rem 1rem;
        font-weight: 700;
        color: #2d3748;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .enrollments-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s;
    }
    .enrollments-table tbody tr:hover {
        background: #f8f9ff;
        transform: scale(1.01);
        box-shadow: 0 3px 10px rgba(102, 126, 234, 0.1);
    }
    .enrollments-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        border: none;
    }
    .student-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .student-name {
        font-weight: 600;
        color: #2d3748;
        font-size: 0.95rem;
    }
    .student-email {
        color: #718096;
        font-size: 0.85rem;
    }
    .course-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .course-title {
        font-weight: 600;
        color: #2d3748;
        font-size: 0.95rem;
    }
    .course-category {
        color: #718096;
        font-size: 0.85rem;
    }
    .amount-paid {
        font-weight: 700;
        color: #10b981;
        font-size: 1rem;
    }
    .status-badge-custom {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    .progress-bar-wrapper {
        width: 120px;
        height: 25px;
        background: #e9ecef;
        border-radius: 12px;
        overflow: hidden;
    }
    .progress-bar-custom {
        height: 100%;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.75rem;
        transition: width 0.3s;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    .btn-action {
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
        font-size: 0.9rem;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-view {
        background: #3b82f6;
        color: white;
    }
    .btn-view:hover {
        background: #2563eb;
        color: white;
    }
    .btn-edit {
        background: #f59e0b;
        color: white;
    }
    .btn-edit:hover {
        background: #d97706;
        color: white;
    }
    .btn-delete {
        background: #ef4444;
        color: white;
    }
    .btn-delete:hover {
        background: #dc2626;
        color: white;
    }
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    .empty-state i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1.5rem;
    }
    .empty-state h5 {
        color: #4a5568;
        margin-bottom: 0.5rem;
    }
    .empty-state p {
        color: #718096;
        margin-bottom: 1.5rem;
    }
    .alert-success-custom {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
</style>

<div class="admin-wrapper">
    @include('admin.partials.navigation')

    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="enrollments-header d-flex justify-content-between align-items-center">
            <div>
                <h2><i class="fas fa-user-graduate me-3"></i>Course Enrollments</h2>
                <p class="mb-0 mt-2" style="opacity: 0.9;">Manage and track all student enrollments</p>
            </div>
            <a href="{{ route('admin.course-enrollments.create') }}" class="btn-add-enrollment">
                <i class="fas fa-plus me-2"></i>Add New Enrollment
            </a>
        </div>

        <div class="card enrollments-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table enrollments-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Student</th>
                                <th>Course</th>
                                <th>Enrollment Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="pe-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrollments as $enrollment)
                            <tr>
                                <td class="ps-4">
                                    <div class="student-info">
                                        <span class="student-name">{{ $enrollment->name ?? ($enrollment->userRegistration ? $enrollment->userRegistration->name : 'N/A') }}</span>
                                        <span class="student-email">{{ $enrollment->email ?? ($enrollment->userRegistration ? $enrollment->userRegistration->email : 'N/A') }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($enrollment->course)
                                        <div class="course-info">
                                            <span class="course-title">{{ $enrollment->course->title }}</span>
                                            @if($enrollment->course->category)
                                                <span class="course-category">{{ $enrollment->course->category->name }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">Course not found</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="color: #6366f1; font-weight: 500;">
                                        {{ $enrollment->enrollment_date ? \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') : $enrollment->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td>
                                    @if($enrollment->amount_paid)
                                        <span class="amount-paid">&#8377;{{ number_format($enrollment->amount_paid, 2) }}</span>
                                    @else
                                        <span class="text-muted">Free</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge-custom bg-{{ $enrollment->enrollment_status_badge }}">
                                        {{ ucfirst($enrollment->enrollment_status) }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <div class="action-buttons justify-content-center">
                                        <a href="{{ route('admin.course-enrollments.show', $enrollment) }}" class="btn btn-action btn-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.course-enrollments.edit', $enrollment) }}" class="btn btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.course-enrollments.destroy', $enrollment) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this enrollment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-action btn-delete" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h5>No enrollments found</h5>
                                        <p>Start by creating your first enrollment</p>
                                        <a href="{{ route('admin.course-enrollments.create') }}" class="btn-add-enrollment">
                                            <i class="fas fa-plus me-2"></i>Add First Enrollment
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($enrollments->hasPages())
                    <div class="card-footer bg-light" style="border-top: 1px solid #f0f0f0; padding: 1.5rem;">
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
