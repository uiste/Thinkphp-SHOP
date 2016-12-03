<?php 
namespace Admin\Controller;
use Think\Controller;

class RoleController extends BaseController {

	public function lst(){
    	$roleModel = M('Role');
        $data = $roleModel->alias('a')
            ->field('a.*,group_concat(b.auth_name) as auth_name')
            ->join('left join jx_auth b on find_in_set(b.auth_id,a.role_auth_ids)')
            ->group('a.role_id')
            ->select();
        $this->assign('data',$data);
		$this->display();
    }
    public function add(){
        if (IS_POST) {
            $roleModel = D('Role');
            if ($roleModel->create()) {
                if ($roleModel->add()) {
                    $this->success('角色添加成功', U('lst'));exit();
                }else{
                    $this->error('角色添加失败：' . $roleModel->getDbError());
                }
            }else{
                $this->error('数据输入错误：'.$roleModel->getError());
            }
        }
    	$authData = D('Auth')->select();
        $this->assign('authData',$authData);
		$this->display();
    }
    public function edt(){
        $roleModel = D('Role');
        if (IS_POST) {
            if ($data = $roleModel->create()) {
                if ($roleModel->save()!==false) {
                    $this->success('角色更新成功', U('lst'));exit();
                }else{
                    $this->error('角色更新失败：' . $roleModel->getDbError());
                }
            }else{
                $this->error('数据输入错误：'.$roleModel->getError());
            }
        }
        $role_id = I('get.id');
        $role_info = $roleModel->find($role_id);
    	$authData = D('Auth')->select();
        $this->assign('role_info',$role_info);
        $this->assign('authData',$authData);
		$this->display();
    }
    public function del(){
    	$roleModel = M('role');
        $id = I('get.id');
        if ($id>1) {
            if ($roleModel->delete($id)) {
                $this->success('角色删除成功');exit();
            }
        }else{
            $this->error('角色删除失败');
        }
		
    }

}