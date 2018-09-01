<?php
namespace app\testtool\model;
use think\Model;
use think\Db;
class TestToolManagement extends Model
{
    /**
     * @param $data
     * @return int
     * 创建HOST文本
     */
    public function addHostText($data){
    	$res = Db::name('host')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    /**
     * @param $flag
     * @return mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得host文本
     */
    public function getHostText($flag){
        Db::name('host')->where('flag',$flag)->setInc('req_times',1);
        $res = Db::name('host')->where('flag',$flag)->find();
        return $res['host_text'];
    }

    /**
     * @param $id
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得host对象信息
     */
    public function getHostInfo($id){
        $res = Db::name('host')->where('id',$id)->find();
        $data['hostName'] = $res['host_name'];
        $data['hostText'] = $res['host_text'];
        return json_encode($data, true);
    }

    /**
     * @param $id
     * @param $data
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 保存host对象信息
     */
    public function saveHostText($id,$data)
    {
        $res = Db::name('host')->where('id',$id)->update($data);
        return $res;
    }

    /**
     * @param $id
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 物理删除host
     */
    public function deleteHost($id){
        $res = Db::name('host')->where('id',$id)->delete();
        return $res;
    }

    /**
     * @param $testPlanId
     * @param $data
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 编辑测试计划内容
     */
    public function editTestPlan($testPlanId,$data)
    {
        $res = Db::name('test_plan')->where('id',$testPlanId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    /**
     * @param $testPlanId
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试计划信息
     */
    public function getTestPlanInfo($testPlanId){
        $res = Db::name('test_plan')->where('id',$testPlanId)->find();
        return $res;
    }

    /**
     * @param $testPlanId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除测试计划
     */
    public function deleteTestPlan($testPlanId){
        $data["status"] = 0;
        $res = Db::name('test_plan')->where('id',$testPlanId)->update($data);
        return $res;
    }


    /**
     * @param $limit
     * @param $offset
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得host列表数据
     */
    public function getHostsData($limit,$offset){
        $resTB = Db::name('host') -> limit($offset, $limit) -> Order('id desc')-> select();
        $total = Db::name('host') -> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['host_name'] = $value['host_name'];
            $info['url'] = $value['url'];
            $info['operate_time'] = $value['operate_time'];
            $info['operator'] = $value['operator'];
            $info['req_times'] = $value['req_times'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }
}