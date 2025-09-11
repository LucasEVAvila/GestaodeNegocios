<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminClientesController extends Controller
{
    public function adminClientes(){
        return view('pages.adminClientes');
    }
}

