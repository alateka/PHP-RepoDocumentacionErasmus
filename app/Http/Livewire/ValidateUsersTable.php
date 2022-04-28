<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ValidateUsersTable extends Component
{

    use WithPagination;

    public $paginate = 15;
    public $search = "";

    protected $queryString = [
        'search' => ['except' => ''],
    ]; 

    public function render()
    {
        $users = User::where('verified', 0)
                    ->where(function($query){
                        $query->where('users.name', 'like', "%{$this->search}%")
                        ->orWhere('users.last_name', 'like',"%{$this->search}%")
                        ->orWhere('users.email', 'like',"%{$this->search}%");
                    })
                    ->paginate($this->paginate);

        return view('livewire.validate-users-table', [
            'users' => $users,
            ]);
    }

     public function clearFilters(){
     
        //Resetea todas las propiedades
        $this->reset();

        //Resetea la página (vuelve a la 1)
        $this->resetPage();
    } 

    public function updatingSearch(){
        $this->resetPage();
    }
}
