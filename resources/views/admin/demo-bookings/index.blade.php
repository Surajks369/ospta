@extends('admin.layouts.app')

@section('title', 'Demo Bookings')

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
            <h2><i class="fas fa-calendar-check me-2 text-primary"></i>Demo Bookings Management</h2>
            <a href="{{ route('admin.demo-bookings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Booking
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Demo Bookings</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Preferred Date</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demoBookings as $booking)
                            <tr>
                                <td class="ps-4">{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone ?? 'N/A' }}</td>
                                <td>
                                    @if($booking->course)
                                        <span class="badge bg-info">{{ $booking->course->title }}</span>
                                    @else
                                        <span class="text-muted">General inquiry</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->preferred_date)
                                        {{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}
                                        @if($booking->preferred_time)
                                            <br><small class="text-muted">{{ $booking->preferred_time }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($booking->status)
                                        @case('pending')
                                            <span class="badge bg-warning">Pending</span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge bg-info">Confirmed</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">Completed</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.demo-bookings.show', $booking) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.demo-bookings.edit', $booking) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.demo-bookings.destroy', $booking) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this booking?')">
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
                                        <h5 class="text-muted">No demo bookings found</h5>
                                        <p class="text-muted mb-3">Start by creating your first booking</p>
                                        <a href="{{ route('admin.demo-bookings.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Add First Booking
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($demoBookings->hasPages())
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-center">
                            {{ $demoBookings->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
