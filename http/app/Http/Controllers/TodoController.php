<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        //
        $db = new Todo();
        $db->title = $request->input('title') == null ? '' : $request->input('title');
        $db->body = $request->input('body') == null ? '' : $request->input('body');
        $db->uid = $request->input('uid');
        $db->udate = $request->input('udate');
        $db->state = 'stay';

        $db->save();

        // return $request->input('title');
        // return $db;
    }

    public function search(Request $request){
        $uid = $request->input('uid');

        $db = new Todo();
        $res = $db->select('id', 'title', 'body', 'udate', 'state', 'updated_at as update')
                    ->where('uid', $uid)
                    ->get();
        if($res)  return $res;
    }

    
}
