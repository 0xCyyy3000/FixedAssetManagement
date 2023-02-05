<?php

namespace App\Http\Livewire;

use App\Models\ItemProfile;
use Livewire\Component;

class Search extends Component
{
    public $query = '';
    public $results;

    protected $queryString = ['results'];

    public function render()
    {

        if (strlen($this->query) > 1) {
            $this->results = ItemProfile::where('title', 'like', "%{$this->query}%")->get();
        }
        return view('livewire.search');
    }
}
