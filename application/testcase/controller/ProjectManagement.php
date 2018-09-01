<?php
namespace app\testcase\controller;
use app\testcase\model\ProjectManagement as PM;
use think\Controller;

class ProjectManagement extends controller
{
    public function index()
    {   $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    	 	return $this->fetch();
    }

    //创建项目页面
    public function create_page()
    {
        $this -> assign('realName', session('realName'));
        return $this->fetch();
    }

    //查看项目备注页面
    public function view_remark_page()
    {
        $prjId = $_GET['prjId'];
        $pm = new PM;
        $this -> assign('remark', $pm->getPrjRemark($prjId));
        return $this->fetch();
    }

    //新建项目
    public function createPrj(){
        $data["creator_name"] = trim($_POST['realName']);
        $data["prj_name"] = trim($_POST['prjName']);
        $data["remark"]= trim($_POST['remark']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;
        $pm = new PM;
        $result = $pm->addProject($data);
        if($result==1){
            return ['status'=>1,'info'=>'新增项目成功！'];
        }else{
            return ['status'=>0,'info'=>'新增项目失败，请重试！'];
        }
    }

    //编辑项目页面
    public function edit_page()
    {
        $prjId = $_GET['prjId'];
        $pm = new PM;
        $prjInfo = $pm->getPrjInfo($prjId);
        $this -> assign('realName', session('realName'));
        $this -> assign('prjId', $prjId);
        $this -> assign('prjName', $prjInfo['prj_name']);
        $this -> assign('remark', $prjInfo['remark']);
        return $this->fetch();
    }


    //编辑项目
    public function editPrj(){
        $prjId = trim($_POST['prjId']);
        $data["prj_name"] = trim($_POST['prjName']);
        $data["remark"]= trim($_POST['remark']);
        $pm = new PM;
        $result = $pm->editProject($prjId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑项目成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑项目失败，请重试！'];
        }
    }

    //删除项目
    public function deletePrj(){
        $prjId = trim($_POST['prjId']);
        $pm = new PM;
        $result = $pm->deleteProject($prjId);
        if($result==1){
            return ['status'=>1,'info'=>'删除项目成功！'];
        }else{
            return ['status'=>0,'info'=>'删除项目失败，请重试！'];
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

    //获得项目
    public function getPrjList(){
        $limit = $_GET['limit'];
        $offset = $_GET['offset']; 
        $pm = new PM;
        echo $pm->getPrjList($limit,$offset);
    }
}
