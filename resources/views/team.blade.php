@include('partials.header')
<!-- Add CSS file -->
<link rel="stylesheet" href="{{ asset('assets/css/team.css') }}">

<!-- Hero Section -->


<!-- Team Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="team-section-header">
            <h5>Our Expert Team</h5>
            <h1>Meet The Faces Behind Our Success</h1>
            <p class="text-muted">Each member of our team brings unique expertise and passion to create an exceptional learning experience</p>
        </div>
        <div class="row">
            @forelse($teamMembers as $member)
                <div class="col-md-6 col-lg-3">
                    <div class="team-item">
                        <img class="img-fluid w-100" src="{{ $member->photo ? Storage::url($member->photo) : asset('assets/img/placeholder.png') }}" alt="{{ $member->name }}">
                        <div class="team-text text-center">
                            <h5 class="mb-0">{{ $member->name }}</h5>
                            <p class="text-primary">{{ $member->job_title }}</p>
                            @if($member->qualification)
                                <small class="qualification">{{ $member->qualification }}</small>
                            @endif
                            <div class="team-social">
                                @if(isset($member->social_links['facebook']))
                                    <a href="{{ $member->social_links['facebook'] }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if(isset($member->social_links['twitter']))
                                    <a href="{{ $member->social_links['twitter'] }}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if(isset($member->social_links['linkedin']))
                                    <a href="{{ $member->social_links['linkedin'] }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if(isset($member->social_links['instagram']))
                                    <a href="{{ $member->social_links['instagram'] }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No team members found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@include('partials.footer')