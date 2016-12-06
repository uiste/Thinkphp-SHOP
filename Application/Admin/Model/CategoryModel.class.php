<?php
/*
** +-------------------------------------------
** | Author: uiste [ JUST DO IT ]
** +-------------------------------------------
** | Connection: <blog.uiste.com>
** +-------------------------------------------
*/
namespace Admin\Model;
use Think\Model;

/**
* 商品分类，商品栏目
*/
class CategoryModel extends Model 
{
	
	//自动验证
	protected $_validate = array(
		array('cate_name', 'require', '名称不能为空'),
	);
	
	// 栏目树形结构
	public function getTree(){
		$data = $this->select();
		return $this->treeList($data,$pid=0);
	}
	public function treeList($data,$pid=0,$level=0){
		static $arr = array();
		foreach ($data as $key => $value) {
			if ($pid==$value['cate_pid']) {
				$value['level'] = $level;
				$arr[] = $value;
				$this->treeList($data,$value['cate_id'],$level+1);
			}
		}
		return $arr;
	}
	// 获取叶子节点
	public function getLeaf($cate_id){
		$where = array('cate_pid'=>$cate_id);
		return $this->field('cate_id')->where($where)->find();
	}

	// 获取所有的子级，用于编辑页面的隐藏判断
	public function getChild($cate_id){
		$cate_pid = array('cate_pid'=>$cate_id);
		$cateChildData = $this->field('cate_id')->where($cate_pid)->select();
		$cateChildList = array();
		foreach ($cateChildData as $key => $value) {
			$cateChildList[] = $cateChildData[$key]['cate_id'];
		}
		return $cateChildList;
	}
}