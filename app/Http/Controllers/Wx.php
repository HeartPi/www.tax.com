<?php

namespace App\Http\Controllers;

use App\Model\IconListModel;
use Illuminate\Http\Request;

class Wx extends Base
{
    //用于微信接口记录登录操作
    public function login_log(){
        
    }
    //执行兑换openid 请求
    public function getOpenId(Request $request){
        return $request->all();
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
}
