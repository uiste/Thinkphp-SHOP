<?php 
namespace Home\Model;
use Think\Model;

/**
* category栏目模型
*/
class CategoryModel extends Model 
{
	
	// 获取导航信息
	public function getNav()
	{
		// 1. 先取出所有数据，然后对数据进行遍历，找到满足条件的数据
		$data = $this->select();
		// 2. 获取顶级栏目信息
		$result = array();
		foreach ($data as $k => $v) {
			// 顶级
			if($v['cate_pid'] == 0){
				unset($data[$k]);
				// 遍历数据，获取该数据的二级栏目信息
				foreach ($data as $k1 => $v1) {
					if($v1['cate_pid'] == $v['cate_id']){
						unset($data[$k1]);
						// 遍历数据，获取该数据的对应的三级栏目信息
						foreach ($data as $k2 => $v2) {
							
							if($v2['cate_pid'] == $v1['cate_id']){
								$v1['children'][] = $v2;
								unset($data[$k2]);
							}
						}
						$v['children'][] = $v1;
					}
				}
				$result[] = $v;
			}
		}

		return $result;
	}

	// 获取某个栏目的子级栏目
	public function getChild($cateId)
	{
		$data = $this->select();
		return $this->_getChild($data, $cateId);
	}
	// 递归获取数据
	public function _getChild($data, $cateId)
	{
		static $list = array();

		foreach ($data as $k => $v) {
			if($v['pid'] == $cateId){
				$list[] = $v['cate_id']; // 栏目主键cate_id
				$this->_getChild($data, $v['cate_id']);
			}
		}

		return $list;
	}
	// 面包屑导航---寻找家谱树
	// 根据当前的栏目id查询父类的栏目id，然后在根据父类查找爷爷辈
	public function getFamily($cateId)
	{
		$data = $this->select();
		return $this->_getFamily($data, $cateId);
	}

	public function _getFamily($data, $cateId)
	{
		static $list = array();

		foreach ($data as $k => $v) {
			if($v['cate_id'] == $cateId){

				$list[] = $v;

				$this->_getFamily($data, $v['pid']);
			}
		}

		return $list;
	}

}

 ?>