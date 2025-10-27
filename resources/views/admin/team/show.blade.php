@extends('admin.layouts.app')

@section('title', 'Team Member Details')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-user-circle me-2 text-primary"></i>Team Member Details</h2>
            <div>
                <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-1"></i>Edit Member
                </a>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Team
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <!-- Profile Card -->
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="{{ $member->photo ? Storage::url($member->photo) : asset('assets/img/placeholder.png') }}" 
                             alt="{{ $member->name }}" 
                             class="rounded-circle img-thumbnail mb-3"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        
                        <h4 class="mb-1">{{ $member->name }}</h4>
                        <p class="text-muted">{{ $member->job_title }}</p>
                        
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            @if(isset($member->social_links['facebook']))
                                <a href="{{ $member->social_links['facebook'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            @endif
                            @if(isset($member->social_links['twitter']))
                                <a href="{{ $member->social_links['twitter'] }}" target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if(isset($member->social_links['linkedin']))
                                <a href="{{ $member->social_links['linkedin'] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                            @if(isset($member->social_links['instagram']))
                                <a href="{{ $member->social_links['instagram'] }}" target="_blank" class="btn btn-outline-danger btn-sm">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                        </div>

                        <div class="list-group list-group-flush text-start">
                            <div class="list-group-item">
                                <small class="text-muted d-block">Status</small>
                                <span class="badge {{ $member->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $member->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="list-group-item">
                                <small class="text-muted d-block">Sort Order</small>
                                {{ $member->sort_order }}
                            </div>
                            @if($member->email)
                                <div class="list-group-item">
                                    <small class="text-muted d-block">Email</small>
                                    <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                </div>
                            @endif
                            @if($member->phone)
                                <div class="list-group-item">
                                    <small class="text-muted d-block">Phone</small>
                                    <a href="tel:{{ $member->phone }}">{{ $member->phone }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Professional Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Professional Information</h5>
                    </div>
                    <div class="card-body">
                        @if($member->qualification)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Qualification</h6>
                                <p class="mb-0">{{ $member->qualification }}</p>
                            </div>
                        @endif

                        @if($member->specializations)
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Specializations</h6>
                                <p class="mb-0">{{ $member->specializations }}</p>
                            </div>
                        @endif

                        @if($member->bio)
                            <div>
                                <h6 class="text-muted mb-2">Biography</h6>
                                <p class="mb-0">{{ $member->bio }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- System Information -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">System Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted d-block">Created At</small>
                                    {{ $member->created_at->format('M d, Y H:i A') }}
                                </div>
                                @if($member->created_by)
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Created By</small>
                                        {{ $member->createdBy->name ?? 'N/A' }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <small class="text-muted d-block">Last Updated</small>
                                    {{ $member->updated_at->format('M d, Y H:i A') }}
                                </div>
                                @if($member->updated_by)
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Updated By</small>
                                        {{ $member->updatedBy->name ?? 'N/A' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection