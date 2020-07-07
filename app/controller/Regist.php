<?php
namespace app\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use app\model\Clerk;
use app\model\CandidateClerk;
use app\model\Department;

use app\BaseController;

class Regist extends BaseController
{   
    public function regist()
    {
        // 获取model实例
        $cand_ck = new CandidateClerk();
        $dp = new Department();

        if(Request::method() == 'POST'){
            $all = Request::param();
            $dp_name = $all['department'];
            // 检查部门是否存在
            if($dp->checkbyname($dp_name)){
                // 部门存在，加入待注册职工信息         
                $insert = $cand_ck->add($all);
                if($insert){
                    echo json_encode(['code'=>1,'msg'=>'注册已提交']);
                    exit;
                }
                else{
                    echo json_encode(['code'=>2,'msg'=>'注册提交失败']);
                    exit;
                }   
            }   
            else{
                // 部门不存在，返回错误信息
                echo json_encode(['code'=>0,'msg'=>'部门不存在']) ;
            }                     
        }  
        else{
            $title = '企业';
            View::assign([          
            'title'=>$title
        ]);
            return View::fetch();   //   view/regist/regist.html
        } 
    }
}
