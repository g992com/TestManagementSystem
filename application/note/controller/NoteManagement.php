<?php
namespace app\note\controller;
use app\note\model\NoteManagement as NM;
use think\Controller;

class NoteManagement extends controller
{
 
    public function index()
    {   
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    	return $this->fetch();
    }
    
    //获得笔记列表
    public function getNoteBookNode(){
    	$userId = trim($_POST['userId']);
        $nm = new NM;
        $result = $nm->getNoteBookNode($userId);
        return $result;
    }
    
    //获得最新节点
    public function getNoteFirstNode(){
    	$creatorId = trim($_POST['creatorId']);
    	$nm = new NM;
        $result = $nm->getNoteFirstNode($creatorId);
        return ['status'=>1,'info'=>$result];
    }
    
    //获得笔记文本内容
    public function getNoteContent(){
    	$noteBookId = trim($_POST['noteBookId']);
    	$nm = new NM;
        $result = $nm->getNoteContent($noteBookId);
        return $result;
    }
    
    //修改笔记内容
    public function saveNoteBook(){
    	$currentNoteBookId = trim($_POST['currentNoteBookId']);
    	$data['note_book_name']  = trim($_POST['noteTile']);
    	$data['note_content']  = $_POST['noeteContent'];
    	$data['modify_date'] = date('Y-m-d H:i:s',time());
    	$nm = new NM;
        $result = $nm->saveNoteBook($currentNoteBookId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'保存笔记成功！'];
        }else{
            return ['status'=>0,'info'=>'保存笔记失败，请重试！'];
        }
    }
    
    

    //添加笔记本名称
    public function addNoteBookName(){
    	$data['note_book_name'] = trim($_POST['noteBookName']);
        $data['creator_name'] = trim($_POST['creatorName']);
        $data['creator_id'] = trim($_POST['creatorId']);
        $data['create_date'] = date('Y-m-d H:i:s',time());
        $data['modify_date'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;
        $nm = new NM;
        $result = $nm->addNoteBookName($data);
        if($result==1){
            return ['status'=>1,'info'=>'新增笔记本成功！'];
        }else{
            return ['status'=>0,'info'=>'新增笔记本失败，请重试！'];
        }
    }
    
     //修改笔记本名称
    public function  editNoteBookName(){
        $noteBookId = trim($_POST['noteBookId']);
        $data['note_book_name'] = trim($_POST['noteBookName']);
       	$nm = new NM;
        $result = $nm->editNoteBookName($noteBookId,$data);
        if($result==1){
            return ['status'=>1,'info'=>'编辑笔记本名称成功！'];
        }else{
            return ['status'=>0,'info'=>'编辑笔记本名称失败，请重试！'];
        }
    }
    
    //删除笔记本名称
    public function deleteNoteBook(){
        $noteBookId = trim($_POST['id']);
        $nm = new NM;
        $result = $nm->deleteNoteBook($noteBookId);
        if($result==1){
            return ['status'=>1,'info'=>'删除笔记本成功！'];
        }else{
            return ['status'=>0,'info'=>'删除笔记本失败，请重试！'];
        }
    }
    
    //搜索笔记本内容
    public function searchNoteByText(){
    	$userId = trim($_POST['userId']);
    	$searchText = trim($_POST['searchText']);
    	$nm = new NM;
        $result = $nm->searchNoteByText($userId,$searchText);
        return $result;
    }
    

}
