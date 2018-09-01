<?php
namespace app\schedule\model;
use think\Model;
use think\Db;
class PersonScheduleManagement extends Model
{
	//获得排期数据
	public function getScheduleData($start,$creatorId){
		$resTB = Db::name('schedule')->where('start_time','>=',$start) ->where('creator_id','=',$creatorId) ->where('status','=',1)-> select();
		$data = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['title'] = $value['title'];
            $info['start_time'] = $value['start_time'];
            $info['end_time'] = $value['end_time'];
            $info['color'] = $value['color'];
            $info['creator_id'] = $value['creator_id'];
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            array_push($data, $info);
        }
        return json_encode($data, true);  
	}
	
	//重新保存排期数据
	public function reSaveEvent($id,$data){
		$res = Db::name('schedule')->where('id',$id)->update($data);
    		if($res){
    			return 1;
    		}else{
    			return 0;
    		}
	}
	
	//添加排期数据
    public function addEvent($data){
	    	$res = Db::name('schedule')-> insert($data);
	    	if($res){
	    		return 1;
	    	}else{
	    		return 0;
	    	}
    }
    
    public function editEvent($eventId,$data){
        $res = Db::name('schedule')->where('id',$eventId)->update($data);
        if($res){
	    		return 1;
	    	}else{
	    		return 0;
	    	}
    }
    
    //删除排期数据
    public function delEvent($eventId){
    		$data["status"] = 0;
        $res = Db::name('schedule')->where('id',$eventId)->update($data);
        if($res){
	    		return 1;
	    	}else{
	    		return 0;
	    	}
    }
	
}