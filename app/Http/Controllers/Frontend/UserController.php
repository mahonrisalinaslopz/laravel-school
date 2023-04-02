<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $teachers = DB::table('users')
        //     ->join("teachers", "users.id", "=", "teachers.user_id")
        //     ->get();

        // $students = DB::table('users')
        //     ->join("students", "users.id", "=", "students.user_id")
        //     ->get();
        $teachers = Teacher::all();
        $students = Student::all();

        $totalUsers = [];

        foreach ($teachers as $teacher) {
            $totalUsers[] = $teacher;
        }

        foreach ($students as $student) {
            $totalUsers[] = $student;
        }

        $roles = Role::all();

        return view("frontend.users.index", [
            "users" => $totalUsers,
            "roles" => $roles
        ]);
        // return $totalUsers[10]->users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "apellidos" => "required",
            "nombre" => "required",
            "codigo" => "required",
            "email" => "required|email",
            "phone" => "required|numeric",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route("users.index")->with("error_form_add", "Faltan los siguientes datos en el formulario para añadir usuarios:")->withErrors($errors);
        } else {
            $newUser = new User();
            $newUser->email = $request->email;
            $newUser->password = bcrypt($request->password);
            $newUser->save();

            $rolInput = $request->rol;
            $userCreated = User::where("email", $request->email)->first();
            $idUserCreated = $userCreated->id;

            switch ($rolInput) {
                case $rolInput === "1" || $rolInput === "2":
                    $newTeacher = new Teacher();
                    $newTeacher->user_id = $idUserCreated;
                    $newTeacher->name = $request->nombre;
                    $newTeacher->last_name = $request->apellidos;
                    $newTeacher->phone = $request->phone;
                    $newTeacher->save();

                    if ($rolInput === "1") {
                        $userCreated->assignRole("admin");
                        return redirect()->route("users.index")->with("success_form_add", "Admin agregado");
                    } else {
                        $userCreated->assignRole("teacher");
                        return redirect()->route("users.index")->with("success_form_add", "Maestro agregado");
                    }
                    break;
                case "3":
                    $newTeacher = new Student();
                    $newTeacher->user_id = $idUserCreated;
                    $newTeacher->name = $request->nombre;
                    $newTeacher->last_name = $request->apellidos;
                    $newTeacher->phone = $request->phone;
                    $newTeacher->official_code = $request->codigo;
                    $newTeacher->save();

                    $userCreated->assignRole("student");
                    return redirect()->route("users.index")->with("success_form_add", "Alumno agregado");
                    break;
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route("users.index")->with("success_form_delete", "Usuario eliminado");
    }
}
