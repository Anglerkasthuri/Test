<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

use App\Models\Country;
use App\Models\Timezone;
use App\Models\Continent;

use App\Models\SubContinent;

use Spatie\Permission\Models\Role;
use App\Http\Livewire\AdminComponent as AdminComponent;
use Illuminate\Support\Arr;

class CommonFilter extends Component
{
    public $filterFile = "";
    public $row = "";
    public $search = "";

    public function render()
    {
        $this->emit('selectLoadOk');
        return view($this->filterFile);
    }

    public function search()
    {
        $this->emitUp('searchValue', $this->search);
    }

    public function resetSearch()
    {
        $this->search = [];
        $this->emitUp('resetSearch');
    }

    public function export()
    {
        $this->emitUp('export');
    }

    public function getSearchContinentListProperty()
    {
        return Continent::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchSubContinentListProperty()
    {
        
        // return 
        // SubContinent::query()
        // ->when(Arr::get($this->search, 'continent_id'), fn($query, $continentId) => $query->whereIn('continent_id', $continentId))
        // ->toBase()
        // ->pluck('title', 'id'); 
        return 
        SubContinent::select(['id', 'title', 'continent_id'])
        ->with('continent')
        ->get()
        ->when(Arr::get($this->search, 'continent_id'), fn($query, $continentId) => $query->whereIn('continent_id', $continentId))
        ->groupBy('continent.title')->map(function($q) {
            return $q->pluck('title', 'id');
        });
                
    }


    public function updated($name, $value)
    {
       
        if($name === "search.continent_id") {
            Arr::set($this->search, 'sub_continent_id', null);
        }
    }
}
