<?php

namespace App\Livewire;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchLocation extends Component
{

    public $center;
    public $search = 'jember';
    public function render()
    {
        $loc = ($this->search !== '') ? Location::where('regency', 'like', '%' . $this->search . '%')->get() : [];

        return view('livewire.search-location', ['search' => $this->search,'locations' => $loc]);
    }
}
