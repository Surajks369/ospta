@extends('admin.layouts.app')

@section('title', 'Offers')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <!-- Navigation already included above -->

    <div class="admin-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-tags me-2 text-primary"></i>Offers</h2>
            <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Offer
            </a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Offers</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Title</th>
                                <th>Offer Code</th>
                                <th>Discount Value</th>
                                <th>Maximum Discount</th>
                                <th>Minimum Amount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($offers as $offer)
                            <tr>
                                
                                <td><div class="fw-bold">{{ $offer->title }}</div></td>
                                <td>{{ $offer->offer_code ?? 'N/A' }}</td>
                                <td>{{ $offer->discount_value }}</td>
                                <td>{{ $offer->maximum_discount ?? 'N/A' }}</td>
                                <td>{{ $offer->minimum_amount ?? 'N/A' }}</td>
                                <td>{{ $offer->start_date ? $offer->start_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $offer->end_date ? $offer->end_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-{{ $offer->status ? 'success' : 'secondary' }}">
                                        {{ $offer->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <a href="{{ route('admin.offers.show', $offer->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this offer?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted">No offers found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($offers->hasPages())
                    <div class="d-flex justify-content-center">
                        {{ $offers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
