<?php
namespace app\index\controller;
use think\Controller;
use app\index\model;
class Goods extends Controller{
	public $obj;
	public function  __construct()
	{
		$this->obj = model('Goods');
	}
	public function index()
	{
		return view('index');
	}
	public function add()
	{
		return view('add');
	}
	//品牌列表
	public function goods_brand()
	{
		// echo 1;die;
		return view('goods_brand');
	}
	//品牌添加
	public function brand_add()
	{
		
	}
	//相册展示
	public function details_show()
	{
		return view('details_show');
	}
	//相册--添加
	public function details_add()
	{
		return view('details_add');
	}
	//相册--入库
	public function detaileadd_do()
	{
		$up_info=$_FILES['img'];
		// var_dump($up_info);die; 
		$ob_path=INDEX_PATH."/update";   
		if (!is_dir($ob_path)) {
			mkdir($ob_path,777,true);
		}
		$typelist=array("image/gif","image/jpeg","image/pjpeg","image/png"); //定义运行的上传文件类型 
		for($i=0;$i<count($up_info['name']);$i++){        //foreach 循环处理多个文件上传 
		//  2.判断文件是否上传错误 
	    if($up_info['error'][$i]>0){ 
			    switch($up_info['error'][$i]){ 
			        case 1: 
			            $err_info="上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值"; 
			            break; 
			        case 2: 
			            $err_info="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值"; 
			            break; 
			        case 3: 
			            $err_info="文件只有部分被上传"; 
			            break; 
			        case 4: 
			            $err_info="没有文件被上传"; 
			            break; 
			        case 6: 
			            $err_info="找不到临时文件夹"; 
			            break; 
			        case 7: 
			            $err_info="文件写入失败"; 
			            break; 
			        default: 
			            $err_info="未知的上传错误"; 
			            break; 
			    } 
			    return $err_info; 
                die(); 
			} 
			//3.判断文件上传的类型是否合法 
			if(!in_array($up_info['type'][$i],$typelist)){ 
			    // continue('文件类型错误！'.$up_info['type'][$i]); 
			    return '文件类型错误！'.$up_info['type'][$i]; 
                die(); 
			} 
			//4.上传文件的大小过滤 
			if($up_info['size'][$i]>1000000){ 
			    // continue('文件大小超过1000000'); 
			    return '文件大小超过1000000'; 
                die(); 
			} 
			//5.上传文件名处理
			$exten_name=pathinfo($up_info['name'][$i],PATHINFO_EXTENSION); 
		    do{ 
		        $main_name=date('YmHis'.'--'.rand(100,999));         
		        $new_name=$main_name.'.'.$exten_name; 
		    }while(file_exists($ob_path.'/'.$new_name)); 
			//6.判断是否是上传的文件，并执行上传 
			if(is_uploaded_file($up_info['tmp_name'][$i])){
		        if(move_uploaded_file($up_info['tmp_name'][$i],$ob_path.'/'.$new_name)){
		            $res = $this->obj->details_add($ob_path.'/'.$new_name.',');
		            if ($res) {
		            	echo "<script>alert('上传成功');location.href='/goods/details_show'</script>";
		            }else{
		            	echo "<script>alert('上传失败');location.href='/goods/details_add'</script>";
		            }
		        }else{ 
		            echo '上传文件移动失败!'; 
		            } 
			}else{ 
			       echo '文件不是上传的文件'; 
			        } 
			 
			}//for循环的括号 
		


	}

    /*
    *分类列表添加
    *

     */

    public function classAdd()
    {


        if (!empty($_POST)) {
            $data = $_POST;
            $res = model('Goods')->add($data);
            if ($res) {


            }
        } else {

            $data =     model('Goods')->selectAll();
            $data = model('CreateTree')->createTree($data);
            return view('add',['data'=>$data]);
        }

    }
    /**
     * 无限分类列表
     */
    public function listAll()
    {
        $data =     model('Goods')->selectAll();
        $data = model('CreateTree')->createTree($data);
        return view('listAll',['data'=>$data]);
    }
}