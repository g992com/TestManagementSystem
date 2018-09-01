<?php
namespace app\institutional\controller;
use app\institutional\model\RoleManagement as RM;
use think\Controller;

class GroupManagement extends controller
{
    public function index()
    {   $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    	 	return $this->fetch();
    }

    //创建角色页面
    public function createpage()
    {
        $this -> assign('realName', session('realName'));
        return $this->fetch();
    }


    //创建角色
    public function createRole(){
    		$roleName = trim($_POST['roleName']);
    		$data["role_name"] = $roleName;
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;
        $rm = new RM;
        $result = $rm->addRole($roleName,$data);
        if($result==-1){
            return ['status'=>-1,'info'=>'已经存在此角色名，请重新指定名称！'];
        }else if($result==0){
            return ['status'=>0,'info'=>'新增角色失败，请重试！'];
        }else{
        		return ['status'=>1,'info'=>'新增角色成功！'];
        }
        
    }

    //编辑角色页面
    public function editpage()
    {
        $roleId = $_GET['roleId'];
        $rm = new RM;
        $roleInfo = $rm->getRoleInfo($roleId);
        $this -> assign('roleId', $roleId);
        $this -> assign('roleName', $roleInfo['role_name']);
        return $this->fetch();
    }
    
    //编辑角色
    public function editRole(){
        $roleId = trim($_POST['id']);
        $data["role_name"] = trim($_POST['roleName']);
        $rm = new RM;
        $result = $rm->editRole($roleId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑角色成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑角色失败，请重试！'];
        }
    }
    

    //删除角色
    public function deleteRole(){
        $roleId = trim($_POST['roleId']);
        $rm = new RM;
        $result = $rm->deleteRole($roleId);
        if($result==1){
            return ['status'=>1,'info'=>'删除角色成功！'];
        }else{
            return ['status'=>0,'info'=>'删除角色失败，请重试！'];
        }
    }
    
    //获得角色列表
    public function getRoleList(){
        $limit = $_GET['limit'];
        $offset = $_GET['offset']; 
        $rm = new RM;
        echo $rm->getRoleList($limit,$offset);
    }
}
