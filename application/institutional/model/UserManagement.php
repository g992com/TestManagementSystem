<?php
namespace app\institutional\model;
use think\Model;
use think\Db;
class UserManagement extends Model
{   
    //添加用户
    public function addUser($userName,$data){
    	 	$count = Db::name('user') ->where('user_name','=',$userName)-> count();
    		if($count>0){
	    		return -1;
	    	}else{
	    		$res = Db::name('user')-> insert($data);
		    	if($res){
		    		return 1;
		    	}else{
		    		return 0;
		    	}
	    	} 
    }

    //编辑用户
    public function editUser($userId,$data)
    {
        $res = Db::name('user')->where('id',$userId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    //获得用户信息
    public function getUserInfo($userId){
        $res = Db::name('user')->where('id',$userId)->find();
        return $res;
    }

    //删除用户
    public function deleteUser($userId){
        $data["status"] = 0;
        $res = Db::name('user')->where('id',$userId)->update($data);
        return $res;
    }
    
    //检查用户密码的正确性
    public function checkUserPwd($userId,$oldPwd){
    		$conut = Db::name('user') ->where('id',$userId)->where('user_pwd',$oldPwd)-> count();
    		if($conut==1){
    			return 1;
    		}else{
    			return 0;
    		}
    }
    
    //修改用户密码
    public function modifyUserPwd($userId,$newPwd){
    		$data["user_pwd"] = $newPwd;
    		$res = Db::name('user')->where('id',$userId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    //获得用户列表
    public function getUserList($limit,$offset){       
        $resTB = Db::name('user') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) -> select();
        $total = Db::name('user') ->where('status','<>',0)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['user_name'] = $value['user_name'];
            $info['real_name'] = $value['real_name'];
            $info['user_sex'] = $value['user_sex'];
            $info['phone_num'] = $value['phone_num'];
            $info['email'] = $value['email'];
            $info['login_time'] = $value['login_time'];
            $info['loginCount'] = $value['loginCount'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
    }
}