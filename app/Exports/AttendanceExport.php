<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
// use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class AttendanceExport implements FromCollection
{

	public function view(): View
    {
        // return view('exports.products', [
            // 'products' => Product::all()
        // ]);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }
}
