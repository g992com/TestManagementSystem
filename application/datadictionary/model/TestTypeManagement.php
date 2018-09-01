<?php
namespace app\datadictionary\model;
use think\Model;
use think\Db;
class TestTypeManagement extends Model
{
    /**
     * @param $data
     * @return int
     * 添加类型
     */
    public function addType($data){
    	$res = Db::name('test_type')-> insert($data);
    	if($res){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    /**
     * @param $prjId
     * @param $data
     * @return int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 更新类型信息
     */
    public function editType($typeId,$data)
    {
        $res = Db::name('test_type')->where('id',$typeId)->update($data);
        if($res){
    			return 1;
    		}else{
    			return 0;
    		}
    }

    /**
     * @param $prjId
     * @return array|false|\PDOStatement|string|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得类型信息
     */
    public function getTypeInfo($typeId){
        $res = Db::name('test_type')->where('id',$typeId)->find();
        return $res;
    }

    /**
     * @param $typeId
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 删除类型
     */
    public function deleteType($typeId){
        $data["status"] = 0;
        $res = Db::name('test_type')->where('id',$typeId)->update($data);
        return $res;
    }

    /**
     * @param $typeId
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得项目备注
     */
    public function getTypeRemark($typeId){
        $res = Db::name('test_type')->where('id',$typeId)->find();
        return $res['remark'];
    }

    /**
     * @param $limit
     * @param $offset
     * @return string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得类型列表
     */
    public function getTypeList($limit,$offset){
        $resTB = Db::name('test_type') -> limit($offset, $limit) -> Order('id desc')->where('status','<>',0) -> select();
        $total = Db::name('test_type') ->where('status','<>',0)-> count();
        if ($resTB == null) {
            echo '{"total":0,"rows":[]}';
            return;
        }
        $temp = array();
        foreach ($resTB as $value) {
            $info['id'] = $value['id'];
            $info['type_name'] = $value['type_name'];
            $info['creator_name'] = $value['creator_name'];
            $info['create_date'] = $value['create_date'];
            $info['remark'] = $value['remark'];
            $info['status'] = $value['status'];
            array_push($temp, $info);
        }
        $data['total'] = $total;
        $data['rows'] = $temp;
        return json_encode($data, true);  
    }
}