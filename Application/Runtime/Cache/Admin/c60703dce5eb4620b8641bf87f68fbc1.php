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
<link rel="stylesheet" href="/Public/Admin/assets/css/font_awesome.css" />
<link rel="stylesheet" href="/Public/Admin/assets/css/app.css">
<script src="/Public/Admin/assets/js/jquery.min.js"></script>
<script src="/Public/Admin/assets/js/app.js"></script>
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
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 &gt; <a href="/index.php/Admin/Auth/lst">权限列表</a></dl>
    </div>
  
    <div class="fbneirong">
      <form class="am-form" action="/index.php/Admin/Auth/edt/id/35" method="post">
        <div class="am-form-group am-cf">
          <div class="zuo">权限名称：</div>
          <div class="you">
            <input type="text" name="auth_name" value="<?php echo ($authInfo["auth_name"]); ?>" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入权限名称">
            <input type="hidden" name="auth_id" value="<?php echo ($authInfo["auth_id"]); ?>">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">上级权限：</div>
          <div class="you">
            <select name="auth_pid">
              <option value="0">请选择上级权限</option>
              <?php if(is_array($authData)): $i = 0; $__LIST__ = $authData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!in_array($vo['auth_id'], $authChildList)): ?><option value="<?php echo ($vo["auth_id"]); ?>" <?php echo $authInfo['auth_pid']==$vo['auth_id']?'selected':'' ?> ><?php echo (str_repeat('&emsp;',$vo["level"]*2)); echo ($vo["auth_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">控制器名：</div>
          <div class="you">
            <input type="text" name="auth_c" value="<?php echo ($authInfo["auth_c"]); ?>" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入控制器名">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">权限方法：</div>
          <div class="you">
            <input type="text" name="auth_a" value="<?php echo ($authInfo["auth_a"]); ?>" class="am-input-sm" id="doc-ipt-email-1" placeholder="请再次输入方法名">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">是否显示：</div>
          <div class="you">
            <label class="am-radio-inline"><input type="radio" checked value="1" name="is_show"> 是</label>
            <label class="am-radio-inline"><input type="radio" <?php echo $authInfo['is_show']?'':'checked' ?> value="0" name="is_show"> 否</label>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="you" style="margin-left: 11%;">
              <button type="button" id="btnBack" class="am-btn am-btn-success am-round">返回</button>&nbsp;   &nbsp; <button type="submit" class="am-btn am-btn-secondary am-round">提交</button>
          </div>
        </div>
      </form>
    </div>
<script type="text/javascript">
    $('#btnBack').click(function(event) {
      window.location.href = '/index.php/Admin/Auth/lst';
    });
</script>
			<div class="foods">
			      <ul>版权所有@2015</ul>
			      <dl><a href="" title="返回头部" class="am-icon-btn am-icon-arrow-up"></a></dl>  
			</div>
		</div>
	</body>


<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/Public/Admin/assets/js/polyfill/rem.min.js"></script>
<script src="/Public/Admin/assets/js/polyfill/respond.min.js"></script>
<script src="/Public/Admin/assets/js/amazeui.legacy.js"></script>
<![endif]--> 

<!--[if (gte IE 9)|!(IE)]><!--> 
<script src="/Public/Admin/assets/js/amazeui.min.js"></script>
<!--<![endif]-->

</html>