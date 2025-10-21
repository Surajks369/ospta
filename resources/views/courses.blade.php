 @include('partials.header')
<main>
        <!--? Hero Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2 d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Classes</h1>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!-- Hero End -->
        <!--? Class-offer-area Start -->
        <div class="class-offer-area section-padding40 ">
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
            </div>
        </div>
        <!-- Class-offer-area End -->
    </main>
  @include('partials.footer')