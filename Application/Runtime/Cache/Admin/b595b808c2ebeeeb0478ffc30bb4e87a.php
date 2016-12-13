<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<title>购物商城后台管理系统</title>
<link rel="icon" type="image/png" href="/Public/Admin/assets/i/favicon.png">
<link rel="apple-touch-icon-precomposed" href="/Public/Admin/assets/i/app-icon72x72@2x.png">
<link rel="stylesheet" href="/Public/Admin/assets/css/amazeui.min.css"/>
<link rel="stylesheet" href="/Public/Admin/assets/css/admin.css">
<link rel="stylesheet" href="/Public/Admin/assets/css/font_awesome.css" />
<script src="/Public/Admin/assets/js/jquery.min.js"></script>
<script src="/Public/Admin/assets/js/app.js"></script>
</head>
<body>
<header class="am-topbar admin-header">
  <div class="am-topbar-brand"><img src="/Public/Admin/assets/i/logo.png"></div>
  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav admin-header-list">
      <li class="kuanjie">
       	<a href="<?php echo U('/');?>">首页</a>          
       	<a href="#">奖金管理</a> 
       	<a href="#">订单管理</a>   
       	<a href="#">产品管理</a> 
       	<a href="#">个人中心</a> 
       	<a onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="<?php echo U('Login/logout');?>">退出系统</a>
      </li>
      <li class="am-hide-sm-only" style="float: right;"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a>
      </li>
    </ul>
  </div>
</header>
<div class="am-cf admin-main"> 
<div class="nav-navicon admin-main admin-sidebar">
    
    <div class="sideMenu" style="color:#aeb2b7; margin: 10px 0 0 0;"> <i class="fa fa-cog fa-spin fa-3x fa-fw margin-bottom"></i>欢迎系统管理员：<?php echo session('username');?> 
    </div>

    <div class="sideMenu">
<?php if(is_array($menu_list["auth_info1"])): $i = 0; $__LIST__ = $menu_list["auth_info1"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><h3 class="am-icon-flag"><em></em> <a href="#"><?php echo ($vo1["auth_name"]); ?></a></h3>
      <ul>
        <?php if(is_array($menu_list["auth_info2"])): $i = 0; $__LIST__ = $menu_list["auth_info2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo1["auth_id"] == $vo2["auth_pid"] ): ?><li><a href="/index.php/Admin/<?php echo ($vo2["auth_c"]); ?>/<?php echo ($vo2["auth_a"]); ?>" target="main"><?php echo ($vo2["auth_name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- sideMenu End --> 
    
    <script type="text/javascript">
			jQuery(".sideMenu").slide({
				titCell:"h3", //鼠标触发对象
				targetCell:"ul", //与titCell一一对应，第n个titCell控制第n个targetCell的显示隐藏
				effect:"slideDown", //targetCell下拉效果
				delayTime:300 , //效果时间
				triggerTime:150, //鼠标延迟触发时间（默认150）
				defaultPlay:true,//默认是否执行效果（默认true）
				returnDefault:false //鼠标从.sideMen移走后返回默认状态（默认false）
				});
		</script> 
   
</div>

<div class="admin-content">
<iframe src="info.html" frameborder="0" width="100%" height="100%" name="main"></iframe>
		

</div>

<script src="/Public/Admin/assets/js/amazeui.min.js"></script>

</body>
</html>