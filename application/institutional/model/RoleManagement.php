<?php
namespace app\institutional\model;
use think\Model;
use think\Db;
class RoleManagement extends Model
{   
    //添加用户
    public function addRole($roleName,$data){
    	 	$count = Db::name('role') ->where('role_name','=',$roleName)-> count();
    		if($count>0){
	    		return -1;
	    	}else{
	    		$res = Db::name('role')-> insert($data);
		    	if($res){
		    		return 1;
		    	}else{
		    		return 0;
		    	}
	    	} 
    }

    //编辑角色
    public function editRole($roleId,$data)
    {
        $res = Db::name('role')->where('id',$roleId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    //获得角色信息
    public function getRoleInfo($roleId){
        $res = Db::name('role')->where('id',$roleId)->find();
        return $res;
    }

    //删除用户
    public function deleteRole($roleId){
        $data["status"] = 0;
        $res = Db::name('role')->where('id',$roleId)->update($data);
        return $res;
    }
    
    //获得角色列表
    public function getRoleList($limit,$offset){       
        $resTB = Db::name('role') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) -> select();
        $total = Db::name('role') ->where('status','<>',0)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['role_name'] = $value['role_name'];
            $info['status'] = $value['status'];
            $info['create_date'] = $value['create_date'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
    }
}