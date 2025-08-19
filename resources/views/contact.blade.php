@include('partials.header')
    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2 d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s" style="color: #423F8D; font-weight: 700;">Contact Us</h1>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #ED078B;">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page" style="color: #423F8D;">Contact</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!-- slider Area End-->

        <!--? Contact form Start -->
        <section class="contact-section">
            <div class="container">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); color: #155724;">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 15px; border: none; background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); color: #721c24;">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title text-center mb-5" style="color: #423F8D; font-weight: 700; font-size: 2.5rem;">Get In Touch</h2>
                        <p class="text-center text-muted mb-5" style="font-size: 1.1rem;">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 shadow-lg" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                            <div class="card-body p-5">
                                <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="name" class="form-label" style="color: #423F8D; font-weight: 600;">Full Name <span style="color: #ED078B;">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name') }}"
                                                   style="border-radius: 15px; border: 2px solid #e9ecef; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;"
                                                   placeholder="Enter your full name"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="email" class="form-label" style="color: #423F8D; font-weight: 600;">Email Address <span style="color: #ED078B;">*</span></label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email') }}"
                                                   style="border-radius: 15px; border: 2px solid #e9ecef; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;"
                                                   placeholder="Enter your email address"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="phone" class="form-label" style="color: #423F8D; font-weight: 600;">Phone Number</label>
                                            <input type="tel" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="{{ old('phone') }}"
                                                   style="border-radius: 15px; border: 2px solid #e9ecef; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;"
                                                   placeholder="Enter your phone number">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="subject" class="form-label" style="color: #423F8D; font-weight: 600;">Subject <span style="color: #ED078B;">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('subject') is-invalid @enderror" 
                                                   id="subject" 
                                                   name="subject" 
                                                   value="{{ old('subject') }}"
                                                   style="border-radius: 15px; border: 2px solid #e9ecef; padding: 12px 15px; font-size: 16px; transition: all 0.3s ease;"
                                                   placeholder="Enter subject"
                                                   required>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="message" class="form-label" style="color: #423F8D; font-weight: 600;">Message <span style="color: #ED078B;">*</span></label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  id="message" 
                                                  name="message" 
                                                  rows="6" 
                                                  style="border-radius: 15px; border: 2px solid #e9ecef; padding: 15px; font-size: 16px; transition: all 0.3s ease; resize: vertical;"
                                                  placeholder="Enter your message here..."
                                                  required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" 
                                                class="btn btn-primary btn-lg" 
                                                style="background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%); border: none; border-radius: 25px; padding: 15px 40px; font-weight: 600; font-size: 16px; color: white; transition: all 0.3s ease;">
                                            <i class="fas fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info Cards -->
                <div class="row mt-5">
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm text-center" style="border-radius: 20px; transition: all 0.3s ease;">
                            <div class="card-body py-5">
                                <div class="mb-4">
                                    <i class="fas fa-map-marker-alt fa-3x" style="color: #ED078B;"></i>
                                </div>
                                <h5 style="color: #423F8D; font-weight: 700; margin-bottom: 15px;">Visit Us</h5>
                                <p class="text-muted mb-0">57/A, Green Lane, NYC<br>New York, USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm text-center" style="border-radius: 20px; transition: all 0.3s ease;">
                            <div class="card-body py-5">
                                <div class="mb-4">
                                    <i class="fas fa-phone fa-3x" style="color: #ED078B;"></i>
                                </div>
                                <h5 style="color: #423F8D; font-weight: 700; margin-bottom: 15px;">Call Us</h5>
                                <p class="text-muted mb-0">
                                    <a href="tel:+10783673692" style="color: #6c757d; text-decoration: none;">+10 (78) 367 3692</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm text-center" style="border-radius: 20px; transition: all 0.3s ease;">
                            <div class="card-body py-5">
                                <div class="mb-4">
                                    <i class="fas fa-envelope fa-3x" style="color: #ED078B;"></i>
                                </div>
                                <h5 style="color: #423F8D; font-weight: 700; margin-bottom: 15px;">Email Us</h5>
                                <p class="text-muted mb-0">
                                    <a href="mailto:info@ospta.com" style="color: #6c757d; text-decoration: none;">info@ospta.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--? Contact form End -->
    </main>

    <!-- Custom Styles for Contact -->
    <style>
    .contact-form .form-control:focus {
        border-color: #ED078B;
        box-shadow: 0 0 0 0.2rem rgba(237, 7, 139, 0.25);
    }

    .contact-form .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(237, 7, 139, 0.3);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }

    @media (max-width: 768px) {
        .contact-title {
            font-size: 2rem !important;
        }
        
        .card-body {
            padding: 2rem !important;
        }
    }
    </style>
@include('partials.footer')