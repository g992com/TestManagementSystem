<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Index as Idx;

class Index extends Controller
{
	
    public function index()
    {
    	if(session('userID')==null){
    		return $this->fetch('Login\login');
    	}else{
    		$this -> assign('realName', session('realName'));
        	$this -> assign('userId', session('userID'));
        	return $this->fetch();
    	}
        
    }
    
    public function update_log_page()
    {
        return $this->fetch();
    }
    
    
    public function modifyPwdPage(){
    	return $this->fetch();
    }
    //我的主页
    public function myHome(){
    		echo '我的主页内容...';
    }
    
  
    
    public function setSessionNull(){
    		session('userID', null);
    		return ['status'=>1,'info'=>'删除SESSION成功！'];
    }
    
    //获得用户的菜单树节点
 	//public function getMenu(){
 	//	$index = new Idx;
 	//	return $index->getMenus(input('function_id'));
 	//}   
   
}
