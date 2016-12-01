<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>购物商城后台管理系统</title>
<meta name="description" content="这是一个 index 页面">
<meta name="keywords" content="index">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="icon" type="image/png" href="/Public/Admin/assets/i/favicon.png">
<link rel="apple-touch-icon-precomposed" href="/Public/Admin/assets/i/app-icon72x72@2x.png">
<meta name="apple-mobile-web-app-title" content="Amaze UI" />
<link rel="stylesheet" href="/Public/Admin/assets/css/amazeui.min.css"/>
<link rel="stylesheet" href="/Public/Admin/assets/css/admin.css">
<link rel="stylesheet" href="/Public/Admin/assets/css/amazeui.datatables.min.css" />
<link rel="stylesheet" href="/Public/Admin/assets/css/app.css">
<script src="/Public/Admin/assets/js/jquery.min.js"></script>
<script src="/Public/Admin/assets/js/app.js"></script>
<script type="text/javascript">
	$('#turnIndex').click(function(){
		alert(111)
		// window.location.href = '/index.php/Admin/Admin/index'
	})
</script>
</head>
<body>
<div class="daohang">
      <ul>
        <li><button id="turnIndex" type="button" class="am-btn am-btn-default am-radius am-btn-xs"> 首页 </li>
        <li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs">帮助中心<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close="">×</a></button></li> 
      </ul>
</div>
<div class="admin-biaogelist">
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> 栏目名称</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 &gt; <a href="/index.php/Admin/Admin/lst">管理员列表</a></dl>
    </div>
	
    <div class="fbneirong">
      <form class="am-form" action="/index.php/Admin/Admin/add" method="post">
        <div class="am-form-group am-cf">
          <div class="zuo">管理员名称：</div>
          <div class="you">
            <input type="text" name="username" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入管理员名称">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">管理员角色：</div>
          <div class="you">
            <select name="role_id">
              <option value="0">请选择管理员角色</option>
              <option value="option2">选项二.....</option>
            </select>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">新密码：</div>
          <div class="you">
            <input type="password" name="password" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入新密码">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">新密码：</div>
          <div class="you">
            <input type="password" name="repassword" class="am-input-sm" id="doc-ipt-email-1" placeholder="请再次输入新密码">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">管理员邮箱：</div>
          <div class="you">
            <input type="email" name="email" class="am-input-sm" id="doc-ipt-pwd-1" placeholder="请输入管理员邮箱">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">管理员备注：</div>
          <div class="you">
            <textarea class="" name="mark_up" rows="2" id="doc-ta-1"></textarea>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="you" style="margin-left: 11%;">
              <button type="button" id="btnBack" class="am-btn am-btn-success am-round">返回</button>&nbsp;   &nbsp; <button type="submit" class="am-btn am-btn-secondary am-round">添加</button>
          </div>
        </div>
      </form>
    </div>
<script type="text/javascript">
    $('#btnBack').click(function(event) {
      window.location.href = '/index.php/Admin/Admin/lst';
    });
</script>
<script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/Public/Js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/Js/validate_zh_cn.js"></script>
<script type="text/javascript">
      // 1. 获取表单
    $("#add_form").validate({
        rules:{
            'username':{
                'required':true, // username字段不能为空
                'rangelength':[3,7] // username字段长度
            },
            'password':{
                'required':true, // username字段不能为空
                'rangelength':[5,8] // username字段长度
            },
            'pwd':{
                'required':true,
                'equalTo':'#checkpassword' // equalTo的值是通过jQuery选择器定义的
            },
            'email':{
                'required':true,
                'email':true,
            }
        }
    });
</script>
			<div class="foods">
			      <ul>版权所有@2015</ul>
			      <dl><a href="" title="返回头部" class="am-icon-btn am-icon-arrow-up"></a></dl>  
			</div>
		</div>
	</body>
</html>