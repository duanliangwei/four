<?php
namespace app\index\controller;
use think\Controller;
use app\index\model;
use think\Cookie;
class Login extends Controller{
	public function login(){
		return $this->fetch('login');
	}
	public function login_do(){
			$data = input('post.');
			$model = model('Login');
			$res = $model->login_do($data);
			if ($res==0) {
				$this->error('账号或密码错误,权限不够');
			}else{
				Cookie::set('user_name','user_id','value',3600);
				Cookie::set('user_name',$res['user_name']);
				Cookie::set('user_id',$res['user_id']);
				echo "<script>alert('登录成功');location.href='/home/index'</script>";
			}
	}
}