<?php
/**
 * 执行URL请求函数
 * 
 */
function geturl($url){//geturl函数
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if(!function_exists('result')) {
    /**
     * 返回数据
     *
     * @param string|array  $data  数据
     * @param int  $status  状态码
     * @return \Illuminate\Http\Response
     */
    function result($data = null, int $status = 200) {
        return response()->json(
            is_null($data) ? ['code' => 1] : ['code' => 1, 'data' => $data],
            $status
        );
    }
}

if(!function_exists('error')) {
    /**
     * 返回错误
     *
     * @param string  $msg  错误信息
     * @param int  $status  状态码
     * @return \Illuminate\Http\Response
     */
    function error($msg = '参数错误', int $status = 200) {
        return response()->json(
            ['code' => 0, 'message' => $msg],
            $status
        );
    }
}

if(!function_exists('error_system')) {
    /**
     * 返回系统错误
     *
     * @param int  $number  编号
     * @return \Illuminate\Http\Response
     */
    function error_system($number = null) {
        return error(is_null($number) ? '系统错误' : '系统错误[' . $number . ']');
    }
}
    function nowDate($type = 'Y-m-d H:i:s')
    {  
        return date($type);
    }
?>