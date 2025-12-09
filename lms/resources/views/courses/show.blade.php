@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="display-5">Course Details</h1>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $course->title }}</h5>
                <p class="card-text"><strong>Code:</strong> {{ $course->code }}</p>
                <p class="card-text">{{ $course->description }}</p>
                <a href="{{ route('courses.edit', $course->id) }}" class="card-link">Edit</a>
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger p-0 align-baseline">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
