<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Idioma;
use Illuminate\Support\Facades\DB;

class UserSolicitud extends Component
{

    public $empresa = "";
    public $ingles = "";
    public $frances = "";
    public $aleman = "";
    public $portugues = "";
    public $italiano = "";
    public $old_idiomas = [];
    public $count = 0;
    public function render()
    {
        $user = auth()->user();
        $idiomas = Idioma::all();

        $db_idiomas = DB::table('idioma_user')
            ->where('user_id', $user->id)
            ->get();

        for($i = 0; $i<count($db_idiomas); $i++){
            for($j = 0; $j<count($idiomas); $j++){
                if($idiomas[$j]->id == $db_idiomas[$i]->idioma_id){
                    $this->old_idiomas[$idiomas[$j]->name] = $db_idiomas[$i]->nivel;
                }

            }

        }


        if($user->solicitud) {
            if ($user->solicitud->empresa && $this->empresa == "")
            {
                $this->empresa = 1;
            }

            if($this->count == 0) {
                if (isset($this->old_idiomas["Ingles"])) {
                    $this->ingles = "ingles";
                }
                if (isset($this->old_idiomas["Frances"])) {
                    $this->frances = "frances";
                }
                if (isset($this->old_idiomas["Aleman"])) {
                    $this->aleman = "aleman";
                }
                if (isset($this->old_idiomas["Portugues"])) {
                    $this->portugues = "portugues";
                }
                if (isset($this->old_idiomas["Italiano"])) {
                    $this->italiano = "italiano";
                }
                $this->count++;
            }
        }


        return view('livewire.user-solicitud', [
            'user' => $user,
            'idiomas' => $idiomas,
            'old_idiomas' => $this->old_idiomas,
        ]);
    }
}
