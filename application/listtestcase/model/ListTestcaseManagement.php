<?php

namespace app\listtestcase\model;

use think\Model;
use think\Db;

class ListTestcaseManagement extends Model
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
     * @param $id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得测试模块名称
     */
    public function getTestModuleNameById($id)
    {
        $resTB = Db::name('test_module')->where('id', '=', $id)->find();
        return $resTB['module_name'];
    }

    /**
     * @param $id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得测试类型名称
     */
    public function getTestTypeNameById($id)
    {
        $resTB = Db::name('test_type')->where('id', '=', $id)->find();
        return $resTB['type_name'];
    }

    /**
     * @param $id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得测试环境名称
     */
    public function getTesEnvNameById($id)
    {
        $resTB = Db::name('test_env')->where('id', '=', $id)->find();
        return $resTB['env_name'];
    }

    /**
     * @param $tcId
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得用例信息
     */
    public function getTCInfoById($tcId)
    {
        $resTB = Db::name('list_testcase')->where('id', '=', $tcId)->find();
        $data['per_descript'] = $resTB['per_descript'];
        $data['step_descript'] = $resTB['step_descript'];
        $data['expect_descript'] = $resTB['expect_descript'];
        return json_encode($data, true);
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
     * @param $testPlanId
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试用例列表数据
     */
    public function getTestcaseList($limit, $offset, $testPlanId, $keys)
    {
        $resTB = null;
        $total = 0;
        if ($testPlanId == 0) {
            if ($keys == "") {
                $resTB = Db::name('list_testcase')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->select();
                $total = Db::name('list_testcase')->where('status', '<>', 0)->count();
            } else {
                $where['tc_name|per_descript|step_descript|expect_descript|creator_name|operator_name|tag|tc_level'] = array('like', "%" . $keys . "%", 'or');
                $resTB = Db::name('list_testcase')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->where($where)->select();
                $total = Db::name('list_testcase')->where('status', '<>', 0)->where($where)->count();
            }
        } else {
            if ($keys == "") {
                $resTB = Db::name('list_testcase')->limit($offset, $limit)->Order('id asc')->where('status', '<>', 0)->where('test_plan_id', '=', $testPlanId)->select();
                $total = Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', '=', $testPlanId)->count();
            } else {
                $where['tc_name|per_descript|step_descript|expect_descript|creator_name|operator_name|tag|tc_level'] = array('like', "%" . $keys . "%", 'or');
                $resTB = Db::name('list_testcase')->limit($offset, $limit)->Order('id asc')->where('status', '<>', 0)->where('test_plan_id', '=', $testPlanId)->where($where)->select();
                $total = Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', '=', $testPlanId)->where($where)->count();
            }

        }

        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $listTestcaseId = $value['id'];
            $info['id'] = $listTestcaseId;
            $info['tc_name'] = $value['tc_name'];
            $info['tc_level'] = $value['tc_level'];
            $info['operator_name'] = $value['operator_name'];
            $info['test_module'] = $this->getTestModuleNameById($value['test_module_id']);
            $info['test_type'] = $this->getTestTypeNameById($value['test_type_id']);
            $info['test_env'] = $this->getTesEnvNameById($value['test_env_id']);
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            $info['per_descript'] = $value['per_descript'];
            $info['step_descript'] = $value['step_descript'];
            $info['expect_descript'] = $value['expect_descript'];
            $info['create_date'] = $value['create_date'];
            $info['run_date'] = $value['run_date'];
            $info['tag'] = $value['tag'];
            $info['is_smoke'] = $value['is_smoke'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }

    /**
     * @param $limit
     * @param $offset
     * @param $testPlanId
     * @param $testModuleId
     * @param $testTypeId
     * @param $testEnvId
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 高级查询测试用例
     */
    public function advSearchTC($limit, $offset, $testPlanId, $testModuleId, $testTypeId, $testEnvId)
    {
        $map = array();

        if ($testPlanId <> 0) {
            $map['test_plan_id'] = $testPlanId;
        }
        if ($testModuleId <> 0) {
            $map['test_module_id'] = $testModuleId;
        }
        if ($testTypeId <> 0) {
            $map['test_type_id'] = $testTypeId;
        }
        if ($testEnvId <> 0) {
            $map['test_env_id'] = $testEnvId;
        }

        $resTB = Db::name('list_testcase')->limit($offset, $limit)->Order('id asc')->where('status', '<>', 0)->where($map)->select();
        $total = Db::name('list_testcase')->where('status', '<>', 0)->where($map)->count();

        if ($resTB == null) {
            echo '{"total":0,"rows":[]}' . dump($map);
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $listTestcaseId = $value['id'];
            $info['id'] = $listTestcaseId;
            $info['tc_name'] = $value['tc_name'];
            $info['tc_level'] = $value['tc_level'];
            $info['operator_name'] = $value['operator_name'];
            $info['test_module'] = $this->getTestModuleNameById($value['test_module_id']);
            $info['test_type'] = $this->getTestTypeNameById($value['test_type_id']);
            $info['test_env'] = $this->getTesEnvNameById($value['test_env_id']);
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            $info['per_descript'] = $value['per_descript'];
            $info['step_descript'] = $value['step_descript'];
            $info['expect_descript'] = $value['expect_descript'];
            $info['create_date'] = $value['create_date'];
            $info['run_date'] = $value['run_date'];
            $info['tag'] = $value['tag'];
            $info['is_smoke'] = $value['is_smoke'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }

    /**
     * @param $data
     * @return int
     * 创建测试用例
     */
    public function createListTestCase($data)
    {
        $res = Db::name('list_testcase')->insert($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $tcId
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试用例对象内容
     */
    public function getTestCaseInfo($tcId)
    {
        $res = Db::name('list_testcase')->where('id', $tcId)->find();
        return $res;
    }

    /**
     * @param $tcId
     * @param $data
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新测试用例内容
     */
    public function updateListTestCase($tcId, $data)
    {
        $res = Db::name('list_testcase')->where('id', $tcId)->update($data);
        return $res;
    }

    /**
     * @param $tcId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除测试用例
     */
    public function deleteTesCase($tcId)
    {
        $data["status"] = 0;
        $res = Db::name('list_testcase')->where('id', $tcId)->update($data);
        return $res;
    }

    /**
     * @param $tcId
     * @param $status
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 修改测试用例状态值
     */
    public function modifyStatus($tcId, $status)
    {
        $data["status"] = $status;
        $res = Db::name('list_testcase')->where('id', $tcId)->update($data);
        return $res;
    }

    /**
     * @param $tcId
     * @param $status
     * @param $operatorName
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 执行测试用例
     */
    public function runTC($tcId, $status, $operatorName)
    {
        $data["status"] = $status;
        $data["operator_name"] = $operatorName;
        $data['run_date'] = date('Y-m-d H:i:s', time());
        $res = Db::name('list_testcase')->where('id', $tcId)->update($data);
        return $res;

    }

    /**
     * @param $tcId
     * @param $operatorName
     * @return int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 克隆测试用例
     */
    public function cloneTestCase($tcId, $operatorName)
    {
        $resTB = Db::name('list_testcase')->where('id', $tcId)->find();
        $data['test_module_id'] = $resTB['test_module_id'];
        $data['test_type_id'] = $resTB['test_type_id'];
        $data['test_env_id'] = $resTB['test_env_id'];
        $data['tc_name'] = $resTB['tc_name'];
        $data['per_descript'] = $resTB['per_descript'];
        $data['step_descript'] = $resTB['step_descript'];
        $data['expect_descript'] = $resTB['expect_descript'];
        $data['test_plan_id'] = $resTB['test_plan_id'];
        $data['creator_name'] = $operatorName;
        $data['tc_level'] = $resTB['tc_level'];
        $data['tag'] = $resTB['tag'];
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
     * @param $testPlanId
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 查询需要导出的测试用例数据
     */
    public function getExcelTCData($testPlanId)
    {
        return Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', '=', $testPlanId)->order('id desc')->select();
    }

    /**
     * @param $data
     * @return int
     * 添加用例分享信息
     */
    public function createShareTCInfo($data)
    {
        $res = Db::name('list_tc_share')->insert($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $sendTestCaseId
     * @param $testModuleId
     * @return int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 发送用例到基线库
     */
    public function send2BaseTC($sendTestCaseId,$testModuleId){
        $resTB = Db::name('list_testcase')->where('id', $sendTestCaseId)->find();
        $data['test_module_id'] = $testModuleId;
        $data['tc_name'] = $resTB['tc_name'];
        $data['per_descript'] = $resTB['per_descript'];
        $data['step_descript'] = $resTB['step_descript'];
        $data['expect_descript'] = $resTB['expect_descript'];
        $data['creator_name'] = session('realName');
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