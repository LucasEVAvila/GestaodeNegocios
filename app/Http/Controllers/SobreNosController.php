<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    public function aboutUS(){
        //echo 'A soma dos parametros é: ' . ($p1 + $p2);

        /*ARRAY ASSOCIATIVA
        return view('site.aboutUs', ['x'=> $p1, 'y'=>$p2]);

        */

        // COMPACT
        return view('pages.aboutUs');
    }
}
