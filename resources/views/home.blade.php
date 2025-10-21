    @include('partials.header')
    <main>
        <!--? slider Area Start-->
        <section class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-10 col-sm-11">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s">Quality<br> Learning</h1>
                                    <span data-animation="fadeInLeft" data-delay="0.4s">For Every Child</span>
                                    <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Explore Classes</a>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!-- End Slider -->
        <!--? About Area Start -->
        <div class="about-low-area section-padding40">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-11">
                        <div class="section-tittle text-center mb-70">
                            <h2>Welcome to our <span>Kindergarten</span></h2>
                            <p>Our set he for firmament morning sixth subdue today the darkness creeping gathered divide our let god moving today. Moving in fourth air night bring upon lesser subdue fowl male signs.</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <div class="about-caption">
                            <div class="single-features mb-30">
                                <div class="features-icon">
                                    <img src="{{ asset('assets/img/icon/about-icon1.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <h3 class="color-font1">Inter School Sports</h3>
                                    <p>The words you use in your written communica speak volumes.</p>
                                </div>
                            </div>
                            <div class="single-features mb-30">
                                <div class="features-icon">
                                    <img src="{{ asset('assets/img/icon/about-icon2.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <h3 class="color-font2">Friendly Environment</h3>
                                    <p>The words you use in your written communica speak volumes.</p>
                                </div>
                            </div>
                            
                            <div class="single-features mb-30">
                                <div class="features-icon">
                                    <img src="{{ asset('assets/img/icon/about-icon3.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <h3 class="color-font3">Multimedia Class</h3>
                                    <p>The words you use in your written communica speak volumes.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <!-- about-img -->
                        <div class="about-img ">
                            <img src="assets/img/gallery/about2.png" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Area End -->
        <!--? Class-offer-area Start -->
        <div class="class-offer-area section-bg2 section-padding40 " data-background="assets/img/gallery/section_bg1.png">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-11">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-80">
                            <h2>Classes We Offer</h2>
                            <p>Our set he for firmament morning sixth subdue today the darkness creeping gathered divide our let god moving today. Moving in fourth air night bring upon lesser subdue.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <!-- Single -->
                        <div class="properties pb-30">
                            <div class="properties__card">
                                <div class="properties__img">
                                    <a href="{{ route('course.details', $course->id) }}">
                                        @if($course->image)
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/gallery/class-img1.png') }}" alt="{{ $course->title }}">
                                        @endif
                                    </a>
                                    <div class="img-text">
                                        <span class="open">{{ $course->status ? 'Open' : 'Admission Closed' }}</span>
                                    </div>
                                </div>
                                <div class="properties__caption">
                                    <h3><a href="{{ route('course.details', $course->id) }}">{{ $course->title }}</a></h3>
                                    <p>{{ Str::limit($course->description, 80) }}</p>
                                </div>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="class-day">
                                        <span class="color-font4">{{ $course->category->name ?? 'General' }}</span>
                                        <p>Category</p>
                                    </div>
                                    <div class="class-day">
                                        <span class="color-font2">{{ $course->duration ?? 'N/A' }}</span>
                                        <p>Duration</p>
                                    </div>
                                    <div class="class-day">
                                        <span class="color-font1">{{ $course->price ? number_format($course->price, 0) : 'Free' }}</span>
                                        <p>Price</p>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('course.details', $course->id) }}" class="border-btn">View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="browse-all text-center mt-30">
                            <a href="/courses" class="border-btn">More Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Class-offer-area End -->
        <!--? Date Count Start -->
        @if($activeOffer)
        <div class="date-events section-bg2 section-padding40" data-background="assets/img/gallery/section_bg2.png">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-9">
                        <div class="date-wrapper">
                            <div class="section-tittle text-center mb-30">
                                <span class="span">{{ \Carbon\Carbon::parse($activeOffer->end_date)->format('d M Y') }}</span>
                                <h2>{{ $activeOffer->title }}</h2>
                                <p>{{ $activeOffer->description }}</p>
                                <a href="#" class="btn mt-10">View Offer</a>
                            </div>
                            <!-- Timer -->
                            <div class="cd-timer" id="countdown">
                               <!-- Countdown will be rendered here by JS -->
                            </div>
                            <!-- /End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var endDate = "{{ \Carbon\Carbon::parse($activeOffer->end_date)->format('Y/m/d H:i:s') }}";
            if (typeof $.fn.countdown !== 'undefined') {
                $('#countdown').countdown(endDate, function(event) {
                    $(this).html(event.strftime('<span class="countdown-days">%D</span> days <span class="countdown-hours">%H</span> hours <span class="countdown-minutes">%M</span> min <span class="countdown-seconds">%S</span> sec'));
                });
            } else {
                document.getElementById('countdown').innerText = 'Countdown unavailable';
            }
        });
        </script>
        @endif
        <!-- Date Count End -->
        <!--? Team Ara Start -->
        <div class="team-area section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="cl-xl-8 col-lg-8 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-60">
                            <h2>Expert Teachers</h2>
                            <p>Our set he for firmament morning sixth subdue today the darkness creeping gathered divide our let god moving today. Moving in fourth air night bring upon lesser subdue.</p>
                        </div> 
                    </div>
                </div>
                <div class="c-row">
                    <div class="team-active">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-team mb-30 text-center">
                                <div class="team-img">
                                    <img src="assets/img/gallery/team1.png" alt="">
                                    <div class="team-caption">
                                        <!-- Blog Social -->
                                        <div class="team-social">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h3><a href="#">Mr. Jacson Clay</a></h3>
                                    <p>Sports Instructor</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-team mb-30 text-center">
                                <div class="team-img">
                                    <img src="assets/img/gallery/team2.png" alt="">
                                    <div class="team-caption">
                                        <!-- Blog Social -->
                                        <div class="team-social">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h3><a href="#">Mr. Jacson Clay</a></h3>
                                    <p>Sports Instructor</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-team mb-30 text-center">
                                <div class="team-img">
                                    <img src="assets/img/gallery/team3.png" alt="">
                                    <div class="team-caption">
                                        <!-- Blog Social -->
                                        <div class="team-social">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h3><a href="#">Buster Hyman</a></h3>
                                    <p>Sports Instructor</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-team mb-30 text-center">
                                <div class="team-img">
                                    <img src="assets/img/gallery/team2.png" alt="">
                                    <div class="team-caption">
                                        <!-- Blog Social -->
                                        <div class="team-social">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h3><a href="#">Amilia Kauly</a></h3>
                                    <p>Sports Instructor</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-team mb-30 text-center">
                                <div class="team-img">
                                    <img src="assets/img/gallery/team3.png" alt="">
                                    <div class="team-caption">
                                        <!-- Blog Social -->
                                        <div class="team-social">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h3><a href="#">Mr. Jacson Clay</a></h3>
                                    <p>Sports Instructor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Ara End -->
        <!--? Testimonial Start -->
        <div class="testimonial-area testimonial-padding section-bg2" data-background="assets/img/gallery/section_bg3.png">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-11 col-lg-11 col-md-9">
                        <div class="h1-testimonial-active">
                            @foreach($testimonials as $testimonial)
                            <div class="single-testimonial text-center">
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="assets/img/gallery/testimonial.png" alt="">
                                        <p>{{ $testimonial->testimonial }}</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                        </div>
                                        <div class="founder-text">
                                            <span>{{ $testimonial->name }}</span>
                                            <p>{{ $testimonial->designation }} @ {{ $testimonial->company }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        <!--? instagram-social start -->
        <div class="instagram-area fix">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="instagram-active owl-carousel">
                            @foreach($gallery as $item)
                            <div class="single-instagram">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Gallery Image">
                                <a href="#"><i class="ti-instagram"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- instagram-social End -->
    </main>
    
        @include('partials.footer')
    