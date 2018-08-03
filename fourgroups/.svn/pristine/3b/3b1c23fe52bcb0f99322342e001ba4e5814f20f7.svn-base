<?php  
namespace app\index\model;
use think\Model;
use think\Db;
/**
* 
*/
class Adver_do extends Model{
	public function show_adver(){
		return $data = Db::table('adver')->where('is_up=1')->order('sort esc')->select();
	}
	public function shows_adver(){
		return $data = Db::table('adver')->where('is_up=0')->order('sort esc')->select();
	}
	public function add_adver($data){
		return $res = db('adver')->insert($data);
	}
	public function one_show($id){
		return $data = db('adver')->where('ad_id',$id)->find();
	}
	public function upd_del($id){
		return $res = db('adver')->where('ad_id',$id)->setField('is_up','0');
	}
	public function upd_add($id){
		return $res = db('adver')->where('ad_id',$id)->setField('is_up','1');
	}
	public function upd_do($data){
		return $res = db('adver')->where('ad_id',$data['ad_id'])->update($data);
	}
	public function ad_position(){
		return $data = db('ad_position')->select();
	}
	public function ad_position_one($ap_id){
		return $data = db('ad_position')->where('ap_id',$ap_id)->find();
	}
}

?>