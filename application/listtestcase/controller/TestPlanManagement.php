<?php
namespace app\listtestcase\controller;
use app\listtestcase\model\TestPlanManagement as TPM;
use think\Controller;

class TestPlanManagement extends controller
{
    /**
     * @return mixed
     * 测试计划页面
     */
    public function index()
    {   $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * 创建测试计划页面
     */
    public function create_page()
    {
        $this -> assign('realName', session('realName'));
        $this -> assign('userId', session('userID'));
        $testPlanMode = new TPM;
        $testPOs = $testPlanMode->getAllTestPOs();
        $this->assign('testPOs', $testPOs);
        return $this->fetch();
    }



    /**
     * @return array
     * 创建测试计划
     */
    public function createTestPlan(){
        $data["creator_name"] = trim($_POST['realName']);
        $data["test_po"] = trim($_POST['testPO']);
        $data["test_plan_name"] = trim($_POST['testPlanName']);
        $data["start_date"]= trim($_POST['startDate']);
        $data["end_date"]= trim($_POST['endDate']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = trim($_POST['status']);
        $testPlanMode = new TPM;
        $result = $testPlanMode->addTestPlan($data);
        if($result==1){
            return ['status'=>1,'info'=>'新增测试计划成功！'];
        }else{
            return ['status'=>0,'info'=>'新增测试计划失败，请重试！'];
        }
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 编辑测试计划页面
     */
    public function edit_page()
    {
        $testPlanId = $_GET['testPlanId'];
        $testPlanMode = new TPM;
        $prjInfo = $testPlanMode->getTestPlanInfo($testPlanId);
        $this -> assign('testPlanId', $testPlanId);
        $this -> assign('testPO', $prjInfo['test_po']);
        $this -> assign('testPlanName', $prjInfo['test_plan_name']);
        $this -> assign('startDate', $prjInfo['start_date']);
        $this -> assign('endDate', $prjInfo['end_date']);
        $this -> assign('status', $prjInfo['status']);
        $testPlanMode = new TPM;
        $testPOs = $testPlanMode->getAllTestPOs();
        $this->assign('testPOs', $testPOs);
        return $this->fetch();
    }


    //编辑项目
    public function editTestPlan(){
        $testPlanId = trim($_POST['testPlanId']);
        $data["test_plan_name"] = trim($_POST['testPlanName']);
        $data["test_po"] = trim($_POST['testPO']);
        $data["start_date"]= trim($_POST['startDate']);
        $data["end_date"]= trim($_POST['endDate']);
        $data['status'] = trim($_POST['status']);
        $testPlanMode = new TPM;
        $result = $testPlanMode->editTestPlan($testPlanId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑测试计划成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑测试计划失败，请重试！'];
        }
    }

    //删除项目
    public function deleteTestPlan(){
        $testPlanId = trim($_POST['testPlanId']);
        $testPlanMode = new TPM;
        $result = $testPlanMode->deleteTestPlan($testPlanId);
        if($result==1){
            return ['status'=>1,'info'=>'删除测试计划成功！'];
        }else{
            return ['status'=>0,'info'=>'删除测试计划失败，请重试！'];
        }
    }

    //设置状态
    public function setStatus(){
        $prjId = trim($_POST['prjId']);
        $status= trim($_POST['status']);
        $pm = new PM;
        $result = $pm->setStatus($prjId,$status);
        if($result==1){
            return ['status'=>1,'info'=>'切换项目状态成功！'];
        }else{
            return ['status'=>0,'info'=>'切换项目状态失败，请重试！'];
        }
    }

    /**
     * 获得测试计划列表数据
     */
    public function getTestPlanList(){
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $keys = $_GET['keys'];
        $statusId = $_GET['statusId'];

        $testPlanMode = new TPM;
        echo $testPlanMode->getTestPlanList($limit,$offset,$keys,$statusId);
    }
}
