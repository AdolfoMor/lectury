<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseCategory;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('category')
            ->latest()
            ->paginate(10);

        return inertia('Admin/Courses/Index', [
            'courses' => Course::all(['id', 'name', 'modality', 'type', 'start_date', 'end_date']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Courses/Form', [
            'categories' => CourseCategory::all(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:course_categories,id',
            'modality' => 'required|in:Presencial,En línea,Mixta',
            'type' => 'required|in:Gratuito,Pago',
            'price' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data['created_by'] = auth()->id();
        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Curso creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return inertia('Admin/Courses/Form', [
            'course' => $course,
            'categories' => CourseCategory::all(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:course_categories,id',
            'modality' => 'required|in:Presencial,En línea,Mixta',
            'type' => 'required|in:Gratuito,Pago',
            'price' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Curso eliminado.');
    }
}
