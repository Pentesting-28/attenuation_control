<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;

use App\Models\Student\{Attendance, Student};
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';

    public function render()
    {
    	$attendances = Attendance::with('student')
    							 ->has('student')
    							 ->paginate(10);

        return view('livewire.attendance.index', compact('attendances'));
    }
}
