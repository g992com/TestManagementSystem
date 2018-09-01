<?php
namespace app\mindmap\model;
use think\Model;
use think\Db;
class MapManagement extends Model
{   
    

    //获得导图名称
     public function getMapNode($userId){
     	$resTB = Db::name('mind_map') -> Order('id desc')->where('creator_id','=',$userId)->where('status','=',1) -> select();
     	$result = array();
     	foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['text'] = $value['map_name'];
            $info['creatorId'] = $value['creator_id'];
            $info['creatorName'] = $value['creator_name'];
            $info['icon'] = "Hui-iconfont Hui-iconfont-share";
            array_push($result, $info);
        }
        return json_encode($result, true);
     }

    //添加导图名称
    public function addMapName($data){
    	$res = Db::name('mind_map')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    //删除导图名称
    public function deleteMap($id){
        $data["status"] = 0;
        $res = Db::name('mind_map')->where('id',$id)->update($data);
        return $res;
    }

    //编辑导图名称
    public function editMapName($id,$data)
    {
        $res = Db::name('mind_map')->where('id',$id)->update($data);
        return $res;
    }
    
    //获得导图名称
    public function getMapName($mapId){
    	$resTB = Db::name('mind_map') ->where('id','=',$mapId) -> find();
        return $resTB['map_name']; 
    }
    
    //获得导图数据
    public function getMapData($mapId){
       $resTB = Db::name('mind_map') ->where('id','=',$mapId) -> find();
       return $resTB['json'];  
    }

	//更新导图数据
	public function updateMapData($mapId,$data){
		$res = Db::name('mind_map')->where('id',$mapId)->update($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
	}
	
	//检查是否存在已被分享的导图数据
    public function hasShareMapData($mapId){
    	$count = Db::name('map_share')->where('map_id','=',$mapId)-> count();
    	if($count==1){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    //添加导图数据分享信息
    public function createMapShareInfo($data){
   	 	$res = Db::name('map_share')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

}