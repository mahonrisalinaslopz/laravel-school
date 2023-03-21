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
}
