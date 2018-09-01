<?php
namespace app\mindmap\controller;
use app\mindmap\model\MapManagement as MM;
use think\Controller;

class MapManagement extends controller
{
    //我的思维导图页面
    public function index()
    {   
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    	return $this->fetch();
    }
    
     //错误页面
    public function tip_page()
    {   
    	return $this->fetch();
    }
    
    public function map_page(){
    	$mapId = $_GET['mapId'];
    	$mm = new MM;
    	$mapName = $mm->getMapName($mapId);
    	$this -> assign('mapName', $mapName);
    	$this -> assign('mapId', $mapId);
    	$this -> assign('userId', session('userID'));
    	$this -> assign('realName', session('realName'));
    	return $this->fetch();
    }
    
    public function getMapNode(){
    	$userId = trim($_POST['userId']);
        $mm = new MM;
        $result = $mm->getMapNode($userId);
        return $result;
    }
    
    //添加导图名称
    public function addMapName(){
    	$data['map_name'] = trim($_POST['mapName']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['creator_id'] = trim($_POST['creatorId']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;
         $mm = new MM;
        $result = $mm->addMapName($data);
        if($result==1){
            return ['status'=>1,'info'=>'新增导图名称成功！'];
        }else{
            return ['status'=>0,'info'=>'新增导图名称失败，请重试！'];
        }
    }
    
     //修改导图名称
    public function  editMapName(){
        $mapId = trim($_POST['mapId']);
        $data['map_name'] = trim($_POST['mapName']);
        $mm = new MM;
        $result = $mm->editMapName($mapId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑导图名称成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑导图名称失败，请重试！'];
        }
    }
    
     //删除导图名称
    public function deleteMap(){
        $mapId = trim($_POST['id']);
        $mm = new MM;
        $result = $mm->deleteMap($mapId);
        if($result==1){
            return ['status'=>1,'info'=>'删除导图名称成功！'];
        }else{
            return ['status'=>0,'info'=>'删除导图名称失败，请重试！'];
        }
    }
    
    //获得导图数据
    public function getMapData(){
    	$mapId = trim($_POST['mapId']);
        $mm = new MM;
        $result = $mm->getMapData($mapId);
        return $result;
    }
    
    //保存导图数据
    public function saveMapData(){
    	$mapId = trim($_POST['mapId']);
        $data['json'] = $_POST['json'];
        $mm = new MM;
        $result = $mm->updateMapData($mapId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'导图保存成功！'];
        }else{
            return ['status'=>0,'info'=>'导图保存失败，请重试！'];
        }
    }
    
    
    //创建导图分享信息
    public function createMapShareInfo(){
    	$mapId = trim($_POST['mapId']);
    	$mapName = trim($_POST['mapName']);
    	$creatorName = trim($_POST['creatorName']);
    	$creatorId = trim($_POST['creatorId']);
    	$serverIp = trim($_POST['serverIp']);
    	$prefixURL = trim($_POST['prefixURL']);
    	
    	$mm = new MM;
    	if($mm->hasShareMapData($mapId)){
    		return ['status'=>-1,'info'=>'导图已经被分享过了，不用再作分享操作！'];  //检查是否存在已保存的数据
    	}else{
    		$data['map_id'] = $mapId;
    		$data['map_name'] = $mapName;
    		$data['share_url'] = 'http://'.$serverIp.$prefixURL.'/share_management/map?id='.$mapId;
    		$data['creator_name'] = $creatorName;
    		$data['creator_id'] = $creatorId;
    		$data['create_date'] = date('Y-m-d H:i:s',time());
    		$result = $mm->createMapShareInfo($data);
    		if($result==1){
            	return ['status'=>1,'info'=>'导图分享成功，请到分享页面查看！'];
        	}else{
            	return ['status'=>0,'info'=>'导图分享失败，请重试！'];
        	}
    	}
    }
}
