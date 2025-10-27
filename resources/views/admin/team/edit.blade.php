@extends('admin.layouts.app')

@section('title', 'Edit Team Member')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-user-edit me-2 text-primary"></i>Edit Team Member</h2>
            <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Team
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.team.update', $member) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Basic Information -->
                            <div class="mb-4">
                                <h5 class="card-title mb-3">Basic Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $member->name) }}" 
                                                   placeholder="Enter name"
                                                   required>
                                            <label for="name">Full Name <span class="text-danger">*</span></label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control @error('job_title') is-invalid @enderror" 
                                                   id="job_title" 
                                                   name="job_title" 
                                                   value="{{ old('job_title', $member->job_title) }}" 
                                                   placeholder="Enter job title"
                                                   required>
                                            <label for="job_title">Job Title <span class="text-danger">*</span></label>
                                            @error('job_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="mb-4">
                                <h5 class="card-title mb-3">Contact Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', $member->email) }}"
                                                   placeholder="Enter email">
                                            <label for="email">Email</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="{{ old('phone', $member->phone) }}"
                                                   placeholder="Enter phone">
                                            <label for="phone">Phone</label>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Details -->
                            <div class="mb-4">
                                <h5 class="card-title mb-3">Professional Details</h5>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('qualification') is-invalid @enderror" 
                                               id="qualification" 
                                               name="qualification" 
                                               value="{{ old('qualification', $member->qualification) }}"
                                               placeholder="Enter qualification">
                                        <label for="qualification">Qualification</label>
                                        @error('qualification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" 
                                               class="form-control @error('specializations') is-invalid @enderror" 
                                               id="specializations" 
                                               name="specializations" 
                                               value="{{ old('specializations', $member->specializations) }}"
                                               placeholder="Enter specializations">
                                        <label for="specializations">Specializations</label>
                                        @error('specializations')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" 
                                              name="bio" 
                                              style="height: 100px"
                                              placeholder="Enter bio">{{ old('bio', $member->bio) }}</textarea>
                                    <label for="bio">Biography</label>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Social Links -->
                            <div class="mb-4">
                                <h5 class="card-title mb-3">Social Media Links</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="url" 
                                                   class="form-control" 
                                                   id="facebook" 
                                                   name="social_links[facebook]" 
                                                   value="{{ old('social_links.facebook', $member->social_links['facebook'] ?? '') }}"
                                                   placeholder="Facebook URL">
                                            <label for="facebook">Facebook</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="url" 
                                                   class="form-control" 
                                                   id="twitter" 
                                                   name="social_links[twitter]" 
                                                   value="{{ old('social_links.twitter', $member->social_links['twitter'] ?? '') }}"
                                                   placeholder="Twitter URL">
                                            <label for="twitter">Twitter</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="url" 
                                                   class="form-control" 
                                                   id="linkedin" 
                                                   name="social_links[linkedin]" 
                                                   value="{{ old('social_links.linkedin', $member->social_links['linkedin'] ?? '') }}"
                                                   placeholder="LinkedIn URL">
                                            <label for="linkedin">LinkedIn</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="url" 
                                                   class="form-control" 
                                                   id="instagram" 
                                                   name="social_links[instagram]" 
                                                   value="{{ old('social_links.instagram', $member->social_links['instagram'] ?? '') }}"
                                                   placeholder="Instagram URL">
                                            <label for="instagram">Instagram</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Photo Upload -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Profile Photo</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="file" 
                                               class="form-control @error('photo') is-invalid @enderror" 
                                               id="photo" 
                                               name="photo"
                                               accept="image/*"
                                               onchange="previewImage(this)">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <img id="photoPreview" 
                                             src="{{ $member->photo ? Storage::url($member->photo) : asset('assets/img/placeholder.png') }}" 
                                             alt="{{ $member->name }}" 
                                             class="img-thumbnail"
                                             style="max-width: 200px;">
                                    </div>
                                    @if($member->photo)
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="remove_photo" 
                                                   id="remove_photo" 
                                                   value="1">
                                            <label class="form-check-label" for="remove_photo">
                                                Remove existing photo
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Status and Order -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                    id="status" 
                                                    name="status">
                                                <option value="1" {{ old('status', $member->status) ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ !old('status', $member->status) ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <label for="status">Status</label>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <input type="number" 
                                               class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" 
                                               name="sort_order" 
                                               value="{{ old('sort_order', $member->sort_order) }}"
                                               placeholder="Enter sort order">
                                        <label for="sort_order">Sort Order</label>
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('photoPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection