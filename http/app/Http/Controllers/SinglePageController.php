<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    
    function index($any=""){
        echo view('page');
    }
}
