<?php

namespace app\datadictionary\controller;

use app\datadictionary\model\TestModuleManagement as TMM;
use think\Controller;

class TestModuleManagement extends controller
{
    /**
     * @return mixed
     * 模块管理页面
     */
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * 创建模块页面
     */
    public function create_page()
    {
        $this->assign('realName', session('realName'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * 查看模块备注页面
     */
    public function view_remark_page()
    {
        $moduleId = $_GET['moduleId'];
        $testModuleMode = new TMM;
        $this->assign('remark', $testModuleMode->getModuleRemark($moduleId));
        return $this->fetch();
    }

    /**
     * @return array
     * 新建测试模块
     */
    public function createModule()
    {
        $data["creator_name"] = trim($_POST['realName']);
        $data["module_name"] = trim($_POST['moduleName']);
        $data["remark"] = trim($_POST['remark']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $testModuleMode = new TMM;
        $result = $testModuleMode->addModule($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '新增模块成功！'];
        } else {
            return ['status' => 0, 'info' => '新增模块失败，请重试！'];
        }
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 编辑模块页面
     */
    public function edit_page()
    {
        $moduleId = $_GET['moduleId'];
        $testModuleMode = new TMM;
        $moduleInfo = $testModuleMode->getModuleInfo($moduleId);
        $this->assign('realName', session('realName'));
        $this->assign('moduleId', $moduleId);
        $this->assign('moduleName', $moduleInfo['module_name']);
        $this->assign('remark', $moduleInfo['remark']);
        return $this->fetch();
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新模块信息
     */
    public function editModule()
    {
        $moduleId = trim($_POST['moduleId']);
        $data["module_name"] = trim($_POST['moduleName']);
        $data["remark"] = trim($_POST['remark']);
        $testModuleMode = new TMM;
        $result = $testModuleMode->editModule($moduleId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑模块成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑模块失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除模块
     */
    public function deleteModule()
    {
        $moduleId = trim($_POST['moduleId']);
        $testModuleMode = new TMM;
        $result = $testModuleMode->deleteModule($moduleId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除模块成功！'];
        } else {
            return ['status' => 0, 'info' => '删除模块失败，请重试！'];
        }
    }


    /**
     * 获得模块
     */
    public function getModuleList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testModuleMode = new TMM;
        echo $testModuleMode->getModuleList($limit, $offset);
    }
}
