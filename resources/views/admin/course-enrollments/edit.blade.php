@extends('admin.layouts.app')

@section('title', 'Edit Course Enrollment')

@section('content')
<style>
    .form-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 1.5rem 2rem;
        border-radius: 15px 15px 0 0;
        color: white;
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
    .form-floating > label {
        padding: 1rem 1rem;
        color: #718096;
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
    }
    .btn-back:hover {
        background: #fef3c7;
        color: #d97706;
    }
</style>

<div class="admin-wrapper">
     @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-edit me-3"></i>Edit Course Enrollment</h2>
            <a href="{{ route('admin.course-enrollments.index') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
        <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <div class="form-header">
                <h5 class="mb-0"><i class="fas fa-pen-to-square me-2"></i>Update Enrollment Information</h5>
            </div>
            <div class="card-body" style="padding: 2rem; background: #f8f9fa;">
                <form action="{{ route('admin.course-enrollments.update', $courseEnrollment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Student Information -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-user-circle"></i>Student Information
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="hidden" name="user_registration_id" value="{{ $courseEnrollment->user_registration_id }}">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $courseEnrollment->name ?? ($courseEnrollment->userRegistration ? $courseEnrollment->userRegistration->name : '')) }}" placeholder="Student Name" required>
                                    <label for="name">Student Name <span class="text-danger">*</span></label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                    <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $courseEnrollment->email) }}" placeholder="student@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $courseEnrollment->phone) }}" placeholder="+1234567890">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label"><i class="fas fa-birthday-cake me-2"></i>Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $courseEnrollment->date_of_birth ? \Carbon\Carbon::parse($courseEnrollment->date_of_birth)->format('Y-m-d') : '') }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $courseEnrollment->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $courseEnrollment->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $courseEnrollment->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="qualification" class="form-label"><i class="fas fa-graduation-cap me-2"></i>Qualification</label>
                                    <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" value="{{ old('qualification', $courseEnrollment->qualification) }}" placeholder="e.g., High School, Bachelor's">
                                    @error('qualification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-map-marker-alt"></i>Address Information
                        </div>
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label"><i class="fas fa-home me-2"></i>Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="Street address">{{ old('address', $courseEnrollment->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label"><i class="fas fa-city me-2"></i>City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $courseEnrollment->city) }}" placeholder="City">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="state" class="form-label"><i class="fas fa-map me-2"></i>State</label>
                                    <select class="form-control @error('state') is-invalid @enderror" id="state" name="state">
                                        <option value="">Select State</option>
                                        <option value="Andhra Pradesh" {{ old('state', $courseEnrollment->state) == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh" {{ old('state', $courseEnrollment->state) == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal Pradesh</option>
                                        <option value="Assam" {{ old('state', $courseEnrollment->state) == 'Assam' ? 'selected' : '' }}>Assam</option>
                                        <option value="Bihar" {{ old('state', $courseEnrollment->state) == 'Bihar' ? 'selected' : '' }}>Bihar</option>
                                        <option value="Chhattisgarh" {{ old('state', $courseEnrollment->state) == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh</option>
                                        <option value="Goa" {{ old('state', $courseEnrollment->state) == 'Goa' ? 'selected' : '' }}>Goa</option>
                                        <option value="Gujarat" {{ old('state', $courseEnrollment->state) == 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                        <option value="Haryana" {{ old('state', $courseEnrollment->state) == 'Haryana' ? 'selected' : '' }}>Haryana</option>
                                        <option value="Himachal Pradesh" {{ old('state', $courseEnrollment->state) == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal Pradesh</option>
                                        <option value="Jharkhand" {{ old('state', $courseEnrollment->state) == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                        <option value="Karnataka" {{ old('state', $courseEnrollment->state) == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                        <option value="Kerala" {{ old('state', $courseEnrollment->state) == 'Kerala' ? 'selected' : '' }}>Kerala</option>
                                        <option value="Madhya Pradesh" {{ old('state', $courseEnrollment->state) == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh</option>
                                        <option value="Maharashtra" {{ old('state', $courseEnrollment->state) == 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                        <option value="Manipur" {{ old('state', $courseEnrollment->state) == 'Manipur' ? 'selected' : '' }}>Manipur</option>
                                        <option value="Meghalaya" {{ old('state', $courseEnrollment->state) == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                        <option value="Mizoram" {{ old('state', $courseEnrollment->state) == 'Mizoram' ? 'selected' : '' }}>Mizoram</option>
                                        <option value="Nagaland" {{ old('state', $courseEnrollment->state) == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                        <option value="Odisha" {{ old('state', $courseEnrollment->state) == 'Odisha' ? 'selected' : '' }}>Odisha</option>
                                        <option value="Punjab" {{ old('state', $courseEnrollment->state) == 'Punjab' ? 'selected' : '' }}>Punjab</option>
                                        <option value="Rajasthan" {{ old('state', $courseEnrollment->state) == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                        <option value="Sikkim" {{ old('state', $courseEnrollment->state) == 'Sikkim' ? 'selected' : '' }}>Sikkim</option>
                                        <option value="Tamil Nadu" {{ old('state', $courseEnrollment->state) == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu</option>
                                        <option value="Telangana" {{ old('state', $courseEnrollment->state) == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                        <option value="Tripura" {{ old('state', $courseEnrollment->state) == 'Tripura' ? 'selected' : '' }}>Tripura</option>
                                        <option value="Uttar Pradesh" {{ old('state', $courseEnrollment->state) == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh</option>
                                        <option value="Uttarakhand" {{ old('state', $courseEnrollment->state) == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand</option>
                                        <option value="West Bengal" {{ old('state', $courseEnrollment->state) == 'West Bengal' ? 'selected' : '' }}>West Bengal</option>
                                        <option value="Andaman and Nicobar Islands" {{ old('state', $courseEnrollment->state) == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>Andaman and Nicobar Islands</option>
                                        <option value="Chandigarh" {{ old('state', $courseEnrollment->state) == 'Chandigarh' ? 'selected' : '' }}>Chandigarh</option>
                                        <option value="Dadra and Nagar Haveli and Daman and Diu" {{ old('state', $courseEnrollment->state) == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>Dadra and Nagar Haveli and Daman and Diu</option>
                                        <option value="Delhi" {{ old('state', $courseEnrollment->state) == 'Delhi' ? 'selected' : '' }}>Delhi</option>
                                        <option value="Jammu and Kashmir" {{ old('state', $courseEnrollment->state) == 'Jammu and Kashmir' ? 'selected' : '' }}>Jammu and Kashmir</option>
                                        <option value="Ladakh" {{ old('state', $courseEnrollment->state) == 'Ladakh' ? 'selected' : '' }}>Ladakh</option>
                                        <option value="Lakshadweep" {{ old('state', $courseEnrollment->state) == 'Lakshadweep' ? 'selected' : '' }}>Lakshadweep</option>
                                        <option value="Puducherry" {{ old('state', $courseEnrollment->state) == 'Puducherry' ? 'selected' : '' }}>Puducherry</option>
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pincode" class="form-label"><i class="fas fa-mail-bulk me-2"></i>Pincode</label>
                                    <input type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" value="{{ old('pincode', $courseEnrollment->pincode) }}" placeholder="Pincode">
                                    @error('pincode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- School Details -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-school"></i>School Details
                        </div>
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="current_school" class="form-label"><i class="fas fa-building me-2"></i>Current School Name</label>
                                    <input type="text" class="form-control @error('current_school') is-invalid @enderror" id="current_school" name="current_school" value="{{ old('current_school', $courseEnrollment->current_school) }}" placeholder="School Name">
                                    @error('current_school')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="school_grade" class="form-label"><i class="fas fa-layer-group me-2"></i>Grade/Class</label>
                                    <input type="text" class="form-control @error('school_grade') is-invalid @enderror" id="school_grade" name="school_grade" value="{{ old('school_grade', $courseEnrollment->school_grade) }}" placeholder="e.g., Grade 10">
                                    @error('school_grade')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="school_board" class="form-label"><i class="fas fa-book-reader me-2"></i>School Board</label>
                                    <input type="text" class="form-control @error('school_board') is-invalid @enderror" id="school_board" name="school_board" value="{{ old('school_board', $courseEnrollment->school_board) }}" placeholder="e.g., CBSE, State Board">
                                    @error('school_board')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parent/Guardian Details -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-users"></i>Parent/Guardian Details
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_name" class="form-label"><i class="fas fa-user-tie me-2"></i>Parent Name</label>
                                    <input type="text" class="form-control @error('parent_name') is-invalid @enderror" id="parent_name" name="parent_name" value="{{ old('parent_name', $courseEnrollment->parent_name) }}" placeholder="Parent/Guardian Name">
                                    @error('parent_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_phone" class="form-label"><i class="fas fa-phone-alt me-2"></i>Parent Phone</label>
                                    <input type="text" class="form-control @error('parent_phone') is-invalid @enderror" id="parent_phone" name="parent_phone" value="{{ old('parent_phone', $courseEnrollment->parent_phone) }}" placeholder="+1234567890">
                                    @error('parent_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_email" class="form-label"><i class="fas fa-envelope me-2"></i>Parent Email</label>
                                    <input type="email" class="form-control @error('parent_email') is-invalid @enderror" id="parent_email" name="parent_email" value="{{ old('parent_email', $courseEnrollment->parent_email) }}" placeholder="parent@example.com">
                                    @error('parent_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_occupation" class="form-label"><i class="fas fa-briefcase me-2"></i>Parent Occupation</label>
                                    <input type="text" class="form-control @error('parent_occupation') is-invalid @enderror" id="parent_occupation" name="parent_occupation" value="{{ old('parent_occupation', $courseEnrollment->parent_occupation) }}" placeholder="Occupation">
                                    @error('parent_occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Details -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-calendar-alt"></i>Enrollment Details
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="enrollment_date" class="form-label"><i class="fas fa-calendar-check me-2"></i>Enrollment Date</label>
                                    <input type="date" class="form-control @error('enrollment_date') is-invalid @enderror" id="enrollment_date" name="enrollment_date" value="{{ old('enrollment_date', $courseEnrollment->enrollment_date ? \Carbon\Carbon::parse($courseEnrollment->enrollment_date)->format('Y-m-d') : '') }}">
                                    @error('enrollment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount_paid" class="form-label"><span class="me-2">&#8377;</span>Amount Paid</label>
                                    <input type="number" class="form-control @error('amount_paid') is-invalid @enderror" id="amount_paid" name="amount_paid" value="{{ old('amount_paid', $courseEnrollment->amount_paid) }}" min="0" step="0.01">
                                    @error('amount_paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-credit-card"></i>Payment Information
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method</label>
                                    <input type="text" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" value="{{ old('payment_method', $courseEnrollment->payment_method) }}" placeholder="e.g., Credit Card, Cash">
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_reference" class="form-label">Payment Reference</label>
                                    <input type="text" class="form-control @error('payment_reference') is-invalid @enderror" id="payment_reference" name="payment_reference" value="{{ old('payment_reference', $courseEnrollment->payment_reference) }}" placeholder="Transaction ID or Reference">
                                    @error('payment_reference')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
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
                                        <option value="inactive" {{ old('enrollment_status', $courseEnrollment->enrollment_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="active" {{ old('enrollment_status', $courseEnrollment->enrollment_status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="completed" {{ old('enrollment_status', $courseEnrollment->enrollment_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('enrollment_status', $courseEnrollment->enrollment_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="suspended" {{ old('enrollment_status', $courseEnrollment->enrollment_status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                    </select>
                                    @error('enrollment_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Dates & Progress -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-calendar-week"></i>Course Dates & Progress
                        </div>
                        <div class="row g-4">
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

                    <!-- Additional Notes -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-sticky-note"></i>Additional Notes
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="4" placeholder="Enter any additional notes or comments...">{{ old('notes', $courseEnrollment->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex gap-3 justify-content-end" style="padding: 1rem 2rem;">
                        <a href="{{ route('admin.course-enrollments.index') }}" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Update Enrollment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
