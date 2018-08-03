<?php
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\view;
use app\index\model;
class Home extends Controller{
	private static $user_id;
	public $model;
	public  function __construct(){
		$this->model = model('Login');
		 self::$user_id=Cookie::get('user_id');
		 if (empty(self::$user_id)) {
		 	$this->error('请先登录','/login/login');die;
		 }
	}
	
	public function index(){
		$user_name =Cookie::get('user_name');
		return view('index',['user_name'=>$user_name,'user_id'=>self::$user_id]);
	}
	//用户列表
	public function manager(){
		$data = $this->model->manager();
		return view('manager',['data'=>$data]);
	}
	//用户列表删除  GET获取user_id
	public function managerdel(){
		$user_id = input('get.id');
		$res = $this->model->managerdel($user_id);
		if ($res) {
			echo "<script>alert('删除成功');location.href='/home/manager'</script>";
		}else{
			$this->error('删除失败');
		}
	}
	//用户管理员的添加页面渲染
	public function addmanager(){
		return view('addmanager');
	}
	//添加用户
	public function managerinsert(){
		$data = input('post.');
		$data['user_pwd'] = md5($data['user_pwd']);
		$data['logintime'] =date("Y-m-d H:i:s");
		$res = $this->model->managerinsert($data);
		if ($res) {
			echo "<script>alert('添加成功');location.href='/home/manager'</script>";
		}else{
			$this->error('添加失败');
		}
	}

	public function page(){
		return view('page');
	}
	
	
}