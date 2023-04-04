<?php


use App\Http\Controllers\CareerController;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\Frontend\AdminController;
use App\Http\Controllers\Frontend\UserController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SemesterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('frontend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('dashboard',[AdminController::class,'dashboard']);
    Route::resource('dashboard', AdminController::class)->only("index")->names("admin");
    Route::delete('dashboard/logout', [AdminController::class, 'logout'])->name("logout_user");
    Route::resource('users', UserController::class)->only("index", "store", "update", "destroy")->names("users");
});


Route::controller(CareerController::class)->group(function () {
    Route::get('/careers', 'index');
});
Route::controller(CourseController::class)->group(function () {
    Route::get('/courses', 'index');
});
Route::controller(SemesterController::class)->group(function () {
    Route::get('/semesters', 'index');
});



/* Route::get('backend', function() {
    return view('dashboard',[AdminController::class,'dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard'); */

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
