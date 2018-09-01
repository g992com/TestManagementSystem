<?php
namespace app\mindmap\controller;
use app\mindmap\model\ShareManagement as SM;
use think\Controller;

class ShareManagement extends controller
{
    //思维导图列表页面
    public function index()
    {   
    	$this -> assign('userId', session('userID'));
    	return $this->fetch();
    }
    
    public function getShareList(){
    	$usrId= $_GET['usrId'];
    	$limit = $_GET['limit'];
        $offset = $_GET['offset']; 
        $sm = new SM;
        echo $sm->getShareList($limit,$offset);
    }
    
    public function map()
    {   
        $mapId = $_GET['id'];
       	$sm = new SM;
        $mapName =  $sm->getMapName($mapId);
        $this -> assign('mapId', $mapId);
        $this -> assign('mapName', $mapName);
    	return $this->fetch();
    }
    
      //获得导图数据
    public function getMapData(){
        $mapId = trim($_POST['mapId']);
        $sm = new SM;
        $result = $sm->getMapData($mapId);
        return $result;
     } 
}
