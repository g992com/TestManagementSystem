<?php
namespace app\testcase\controller;
use app\testcase\model\NodeManagement as NM;
use think\Controller;

class NodeManagement extends controller
{
    //节点管理页面
    public function index()
    {   
        $nm = new NM;
        $this -> assign('prjLst', $nm->getAllPrj());
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    		return $this->fetch();
    }

    //获得项目下的所有节点
    public function getPrjNode(){
        $prjId = trim($_POST['prjId']);
        $nm = new NM;
        $result = $nm->getPrjNode($prjId);
        return $result;
    }

    //获得节点信息
    public function getNodeInfo(){
        $nodeId = trim($_POST['nodeId']);
        $nm = new NM;
        $result = $nm->getNodeInfo($nodeId);
        return $result;
    }

    //创建节点
    public function addPrjNode(){
        $data['prj_id'] = trim($_POST['prjId']);
        $data['node_name'] = trim($_POST['nodeName']);
        $data['remark'] = trim($_POST['remark']);
        $data['creator_name'] = trim($_POST['creator']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;
        $nm = new NM;
        $result = $nm->addPrjNode($data);
        if($result==1){
            return ['status'=>1,'info'=>'新增节点成功！'];
        }else{
            return ['status'=>0,'info'=>'新增节点失败，请重试！'];
        }
    }

    //修改节点
    public function  savePrjNode(){
        $nodeId = trim($_POST['nodeId']);
        $data['node_name'] = trim($_POST['nodeName']);
        $data['remark'] = trim($_POST['remark']);
        $nm = new NM;
        $result = $nm->savePrjNode($nodeId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑节点成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑节点失败，请重试！'];
        }
    }

    //删除节点
    public function deletePrjNode(){
        $nodeId = trim($_POST['id']);
        $nm = new NM;
        $result = $nm->deletePrjNode($nodeId);
        if($result==1){
            return ['status'=>1,'info'=>'删除节点成功！'];
        }else{
            return ['status'=>0,'info'=>'删除节点失败，请重试！'];
        }
    }

}
