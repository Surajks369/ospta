@extends('admin.layouts.app')

@section('title', 'Edit Demo Booking')

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
    .form-section {
        background: white;
        padding: 2rem;
        margin-bottom: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }
    .section-title {
        font-size: 1.1rem;
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
    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }
    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    .btn-submit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(245, 158, 11, 0.4);
        color: white;
    }
    .btn-cancel {
        background: #e2e8f0;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        color: #4a5568;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-cancel:hover {
        background: #cbd5e0;
        color: #2d3748;
    }
</style>

<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-edit me-2"></i>Edit Demo Booking</h2>
                <a href="{{ route('admin.demo-bookings.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>

        <div class="form-section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i>Booking Information
            </div>
            <form action="{{ route('admin.demo-bookings.update', $demoBooking) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Course Section -->
                <div class="mb-4">
                    <label for="course_id" class="form-label"><i class="fas fa-book me-1"></i>Course</label>
                    <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id">
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $demoBooking->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contact Information Section -->
                <div class="section-title mt-4">
                    <i class="fas fa-user"></i>Contact Information
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $demoBooking->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $demoBooking->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $demoBooking->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- School Information Section -->
                <div class="section-title mt-4">
                    <i class="fas fa-school me-1"></i>School Information
                </div>

                <div class="mb-3">
                    <label for="school_name" class="form-label">School Name</label>
                    <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="school_name" name="school_name" value="{{ old('school_name', $demoBooking->school_name) }}">
                    @error('school_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="school_address" class="form-label">School Address</label>
                    <textarea class="form-control @error('school_address') is-invalid @enderror" id="school_address" name="school_address" rows="2">{{ old('school_address', $demoBooking->school_address) }}</textarea>
                    @error('school_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person', $demoBooking->contact_person) }}">
                        @error('contact_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="contact_designation" class="form-label">Designation</label>
                        <input type="text" class="form-control @error('contact_designation') is-invalid @enderror" id="contact_designation" name="contact_designation" value="{{ old('contact_designation', $demoBooking->contact_designation) }}">
                        @error('contact_designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label for="contact_phone" class="form-label">Contact Phone</label>
                        <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $demoBooking->contact_phone) }}">
                        @error('contact_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email', $demoBooking->contact_email) }}">
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Demo Information Section -->
                <div class="section-title mt-4">
                    <i class="fas fa-calendar-alt me-1"></i>Demo Details
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="preferred_date" class="form-label">Preferred Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('preferred_date') is-invalid @enderror" id="preferred_date" name="preferred_date" value="{{ old('preferred_date', $demoBooking->preferred_date?->format('Y-m-d')) }}" required>
                        @error('preferred_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="preferred_time" class="form-label">Preferred Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('preferred_time') is-invalid @enderror" id="preferred_time" name="preferred_time" value="{{ old('preferred_time', $demoBooking->preferred_time) }}" required>
                        @error('preferred_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message', $demoBooking->message) }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Section -->
                <div class="section-title mt-4">
                    <i class="fas fa-cog me-1"></i>Admin Settings
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status', $demoBooking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $demoBooking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status', $demoBooking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $demoBooking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="admin_notes" class="form-label">Admin Notes</label>
                    <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes', $demoBooking->admin_notes) }}</textarea>
                    @error('admin_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i>Update Booking
                    </button>
                    <a href="{{ route('admin.demo-bookings.index') }}" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection