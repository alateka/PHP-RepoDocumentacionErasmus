<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadDocumentosRequest;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Route;

class DocumentoController extends Controller
{
    public function store(UploadDocumentosRequest $request){
        
        $request->uploadDocumentos();
        alert()->success('¡Documentos subidos!','Sus documentos fueron subidos de manera exitosa.');
        return back();
    }

    public function documentos(){
        return view('user.upload-documents');
    }

    public function delete(Documento $documento){
    
        Storage::delete($documento->url);
        $documento->delete();

        alert()->success('Archivo eliminado');

        return back();
    
    }

    public function download($id){
        
        $doc = Documento::findOrfail($id);

        return response()->download(storage_path("app/{$doc->url}"));
    }
}
