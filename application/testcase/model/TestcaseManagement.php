<?php
namespace app\testcase\model;
use think\Model;
use think\Db;
class TestcaseManagement extends Model
{   
    //获得Flow数据
    public function getFlowData($nodeId){
       $resTB = Db::name('flow') ->where('node_id','=',$nodeId) -> find();
        return $resTB['json'];  
    }
    
    //获得节点信息
    public function getNodeInfo($nodeId){
       $resTB = Db::name('node') ->where('id','=',$nodeId) -> find();
        return $resTB;  
    }
    
    //按节点id查询节点下是否存在Flow数据，返回0和1，0表示没有，1表示有
    public function getFlowDataCountByNodeId($nodeId){
    		$resTB = Db::name('flow') ->where('node_id','=',$nodeId) -> count();
    		return $resTB;
    }
    
	//添加Flow数据
	public function addFlowData($data){
		$res = Db::name('flow')-> insert($data);
    		if($res){
    			return 1;
    		}else{
    			return 0;
    		}
	}
	//更新Flow数据
	public function updateFlowData($nodeId,$data){
		$res = Db::name('flow')->where('node_id',$nodeId)->update($data);
    		if($res){
    			return 1;
    		}else{
    			return 0;
    		}
	}
	
	//获得用例列表
    public function getTestCase($limit,$offset,$nodeId){       
        $resTB = Db::name('testcase') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) ->where('node_id','=',$nodeId)-> select();
        $total = Db::name('testcase') ->where('status','<>',0) ->where('node_id','=',$nodeId)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['tc_name'] = $value['tc_name'];
            $info['review_status'] = $value['review_status'];
            $info['test_result'] = $value['test_result'];
            $info['creator_name'] = $value['creator_name'];
            $info['operator_name'] = $value['operator_name'];
            $info['create_date'] = $value['create_date'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
    }
	
	//添加用例
    public function addTestCase($data){
   	 	$res = Db::name('testcase')-> insert($data);
    		if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }
    
    //获得用例信息
    public function getTestCaseInfo($nodeId,$tcId){
    	$res = Db::name('testcase')->where('id','=',$tcId)->find();
        $data['tc_name'] = $res['tc_name'];
        $data['per_descript'] = $res['per_descript'];
        $data['step_descript'] = $res['step_descript'];
        $data['expect_descript'] = $res['expect_descript'];
        $data['data_descript'] = $res['data_descript'];
        $data['test_result'] = $res['test_result'];
        
        $upRes = Db::name('testcase')->where('node_id','=',$nodeId)->where('id','>',$tcId)->where('status','<>',0)->order('id asc')->limit(1)->find();
        $data['upTCId'] = $upRes['id'];
        $nextRes = Db::name('testcase')->where('node_id','=',$nodeId)->where('id','<',$tcId)->where('status','<>',0)->order('id desc')->limit(1)->find();
        $data['nextTCId'] = $nextRes['id'];
        
        return json_encode($data, true);  
    }

    //编辑用例信息
    public function editTestCase($tcId,$data){
    		$res = Db::name('testcase')->where('id',$tcId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }
    
    //删除用例
     public function deleteTestCase($tcId){
        $data["status"] = 0;
        $res = Db::name('testcase')->where('id',$tcId)->update($data);
        return $res;
    }
    
    //执行用例
    public function runTestCase($tcId,$resultFlag,$operator){
    		$data['test_result'] = $resultFlag;
    		$data['operator_name'] = $operator;
    		
    	 	$res = Db::name('testcase')->where('id','=',$tcId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }
    
    //检查是否存在flow数据
    public function hasFlowData($nodeId){
    	$count = Db::name('flow')->where('node_id','=',$nodeId)-> count();
    	if($count==1){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    //检查是否存在已被分享的flow数据
    public function hasShareFlowData($nodeId){
    	$count = Db::name('tc_share')->where('node_id','=',$nodeId)->where('type','=','导图用例')-> count();
    	if($count==1){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    //检查是否存在table数据
    public function hasTableData($nodeId){
    	$count = Db::name('testcase')->where('node_id','=',$nodeId)-> count();
    	if($count>0){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    //获得table数据
    public function getTableData($nodeId){
    	$resTB = Db::name('testcase') -> Order('id desc')->where('status','<>',0) ->where('node_id','=',$nodeId)-> select();
    	return $resTB;
    }
    
    //检查是否存在已被分享的table数据
    public function hasShareTableData($nodeId){
    	$count = Db::name('tc_share')->where('node_id','=',$nodeId)->where('type','=','冒烟用例')-> count();
    	if($count==1){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    //添加Flow数据分享信息
    public function createFlowShareInfo($data){
   	 	$res = Db::name('tc_share')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }
   
    //添加Table数据分享信息
    public function createTableShareInfo($data){
   	 	$res = Db::name('tc_share')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }
    
}