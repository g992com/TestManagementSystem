<?php

namespace app\datadictionary\controller;

use app\datadictionary\model\TestTypeManagement as TTM;
use think\Controller;

class TestTypeManagement extends controller
{
    /**
     * @return mixed
     * 类型管理页面
     */
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * 创建类型页面
     */
    public function create_page()
    {
        $this->assign('realName', session('realName'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * 查看类型备注页面
     */
    public function view_remark_page()
    {
        $typeId = $_GET['typeId'];
        $testTypeMode = new TTM;
        $this->assign('remark', $testTypeMode->getTypeRemark($typeId));
        return $this->fetch();
    }

    /**
     * @return array
     * 新建测试类型
     */
    public function createType()
    {
        $data["creator_name"] = trim($_POST['realName']);
        $data["type_name"] = trim($_POST['typeName']);
        $data["remark"] = trim($_POST['remark']);
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $testTypeMode = new TTM;
        $result = $testTypeMode->addType($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '新增类型成功！'];
        } else {
            return ['status' => 0, 'info' => '新增类型失败，请重试！'];
        }
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 编辑类型页面
     */
    public function edit_page()
    {
        $typeId = $_GET['typeId'];
        $testTypeMode = new TTM;
        $moduleInfo = $testTypeMode->getTypeInfo($typeId);
        $this->assign('realName', session('realName'));
        $this->assign('typeId', $typeId);
        $this->assign('typeName', $moduleInfo['type_name']);
        $this->assign('remark', $moduleInfo['remark']);
        return $this->fetch();
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新类型信息
     */
    public function editType()
    {
        $typeId = trim($_POST['typeId']);
        $data["type_name"] = trim($_POST['typeName']);
        $data["remark"] = trim($_POST['remark']);
        $testTypeMode = new TTM;
        $result = $testTypeMode->editType($typeId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑类型成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑类型失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除类型
     */
    public function deleteType()
    {
        $typeId = trim($_POST['typeId']);
        $testTypeMode = new TTM;
        $result = $testTypeMode->deleteType($typeId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除类型成功！'];
        } else {
            return ['status' => 0, 'info' => '删除类型失败，请重试！'];
        }
    }


    /**
     * 获得类型
     */
    public function getTypeList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testTypeMode = new TTM;
        echo $testTypeMode->getTypeList($limit, $offset);
    }
}
