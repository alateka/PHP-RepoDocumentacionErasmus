<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento;

class UploadDocumentosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'files' => 'required|max:6|',
        ];
    }

    public function messages()
    {
        return [
            'files.required' => 'Ningún archivo encontrado.',
            'files.max' => 'El número máximo de archivos permitido es 6',
        ];
    }

    public function uploadDocumentos(){

        $user = auth()->user();
        
        $files = $this->file('files');

        foreach ($files as $file){
           
            Storage::putFileAs('/public/UserDocuments/' . $user->email . '/', $file, $file->getClientOriginalName());
                Documento::create([
                    'documento' => $file->getClientOriginalName(),
                    'url' => 'public/UserDocuments/' . $user->email . '/' . $file->getClientOriginalName(),
                    'solicitud_id' => $user->solicitud->id,
                ]);
             
        }
           
    }
}
