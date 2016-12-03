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
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 &gt; <a href="/index.php/Admin/Role/lst">角色列表</a></dl>
    </div>
	
    <div class="fbneirong">
      <form class="am-form" action="/index.php/Admin/Role/add" method="post">
        <div class="am-form-group am-cf">
          <div class="zuo">角色名称：</div>
          <div class="you">
            <input type="text" name="role_name" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入角色名称">
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">权限分配：</div>
          <div class="you">
          <table class="am-table am-table-bordered am-table-striped">
             <thead>
                <tr>
                   <th style="width:160px;text-align: center;">顶级权限</th>
                   <th style="text-align: center;">子级权限</th>
                </tr>
             </thead>
             <tbody>
               <?php if(is_array($authData)): $i = 0; $__LIST__ = $authData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if($vo1["auth_pid"] == 0): ?><tr>
                     <td style="text-align: center;"><label class="am-checkbox-inline"><input type="checkbox" name="role_auth_ids[]" value="<?php echo ($vo1["auth_id"]); ?>"><?php echo ($vo1["auth_name"]); ?></label></td>
                     <td>
                    <?php if(is_array($authData)): $i = 0; $__LIST__ = $authData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2["auth_pid"] == $vo1["auth_id"] ): ?><label class="am-checkbox-inline"><input type="checkbox" name="role_auth_ids[]" value="<?php echo ($vo2["auth_id"]); ?>"><?php echo ($vo2["auth_name"]); ?></label><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </td>
                  </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
             </tbody>
            </table>
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
      window.location.href = '/index.php/Admin/Role/lst';
    });
</script>
			<div class="foods">
			      <ul>版权所有@2015</ul>
			      <dl><a href="" title="返回头部" class="am-icon-btn am-icon-arrow-up"></a></dl>  
			</div>
		</div>
	</body>
</html>