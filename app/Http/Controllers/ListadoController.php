<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class ListadoController extends Controller
{
    public function generatePDF(Request $request){

        $year = $request->year;
        $grado = $request->grado;

         $users = DB::table('users')
        ->leftJoin('ciclos', 'ciclos.id', '=', 'users.ciclo_id')
        ->leftJoin('solicitudes', 'solicitudes.user_id', '=', 'users.id')
        ->select('users.*', 'ciclos.*', 'solicitudes.*')
        ->where('ciclos.grado', 'like', "%{$request->grado}%")
        ->where('users.year', 'like', "%{$request->year}%")
        ->where('solicitudes.user_id', '!=', null)
        ->orderBy('ciclos.nombre', 'asc')
        ->orderBy('solicitudes.baremo', 'desc')
        ->get();
      
        $pdf = PDF::loadView('admin.users-pdf', compact('users', 'year', 'grado'));

        return $pdf->download("Grado{$request->grado}-{$request->year}.pdf");

    }
}
