<?php

namespace app\schedule\model;

use think\Model;
use think\Db;

class HrScheduleManagement extends Model
{

    /**
     * @param $start
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得日程列表数据
     */
    public function getScheduleData($start)
    {
        $resTB = Db::name('schedule')->where('start_time', '>=', $start)->where('status', '=', 1)->select();
        $data = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['title'] = $value['title'];
            $info['start_time'] = $value['start_time'];
            $date1 = $value['end_time'];
            $info['end_time'] = date('Y-m-d', strtotime("$date1 +1 day"));  //日历控件默认显示是减了1天的，这里需加上，保证显示正确。
            $info['color'] = $value['color'];
            $info['creator_id'] = $value['creator_id'];
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            array_push($data, $info);
        }
        return json_encode($data, true);
    }

    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得任务列表数据
     */
    public function getTaskList()
    {
        $resTB = Db::name('test_plan')->where('status', '<>', 0)->where('status', '<>', 2)->where('status', '<>', 5)->field('id,test_plan_name')->order('id desc')->select();
        return json_encode($resTB, true);
    }

    /**
     * @param $taskId
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得任务日期数据
     */
    public function getTaskDate($taskId)
    {
        $resTB = Db::name('test_plan')->where('id', '=', $taskId)->field('start_date,end_date')->order('id desc')->select();
        return json_encode($resTB, true);
    }

    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试人员数据
     */
    public function getTesterList()
    {
        $resTB = Db::name('user')->where('status', '<>', 0)->where('role_id', '=', 1)->field('id,real_name')->order('real_name asc')->select();
        return json_encode($resTB, true);
    }

    /**
     * @param $selectedTesters
     * @param $data
     * @return int
     * 添加任务
     */
    public function addEvent($selectedTesters, $data)
    {

        foreach ($selectedTesters as $value) {
            $temp = $data;
            $temp['runner'] = $value;
            $temp['title'] = '【' . $value . '】' . $data['title'];
            Db::name('schedule')->insert($temp);
        }
        return 1;
    }

    /**
     * @param $eventId
     * @param $data
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 编辑任务信息
     */
    public function editEvent($eventId, $data)
    {
        $res = Db::name('schedule')->where('id', $eventId)->update($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $id
     * @param $data
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 重新保存任务信息
     */
    public function reSaveEvent($id, $data)
    {
        $res = Db::name('schedule')->where('id', $id)->update($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $eventId
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除任务
     */
    public function delEvent($eventId)
    {
        $data["status"] = 0;
        $res = Db::name('schedule')->where('id', $eventId)->update($data);
        if ($res) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得测试人员表格数据
     */
    public function getTesters()
    {
        $resTB = Db::name('user')->where('status', '<>', 0)->where('role_id', '=', 1)->field('id,real_name')->order('real_name asc')->select();
        return json_encode($resTB, true);
    }

    /**
     * @param $start
     * @param $whereStr
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 按测试人员获得排期任务数据
     */
    public function getScheduleDataByTester($start, $whereStr)
    {
        $map['runner'] = array('in', $whereStr);
        $resTB = Db::name('schedule')->where($map)->where('start_time', '>=', $start)->where('status', '=', 1)->select();
        $data = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['title'] = $value['title'];
            $info['start_time'] = $value['start_time'];
            $date1 = $value['end_time'];
            $info['end_time'] = date('Y-m-d', strtotime("$date1 +1 day"));  //日历控件默认显示是减了1天的，这里需加上，保证显示正确。
            $info['color'] = $value['color'];
            $info['creator_id'] = $value['creator_id'];
            $info['creator_name'] = $value['creator_name'];
            $info['status'] = $value['status'];
            array_push($data, $info);
        }
        return json_encode($data, true);
    }

}