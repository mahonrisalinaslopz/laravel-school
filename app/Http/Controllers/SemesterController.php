<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $data = Semester::all();
        return View("semester.index", ["data" => $data]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View("semester.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Semester::create([
            "name" => $request->name,
            "description" => $request->description,
        ]);
        return View("semester.index")->with("status", "Registro Creado");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $semester = Semester::find($id);
        return View("semester.show", ["semester" => $semester]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $semester = Semester::find($id);
        return View("semester.edit", ["semester" => $semester]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $semester = Semester::find($id);
        $semester->update(
            [
                "name" => $request->name,
                "description" => $request->description,
            ]
        );
        return View("semester.index")->with("status", "Registro Actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $semester = Semester::find($id);
        return View("semester.index")->with("status", "Registro Borrado");
    }
}
