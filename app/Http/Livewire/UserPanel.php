<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserPanel extends Component
{
    public function render()
    {
        $user = auth()->user();
        return view('livewire.user-panel',[
            'user' => $user,
        ]);
    }
}
