<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSolicitudRequest;
use App\Http\Requests\UpdateSolicitudRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{

    public function index(){

        $user = auth()->user();
        //Alert::success('¡Documentos subidos!','Sus documentos fueron subidos de manera exitosa.');
        return view('user.user-solicitud', $user);
    }

    public function createSolicitud(CreateSolicitudRequest $request)
    {
        //dd($request->all());
        $request->createSolicitud();

        alert()->success('¡Solicitud enviada!','Su solicitud fue enviada de manera exitosa.');
        return redirect()->route('home');

    }

    public function updateSolicitud(UpdateSolicitudRequest $request)
    {
        $user = User::find($request->user_id);

        $request->updateSolicitud($user->solicitud);
        
        return back();
    }

    public function updateSolicitudByUser(UpdateSolicitudRequest $request)
    {
        //dd($request->all());
        $request->updateSolicitudByUser();
        alert()->success('¡Solicitud actualizada!','Su solicitud fue actualizada de manera exitosa.');
        return redirect()->route('home');
    }

    public function delete(Solicitud $solicitud)
    {

        $user = User::where('id', $solicitud->user_id)->firstOrFail();

        if(count($solicitud->documentos)){
            foreach($solicitud->documentos as $documento){
                $documento->delete();
            }
        }

        if($user->idiomas){
            DB::table('idioma_user')
            ->where('user_id', $user->id)
            ->delete();
        }

        $solicitud->delete();
        alert()->success('Solicitud eliminada.');
        return redirect(route('home'));
        
    }
}
