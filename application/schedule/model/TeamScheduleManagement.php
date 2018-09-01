<?php
namespace app\schedule\model;
use think\Model;
use think\Db;
class TeamScheduleManagement extends Model
{
	
	//public 
	
	//获得所有排期数据
	public function getAllScheduleData($start){
		$resTB = Db::name('schedule')->where('start_time','>=',$start) ->where('status','=',1)-> select();
		$data = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['title'] = $value['title'];
            $info['start_time'] = $value['start_time'];
            $info['end_time'] = $value['end_time'];
            $info['color'] = $value['color'];
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            array_push($data, $info);
        }
        return json_encode($data, true);  
	}
	
	//按用户id获得排期数据
	public function getScheduleDataByCreatotId($start,$memberIds){
		$resTB = Db::name('schedule')->where('creator_id','in',$memberIds)->where('start_time','>=',$start) ->where('status','=',1)-> select();
		$data = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['title'] = $value['title'];
            $info['start_time'] = $value['start_time'];
            $info['end_time'] = $value['end_time'];
            $info['color'] = $value['color'];
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            array_push($data, $info);
        }
        return json_encode($data, true);  
	}
	
	//获得排期表中的所以项目成员信息
    public function getMembers(){       
        $resTB = Db::name('schedule')->group('creator_id')-> Order('creator_name desc')-> field(['creator_id','creator_name'])->select();
        return json_encode($resTB, true);  
    }
	

	
}