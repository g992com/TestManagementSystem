<?php

namespace app\listtestcase\model;

use think\Model;
use think\Db;

class TestPlanManagement extends Model
{
    /**
     * @param $data
     * @return int
     * 创建测试计划
     */
    public function addTestPlan($data)
    {
        $res = Db::name('test_plan')->insert($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $testPlanId
     * @param $data
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 编辑测试计划内容
     */
    public function editTestPlan($testPlanId, $data)
    {
        $res = Db::name('test_plan')->where('id', $testPlanId)->update($data);
        if ($res) {
            return 1;
        } else {
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
    public function getTestPlanInfo($testPlanId)
    {
        $res = Db::name('test_plan')->where('id', $testPlanId)->find();
        return $res;
    }

    /**
     * @param $testPlanId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除测试计划
     */
    public function deleteTestPlan($testPlanId)
    {
        $data["status"] = 0;
        $res = Db::name('test_plan')->where('id', $testPlanId)->update($data);
        return $res;
    }

    //切换项目
    public function setStatus($prjId, $status)
    {
        $data['status'] = $status;
        $res = Db::name('project')->where('id', $prjId)->update($data);
        return $res;
    }

    //获得项目备注
    public function getPrjRemark($prjId)
    {
        $res = Db::name('project')->where('id', $prjId)->find();
        return $res['remark'];
    }

    //获得计划列表
    public function getTestPlanList($limit, $offset, $keys, $statusId)
    {
        $resTB = null;
        $total = 0;
        if ($keys == '') {
            if ($statusId == 1) {
                $resTB = Db::name('test_plan')->limit($offset, $limit)->Order('id desc')->where('status', '<>', 0)->select();
                $total = Db::name('test_plan')->where('status', '<>', 0)->count();
            } else {
                $resTB = Db::name('test_plan')->limit($offset, $limit)->Order('id desc')->where('status', '=', $statusId)->select();
                $total = Db::name('test_plan')->where('status', '=', $statusId)->count();
            }
        } else {
            $where['test_plan_name|creator_name|test_po'] = array('like', "%" . $keys . "%", 'or');
            if ($statusId == 1) {
                $resTB = Db::name('test_plan')->limit($offset, $limit)->Order('id desc')->where($where)->where('status', '<>', 0)->select();
                $total = Db::name('test_plan')->where('status', '<>', 0)->where($where)->count();
            } else {
                $resTB = Db::name('test_plan')->limit($offset, $limit)->Order('id desc')->where($where)->where('status', '=', $statusId)->select();
                $total = Db::name('test_plan')->where('status', '=', $statusId)->where($where)->count();
            }
        }

        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $listTestPlanId = $value['id'];
            $info['id'] = $listTestPlanId;
            $info['test_plan_name'] = $value['test_plan_name'];
            $info['test_po'] = $value['test_po'];
            $info['creator_name'] = $value['creator_name'];
            $info['start_date'] = $value['start_date'];
            $info['end_date'] = $value['end_date'];
            $info['status'] = $value['status'];
            $tcCount = $this->getListTestCaseRunStatus($listTestPlanId);
            $info['tc_totle'] = $tcCount['tcTotle'];
            $info['fail_tc_totle'] = $tcCount['failTCTotle'];
            $info['pass_tc_totle'] = $tcCount['passTCTotle'];
            $noRunTCTotle = (int)$tcCount['tcTotle'] - (int)$tcCount['failTCTotle'] - (int)$tcCount['passTCTotle'];
            $info['no_run_tc_totle'] = $noRunTCTotle;
            if ((int)$tcCount['tcTotle'] == 0) {
                $info['progress'] = 0;
            } else {
                $info['progress'] = round(1 - ((int)$noRunTCTotle / (int)$tcCount['tcTotle']), 1) * 100;
            }
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }

    public function getListTestCaseRunStatus($listTestPlanId)
    {
        $tcTotle = Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', '=', $listTestPlanId)->count();
        // $noRunTCTotle = Db::name('list_testcase')->where('status','<>',0) ->where('test_plan_id','=',$listTestPlanId)->where('test_result','=',0)-> count();
        $failTCTotle = Db::name('list_testcase')->where('status', '=', 4)->where('test_plan_id', '=', $listTestPlanId)->count();
        $passTCTotle = Db::name('list_testcase')->where('status', '=', 5)->where('test_plan_id', '=', $listTestPlanId)->count();
        $tcCount['tcTotle'] = $tcTotle;
        // $tcCount['noRunTCTotle']=$noRunTCTotle;
        $tcCount['failTCTotle'] = $failTCTotle;
        $tcCount['passTCTotle'] = $passTCTotle;
        return $tcCount;
    }

    /**
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得所有测试人员
     */
    public function getAllTestPOs()
    {
        $resTB = Db::name('user')->where('status', '<>', 0)->where('role_id', '=', 1)->field('id,real_name')->order('real_name asc')->select();
        if ($resTB > 0) {
            return $resTB;
        } else {
            return '';
        }
    }
}