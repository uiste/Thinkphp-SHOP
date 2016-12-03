<?php 
namespace Admin\Model;
use Think\Model;

/**
* 权限模型
*/
class AuthModel extends Model 
{
	//商品自动验证
	protected $_validate = array(
		array('auth_name', 'require', '权限名称不能为空'),
	);
	// 权限树形结构
	public function getTree(){
		$data = $this->select();
		return $this->treeList($data,$pid=0);
	}
	public function treeList($data,$pid=0,$level=0){
		static $arr = array();
		foreach ($data as $key => $value) {
			if ($pid==$value['auth_pid']) {
				$value['level'] = $level;
				$arr[] = $value;
				$this->treeList($data,$value['auth_id'],$level+1);
			}
		}
		return $arr;
	}
	// 获取叶子节点
	public function getLeaf($auth_id){
		$where = array('auth_pid'=>$auth_id);
		return $this->field('auth_id')->where($where)->find();
	}

	// 获取所有的子级，用于编辑页面的隐藏判断
	public function getChild($auth_id){
		$auth_pid = array('auth_pid'=>$auth_id);
		$authChildData = $this->field('auth_id')->where($auth_pid)->select();
		$authChildList = array();
		foreach ($authChildData as $key => $value) {
			$authChildList[] = $authChildData[$key]['auth_id'];
		}
		return $authChildList;
	}
}