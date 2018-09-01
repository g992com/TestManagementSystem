<?php
namespace app\schedule\controller;
use think\Controller;
use app\schedule\model\PlanScheduleManagement as PSM;

class PlanScheduleManagement extends Controller
{
    public function index()
    {
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
        $planId = $_GET['planId'];
        $this -> assign('planId',$planId);
        $psm = new PSM;
        $this -> assign('planName', $psm->getPlanNameById($planId));
        return $this->fetch();
    }
   
    
    //添加排期表名称
    public function addPlan(){
    		$planName = $_POST['planName'];
    		$data['plan_name'] = $planName;
    		$data['creator_name'] = $_POST['creatorName'];
    		$data['creator_id'] = $_POST['creatorId'];
    		$data['create_date'] = date('Y-m-d H:i:s',time());
    		$data['status'] = 1;
    		$psm = new PSM;
        $result = $psm->addPlan($planName,$data);
        if($result==-1){
            return ['status'=>-1,'info'=>'已经存在相同名称的排期表，请重新指定名称！'];
        }else if($result==0){
            return ['status'=>0,'info'=>'新增排期表名称失败，请重试！'];
        }else{
        		return ['status'=>$result,'info'=>'新增排期表名称成功！'];
        }
    }
    
    //获得排期表名称
    public function getPlans(){
    	$creatorId = $_GET['creatorId'];
    	$psm = new PSM;
        echo $psm->getPlans($creatorId);
    }
    
    //按计划id获得排期数据
    public function getPlanContent(){
    		$planId = $_POST['planId'];
    		$psm = new PSM;
    		return $psm->getPlanContent($planId);;
    }
    
     //保存排期数据
     public function saveHotData(){
     	$planId = $_POST['planId'];
        $data['content']= $_POST['htdata'];
        $psm = new PSM;
        $result = $psm->saveHotData($planId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'保存排期表成功！'];
        }else{
            return ['status'=>0,'info'=>'保存排期表失败，请重试！'];
        }
     }
     
     //删除排期表
     public function delPlan(){
     	$planId = trim($_POST['id']);
        $psm = new PSM;
        $result = $psm->delPlan($planId);
        if($result==1){
            return ['status'=>1,'info'=>'删除排期表成功！'];
        }else{
            return ['status'=>0,'info'=>'删除排期表失败，请重试！'];
        }
     }
     
     //获得测试人员
     public function getTester(){
     	$key = trim($_GET['key']);
     	$psm = new PSM;
        echo $psm->getTester($key);
     }
}
