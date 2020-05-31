<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Base extends Controller
{
    //控制器基类
    
    /**
     * 返回成功
     *
     * @param string $msg 消息
     * @param void $data 返回数据
     * @param integer $code 返回状态码
     * @return void
     */
    public function api_success($msg,$data,$code = 1)
    {
        $res_data = [
            'code' => $code,
            'data' => $data,
            'msg' => $msg
        ];
        return response()->json($res_data);
    }
    /**
     * 失败返回
     *
     * @param string $msg 消息
     * @param void $data 返回数据
     * @param integer $code 返回状态码
     * @return void 
     */
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
