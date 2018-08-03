<?php
namespace app\index\model;
use think\Model;
use think\DB;
class Login extends Model{
	public function login_do($arr){
		$username = $arr['user_name'];
		$pwd = $arr['user_pwd'];
		$res =DB::table('user')->where('user_name',$username)->find();
		if (empty($res)) {
			return 0;die;
		}
		if ($res['is_set']==0) {
			return 0;die;
		}
		if ($res['user_pwd']!=$pwd) {
			return 0;
		}else{
			return $res;
			return 1;
		}
		
	}
	public function manager(){
		$data = DB::table('user')->select();
		return $data;
	}
	public function managerdel($user_id){
		return DB::table('user')->delete($user_id);
	}
	public function managerinsert($arr){
		return DB::table('user')->insert($arr);
	}
}