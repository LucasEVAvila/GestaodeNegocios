<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function produtos_list(){
        return view ('pages.product');
    }
}
