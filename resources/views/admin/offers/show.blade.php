@extends('admin.layouts.app')
@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-eye me-2 text-primary"></i>View Offer</h2>
            <div>
                <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Offers
                </a>
            </div>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Offer Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($offer->image)
                            <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="img-fluid rounded">
                        @else
                            <div class="text-center p-5 bg-light rounded">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="text-muted mt-2">No image available</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150">Title:</th>
                                <td>{{ $offer->title }}</td>
                            </tr>
                            <tr>
                                <th>Offer Code:</th>
                                <td>{{ $offer->offer_code ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $offer->description }}</td>
                            </tr>
                            <tr>
                                <th>Discount Type:</th>
                                <td>{{ ucfirst($offer->discount_type) }}</td>
                            </tr>
                            <tr>
                                <th>Discount Value:</th>
                                <td>{{ $offer->discount_value }}</td>
                            </tr>
                            <tr>
                                <th>Maximum Discount:</th>
                                <td>{{ $offer->maximum_discount ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Minimum Amount:</th>
                                <td>{{ $offer->minimum_amount ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Usage Limit:</th>
                                <td>{{ $offer->usage_limit ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Used Count:</th>
                                <td>{{ $offer->used_count ?? '0' }}</td>
                            </tr>
                            <tr>
                                <th>Start Date:</th>
                                <td>{{ $offer->start_date ? $offer->start_date->format('Y-m-d') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>End Date:</th>
                                <td>{{ $offer->end_date ? $offer->end_date->format('Y-m-d') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $offer->status ? 'success' : 'secondary' }}">
                                        {{ $offer->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
