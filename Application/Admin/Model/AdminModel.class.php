<?php 
namespace Admin\Model;
use Think\Model;

/**
* 后台管理员
*/
class AdminModel extends Model 
{
	
	//商品自动验证
	protected $_validate = array(
		array('username', 'require', '管理员名称不能为空'),
		array('password', 'require', '管理员密码不能为空',1,'regex',1),
		array('email', 'require', '管理员邮箱不能为空'),

		array('repassword', 'password', '密码必须一致',0,'confirm'),
		// array('code', 'check_verify', '验证码输入错误',0,'function'),
	);
	
	// 自动填充
	protected $_auto = array(
		array('register_time','time',1,'function'),
	);

	// 添加管理员时密码加盐
	public function _before_insert(&$data, $option){
		$data['salt']		= uniqid();
		$data['password']	= md5(md5($data['password']) . $data['salt']);
	}

	// 修改管理员时密码处理
	public function _before_update(&$data, $option){
		if ($data['password']!=null) {
			$data['salt']		= uniqid();
			$data['password']	= md5(md5($data['password']) . $data['salt']);
		}else{
			unset($data['password']);
		}
	}

	// 管理员登录验证
	public function login($code){
		$username = $this->username;
		$where = array('username'=>$username);
		$password = $this->password;
		$userinfo = $this->where($where)->find();
		if ($userinfo) {
			if ($userinfo['password']== md5(md5($password).$userinfo['salt']) ) {
				session('id',$userinfo['id']);
				session('username',$userinfo['username']);
				$this->updateUserInfo($userinfo['id']);
				return 1;
			}else{
				return 2; //密码错误
			}
		}else{
			return 3; //用户不存在
		}
	}
	// 更新登录IP与登录时间
	public function updateUserInfo($uid){
		$data = array(
			'id'				=> $uid,
			'login_time'		=> time(),
			'login_ip'			=> ip2long( get_client_ip() ),
		);
		$this->save($data);
	}
}