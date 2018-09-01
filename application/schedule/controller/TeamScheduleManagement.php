<?php
namespace app\schedule\controller;
use think\Controller;
use app\schedule\model\TeamScheduleManagement as TSM;

class TeamScheduleManagement extends Controller
{
    public function index()
    {
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
        return $this->fetch();
    }
    
    //获得排期数据
    public function getScheduleData(){
    		//获得查询范围
    		$start = $_POST['start'];
    		
    		$getRange = $_POST['getRange'];
    		$tsm = new TSM;
    		if($getRange == 'All'){
    			echo $tsm->getAllScheduleData($start); //获得所有人的排期
    		}else{
    			$memberIds = array();
    			foreach ($getRange as $value) {
            		array_push($memberIds, $value['creator_id']);
			}
    			echo $tsm->getScheduleDataByCreatotId($start,$memberIds); 
    		}
    }
    
    //获得排期表中的所以项目成员信息
    public function getMembers(){
    	 	$tsm = new TSM;
        echo $tsm->getMembers();
    	
    }
}
