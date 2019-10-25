<?php

namespace App\Http\Middleware;

use Closure;
use App\hadmin\Login;
class Token
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
        $token = $request->input('token');
        $userData = $this->token($token);
        $mid_params = ['userData'=>$userData];
        $request->attributes->add($mid_params);

        return $next($request);
    }

    public function token($token)
    {
        // $token=\request()->input('token');
        if (empty($token)){
            return json_encode(['code'=>0,'msg'=>'请先登录'],JSON_UNESCAPED_UNICODE);
        }
        $userData=Login::where(['login_token'=>$token])->first();
        if(empty($userData)){
            return json_encode(['code'=>0,'msg'=>'请先登录'],JSON_UNESCAPED_UNICODE);
        }
        if ($userData['login_time'] < time()){
            return json_encode(['code'=>0,'msg'=>'登陆过期'],JSON_UNESCAPED_UNICODE);
        }else{
            Login::where(['login_token'=>$userData['login_token']])->update([
                'login_time'=>time()+7200,
            ]);
        }
        return $userData;
    }
}
