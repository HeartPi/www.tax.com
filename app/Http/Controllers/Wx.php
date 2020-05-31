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
        $time = \nowDate();
        //加入创建时间
        $data['created_at'] = $time;
        $data['updated_at'] = $time;
        if ($id = $indent->insertGetId($data) !== false) {
            return $this->api_success('操作成功',$id);
        }else{
            return $this->api_error('操作失败',$data);
        }
    }
    //获取历史订单
    public function getInstallData(Request $request,IndentModel $indent)
    {
        //从请求中获取openID
        $open_id = $request->input('openId',null);
        //从请求中获取orderId
        $orderId = $request->input('orderId',0);

        $reply = $indent->selectRaw('id,license_plate_number as name,"待付款" as state,created_at as time,"未处理" as status,tax as money')->paginate(10);
        return $this->api_success('操作成功',$reply);   
    }
    //获取订单详情
    public function getInstallInfo(Request $request,IndentModel $indent)
    {
        $id = $request->input('id',0);
        $info = $indent->find($id);
        return $this->api_success('操作成功',$info);
    }
}
