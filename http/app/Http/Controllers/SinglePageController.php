<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class SinglePageController extends Controller
{
    
    function index($any=""){

        date_default_timezone_set('Asia/Seoul');

        $user = new UserController();
        $user->addUser();
        $user->setUser();

        echo view('page');
    }
}
