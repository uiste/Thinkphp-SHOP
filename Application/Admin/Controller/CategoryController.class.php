<?php 
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends BaseController {

	public function lst(){
    	$cateData = D('Category')->getTree();
        $this->assign('cateData',$cateData);
		$this->display();
    }
    public function add(){
        $cateModel = D('Category');
        if (IS_POST) {
            if ($cateModel->create()) {
                if ($cateModel->add()) {
                    $this->success('栏目添加成功', U('lst'));exit();
                }else{
                    $this->error('栏目添加失败'.$cateModel->getDbError());
                }
            }else{
                $this->error('输入不合法：'.$cateModel->getError());
            }
        }
        $cateData = $cateModel->getTree();
        $this->assign('cateData', $cateData);
		$this->display();
    }
    public function edt(){
        $cateModel = D('Category');
        if (IS_POST) {
            if ($data = $cateModel->create()) {
                /**********安全防护************/
                // 自己不能是自己的子级
                if ($data['cate_id']==$data['cate_pid']) {
                    $this->error('栏目更新不合法，自己不能是自己的子级');
                }
                // 自己不能是自己子级的子级
                $leaf = $cateModel->getLeaf($data['cate_id']);
                if (in_array($data['cate_pid'], $leaf)) {
                    $this->error('栏目更新不合法，自己不能是自己的子级的子级');
                }

                if ($cateModel->save()!==false) {
                    $this->success('栏目修改成功', U('lst'));exit();
                }else{
                    $this->error('栏目修改失败'.$cateModel->getDbError());
                }
            }else{
                $this->error('输入不合法：'.$cateModel->getError());
            }
        }
    	$cate_id    = I('get.id');
        $cateInfo   = $cateModel->find($cate_id);
        $cateData   = $cateModel->getTree();
        $cateChildList  = $cateModel->getChild($cate_id);
        $this->assign('cateData', $cateData);
        $this->assign('cateInfo', $cateInfo);
        $this->assign('cateChildList', $cateChildList);
		$this->display();
    }
    public function del(){
    	$cateModel = D('Category');
        $id = I('get.id');
        $status = $cateModel->getLeaf($id);
        if (!$status) {
            if ($cateModel->delete($id)) {
                $this->success('栏目删除成功');exit();
            }
        }else{
            $this->error('栏目删除失败');
        }
		
    }

    /**********使用AJAX技术删除属性列表里面的属性************/

    public function ajaxDel(){
    	$cateModel = D('Category');
        $id = I('get.id');
        $status = $cateModel->getLeaf($id);
        if (!$status) {
            if ($cateModel->delete($id)){
                $data = array(
	            	'sign'		=>	1,
	            	'code'		=> 'delete success',
	            	'msg'		=> '删除成功'
	            );
	            echo json_encode($data);exit();
            }else{
            	$data = array(
	            	'sign'		=>	2,
	            	'code'		=> 'delete error',
	            	'msg'		=> '删除失败'
	            );
	            echo $cateModel->_sql();

	            echo json_encode($data);exit();
            }
        }else{
            $data = array(
            	'sign'		=>	3,
            	'code'		=> 'delete failed',
            	'msg'		=> '该栏目有子级目录不能被删除。。。'
            );
            echo json_encode($data);exit();
        }

    }

}