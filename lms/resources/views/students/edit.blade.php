@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h1 class="display-5">Update Student Profile</h1>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-8">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname', $student->fname) }}">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname', $student->lname) }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="course_ids" class="form-label">Enrolled Courses</label>
                <select class="form-select" id="course_ids" name="course_ids[]" multiple>
                    @php
                        $selectedCourses = collect(old('course_ids', $student->courses->pluck('id')->toArray()));
                    @endphp
                    @forelse ($courses as $course)
                        <option value="{{ $course->id }}" @selected($selectedCourses->contains($course->id))>
                            {{ $course->name }}
                            @if($course->professor)
                                (Prof. {{ $course->professor->fname }} {{ $course->professor->lname }})
                            @endif
                        </option>
                    @empty
                        <option disabled>No courses available</option>
                    @endforelse
                </select>
                <div class="form-text">Hold Cmd/Ctrl to select multiple courses.</div>
                @error('course_ids')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
