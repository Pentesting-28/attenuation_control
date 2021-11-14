<?php

namespace App\Http\Livewire\ListsBySports;

use Livewire\Component;

class AttendanceList extends Component
{
    public function render()
    {
        return view('livewire.lists-by-sports.attendance-list');
    }

    public function mount($sport)
    {
    	if(is_numeric($sport))
    	{
    		dd($sport);
    	}
    }
}
