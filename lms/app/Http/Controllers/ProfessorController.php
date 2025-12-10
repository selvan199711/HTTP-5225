<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Models\Professor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('professors.index', [
            'professors' => Professor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('professors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessorRequest $request): RedirectResponse
    {
        Professor::create($request->validated());

        Session::flash('success', 'Professor added successfully');

        return redirect()->route('professors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Professor $professor): View
    {
        return view('professors.show', compact('professor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professor $professor): View
    {
        return view('professors.edit', compact('professor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessorRequest $request, Professor $professor): RedirectResponse
    {
        $professor->update($request->validated());

        Session::flash('success', 'Professor updated successfully');

        return redirect()->route('professors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professor): RedirectResponse
    {
        $professor->delete();

        Session::flash('success', 'Professor deleted successfully');

        return redirect()->route('professors.index');
    }
}
