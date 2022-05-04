<?php

namespace App\Http\Livewire;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPanel extends Component
{

    use WithPagination;

    
    
    public $paginate = 15;
    public $search = "";
    public $camp = null;
    public $order = null;
    public $icon = null;
    public $grado = null;
    public $ciclo = null;
    public $year = '';
    public $solicitud = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'camp' => ['except' => null],
        'order' => ['except' => null],
        'icon' => ['except' => null],
        'grado' => ['except' => null],
        'year' => ['except' => ''],
        'ciclo' => ['except' => null],
        'solicitud' => ['except' => ''],
    ];

    public function render()
    {
        DB::enableQueryLog();
       
        $ciclos = Ciclo::all();
        $ciclosGradoMedio = Ciclo::where('grado', 'Medio')->get();
        $ciclosGradoSuperior = Ciclo::where('grado', 'Superior')->get(); 

        $users = DB::table('users')
            ->leftJoin('ciclos', 'ciclos.id', '=', 'users.ciclo_id')
            ->leftJoin('solicitudes', 'solicitudes.user_id', '=', 'users.id')
            ->select('users.*', 'ciclos.grado', 'ciclos.nombre', 'solicitudes.user_id', 'solicitudes.baremo')
            ->where('ciclos.grado', 'like', "%{$this->grado}%")
            ->where('ciclos.nombre', 'like', "%{$this->ciclo}%")
            ->where('verified',1)
            ->where('users.admin', false)
            ->where('users.year', 'like', "%{$this->year}%")
            ->where(function($query){
                $query->where('users.name', 'like', "%{$this->search}%")
                ->orWhere('users.last_name', 'like',"%{$this->search}%")
                ->orWhere('users.email', 'like',"%{$this->search}%");
            });    
        
        if($this->camp && $this->order){
            $users = $users->orderBy($this->camp, $this->order);
        }

        if($this->solicitud == 0){
            $users = $users->whereNull('solicitudes.user_id');
        }

        if($this->solicitud == 1){
            $users = $users->whereNotNull('solicitudes.user_id');
        }

        $users = $users->paginate($this->paginate);
  
        $query = DB::getQueryLog();

        return view('livewire.admin-panel',[
            'users' => $users,
            'ciclos' => $ciclos,
            'ciclosGradoMedio' => $ciclosGradoMedio,
            'ciclosGradoSuperior' => $ciclosGradoSuperior,
            'query' => $query,
        ]);
    }

    //Los updatingXXX resetean la página (vuelven a la página 1) al cambiarlos
    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatingGrado(){
        $this->resetPage();
    }

    public function updatingCiclo(){
        $this->resetPage();
    }

    public function updatingSolicitud(){
        $this->resetPage();
    }

    public function updatingYear(){
        $this->resetPage();
    }

    public function clearFilters(){
     
        //Resetea todas las propiedades
        $this->reset();

        //Resetea la página (vuelve a la 1)
        $this->resetPage();
    }

    public function sortable($camp){

        if($camp !== $this->camp){
            $this->order = null;
        }
        
        switch ($this->order){

            case null:
                $this->order = 'asc';
                $this->icon = '-arrow-circle-up';
                break;

            case 'asc':
                $this->order = 'desc';
                $this->icon = '-arrow-circle-down';
                break;

            case 'desc':
                $this->order = null;
                $this->icon = '-circle';
                break;
        }

        $this->camp = $camp;
    }

    public function resetCiclo(){
        $this->ciclo = "";
    }
}
