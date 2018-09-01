<?php
namespace app\note\model;
use think\Model;
use think\Db;
class NoteManagement extends Model
{   
	
	 //获得笔记本名称
     public function getNoteBookNode($userId){
     	$resTB = Db::name('note_book') -> Order('modify_date desc')->where('creator_id','=',$userId)->where('status','=',1) -> select();
     	$result = array();
     	foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['text'] = $value['note_book_name'];
            $info['creatorId'] = $value['creator_id'];
            $info['creatorName'] = $value['creator_name'];
            $info['icon'] = "Hui-iconfont Hui-iconfont-order";
            array_push($result, $info);
        }
        return json_encode($result, true);
     }
     
     //搜索笔记本内容
     public function searchNoteByText($userId,$searchText){
     	$resTB = Db::name('note_book') -> Order('modify_date desc')->where('creator_id','=',$userId)->where('note_content','like','%'.$searchText.'%')->where('status','=',1) -> select();
     	$result = array();
     	foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['text'] = $value['note_book_name'];
            $info['creatorId'] = $value['creator_id'];
            $info['creatorName'] = $value['creator_name'];
            $info['icon'] = "Hui-iconfont Hui-iconfont-order";
            array_push($result, $info);
        }
        return json_encode($result, true);
     }
     
     //获得最后一个笔记节点
     public function getNoteFirstNode($creatorId){
     	$resTB = Db::name('note_book') -> Order('modify_date desc')->where('creator_id','=',$creatorId)->where('status','=',1) ->limit(1) -> select();
        return json_encode($resTB[0], true);
     }
     
     //添加笔记本
    public function addNoteBookName($data){
    	$res = Db::name('note_book')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }
    
    //获得笔记内容
    public function getNoteContent($noteBookId){
    	$resTB = Db::name('note_book') ->where('id','=',$noteBookId) -> find();
        return $resTB['note_content'];  
    }
    
    //修改笔记内容
    public function saveNoteBook($currentNoteBookId,$data){
    	$res = Db::name('note_book')->where('id',$currentNoteBookId)->update($data);
        return $res;
    }
    
    
    //编辑笔记本名称
    public function editNoteBookName($id,$data)
    {
        $res = Db::name('note_book')->where('id',$id)->update($data);
        return $res;
    }
    
    //删除笔记本
    public function deleteNoteBook($id){
        $data["status"] = 0;
        $res = Db::name('note_book')->where('id',$id)->update($data);
        return $res;
    }
}