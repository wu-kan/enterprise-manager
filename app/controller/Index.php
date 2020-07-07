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

class Index extends BaseController
{
	// 加入中间件
    protected $middleware = [\app\middleware\Validate::class];

    public function index()
    {
    	return "这里是空首页——2020春季学期软工第2小组";

    	// 先插入一条数据
    	/*$data = ['name'=>'吴思越',
    	'gender'=>'男',
    	'age'=>'21',
    	'address'=>'China GuangZhou',
    	'phone'=>'110',
    	'email'=>'123',
    	'department'=>'开发部',
    	'wage'=>'1000',
    	'bonus'=>'0',
    	'authority'=>'0',
    	'password'=>'111'
    	];
    	$insert = Db::table('manager_clerk')->insert($data);*/
    	
    	
    	//$db = new Clerk();
        //$index = $db->getall();
        //print_r($index); 
        
        // 测试model的add函数
        /*$db = new Clerk();
        $data=['name'=>'吴小越',
    	'gender'=>'男',
    	'age'=>'12',
    	'address'=>'China GuangZhou',
    	'phone'=>'110',
    	'email'=>'123',
    	'department'=>'开发部',
    	'wage'=>'1000',
    	'bonus'=>'0',
    	'authority'=>'0',
    	'password'=>'111'
    	];
    	$index = $db->add($data);
        print_r($index);
		
		/*
		$db = new Clerk();
		$delete = $db->del(12);
		print_r($delete);*/

        
		// 测试model的modify函数
		//$db = new Clerk();
    	//$index = $db->modify(13,['name'=>'吴越','department'=>'开发部']);
        //print_r($index);
		

		// 测试model的judge函数
    	/*$index = $db->judge(9);
    	print_r($index);

        // 测试model的checkpsw函数
    	/*$index = $db->checkpsw(9,'111');
        if($index){
        	print_r('true');
        }
        else print_r('false');*/
        
        //$db = new Department();
        //$data = ['name'=>'开发部','set_time'=>'2020.7.3','size'=>'0'];
    	//$insert = $db->add($data);
    	//print_r($insert);

    	//$db = new Department();
    	//$delete = $db->del(11);
    }


}
