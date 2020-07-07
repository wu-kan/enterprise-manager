<?php
namespace app\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use app\model\Clerk;
use app\model\CandidateClerk;
use app\model\Department;

use app\BaseController;

class OccupationInfo extends BaseController
{   
    // 加入中间件
    protected $middleware = [\app\middleware\Validate::class];
    
    public function showInfo(){
        $title = '企业';
        # 右侧列表
        $db = new Clerk();
        $right = $db->getall();
        View::assign([
            'right' => $right,
            'title'=>$title
        ]);
        return View::fetch();    //   view/occupation_info/show_info.html
    }
    
}
