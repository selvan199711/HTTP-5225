@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="display-5">Student Profile</h1>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $student->fname }} {{ $student->lname }}</h5>
                <p class="card-text">{{ $student->email }}</p>
                @if($student->courses->isNotEmpty())
                    <p class="fw-semibold mb-1">Enrolled Courses</p>
                    <ul class="small">
                        @foreach ($student->courses as $course)
                            <li>{{ $course->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Not enrolled in any courses yet.</p>
                @endif
                <a href="{{ route('students.edit', $student->id) }}" class="card-link">Edit</a>
                <a href="{{ route('students.trash', $student->id) }}" class="card-link text-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
