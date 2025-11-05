<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::with('course:id,name')->get(['id', 'course_id', 'name', 'start_date', 'end_date']);

        return Inertia::render('Admin/Groups/Index', [
            'groups' => $groups,
        ]);
    }

    public function byCourse(Course $course)
    {
        $groups = $course->group()
            ->select('id', 'name', 'start_date', 'end_date')
            ->get();

        return Inertia::render('Admin/Groups/Group', [
            'course' => $course->only('id', 'name'),
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::select('id', 'name')->get();

        return Inertia::render('Admin/Groups/Form', [
            'courses' => $courses,
            'group' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Group::create($validated);

        return redirect()->route('admin.groups.index')->with('success','Grupo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $courses = Course::select('id', 'name')->get();

        return Inertia::render('Admin/Groups/Form', [
            'courses' => $courses,
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
         $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $group->update($validated);

        return redirect()->route('admin.groups.index')->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return back()->with('success', 'Grupo eliminado correctamente.');
    }
}
