@extends('admin.layouts.app')

@section('title', 'Add New FAQ')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-question-circle me-2 text-primary"></i>Add New FAQ</h2>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to FAQs
            </a>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.faqs.store') }}" method="POST" id="faqForm">
                            @csrf
                            <div class="mb-3">
                                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('question') is-invalid @enderror" 
                                       id="question" name="question" value="{{ old('question') }}" required>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('answer') is-invalid @enderror" 
                                          id="answer" name="answer" rows="6" required>{{ old('answer') }}</textarea>
                                @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                               id="category" name="category" value="{{ old('category') }}" 
                                               placeholder="e.g., General, Courses, Payment" required>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sort_order" class="form-label">Order Position</label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                        @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                           {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        Active Status
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Save FAQ
                                </button>
                                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tips</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Write clear and concise questions</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Provide detailed answers</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use categories to organize FAQs</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Set order position to control display sequence</li>
                            <li><i class="fas fa-check text-success me-2"></i>Use HTML formatting in answers if needed</li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Common Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge bg-secondary category-suggestion" style="cursor: pointer;">General</span>
                            <span class="badge bg-secondary category-suggestion" style="cursor: pointer;">Courses</span>
                            <span class="badge bg-secondary category-suggestion" style="cursor: pointer;">Payment</span>
                            <span class="badge bg-secondary category-suggestion" style="cursor: pointer;">Enrollment</span>
                            <span class="badge bg-secondary category-suggestion" style="cursor: pointer;">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category suggestions
    const categoryInput = document.getElementById('category');
    const categorySuggestions = document.querySelectorAll('.category-suggestion');

    categorySuggestions.forEach(suggestion => {
        suggestion.addEventListener('click', function() {
            categoryInput.value = this.textContent;
        });
    });
});
</script>
@endsection
