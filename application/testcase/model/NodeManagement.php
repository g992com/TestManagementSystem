<?php
namespace app\testcase\model;
use think\Model;
use think\Db;
class NodeManagement extends Model
{   
    //获得所有启用状态的项目
    public function getAllPrj(){       
        $resTB = Db::name('project') -> Order('id desc')->where('status','<>',0)->where('status','<>',2) -> select();
        return $resTB;  
    }

    //获得项目下的所有节点
     public function getPrjNode($prjId){
     	$resTB = Db::name('node') -> Order('id desc')->where('prj_id','=',$prjId)->where('status','=',1) -> select();
     	$result = array();
     	foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['text'] = $value['node_name'];
            $info['creator'] = $value['creator_name'];
            array_push($result, $info);
        }
        return json_encode($result, true);
     }

    //获得节点信息
    public function getNodeInfo($nodeId){
       $resTB = Db::name('node') ->where('id','=',$nodeId) -> find();
        $data['nodeName'] = $resTB['node_name'];
        $data['remark'] = $resTB['remark'];
        return json_encode($data, true);  
    }

    //添加节点
    public function addPrjNode($data){
    	$res = Db::name('node')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    //删除节点
    public function deletePrjNode($id){
        $data["status"] = 0;
        $res = Db::name('node')->where('id',$id)->update($data);
        return $res;
    }

    //编辑节点
    public function savePrjNode($id,$data)
    {
        $res = Db::name('node')->where('id',$id)->update($data);
        return $res;
    }


}