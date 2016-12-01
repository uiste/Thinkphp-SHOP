<?php
namespace Member\Controller;
use Think\Controller;
class MemberController extends Controller {
    /**
     * 会员注册
     */
    public function register(){
    	if (IS_POST) {
    		$memberModel = D('Member');
    		// 注册信息数据验证
    		if ($memberModel -> create()) {
    			// 注册信息入库
    			if ($memberModel -> add()) {
    				return $this->success('注册成功', U('Home/Index/index'));exit;
    			}else{
    				return $this->error('注册失败：<br>' . $this->getDbError());
    			}
    		}else{
    			return $this->error('数据验证失败：<br>' . $memberModel->getError());
    		}
    	}
    	return $this->display();
    }

    /**
     * 会员邮箱激活
     */
    public function active(){
    	$id = I('id');
    	$email_key = I('email_key');
    	$memberModel = D('Member');
    	// 验证用户id与用户秘钥是否匹配
    	if (md5($id . C('EMAIL_KEY')) == $email_key) {
    		$userinfo = $memberModel->find($id);
    		if ($userinfo) {
    			$where = array('id'=>$id);
    			// setField 返回更新信息影响的函数
    			$status = $memberModel->where($where)->setField('isactive', 1);
    			if ($status) {
    				return $this->success('用户激活成功', U('Home/Index/index'));
    			}else{
    				return $this->error('用户激活失败', U('Home/Index/index'));
    			}
    		}else{
    			$this->error('用户不存在', U('Home/Index/index'));
    		}
    	}else{
    		return $this->error('非法操作，该用户不存在',U('Home/Index/index'));
    	}
    }

    /**
     * 登录功能
     */
    public function login(){
        if (IS_POST) {
            $memberModel = D('member');
            // 登录添加单独的验证规则，防止与注册的冲突
            if ($memberModel->create(I('post.'),4)) {
                $status = $memberModel->login();
                if ($status==1) {
                    $this->success('登录成功', U('Home/Index/index'));exit();
                }else{
                    $this->error('用户名或密码错误，请重新登录');
                }
            }else{
                $this->error('输入信息不合法：'.$memberModel->getError());
            }
        }
        $this->display();
    }

    /**
     * 退出功能
     */
    public function logout(){
        session(null);
        $this->success('退出成功', U('Home/Index/index'));
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

    // 一下为找回密码部分
    public function find(){ 

        $this->display();
    }

    // 生成随机验证码发送给用户邮箱
    public function sendEmail(){
        $email = trim(I('get.email'));
        $where = array('email'=> $email);
        $memberModel = M('Member');
        $userinfo = $memberModel->where($where)->find();
        if ($userinfo) {
            // 生成随机验证码
            $code = substr(uniqid(), -5);
            $status = sendMail($email, '找回密码', '京西商城找回密码的验证码是：'.$code);
            // 邮件发送状态判断
            if ($status) {
                $sign = md5(md5($email) . $code);
                $data = array(
                    'sign' => 1,
                    'code' => 'sendEmail success',
                    'data' => array(
                        'uid'   => $userinfo['id'],
                        'sign'  => $sign,
                    ),
                    'msg'  => '邮件已发送，请查收邮件'
                );
                echo json_encode($data);exit();
            }else{
                $data = array(
                    'sign' => 2,
                    'code' => 'sendEmail false',
                    'msg'  => '邮件发送失败，请联系管理员 uiste01@163.com'
                );
                echo json_encode($data);exit();
            }
        }else{
            $data = array(
                'sign' => 3,
                'code' => 'not found user',
                'msg'  => '用户信息不存在'
            );
            echo json_encode($data);exit();
        }
    }
    // 验证输入的验证码是否正确，如果正确就跳转到更新密码页面
    public function change(){
        $data = I('post.');
        if (md5(md5($data['email']) . $data['checkcode']) != $data['sign']) {
            $this->error('验证码输入错误或邮箱不合法');
        }
        $memberModel = M('member');
        $where = array('id'=>$data['id']);
        $userinfo = $memberModel->field('id,username')->where($where)->find();
        session('uname',$userinfo['username']);
        $this->assign('userinfo', $userinfo);
        $this->display();
    }

    public function doChange(){
        if(IS_POST){
            $memberModel = D('member');
            if ($memberModel->create()) {
                if ($memberModel->save()) {
                    $this->success('密码更新成功，请重新登录', U('Home/Index/index'));
                }else{
                    $this->error('密码更新失败，请重新更新...'.$memberModel->getDbError());
                }
            }else{
                $this->error('输入不合法:'.$memberModel->getError());
            }
        }
    }
}