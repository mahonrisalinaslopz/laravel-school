<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CareerController extends Controller
{
    public function index()
    {
        $data = Career::all();

        return View("career.index", ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View("career.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Career::create([
            "name" => $request->name,
            "description" => $request->description,
        ]);
        return View("career.index")->with("status", "Registro Creado");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $career = Career::find($id);
        return View("career.show", ["career" => $career]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $career = Career::find($id);
        return View("career.edit", ["career" => $career]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $career = Career::find($id);
        $career->update(
            [
                "name" => $request->name,
                "description" => $request->description,
            ]
        );
        return View("career.index")->with("status", "Registro Actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $career = Career::find($id);
        return View("career.index")->with("status", "Registro Borrado");
    }
}
