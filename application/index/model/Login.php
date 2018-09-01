<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Login extends Model
{
    public function login($userName,$password){
    		$user = Db::name('user')->where('user_name','=',$userName)->where('status','<>',0)->find();
    		if($user){
    			if($user['user_pwd']==$password){
    				session('userID', $user['id']);
		    		session('userName', $user['user_name']);
				session('realName', $user['real_name']);
    				return 1;
    			}else{
    				return 2;
    			}
    		}else{
    			return 3;
    		}
    }
    
    

}