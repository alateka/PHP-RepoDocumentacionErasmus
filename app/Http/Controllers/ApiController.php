<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Storage;


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
                    'Access Token' => $token,
                    'Token Type' => 'Bearer',
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
}
