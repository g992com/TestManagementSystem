<?php

namespace app\testcase\controller;
use app\testcase\model\NodeManagement as NM;
use app\testcase\model\TestcaseManagement as TCM;
use think\Controller;

class TestcaseManagement extends controller
{
    //测试用例管理页面
    public function index()
    {   
        $nm = new NM;
        $this -> assign('prjLst', $nm->getAllPrj());
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    		return $this->fetch();
    }
    
     //Flow页面
    public function flow_page()
    {   
    	$nodeId = trim($_GET['nodeId']);
        $tc = new TCM;
        $nodeInfo =  $tc->getNodeInfo($nodeId);
        $this -> assign('nodeId', $nodeId);
        $this -> assign('nodeName', $nodeInfo['node_name']);
        $this -> assign('PrjId', $nodeInfo['prj_id']);
        $this -> assign('creatorName', $nodeInfo['creator_name']);
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    		return $this->fetch();
    }
    
    //获得Flow数据
    public function getFlowData(){
        $nodeId = trim($_POST['nodeId']);
        $tcm = new TCM;
        $result = $tcm->getFlowData($nodeId);
        return $result;
    }
    
    //保存Flow数据
    public function saveFlowData(){
    	$nodeId = trim($_POST['nodeId']);
    	$data['prj_id'] = trim($_POST['PrjId']);
        $data['node_id'] = $nodeId;
        $data['node_id'] = trim($_POST['nodeId']);
        $data['creator_name'] = trim($_POST['creator']);
        $data['json'] = $_POST['json'];
        $data['create_date'] = date('Y-m-d H:i:s',time());
        
        $tcm = new TCM;
        $count = $tcm->getFlowDataCountByNodeId($nodeId);
       
        if($count==0){
        		$result = $tcm->addFlowData($data);
        		 if($result==1){
            		return ['status'=>1,'info'=>'用例保存成功！'];
        		 }else{
            		return ['status'=>0,'info'=>'用例保存失败，请重试！'];
        		 }
        }else{
        		$result = $tcm->updateFlowData($nodeId,$data);
        		 if($result==1){
            		return ['status'=>1,'info'=>'用例保存成功！'];
        		 }else{
            		return ['status'=>0,'info'=>'用例保存失败，请重试！'];
        		 }
        }
        
    }
    
    //获得测试用例
    public function getTestCase(){
    		$limit = $_GET['limit'];
        $offset = $_GET['offset']; 
        $nodeId = $_GET['nodeId']; 
        $tcm = new TCM;
        echo $tcm->getTestCase($limit,$offset,$nodeId);
    }
    
    //保存测试用例
    public function addTestCase(){
    		$data['tc_name'] = trim($_POST['tcName']);
    		$data['per_descript'] = trim($_POST['perDescript']);
    		$data['step_descript'] = trim($_POST['stepDescript']);
    		$data['expect_descript'] = trim($_POST['expectDescript']);
    		$data['data_descript'] = trim($_POST['dataDescript']);
        $data['node_id'] = trim($_POST['nodeId']);
        $data['prj_id'] = trim($_POST['prjId']);
        $data['creator_name'] = trim($_POST['creator']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['test_result'] = 0;
        $data['review_status'] = 1;
        $data['status'] = 1;
        $tcm = new TCM;
        $result = $tcm->addTestCase($data);
        if($result==1){
            return ['status'=>1,'info'=>'新增用例成功！'];
        }else{
            return ['status'=>0,'info'=>'新增用例失败，请重试！'];
        }
    }
    
    //编辑测试用例
    public function editTestCase(){
    		$data['tc_name'] = trim($_POST['tcName']);
    		$data['per_descript'] = trim($_POST['perDescript']);
    		$data['step_descript'] = trim($_POST['stepDescript']);
    		$data['expect_descript'] = trim($_POST['expectDescript']);
    		$data['data_descript'] = trim($_POST['dataDescript']);
        $tcId = trim($_POST['tcId']);
        $tcm = new TCM;
        $result = $tcm->editTestCase($tcId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑用例成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑用例失败，请重试！'];
        }
    }
    
    //删除用例
    public function deleteTestCase(){
    		$tcId = trim($_POST['tcId']);
    		$tcm = new TCM;
        $result = $tcm->deleteTestCase($tcId);
        if($result==1){
            return ['status'=>1,'info'=>'删除用例成功！'];
        }else{
            return ['status'=>0,'info'=>'删除用例失败，请重试！'];
        }
    }
    
    //获得用例信息
    public function getTestCaseInfo(){
     	$nodeId = trim($_POST['nodeId']);
    		$tcId = trim($_POST['tcId']);
    		$tcm = new TCM;
    	    $result = $tcm->getTestCaseInfo($nodeId,$tcId);
        return $result;
    }
    
    //执行用例
    public function runTestCase(){
    	$tcId = trim($_POST['tcId']);
    	$resultFlag = trim($_POST['resultFlag']);
    	$operator = trim($_POST['operator']);
    	$tcm = new TCM;
        $result = $tcm->runTestCase($tcId,$resultFlag,$operator);
        if($result==1){
            return ['status'=>1,'info'=>'执行用例成功！'];
        }else{
            return ['status'=>0,'info'=>'执行用例失败，请重试！'];
        }
    }
    
    //创建Flow分享信息
    public function createFlowShareInfo(){
    	$nodeId = trim($_POST['nodeId']);
    	$creator = trim($_POST['creator']);
    	$serverIp = trim($_POST['serverIp']);
    	$prefixURL = trim($_POST['prefixURL']);
    	
    	$tcm = new TCM;
    	if(!($tcm->hasFlowData($nodeId))){
    		return ['status'=>-2,'info'=>'请先保存导图后，再作分享！'];  //检查是否存在已保存的数据
    	}else if($tcm->hasShareFlowData($nodeId)){
    		return ['status'=>-1,'info'=>'导图已经被分享过了，不用再作分享操作！'];  //检查是否存在已保存的数据
    	}else{
    		$data['node_id'] = $nodeId;
    		$data['share_url'] = 'http://'.$serverIp.$prefixURL.'/share_management/flow?id='.$nodeId;
    		$data['creator_name'] = $creator;
    		$data['type'] = '导图用例';
    		$data['create_date'] = date('Y-m-d H:i:s',time());
    		$result = $tcm->createFlowShareInfo($data);
    		if($result==1){
            	return ['status'=>1,'info'=>'导图分享成功，请到用例分享页面查看！'];
        	}else{
            	return ['status'=>0,'info'=>'导图分享失败，请重试！'];
        	}
    	}
    }
    
    //创建Table分享信息
    public function createTableShareInfo(){
    	$prjId = trim($_POST['prjId']);
    	$nodeId = trim($_POST['nodeId']);
    	$creator = trim($_POST['creator']);
    	$serverIp = trim($_POST['serverIp']);
    	$prefixURL = trim($_POST['prefixURL']);
    	
    	$tcm = new TCM;
    	//if(!($tcm->hasTableData($nodeId))){
    		//return ['status'=>-2,'info'=>'请至少添加一条用例后，再作分享！'];  //检查是否存在已保存的数据
    //	}else 
    	
    	if($tcm->hasShareTableData($nodeId)){
    		return ['status'=>-1,'info'=>'用例列表已经被分享过了，不用再作分享操作！'];  //检查是否存在已保存的数据
    	}else{
    		$data['node_id'] = $nodeId;
    		$data['share_url'] = 'http://'.$serverIp.$prefixURL.'/share_management/table?prj='.$prjId.'&id='.$nodeId;
    		$data['creator_name'] = $creator;
    		$data['type'] = '冒烟用例';
    		$data['create_date'] = date('Y-m-d H:i:s',time());
    		$result = $tcm->createTableShareInfo($data);
    		if($result==1){
            	return ['status'=>1,'info'=>'用例列表分享成功，请到用例分享页面查看！'];
        	}else{
            	return ['status'=>0,'info'=>'用例列表分享失败，请重试！'];
        	}
    	}
    	
    }
    
    //导出Table数据
    public function exportTCData(){
    	
    	
    }
    

}
