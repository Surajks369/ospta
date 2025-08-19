@extends('admin.layouts.app')

@section('title', 'Create Demo Booking')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-calendar-plus me-2 text-primary"></i>Create Demo Booking</h2>
            <a href="{{ route('admin.demo-bookings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Bookings
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Demo Booking Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.demo-bookings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('user_registration_id') is-invalid @enderror" id="user_registration_id" name="user_registration_id" required aria-label="Select User">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_registration_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                <label for="user_registration_id">User <span class="text-danger">*</span></label>
                                @error('user_registration_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required aria-label="Select Course">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <label for="course_id">Course <span class="text-danger">*</span></label>
                                @error('course_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="preferred_date" class="form-label">Preferred Date</label>
                                <input type="date" class="form-control @error('preferred_date') is-invalid @enderror" id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}">
                                @error('preferred_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="preferred_time" class="form-label">Preferred Time</label>
                                <input type="time" class="form-control @error('preferred_time') is-invalid @enderror" id="preferred_time" name="preferred_time" value="{{ old('preferred_time') }}">
                                @error('preferred_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Book Demo
                        </button>
                        <a href="{{ route('admin.demo-bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
