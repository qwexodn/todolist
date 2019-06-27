<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Http\Controllers\Common;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * 리스트 추가
     */
    public function store(Request $request)
    {
        //
        $common = new Common();

        $db = new Todo();
        $db->title = $request->input('title') == null ? '' : $request->input('title');
        $db->body = $request->input('body') == null ? '' : $request->input('body');
        $db->uid = $common->uidDecode($request->input('uid'));
        $db->udate = $request->input('udate');
        $db->state = 'stay';

        $db->save();

        // return $request->input('title');
        // return $db;
    }

    /**
     * 리스트 서치
     */
    public function search(Request $request){
        $common = new Common();

        $uid = $common->uidDecode($request->input('uid'));

        $db = new Todo();
        $res = $db->select('id', 'title', 'body', 'udate', 'state', 'created_at as update')
                    ->where('uid', $uid)
                    ->get();
        if($res)  return $res;
    }

    /**
     * 리스트 완료
     */
    public function clear(Request $request){
        $common = new Common();
        $db = new Todo();

        $uid = $common->uidDecode($request->input('uid'));
        $index = $request->input('index');

        $db->where('uid', $uid)
            ->where('id', $index)
            ->update(['state'=>'clear']);
    }

    /**
     * 리스트 보류
     */
    public function hold(Request $request){
        $common = new Common();
        $db = new Todo();

        $uid = $common->uidDecode($request->input('uid'));
        $index = $request->input('index');

        $db->where('uid', $uid)
            ->where('id', $index)
            ->update(['state'=>'stay']);
    }
}
