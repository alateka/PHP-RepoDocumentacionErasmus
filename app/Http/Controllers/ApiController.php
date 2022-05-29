<?php

// Author ==> Alberto Pérez Fructuoso
// File   ==> ApiController.php
// Date   ==> 2022/05/21

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use App\Models\Ciclo;



class ApiController extends Controller
{
    public function getApiToken(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')) ) {
            return response()->json([
            'Message' => 'Invalid login :('], 401);
        }


        if ( auth()->user()->verified ) {
            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                    'AccessToken' => $token,
                    'TokenType' => 'Bearer',
                    ], 200);
        }

        return response()->json([
            'Error' => 'User email not verified :('], 401);
    }

    public function apiTest()
    {
        return response()->json([
            'Message' => 'It work :)'], 200);
    }

    public function uploadFileViaApi(Request $request)
    {
        if ( auth()->user()->verified ) {
            $user = auth()->user();

            $file = $request->file('file');

            Storage::putFileAs('/public/UserDocuments/' . $user->email.'/', $file, $file->getClientOriginalName());
            Documento::create([
                'documento' => $file->getClientOriginalName(),
                'url' => 'public/UserDocuments/' . $user->email.'/'.$file->getClientOriginalName(),
                'solicitud_id' => $user->solicitud->id,
            ]);

            return response()->json(['Message' => "Updated file from $user->email",
                                    'File' => $file->getClientOriginalName()
                                    ], 200);
        }
    }

    public function getUserData()
    {
        if ( auth()->user()->verified ) {
            
            $user = auth()->user();

            return response()->json([
                'Name' => $user->name,
                'LastName' => $user->last_name,
                'Email' => $user->email,
                'DNI' => $user->dni,
                'Date' => $user->fecha_nacimiento
                ], 200);
        }
    }



    public function loginOnAndroidApp(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')) ) {
            return response()->json([
            'Message' => 'Invalid login :('], 401);
        }


        if ( auth()->user()->verified ) {
            $user = User::where('email', $request['email'])->firstOrFail();
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                    'AccessToken' => $token,
                    'Name' => $user->name,
                    'LastName' => $user->last_name,
                    'Email' => $user->email,
                    'DNI' => $user->dni,
                    'Date' => $user->fecha_nacimiento,
                    'Documents' => $user->solicitud->documentos,
                    'CycleID' => $user->ciclo_id,
                    'CycleName' => Ciclo::where('id', $user->ciclo_id)->firstOrFail()->nombre,
                    'Nationality' => $user->nacionalidad,
                    'Locality' => $user->localidad,
                    'Phone' => $user->telefono,
                    'Address' => $user->direccion,
                    'ZIP' => $user->cp
                    ], 200);
        }

        return response()->json([
            'Error' => 'User email not verified :('], 401);
    }


    public function documentList()
    {
        if ( auth()->user()->verified ) {
            $documents = auth()->user()->solicitud->documentos;

            return response()->json([
                'Data' => $documents
                ], 200);
        }
    }
    

    public function updateUserViaAPI(Request $request, User $user)
    {
        if ( auth()->user()->verified ) {
            $input = $request->all();

            $user = User::findOrFail(auth()->user()->id);

            $user->fill([
                'name' => $input['name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'fecha_nacimiento' => $input['birth_date'],
                'ciclo_id' => Ciclo::where('nombre', $request['cycle_name'])->firstOrFail()->id,
                'dni' => $input['dni'],
                'nacionalidad' => $input['nationality'],
                'telefono' => $input['phone'],
                'localidad' => $input['locality'],
                'direccion' => $input['address'],
                'cp' => $input['zip'],
            ]);


            $user->save();
            
            return response()->json([
                'Status' => 'OK'
                ], 200);
            }
    }

    public function getCycleList()
    {
        if ( auth()->user()->verified ) {
            
            $ciclos = Ciclo::all();

            $JSONdata = [];
            for ( $i = 0; $i < count($ciclos); $i++) {
                $JSONdata[$i] = [
                    'Name' => $ciclos[$i]->nombre,
                    'Id' => $ciclos[$i]->id,
                    'Grado' => $ciclos[$i]->grado,
                    'Rama' => $ciclos[$i]->rama,
                ];
            }
            return response()->json($JSONdata, 200);
        }
    }

    public function removeFileViaApi(Request $request)
    {
        if ( auth()->user()->verified ) {
            $user = auth()->user();

            $doc = Documento::findOrfail($request['id']);
            Storage::delete($doc->url);
            $doc->delete();

            return response()->json([
                'Status' => 'OK'
                ], 200);
        }
    }

    public function downloadDocument(Request $request){
        
        if ( auth()->user()->verified ) {
            $doc = Documento::findOrfail($request["id"]);
            return response()->download(storage_path("app/{$doc->url}"));
        }
    }
}
