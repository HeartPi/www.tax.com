<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Base extends Controller
{
    //控制器基类
    //接口成功返回api
    public function api_success($msg,$data,$code = 1)
    {
        $res_data = [
            'code' => $code,
            'data' => $data,
            'msg' => $msg
        ];
        return response()->json($res_data);
    }
    //错误返回接口
    public function api_error($msg,$data,$code = 0)
    {
        $res_data = [
            'code' => $code,
            'data' => $data,
            'msg' => $msg
        ];
        return response()->json($res_data);
    }
}
