<?php 
namespace Admin\Model;
use Think\Model;

/**
* 角色管理
*/
class RoleModel extends Model 
{
	//自动验证
	protected $_validate = array(
		array('role_name', 'require', '角色名称必须填写'),
	);
	
	public function _before_insert(&$data,$options){
		$data['role_auth_ids'] = implode(',',$data['role_auth_ids']);
	}

	public function _before_update(&$data,$options){
		$data['role_auth_ids'] = implode(',',$data['role_auth_ids']);
	}


}