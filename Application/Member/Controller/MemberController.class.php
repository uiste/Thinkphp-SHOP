<?php
namespace Member\Controller;
use Think\Controller;
class MemberController extends Controller {
	// 会员注册
    public function register(){
    	if (IS_POST) {
    		$memberModel = D('Member');
    		// 注册信息数据验证
    		if ($memberModel -> create()) {
    			// 注册信息入库
    			if ($memberModel -> add()) {
    				return $this->success('注册成功', U('Home/Index/index'));
    			}else{
    				return $this->error('注册失败：<br>' . $this->getDbError());
    			}
    		}else{
    			return $this->error('数据验证失败：<br>' . $memberModel->getError());
    		}
    	}
    	return $this->display();
    }

    // 会员邮箱激活
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

}