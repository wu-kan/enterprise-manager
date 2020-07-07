<?php
namespace app\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use app\model\Clerk;
use app\model\CandidateClerk;
use app\model\Department;

use app\BaseController;

class DepartmentManage extends BaseController
{	
	// 加入中间件
    protected $middleware = [\app\middleware\Validate::class];

	public function index(){
		$title = '企业';
        # 右侧列表
    	$db = new Department();
    	$right = $db->getall();
        View::assign([
            'right' => $right,
            'title'=>$title
        ]);
        return View::fetch();    //   view/department_manage/index.html
	}

    public function add()
    {
        //获得Department实例
        $dp = new Department();

        if(Request::method() == 'POST'){
            $all = Request::param();
            //部门信息
            $data=['name'=>$all['name'],'set_time'=>date("Y-m-d",time()),'size'=>0];
            $insert = $dp->add($data);
            if($insert==false){
                // 部门已存在，则无法添加部门
                echo json_encode(['code'=>0,'msg'=>'部门已存在，添加失败']);
                exit;
            }
            else{  // 部门不存在，添加部门
            	//echo json_encode($insert);
                if($insert){
                    echo json_encode(['code'=>1,'msg'=>'添加成功']);
                    //echo json_encode($insert);
                    exit;
                }
                else{
                    echo json_encode(['code'=>2,'msg'=>'添加失败']);
                    exit;
                }
            }
        }   
	    else{
	        return View::fetch();   //   view/department_manage/add.html
        }
    }

    public function delete(){
    	//获得Department实例
        $dp = new Department();
		//获取部门名
        $id = Request::param('id');
        //echo json_encode($dp_name);
                
        $delete = $dp->del($id);    
        if($delete==0){		//人数大于0，无法删除部门  
        	echo json_encode(['code'=>2,'msg'=>'部门人数大于0，无法删除']);
        	exit;
        }
        else{    //人数为0，可以删除
            if($delete){
               //删除成功
                echo json_encode(['code'=>1,'msg'=>'删除成功']);
                exit;
            }
            else{
                //删除失败
                echo json_encode(['code'=>0,'msg'=>'删除失败']);
                exit;
            }
        }       
    }

}
