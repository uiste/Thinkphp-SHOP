<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $menu_list = D('Admin')->menu_list();
        $this->assign('menu_list',$menu_list);
    	$this->display();
    }
}