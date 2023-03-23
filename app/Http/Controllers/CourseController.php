<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::all();
        return View("course.index", ["data" => $data]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View("course.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Course::create([
            "name" => $request->name,
            "description" => $request->description,
            "link" => $request->link,
            "career_id" => $request->career_id,
            "semester_id" => $request->semester_id
        ]);
        return View("course.index")->with("status", "Registro Creado");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        return View("course.show", ["course" => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        return View("course.edit", ["course" => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::find($id);
        $course->update(
            [
                "name" => $request->name,
                "description" => $request->description,
                "link" => $request->link,
                "career_id" => $request->career_id,
                "semester_id" => $request->semester_id
            ]
        );
        return View("course.index")->with("status", "Registro Actalizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $course->delete();
        return View("course.index")->with("status", "Registro Borrado");
    }
}
