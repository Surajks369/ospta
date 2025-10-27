@extends('layouts.app')

@section('title', 'Our Team')

@section('content')
<!-- Page Title -->
<div class="container-fluid page-title">
    <div class="container">
        <h1>Our Team</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Our Team</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Team Section -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3">Our Teachers</h5>
            <h1>Meet Our Expert Teachers</h1>
        </div>
        <div class="row">
            @forelse($teamMembers as $member)
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="team-item position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ $member->photo ? Storage::url($member->photo) : asset('assets/img/placeholder.png') }}" alt="{{ $member->name }}">
                        <div class="team-text d-flex flex-column justify-content-center text-center border border-top-0 p-4">
                            <h5>{{ $member->name }}</h5>
                            <p class="m-0">{{ $member->job_title }}</p>
                            @if($member->qualification)
                                <small class="text-muted">{{ $member->qualification }}</small>
                            @endif
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center w-100">
                            @if(isset($member->social_links['facebook']))
                                <a class="btn btn-outline-light mr-2" href="{{ $member->social_links['facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if(isset($member->social_links['twitter']))
                                <a class="btn btn-outline-light mr-2" href="{{ $member->social_links['twitter'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if(isset($member->social_links['linkedin']))
                                <a class="btn btn-outline-light mr-2" href="{{ $member->social_links['linkedin'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if(isset($member->social_links['instagram']))
                                <a class="btn btn-outline-light" href="{{ $member->social_links['instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
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
@endsection