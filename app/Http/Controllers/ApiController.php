<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;



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
                    'Documents' => $user->solicitud->documentos
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
    

    public function updateUserViaAPI(UpdateUserRequest $request)
    {
        // TODO por hacer

        if ( auth()->user()->verified ) {

            $user = User::where('email', $request['email'])->firstOrFail();

            $user->name = $request['name'];


            return response()->json([
                'STATUS' => 'OK'], 200);
            }
    }
}
