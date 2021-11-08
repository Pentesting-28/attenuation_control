<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
// use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{

	public function view(): View
    {
        return view('reports.exports.general_attendance');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }
}
