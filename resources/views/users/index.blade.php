@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <h1 class="mb-4">User Management</h1>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="search" class="form-control" placeholder="Search by Name, Department, or Designation">
                </div>
                <div class="col-md-3">
                    <button id="reset" class="btn btn-secondary w-100">
                        <i class="fas fa-undo me-1"></i>Reset
                    </button>
                </div>
                <div class="col-md-3">
                    <button id="export-csv" class="btn btn-success w-100">
                        <i class="fas fa-file-csv me-1"></i>Export CSV
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="user-grid">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($users as $user)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">
                                <i class="fas fa-building me-1"></i><strong>Department:</strong> {{ $user->department->name }}<br>
                                <i class="fas fa-id-badge me-1"></i><strong>Designation:</strong> {{ $user->designation->name }}<br>
                                <i class="fas fa-phone me-1"></i><strong>Phone:</strong> {{ $user->phone_number }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
