<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){

        $isAdmin = auth()->user()->admin;
        if($isAdmin){
            return view('home');
        }else{
            return view('user.user-home');
        }
    }

    public function notVerify(){
        return view('not-verify');
    }
}
