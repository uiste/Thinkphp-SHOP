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

	// 插入前置钩子函数处理图片上传
	protected function _before_insert(&$data, $option){
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
		}else{
			$uploadError = $upload->getError();
			$this->error = $uploadError;
			return false;
		}
	}
}














