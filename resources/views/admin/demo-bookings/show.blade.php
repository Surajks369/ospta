@extends('admin.layouts.app')

@section('title', 'Demo Booking Details')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>Demo Booking Details</h2>
            <a href="{{ route('admin.demo-bookings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Bookings
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Demo Booking Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>User</h5>
                        <p><strong>{{ $demoBooking->userRegistration ? $demoBooking->userRegistration->name : 'N/A' }}</strong><br>
                        <span class="text-muted">{{ $demoBooking->userRegistration ? $demoBooking->userRegistration->email : 'N/A' }}</span></p>
                        <h5>Course</h5>
                        <p><strong>{{ $demoBooking->course ? $demoBooking->course->title : 'N/A' }}</strong></p>
                        <h5>Preferred Date</h5>
                        <p>{{ $demoBooking->preferred_date?->format('M d, Y') ?? 'N/A' }}</p>
                        <h5>Preferred Time</h5>
                        <p>{{ $demoBooking->preferred_time ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Name</h5>
                        <p>{{ $demoBooking->name }}</p>
                        <h5>Email</h5>
                        <p>{{ $demoBooking->email }}</p>
                        <h5>Phone</h5>
                        <p>{{ $demoBooking->phone }}</p>
                        <h5>Status</h5>
                        <span class="badge bg-{{ $demoBooking->status == 'confirmed' ? 'info' : ($demoBooking->status == 'completed' ? 'success' : ($demoBooking->status == 'cancelled' ? 'danger' : 'warning')) }}">
                            {{ ucfirst($demoBooking->status) }}
                        </span>
                    </div>
                </div>
                <hr>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>School Name</h5>
                        <p>{{ $demoBooking->school_name ?? 'N/A' }}</p>
                        <h5>School Address</h5>
                        <p>{{ $demoBooking->school_address ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Contact Person</h5>
                        <p>{{ $demoBooking->contact_person ?? 'N/A' }}</p>
                        <h5>Contact Designation</h5>
                        <p>{{ $demoBooking->contact_designation ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Contact Phone</h5>
                        <p>{{ $demoBooking->contact_phone ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Contact Email</h5>
                        <p>{{ $demoBooking->contact_email ?? 'N/A' }}</p>
                    </div>
                </div>
                <hr>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>Message</h5>
                        <p>{{ $demoBooking->message ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>Admin Notes</h5>
                        <p>{{ $demoBooking->admin_notes ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Created At</h5>
                        <p>{{ $demoBooking->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Updated At</h5>
                        <p>{{ $demoBooking->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
