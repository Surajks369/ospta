@extends('admin.layouts.app')

@section('title', 'Course Enrollment Details')

@section('content')
<style>
    .enrollment-detail-card {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .enrollment-detail-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 1.5rem;
        font-weight: 600;
        border: none;
    }
    .enrollment-detail-card .card-body {
        padding: 1.5rem;
        background: #ffffff;
    }
    .detail-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
        align-items: center;
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        min-width: 180px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }
    .detail-label i {
        margin-right: 8px;
        color: #667eea;
        width: 20px;
    }
    .detail-value {
        color: #212529;
        flex: 1;
        font-size: 0.95rem;
    }
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #667eea;
        display: flex;
        align-items: center;
    }
    .section-title i {
        margin-right: 10px;
        color: #667eea;
    }
    .status-badge-large {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }
    .progress-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .progress-bar-custom {
        height: 25px;
        border-radius: 12px;
        flex: 1;
        background: #e9ecef;
        overflow: hidden;
    }
    .progress-bar-custom .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .info-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .amount-display {
        font-size: 1.5rem;
        font-weight: 700;
        color: #10b981;
    }
    .date-display {
        color: #6366f1;
        font-weight: 600;
    }
    @media (max-width: 768px) {
        .detail-row {
            flex-direction: column;
            align-items: flex-start;
        }
        .detail-label {
            min-width: auto;
            margin-bottom: 0.25rem;
        }
    }
</style>

<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-user-graduate me-2 text-primary"></i>Course Enrollment Details</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.course-enrollments.edit', $courseEnrollment) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('admin.course-enrollments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>

        <div class="info-card-grid">
            <!-- Student Information -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-user me-2"></i>Student Information
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-user-circle"></i>Full Name</div>
                        <div class="detail-value">{{ $courseEnrollment->name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-envelope"></i>Email</div>
                        <div class="detail-value">{{ $courseEnrollment->email ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-phone"></i>Phone</div>
                        <div class="detail-value">{{ $courseEnrollment->phone ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-birthday-cake"></i>Date of Birth</div>
                        <div class="detail-value">{{ $courseEnrollment->date_of_birth ? \Carbon\Carbon::parse($courseEnrollment->date_of_birth)->format('M d, Y') : 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-venus-mars"></i>Gender</div>
                        <div class="detail-value">{{ $courseEnrollment->gender ? ucfirst($courseEnrollment->gender) : 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-map-marker-alt me-2"></i>Address Information
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-home"></i>Address</div>
                        <div class="detail-value">{{ $courseEnrollment->address ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-city"></i>City</div>
                        <div class="detail-value">{{ $courseEnrollment->city ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-map"></i>State</div>
                        <div class="detail-value">{{ $courseEnrollment->state ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-mail-bulk"></i>Pincode</div>
                        <div class="detail-value">{{ $courseEnrollment->pincode ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- School Details -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-school me-2"></i>School Details
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-building"></i>School Name</div>
                        <div class="detail-value">{{ $courseEnrollment->current_school ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-layer-group"></i>Grade</div>
                        <div class="detail-value">{{ $courseEnrollment->school_grade ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-book-reader"></i>Board</div>
                        <div class="detail-value">{{ $courseEnrollment->school_board ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Parent Details -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-users me-2"></i>Parent/Guardian Details
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-user-tie"></i>Parent Name</div>
                        <div class="detail-value">{{ $courseEnrollment->parent_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-phone-alt"></i>Parent Phone</div>
                        <div class="detail-value">{{ $courseEnrollment->parent_phone ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-envelope"></i>Parent Email</div>
                        <div class="detail-value">{{ $courseEnrollment->parent_email ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-briefcase"></i>Occupation</div>
                        <div class="detail-value">{{ $courseEnrollment->parent_occupation ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-graduation-cap"></i>Qualification</div>
                        <div class="detail-value">{{ $courseEnrollment->qualification ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Course Information -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-book me-2"></i>Course Information
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-bookmark"></i>Course</div>
                        <div class="detail-value">
                            <strong>{{ $courseEnrollment->course ? $courseEnrollment->course->title : 'N/A' }}</strong>
                            @if($courseEnrollment->course && $courseEnrollment->course->category)
                                <br><small class="text-muted">{{ $courseEnrollment->course->category->name }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-calendar-check"></i>Enrollment Date</div>
                        <div class="detail-value date-display">
                            {{ $courseEnrollment->enrollment_date ? \Carbon\Carbon::parse($courseEnrollment->enrollment_date)->format('l, M d, Y') : 'N/A' }}
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-play-circle"></i>Start Date</div>
                        <div class="detail-value">{{ $courseEnrollment->start_date ? \Carbon\Carbon::parse($courseEnrollment->start_date)->format('M d, Y') : 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-stop-circle"></i>End Date</div>
                        <div class="detail-value">{{ $courseEnrollment->end_date ? \Carbon\Carbon::parse($courseEnrollment->end_date)->format('M d, Y') : 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Enrollment Status -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i>Enrollment Status
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-flag"></i>Status</div>
                        <div class="detail-value">
                            <span class="status-badge-large bg-{{ $courseEnrollment->enrollment_status_badge }}">
                                {{ ucfirst($courseEnrollment->enrollment_status) }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-chart-line"></i>Progress</div>
                        <div class="detail-value">
                            <div class="progress-wrapper">
                                <div class="progress-bar-custom">
                                    <div class="progress-bar" style="width: {{ $courseEnrollment->progress_percentage ?? 0 }}%">
                                        {{ $courseEnrollment->progress_percentage ?? 0 }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-dollar-sign me-2"></i>Payment Information
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-money-bill-wave"></i>Amount Paid</div>
                        <div class="detail-value">
                            <span class="amount-display">${{ number_format($courseEnrollment->amount_paid, 2) }}</span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-credit-card"></i>Payment Method</div>
                        <div class="detail-value">{{ $courseEnrollment->payment_method ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-receipt"></i>Payment Reference</div>
                        <div class="detail-value">{{ $courseEnrollment->payment_reference ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-check-circle"></i>Payment Status</div>
                        <div class="detail-value">
                            <span class="status-badge-large bg-{{ $courseEnrollment->payment_status_badge }}">
                                {{ ucfirst($courseEnrollment->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="card enrollment-detail-card shadow-sm">
                <div class="card-header">
                    <i class="fas fa-sticky-note me-2"></i>Additional Information
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-comment-alt"></i>Notes</div>
                        <div class="detail-value">{{ $courseEnrollment->notes ?? 'No notes available' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-calendar-plus"></i>Created At</div>
                        <div class="detail-value">{{ $courseEnrollment->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label"><i class="fas fa-calendar-edit"></i>Updated At</div>
                        <div class="detail-value">{{ $courseEnrollment->updated_at->format('M d, Y h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
