<?php 
namespace Admin\Model;
use Think\Model;

/**
* 属性类型
*/
class TypeModel extends Model 
{
	
	//自动验证
	protected $_validate = array(
		array('type_name', 'require', '名称不能为空'),
	);
	

}