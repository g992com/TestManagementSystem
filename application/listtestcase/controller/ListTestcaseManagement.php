<?php

namespace app\listtestcase\controller;

use app\listtestcase\model\ListTestcaseManagement as LTM;
use think\Loader;
use think\Controller;


class ListTestcaseManagement extends controller
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
        $listTestcaseModel = new LTM;
        $testPlans = $listTestcaseModel->getAllTestPlans();
        $this->assign('testPlans', $testPlans);
        $getTestModules = $listTestcaseModel->getAllTestModules();
        $this->assign('testModules', $getTestModules);
        $getTestTypes = $listTestcaseModel->getAllTestTypes();
        $this->assign('testTypes', $getTestTypes);
        $getTestEnvs = $listTestcaseModel->getAllTestEnvs();
        $this->assign('testEnvs', $getTestEnvs);
        return $this->fetch();
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 测试用例添加页面
     */
    public function add_testcase_page()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userId', session('userID'));
        $listTestcaseModel = new LTM;
        $getTestModules = $listTestcaseModel->getAllTestModules();
        $this->assign('testModules', $getTestModules);
        $getTestTypes = $listTestcaseModel->getAllTestTypes();
        $this->assign('testTypes', $getTestTypes);
        $getTestEnvs = $listTestcaseModel->getAllTestEnvs();
        $this->assign('testEnvs', $getTestEnvs);
        $this->assign('testPlanId', $_GET['testPlanId']);
        return $this->fetch();
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 分享对话框
     */
    public function share_testcase_page()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userId', session('userID'));
        $listTestCaseModel = new LTM;
        $testPlans = $listTestCaseModel->getAllTestPlans();
        $this->assign('testPlans', $testPlans);
        $getTestModules = $listTestCaseModel->getAllTestModules();
        $this->assign('testModules', $getTestModules);
        $this->assign('testPlanId', $_GET['testPlanId']);
        return $this->fetch();
    }

    /**
     * @return array
     * 生成分享链接
     */
    public function addShareTCInfo(){
        $data['test_plan_id'] = trim($_POST['testPlanId']);
        $data['test_module_id'] = trim($_POST['testModuleId']);
        $data['share_url'] = trim($_POST['shareURL']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $listTestCaseModel = new LTM;
        $result = $listTestCaseModel->createShareTCInfo($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '生成分享链接成功！'];
        } else {
            return ['status' => 0, 'info' => '生成分享链接失败，请重试！'];
        }
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 编辑测试用例页面
     */
    public function edit_page()
    {
        $tcId = $_GET['tcId'];
        $listTestcaseModel = new LTM;
        $getTestModules = $listTestcaseModel->getAllTestModules();
        $this->assign('testModules', $getTestModules);
        $getTestTypes = $listTestcaseModel->getAllTestTypes();
        $this->assign('testTypes', $getTestTypes);
        $getTestEnvs = $listTestcaseModel->getAllTestEnvs();
        $this->assign('testEnvs', $getTestEnvs);
        $this->assign('realName', session('realName'));
        $this->assign('userId', session('userID'));
        $this->assign('tcId', $tcId);
        $tcInfo = $listTestcaseModel->getTestCaseInfo($tcId);
        $this->assign('tcName', $tcInfo['tc_name']);
        $this->assign('tag', $tcInfo['tag']);
        $this->assign('testModuleId', $tcInfo['test_module_id']);
        $this->assign('testTypeId', $tcInfo['test_type_id']);
        $this->assign('testEnvId', $tcInfo['test_env_id']);
        $this->assign('tcLevel', $tcInfo['tc_level']);
        $this->assign('status', $tcInfo['status']);
        $this->assign('isSmoke', $tcInfo['is_smoke']);
        return $this->fetch();
    }

    /**
     *获得测试用例列表数据
     */
    public function getTestcaseList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testPlanId = $_GET['testPlanId'];
        $keys = $_GET['keys'];
        $listTestcaseModel = new LTM;
        echo $listTestcaseModel->getTestcaseList($limit, $offset, $testPlanId,$keys);
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 高级查询测试用例
     */
    public function advSearchTC(){
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testPlanId = $_GET['testPlanId'];
        $testModuleId = $_GET['testModuleId'];
        $testTypeId = $_GET['testTypeId'];
        $testEnvId = $_GET['testEnvId'];
        $listTestCaseModel = new LTM;
        echo $listTestCaseModel->advSearchTC($limit, $offset, $testPlanId,$testModuleId,$testTypeId,$testEnvId);
    }

    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过id获得用例信息
     */
    public function getTCInfoById()
    {
        $tcId = trim($_POST['tcId']);
        $listTestCaseModel = new LTM;
        $result = $listTestCaseModel->getTCInfoById($tcId);
        return $result;
    }

    /**
     * @return array
     *新建测试用例
     */
    public function createListTestCase()
    {
        $data['test_module_id'] = trim($_POST['testModuleId']);
        $data['test_type_id'] = trim($_POST['testTypeId']);
        $data['test_env_id'] = trim($_POST['testEnvId']);
        $data['tc_name'] = trim($_POST['tcName']);
        $data['per_descript'] = trim($_POST['perDescript']);
        $data['step_descript'] = trim($_POST['stepDescript']);
        $data['expect_descript'] = trim($_POST['expectDescript']);
        $data['test_plan_id'] = trim($_POST['testPlanId']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['tc_level'] = trim($_POST['testLevel']);
        $data['tag'] = trim($_POST['tag']);
        $data['is_smoke'] = trim($_POST['isSmoke']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $listTestcaseModel = new LTM;
        $result = $listTestcaseModel->createListTestCase($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '添加测试用例成功！'];
        } else {
            return ['status' => 0, 'info' => '添加测试用例失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 编辑测试用例内容
     */
    public function editListTestCase()
    {
        $tcId = $_GET['tcId'];
        $data['test_module_id'] = trim($_POST['testModuleId']);
        $data['test_type_id'] = trim($_POST['testTypeId']);
        $data['test_env_id'] = trim($_POST['testEnvId']);
        $data['tc_name'] = trim($_POST['tcName']);
        $data['per_descript'] = trim($_POST['perDescript']);
        $data['step_descript'] = trim($_POST['stepDescript']);
        $data['expect_descript'] = trim($_POST['expectDescript']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['tc_level'] = trim($_POST['testLevel']);
        $data['tag'] = trim($_POST['tag']);
        $data['is_smoke'] = trim($_POST['isSmoke']);
        $listTestcaseModel = new LTM;
        $result = $listTestcaseModel->updateListTestCase($tcId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑测试用例成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑测试用例失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除测试用例
     */
    public function deleteTesCase()
    {
        $tcId = trim($_POST['tcId']);
        $listTestcaseModel = new LTM;
        $result = $listTestcaseModel->deleteTesCase($tcId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除测试用例成功！'];
        } else {
            return ['status' => 0, 'info' => '删除测试用例失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 修改测试用例状态
     */
    public function modifyStatus()
    {
        $tcId = trim($_POST['tcId']);
        $status = trim($_POST['status']);
        $listTestCaseModel = new LTM;
        $result = $listTestCaseModel->modifyStatus($tcId, $status);
        if ($result == 1) {
            return ['status' => 1, 'info' => '测试用例状态修改成功！'];
        } else {
            return ['status' => 0, 'info' => '测试用例状态修改失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 执行测试用例
     */
    public function runTC()
    {
        $tcId = trim($_POST['tcId']);
        $status = trim($_POST['status']);
        $operatorName = trim($_POST['operatorNname']);
        $listTestCaseModel = new LTM;
        $result = $listTestCaseModel->runTC($tcId, $status, $operatorName);
        if ($result == 1) {
            return ['status' => 1, 'info' => '测试用例状态修改成功！'];
        } else {
            return ['status' => 0, 'info' => '测试用例状态修改失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 克隆测试用例
     */
    public function cloneTestCase()
    {
        $tcId = trim($_POST['tcId']);
        $operatorName = trim($_POST['operatorNname']);
        $listTestCaseModel = new LTM;
        $result = $listTestCaseModel->cloneTestCase($tcId, $operatorName);
        if ($result == 1) {
            return ['status' => 1, 'info' => '测试用例克隆成功！'];
        } else {
            return ['status' => 0, 'info' => '测试用例克隆失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 发送用例到基线库
     */
    public function send2BaseTC(){
        $sendTestCaseId = trim($_POST['sendTestCaseId']);
        $testModuleId= trim($_POST['testModuleId']);
        $listTestCaseModel = new LTM;
        $result = $listTestCaseModel->send2BaseTC($sendTestCaseId,$testModuleId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '已成功发送到基线库！'];
        } else {
            return ['status' => 0, 'info' => '发送到基线库失败，请重试！'];
        }
    }


    /**
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 导出测试用例
     */
    public function exportListTestCase()
    {
        $testPlanId = $_GET['testPlanId'];
        $listTestCaseModel = new LTM;
        $data = $listTestCaseModel->getExcelTCData($testPlanId);

        Loader::import('PHPExcel.Classes.PHPExcel');
        Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
        $PHPExcel = new \PHPExcel();
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("export_tc"); //给当前活动sheet设置名称
        //设置单元格样式
        $PHPSheet->getColumnDimension( 'B')->setWidth(60);
        $PHPSheet->getColumnDimension( 'C')->setWidth(40);
        $PHPSheet->getColumnDimension( 'D')->setWidth(40);
        $PHPSheet->getColumnDimension( 'E')->setWidth(40);
        $PHPSheet->getColumnDimension( 'F')->setWidth(10);
        $PHPSheet->getColumnDimension( 'G')->setWidth(20);

        $PHPSheet->getStyle('B:E')->getAlignment()->setWrapText(true);
        $PHPSheet->getStyle('A1:G1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $PHPSheet->getRowDimension(1)->setRowHeight(35);

        $PHPSheet->setCellValue("A1","ID")->setCellValue("B1","测试用例标题")->setCellValue("C1","前置条件")->setCellValue("D1","操作步骤")->setCellValue("E1","预期结果")->setCellValue("F1","创建人")->setCellValue("G1","创建时间");//表格数据
        $index = 2;
        foreach($data as $row){
            $PHPSheet->setCellValue("A".$index,$row['id'])->setCellValue("B".$index,$row['tc_name'])->setCellValue("C".$index,$row['per_descript'])->setCellValue("D".$index,$row['step_descript'])->setCellValue("E".$index,$row['expect_descript'])->setCellValue("F".$index,$row['creator_name'])->setCellValue("G".$index,$row['create_date']);//表格数据
            $index++;
        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
        header('Content-Disposition: attachment;filename="export_tc.xlsx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成文件
    }
}
