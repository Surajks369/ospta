@include('partials.header')

<main>
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(135deg, #423F8D 0%, #7B3F98 100%); padding: 120px 0 80px; position: relative; overflow: hidden;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 style="color: white; font-family: 'Fredoka One', cursive; font-size: 3.5rem; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Join Our Learning Community
                    </h1>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.3rem; margin-bottom: 0; line-height: 1.6;">
                        Start your educational journey with us today! Choose between demo sessions or full course enrollment.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div style="position: absolute; top: 20%; right: 10%; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
        <div style="position: absolute; bottom: 20%; left: 10%; width: 60px; height: 60px; background: rgba(237,7,139,0.3); border-radius: 50%; animation: float 4s ease-in-out infinite reverse;"></div>
    </section>

    <!-- Registration Form Section -->
    <section style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div style="background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.1); padding: 40px; margin-bottom: 40px;">
                        <div class="text-center mb-5">
                            <h2 style="color: #423F8D; font-family: 'Fredoka One', cursive; font-size: 2.5rem; margin-bottom: 15px;">
                                Registration Form
                            </h2>
                            <p style="color: #666; font-size: 1.1rem; margin-bottom: 0;">
                                Fill out the form below to get started with your learning journey
                            </p>
                        </div>

                        @if(session('success'))
                            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #c3e6cb;">
                                <i class="fas fa-check-circle" style="margin-right: 10px;"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #f5c6cb;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('join.submit') }}" method="POST" id="registrationForm">
                            @csrf
                            
                            <!-- Registration Type Selection -->
                            <div class="mb-4">
                                <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 10px; font-size: 1.1rem;">
                                    Registration Type <span style="color: #ED078B;">*</span>
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="registration-type-card" style="border: 2px solid #e9ecef; border-radius: 15px; padding: 20px; cursor: pointer; transition: all 0.3s ease; margin-bottom: 15px;" onclick="selectRegistrationType('demo')">
                                            <input type="radio" name="registration_type" value="demo" id="demo_booking" style="margin-right: 10px;" required>
                                            <label for="demo_booking" style="cursor: pointer; margin: 0;">
                                                <strong style="color: #423F8D; display: block; font-size: 1.2rem; margin-bottom: 5px;">Demo Booking</strong>
                                                <small style="color: #666;">Book a free demo session to explore our courses</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="registration-type-card" style="border: 2px solid #e9ecef; border-radius: 15px; padding: 20px; cursor: pointer; transition: all 0.3s ease; margin-bottom: 15px;" onclick="selectRegistrationType('enrollment')">
                                            <input type="radio" name="registration_type" value="enrollment" id="course_enrollment" style="margin-right: 10px;" required>
                                            <label for="course_enrollment" style="cursor: pointer; margin: 0;">
                                                <strong style="color: #423F8D; display: block; font-size: 1.2rem; margin-bottom: 5px;">Course Enrollment</strong>
                                                <small style="color: #666;">Enroll directly in a full course program</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                        Full Name <span style="color: #ED078B;">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                           onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                        Email Address <span style="color: #ED078B;">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                           onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                        Phone Number <span style="color: #ED078B;">*</span>
                                    </label>
                                    <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                           onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                        Course <span style="color: #ED078B;">*</span>
                                    </label>
                                    <select name="course_id" class="form-control" required
                                            style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease; background: white;"
                                            onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                        <option value="">Select a course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Demo Booking Specific Fields -->
                            <div id="demoFields" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            Preferred Date
                                        </label>
                                        <input type="date" name="preferred_date" class="form-control" value="{{ old('preferred_date') }}"
                                               style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                               onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            Preferred Time
                                        </label>
                                        <select name="preferred_time" class="form-control"
                                                style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease; background: white;"
                                                onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                            <option value="">Select time</option>
                                            <option value="09:00 AM" {{ old('preferred_time') == '09:00 AM' ? 'selected' : '' }}>09:00 AM</option>
                                            <option value="10:00 AM" {{ old('preferred_time') == '10:00 AM' ? 'selected' : '' }}>10:00 AM</option>
                                            <option value="11:00 AM" {{ old('preferred_time') == '11:00 AM' ? 'selected' : '' }}>11:00 AM</option>
                                            <option value="02:00 PM" {{ old('preferred_time') == '02:00 PM' ? 'selected' : '' }}>02:00 PM</option>
                                            <option value="03:00 PM" {{ old('preferred_time') == '03:00 PM' ? 'selected' : '' }}>03:00 PM</option>
                                            <option value="04:00 PM" {{ old('preferred_time') == '04:00 PM' ? 'selected' : '' }}>04:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Enrollment Specific Fields -->
                            <div id="enrollmentFields" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            Date of Birth
                                        </label>
                                        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}"
                                               style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                               onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            Gender
                                        </label>
                                        <select name="gender" class="form-control"
                                                style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease; background: white;"
                                                onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                            <option value="">Select gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                        Address
                                    </label>
                                    <textarea name="address" class="form-control" rows="3"
                                              style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease; resize: vertical;"
                                              onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">{{ old('address') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            City
                                        </label>
                                        <input type="text" name="city" class="form-control" value="{{ old('city') }}"
                                               style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                               onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            State
                                        </label>
                                        <input type="text" name="state" class="form-control" value="{{ old('state') }}"
                                               style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                               onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                            Pincode
                                        </label>
                                        <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}"
                                               style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                               onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                        Qualification
                                    </label>
                                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}"
                                           style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease;"
                                           onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">
                                </div>
                            </div>

                            <!-- Common Message Field -->
                            <div class="mb-4">
                                <label style="display: block; color: #423F8D; font-weight: 600; margin-bottom: 8px;">
                                    Additional Message
                                </label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Tell us more about your learning goals or any specific requirements..."
                                          style="border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 15px; font-size: 1rem; transition: border-color 0.3s ease; resize: vertical;"
                                          onfocus="this.style.borderColor='#ED078B'" onblur="this.style.borderColor='#e9ecef'">{{ old('message') }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn" id="submitBtn" disabled
                                        style="background: linear-gradient(45deg, #ED078B, #423F8D); color: white; border: none; padding: 15px 40px; border-radius: 50px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(237,7,139,0.3);"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 35px rgba(237,7,139,0.4)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 25px rgba(237,7,139,0.3)'">
                                    <i class="fas fa-paper-plane" style="margin-right: 10px;"></i>
                                    Submit Registration
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section style="padding: 80px 0; background: white;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="color: #423F8D; font-family: 'Fredoka One', cursive; font-size: 2.5rem; margin-bottom: 15px;">
                    Why Choose Our Learning Platform?
                </h2>
                <p style="color: #666; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                    Join thousands of successful students who have transformed their careers with our expert-led courses
                </p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div style="text-align: center; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #ED078B, #423F8D); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-graduation-cap" style="color: white; font-size: 2rem;"></i>
                        </div>
                        <h4 style="color: #423F8D; font-weight: 600; margin-bottom: 15px;">Expert Instructors</h4>
                        <p style="color: #666; line-height: 1.6;">Learn from industry professionals with years of real-world experience</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div style="text-align: center; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #ED078B, #423F8D); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-clock" style="color: white; font-size: 2rem;"></i>
                        </div>
                        <h4 style="color: #423F8D; font-weight: 600; margin-bottom: 15px;">Flexible Schedule</h4>
                        <p style="color: #666; line-height: 1.6;">Study at your own pace with flexible timing options that fit your lifestyle</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div style="text-align: center; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; transition: transform 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #ED078B, #423F8D); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-certificate" style="color: white; font-size: 2rem;"></i>
                        </div>
                        <h4 style="color: #423F8D; font-weight: 600; margin-bottom: 15px;">Certification</h4>
                        <p style="color: #666; line-height: 1.6;">Earn recognized certificates upon course completion to boost your career</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .registration-type-card:hover {
        border-color: #ED078B !important;
        background: rgba(237,7,139,0.05) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(237,7,139,0.15);
    }

    .registration-type-card.selected {
        border-color: #ED078B !important;
        background: rgba(237,7,139,0.1) !important;
        box-shadow: 0 8px 25px rgba(237,7,139,0.2);
    }

    .form-control:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(237,7,139,0.2);
    }

    #submitBtn:disabled {
        background: #ccc !important;
        cursor: not-allowed !important;
        transform: none !important;
        box-shadow: none !important;
    }
</style>

<script>
    function selectRegistrationType(type) {
        // Update radio selection
        document.getElementById(type === 'demo' ? 'demo_booking' : 'course_enrollment').checked = true;
        
        // Update visual selection
        document.querySelectorAll('.registration-type-card').forEach(card => {
            card.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        // Show/hide relevant fields
        const demoFields = document.getElementById('demoFields');
        const enrollmentFields = document.getElementById('enrollmentFields');
        const submitBtn = document.getElementById('submitBtn');
        
        if (type === 'demo') {
            demoFields.style.display = 'block';
            enrollmentFields.style.display = 'none';
        } else {
            demoFields.style.display = 'none';
            enrollmentFields.style.display = 'block';
        }
        
        // Enable submit button
        submitBtn.disabled = false;
        submitBtn.style.background = 'linear-gradient(45deg, #ED078B, #423F8D)';
        submitBtn.style.cursor = 'pointer';
    }

    // Handle radio button changes
    document.querySelectorAll('input[name="registration_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                selectRegistrationType(this.value);
            }
        });
    });

    // Restore selection on page load (for form validation errors)
    document.addEventListener('DOMContentLoaded', function() {
        const selectedType = document.querySelector('input[name="registration_type"]:checked');
        if (selectedType) {
            // Find the parent card and trigger selection
            const card = selectedType.closest('.registration-type-card');
            if (card) {
                selectRegistrationType(selectedType.value);
                card.classList.add('selected');
            }
        }
    });
</script>

@include('partials.footer')