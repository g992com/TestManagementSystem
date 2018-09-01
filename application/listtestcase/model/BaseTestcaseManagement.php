<?php

namespace app\listtestcase\model;

use think\Model;
use think\Db;

class BaseTestcaseManagement extends Model
{
    /**
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得所有计划
     */
    public function getAllTestPlans()
    {
        $resTB = Db::name('test_plan')->where('status', '<>', 0)->field('id,test_plan_name')->order('id desc')->select();
        if ($resTB > 0) {
            return $resTB;
        } else {
            return '';
        }
    }

    /**
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得所有测试模块
     */
    public function getAllTestModules()
    {
        $resTB = Db::name('test_module')->where('status', '<>', 0)->field('id,module_name')->order('id desc')->select();
        if ($resTB > 0) {
            return $resTB;
        } else {
            return '';
        }
    }

    /**
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得所有测试类型
     */
    public function getAllTestTypes()
    {
        $resTB = Db::name('test_type')->where('status', '<>', 0)->field('id,type_name')->order('id desc')->select();
        if ($resTB > 0) {
            return $resTB;
        } else {
            return '';
        }
    }

    /**
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得所有测试环境
     */
    public function getAllTestEnvs()
    {
        $resTB = Db::name('test_env')->where('status', '<>', 0)->field('id,env_name')->order('id desc')->select();
        if ($resTB > 0) {
            return $resTB;
        } else {
            return '';
        }
    }


    /**
     * @param $limit
     * @param $offset
     * @param $testModuleId
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得基线测试用例列表
     */
    public function getTestcaseList($limit, $offset, $testModuleId, $keys)
    {
        $resTB = null;
        $total = 0;
        if ($testModuleId == 0) {
            if ($keys == "") {
                $resTB = Db::name('base_testcase')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->select();
                $total = Db::name('base_testcase')->where('status', '<>', 0)->count();
            }else{
                $where['tc_name|per_descript|step_descript|expect_descript|creator_name|tag'] = array('like', "%" . $keys . "%", 'or');
                $resTB = Db::name('base_testcase')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->where($where)->select();
                $total = Db::name('base_testcase')->where('status', '<>', 0)->where($where)->count();
            }

        } else {
            if ($keys == "") {
                $resTB = Db::name('base_testcase')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->where('test_module_id', '=', $testModuleId)->select();
                $total = Db::name('base_testcase')->where('status', '<>', 0)->where('test_module_id', '=', $testModuleId)->count();
            }else{
                $where['tc_name|per_descript|step_descript|expect_descript|creator_name|tag'] = array('like', "%" . $keys . "%", 'or');
                $resTB = Db::name('base_testcase')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->where('test_module_id', '=', $testModuleId)->where($where)->select();
                $total = Db::name('base_testcase')->where('status', '<>', 0)->where('test_module_id', '=', $testModuleId)->where($where)->count();
            }
         }
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['tc_name'] = $value['tc_name'];
            $info['creator_name'] = $value['creator_name'];
            $info['per_descript'] = $value['per_descript'];
            $info['step_descript'] = $value['step_descript'];
            $info['expect_descript'] = $value['expect_descript'];
            $info['create_date'] = $value['create_date'];
            $info['tag'] = $value['tag'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }

    /**
     * @param $data
     * @return int
     * 创建基线测试用例
     */
    public function createBaseTestCase($data)
    {
        $res = Db::name('base_testcase')->insert($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $tcId
     * @param $data
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新基线用例内容
     */
    public function updateBaseTestCase($tcId, $data)
    {
        $res = Db::name('base_testcase')->where('id', $tcId)->update($data);
        return $res;
    }

    /**
     * @param $tcId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除基线用例
     */
    public function deleteTesCase($tcId)
    {
        $data["status"] = 0;
        $res = Db::name('base_testcase')->where('id', $tcId)->update($data);
        return $res;
    }

    /**
     * @param $tcId
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得测试用例对象信息
     */
    public function getBaseTCInfoById($tcId)
    {
        $resTB = Db::name('base_testcase')->where('id', '=', $tcId)->find();
        $data['tc_name'] = $resTB['tc_name'];
        $data['tag'] = $resTB['tag'];
        $data['per_descript'] = $resTB['per_descript'];
        $data['step_descript'] = $resTB['step_descript'];
        $data['expect_descript'] = $resTB['expect_descript'];
        return json_encode($data, true);
    }

    /**
     * @param $sendTestCaseId
     * @param $testPlanId
     * @param $testModuleId
     * @param $testTypeId
     * @param $testEnvId
     * @param $testLevel
     * @return int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 将基线用例发送到普通用例库
     */
    public function send2TC($sendTestCaseId,$testPlanId,$testModuleId,$testTypeId,$testEnvId,$testLevel){
        $resTB = Db::name('base_testcase')->where('id', $sendTestCaseId)->find();
        $data['test_plan_id'] = $testPlanId;
        $data['test_module_id'] = $testModuleId;
        $data['test_type_id'] = $testTypeId;
        $data['test_env_id'] = $testEnvId;
        $data['tc_level'] = $testLevel;
        $data['tc_name'] = $resTB['tc_name'];
        $data['per_descript'] = $resTB['per_descript'];
        $data['step_descript'] = $resTB['step_descript'];
        $data['expect_descript'] = $resTB['expect_descript'];
        $data['tag'] = $resTB['tag'];
        $data['creator_name'] = session('realName');
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $res = Db::name('list_testcase')->insert($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $tcId
     * @param $operatorName
     * @return int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 克隆基线用例
     */
    public function cloneTestCase($tcId, $operatorName)
    {
        $resTB = Db::name('base_testcase')->where('id', $tcId)->find();
        $data['test_module_id'] = $resTB['test_module_id'];
        $data['tc_name'] = $resTB['tc_name'];
        $data['per_descript'] = $resTB['per_descript'];
        $data['step_descript'] = $resTB['step_descript'];
        $data['expect_descript'] = $resTB['expect_descript'];
        $data['creator_name'] = $operatorName;
        $data['tag'] = $resTB['tag'];
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $res = Db::name('base_testcase')->insert($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

}