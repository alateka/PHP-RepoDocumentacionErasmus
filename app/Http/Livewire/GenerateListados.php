<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GenerateListados extends Component
{

    public $year = '';
    public $grado = '';

    public function render()
    {

        return view('livewire.generate-listados');
    }
}
