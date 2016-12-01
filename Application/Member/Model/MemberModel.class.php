<?php 
namespace Member\Model;
use Think\Model;

/**
* 会员模块
*/
class MemberModel extends Model
{
	// 自动验证注册信息
	protected $_validate = array(
		array('username','require','用户名不能为空'),
		array('password','require','密码不能为空'),
		array('email','require','邮箱不能为空'),
		array('phone','require','手机号不能为空'),
		
		array('username','','该用户名已经存在！',0,'unique',1),
		array('username','','该用户名已经存在！',0,'unique',2),
		array('email','','该有邮箱已经存在！',0,'unique',1),
		array('email','','该有邮箱已经存在！',0,'unique',2),
		array('phone','','该手机号已经存在！',0,'unique',1),
		array('phone','','该手机号已经存在！',0,'unique',2),

		array('repassword','password','两次密码不正确',0,'confirm'),
		array('email','email','邮箱格式不正确'),
		array('phone','number','手机不正确'),

		array('checkcode','check_verify','验证码填写错误',1,'function',4),
	);

	// 自动完成注册时间
	protected $_auto = array(
		array('registertime','time',1,'function'),
	);

	/**
	 * 插入的前置钩子函数在注册数据入库前，进行密码加密
	 * @param  array &$data  表单提交过来的数据
	 * @param  array $option 表名和模型名以及一些查询条件（如果有）
	 */
	public function _before_insert(&$data,$option){
		$data['salt']		= uniqid();
		$data['password']	= md5(md5($data['password']) . $data['salt']);
	}

	/**
	 * 插入的后置钩子函数，在数据真正入库之后会被调用
	 * @param  array $data   存入数据库的数据，包含主键id
	 * @param  array $option 表名和模型名
	 */
	public function _after_insert($data,$option){
		$email_key = md5($data['id'] . C('EMAIL_KEY'));
		$content = "尊敬的用户您好，欢迎注册京西购物网站！<br><a href='http://local.shop.com/index.php/Member/Member/active/id/" .$data['id']. "/email_key/" . $email_key. "' target='_blank'>请点击激活您的账户</a>";
		sendMail($data['email'], '京西购物商城', $content );
	}
	/**
	 * 更新的前置钩子函数在注册数据入库前，进行密码加密
	 * @param  array &$data  表单提交过来的数据
	 * @param  array $option 表名和模型名以及一些查询条件（如果有）
	 */
	public function _before_update(&$data,$option){
		$data['salt']		= uniqid();
		$data['password']	= md5(md5($data['password']) . $data['salt']);
	}

	/**
	 * 用户登录登录验证
	 */
	public function login($code){
		$username = $this->username;
		$where = array('username'=>$username);
		$password = $this->password;
		$userinfo = $this->where($where)->find();
		if ($userinfo) {
			if ($userinfo['password']== md5(md5($password).$userinfo['salt']) ) {
				session('uid',$userinfo['id']);
				session('uname',$userinfo['username']);
				return 1;
			}else{
				return 2; //密码错误
			}
		}else{
			return 3; //用户不存在
		}
	}
}