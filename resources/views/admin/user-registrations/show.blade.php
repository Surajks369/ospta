@extends('admin.layouts.app')

@section('title', 'User Registration Details')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>User Registration Details</h2>
            <a href="{{ route('admin.user-registrations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Registrations
            </a>
        </div>
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>User Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-5 text-center">
                        @if($userRegistration->image)
                            <img src="{{ asset('storage/' . $userRegistration->image) }}" alt="Profile Image" class="img-thumbnail rounded mb-2" style="max-width: 180px; max-height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 180px; height: 180px;">
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h4 class="fw-bold mb-3">{{ $userRegistration->name }}</h4>
                        <p class="mb-2"><strong>Email:</strong> {{ $userRegistration->email }}</p>
                        <p class="mb-2"><strong>Phone:</strong> {{ $userRegistration->phone ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Date of Birth:</strong> {{ $userRegistration->date_of_birth ? $userRegistration->date_of_birth->format('M d, Y') : 'N/A' }}</p>
                        <p class="mb-2"><strong>Gender:</strong> {{ ucfirst($userRegistration->gender ?? 'N/A') }}</p>
                        <p class="mb-2"><strong>Qualification:</strong> {{ $userRegistration->qualification ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Address:</strong> {{ $userRegistration->address ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>City:</strong> {{ $userRegistration->city ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>State:</strong> {{ $userRegistration->state ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Pincode:</strong> {{ $userRegistration->pincode ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Course Interest:</strong> {{ $userRegistration->course_interest ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Notes:</strong> {{ $userRegistration->notes ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Status:</strong> <span class="badge bg-{{ $userRegistration->status == 'approved' ? 'success' : ($userRegistration->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($userRegistration->status) }}</span></p>
                        <p class="mb-2"><strong>Created At:</strong> {{ $userRegistration->created_at->format('M d, Y') }}</p>
                        <p class="mb-2"><strong>Updated At:</strong> {{ $userRegistration->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
