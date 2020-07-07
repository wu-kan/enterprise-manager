<?php
namespace app\model;
use think\Model;
use app\model\Clerk;
use think\facade\Db;

class Department extends Model{
    //给出部门完整信息：name,set_time,size，检查冲突，加入到部门数据表中
    public function add($data){
        $dpname=$data['name'];
        if(!$this->checkbyname($dpname)){
            $create=Department::create($data);
            return $create->toArray();
        }
        return false;
        
    }

    //给出部门id，检查冲突，删除该部门的信息
    public function del($id)
    {
        //$name=Department::where('id',$id)->find()['name'];
        //Db::table('manager_clerk')->where('department',$name)->update(['department' => 'null']);
        //Db::table('manager_candidate_clerk')->where('department',$name)->update(['department' => 'null']);
        $size=Department::where('id',$id)->find()['size'];
        if($size>0){
            return 0;
        }
        $delete=Department::destroy($id);
        return $delete;
    }

    //给出部门id，查看该部门是否存在
    public function checkbyid($id)
    {
        $find=Department::where('id',$id)->find();
        if($find!=null){
            return true;
        }
        else{
            return false;
        }
    }

    //给出部门名，查看该部门是否存在
    public function checkbyname($name){
        $find=Department::where('name',$name)->find();
        if($find!=null){
            return true;
        }
        else{
            return false;
        }
    }

    // 获取所有部门
    public function getall()
    {
        $all=Department::select();
        return $all->toArray();
    }


    // 给出id，获取某个部门的信息
    public function getInfo($id){
        $find = Department::where('id',$id)->find();
        if(empty($find))return false; // NULL
        return $find->toArray();
    }
}