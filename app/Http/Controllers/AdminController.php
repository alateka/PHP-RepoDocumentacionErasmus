<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUserRequest;
use App\Mail\VerifyMailable;
use App\Models\Idioma;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function validateUsers(){
        return view('admin.validate-users');
    }

    public function listados(){
        return view('admin.generate-listados');
    }

    public function verify(ValidateUserRequest $request, User $user){
       
        $request->verifyUser($user);
        $correo = new VerifyMailable($user);
        Mail::to("$user->email")->send($correo);
        return redirect()->route('admin.validate')->with('verify', true);
       
    }

    public function showSolicitud(User $user){

       
        $idiomas = DB::table('idioma_user')
        ->leftJoin('idiomas', 'idiomas.id', '=', 'idioma_user.idioma_id')
        ->where('user_id', $user->id)->get();
        
        return view('admin.admin-solicitud', [
            'user' => $user,
            'idiomas' => $idiomas,
        ]);
    }
}
