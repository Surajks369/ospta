@extends('admin.layouts.app')

@section('title', 'Team Members')

@section('content')
<div class="admin-wrapper">
    @include('admin.partials.navigation')
    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-users me-2 text-primary"></i>Team Members</h2>
            <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Member
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if($members->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" width="80">Photo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>
                                            @if($member->photo)
                                                <img src="{{ asset('storage/' . $member->photo) }}" 
                                                     alt="{{ $member->name }}" 
                                                     class="rounded-circle"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->job_title }}</td>
                                        <td>{{ $member->sort_order }}</td>
                                        <td>
                                            <span class="badge bg-{{ $member->status ? 'success' : 'danger' }}">
                                                {{ $member->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.team.show', $member) }}" 
                                                   class="btn btn-sm btn-info text-white" 
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.team.edit', $member) }}" 
                                                   class="btn btn-sm btn-warning text-white"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.team.destroy', $member) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this member?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $members->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <img src="{{ asset('assets/img/empty.svg') }}" alt="No Members" class="mb-3" style="max-width: 200px;">
                        <h4>No Team Members Found</h4>
                        <p class="text-muted">Start by adding your first team member.</p>
                        <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Add New Member
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection