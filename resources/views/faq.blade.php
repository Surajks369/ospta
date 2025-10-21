 @include('partials.header')
<main>
    <!--? FAQ Start -->
    <section class="categories-area section-padding40">
        <div class="container">
            <!-- Section Header -->
            <div class="row">
                <div class="col-xl-7 col-lg-8 col-md-10 mx-auto">
                    <div class="section-tittle text-center mb-55">
                        <h2 style="color: #423F8D; font-weight: 700;">Frequently Asked Questions</h2>
                        <p class="text-muted">Find answers to the most common questions about our courses and services</p>
                    </div>
                </div>
            </div>
            
            <!-- FAQ Content -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    @if($faqs->count() > 0)
                        @foreach($faqs as $category => $categoryFaqs)
                            <div class="mb-5">
                                <h3 class="mb-4" style="color: #423F8D; font-weight: 600;">{{ $category ?: 'General' }}</h3>
                                <div class="accordion" id="faqAccordion{{ str_replace(' ', '', $category) }}">
                                    @foreach($categoryFaqs as $index => $faq)
                                        <div class="card border-0 shadow-sm mb-3" style="border-radius: 15px; overflow: hidden;">
                                            <div class="card-header" id="heading{{ $category }}{{ $index }}" style="background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%); border: none; padding: 0;">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link text-white text-left w-100 py-3 px-4 position-relative" 
                                                            type="button" 
                                                            data-toggle="collapse" 
                                                            data-target="#collapse{{ $category }}{{ $index }}" 
                                                            aria-expanded="false" 
                                                            aria-controls="collapse{{ $category }}{{ $index }}"
                                                            style="text-decoration: none; font-weight: 600; font-size: 16px; border: none; outline: none; box-shadow: none; display: block; width: 100%;">
                                                        <div class="d-flex justify-content-between align-items-center w-100">
                                                            <span style="color: white !important;">{{ $faq->question }}</span>
                                                            <i class="fas fa-chevron-down" style="color: white !important; transition: transform 0.3s ease;"></i>
                                                        </div>
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapse{{ $category }}{{ $index }}" 
                                                 class="collapse" 
                                                 aria-labelledby="heading{{ $category }}{{ $index }}" 
                                                 data-parent="#faqAccordion{{ str_replace(' ', '', $category) }}">
                                                <div class="card-body py-4 px-4" style="background-color: #f8f9fa; color: #333 !important;">
                                                    <p class="mb-0" style="line-height: 1.6; font-size: 15px; color: #333 !important;">
                                                        {!! nl2br(e($faq->answer)) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <!-- No FAQs Available -->
                        <div class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-question-circle fa-5x text-muted mb-4" style="color: #423F8D !important; opacity: 0.3;"></i>
                                <h4 class="text-muted mb-3">No FAQs Available</h4>
                                <p class="text-muted">We're working on adding frequently asked questions. Please check back soon!</p>
                                <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%); border: none; border-radius: 25px; padding: 12px 30px; font-weight: 600;">
                                    <i class="fas fa-home me-2"></i>Back to Home
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Contact Support Section -->
            <div class="row mt-5">
                <div class="col-xl-8 col-lg-10 mx-auto">
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
                        <div class="card-body py-5 px-4 text-center">
                            <div class="mb-4">
                                <i class="fas fa-headset fa-3x" style="color: #ED078B;"></i>
                            </div>
                            <h4 style="color: #423F8D; font-weight: 700; margin-bottom: 15px;">Still have questions?</h4>
                            <p class="text-muted mb-4">Can't find the answer you're looking for? Please chat to our friendly team.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <a href="tel:+10783673692" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%); border: none; border-radius: 25px; padding: 12px 20px; font-weight: 600; color: white !important;">
                                        <i class="fas fa-phone me-2" style="color: white !important;"></i>Call us: +10 (78) 367 3692
                                    </a>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <a href="mailto:info@ospta.com" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%); border: none; border-radius: 25px; padding: 12px 20px; font-weight: 600; color: white !important;">
                                        <i class="fas fa-envelope me-2" style="color: white !important;"></i>Email us
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--? FAQ End -->
</main>

<!-- Custom Styles and Scripts for FAQ -->
<style>
/* Remove any overflow issues that cause blue bars */
.container, .container-fluid {
    overflow-x: hidden;
}

body, html {
    overflow-x: hidden;
}

.accordion .card-header {
    border: none !important;
    padding: 0 !important;
    overflow: hidden;
    border-radius: 15px 15px 0 0 !important;
    background: transparent !important;
}

.accordion .card-header button {
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
    background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%) !important;
    color: white !important;
    text-decoration: none !important;
    width: 100% !important;
    display: block !important;
    text-align: left !important;
    border-radius: 0 !important;
    position: relative;
    overflow: hidden;
}

.accordion .card-header button:hover {
    background: linear-gradient(135deg, #ED078B 0%, #ED078B 100%) !important;
    color: white !important;
    transform: none !important;
}

.accordion .card-header button:focus,
.accordion .card-header button:active {
    box-shadow: none !important;
    outline: none !important;
    color: white !important;
    background: linear-gradient(135deg, #ED078B 0%, #423F8D 100%) !important;
}

.accordion .card-header button span,
.accordion .card-header button i {
    color: white !important;
}

.accordion .card {
    transition: all 0.3s ease;
    border: none !important;
    overflow: hidden;
    border-radius: 15px !important;
    background: transparent !important;
}

.accordion .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.accordion .card-body {
    color: #333 !important;
    border: none !important;
    border-radius: 0 0 15px 15px !important;
}

.accordion .card-body p {
    color: #333 !important;
}

/* Proper collapse/expand behavior */
.collapse {
    transition: height 0.35s ease !important;
    overflow: hidden !important;
    height: 0px !important;
    display: block !important;
}

.collapse.show {
    height: auto !important;
}

/* Chevron rotation animation */
.accordion .card-header button[aria-expanded="true"] i {
    transform: rotate(180deg) !important;
}

.accordion .card-header button[aria-expanded="false"] i {
    transform: rotate(0deg) !important;
}

/* Fix any positioning issues */
.accordion .card-header button .d-flex {
    width: 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .accordion .card-header button {
        font-size: 14px !important;
        padding: 15px !important;
    }
    
    .accordion .card-body {
        padding: 20px 15px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap accordion functionality
    const accordionButtons = document.querySelectorAll('[data-toggle="collapse"]');
    
    accordionButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const targetId = this.getAttribute('data-target');
            const target = document.querySelector(targetId);
            const isCurrentlyOpen = target.classList.contains('show');
            
            // Close all other accordions first
            accordionButtons.forEach(function(otherButton) {
                if (otherButton !== button) {
                    const otherTargetId = otherButton.getAttribute('data-target');
                    const otherTarget = document.querySelector(otherTargetId);
                    
                    if (otherTarget.classList.contains('show')) {
                        // Close other accordion
                        otherTarget.classList.remove('show');
                        otherTarget.style.height = '0px';
                        otherButton.setAttribute('aria-expanded', 'false');
                        otherButton.classList.add('collapsed');
                    }
                }
            });
            
            // Toggle current accordion
            if (isCurrentlyOpen) {
                // Close current accordion
                target.style.height = target.scrollHeight + 'px';
                setTimeout(function() {
                    target.style.height = '0px';
                    target.classList.remove('show');
                }, 10);
                button.setAttribute('aria-expanded', 'false');
                button.classList.add('collapsed');
            } else {
                // Open current accordion
                target.classList.add('show');
                target.style.height = '0px';
                setTimeout(function() {
                    target.style.height = target.scrollHeight + 'px';
                    setTimeout(function() {
                        target.style.height = 'auto';
                    }, 350);
                }, 10);
                button.setAttribute('aria-expanded', 'true');
                button.classList.remove('collapsed');
                
                // Smooth scroll to the opened item after animation
                setTimeout(function() {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 400);
            }
        });
    });
    
    // Initialize all collapse elements with proper styling
    const collapseElements = document.querySelectorAll('.collapse');
    collapseElements.forEach(function(element) {
        element.style.transition = 'height 0.35s ease';
        element.style.height = '0px';
        element.style.overflow = 'hidden';
        element.style.display = 'block';
    });
    
    // Initialize all buttons as collapsed
    accordionButtons.forEach(function(button) {
        button.setAttribute('aria-expanded', 'false');
        button.classList.add('collapsed');
    });
});
</script>

@include('partials.footer')