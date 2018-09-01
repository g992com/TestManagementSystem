<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Login as Lgn;

class Login extends Controller
{
	//登录页面展示
    public function index()
    {
        return $this->fetch('login');
    }
    
    //验证用户的登录信息
    public function verifyLogin(){
    		$login = new Lgn;
    		$status = $login->login(input('userName'),input('userPwd')); 
    		if($status==1){
    			return json(['status'=>$status,'info'=>'验证用户名和密码成功，可以登录到系统。']);
    		}else{
    			return json(['status'=>$status,'info'=>'用户名或密码错误,或是用户已被删除！']);
    		}
    }
}
