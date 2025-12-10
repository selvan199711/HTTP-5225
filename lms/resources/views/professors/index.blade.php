@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="display-5">Professors</h1>
            <a href="{{ route('professors.create') }}" class="btn btn-primary">Add Professor</a>
        </div>
    </div>
</div>
<div class="row mt-4">
    @forelse($professors as $professor)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $professor->name }}</h5>
                    <a href="{{ route('professors.show', $professor->id) }}" class="card-link">View</a>
                    <a href="{{ route('professors.edit', $professor->id) }}" class="card-link">Edit</a>
                    <form action="{{ route('professors.destroy', $professor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger p-0 align-baseline">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <div class="alert alert-info">No professors available.</div>
        </div>
    @endforelse
</div>
@endsection
