@extends('layouts.app')

@section('title', 'Designation Management')

@section('content')
    <h1 class="mb-4">Designation Management</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('designations.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" class="form-control" placeholder="New Designation Name" required>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Add Designation
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($designations as $designation)
                            <tr>
                                <td>{{ $designation->id }}</td>
                                <td>
                                    <form action="{{ route('designations.update', $designation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $designation->name }}" class="form-control d-inline-block w-auto">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-save me-1"></i>Update
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('designations.destroy', $designation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $designations->links('pagination::bootstrap-5') }}
    </div>
@endsection
