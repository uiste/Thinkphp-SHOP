<?php 
namespace Admin\Model;
use Think\Model;

/**
* 后台管理员
*/
class AdminModel extends Model 
{
	
	//自动验证
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
	// 登录成功保存权限信息
	public function login($code){
		$username = $this->username;
		$where = array('username'=>$username);
		$password = $this->password;
		$userinfo = $this->where($where)->find();
		if ($userinfo) {
			if ($userinfo['password']== md5(md5($password).$userinfo['salt']) ) {
				// 登录成功调用权限信息保存的方法
				session('id',$userinfo['id']);
				session('username',$userinfo['username']);
				session('role_id',$userinfo['role_id']);
				$this->getAuth();
				$this->updateUserInfo($userinfo['id']);
				return 1;
			}else{
				return 2; //密码错误
			}
		}else{
			return 3; //用户不存在
		}
	}
	// 获取管理员权限信息
	public function getAuth(){
		$role_id = session('role_id');
		// 获取角色信息
		$roleModel = M('Role');
		$roleInfo = $roleModel->find($role_id);
		// 根据角色表中的权限列表role_ruth_ids获取权限信息
		$authModel = M('Auth');
		if ($roleInfo['role_auth_ids'] == '*') {
			$auth = '*';
			return $auth;
		}else{
			$_authData = $authModel->field("auth_id,auth_name,auth_c,auth_a,auth_pid,is_show,concat(auth_c,'/',auth_a) as url")
				->where("auth_id in ({$roleInfo['role_auth_ids']})")->select();
			// 将权限处理成一个一维数组
			$authData = array();
			foreach ($_authData as $key => $value) {
				$authData[] = $value['url'];
			}
			return $authData;
		}
	}

	// 权限列表显示
	public function menu_list(){
		// 规定超级管理员的role_id等于1
        $role_id = session('role_id');
        if ($role_id==1) { //超级管理员
            $auth_info1 = M('auth')->where('auth_pid = 0 and is_show = 1')->select();//父级
            $auth_info2 = M('auth')->where('auth_pid > 0 and is_show = 1')->select();//子级
        }else{
            $role = M('role')->find($role_id); //通过管理员角色id找到角色信息
            $role_auth_ids = $role['role_auth_ids'];//获取该角色的权限信息
            $auth_info1 = M('auth')->where("auth_pid = 0 and is_show =1 and auth_id in ($role_auth_ids)")->select();
            $auth_info2 = M('auth')->where("auth_pid > 0 and is_show =1 and auth_id in ($role_auth_ids)")->select();
        }
        $menu_list = array(
                'auth_info1' => $auth_info1,
                'auth_info2' => $auth_info2
            );
        return $menu_list;
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