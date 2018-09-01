<?php
namespace app\testcase\controller;
use app\testcase\model\ShareManagement as SM;
use think\Controller;

class ShareManagement extends controller
{
    /**
     * @return mixed
     * 分享管理主页
     */
	public function index()
    {   
    	return $this->fetch();
    }

    /**
     * @return mixed
     * 导图分享展示页面
     */
    public function flow()
    {   
        $nodeId = $_GET['id'];
       	$sm = new SM;
        $nodeName =  $sm->getNodeName($nodeId);
        $this -> assign('nodeId', $nodeId);
        $this -> assign('nodeName', $nodeName);
    	return $this->fetch();
    }
    
    public function table()
    {   
    	$prjId = $_GET['prj'];
        $nodeId = $_GET['id'];
        $sm = new SM;
        $nodeName =  $sm->getNodeName($nodeId);
        $this -> assign('prjId', $prjId);
        $this -> assign('nodeId', $nodeId);
        $this -> assign('nodeName', $nodeName);
    	return $this->fetch();
    }
    
    public function getShareList(){
    	$limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $keyWords= $_GET['key'];
        $sm = new SM;
        echo $sm->getShareList($limit,$offset,$keyWords);
    }
    
    //获得Flow数据
    public function getFlowData(){
        $nodeId = trim($_POST['nodeId']);
        $sm = new SM;
        $result = $sm->getFlowData($nodeId);
        return $result;
     } 
      
    //获得用例信息
    public function getTestCaseInfo(){
    	$tcId = trim($_POST['tcId']);
    	$sm = new SM;
    	$result = $sm->getTestCaseInfo($tcId);
        return $result;
    }
    
    

}
