<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search = "";
    private $paginate = 10;
    public bool $showOnlyActive;

    public function mount($showOnlyActive = true){
        $this->showOnlyActive = filter_var($showOnlyActive, FILTER_VALIDATE_BOOLEAN);
    }

    public function render()
    {
        if(!empty($this->search)){
            $members = User::search($this->search);
        }else{
            $members = User::query();
        }

        if($this->showOnlyActive){
            $members = $members->where('is_active',true);
        }

        $members = $members->paginate($this->paginate);

        return view('livewire.search',[
            'members' =>  $members
        ]);
    }
}
