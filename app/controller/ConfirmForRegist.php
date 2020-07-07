<?php
namespace app\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use app\model\Clerk;
use app\model\CandidateClerk;
use app\model\Department;

use app\BaseController;

class ConfirmforRegist extends BaseController
{   
    // 加入中间件
    protected $middleware = [\app\middleware\Validate::class];

    // 接收post的id，确认其注册
    public function confirm()
    {
        // 获取model实例
        $ck = new Clerk();
        $cand_ck = new CandidateClerk();

        if(Request::method() == 'POST'){
            $param = Request::param();
            $info = $cand_ck->getInfo($param['id']);
            if(!$info){
                echo json_encode(['code'=>0,'msg'=>'未找到待注册用户']);
                exit;
            }
            else{
                $cand_ck->del($param['id']);
                // 复制一份职工信息，但不保留id
                $new = [];
                $new['name'] = $info['name'];
                $new['gender'] = $info['gender'];
                $new['age'] = $info['age'];
                $new['address'] = $info['address'];
                $new['phone'] = $info['phone'];
                $new['email'] = $info['email'];
                $new['department'] = $info['department'];
                $new['wage'] = $info['wage'];
                $new['bonus'] = $info['bonus'];
                $new['authority'] = $info['authority'];
                $new['password'] = $info['password'];
                $ck->add($new);
                echo json_encode(['code'=>1,'msg'=>'成功批准注册']);
            }
            
        }   
    }


    // 获取所有待注册职工
    public function get_list(){
        // 获取model实例
        $cand_ck = new CandidateClerk();
        $all = $cand_ck->getall();
        $title = '企业';
        View::assign([
            'candidate_clerk'  => $all,
            'title'=>$title
        ]);
        return View::fetch();   //   view/confirm_for_regist/get_list.html
        //print_r($all);
    }
}
