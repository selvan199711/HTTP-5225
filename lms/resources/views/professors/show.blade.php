@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="display-5">Professor</h1>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $professor->name }}</h5>
                <a href="{{ route('professors.edit', $professor->id) }}" class="card-link">Edit</a>
                <form action="{{ route('professors.destroy', $professor->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger p-0 align-baseline">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
