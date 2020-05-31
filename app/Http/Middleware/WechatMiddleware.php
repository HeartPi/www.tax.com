<?php

namespace App\Http\Middleware;

use App\Models\Users;
use Closure;

class WechatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        $user = Users::where('token', $token)
                    ->first();

        if(!$user) {
            return error('请登陆', 401);
        }

        if($user->status !== 1) {
            return error('当前账户暂时无法使用');
        }

        $request->user  = $user->toArray();
        $request->uid   = $user->getKey();

        return $next($request);
    }
}