<?php

namespace app\testcase\model;

use think\Model;
use think\Db;

class ShareManagement extends Model
{
    /**
     * @param $limit
     * @param $offset
     * @param $type
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得分享列表
     */
    public function getShareList($limit, $offset,$keyWords)
    {
        $resTB = null;
        $total = 0;
        if ($keyWords == '|ALL|') {
            $resTB = Db::name('tc_share')->limit($offset, $limit)->Order('id desc')->select();
            $total = Db::name('tc_share')->count();
        }  else {
            $where['type|creator_name']=array('like',"%".$keyWords."%",'or');
            $resTB = Db::name('tc_share')->where($where)->limit($offset, $limit)->Order('id desc')->select();
            $total = Db::name('tc_share')->where($where)->count();
        }

        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['type'] = $value['type'];
            $info['create_date'] = $value['create_date'];
            $info['share_url'] = $value['share_url'];
            $info['creator_name'] = $value['creator_name'];
            $nodeId = $value['node_id'];
            $res = Db::name('node')->where('id', $nodeId)->find();
            $info['node_name'] = $res['node_name'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);
    }

    /**
     * @param $nodeId
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得节点名称
     */
    public function getNodeName($nodeId)
    {
        $resNodeTB = Db::name('node')->where('id', '=', $nodeId)->find();
        $nodenName = $resNodeTB['node_name'];
    	$prjId = $resNodeTB['prj_id'];
        $resPrjTB = Db::name('project')->where('id', '=', $prjId)->find();
        $prjName = $resPrjTB['prj_name'];
        return $prjName.'→'.$nodenName;
    }

    /**
     * @param $nodeId
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得Flow数据
     */
    public function getFlowData($nodeId)
    {
        $resTB = Db::name('flow')->where('node_id', '=', $nodeId)->find();
        return $resTB['json'];
    }


    /**
     * @param $tcId
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得用例信息
     */
    public function getTestCaseInfo($tcId)
    {
        $res = Db::name('testcase')->where('id', '=', $tcId)->find();
        $data['tc_name'] = $res['tc_name'];
        $data['per_descript'] = $res['per_descript'];
        $data['step_descript'] = $res['step_descript'];
        $data['expect_descript'] = $res['expect_descript'];
        $data['data_descript'] = $res['data_descript'];
        $data['test_result'] = $res['test_result'];
        return json_encode($data, true);
    }
}