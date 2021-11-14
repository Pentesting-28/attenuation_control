<?php

namespace App\Http\Livewire\Template;

use Livewire\Component;

use App\Models\Student\Sport;

class Sidebar extends Component
{
    public function render()
    {
    	$sports = Sport::get(['id','name']);
        return view('livewire.template.sidebar', compact('sports'));
    }
}
