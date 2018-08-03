<?php
/**
 * Created by PhpStorm.
 * User: Thinkpad
 * Date: 2018/8/3
 * Time: 11:03
 */
namespace app\index\model;

use think\Model;

class CreateTree extends Model
{
    protected $tableName = 'lr_classify';
    function createTree($data,$parent_id=0,$level=0)
    {
        static $new_arr = array();//定义一个容器
        foreach($data as $key=>$value)
        {
            if($value['pid'] == $parent_id)
            {
                $value['level'] = $level;
                $new_arr[]  = $value;
                $this->createTree($data,$value['class_id'],$level+1);
            }
        }
        return $new_arr;
    }
}