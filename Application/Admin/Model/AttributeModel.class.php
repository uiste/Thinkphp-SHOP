<?php 
namespace Admin\Model;
use Think\Model;

/**
* 商品属性
*/
class AttributeModel extends Model 
{
	
	//自动验证
	protected $_validate = array(
		array('attr_name', 'require', '名称不能为空'),
	);
	
	// 插入的前置钩子完成可选值的替换
	public function _before_insert(&$data, $options)
	{
		// ，==> ,
		$data['attr_values'] = str_replace('，', ',', $data['attr_values']);

	}

}