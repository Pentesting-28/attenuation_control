<?php

namespace App\Http\Livewire\Sport;

use Livewire\Component;

use App\Models\Student\Sport;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
	use WithPagination;

    protected $paginationTheme = 'bootstrap';

  	public
        $name,
        $sport_id,
        $filter = [
            'sport_name' => null,
        ];



    public function render()
    {
      	$sports = Sport::when($this->filter["sport_name"] != null, function ( Builder $query ) {
                            $query->where('name', 'LIKE', '%'.$this->filter["sport_name"].'%');
                         })
                        ->orderBy('created_at', 'ASC')
                        ->paginate(10);
    	// dd($sports);
        return view('livewire.sport.index', compact('sports'));
    }






    public function clearProperty()
    {
        $this->reset([
          'name',
          'sport_id',
        ]);

        $this->resetValidation();
    }






    public function store()
    {
      	$validatedData = $this->validate([
      		'name' => 'required|string|min:3|max:255',
      	]);

      	Sport::create([
      		'name' => $this->name,
      	]);

      	$this->clearProperty();

      	$this->emit('modalHide');

      	$this->emit('confirm_create');
    }






    public function modal($action, Sport $sport)
    {
        switch ($action) {
          case 'edit':

            $this->fill([
              'name' => $sport->name,
              'sport_id' => $sport->id,
            ]);

          break;

          case 'destroy':

            $this->fill([
              'sport_id'    => $sport->id,
            ]);

          break;
        }
    }






    public function update(Sport $sport)
    {
    		$validatedData = $this->validate([
    			'name' => 'required|string|min:3|max:255',
    		]);

    		$sport_update = $sport->update([
    			'name' => $this->name,
    		]);

    		$this->clearProperty();

    		$this->emit('modalHide');

    		$this->emit('confirm_update');
    }






    public function destroy(Sport $sport)
    {
        $sport->delete();

        $this->clearProperty();

        $this->emit('modalHide');
    }
}
