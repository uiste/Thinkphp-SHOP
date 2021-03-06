<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends BaseController {

	public function lst(){
    	$adminData = M('admin')->alias('a')
            ->field('a.*,b.role_name')
            ->join('jx_role as b on a.role_id=b.role_id')->select();
    	$this->assign('adminData', $adminData);
		$this->display();
    }

    public function add(){
    	if (IS_POST) {
    		$adminModel = D('Admin');
    		if ($adminModel->create()) {
    			if ($adminModel->add()) {
    				$this->success('管理员添加成功', U('lst'));exit();
    			}else{
    				$this->error('管理员添加失败'.$adminModel->getDbError());
    			}
    		}else{
    			$this->error('管理员添加失败：'.$adminModel->getError());
    		}
    	}
        $roleData = M('role')->select();
        $this->assign('roleData',$roleData);
		$this->display();
    }

    public function edt(){
    	$adminModel = D('Admin');
    	if (IS_POST) {
    		if ($adminModel->create()) {
    			if ($adminModel->save()!==false) {
    				$this->success('管理员修改成功', U('lst'));exit();
    			}else{
    				$this->error('管理员修改失败'.$adminModel->getDbError());
    			}
    		}else{
    			$this->error('非法数据：'.$adminModel->getError());
    		}
    	}
    	$id = I('get.id');
    	$adminInfo = $adminModel->find($id);
    	$this->assign('adminInfo',$adminInfo);
        $roleData = M('role')->select();
        $this->assign('roleData',$roleData);
		$this->display();
    }

    public function del(){
    	$adminModel = M('admin');
    	$id = I('get.id');
    	if ($id>1) {
    		if ($adminModel->delete($id)) {
    			$this->success('管理员删除成功');exit();
    		}
    	}else{
            $this->error('管理员删除失败');
        }
    }


}