<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
  
        if($user->idiomas){
            DB::table('idioma_user')
            ->where('user_id', $user->id)
            ->delete();
        }

        if($user->solicitud){

            if(count($user->solicitud->documentos)){
                foreach($user->solicitud->documentos as $documento){
                    $documento->delete();
                }
            }

            $user->solicitud->delete();
        }
         
        Storage::deleteDirectory("public/UserDocuments/{$user->email}");
        $user->tokens->each->delete();
        $user->delete();
    }
}
