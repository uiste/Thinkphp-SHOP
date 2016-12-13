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
        // 获取商品属性类型
        $typeModel  = D('Type');
        $typeData   = $typeModel->select();
		$this->assign('typeData',$typeData);
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

        // 获取对应商品信息
        $this->assign('goodsInfo',$goodsInfo);

        // 获取所有商品栏目
        $cateData  = D('category')->getTree();
        $this->assign('cateData',$cateData);

        // 获取所有商品类型
        $typeModel = D("Type");
        $typeData = $typeModel->select();
        $this->assign('typeData', $typeData);

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

    // 商品拓展属性添加
    public function getAttr(){
        $type_id = I('get.type_id');
        $attrModel = D('attribute');
        $attrData = $attrModel->where("type_id = $type_id")->select();
        echo json_encode($attrData);
    }

    // 商品拓展属性编辑
    public function getGoodsAttr()
    {
        $goodsId = I('get.goods_id');

        $goodsAttrModel = D("GoodsAttr");
        // 根据商品主键id查询对应的商品属性值，并且属性名称获取sh_attribute
        $goodsAttrData = $goodsAttrModel
                ->alias('a')
                ->field('b.attr_name,b.attr_type,b.attr_input_type,attr_values,a.*')
                ->join('left join jx_attribute b on a.attr_id = b.attr_id')
                ->where("a.goods_id = {$goodsId}")
                ->select();
                
        if($goodsAttrData){
            $data = array(
                'sign' => 0,
                'code' => 'get success',
                'msg' => '获取成功！',
                'data' => $goodsAttrData
            );
            echo json_encode($data);exit();
        }else{
            $data = array(
                'sign' => 1,
                'code' => 'not found',
                'msg' => '没有属性值' 
            );
            echo json_encode($data);exit();
        }
    }

}

