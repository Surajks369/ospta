@extends('admin.layouts.app')

@section('title', 'Edit Course Enrollment')

@section('content')
<div class="admin-wrapper">
     @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-edit me-2 text-primary"></i>Edit Course Enrollment</h2>
            <a href="{{ route('admin.course-enrollments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Enrollments
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Course Enrollment Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.course-enrollments.update', $courseEnrollment) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('user_registration_id') is-invalid @enderror" id="user_registration_id" name="user_registration_id" required aria-label="Select User">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $courseEnrollment->user_registration_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
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
                                        <option value="{{ $course->id }}" {{ $courseEnrollment->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
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
                                <label for="enrollment_date" class="form-label">Enrollment Date</label>
                                <input type="date" class="form-control @error('enrollment_date') is-invalid @enderror" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date', $courseEnrollment->enrollment_date) }}">
                                @error('enrollment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount_paid" class="form-label">Amount Paid</label>
                                <input type="number" class="form-control @error('amount_paid') is-invalid @enderror" id="amount_paid" name="amount_paid" value="{{ old('amount_paid', $courseEnrollment->amount_paid) }}" min="0" step="0.01">
                                @error('amount_paid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="pending" {{ $courseEnrollment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ $courseEnrollment->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ $courseEnrollment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $courseEnrollment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <input type="text" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" value="{{ old('payment_method', $courseEnrollment->payment_method) }}">
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_reference" class="form-label">Payment Reference</label>
                                <input type="text" class="form-control @error('payment_reference') is-invalid @enderror" id="payment_reference" name="payment_reference" value="{{ old('payment_reference', $courseEnrollment->payment_reference) }}">
                                @error('payment_reference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status">
                                    <option value="pending" {{ $courseEnrollment->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $courseEnrollment->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ $courseEnrollment->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="refunded" {{ $courseEnrollment->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                @error('payment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="enrollment_status" class="form-label">Enrollment Status</label>
                                <select class="form-control @error('enrollment_status') is-invalid @enderror" id="enrollment_status" name="enrollment_status">
                                    <option value="active" {{ $courseEnrollment->enrollment_status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ $courseEnrollment->enrollment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $courseEnrollment->enrollment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="suspended" {{ $courseEnrollment->enrollment_status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                                @error('enrollment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $courseEnrollment->start_date) }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $courseEnrollment->end_date) }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="progress_percentage" class="form-label">Progress (%)</label>
                        <input type="number" class="form-control @error('progress_percentage') is-invalid @enderror" id="progress_percentage" name="progress_percentage" value="{{ old('progress_percentage', $courseEnrollment->progress_percentage) }}" min="0" max="100">
                        @error('progress_percentage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes', $courseEnrollment->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Enrollment
                        </button>
                        <a href="{{ route('admin.course-enrollments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
