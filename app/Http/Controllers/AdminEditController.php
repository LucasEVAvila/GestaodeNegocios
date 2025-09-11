<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEditController extends Controller
{
    public function adminEdit(){
        return view('pages.adminEdit');
    }
}