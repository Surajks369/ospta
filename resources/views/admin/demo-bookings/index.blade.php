@extends('admin.layouts.app')

@section('title', 'Demo Bookings')

@section('content')
<style>
    .bookings-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
    }
    .bookings-header h2 {
        color: white;
        margin: 0;
        font-weight: 700;
    }
    .btn-add-booking {
        background: white;
        color: #8b5cf6;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-add-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: #8b5cf6;
        background: #f8f9fa;
    }
    .bookings-card {
        border-radius: 15px;
        border: none;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    }
    .bookings-table {
        margin: 0;
    }
    .bookings-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .bookings-table thead th {
        border: none;
        padding: 1.2rem 1rem;
        font-weight: 700;
        color: #2d3748;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .bookings-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s;
    }
    .bookings-table tbody tr:hover {
        background: #f8f9ff;
        transform: scale(1.01);
        box-shadow: 0 3px 10px rgba(139, 92, 246, 0.1);
    }
    .bookings-table tbody td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
        border: none;
    }
    .booking-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .booking-name {
        font-weight: 600;
        color: #2d3748;
        font-size: 0.95rem;
    }
    .booking-email {
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
    .date-info {
        color: #718096;
        font-size: 0.85rem;
    }
    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-align: center;
        display: inline-block;
    }
    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }
    .status-confirmed {
        background: #dbeafe;
        color: #0c4a6e;
    }
    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }
    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .btn-sm-custom {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-view {
        background: #dbeafe;
        color: #0c4a6e;
    }
    .btn-view:hover {
        background: #bfdbfe;
        color: #0c4a6e;
    }
    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }
    .btn-edit:hover {
        background: #fcd34d;
        color: #92400e;
    }
    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }
    .btn-delete:hover {
        background: #fecaca;
        color: #991b1b;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #718096;
    }
    .empty-state i {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }
</style>

<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="bookings-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-calendar-check me-2"></i>Demo Bookings</h2>
                <a href="{{ route('admin.demo-bookings.create') }}" class="btn btn-add-booking">
                    <i class="fas fa-plus me-1"></i>Add Demo Booking
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card bookings-card">
            <div class="card-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; padding: 1rem 1.5rem; border: none;">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Demo Bookings</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table bookings-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demoBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="booking-info">
                                            <span class="booking-name">{{ $booking->name }}</span>
                                            <span class="booking-email">{{ $booking->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="course-info">
                                            <span class="course-title">{{ $booking->course?->title ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            {{ $booking->preferred_date?->format('M d, Y') ?? 'N/A' }}<br>
                                            <small>{{ $booking->preferred_time ?? 'N/A' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons" style="justify-content: flex-end;">
                                            <a href="{{ route('admin.demo-bookings.show', $booking) }}" class="btn-sm-custom btn-view" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.demo-bookings.edit', $booking) }}" class="btn-sm-custom btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.demo-bookings.destroy', $booking) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-sm-custom btn-delete" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h5 class="text-muted">No demo bookings found</h5>
                                            <p class="text-muted">Get started by creating your first demo booking.</p>
                                            <a href="{{ route('admin.demo-bookings.create') }}" class="btn btn-add-booking mt-3">
                                                <i class="fas fa-plus me-1"></i>Create Demo Booking
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($demoBookings->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $demoBookings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
