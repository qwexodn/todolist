<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Common;

class UserController extends Controller
{
    private $users;

    public function __construct(){
        $this->users = new User();
    }


    public function store(Request $request)
    {
        //
        $db = new User();
        $db->ip = $request->input('ip');

        $db->save();
        return redirect('/');
    }

    /**
     * 유저 pid 찾기
     */
    public function search(){
        $common = new Common();

        $res = $this->users->where('ip', $_SERVER["REMOTE_ADDR"])
                            ->get();
        
        foreach($res as $row){
            return $common->uidEncode($row->id);
        }
        return -1;
    }

    /**
     * 유저 DB에 추가
     */
    function addUser(){
        //유저의 아이피가 곧 계정이다
        $ip = $_SERVER['REMOTE_ADDR'];

        $ipex = $this->users->where('ip', $ip)->doesntExist();

        // 아이피가 저장이 되어 있으면 업데이트(마지막 접속 날짜 기록)
        if($ipex){
            $this->users->ip = $ip;
            $this->users->save();
        }else{
            $this->users->where('ip', $ip)
                    ->update(['ip' => $ip]);
        }
    }

    /**
     * 세션에 유저 pid 저장
     */
    function setUser(){
        $userRes = $this->users->where('ip', $_SERVER['REMOTE_ADDR'])
                            ->get();
        
        foreach($userRes as $row){
            $_SESSION['uid'] = $row->id;
        }
    }
}
