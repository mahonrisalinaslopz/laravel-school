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
            "phone" => "required",
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

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "new_apellidos" => "required",
            "new_nombre" => "required",
            "new_email" => "required|email",
            "new_phone" => "required",
            "new_rol" => "required",
        ]);

        $user = User::find($id);

        // Corroboramos si es que la data es de un maestro o un alumno
        if (Teacher::where("user_id", $id)->first()) {
            $dataUser = Teacher::where("user_id", $id)->first();
        } else {
            $dataUser = Student::where("user_id", $id)->first();
        }

        // Manejamos la falla de la validación
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route("users.index")->with("error_form_edit", "El formulario para editar los datos del usuario $dataUser->name $dataUser->last_name tiene errores o está incompleto.")->withErrors($errors);
        } else {
            // Actualizo los primeros datos del formulario
            $user->email = $request->new_email;
            if ($request->new_password !== null && $request->new_password !== "") {
                $user->password = bcrypt($request->new_password);
            }
            $user->save();
            
            // Validamos si es que el rol enviado desde el formulario es igual al que ya tiene el usuario
            $rolesUser = $user->getRoleNames();
            if ($rolesUser[0] !== $request->new_rol) {
                // Corroborar si el nombre del rol existe
                $roles = Role::all();
                $arrayRoles = []; // Guardo el nombre de los roles en un array
                foreach ($roles as $rol) {
                    $arrayRoles[] = $rol->name;
                }

                // Corroboro si es que el rol que recibí de el formulario existe en el array que contiene todos los roles.
                $newRol = $request->new_rol;
                $responseExists = in_array($newRol, $arrayRoles, true);

                // Manejo las acciones en base a si existe o no el nuevo rol
                if ($responseExists) {
                    // Remuevo todos los roles para que esté libre de errores
                    foreach ($arrayRoles as $rol) {
                        $user->removeRole($rol);
                    }
                    // Asigno el nuevo rol
                    $user->assignRole($newRol);

                    switch ($newRol !== $rolesUser[0]) {
                        case (($rolesUser[0] === "admin" || $rolesUser[0] === "teacher") && $newRol === "student"):
                            $newStudent = new Student();
                            $newStudent->user_id = $dataUser->user_id;
                            $newStudent->name = $request->new_nombre;
                            $newStudent->last_name = $request->new_apellidos;
                            $newStudent->phone = $request->new_phone;
                            $newStudent->official_code = fake()->unique()->ean8();
                            $newStudent->save();

                            $dataUser->delete();

                            return redirect()->route("users.index")->with("success_form_edit", "Datos del usuario $dataUser->name $dataUser->last_name actualizados correctamente. Debido al cambio de rol a estudiante se le ha creado un nuevo código oficial: $newStudent->official_code.");
                            break;

                        case ($rolesUser[0] === "student" && ($newRol === "admin" || $newRol === "teacher")):
                            $newTeacher = new Teacher();
                            $newTeacher->user_id = $dataUser->user_id;
                            $newTeacher->name = $request->new_nombre;
                            $newTeacher->last_name = $request->new_apellidos;
                            $newTeacher->phone = $request->new_phone;
                            $newTeacher->save();

                            $dataUser->delete();

                            return redirect()->route("users.index")->with("success_form_edit", "Datos del usuario $dataUser->name $dataUser->last_name actualizados correctamente. Debido al cambio de rol se ha eliminado el código oficial.");
                            break;
                    }
                } else {
                    return redirect()->route("users.index")->with("error_form_edit", "El rol que seleccionaste no existe");
                }
            }

            $dataUser->last_name = $request->new_apellidos;
            $dataUser->name = $request->new_nombre;
            $dataUser->phone = $request->new_phone;
            $dataUser->save();

            return redirect()->route("users.index")->with("success_form_edit", "Datos del usuario $dataUser->name $dataUser->last_name actualizados correctamente.");
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route("users.index")->with("success_form_delete", "Usuario eliminado");
    }
}
