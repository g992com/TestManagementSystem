<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Index extends Model
{
	//获得系统一级菜单
	public function getParentMenus(){
		$menus = Db::name('top_menu')->select();
		return $menus;
	}
	
	
	//获得系统菜单
    public function getMenus($functionId){
    	$menus1 = Db::name('menu')->where(['function_id'   => ['=', $functionId],'pId' => ['=', 0]])->select();//查询菜单第一层节点（父节点）
    	if(0 == count($menus1)){
    		return json(['status'=>0,'info'=>'没有导航数据，导航菜单加载失败！']);
    	}else{    		
 			$data = array();
 			foreach ($menus1 as $value1) {
 				$id =  $value1['id'];
 				$info['id'] = $id;
 				$info['pId'] = $value1['pId'];
 				$info['name'] = $value1['name'];
 				$info['open'] = true;
 				array_push($data, $info);
 				$menus2 = Db::name('menu') -> where('pId','=',$id)-> order('menu_index asc') -> select();//查询菜单第二层节点（菜单节点）
 				foreach ($menus2 as $value2) {
 					$id =  $value2['id'];
 					$info['id'] = $id;
 					$info['pId'] = $value2['pId'];
 					$info['name'] = $value2['name'];
 					$info['file'] = $value2['file'];
 					array_push($data, $info);
 				}
 			}
 			return json(['status'=>1,'info'=>json_encode($data, true)]);
    	}
    }

}