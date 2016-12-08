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

class GoodsController extends Controller {

	public function lst(){
    	$goodsModel = D('Goods');
    	$data 	= $goodsModel->search();

        $this->assign('goodsData',$data['list']);
    	$this->assign('show',$data['show']);
        // dump($goodsData);exit();
		$this->display();
        $upload = new \Think\Upload();
        $info = $upload->upload();
    }

    public function add(){
		if(IS_POST){
			$goodsModel = D('Goods');

			if($goodsModel->create()){
				if($goodsModel->add()){
					$this->success('数据添加成功！',U('lst'));exit();
				}else{
					$erro = mysql_error();
					$this->error('数据添加失败！' . $goodsModel->getDbError());
				}
			}else{
                $this->error('数据输入错误：' . $goodsModel->getError());
            }
		}

		// 获取所有栏目
		$categoryModel = D('Category');
		$cateData = $categoryModel->getTree();
		$this->assign('cateData', $cateData);
		$this->display();
    }

    public function edt(){
    	$goodsModel = D('Goods');

        if (IS_POST) {
            if ($data = $goodsModel->create()) {
                // dump($data);exit();
                if( $goodsModel->save() !== false ){
                    $this->success('更新成功', U('lst'));exit();
                }else{
                    $this->error('更新失败：' . $goodsModel->getDbError());
                }
            }else{
                $this->error('数据输入错误：' . $goodsModel->getError());
            }
        }
        $id = I('get.id');
        $goodsInfo = $goodsModel->find($id);
        $this->assign('goodsInfo',$goodsInfo);

        $cateData  = D('category')->getTree();
        $this->assign('cateData',$cateData);
		$this->display();
    }

    public function del(){
		$goodsModel = D('Goods');
        $id = I('get.id');
        $where = array('goods_id'=>$id);
        $status = $goodsModel->where($where)->setField('is_delete', 1);
        if ($status !== false) {
            // $this->success('加入回收站成功');exit();
            $data = array(
                'sign'  =>  1,
                'code'  =>  'recovery success',
                'msg'   =>  '加入回收站成功',
            );
            echo json_encode($data);exit();
        }else{
            // $this->error('加入失败');
            $data = array(
                'sign'  =>  0,
                'code'  =>  'recovery error',
                'msg'   =>  '加入回收站失败',
            );
            echo json_encode($data);exit();
        }
    }

}

