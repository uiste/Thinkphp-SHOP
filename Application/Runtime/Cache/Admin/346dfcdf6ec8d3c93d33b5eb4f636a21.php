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
  <form class="am-form" action="/index.php/Admin/Goods/add" method="post" enctype="multipart/form-data">
    <div class="listbiaoti am-cf">
        <ul class="am-icon-flag on">
            商品管理
        </ul>
        <dl class="am-icon-home" style="float: right;">
            当前位置： 首页 &gt;
            <a href="#">
                添加商品
            </a>
        </dl>
    </div>
    <div class="am-tabs am-margin" data-am-tabs="">
        <ul class="am-tabs-nav am-nav am-nav-tabs">
            <li class="am-active">
                <a href="#tab1">
                    通用信息
                </a>
            </li>
            <li class="">
                <a href="#tab2">
                    详细描述
                </a>
            </li>
            <li class="">
                <a href="#tab3">
                    商品属性
                </a>
            </li>
            <li class="">
                <a href="#tab4">
                    商品相册
                </a>
            </li>
            <li class="">
                <a href="#tab5">
                    其他信息
                </a>
            </li>
        </ul>
        <div class="am-tabs-bd" style="touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
            <div class="am-tab-panel am-fade am-active am-in" id="tab1">
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      商品名称
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <input type="text" name="goods_name" id="doc-vld-name-1" minlength="3" placeholder="输入商品名称" class="am-form-field">
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      商品货号
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <input type="text" name="goods_sn" id="doc-vld-name-1" placeholder="输入商品货号，如果您不输入系统会自动生成一个唯一货号" class="am-form-field" >
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      所属栏目
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <select name="cate_id">
                          <option value="0">请选择商品类型</option>
                          <?php if(is_array($cateData)): $i = 0; $__LIST__ = $cateData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cate_id"]); ?>"><?php echo str_repeat('&nbsp;',$vo['level']*5); echo ($vo["cate_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      商品库存
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <input type="text" name="goods_number" id="doc-vld-name-1" class="am-form-field" required="">
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      商品价格
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <input type="text" name="goods_price" id="doc-vld-name-1" minlength="3" pattern="^[0-9]+$" class="am-form-field" required="">
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      是否上架
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <label class="am-radio-inline"><input type="radio" checked value="1" name="is_sale"> 是</label>
                      <label class="am-radio-inline"><input type="radio" value="1" name="is_sale"> 否</label>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      是否新品
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <label class="am-radio-inline"><input type="radio" checked value="1" name="is_new"> 是</label>
                      <label class="am-radio-inline"><input type="radio" value="1" name="is_new"> 否</label>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      是否精品
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <label class="am-radio-inline"><input type="radio" checked value="1" name="is_best"> 是</label>
                      <label class="am-radio-inline"><input type="radio" value="1" name="is_best"> 否</label>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      是否热销
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <label class="am-radio-inline"><input type="radio" checked value="1" name="is_hot"> 是</label>
                      <label class="am-radio-inline"><input type="radio" value="1" name="is_hot"> 否</label>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      添加时间
                    </div>
                    <div class="you" style="width: 40%;float:left;margin-left:20px;">
                      <input type="text" id="demo" name="add_time" placeholder="请点击选择添加时间" class="am-form-field" >
                    </div>
                </div>
            </div>
            <div class="am-tab-panel am-fade" id="tab2">
                    <div class="am-g am-margin-top">
                    <!-- <div class="am-u-sm-4 am-u-md-2 am-text-right">
                      描述<textarea name="goods_descp" rows="5" id="doc-ta-1"></textarea>
                    </div> -->
                    <div class="you" style="width: 100%;float:left;margin:0 20px;">
                      <script id="editor" name="goods_descp" type="text/plain" style="width:100%;height:500px;"></script>
                    </div>
                </div>
            </div>
            <div class="am-tab-panel am-fade" id="tab3">
                    <div class="xitong">
                        <div class="am-alert am-alert-success" data-am-alert="">
                            <p>
                                发件箱设置（站内所有邮件均由此邮箱发送，如会员密码找回邮件等）
                            </p>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                                发件人：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                                邮箱账号：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                                邮箱密码：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                                SMTP：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                                发送端口：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                                发送方式：
                            </div>
                            <div class="you" style="margin-top: 4px;">
                                <label class="am-radio-inline">
                                    <input type="radio" value="" name="docInlineRadio">
                                    SSL服务方式
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="docInlineRadio">
                                    TLS服务方式
                                </label>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">
                            </div>
                            <div class="you" style="margin-top: 4px;">
                                测试发送状态
                                <br>
                                <br>
                                <button type="button" class="am-btn am-btn-success  am-radius am-btn-sm">
                                    保存选择
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="am-tab-panel am-fade" id="tab4">
                    <div class="am-g am-margin-top-sm">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            商品图片
                        </div>
                        <div class="am-u-sm-8 am-u-md-4 am-u-end">
                            <input type="file" class="am-input-sm" name="goods_img">
                        </div>
                    </div>
            </div>
            <div class="am-tab-panel am-fade" id="tab5">
                    <div class="am-g am-margin-top-sm">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            SEO 标题
                        </div>
                        <div class="am-u-sm-8 am-u-md-4 am-u-end">
                            <input type="text" class="am-input-sm">
                        </div>
                    </div>
                    <div class="am-g am-margin-top-sm">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            SEO 关键字
                        </div>
                        <div class="am-u-sm-8 am-u-md-4 am-u-end">
                            <input type="text" class="am-input-sm">
                        </div>
                    </div>
                    <div class="am-g am-margin-top-sm">
                        <div class="am-u-sm-4 am-u-md-2 am-text-right">
                            SEO 描述
                        </div>
                        <div class="am-u-sm-8 am-u-md-4 am-u-end">
                            <textarea rows="4">
                            </textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="am-margin">
        <button type="submit" class="am-btn am-btn-success am-radius ">
            提交保存
        </button>
        <button type="button" class="am-btn am-btn-primary am-radius ">
            放弃保存
        </button>
    </div>
  </form>
</div>
<script type="text/javascript" src="/Public/Js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/Js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/Public/Js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/Public/Js/laydate.js"></script>
<script type="text/javascript">
    // ueditor编辑器
    var ue = UE.getEditor('editor');

    $('#btnBack').click(function(event) {
      window.location.href = '/index.php/Admin/Goods/lst';
    });

  laydate({
            elem: '#demo',
            istime: true,
            format: 'YYYY-MM-DD hh:mm:ss',
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