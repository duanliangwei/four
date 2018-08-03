<?php
namespace app\index\model;
use think\Model;
use think\DB;
class Goods extends Model{
	//多文件上传
	public function details_add($path)
	{
	   $path = explode(',',$path);
	   unset($path[1]);
	   $data['details_img'] = '';
	   foreach ($path as $key => $value) {
	   	  $data['details_img'] .= $path[$key];
	   }
       $res = Db::table('lr_details')->insert($data);
       return $res;
	}
	public function add($data)
    {
        $res = DB::table('lr_classify')->insert($data);
        return $res;
    }
    public function selectAll()
    {
        $res = DB::table('lr_classify')->select();
        return $res;
    }

}