<?php 
namespace Admin\Controller;
use Think\Controller;
use Geetest\GeetestLib;

class LoginController extends Controller {

	public function login(){
    	if (IS_POST) {
            require_once './Public/Lib/gtcode/config/config.php';
            session_start();
            if($_POST['type'] == 'pc'){
                $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
            }elseif ($_POST['type'] == 'mobile') {
                $GtSdk = new GeetestLib(MOBILE_CAPTCHA_ID, MOBILE_PRIVATE_KEY);
            }

            $user_id = $_SESSION['user_id'];
            if ($_SESSION['gtserver'] == 1) {   //服务器正常
                $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
                if ($result) {
                    $this -> checkLogin();
                } else{
                    echo '{"status":"fail1", "msg":"验证码输入错误！"}';exit();
                }
            }else{  //服务器宕机,走failback模式
                if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                    $this -> checkLogin();
                }else{
                    echo '{"status":"fail1", "msg":"验证码输入错误！"}';exit();
                }
            }
    	}
		$this->display();
    }
    public function checkLogin(){
        $adminModel = D('Admin');
        if ($adminModel->create()) {
            $status = $adminModel->login();
            if ($status==1) {
                echo '{"status":"success", "msg":"登录成功"}';exit();
                // $this->success('登录成功', U('Admin/Index/index'));exit();
            }else{
                echo '{"status":"fail2", "msg":"用户名或密码错误，请重新登录"}';exit();
                // $this->error('用户名或密码错误，请重新登录');
            }
        }else{
            echo '{"status":"fail3", "msg":"信息输入不合法!"}';exit();
            // $this->error('数据输入错误：'.$adminModel->getError());
        }
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
            'imageW'        => 250,
            'imageH'        => 60,
            'fontSize'      => 25,    // 验证码字体大小
            'length'        => 4,     // 验证码位数
            'useNoise'      => false, // 关闭验证码杂点
            'useCurve'      => false, // 是否使用混淆曲线
            'bg'            =>array(40, 45, 47),
        );
        $Verify =     new \Think\Verify($config);
        $Verify->entry();
    }

    /**
     * 极验验证码
     */
    public function geetest(){
        require '/Public/Lib/lib/class.geetestlib.php';
        require '/Public/Lib/config/config.php';
        $GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
        session_start();
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }
}