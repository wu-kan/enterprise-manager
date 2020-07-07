<?php
namespace app\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use app\model\Clerk;
use app\model\CandidateClerk;
use app\model\Department;

use app\BaseController;

class ClerkManage extends BaseController
{   
    // 加入中间件
    protected $middleware = [\app\middleware\Validate::class];

    public function index(){
        $title = '企业';
        # 右侧列表
        $db = new Clerk();
        $right = $db->getall();
        View::assign([
            'right' => $right,
            'title'=>$title
        ]);
        return View::fetch();   //   view/clerk_manage/index.html
    }

    public function add()
    {
        // 获取model实例
        $ck = new Clerk();
        $dp = new Department();

        if(Request::method() == 'POST'){
            $all = Request::param();
            
            $dp_name = $all['department'];
            // 检查部门是否存在
            if($dp->checkbyname($dp_name)){
                // 部门存在，录入职工信息
                $insert = $ck->add($all);
                if($insert){
                    echo json_encode(['code'=>1,'msg'=>'添加成功']);
                    exit;
                }
                else{
                    echo json_encode(['code'=>2,'msg'=>'添加失败']);
                    exit;
                }
            }
            else{
                // 部门不存在，返回错误信息
                echo json_encode(['code'=>0,'msg'=>'部门不存在']) ;
            }
        }   
	    else{
	        return View::fetch();   //   view/clerk_manage/add.html
	    }
    }


    public function delete(){
		// 获取model实例
        $ck = new Clerk();
        
        $id = Request::param('id');
    	$delete = $ck->del($id);
    	if($delete){
    		echo json_encode(['code'=>0,'msg'=>'删除成功']);
            exit;
    	}else{
    		echo json_encode(['code'=>1,'msg'=>'删除失败']);
            exit;
    	}
    }

    public function modify(){
    	// 获取model实例
        $ck = new Clerk();
        $dp = new Department();

    	if(Request::method() == 'POST'){
    		$all = Request::param();
    		$dp_name = $all['department'];
            // 检查部门是否存在
            if($dp->checkbyname($dp_name)){
                // 部门存在，修改职工信息         
    			$update = $ck->modify($all['id'],$all);
	    		if($update){
	    			echo json_encode(['code'=>1,'msg'=>'修改成功']);
                	exit;
	    		}
	    		else{
	    			echo json_encode(['code'=>2,'msg'=>'修改失败']);
                	exit;
	    		}	
	    	}   
	    	else{
                // 部门不存在，返回错误信息
                echo json_encode(['code'=>0,'msg'=>'部门不存在']) ;
            }  	
    	}
    	else{
	    	$id = Request::param('id');
	    	$clerk = $ck->getInfo($id);
	    	View::assign([
	            'clerk' => $clerk
	        ]);
	        return View::fetch();    //   view/clerk_manage/modify.html
        }
    }
}
