<?php
namespace app\testcase\model;
use think\Model;
use think\Db;
class ProjectManagement extends Model
{   
    //添加项目
    public function addProject($data){
    	$res = Db::name('project')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    //编辑项目
    public function editProject($prjId,$data)
    {
        $res = Db::name('project')->where('id',$prjId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    //获得项目信息
    public function getPrjInfo($prjId){
        $res = Db::name('project')->where('id',$prjId)->find();
        return $res;
    }

    //删除项目
    public function deleteProject($prjId){
        $data["status"] = 0;
        $res = Db::name('project')->where('id',$prjId)->update($data);
        return $res;
    }

    //切换项目
    public function setStatus($prjId,$status)
    {
        $data['status'] = $status;
        $res = Db::name('project')->where('id',$prjId)->update($data);
        return $res;
    }

    //获得项目备注
    public function getPrjRemark($prjId){
        $res = Db::name('project')->where('id',$prjId)->find();
        return $res['remark'];
    }

    //获得项目列表
    public function getPrjList($limit,$offset){       
        $resTB = Db::name('project') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) -> select();
        $total = Db::name('project') ->where('status','<>',0)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['prj_name'] = $value['prj_name'];
            $info['creator_name'] = $value['creator_name'];
            $info['create_date'] = $value['create_date'];
            $info['remark'] = $value['remark'];
            $info['status'] = $value['status'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
    }
}