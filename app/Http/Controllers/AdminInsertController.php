<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminInsertController extends Controller
{
    public function adminInsert(){
        return view('pages.adminInsert');
    }
}
