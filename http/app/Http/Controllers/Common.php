<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Common extends Controller
{
    //
    public function uidEncode($uid){
        return urlencode(base64_encode($uid));
    }

    public function uidDecode($uid){
        return base64_decode(urldecode($uid));
    }
}
