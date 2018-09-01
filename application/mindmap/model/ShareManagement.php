<?php
namespace app\mindmap\model;
use think\Model;
use think\Db;
class ShareManagement extends Model
{   
    
//获得分享列表
    public function getShareList($limit,$offset){       
        $resTB = Db::name('map_share') ->limit($offset, $limit) -> Order('id desc')-> select();
        $total = Db::name('map_share') -> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['create_date'] = $value['create_date'];
            $info['share_url'] = $value['share_url'];
            $info['map_name'] = $value['map_name'];
            $info['map_id'] = $value['map_id'];
            $info['creator_name'] = $value['creator_name'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
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
  

}