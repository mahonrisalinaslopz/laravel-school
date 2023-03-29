<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = DB::table('users')
            ->join("teachers", "users.id", "=", "teachers.user_id")
            ->get();

        $students = DB::table('users')
            ->join("students", "users.id", "=", "students.user_id")
            ->get();

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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
