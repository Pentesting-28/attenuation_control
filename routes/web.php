<?php
/*|---------------------Import Class----------------------*/

/*Dashboard*/
use App\Http\Livewire\Template\Dashboard;

/*Crud Student*/
use App\Http\Livewire\Student\Index as StudentIndex;

/*Render Data Attendance Register*/
use App\Http\Livewire\Student\Attendance as AttendanceRegister;

/*Crud Attendance*/
use App\Http\Livewire\Attendance\Index as AttendanceIndex;

/*Crud Sport*/
use App\Http\Livewire\Sport\Index as SportIndex;

/*Render Data AbsenceJustification*/
use App\Http\Livewire\AbsenceJustification\Index as AbsenceJustificationIndex;

/*
	Render Student List
	Render Attendance List
 */
use App\Http\Livewire\ListsBySports\{
	StudentList as StudentListIndex,
	AttendanceList as AttendanceListIndex,
};


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

    Route::get('/attendance', AttendanceIndex::class)->name('attendance.index');

    Route::get('/sport', SportIndex::class)->name('sport.index');

    Route::get('/absence_justification', AbsenceJustificationIndex::class)->name('absence_justification.index');

    Route::get('/student_list/{sport}', StudentListIndex::class)->name('student_list.index');

    Route::get('/attendance_list/{sport}', AttendanceListIndex::class)->name('attendance_list.index');



});
