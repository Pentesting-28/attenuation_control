<?php

namespace App\Http\Livewire\ListsBySports;

use Livewire\Component;

class StudentList extends Component
{
    public function render()
    {
        return view('livewire.lists-by-sports.student-list');
    }

    public function mount($sport)
    {
    	dd($sport);
    }
}
