<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }

}
