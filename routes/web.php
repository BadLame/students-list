<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/", [StudentController::class, "index"])->name("list");

//Route::post("/", [StudentController::class, "search"]);

Route::get("/student", [StudentController::class, "show"])->name("student");

Route::post("/student", [StudentController::class, "store"]);
Route::post("/student/edit", [StudentController::class, "update"]);
