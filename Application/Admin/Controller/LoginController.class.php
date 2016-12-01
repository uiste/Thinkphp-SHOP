<?php 
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {

	public function login(){
    	if (IS_POST) {
    		$adminModel = D('Admin');
    		if ($adminModel->create()) {
    			$status = $adminModel->login();
    			if ($status==1) {
    				$this->success('登录成功', U('Admin/Index/index'));exit();
    			}else{
    				$this->error('用户名或密码错误，请重新登录');
    			}
    		}else{
    			$this->error('数据输入错误：'.$adminModel->getError());
    		}
    	}
		$this->display();
    }

    /**
     * 退出功能
     */
    public function logout(){
        session(null);
        $this->success('退出成功', U('Admin/Login/login'));
    }

    /**
     * 验证码
     */
    public function code(){
        $config =    array(
            'imageW'        => 110,
            'imageH'        => 40,
            'fontSize'      => 15,    // 验证码字体大小
            'length'        => 4,     // 验证码位数
            'useNoise'      => false, // 关闭验证码杂点
            'useCurve'      => false, // 是否使用混淆曲线
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();
    }
}