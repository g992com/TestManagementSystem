<?php
namespace app\schedule\model;
use think\Model;
use think\Db;
class PlanScheduleManagement extends Model
{
	//添加排期表
    public function addPlan($planName,$data){
	    	$count = Db::name('plan') ->where('plan_name','=',$planName)-> count();
	    	if($count>0){
	    		return -1;//已经存在相同名称时，返回-1
	    	}else{
	    		$res = Db::name('plan')-> insert($data);
		    	if($res){//添加成功时返回插入后的id号
		    		$res2 = Db::name('plan')->where('plan_name','=',$planName)->find();
        			return $res2['id'];
		    	}else{
		    		return 0;//添加失败时返回0
		    	}
	    	}    
	}
	
	//获得排期表名称
    public function getPlans($creatorId){ 
    	$resTB = null;
    	if($creatorId==0){
    		$resTB = Db::name('plan')->where('status','=',1)-> Order('id desc')-> field(['id','plan_name','creator_name'])->select();
    	}else{
    		$resTB = Db::name('plan')->where('status','=',1)->where('creator_id','=',$creatorId)-> Order('id desc')-> field(['id','plan_name','creator_name'])->select();
    	}
        
        return json_encode($resTB, true);  
    }
    
    	//按排期Id获得排期表名称
    public function getPlanNameById($id){       
        $resTB = Db::name('plan')->where('id','=',$id)->find();
        return $resTB['plan_name'];
    }
    
    //按计划id获得排期数据
     public function getPlanContent($planId){
     	$resTB = Db::name('plan')->where('id','=',$planId)->find();
     	if($resTB['content']==''){
     		return 'emptyData';
     	}
        return $resTB['content']; 
     }
     
     //保存排期数据
	public function saveHotData($planId,$data){
     	$res = Db::name('plan')->where('id',$planId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
     }
     
    //删除排期表
    public function delPlan($planId){
    		$data["status"] = 0;
        $res = Db::name('plan')->where('id',$planId)->update($data);
        if($res){
	    		return 1;
	    	}else{
	    		return 0;
	    	}
    }
    
    //获得测试人员名称
    public function getTester($key){   
    	$resTB = null;
    	if($key == "All") {
    		$resTB = Db::name('user')->where('status','=',1)-> field(['id','real_name'])->Order('real_name asc')->select();
    	} else{
    		$resTB = Db::name('user')->where('status','=',1)->where('real_name','like','%'.$key.'%')-> field(['id','real_name'])->Order('real_name asc')->select();
    	}
        return json_encode($resTB, true);  
    }
	
}