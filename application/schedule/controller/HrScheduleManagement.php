<?php

namespace app\schedule\controller;

use think\Controller;
use app\schedule\model\HrScheduleManagement as HSM;

class HrScheduleManagement extends Controller
{
    /**
     * @return mixed
     * 人资排期页面
     */
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * 获得排期数据
     */
    public function getScheduleData()
    {
        $start = $_POST['start'];
        $getRange = $_POST['getRange'];
        $hrScheduleModel = new HSM;
        if ($getRange == 'All') {
            echo $hrScheduleModel->getScheduleData($start);
        } else {
            $memberName = '';
            foreach ($getRange as $value) {
                $memberName = $value['real_name'] . ',' . $memberName;
            }
            $whereStr = substr($memberName, 0, strlen($memberName) - 1);
            echo $hrScheduleModel->getScheduleDataByTester($start, $whereStr);
        }
    }

    /**
     * 获得计划任务数据
     */
    public function getTaskList()
    {
        $hrScheduleModel = new HSM;
        echo $hrScheduleModel->getTaskList();
    }

    public function getTaskDate()
    {
        $taskId = $_POST['taskId'];
        $hrScheduleModel = new HSM;
        echo $hrScheduleModel->getTaskDate($taskId);
    }

    /**
     * 获得测试人员数据
     */
    public function getTesterList()
    {
        $hrScheduleModel = new HSM;
        echo $hrScheduleModel->getTesterList();
    }

    public function getTesters()
    {
        $hrScheduleModel = new HSM;
        echo $hrScheduleModel->getTesters();

    }

    /**
     * @return array
     * 添加任务
     */
    public function addEvent()
    {
        $data['test_plan_id'] = $_POST['planId'];
        $data['title'] = $_POST['taskName'];
        $data['start_time'] = $_POST['startDate'];
        $data['end_time'] = $_POST['endDate'];
        $data['color'] = $_POST['color'];
        $data['creator_id'] = $_POST['creatorId'];
        $data['creator_name'] = $_POST['creatorName'];
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $selectedTesters = $_POST['selectTester'];
        $hrScheduleModel = new HSM;
        $result = $hrScheduleModel->addEvent($selectedTesters, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '新增人资排期成功！'];
        } else {
            return ['status' => 0, 'info' => '新增人资排期失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 编辑任务
     */
    public function editEvent()
    {
        $eventId = $_POST['id'];
        $data['title'] = $_POST['taskName'];
        $data['start_time'] = $_POST['startDate'];
        $data['end_time'] = $_POST['endDate'];
        $data['color'] = $_POST['color'];
        $data['creator_name'] = $_POST['creator'];
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $hrScheduleModel = new HSM;
        $result = $hrScheduleModel->editEvent($eventId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑任务成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑任务失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 重新保存任务数据
     */
    public function reSaveEvent()
    {
        $id = $_POST['id'];
        $data['start_time'] = $_POST['start'];
        $data['end_time'] = $_POST['end'];
        $hrScheduleModel = new HSM;
        $result = $hrScheduleModel->reSaveEvent($id, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '更新任务成功！'];
        } else {
            return ['status' => 0, 'info' => '更新任务失败，请重试！'];
        }
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除任务
     */
    public function delEvent()
    {
        $eventId = trim($_POST['id']);
        $hrScheduleModel = new HSM;
        $result = $hrScheduleModel->delEvent($eventId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除排期项成功！'];
        } else {
            return ['status' => 0, 'info' => '删除排期项失败，请重试！'];
        }
    }
}
