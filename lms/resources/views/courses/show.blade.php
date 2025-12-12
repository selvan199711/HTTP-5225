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
                <h5 class="card-title">{{ $course->name }}</h5>
                <p class="card-text">{{ $course->description }}</p>
                @if($course->professor)
                    <p class="mb-1"><strong>Professor:</strong> {{ $course->professor->fname }} {{ $course->professor->lname }}</p>
                    <p class="text-muted mb-3">{{ $course->professor->email }}</p>
                @endif
                @if($course->students->isNotEmpty())
                    <p class="fw-semibold mb-1">Enrolled Students</p>
                    <ul class="small">
                        @foreach ($course->students as $student)
                            <li>{{ $student->fname }} {{ $student->lname }} ({{ $student->email }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No students enrolled.</p>
                @endif
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
