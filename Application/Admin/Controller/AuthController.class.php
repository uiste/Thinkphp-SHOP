<?php 
namespace Admin\Controller;
use Think\Controller;

class AuthController extends BaseController {

	public function lst(){
    	$authData = D('Auth')->getTree();
        $this->assign('authData',$authData);
		$this->display();
    }
    public function add(){
        $authModel = D('Auth');
        if (IS_POST) {
            if ($authModel->create()) {
                if ($authModel->add()) {
                    $this->success('权限添加成功', U('lst'));exit();
                }else{
                    $this->error('权限添加失败'.$authModel->getDbError());
                }
            }else{
                $this->error('输入不合法：'.$authModel->getError());
            }
        }
        $authData = $authModel->getTree();
        $this->assign('authData', $authData);
		$this->display();
    }
    public function edt(){
        $authModel = D('Auth');
        if (IS_POST) {
            if ($data = $authModel->create()) {
                /**********安全防护************/
                // 自己不能是自己的子级
                if ($data['auth_id']==$data['auth_pid']) {
                    $this->error('权限更新不合法，自己不能是自己的子级');
                }
                // 自己不能是自己子级的子级
                $leaf = $authModel->getLeaf($data['auth_id']);
                if (in_array($data['auth_pid'], $leaf)) {
                    $this->error('权限更新不合法，自己不能是自己的子级的子级');
                }

                if ($authModel->save()!==false) {
                    $this->success('权限修改成功', U('lst'));exit();
                }else{
                    $this->error('权限修改失败'.$authModel->getDbError());
                }
            }else{
                $this->error('输入不合法：'.$authModel->getError());
            }
        }
    	$auth_id    = I('get.id');
        $authInfo   = $authModel->find($auth_id);
        $authData   = $authModel->getTree();
        $authChildList  = $authModel->getChild($auth_id);
        $this->assign('authData', $authData);
        $this->assign('authInfo', $authInfo);
        $this->assign('authChildList', $authChildList);
		$this->display();
    }
    public function del(){
    	$authModel = D('Auth');
        $id = I('get.id');
        $status = $authModel->getLeaf($id);
        if (!$status) {
            if ($authModel->delete($id)) {
                $this->success('管理员删除成功');exit();
            }
        }else{
            $this->error('管理员删除失败');
        }
		
    }

}