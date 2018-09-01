<?php

namespace app\schedule\controller;

use think\Controller;
use app\schedule\model\PersonScheduleManagement as PSM;

class PersonScheduleManagement extends Controller
{
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    //获得排期数据
    public function getScheduleData()
    {
        //获得查询范围
        $start = $_POST['start'];
        $creatorId = $_POST['creatorId'];
        $psm = new PSM;
        echo $psm->getScheduleData($start, $creatorId);
    }

    //重新保存排期数据
    public function reSaveEvent()
    {
        $id = $_POST['id'];
        $data['start_time'] = $_POST['start'];
        $data['end_time'] = $_POST['end'];
        $psm = new PSM;
        $result = $psm->reSaveEvent($id, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '更新排期成功！'];
        } else {
            return ['status' => 0, 'info' => '更新排期失败，请重试！'];
        }
    }

    //添加排期数据
    public function addEvent()
    {
        $data['title'] = $_POST['taskName'];
        $data['start_time'] = $_POST['startDate'];
        $data['end_time'] = $_POST['endDate'];
        $data['color'] = $_POST['color'];
        $data['creator_id'] = $_POST['creatorId'];
        $data['creator_name'] = $_POST['creatorName'];
        $data['create_date'] = date('Y-m-d H:i:s', time());
        $data['status'] = 1;
        $psm = new PSM;
        $result = $psm->addEvent($data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '新增个人排期成功！'];
        } else {
            return ['status' => 0, 'info' => '新增个人排期失败，请重试！'];
        }
    }

    //编辑排期数据
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
        $psm = new PSM;
        $result = $psm->editEvent($eventId, $data);
        if ($result == 1) {
            return ['status' => 1, 'info' => '编辑个人排期成功！'];
        } else {
            return ['status' => 0, 'info' => '编辑个人排期失败，请重试！'];
        }
    }


    //删除排期数据
    public function delEvent()
    {
        $eventId = trim($_POST['id']);
        $psm = new PSM;
        $result = $psm->delEvent($eventId);
        if ($result == 1) {
            return ['status' => 1, 'info' => '删除排期项成功！'];
        } else {
            return ['status' => 0, 'info' => '删除排期项失败，请重试！'];
        }
    }

}
