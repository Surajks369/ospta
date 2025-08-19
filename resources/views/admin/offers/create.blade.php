@extends('admin.layouts.app')
@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-plus me-2 text-primary"></i>Create Offer</h2>
            <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Offers
            </a>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Offer Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.offers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Title">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('offer_code') is-invalid @enderror" id="offer_code" name="offer_code" value="{{ old('offer_code') }}" placeholder="Offer Code">
                                <label for="offer_code">Offer Code</label>
                                @error('offer_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" style="height: 100px" required placeholder="Description">{{ old('description') }}</textarea>
                        <label for="description">Description <span class="text-danger">*</span></label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type" required aria-label="Discount Type">
                                    <option value="">Select Type</option>
                                    <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Percent</option>
                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                </select>
                                <label for="discount_type">Discount Type <span class="text-danger">*</span></label>
                                @error('discount_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" name="discount_value" value="{{ old('discount_value') }}" required placeholder="Discount Value">
                                <label for="discount_value">Discount Value <span class="text-danger">*</span></label>
                                @error('discount_value')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('maximum_discount') is-invalid @enderror" id="maximum_discount" name="maximum_discount" value="{{ old('maximum_discount') }}" placeholder="Maximum Discount">
                                <label for="maximum_discount">Maximum Discount</label>
                                @error('maximum_discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control @error('minimum_amount') is-invalid @enderror" id="minimum_amount" name="minimum_amount" value="{{ old('minimum_amount') }}" placeholder="Minimum Amount">
                                <label for="minimum_amount">Minimum Amount</label>
                                @error('minimum_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" name="usage_limit" value="{{ old('usage_limit') }}" placeholder="Usage Limit">
                                <label for="usage_limit">Usage Limit</label>
                                @error('usage_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required placeholder="Start Date">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required placeholder="End Date">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required aria-label="Status">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <label for="status">Status <span class="text-danger">*</span></label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Create Offer</button>
                    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary ms-2"><i class="fas fa-arrow-left me-1"></i>Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

