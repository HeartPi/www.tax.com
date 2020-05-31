<?php

namespace App\Http\Controllers;

use EasyWeChat\Factory;
use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $app = null;

    public function __construct()
    {
        $wechat_config = [
            'app_id'    => 'app_id',
            'secret'    => 'secret'
        ];

        $this->app = Factory::miniProgram($wechat_config);
    }

    /**
     * 用户登陆授权
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->only('iv', 'encryptedData');

        $validator = Validator::make($input, [
            'iv'            => 'required',
            'encryptedData' => 'required',
        ]);

        if($validator->fails()) {
            return error((string) $validator->errors()->first());
        }

        $session_key = $request->user['session_key'];

        if(!$session_key) {
            return error('session_key 不存在');
        }

        try {
            $data = $this->app->encryptor->decryptData(
                        $session_key,
                        $input['iv'],
                        $input['encryptedData']
                    );
        } catch (\Exception $e) {
            return error('session_key 无效');
        }

        if(!isset($data['openId'])) {
            return error('获取 openid 错误');
        }

        $model =    Users::where('openid', $data['openId'])
                        ->first();

        $model->nickname    = $data['nickName'];
        $model->avatar      = $data['avatarUrl'];
        $model->token       = Str::random(32);

        if(!$model->save()) {
            return error_system();
        }

        return  result([
                    'user' => [
                        'nickname'  => $model->nickname,
                        'avatar'    => $model->avatar,
                    ],
                    'token' => $model->token,
                ]);
    }

    /**
     * code
     * code 兑换 session_key 和 openid ，如果 openid 用户不存在创建一个新的
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function code(Request $request)
    {
        $input = $request->only('code');

        $validator = Validator::make($input, [
            'code'  => 'required',
        ]);

        if($validator->fails()) {
            return error((string) $validator->errors()->first());
        }

        try {
            $data = $this->app->auth->session($input['code']);
        } catch (\Exception $e) {
            return error();
        }

        if(isset($data['errcode'])) {
            switch ($data['errcode']) {
                case 40029:
                    // 这里需要注意的是 code 只能换取一次
                    // 如果一直报 40029 需要前后端检查 appid 是否一致
                    return error('code 无效');
                    break;

                default:
                    return error('请求频繁');
                    break;
            }
        }

        $user = Users::where('openid', $data['openid'])
                    ->first();

        if(!$user) {
            $user           = new Users;
            $user->openid   = $data['openid'];
        }

        $user->session_key = $data['session_key'];
        $user->token       = Str::random(32);

        if(!$user->save()) {
            return error_system();
        }

        return  result([
                    'token' => $user->token,
                ]);
    }
}