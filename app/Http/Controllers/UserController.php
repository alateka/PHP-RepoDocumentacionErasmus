<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function delete($user){


        //Este método se puede refactorizar en varios métodos como deleteRelationships()

        $user = User::where('id', $user)->firstOrFail();

        if($user->solicitud){

            if(count($user->solicitud->documentos)){
                foreach($user->solicitud->documentos as $documento){
                    $documento->delete();
                }
            }

            $user->solicitud->delete();
        }

        if($user->idiomas){
            DB::table('idioma_user')
            ->where('user_id', $user->id)->delete();
        }

        Storage::deleteDirectory("public/UserDocuments/{$user->email}");
        $user->delete();

        $route = Route::currentRouteName();

        if($route == "users.unvalidate"){
            return redirect()->route('admin.validate')->with('delete', true);
        }else{
            return redirect()->route('home')->with('delete', true);
        }
    }

    public function update(UpdateUserRequest $request, User $user){

        $request->updateUser($user);

        return redirect()->route('home');

    }

    public function updateByUsuario(UpdateUserRequest $request){

        $request->updateUser();
        alert()->success('¡Perfil actualizado!','Su perfil fue actualizado de manera exitosa.');
        return redirect()->route('home');
    }
}
