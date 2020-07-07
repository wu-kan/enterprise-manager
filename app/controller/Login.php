<?php
namespace app\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use think\facade\Session;
use app\model\Clerk;
use app\model\CandidateClerk;
use app\model\Department;

use app\BaseController;

class Login extends BaseController
{
    public function login()
    {
        // 获取model实例
        $ck = new Clerk();
        
        if(Request::method() == 'POST'){
            $all = Request::param();
            
            if($all['id']=='admin'){  // 管理员身份
                if($all['password'] != 'admin'){
                    echo json_encode(['code'=>4,'msg'=>'管理员密码错误']);
                    exit;
                }
                Session::set('id',$all['id']);
                echo json_encode(['code'=>3,'msg'=>'管理员身份登陆成功']);              
            }
            else{  // 职工身份
                // 查询该用户是否存在
                $info = $ck->getInfo($all['id']);
                // 用户不存在
                if(!$info){
                    echo json_encode(['code'=>0,'msg'=>'未找到用户']);
                    exit;
                }
                // 密码错误
                if(!$ck->checkpsw($all['id'],$all['password'])){
                    echo json_encode(['code'=>1,'msg'=>'职工密码错误']);
                    exit;
                }
                // 密码正确
                Session::set('id',$all['id']);
                echo json_encode(['code'=>2,'msg'=>'职工登陆成功']) ;
            }   
        }

        else{
            // 未登录时，删除用户信息，防止跳转到其他页面
            if(Session::has('id')){
                Session::delete('id');
            }
            return View::fetch();    //   view/login/login.html
        }
    }
}
