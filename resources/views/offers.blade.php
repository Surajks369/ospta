@include('partials.header')

<main>
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(135deg, #423F8D 0%, #ED078B 100%); padding: 120px 0 80px;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 style="color: white; font-family: 'Fredoka One', cursive; font-size: 3.5rem; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Special Offers
                    </h1>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.3rem; margin-bottom: 0; line-height: 1.6;">
                        Discover amazing discounts and special promotions on our courses!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            @if($offers->count() > 0)
                <div class="row g-4">
                    @foreach($offers as $offer)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-lg hover-float" style="border-radius: 20px; overflow: hidden; transition: all 0.3s ease;">
                                @if($offer->image)
                                    <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top" alt="{{ $offer->title }}" 
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-gift fa-4x"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body p-4">
                                    <h3 class="card-title h4 mb-3" style="color: #423F8D; font-weight: 600;">{{ $offer->title }}</h3>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="badge bg-primary me-2" style="font-size: 1rem;">
                                            @if($offer->discount_type === 'percentage')
                                                {{ number_format($offer->discount_value, 0) }}% OFF
                                            @else
                                                ₹{{ number_format($offer->discount_value, 2) }} OFF
                                            @endif
                                        </div>
                                        @if($offer->offer_code)
                                            <div class="badge bg-secondary" style="font-size: 0.9rem;">
                                                Code: {{ $offer->offer_code }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <p class="card-text text-muted mb-3" style="min-height: 48px;">
                                        {{ \Str::limit($offer->description, 100) }}
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="text-muted small">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            Valid till: {{ $offer->end_date->format('d M Y') }}
                                        </div>
                                        <a href="{{ route('offer.details', $offer->id) }}" class="btn btn-outline-primary">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $offers->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-gift fa-5x text-muted"></i>
                    </div>
                    <h3 class="h4 mb-3">No Active Offers</h3>
                    <p class="text-muted">
                        There are no active offers at the moment. Please check back later for new promotions!
                    </p>
                    <a href="{{ route('courses') }}" class="btn btn-primary mt-3">
                        Browse Courses
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section style="padding: 80px 0; background: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 style="color: #423F8D; font-family: 'Fredoka One', cursive; font-size: 2.5rem; margin-bottom: 20px;">
                        Why Choose Our Courses?
                    </h2>
                    <p class="text-muted mb-5">
                        We provide quality education at affordable prices. With our special offers, you get even more value!
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-medal fa-3x text-primary"></i>
                        </div>
                        <h4>Quality Education</h4>
                        <p class="text-muted">Expert instructors and well-structured courses for optimal learning</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-tags fa-3x text-primary"></i>
                        </div>
                        <h4>Best Prices</h4>
                        <p class="text-muted">Competitive pricing with regular discounts and special offers</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <i class="fas fa-clock fa-3x text-primary"></i>
                        </div>
                        <h4>Flexible Learning</h4>
                        <p class="text-muted">Learn at your own pace with lifetime access to course content</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .hover-float {
        transition: transform 0.3s ease;
    }
    .hover-float:hover {
        transform: translateY(-5px);
    }
    .pagination {
        justify-content: center;
        gap: 5px;
    }
    .page-link {
        border-radius: 50%;
        margin: 0 5px;
        color: #423F8D;
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .page-item.active .page-link {
        background: linear-gradient(135deg, #423F8D 0%, #ED078B 100%);
    }
</style>

@include('partials.footer')