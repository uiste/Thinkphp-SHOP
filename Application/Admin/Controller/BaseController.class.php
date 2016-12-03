<?php 
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {

	public function __construct(){
    	parent::__construct();
    	// 检验是否登录
    	if (!session('?id')) {
    		echo '<script type="text/javascript">';
			echo "parent.location.href='/index.php/Admin/Login/login'";
			echo '</script>';
			exit;
    	}

        // 权限验证、限制
        $currentUrl = CONTROLLER_NAME . '/' . ACTION_NAME;
        // 如果是Index控制器不进行权限限制
        if (CONTROLLER_NAME == 'Index') {
            return true;
        }
        // 非Index控制器通过session里面保存的权限信息进行验证
        $auth = D('Admin')->getAuth();
        // 如果是超级管理员拥有所有权限
        if ($auth == '*') {
            return true;
        }
        if (!in_array($currentUrl, $auth)) {
            $this->error('您没有此访问权限');
        }
    }
}