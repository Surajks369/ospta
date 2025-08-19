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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Testimonials</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </section>
    <!-- Hero End -->

    <!--? Testimonial Area Start -->
    <div class="testimonial-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-11">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-80">
                        <h2>What Our <span>Students Say</span></h2>
                        <p>Real feedback from real students who have transformed their careers through our professional training programs. Read their success stories and experiences.</p>
                    </div>
                </div>
            </div>
            
            @if($testimonials && $testimonials->count() > 0)
            <div class="row">
                @foreach($testimonials as $testimonial)
                <div class="col-lg-6 col-md-6 mb-40">
                    <div class="single-testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-top">
                                <div class="quote-icon mb-20">
                                    <img src="{{ asset('assets/img/gallery/testimonial.png') }}" alt="Quote">
                                </div>
                                <div class="testimonial-rating mb-20">
                                    @if($testimonial->rating)
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <i class="fas fa-star color-font1"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    @endif
                                </div>
                                <p class="testimonial-text">"{{ $testimonial->testimonial }}"</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-info d-flex align-items-center">
                                    <div class="author-img">
                                        @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="rounded-circle">
                                        @else
                                        <div class="default-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="author-details ml-20">
                                        <h4 class="author-name">{{ $testimonial->name }}</h4>
                                        <p class="author-position">
                                            @if($testimonial->designation && $testimonial->company)
                                                {{ $testimonial->designation }} @ {{ $testimonial->company }}
                                            @elseif($testimonial->designation)
                                                {{ $testimonial->designation }}
                                            @elseif($testimonial->company)
                                                {{ $testimonial->company }}
                                            @else
                                                Student
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($testimonials->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="pagination-area text-center mt-50">
                        {{ $testimonials->links() }}
                    </div>
                </div>
            </div>
            @endif

            @else
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <div class="empty-testimonials">
                            <i class="fas fa-quote-left fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">No Testimonials Yet</h4>
                            <p class="text-muted">Check back soon for student reviews and success stories!</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Testimonial Area End -->

 </main>

<style>
.single-testimonial-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0px 25px 60px rgba(66, 85, 164, 0.06);
    padding: 40px 30px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.single-testimonial-card:hover {
    box-shadow: 0px 30px 70px rgba(237, 7, 139, 0.15);
    transform: translateY(-5px);
}

.testimonial-text {
    font-size: 16px;
    line-height: 1.8;
    color: #5E5E5E;
    font-style: italic;
    margin-bottom: 30px;
}

.author-img {
    width: 60px;
    height: 60px;
    position: relative;
}

.author-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 3px solid #ED078B;
}

.default-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #ED078B, #da047d);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.author-name {
    color: #423F8D;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
    font-family: "Fredoka One", cursive;
}

.author-position {
    color: #5E5E5E;
    font-size: 14px;
    margin-bottom: 0;
}

.testimonial-rating {
    font-size: 18px;
}

.testimonial-rating i {
    margin-right: 3px;
}

.empty-testimonials {
    padding: 80px 20px;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
}

.breadcrumb .breadcrumb-item.active {
    color: #fff;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    color: rgba(255, 255, 255, 0.7);
    padding: 0 8px;
}

.pagination-area .pagination {
    justify-content: center;
}

.pagination .page-link {
    color: #423F8D;
    border: 1px solid #ED078B;
    margin: 0 5px;
    border-radius: 50px;
    padding: 10px 15px;
}

.pagination .page-link:hover {
    background-color: #ED078B;
    color: #fff;
    border-color: #ED078B;
}

.pagination .page-item.active .page-link {
    background-color: #ED078B;
    border-color: #ED078B;
    color: #fff;
}

@media (max-width: 768px) {
    .single-testimonial-card {
        padding: 30px 20px;
        margin-bottom: 20px;
    }
    
    .author-details {
        margin-left: 15px !important;
    }
    
    .author-name {
        font-size: 16px;
    }
    
    .testimonial-text {
        font-size: 15px;
    }
}

@media (max-width: 576px) {
    .author-info {
        flex-direction: column;
        text-align: center;
    }
    
    .author-details {
        margin-left: 0 !important;
        margin-top: 15px;
    }
}
</style>

 @include('partials.footer')