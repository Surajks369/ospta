@extends('admin.layouts.app')

@section('title', 'Demo Booking Details')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
    }
    .page-header h2 {
        color: white;
        margin: 0;
        font-weight: 700;
    }
    .btn-back {
        background: white;
        color: #f59e0b;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: #f59e0b;
    }
    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f59e0b;
        display: flex;
        align-items: center;
    }
    .section-title i {
        margin-right: 10px;
        color: #f59e0b;
    }
    .detail-card {
        background: white;
        padding: 2rem;
        margin-bottom: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    .detail-row {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .detail-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .detail-item {
        flex: 1;
        min-width: 250px;
    }
    .detail-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    .detail-label i {
        margin-right: 0.5rem;
        color: #f59e0b;
    }
    .detail-value {
        font-size: 1rem;
        color: #2d3748;
        font-weight: 500;
    }
    .detail-value.text-muted {
        color: #718096;
        font-size: 0.9rem;
    }
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .status-pending {
        background: #fef3c7;
        color: #b45309;
    }
    .status-confirmed {
        background: #dbeafe;
        color: #1e40af;
    }
    .status-completed {
        background: #dcfce7;
        color: #166534;
    }
    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }
    .btn-group-detail {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .btn-edit-detail {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-edit-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(245, 158, 11, 0.4);
        color: white;
    }
    .btn-delete-detail {
        background: #fee2e2;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        color: #991b1b;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-delete-detail:hover {
        background: #fecaca;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(153, 27, 27, 0.3);
        color: #991b1b;
    }
</style>

<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-eye me-2"></i>Demo Booking Details</h2>
                <a href="{{ route('admin.demo-bookings.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>

        <!-- Booking Information Section -->
        <div class="detail-card">
            <div class="section-title">
                <i class="fas fa-book"></i>Booking Information
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-graduation-cap"></i>Course</div>
                    <div class="detail-value">{{ $demoBooking->course ? $demoBooking->course->title : 'N/A' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-calendar-alt"></i>Preferred Date</div>
                    <div class="detail-value">{{ $demoBooking->preferred_date?->format('M d, Y') ?? 'N/A' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-clock"></i>Preferred Time</div>
                    <div class="detail-value">{{ $demoBooking->preferred_time ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-flag"></i>Status</div>
                    <div class="detail-value">
                        <span class="status-badge status-{{ $demoBooking->status }}">
                            {{ ucfirst($demoBooking->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Information Section -->
        <div class="detail-card">
            <div class="section-title">
                <i class="fas fa-user"></i>Contact Information
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-user-circle"></i>Name</div>
                    <div class="detail-value">{{ $demoBooking->name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-envelope"></i>Email</div>
                    <div class="detail-value">{{ $demoBooking->email }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-phone"></i>Phone</div>
                    <div class="detail-value">{{ $demoBooking->phone }}</div>
                </div>
            </div>
        </div>

        <!-- School Information Section -->
        <div class="detail-card">
            <div class="section-title">
                <i class="fas fa-school"></i>School Information
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-institution"></i>School Name</div>
                    <div class="detail-value">{{ $demoBooking->school_name ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-map-marker-alt"></i>School Address</div>
                    <div class="detail-value">{{ $demoBooking->school_address ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-user-tie"></i>Contact Person</div>
                    <div class="detail-value">{{ $demoBooking->contact_person ?? 'N/A' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-briefcase"></i>Designation</div>
                    <div class="detail-value">{{ $demoBooking->contact_designation ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-phone-alt"></i>Contact Phone</div>
                    <div class="detail-value">{{ $demoBooking->contact_phone ?? 'N/A' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-at"></i>Contact Email</div>
                    <div class="detail-value">{{ $demoBooking->contact_email ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="detail-card">
            <div class="section-title">
                <i class="fas fa-comments"></i>Additional Information
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-comment"></i>Message</div>
                    <div class="detail-value">{{ $demoBooking->message ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-sticky-note"></i>Admin Notes</div>
                    <div class="detail-value">{{ $demoBooking->admin_notes ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Metadata Section -->
        <div class="detail-card">
            <div class="section-title">
                <i class="fas fa-history"></i>Activity Timeline
            </div>
            <div class="detail-row">
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-plus-circle"></i>Created At</div>
                    <div class="detail-value">{{ $demoBooking->created_at->format('M d, Y \a\t H:i') }}</div>
                    <div class="detail-value text-muted"><small>{{ $demoBooking->created_at->diffForHumans() }}</small></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label"><i class="fas fa-edit"></i>Updated At</div>
                    <div class="detail-value">{{ $demoBooking->updated_at->format('M d, Y \a\t H:i') }}</div>
                    <div class="detail-value text-muted"><small>{{ $demoBooking->updated_at->diffForHumans() }}</small></div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="detail-card">
            <div class="btn-group-detail">
                <a href="{{ route('admin.demo-bookings.edit', $demoBooking) }}" class="btn btn-edit-detail">
                    <i class="fas fa-edit me-2"></i>Edit Booking
                </a>
                <form action="{{ route('admin.demo-bookings.destroy', $demoBooking) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this demo booking?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete-detail">
                        <i class="fas fa-trash me-2"></i>Delete Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
