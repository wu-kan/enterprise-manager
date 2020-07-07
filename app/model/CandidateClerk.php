<?php
namespace app\model;
use think\Model;
use think\facade\Db;

class CandidateClerk extends Model{
	// 给出某条件，获取某个待注册职工的信息
    public function getInfo($id){
        $find = CandidateClerk::where('id',$id)->find();
        if(empty($find))return false;  // // NULL
        return $find->toArray();
    }

    // 给出职工完整信息，加入到待注册职工数据表中
    public function add($data){
    	$create = CandidateClerk::create($data);
    	return $create->toArray();
    }

    // 给出id，删除该待注册职工的信息
    public function del($id){
    	$delete = CandidateClerk::destroy($id);
    	return $delete;
    }

    // 获取所有待注册职工
    public function getall(){
        $all=CandidateClerk::select();
        return $all->toArray();
    }
}