<?php
namespace app\datadictionary\model;
use think\Model;
use think\Db;
class TestEnvManagement extends Model
{
    /**
     * @param $data
     * @return int
     * 添加测试环境
     */
    public function addEnv($data){
    	$res = Db::name('test_env')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    /**
     * @param $prjId
     * @param $data
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新测试环境信息
     */
    public function editEnv($envId,$data)
    {
        $res = Db::name('test_env')->where('id',$envId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    /**
     * @param $prjId
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试环境信息
     */
    public function getEnvInfo($envId){
        $res = Db::name('test_env')->where('id',$envId)->find();
        return $res;
    }

    /**
     * @param $envId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除测试环境
     */
    public function deleteEnv($envId){
        $data["status"] = 0;
        $res = Db::name('test_env')->where('id',$envId)->update($data);
        return $res;
    }

    /**
     * @param $envId
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试环境备注
     */
    public function getEnvRemark($envId){
        $res = Db::name('test_env')->where('id',$envId)->find();
        return $res['remark'];
    }

    /**
     * @param $limit
     * @param $offset
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试环境列表
     */
    public function getEnvList($limit,$offset){
        $resTB = Db::name('test_env') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) -> select();
        $total = Db::name('test_env') ->where('status','<>',0)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['env_name'] = $value['env_name'];
            $info['creator_name'] = $value['creator_name'];
            $info['create_date'] = $value['create_date'];
            $info['remark'] = $value['remark'];
            $info['status'] = $value['status'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
    }
}