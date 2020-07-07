<?php
namespace app\model;
use think\Model;
use think\facade\Db;

class Clerk extends Model{
	// 给出id，获取某个职工的信息
    public function getInfo($id){
        $find = Clerk::where('id',$id)->find();
        if(empty($find))return false; // NULL
        return $find->toArray();
    }

    // 给出职工完整信息，加入到职工数据表中
    public function add($data){
    	$create = Clerk::create($data);
    	return $create->toArray();
    }

    // 给出id，删除该职工的信息
    public function del($id){
    	$delete = Clerk::destroy($id);
    	return $delete;
    }

    // 给出id，修改该职工的信息
    public function modify($id,$new){
    	$update = Clerk::where('id',$id)->update($new);
        return $update;
    }

    // 给出id，获取该职工的权限级别
    public function judge($id){
    	$author = Clerk::where('id',$id)->column('authority');
    	return $author[0];
    }

    // 给出id和密码，检查该职工的密码是否正确
    public function checkpsw($id,$psw){
		$correct_psw = Clerk::where('id',$id)->column('password');
		if($correct_psw[0]==$psw){
			return true;
		}
		else return false;
    }


    // 获取所有职工
    public function getall(){
    	$all=Clerk::select();
        return $all->toArray();
    }
}