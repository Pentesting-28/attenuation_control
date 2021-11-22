<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Student\{Attendance, Student};
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{

	public function view(): View
    {
        $attendances = Student::with('attendance','absence_justification')
                                 ->orderBy('created_at', 'ASC')
                                 ->get();
        // dd($attendances);
        return view('reports.exports.general_attendance', compact('attendances'));
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }
}
