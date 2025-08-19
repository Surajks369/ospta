@extends('admin.layouts.app')

@section('title', 'Course Enrollment Details')

@section('content')
<div class="admin-wrapper">
     @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>Course Enrollment Details</h2>
            <a href="{{ route('admin.course-enrollments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Enrollments
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Course Enrollment Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>User</h5>
                        <p><strong>{{ $courseEnrollment->userRegistration ? $courseEnrollment->userRegistration->name : 'N/A' }}</strong><br>
                        <span class="text-muted">{{ $courseEnrollment->userRegistration ? $courseEnrollment->userRegistration->email : 'N/A' }}</span></p>
                        <h5>Course</h5>
                        <p><strong>{{ $courseEnrollment->course ? $courseEnrollment->course->title : 'N/A' }}</strong></p>
                        <h5>Enrollment Date</h5>
                        <p>{{ $courseEnrollment->enrollment_date ?? 'N/A' }}</p>
                        <h5>Start Date</h5>
                        <p>{{ $courseEnrollment->start_date ?? 'N/A' }}</p>
                        <h5>End Date</h5>
                        <p>{{ $courseEnrollment->end_date ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Amount Paid</h5>
                        <p>${{ number_format($courseEnrollment->amount_paid, 2) }}</p>
                        <h5>Payment Method</h5>
                        <p>{{ $courseEnrollment->payment_method ?? 'N/A' }}</p>
                        <h5>Payment Reference</h5>
                        <p>{{ $courseEnrollment->payment_reference ?? 'N/A' }}</p>
                        <h5>Payment Status</h5>
                        <span class="badge bg-{{ $courseEnrollment->payment_status_badge }}">{{ ucfirst($courseEnrollment->payment_status) }}</span>
                        <h5>Enrollment Status</h5>
                        <span class="badge bg-{{ $courseEnrollment->enrollment_status_badge }}">{{ ucfirst($courseEnrollment->enrollment_status) }}</span>
                        <h5>Progress</h5>
                        <div class="progress" style="width: 100px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $courseEnrollment->progress_percentage }}%">
                                {{ $courseEnrollment->progress_percentage }}%
                            </div>
                        </div>
                        <h5>Notes</h5>
                        <p>{{ $courseEnrollment->notes ?? 'N/A' }}</p>
                        <h5>Created At</h5>
                        <p>{{ $courseEnrollment->created_at->format('M d, Y') }}</p>
                        <h5>Updated At</h5>
                        <p>{{ $courseEnrollment->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
