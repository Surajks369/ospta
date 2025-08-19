@include('partials.header')
<main>
    <!--? Hero Area Start-->
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/category.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $course->title }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('courses') }}">Courses</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->

    <!--? Course Details Area Start -->
    <div class="course-details-area section-padding40">
        <div class="container">
            <div class="row">
                <!-- Course Content -->
                <div class="col-lg-8">
                    <!-- Course Image -->
                    <div class="course-details-img mb-50">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-100">
                        @else
                            <img src="{{ asset('assets/img/gallery/class-img1.png') }}" alt="{{ $course->title }}" class="w-100">
                        @endif
                    </div>

                    <!-- Course Info -->
                    <div class="course-details-content">
                        <div class="course-meta mb-30">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-meta">
                                        <i class="fas fa-tag color-font1"></i>
                                        <span>Category: <strong>{{ $course->category->name ?? 'General' }}</strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-meta">
                                        <i class="fas fa-clock color-font2"></i>
                                        <span>Duration: <strong>{{ $course->duration ?? 'Self-paced' }}</strong></span>
                                    </div>
                                </div>
                                @if($course->level)
                                <div class="col-md-6">
                                    <div class="single-meta">
                                        <i class="fas fa-signal color-font3"></i>
                                        <span>Level: <strong>{{ ucfirst($course->level) }}</strong></span>
                                    </div>
                                </div>
                                @endif
                                @if($course->instructor)
                                <div class="col-md-6">
                                    <div class="single-meta">
                                        <i class="fas fa-user color-font4"></i>
                                        <span>Instructor: <strong>{{ $course->instructor }}</strong></span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Course Description -->
                        <div class="course-description mb-50">
                            <h3 class="mb-30">Course Description</h3>
                            <p>{{ $course->description }}</p>
                        </div>

                        <!-- What You'll Learn -->
                        @if($course->learning_objectives)
                        <div class="learning-objectives mb-50">
                            <h3 class="mb-30">What You'll Learn</h3>
                            <div class="objectives-content">
                                {!! nl2br(e($course->learning_objectives)) !!}
                            </div>
                        </div>
                        @endif

                        <!-- Prerequisites -->
                        @if($course->requirements)
                        <div class="course-requirements mb-50">
                            <h3 class="mb-30">Prerequisites</h3>
                            <div class="requirements-content">
                                {!! nl2br(e($course->requirements)) !!}
                            </div>
                        </div>
                        @endif

                        <!-- Course Curriculum -->
                        @if($course->curriculum)
                        <div class="course-curriculum mb-50">
                            <h3 class="mb-30">Course Curriculum</h3>
                            <div class="curriculum-content">
                                {!! nl2br(e($course->curriculum)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Course Enrollment Card -->
                    <div class="course-enrollment-card mb-50">
                        <div class="enrollment-header text-center">
                            <div class="price-section mb-30">
                                @if($course->discounted_price && $course->discounted_price < $course->price)
                                    <span class="original-price">${{ number_format($course->price, 2) }}</span>
                                    <span class="discounted-price">${{ number_format($course->discounted_price, 2) }}</span>
                                    <div class="discount-badge">
                                        {{ round((($course->price - $course->discounted_price) / $course->price) * 100) }}% OFF
                                    </div>
                                @else
                                    <span class="current-price">${{ $course->price ? number_format($course->price, 2) : 'Free' }}</span>
                                @endif
                            </div>
                            <div class="enrollment-buttons">
                                <a href="#" class="btn hero-btn mb-15 w-100" onclick="enrollCourse()">Enroll Now</a>
                                <a href="#" class="border-btn w-100" onclick="bookDemo()">Book Demo</a>
                            </div>
                        </div>
                    </div>

                    <!-- Course Features -->
                    <div class="course-features mb-50">
                        <h4 class="mb-30">Course Features</h4>
                        <ul class="features-list">
                            <li><i class="fas fa-check color-font1"></i> Lifetime Access</li>
                            <li><i class="fas fa-check color-font2"></i> Certificate of Completion</li>
                            <li><i class="fas fa-check color-font3"></i> Expert Support</li>
                            <li><i class="fas fa-check color-font4"></i> Mobile Friendly</li>
                            <li><i class="fas fa-check color-font1"></i> Self-paced Learning</li>
                        </ul>
                    </div>

                    <!-- Course Stats -->
                    <div class="course-stats mb-50">
                        <h4 class="mb-30">Course Stats</h4>
                        <div class="stats-item">
                            <div class="single-features mb-20">
                                <div class="features-icon">
                                    <i class="fas fa-users color-font1"></i>
                                </div>
                                <div class="features-caption">
                                    <span>Students Enrolled</span>
                                    <p>{{ rand(50, 500) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="stats-item">
                            <div class="single-features mb-20">
                                <div class="features-icon">
                                    <i class="fas fa-star color-font2"></i>
                                </div>
                                <div class="features-caption">
                                    <span>Course Rating</span>
                                    <p>4.8/5</p>
                                </div>
                            </div>
                        </div>
                        <div class="stats-item">
                            <div class="single-features mb-20">
                                <div class="features-icon">
                                    <i class="fas fa-graduation-cap color-font3"></i>
                                </div>
                                <div class="features-caption">
                                    <span>Completion Rate</span>
                                    <p>95%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Details Area End -->
</main>

<style>
.course-meta .single-meta {
    margin-bottom: 15px;
}
.course-meta .single-meta i {
    margin-right: 10px;
    font-size: 16px;
}
.price-section .original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 18px;
    margin-right: 10px;
}
.price-section .discounted-price,
.price-section .current-price {
    font-size: 32px;
    font-weight: bold;
    color: #ED078B;
}
.discount-badge {
    background: #ED078B;
    color: white;
    padding: 5px 15px;
    border-radius: 15px;
    font-size: 12px;
    display: inline-block;
    margin-top: 10px;
}
.features-list {
    list-style: none;
    padding: 0;
}
.features-list li {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}
.features-list li:last-child {
    border-bottom: none;
}
.features-list li i {
    margin-right: 10px;
}
.course-enrollment-card {
    background: #fff;
    padding: 30px;
    box-shadow: 0px 6px 6px 0px rgba(2,25,65,0.08);
    border-radius: 20px;
}
.enrollment-buttons .btn,
.enrollment-buttons .border-btn {
    display: block;
    text-align: center;
    text-decoration: none;
}
</style>

<script>
function enrollCourse() {
    alert('Enrollment functionality will be implemented soon!');
}

function bookDemo() {
    alert('Demo booking functionality will be implemented soon!');
}
</script>

@include('partials.footer')