<?php 
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {

	public function __construct(){
    	parent::__construct();
    	// 检验是否登录
    	if (!session('?id')) {
    		$this->redirect('Login/login');
    	}
    }
}