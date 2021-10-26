<?php
/*|---------------------Import Class----------------------*/

/*Dashboard*/
use App\Http\Livewire\Template\Dashboard;

/*Crud */
use App\Http\Livewire\Student\Index as StudentIndex;

/*Attendance Register*/
use App\Http\Livewire\Student\Attendance as AttendanceRegister;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::get('/', AttendanceRegister::class)->name('attendance.register');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/students', StudentIndex::class)->name('student.index');

});