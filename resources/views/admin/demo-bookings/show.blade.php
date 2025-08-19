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
                        <p><strong>{{ $demoBooking->user ? $demoBooking->user->name : 'N/A' }}</strong><br>
                        <span class="text-muted">{{ $demoBooking->user ? $demoBooking->user->email : 'N/A' }}</span></p>
                        <h5>Course</h5>
                        <p><strong>{{ $demoBooking->course ? $demoBooking->course->title : 'N/A' }}</strong></p>
                        <h5>Preferred Date</h5>
                        <p>{{ $demoBooking->preferred_date ?? 'N/A' }}</p>
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
                        <h5>Message</h5>
                        <p>{{ $demoBooking->message ?? 'N/A' }}</p>
                        <h5>Admin Notes</h5>
                        <p>{{ $demoBooking->admin_notes ?? 'N/A' }}</p>
                        <h5>Created At</h5>
                        <p>{{ $demoBooking->created_at->format('M d, Y') }}</p>
                        <h5>Updated At</h5>
                        <p>{{ $demoBooking->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
