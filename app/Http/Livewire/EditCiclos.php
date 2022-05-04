<?php

namespace App\Http\Livewire;

use App\Models\Ciclo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditCiclos extends Component
{

    public $grado = '';

    public function render()
    {

        $ciclos = Ciclo::all();
        $ciclosGradoMedio = Ciclo::where('grado', 'Medio')->get();
        $ciclosGradoSuperior = Ciclo::where('grado', 'Superior')->get();
        $user = auth()->user();
        if ($this->grado == '')
            $this->grado = $user->ciclo->grado;
 

        return view('livewire.edit-ciclos',[
            'user' => $user,
            'ciclos' => $ciclos,
            'ciclosGradoMedio' => $ciclosGradoMedio,
            'ciclosGradoSuperior' => $ciclosGradoSuperior,
        ]);
    }
}
