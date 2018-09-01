<?php

namespace app\datadictionary\controller;

use app\datadictionary\model\TestEnvManagement as TEM;
use think\Controller;

class TestEnvManagement extends controller
{
    /**
     * @return mixed
     * 测试环境管理页面
     */
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * 创建测试环境页面
     */
    public function create_page()
    {
        $this->assign('realName', session('realName'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 查看测试环境备注页面
     */
    public function view_remark_page()
    {
        $envId = $_GET['envId'];
        $testEnvMode = new TEM;
        $this->assign('remark', $testEnvMode->getEnvRemark($envId));
        return $this->fetch();
    }

    /**
     * @return array
     * 新建测试测试环境
     */
    public function createEnv()
    {
        $data["creator_name"] = trim($_POST['realName']);
        $data["env_name"] = trim($_POST['envName']);
        $data["remark"] = trim($_POST['remark']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $testEnvMode = new TEM;
        $result = $testEnvMode->addEnv($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '新增测试环境成功！'];
        } else {
            return ['status' => 0, 'info' => '新增测试环境失败，请重试！'];
        }
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 编辑测试环境页面
     */
    public function edit_page()
    {
        $envId = $_GET['envId'];
        $testEnvMode = new TEM;
        $moduleInfo = $testEnvMode->getEnvInfo($envId);
        $this->assign('realName', session('realName'));
        $this->assign('envId', $envId);
        $this->assign('envName', $moduleInfo['env_name']);
        $this->assign('remark', $moduleInfo['remark']);
        return $this->fetch();
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新测试环境信息
     */
    public function editEnv()
    {
        $envId = trim($_POST['envId']);
        $data["env_name"] = trim($_POST['envName']);
        $data["remark"] = trim($_POST['remark']);
        $testEnvMode = new TEM;
        $result = $testEnvMode->editEnv($envId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑测试环境成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑测试环境失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除测试环境
     */
    public function deleteEnv()
    {
        $envId = trim($_POST['envId']);
        $testEnvMode = new TEM;
        $result = $testEnvMode->deleteEnv($envId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除测试环境成功！'];
        } else {
            return ['status' => 0, 'info' => '删除测试环境失败，请重试！'];
        }
    }


    /**
     * 获得测试环境
     */
    public function getEnvList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testEnvMode = new TEM;
        echo $testEnvMode->getEnvList($limit, $offset);
    }
}
