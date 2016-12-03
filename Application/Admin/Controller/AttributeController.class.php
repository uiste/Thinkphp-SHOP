<?php 
namespace Admin\Controller;
use Think\Controller;

class AttributeController extends Controller {
	public function lst(){
		$attrModel = M('Attribute');
    	$attrData 	= $attrModel->alias('a')
            ->join('left join jx_type b on a.type_id=b.type_id')
            ->select();
    	$this->assign('attrData',$attrData);
		$this->display();
	}
    public function add(){
		if(IS_POST){
			$attributeModel = D('Attribute');
			if($attributeModel->create()){
				$type_id = $attributeModel->type_id;
				if($attributeModel->add()){
					// $this->success('数据添加成功！',U('Type/showAttr', array('id' => $type_id), false));exit();
					$this->success('处理成功！', U('lst'));exit();
				}else{
					$erro = mysql_error();
					$this->error('数据添加失败！' . $attributeModel->getDbError());
				}
			}else{
                $this->error('数据输入错误：' . $attributeModel->getError());
            }
		}
		$typeData = M('type')->select();
		$this->assign('typeData', $typeData);
		$this->display();
    }

    public function edt(){
    	$attributeModel = D('Attribute');

        if (IS_POST) {
            if ($data = $attributeModel->create()) {
                if ($attributeModel->save()!==false) {
                    $this->success('更新成功', U('lst'));exit();
                }else{
                    $this->error('更新失败：' . $attributeModel->getDbError());
                }
            }else{
                $this->error('数据输入错误：' . $attributeModel->getError());
            }
        }
        $id = I('get.id');
        $attributeInfo = $attributeModel->find($id);
        $this->assign('attributeInfo',$attributeInfo);
        $typeData = M('type')->select();
		$this->assign('typeData', $typeData);
		
		$this->display();
    }

    public function del(){
		$attributeModel = M('attribute');
        $id = I('get.id');
        if ($attributeModel->delete($id)) {
            $this->success('删除成功');exit();
        }else{
        $this->error('删除失败');
        }
    }

}

