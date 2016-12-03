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
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 &gt; <a href="/index.php/Admin/Attribute/lst">属性列表</a></dl>
    </div>
	
    <div class="fbneirong">
      <form class="am-form" action="/index.php/Admin/attribute/add" method="post">
        <div class="am-form-group am-cf">
          <div class="zuo">属性名称：</div>
          <div class="you">
            <input type="text" name="attr_name" id="doc-vld-name" minlength="2" placeholder="输入属性名称" class="am-form-field" required/>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">商品类型：</div>
          <div class="you">
            <select name="type_id">
              <option value="0">请选择商品类型</option>
              <?php if(is_array($typeData)): $i = 0; $__LIST__ = $typeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">属性类型</div>
          <div class="you">
            <label class="am-radio-inline"><input type="radio" checked value="1" name="attr_type"> 唯一</label>
            <label class="am-radio-inline"><input type="radio" value="0" name="attr_type"> 单选</label>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">录入方式</div>
          <div class="you">
            <label class="am-radio-inline"><input type="radio" checked value="1" name="attr_input_type"> 手工</label>
            <label class="am-radio-inline"><input type="radio" value="0" name="attr_input_type"> 列表</label>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">可选值：</div>
          <div class="you">
          <textarea id="doc-vld-ta-1" name="attr_values" disabled="disabled" minlength="4" maxlength="100" placeholder="请输入属性可选值，使用英文逗号分隔"></textarea>
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
      window.location.href = '/index.php/Admin/Attribute/lst';
    });
    // 属性可选值优化
    $("input[name='attr_input_type']").click(function(){
        var attr_input_type_value = $(this).val();
        if (attr_input_type_value==1) {
          $('#doc-vld-ta-1').attr('disabled', true);
        }else{
          $('#doc-vld-ta-1').attr('disabled', false);
        };
    })
</script>
			<div class="foods">
			      <ul>版权所有@2015</ul>
			      <dl><a href="" title="返回头部" class="am-icon-btn am-icon-arrow-up"></a></dl>  
			</div>
		</div>
	</body>
</html>