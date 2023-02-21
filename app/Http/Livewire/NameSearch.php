<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class NameSearch extends Component
{
    public $searchName;

    public function render()
    {
        return view('livewire.name-search',[
            'name'=>User::when($this->searchName, function($query,$searchName){
                return $query->where('name','LIKE',"%$searchName%");
            })->paginate(10)
        ]);
    }
}
