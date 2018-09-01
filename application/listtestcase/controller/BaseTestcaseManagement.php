<?php

namespace app\listtestcase\controller;

use app\listtestcase\model\BaseTestcaseManagement as BTM;
use think\Controller;

class BaseTestcaseManagement extends controller
{
    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 测试用例页面
     */
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        $baseTestCaseModel = new BTM;
        $testPlans = $baseTestCaseModel->getAllTestPlans();
        $this->assign('testPlans', $testPlans);
        $testModules = $baseTestCaseModel->getAllTestModules();
        $this->assign('testModules', $testModules);
        $getTestTypes = $baseTestCaseModel->getAllTestTypes();
        $this->assign('testTypes', $getTestTypes);
        $getTestEnvs = $baseTestCaseModel->getAllTestEnvs();
        $this->assign('testEnvs', $getTestEnvs);
        return $this->fetch();
    }

    /**
     * @return mixed
     * 添加基线用例页面
     */
    public function add_testcase_page()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userId', session('userID'));
        $this->assign('testModuleId', $_GET['testModuleId']);
        return $this->fetch();
    }

    /**
     * @return mixed
     * 编辑基线用例页面
     */
    public function edit_page()
    {
        $tcId = $_GET['tcId'];
        $this->assign('realName', session('realName'));
        $this->assign('userId', session('userID'));
        $this->assign('tcId', $tcId);
        return $this->fetch();
    }

    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得基线用例内容
     */
    public function getBaseTCInfoById()
    {
        $tcId = trim($_POST['tcId']);
        $baseTestCaseModel = new BTM;
        $result = $baseTestCaseModel->getBaseTCInfoById($tcId);
        return $result;
    }

    /**
     *获得测试用例列表数据
     */
    public function getTestcaseList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testModuleId = $_GET['testModuleId'];
        $keys = $_GET['keys'];
        $baseTestCaseModel = new BTM;
        echo $baseTestCaseModel->getTestcaseList($limit, $offset, $testModuleId,$keys);
    }

    /**
     * @return array
     * 创建基线测试用例
     */
    public function createBaseTestCase()
    {
        $data['tc_name'] = trim($_POST['tcName']);
        $data['per_descript'] = trim($_POST['perDescript']);
        $data['step_descript'] = trim($_POST['stepDescript']);
        $data['expect_descript'] = trim($_POST['expectDescript']);
        $data['test_module_id'] = trim($_POST['$testModuleId']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['tag'] = trim($_POST['tag']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $baseTestCaseModel = new BTM;
        $result = $baseTestCaseModel->createBaseTestCase($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '添加基线用例成功！'];
        } else {
            return ['status' => 0, 'info' => '添加基线用例失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 修改基线用例内容
     */
    public function editBaseTestCase()
    {
        $tcId = $_GET['tcId'];

        $data['tc_name'] = trim($_POST['tcName']);
        $data['per_descript'] = trim($_POST['perDescript']);
        $data['step_descript'] = trim($_POST['stepDescript']);
        $data['expect_descript'] = trim($_POST['expectDescript']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['tag'] = trim($_POST['tag']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $baseTestCaseModel = new BTM;
        $result = $baseTestCaseModel->updateBaseTestCase($tcId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑基线用例成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑基线用例失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除基线用例
     */
    public function deleteTesCase()
    {
        $tcId = trim($_POST['tcId']);
        $baseTestCaseModel = new BTM;
        $result = $baseTestCaseModel->deleteTesCase($tcId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除基线用例成功！'];
        } else {
            return ['status' => 0, 'info' => '删除基线用例失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 将基线用例发送到普通用例库
     */
    public function send2TC(){
        $sendTestCaseId = trim($_POST['sendTestCaseId']);
        $testPlanId= trim($_POST['testPlanId']);
        $testModuleId= trim($_POST['testModuleId']);
        $testTypeId= trim($_POST['testTypeId']);
        $testEnvId= trim($_POST['testEnvId']);
        $testLevel= trim($_POST['testLevel']);
        $baseTestCaseModel = new BTM;
        $result = $baseTestCaseModel->send2TC($sendTestCaseId,$testPlanId,$testModuleId,$testTypeId,$testEnvId,$testLevel);
        if ($result == 1) {
            return ['status' => 1, 'info' => '已成功发送到基线库！'];
        } else {
            return ['status' => 0, 'info' => '发送到基线库失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 克隆基线用例
     */
    public function cloneTestCase()
    {
        $tcId = trim($_POST['tcId']);
        $operatorName = trim($_POST['operatorNname']);
        $baseTestCaseModel = new BTM;
        $result = $baseTestCaseModel->cloneTestCase($tcId, $operatorName);
        if ($result == 1) {
            return ['status' => 1, 'info' => '基线用例克隆成功！'];
        } else {
            return ['status' => 0, 'info' => '基线用例克隆失败，请重试！'];
        }
    }

}
