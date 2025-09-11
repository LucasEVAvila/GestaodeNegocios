<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function Regist(){
        return view ('pages.cadastro');
    }
}
