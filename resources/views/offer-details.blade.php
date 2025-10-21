@include('partials.header')

<main>
    <!-- Offer Details Section -->
    <section style="padding: 120px 0 80px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        @if($offer->image)
                            <div style="height: 300px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $offer->image) }}" class="w-100" alt="{{ $offer->title }}" 
                                     style="object-fit: cover; height: 100%;">
                            </div>
                        @endif

                        <div class="card-body p-5">
                            <h1 class="mb-4" style="color: #423F8D; font-weight: 700;">{{ $offer->title }}</h1>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <span class="badge bg-primary p-3" style="font-size: 1.25rem;">
                                                @if($offer->discount_type === 'percentage')
                                                    {{ number_format($offer->discount_value, 0) }}% OFF
                                                @else
                                                    ₹{{ number_format($offer->discount_value, 2) }} OFF
                                                @endif
                                            </span>
                                        </div>
                                        @if($offer->offer_code)
                                            <div>
                                                <p class="mb-1 text-muted">Promo Code:</p>
                                                <div class="input-group">
                                                    <input type="text" value="{{ $offer->offer_code }}" class="form-control" id="offerCode" readonly>
                                                    <button class="btn btn-outline-primary" type="button" onclick="copyCode()">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center h-100">
                                        <div class="text-end ms-auto">
                                            <p class="mb-1 text-muted">Valid Till:</p>
                                            <h5 class="mb-0 text-primary">
                                                {{ $offer->end_date->format('d M Y') }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="mb-3" style="color: #423F8D;">Offer Details</h4>
                                <div class="p-4 bg-light rounded">
                                    {!! nl2br(e($offer->description)) !!}
                                </div>
                            </div>

                            @if($offer->minimum_amount)
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Minimum purchase amount: ₹{{ number_format($offer->minimum_amount, 2) }}
                                </div>
                            @endif

                            @if($offer->maximum_discount)
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Maximum discount amount: ₹{{ number_format($offer->maximum_discount, 2) }}
                                </div>
                            @endif

                            <div class="d-grid gap-2 d-md-block mt-4">
                                <a href="{{ route('courses') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-shopping-cart me-2"></i>Browse Courses
                                </a>
                                <a href="{{ route('offers') }}" class="btn btn-outline-primary btn-lg ms-md-2">
                                    <i class="fas fa-gift me-2"></i>View All Offers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    #offerCode {
        font-family: monospace;
        font-size: 1.2rem;
        text-align: center;
        letter-spacing: 2px;
        font-weight: 600;
        color: #423F8D;
    }
</style>

<script>
function copyCode() {
    const codeInput = document.getElementById('offerCode');
    codeInput.select();
    document.execCommand('copy');
    
    // Show feedback
    const button = event.currentTarget;
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    button.classList.remove('btn-outline-primary');
    button.classList.add('btn-success');
    
    setTimeout(() => {
        button.innerHTML = originalHtml;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-primary');
    }, 2000);
}
</script>

@include('partials.footer')