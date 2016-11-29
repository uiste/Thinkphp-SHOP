<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	return $this->success('正在回跳...',U('Member/Member/register'));
    }
}