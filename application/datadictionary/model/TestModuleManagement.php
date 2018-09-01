<?php
namespace app\datadictionary\model;
use think\Model;
use think\Db;
class TestModuleManagement extends Model
{
    /**
     * @param $data
     * @return int
     * 添加模块
     */
    public function addModule($data){
    	$res = Db::name('test_module')-> insert($data);
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
     * 更新模块信息
     */
    public function editModule($moduleId,$data)
    {
        $res = Db::name('test_module')->where('id',$moduleId)->update($data);
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
     * 获得模块信息
     */
    public function getModuleInfo($moduleId){
        $res = Db::name('test_module')->where('id',$moduleId)->find();
        return $res;
    }

    /**
     * @param $moduleId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除模块
     */
    public function deleteModule($moduleId){
        $data["status"] = 0;
        $res = Db::name('test_module')->where('id',$moduleId)->update($data);
        return $res;
    }

    /**
     * @param $moduleId
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得项目备注
     */
    public function getModuleRemark($moduleId){
        $res = Db::name('test_module')->where('id',$moduleId)->find();
        return $res['remark'];
    }

    /**
     * @param $limit
     * @param $offset
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得模块列表
     */
    public function getModuleList($limit,$offset){
        $resTB = Db::name('test_module') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) -> select();
        $total = Db::name('test_module') ->where('status','<>',0)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['module_name'] = $value['module_name'];
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