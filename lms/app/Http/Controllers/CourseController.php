<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('courses.index', [
            'courses' => Course::with(['professor', 'students'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $professor = Professor::create([
                'fname' => $data['professor_fname'],
                'lname' => $data['professor_lname'],
                'email' => $data['professor_email'],
            ]);

            Course::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'professor_id' => $professor->id,
            ]);
        });

        Session::flash('success', 'Course added successfully');

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): View
    {
        $course->load(['professor', 'students']);

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course): View
    {
        $course->load('professor');

        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($course, $data) {
            $course->update([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

            if ($course->professor) {
                $course->professor->update([
                    'fname' => $data['professor_fname'],
                    'lname' => $data['professor_lname'],
                    'email' => $data['professor_email'],
                ]);
            } else {
                $professor = Professor::create([
                    'fname' => $data['professor_fname'],
                    'lname' => $data['professor_lname'],
                    'email' => $data['professor_email'],
                ]);
                $course->update(['professor_id' => $professor->id]);
            }
        });

        Session::flash('success', 'Course updated successfully');

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        $professor = $course->professor;
        $course->students()->detach();
        $course->delete();
        $professor?->delete();

        Session::flash('success', 'Course deleted successfully');

        return redirect()->route('courses.index');
    }
}
