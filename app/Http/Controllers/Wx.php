<?php

namespace App\Http\Controllers;

use App\Model\IconListModel;
use App\Model\IndentModel;
use Illuminate\Http\Request;

use function GuzzleHttp\json_encode;

class Wx extends Base
{
    //用于微信接口记录登录操作
    public function login_log(){
        
    }
    //执行兑换openid 请求
    public function onLogin(Request $request){
        $code = $request->input('code');
        if ($code) {
            $open_id = config('openid');
            $appSecret = config('appSecret');
            $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$open_id}&secret={$appSecret}&js_code={$code}&grant_type=authorization_code";
            $tmps = geturl($url);
            return $tmps;
        }else{
            return false;
        }
    }
    //验证登录
    public function login(Request $request)
    {
        return true;
    }
    //进入后获取相应数据
    public function index(IconListModel $icon_list)
    {
        $icon = $icon_list->where(['is_delete'=>1])->get()->toArray();
        return $icon;
    }
    //订单提交操作
    public function installData(Request $request,IndentModel $indent)
    {  
        $data = $request->all();
        $data['json_data'] = json_encode($data);
        
        if ($indent->save($data) !== false) {
            $this->api_success();
        }
    }
}
