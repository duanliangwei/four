<?php  
namespace app\index\controller;
use app\index\model\Adver_do;
use think\Controller;
use think\view;
/**
* 
*/
class Adver extends Controller{
	public function show(){
		$obj = new Adver_do();
		$data = $obj->show_adver();
		$data1 = $obj->ad_position();
		// var_dump($data1);die;
		$this->assign('data',$data);
		$this->assign('data1',$data1);
		return $this->fetch('show');
	}
	public function adver_add(){
		$data = input('post.');
		$file = request()->file('ad_img');
		$info = $file->move(ROOT_PATH . 'public' . DS . 'static\img');  
		// 成功上传后 获取上传信息    
		if($info){   
			$data['ad_img'] = "\static\img". DS .$info->getSaveName();
		}else{        
			$this->error('图片上传失败导致广告新增失败');   
		}
		$obj = new Adver_do();
		$res = $obj->add_adver($data);
		if($res){
		    $this->success('广告新增成功', 'adver/show');
		}else{
			$this->error('广告新增失败');     
		}
	}
	public function show_one(){
		$id = input('get.id');
		$obj = new Adver_do();
		$data = $obj->one_show($id);
		$ap_name = $obj->ad_position_one($data['ap_id']);
		$data['ap_name'] = $ap_name['ap_name'];
		// var_dump($data);die;
		$this->assign('data',$data);
		return $this->fetch('show_one');
	}
	public function upd(){
		$id = input('get.id');
		$obj = new Adver_do();
		$data = $obj->one_show($id);
		$data1 = $obj->ad_position();
		// var_dump($data);die;
		$this->assign('data',$data);
		$this->assign('data1',$data1);
		return $this->fetch('upd_do');
	}
	public function upd_do(){
		$data = input('post.');
		$file = request()->file('ad_img');
		if ($file!=null) {
			$info = $file->move(ROOT_PATH . 'public' . DS . 'static\img');
			if($info){
				$ad_img = "\static\img". DS .$info->getSaveName();
				$data['ad_img'] = $ad_img;
			}else{
				$this->error('图片上传失败导致广告修改失败'); 
			}
		}
		$obj = new Adver_do();
		$res = $obj->upd_do($data);
		if($res){
		    $this->success('修改成功', 'adver/show');
		}else{
		   	$this->error('修改失败');       
		}
	}
	public function upd_del(){
		$id = input('get.id');
		$obj = new Adver_do();
		$res = $obj->upd_del($id);
		if($res){
			$this->success('下架成功', 'adver/show');
		} else {
			$this->error('下架失败');
		}

	}
	public function upd_add(){
		$id = input('get.id');
		$obj = new Adver_do();
		$res = $obj->upd_add($id);
		if($res){
			$this->success('上架成功', 'adver/show');
		} else {
			$this->error('上架失败');
		}

	}
	public function del(){
		$id = input('get.id');
	}
	public function shows(){
		$obj = new Adver_do();
		$data = $obj->shows_adver();
		// var_dump($data1);die;
		$this->assign('data',$data);
		return $this->fetch('shows');
	}

}
?>