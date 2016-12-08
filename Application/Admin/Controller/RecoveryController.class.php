<?php
/*
* +-------------------------------+
* | Author: uiste [ JUST DO IT ]  |
* +-------------------------------+
* | Connection: <blog.uiste.com>  |
* +-------------------------------+
*/
namespace Admin\Controller;
use Think\Controller;

class RecoveryController extends Controller {

	public function lst(){
    	$goodsModel = D('Goods');
    	$goodsData 	= $goodsModel->where('is_delete = 1')
            ->alias('goods')
            ->join('left join jx_category cate on goods.cate_id = cate.cate_id')
            ->select();

    	$this->assign('goodsData',$goodsData);
        // dump($goodsData);exit();
		$this->display();
        $upload = new \Think\Upload();
        $info = $upload->upload();
    }

    public function recy(){
    	$goodsModel = D('Goods');
        $id = I('get.id');
        $where = array('goods_id'=>$id);
        $status = $goodsModel->where($where)->setField('is_delete', 0);
        if ($status !== false) {
            $this->success('还原成功');exit();
        }else{
        	$this->error('还原失败');
        }
    }

    public function rdel(){
		$goodsModel = M('Goods');
        $id = I('get.id');
        $goodsDelImg = $goodsModel->field('goods_img, goods_thumb')->find($id);
        foreach ($goodsDelImg as $key => $value) {
            @unlink( C('UPLOAD_ROOT_PATH') . $value );
        }
        $goodsModel->delete($id);
        $this->success('删除成功');exit();
    }

}

