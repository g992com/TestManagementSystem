<?php

namespace app\listtestcase\model;

use think\Model;
use think\Db;

class ShareManagement extends Model
{
    /**
     * @param $limit
     * @param $offset
     * @param $keyWords
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得分享列表数据
     */
    public function getShareList($limit, $offset, $keyWords)
    {
        $resTB = null;
        $total = 0;
        if ($keyWords == '|ALL|') {
            $resTB = Db::name('list_tc_share')->limit($offset, $limit)->Order('id desc')->select();
            $total = Db::name('list_tc_share')->count();
        } else {
            $where['creator_name'] = array('like', "%" . $keyWords . "%", 'or');
            $resTB = Db::name('list_tc_share')->where($where)->limit($offset, $limit)->Order('id desc')->select();
            $total = Db::name('list_tc_share')->where($where)->count();
        }

        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['create_date'] = $value['create_date'];
            $info['share_url'] = $value['share_url'];
            $info['creator_name'] = $value['creator_name'];
            $testPlanId = $value['test_plan_id'];
            $testModuleId = $value['test_module_id'];
            $res1 = Db::name('test_plan')->where('id', $testPlanId)->find();
            $res2 = Db::name('test_module')->where('id', $testModuleId)->find();
            $info['share_name'] = $res1['test_plan_name'] . "【" . $res2['module_name'] . "】";
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }

    /**
     * @param $testPlanId
     * @param $testModuleId
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 拼接分享名称
     */
    public function getShareName($testPlanId,$testModuleId){
        $res1 = Db::name('test_plan')->where('id', $testPlanId)->find();
        $res2 = Db::name('test_module')->where('id', $testModuleId)->find();
        return  $res1['test_plan_name'] . "【" . $res2['module_name'] . "】";
    }

    /**
     * @param $limit
     * @param $offset
     * @param $testPlanId
     * @param $testModuleId
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 按测试计划id和模块id获得测试用例
     */
    public function getTestCaseList($limit, $offset, $testPlanId,$testModuleId){
        $resTB = Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', $testPlanId)->where('test_module_id', $testModuleId)->limit($offset, $limit)->Order('id asc')->select();
        $total = Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', $testPlanId)->where('test_module_id', $testModuleId)->count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
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
            $info['is_smoke'] = $value['is_smoke'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);

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
     * @param $testPlanId
     * @param $testModuleId
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 导出分享的测试用例
     */
    public function getExcelTCData($testPlanId,$testModuleId)
    {
        return Db::name('list_testcase')->where('status', '<>', 0)->where('test_plan_id', '=', $testPlanId)->where('test_module_id', '=', $testModuleId)->order('id asc')->select();
    }

    /**
     * @param $testPlanId
     * @param $testModuleId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 批量设置用例评审通过
     */
    public function batchReviewPass($testPlanId,$testModuleId){
        $data["status"] = 2;
        $res = Db::name('list_testcase')->where('status','<>' ,4)->where('status','<>' ,5)->where('test_plan_id','=' ,$testPlanId)->where('test_module_id','=' ,$testModuleId)->update($data);
        return $res;
    }
}