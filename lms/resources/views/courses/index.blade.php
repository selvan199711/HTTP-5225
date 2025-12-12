@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="display-5">Courses</h1>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
        </div>
    </div>
</div>
<div class="row mt-4">
    @forelse($courses as $course)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($course->description, 80) }}</p>
                    @if($course->professor)
                        <p class="mb-1"><strong>Professor:</strong> {{ $course->professor->fname }} {{ $course->professor->lname }}</p>
                    @endif
                    <p class="text-muted small mb-2">Enrolled Students: {{ $course->students->count() }}</p>
                    <a href="{{ route('courses.show', $course->id) }}" class="card-link">View</a>
                    <a href="{{ route('courses.edit', $course->id) }}" class="card-link">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger p-0 align-baseline">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <div class="alert alert-info">No courses available.</div>
        </div>
    @endforelse
</div>
@endsection
