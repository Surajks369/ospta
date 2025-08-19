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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Gallery</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
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

    <!--? Gallery Area Start -->
    <div class="gallery-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10 col-sm-11">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-80">
                        <h2>Our <span>Gallery</span></h2>
                        <p>Explore our collection of memorable moments, achievements, and highlights from our training programs and events.</p>
                    </div>
                </div>
            </div>
            
            @if($gallery && $gallery->count() > 0)
            <div class="row gallery-item">
                @foreach($gallery as $item)
                <div class="col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="single-gallery-item">
                        <div class="gallery-img">
                            @if($item->image)
                            <a href="{{ asset('storage/' . $item->image) }}" class="img-pop-up">
                                <div class="single-gallery-image" style="background: url('{{ asset('storage/' . $item->image) }}'); background-size: cover; background-position: center; height: 300px; border-radius: 10px; position: relative; overflow: hidden;">
                                    <div class="gallery-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(237, 7, 139, 0.7); opacity: 0; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center;">
                                        <i class="ti-zoom-in" style="color: white; font-size: 30px;"></i>
                                    </div>
                                </div>
                            </a>
                            @else
                            <div class="single-gallery-image" style="background: url('{{ asset('assets/img/gallery/gallery1.png') }}'); background-size: cover; background-position: center; height: 300px; border-radius: 10px;">
                            </div>
                            @endif
                        </div>
                        <div class="gallery-caption mt-20">
                            <h4>{{ $item->title }}</h4>
                            @if($item->description)
                            <p>{{ Str::limit($item->description, 80) }}</p>
                            @endif
                            <div class="gallery-meta">
                                <span class="badge bg-{{ $item->type == 'video' ? 'info' : 'secondary' }}">
                                    {{ ucfirst($item->type) }}
                                </span>
                                @if($item->created_at)
                                <small class="text-muted ml-2">{{ $item->created_at->format('M d, Y') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <div class="empty-gallery">
                            <i class="fas fa-images fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">No Gallery Items Yet</h4>
                            <p class="text-muted">Check back soon for exciting photos and updates!</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Gallery Area End -->
</main>

<style>
.single-gallery-item:hover .gallery-overlay {
    opacity: 1 !important;
}

.gallery-caption h4 {
    color: #423F8D;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
}

.gallery-caption p {
    color: #5E5E5E;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 10px;
}

.gallery-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.empty-gallery {
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

.single-gallery-image {
    border-radius: 10px !important;
}

@media (max-width: 768px) {
    .single-gallery-image {
        height: 250px !important;
    }
    
    .gallery-caption h4 {
        font-size: 16px;
    }
}
</style>

@include('partials.footer')