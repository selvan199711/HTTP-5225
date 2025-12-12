<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('students.index', [
            'students' => Student::with('courses')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create', [
            'courses' => Course::with('professor')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $data = $request->safe()->only(['fname', 'lname', 'email']);
        $student = Student::create($data);
        $student->courses()->sync($request->input('course_ids', []));

        Session::flash('success', 'Student added successfully');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        $student->load('courses');

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        $student->load('courses');

        return view('students.edit', [
            'student' => $student,
            'courses' => Course::with('professor')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $data = $request->safe()->only(['fname', 'lname', 'email']);
        $student->update($data);
        $student->courses()->sync($request->input('course_ids', []));

        Session::flash('success', 'Student updated successfully');

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = Student::withTrashed()->where('id', $id)->first();
        if ($student) {
            $student->courses()->detach();
            $student->forceDelete();
        }

        Session::flash('success', 'Student deleted permanently');

        return redirect()->route('students.index');
    }

    public function trash(int $id): RedirectResponse
    {
        Student::destroy($id);

        Session::flash('success', 'Student trashed successfully');

        return redirect()->route('students.index');
    }

    public function trashed(): View
    {
        return view('students.index', [
            'students' => Student::onlyTrashed()->with('courses')->get(),
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        $student = Student::withTrashed()->where('id', $id)->first();
        $student?->restore();

        Session::flash('success', 'Student restored successfully');

        return redirect()->route('students.trashed');
    }
}
