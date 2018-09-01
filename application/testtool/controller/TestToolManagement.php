<?php

namespace app\testtool\controller;

use app\testtool\model\TestToolManagement as TTM;
use think\Controller;

class TestToolManagement extends controller
{
    /**
     * @return mixed
     * SnedPay快速查询页面
     */
    public function sendpay()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * 获得SendPay数据
     */
    public function getSendPayData()
    {
        $reqURL = $_GET['reqURL'];
        $html = file_get_contents($reqURL);
        echo $html;
    }

    /**
     * @return mixed
     * host管理页面
     */
    public function hosts()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * host创建页面
     */
    public function create_host_page()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userId', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * host编辑页面
     */
    public function edit_host_page()
    {
        $id = $_GET['id'];
        $this->assign('realName', session('realName'));
        $this->assign('id', $id);
        return $this->fetch();
    }

    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得host对象信息
     */
    public function getHostInfo()
    {
        $id = trim($_POST['id']);
        $testToolMode = new TTM;
        $result = $testToolMode->getHostInfo($id);
        return $result;
    }

    /**
     * 获得host数据
     */
    public function getHostsData()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testToolMode = new TTM;
        echo $testToolMode->getHostsData($limit, $offset);
    }

    /**
     * @return array
     * 创建host
     */
    public function createHostText()
    {
        $data["operator"] = trim($_POST['realName']);
        $data["host_name"] = trim($_POST['hostName']);
        $data["host_text"] = trim($_POST['hostText']);
        $data['operate_time'] = date('Y-m-d H:i:s', time());
        $data['req_times'] = 0;
        $flag = time();
        $data["flag"] = $flag;
        $serverIp = trim($_POST['serverIp']);
        $data['url'] = 'http://' . $serverIp . '/index.php/testtool/test_tool_management/getHostText?flag=' . $flag;
        $testToolMode = new TTM;
        $result = $testToolMode->addHostText($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '新增Host文本成功！'];
        } else {
            return ['status' => 0, 'info' => '新增Host文本失败，请重试！'];
        }
    }

    /**
     * 获得host文本
     */
    public function getHostText()
    {
        $flag = trim($_GET['flag']);
        $testToolMode = new TTM;
        $result = $testToolMode->getHostText($flag);
        echo $result;
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 保存host内容
     */
    public function saveHostText()
    {
        $id = trim($_POST['id']);
        $data["operator"] = trim($_POST['realName']);
        $data["host_name"] = trim($_POST['hostName']);
        $data["host_text"] = trim($_POST['hostText']);
        $data['operate_time'] = date('Y-m-d H:i:s', time());
        $testToolMode = new TTM;
        $result = $testToolMode->saveHostText($id, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑Host文本成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑Host文本失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 物理删除host记录
     */
    public function deleteHost()
    {
        $id = trim($_POST['id']);
        $testToolMode = new TTM;
        $result = $testToolMode->deleteHost($id);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除Host文本成功！'];
        } else {
            return ['status' => 0, 'info' => '删除Host文本失败，请重试！'];
        }
    }
}
