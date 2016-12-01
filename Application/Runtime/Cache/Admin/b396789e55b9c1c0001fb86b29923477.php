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

<div class="daohang">
      <ul>
        <li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs"> 首页 </li>
        <li><button type="button" class="am-btn am-btn-default am-radius am-btn-xs">帮助中心<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close="">×</a></button></li> 
      </ul>
</div>
  
<div class="admin">
    <div class="admin-index">
        <dl data-am-scrollspy="{animation: 'slide-right', delay: 100}" class="am-scrollspy-init am-scrollspy-inview am-animation-slide-right">
            <dt class="qs"><i class="am-icon-users"></i></dt>
            <dd>455</dd>
            <dd class="f12">团队数量</dd>
        </dl>
        <dl data-am-scrollspy="{animation: 'slide-right', delay: 300}" class="am-scrollspy-init am-scrollspy-inview am-animation-slide-right">
            <dt class="cs"><i class="am-icon-area-chart"></i></dt>
            <dd>455</dd>
            <dd class="f12">今日收入</dd>
        </dl>
        <dl data-am-scrollspy="{animation: 'slide-right', delay: 600}" class="am-scrollspy-init am-scrollspy-inview am-animation-slide-right">
            <dt class="hs"><i class="am-icon-shopping-cart"></i></dt>
            <dd>455</dd>
            <dd class="f12">商品数量</dd>
        </dl>
        <dl data-am-scrollspy="{animation: 'slide-right', delay: 900}" class="am-scrollspy-init am-scrollspy-inview am-animation-slide-right">
            <dt class="ls"><i class="am-icon-cny"></i></dt>
            <dd>455</dd>
            <dd class="f12">全部收入</dd>
        </dl>
    </div>
			<div class="foods">
			      <ul>版权所有@2015</ul>
			      <dl><a href="" title="返回头部" class="am-icon-btn am-icon-arrow-up"></a></dl>  
			</div>
		</div>
	</body>
</html>