@extends('layouts.app')

@section('title', $member->name)

@section('content')
<!-- Page Title -->
<div class="container-fluid page-title">
    <div class="container">
        <h1>{{ $member->name }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('team') }}">Our Team</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $member->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Team Member Details -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <img src="{{ $member->photo ? Storage::url($member->photo) : asset('assets/img/placeholder.png') }}" 
                             alt="{{ $member->name }}" 
                             class="img-fluid rounded-circle mb-4"
                             style="max-width: 200px;">
                        
                        <h3 class="mb-0">{{ $member->name }}</h3>
                        <p class="text-primary mb-3">{{ $member->job_title }}</p>

                        @if($member->qualification)
                            <p class="mb-3"><i class="fas fa-graduation-cap me-2"></i>{{ $member->qualification }}</p>
                        @endif

                        @if($member->email || $member->phone)
                            <div class="border-top pt-3 mt-3">
                                @if($member->email)
                                    <p class="mb-2">
                                        <i class="fas fa-envelope me-2"></i>
                                        <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                    </p>
                                @endif
                                @if($member->phone)
                                    <p class="mb-0">
                                        <i class="fas fa-phone me-2"></i>
                                        <a href="tel:{{ $member->phone }}">{{ $member->phone }}</a>
                                    </p>
                                @endif
                            </div>
                        @endif

                        <!-- Social Links -->
                        <div class="border-top pt-3 mt-3">
                            <div class="d-flex justify-content-center gap-2">
                                @if(isset($member->social_links['facebook']))
                                    <a href="{{ $member->social_links['facebook'] }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if(isset($member->social_links['twitter']))
                                    <a href="{{ $member->social_links['twitter'] }}" target="_blank" class="btn btn-outline-info">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if(isset($member->social_links['linkedin']))
                                    <a href="{{ $member->social_links['linkedin'] }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                                @if(isset($member->social_links['instagram']))
                                    <a href="{{ $member->social_links['instagram'] }}" target="_blank" class="btn btn-outline-danger">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="mb-4">About {{ $member->name }}</h4>
                        
                        @if($member->bio)
                            <div class="mb-4">
                                {{ $member->bio }}
                            </div>
                        @endif

                        @if($member->specializations)
                            <h5 class="mb-3">Specializations</h5>
                            <p class="mb-4">{{ $member->specializations }}</p>
                        @endif

                        <div class="row g-4">
                            @if($member->qualification)
                                <div class="col-sm-6">
                                    <div class="bg-light rounded p-4 h-100">
                                        <h6 class="mb-2">Education</h6>
                                        <p class="mb-0">{{ $member->qualification }}</p>
                                    </div>
                                </div>
                            @endif
                            @if($member->specializations)
                                <div class="col-sm-6">
                                    <div class="bg-light rounded p-4 h-100">
                                        <h6 class="mb-2">Areas of Expertise</h6>
                                        <p class="mb-0">{{ $member->specializations }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection