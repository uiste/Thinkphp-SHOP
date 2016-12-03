<?php 
namespace Admin\Controller;
use Think\Controller;

class TypeController extends Controller {

	public function lst(){
    	$TypeModel = D('Type');
    	$TypeData 	= $TypeModel->select();
    	$this->assign('TypeData',$TypeData);
		$this->display();
    }

    public function add(){
		if(IS_POST){
			$TypeModel = D('Type');

			if($res = $TypeModel->create()){
				if($TypeModel->add()){
					$this->success('数据添加成功！',U('lst'));exit();
				}else{
					$erro = mysql_error();
					$this->error('数据添加失败！' . $TypeModel->getDbError());
				}
			}else{
                $this->error('数据输入错误：' . $TypeModel->getError());
            }
		}

		$this->display();
    }

    public function edt(){
    	$TypeModel = D('Type');

        if (IS_POST) {
            if ($data = $TypeModel->create()) {
                if ($TypeModel->save()!==false) {
                    $this->success('更新成功', U('lst'));exit();
                }else{
                    $this->error('更新失败：' . $TypeModel->getDbError());
                }
            }else{
                $this->error('数据输入错误：' . $TypeModel->getError());
            }
        }
        $id = I('get.id');
        $TypeInfo = $TypeModel->find($id);
        $this->assign('TypeInfo',$TypeInfo);
		$this->display();
    }

    public function del(){
		$TypeModel = M('Type');
        $id = I('get.id');
        if ($TypeModel->delete($id)) {
            $this->success('删除成功');exit();
        }else{
        $this->error('删除失败');
        }
    }

    // 查看对应商品类型的所有属性列表
    public function showAttr(){
        $type_id = I('get.id');
        $attrModel = M('Attribute');
        $where = array('a.type_id'=>$type_id);
        $attrData   = $attrModel->where($where)->alias('a')
            ->join('left join jx_type b on a.type_id=b.type_id')
            ->select();
        $this->assign('attrData', $attrData);
        $this->display();
    }
}

