@extends('layouts.kindergarten')

@section('title', 'OSPTA - Online Student Professional Training Academy')
@section('description', 'Professional online training courses and certifications to advance your career')

@section('content')
<!--? slider Area Start-->
<section class="slider-area">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-11">
                        <div class="hero__caption">
                            <h1 data-animation="fadeInLeft" data-delay="0.2s">Professional<br> Training</h1>
                            <span data-animation="fadeInLeft" data-delay="0.4s">For Career Growth</span>
                            <a href="{{ route('courses') }}" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Explore Courses</a>
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
                    <h2>Welcome to <span>OSPTA</span></h2>
                    <p>Professional Online Training Academy dedicated to providing high-quality, accessible, and industry-relevant training programs that empower professionals to advance their careers and achieve their goals.</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12">
                <div class="about-caption">
                    <div class="single-features mb-30">
                        <div class="features-icon">
                            <img src="{{ asset('img/icon/about-icon1.svg') }}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3 class="color-font1">Expert Instructors</h3>
                            <p>Learn from industry professionals with years of real-world experience.</p>
                        </div>
                    </div>
                    <div class="single-features mb-30">
                        <div class="features-icon">
                            <img src="{{ asset('img/icon/about-icon2.svg') }}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3 class="color-font2">Flexible Learning</h3>
                            <p>Study at your own pace with 24/7 access to course materials.</p>
                        </div>
                    </div>
                    <div class="single-features mb-30">
                        <div class="features-icon">
                            <img src="{{ asset('img/icon/about-icon3.svg') }}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3 class="color-font3">Industry Certification</h3>
                            <p>Earn recognized certifications that add value to your career.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <!-- about-img -->
                <div class="about-img">
                    <img src="{{ asset('img/gallery/about2.png') }}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Area End -->

<!--? Class-offer-area Start -->
@if($courses->count() > 0)
<div class="class-offer-area section-bg2 section-padding40" data-background="{{ asset('img/gallery/section_bg1.png') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-11">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-80">
                    <h2>Courses We Offer</h2>
                    <p>Discover our comprehensive range of professional training courses designed to advance your career and unlock new opportunities in today's competitive market.</p>
                </div>
            </div>
        </div>
        <div class="class-offer-active">
            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <!-- Single -->
                <div class="properties pb-30">
                    <div class="properties__card">
                        <div class="properties__img">
                            <a href="{{ route('course.details', $course->id) }}">
                                @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}">
                                @else
                                <img src="{{ asset('img/gallery/class-img1.png') }}" alt="{{ $course->title }}">
                                @endif
                            </a>
                            @if($course->level)
                            <div class="img-text">
                                <span class="open">{{ ucfirst($course->level) }}</span>
                            </div>
                            @endif
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
                                <span class="color-font1">${{ $course->price ? number_format($course->price, 0) : 'Free' }}</span>
                                <p>Price</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="browse-all text-center mt-30">
                    <a href="{{ route('courses') }}" class="border-btn">More Courses</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Class-offer-area End -->

<!--? Testimonial Start -->
@if($testimonials->count() > 0)
<div class="testimonial-area testimonial-padding section-bg2" data-background="{{ asset('img/gallery/section_bg3.png') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-11">
                <div class="section-tittle text-center mb-70">
                    <h2>What Our Students Say</h2>
                    <p>Real feedback from real students who have transformed their careers through our training programs.</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-11 col-lg-11 col-md-9">
                <div class="h1-testimonial-active">
                    @foreach($testimonials as $testimonial)
                    <!-- Single Testimonial -->
                    <div class="single-testimonial text-center">
                        <div class="testimonial-caption">
                            <div class="testimonial-top-cap">
                                @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                @else
                                <img src="{{ asset('img/gallery/testimonial.png') }}" alt="{{ $testimonial->name }}">
                                @endif
                                <p>"{{ $testimonial->message }}"</p>
                            </div>
                            <!-- founder -->
                            <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                <div class="founder-img">
                                    @if($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                    @else
                                    <img src="{{ asset('img/gallery/founder-img.svg') }}" alt="{{ $testimonial->name }}">
                                    @endif
                                </div>
                                <div class="founder-text">
                                    <span>{{ $testimonial->name }}</span>
                                    <p>{{ $testimonial->position ?? 'Student' }}</p>
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
@endif
<!-- Testimonial End -->

<!--? Gallery/Instagram Area Start -->
@if($gallery->count() > 0)
<div class="instagram-area fix">
    <div class="container-fluid p-0">
        <div class="row justify-content-center mb-30">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-11">
                <div class="section-tittle text-center">
                    <h2>Success Gallery</h2>
                    <p>Celebrating our students' achievements and memorable moments</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="instagram-active owl-carousel">
                    @foreach($gallery as $item)
                    <div class="single-instagram">
                        @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                        @else
                        <img src="{{ asset('img/gallery/instra1.png') }}" alt="{{ $item->title }}">
                        @endif
                        <a href="{{ route('gallery') }}"><i class="ti-instagram"></i></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Gallery Area End -->

<!-- Call to Action -->
<div class="about-low-area section-padding40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-11">
                <div class="section-tittle text-center mb-50">
                    <h2>Ready to Start Your Journey?</h2>
                    <p>Join thousands of professionals who have transformed their careers through our comprehensive training programs.</p>
                    <div class="browse-all text-center mt-40">
                        <a href="{{ route('join') }}" class="btn hero-btn mr-20">Join Now</a>
                        <a href="{{ route('contact') }}" class="border-btn">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.mr-20 {
    margin-right: 20px;
}
.mt-40 {
    margin-top: 40px;
}
</style>
@endpush
