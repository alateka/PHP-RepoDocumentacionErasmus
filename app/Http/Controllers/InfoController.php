<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function lists()
    {
        return view('info.listados');
    }

    public function doc()
    {
        return view('info.documentos');
    }

    public function faq()
    {
        return view('info.faq');
    }
}
