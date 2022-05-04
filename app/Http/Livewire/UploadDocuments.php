<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UploadDocuments extends Component
{
    public function render()
    {
        $documents = auth()->user()->solicitud->documentos;
        
        return view('livewire.upload-documents', [
            'documentos' => $documents,
        ]);
    }
}
