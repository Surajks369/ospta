
@extends('admin.layouts.app')

@section('title', 'FAQ Details')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-question-circle me-2 text-primary"></i>FAQ Details</h2>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to FAQs
            </a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Details</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">{{ $faq->question }}</h4>
                        <p class="mb-2"><strong>Answer:</strong> {{ $faq->answer }}</p>
                        <p class="mb-2"><strong>Category:</strong> <span class="badge bg-info">{{ $faq->category ?? 'No category' }}</span></p>
                        <p class="mb-2"><strong>Order Position:</strong> {{ $faq->sort_order ?? 0 }}</p>
                        <p class="mb-2"><strong>Status:</strong> <span class="badge bg-{{ $faq->status ? 'success' : 'danger' }}">{{ $faq->status ? 'Active' : 'Inactive' }}</span></p>
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to FAQs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
