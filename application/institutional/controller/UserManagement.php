<?php
namespace app\institutional\controller;
use app\institutional\model\UserManagement as UM;
use think\Controller;

class UserManagement extends controller
{
    public function index()
    {   $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    	 	return $this->fetch();
    }

    //创建项目页面
    public function create_page()
    {
        $this -> assign('realName', session('realName'));
        return $this->fetch();
    }


    //创建用户
    public function createUser(){
    		$userName = trim($_POST['userName']);
    		$data["user_name"] = $userName;
        $data["real_name"] = trim($_POST['realName']);
        $data["user_pwd"] = trim($_POST['userPassword']);
        $data["email"]= trim($_POST['email']);
        $data["user_sex"]= trim($_POST['sex']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;
        $um = new UM;
        $result = $um->addUser($userName,$data);
        if($result==-1){
            return ['status'=>-1,'info'=>'已经存在相同登录名称的用户，请重新指定名称！'];
        }else if($result==0){
            return ['status'=>0,'info'=>'新增用户失败，请重试！'];
        }else{
        		return ['status'=>1,'info'=>'新增用户成功！'];
        }
        
    }

    //编辑用户页面
    public function edit_page()
    {
        $userId = $_GET['userId'];
        $um = new UM;
        $userInfo = $um->getUserInfo($userId);
        $this -> assign('userId', $userId);
        $this -> assign('userName', $userInfo['user_name']);
        $this -> assign('realName', $userInfo['real_name']);
        $this -> assign('email', $userInfo['email']);
        $this -> assign('userSex', $userInfo['user_sex']);
        return $this->fetch();
    }
    
    //编辑用户密码页面
    public function edit_pwd_page()
    {
        $userId = $_GET['userId'];
        $um = new UM;
        $userInfo = $um->getUserInfo($userId);
        $this -> assign('userId', $userId);
        $this -> assign('userName', $userInfo['user_name']);
        $this -> assign('userPwd', $userInfo['user_pwd']);
        return $this->fetch();
    }


    //编辑用户
    public function editUser(){
        $userId = trim($_POST['id']);
        $data["user_name"] = trim($_POST['userName']);
        $data["real_name"]= trim($_POST['realName']);
        $data["email"]= trim($_POST['email']);
        $data["user_sex"]= trim($_POST['sex']);
        $um = new UM;
        $result = $um->editUser($userId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑用户成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑用户失败，请重试！'];
        }
    }
    
    //修改用户登录密码
    public function editUserPwd(){
    		$userId = trim($_POST['id']);
    		$oldPwd = trim($_POST['oldPassword']);
    		$newPwd = trim($_POST['newPassword']);
    		$um = new UM;
    		$checkRes = $um->checkUserPwd($userId,$oldPwd);
    		if($checkRes==1){
    			$result = $um->modifyUserPwd($userId,$newPwd);
    			if($result==1){
            		return ['status'=>1,'info'=>'修改用户密码成功！'];
        		}else{
            		return ['status'=>0,'info'=>'修改用户密码失败，请重试！'];
        		}
    		}else{
    			 return ['status'=>-1,'info'=>'原始密码不正确，请重新输入！'];
    		}
    }

    //删除项目
    public function deleteUser(){
        $userId = trim($_POST['userId']);
        $um = new UM;
        $result = $um->deleteUser($userId);
        if($result==1){
            return ['status'=>1,'info'=>'删除用户成功！'];
        }else{
            return ['status'=>0,'info'=>'删除用户失败，请重试！'];
        }
    }

    //获得项目
    public function getUserList(){
        $limit = $_GET['limit'];
        $offset = $_GET['offset']; 
        $um = new UM;
        echo $um->getUserList($limit,$offset);
    }
}
