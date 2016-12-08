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
* 商品模块
*/
class GoodsModel extends Model 
{
	
	//自动验证
	protected $_validate = array(
		array('goods_name', 'require', '商品名称不能为空'),
	);
	
	// 自动填充
	protected $_auto = array(
		array('goods_sn','_goods_sn',1,'callback'),
		array('add_time','_add_time',1,'callback'),
	);

	// 商品货号填充检查
	protected function _goods_sn($sn){
		if (empty($sn)) {
			return 'sn_' . uniqid();
		}else{
			return $sn;
		}
	}

	// 商品添加时间检查
	protected function _add_time($time){
		if (empty($time)) {
			return time();
		}else{
			return strtotime($time);
		}
	}

	// 搜索分页功能
	public function search(){
		$where = '1 and is_delete = 0';

		// 查询添加依据是否传递查询字段，没有传递默认为空，条件不成立
		if ($goods_name = I('get.gn')) {
			$where .= " and `goods_name` like '%$goods_name%'";
		}

		// 排序字段与排序方式通过判断前台是否有传递，有传递使用，没有就用默认值
		$orderBy 	= !empty(I('get.ob')) ? I('get.ob') : 'goods_id';
		$orderWay 	= !empty(I('get.ow')) ? I('get.ow') : 'desc';

		$count = $this->where($where)->count();
		$size = 5;
		$page = new \Think\Page($count, $size);

		$page->setConfig('prev','«');
		$page->setConfig('next','»');
		$show = $page->show();
		$list = $this->where($where)
				->alias('goods')
	            ->join('left join jx_category cate on goods.cate_id = cate.cate_id')
				->order("$orderBy $orderWay")
				->limit($page->firstRow . ',' . $page->listRows)
				->select();
		return array(
			'show' 	=> $show,
			'list'	=>	$list,
		);
	}

	// 插入前置钩子函数处理图片上传
	protected function _before_insert(&$data, $option){
		return $this->UploadFile($data, $option);
	}

	// 更新前置钩子函数处理更新信息
	public function _before_update(&$data, $options){
		// 如果文件上传成功，执行以下更新信息
		// dump($options);exit();
		// 如果没有文件$_FILES['goods_img']['error'] == 4
		if ($_FILES['goods_img']['error']== '0' ) {
			$status = $this->UploadFile($data, $option);
			// dump($status);exit();
			if ($status) {
				$goods_id = $options['where']['goods_id'];
				$goodsOldImg = $this->field('goods_img , goods_thumb')->find();
				// dump($goodsOldImg);exit();
				foreach ($goodsOldImg as $key => $value) {
					@unlink( C('UPLOAD_ROOT_PATH') . $value );
				}
			}else{
				return false;
			}
		}
	}

	// 图片上传处理函数
	private function UploadFile(&$data, $option){
		$configMaxSize 	= 	(int)C('MAX_UPLOAD_FILE_SIZE');
		$phpiniMaxSize 	= 	(int)ini_get('upload_max_filesize');
		$allowMaxSize	=	min($configMaxSize, $phpiniMaxSize);

		$rootPath		= 	C('UPLOAD_ROOT_PATH');
		$exts 			=	C('ALLOW_EXTS');

		$config 		=	array(
			'maxSize'	=>	$allowMaxSize * 1024 * 1024,
			'rootPath'	=>	$rootPath,
			'savePath'	=>	'Goods/',
			'exts'		=> $exts,
		);

		$upload = new \Think\Upload($config);
		$info   = $upload->upload();
		if ($info) {
			// 图片上传路径
			$data['goods_img'] = $info['goods_img']['savepath'] . $info['goods_img']['savename'];
			// 生成缩略图
			$image = new \Think\Image();
			$image->open( $rootPath . $data['goods_img'] );

			$thumImg = $info['goods_img']['savepath'] . 'thumb_' . $info['goods_img']['savename'];
			$image->thumb( C('THUMB.THUMB_W'), C('THUMB.THUMB_H'), C('THUMB.THUMB_S') )->save($rootPath . $thumImg );
			$data['goods_thumb'] = $thumImg;
			return true;
		}else{
			$uploadError = $upload->getError();
			$this->error = $uploadError;
			return false;
		}
	}
}














