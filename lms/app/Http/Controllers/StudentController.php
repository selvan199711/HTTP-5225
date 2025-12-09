<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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
            'students' => Student::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        Student::create($request->validated());

        Session::flash('success', 'Student added successfully');

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        Session::flash('success', 'Student updated successfully');

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = Student::withTrashed()->where('id', $id)->first();
        $student?->forceDelete();

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
            'students' => Student::onlyTrashed()->get(),
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
