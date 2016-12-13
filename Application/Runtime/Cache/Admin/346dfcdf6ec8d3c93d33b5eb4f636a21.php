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
<!-- <link rel="stylesheet" href="/Public/Admin/assets/css/amazeui.datatables.min.css" /> -->
<link rel="stylesheet" href="/Public/Admin/assets/css/font_awesome.css" />
<link rel="stylesheet" href="/Public/Admin/assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/Public/Lib/lightbox/css/lightbox.css">
<script src="/Public/Admin/assets/js/jquery.min.js"></script>
<script src="/Public/Admin/assets/js/app.js"></script>
<!-- 分页 -->
<style type="text/css">
a.prev{
    border: 1px solid #DDD;
    margin: 4px;
    padding: 4px;
    padding: 0.2em .7em;
    font-weight: 400;
	font-size: 14px;
	text-decoration: none;
}
a.num{
    border: 1px solid #DDD;
    margin: 3px;
    padding: 3px;
    padding: 0.2em .7em;
    font-weight: 400;
	font-size: 14px;
	text-decoration: none;
}
span.current{
    border: 1px solid #0e90d2;
    margin: 4px;
    padding: 4px;
    color: #3E9AFF;
    z-index: 2;
    color: #fff;
    background-color: #0e90d2;
    padding: 0.2em .7em;
}
a.next{
    border: 1px solid #DDD;
    margin: 4px;
    padding: 4px;
    padding: 0.2em .7em;
    text-decoration: none;
}
        </style>
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
                      <input type="text" name="goods_name" id="doc-vld-name-1" minlength="1" placeholder="输入商品名称" class="am-form-field">
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
                      <input type="text" name="goods_price" id="doc-vld-name-1" minlength="1" class="am-form-field" required="">
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
                        <div class="am-form-group">
                            <div class="zuo">
                                发件人：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <select name="type_id" id="type_select">
                                  <option value="0">请选择商品类型</option>
                                  <?php if(is_array($typeData)): $i = 0; $__LIST__ = $typeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type_id"]); ?>"><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div id="attr_container"></div>
                        <!-- <div class="am-form-group">
                            <div class="zuo">
                                发件人：
                            </div>
                            <div class="you" style="max-width: 300px;">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div> -->
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
    // 为单选属性增加一个复制一行的功能 
    // obj代表当前这个DOM元素
    function copy_row(obj) {
        // 先找一下a的父亲，就是一个li 也就是一个属性
        var _cur_li = $(obj).parent();
        console.log(_cur_li);

        if( _cur_li.find('a').html() == '[+]' ){
            var _new_li = _cur_li.clone(); // 新生成的li里面要变成[-]
            _new_li.find('a').html('[-]');
            _cur_li.after(_new_li); // 追加到当前之后

        }else{
            _cur_li.remove();
        }
    }

    // 根据商品类型生成属性框
    $("#type_select").change(function(event) {
        var _type_id = $(this).val();
        if(_type_id == 0){
            $("#attr_container").hide();
        }
        if(_type_id > 0){
            // 执行
            $.ajax({
            
                url: '/index.php/Admin/Goods/getAttr',
                type: 'GET',
                dataType: 'json',
                data:{'type_id' : _type_id},
                success:function(json){
                    if (json==null) {
                        $("#attr_container").hide();
                    }else{
                        $("#attr_container").show();
                    };
                    // 根据返回的信息生成一个属性框
                    // 1. attr_type  为 1 代表是唯一属性 0 代表是单选属性
                    // 2. attr_input_type 1 代表是手工 0 代表是列表
                    // attr_values 是可选值（,分割）
                        var _html = '';
                    // 3. 处理 json [{},{},{}]
                    $.each(json, function(index, val) {
                        // _html += "<li>";
                        _html += '<div class="am-form-group">';
                        // 4. 判断是单选属性 [+]
                        if(val['attr_type'] == 0){
                            // <li><a>[+]</>颜色:<input type><li>
                            _html += "<a href='javascript:;' onclick='copy_row(this);'>[+]</a>";
                        }
                        // 5. 拼属性名称
                        _html += '<div class="zuo">' + val['attr_name'] + '：</div>';
                        // 右侧的
                        _html += '<div class="you" style="max-width: 300px;">'; // [+]颜色:

                        // 6. 判断是否是手工还是列表
                        if(val['attr_input_type'] == 0){
                            // 7. 列表 看可选值 "红色,绿色,金色"
                            var _val = val['attr_values'].split(','); // ['红色', '绿色', '金色']
                            _html += "<select name='goods_attr[" + val['attr_id'] + "][]'>";
                                // 8. 可选项
                                $.each(_val, function(idex1, val1) {
                                    _html += "<option value='" + val1 + "'>" + val1 + "</option>";
                                });
                            _html += "</select>";
                        }else{
                            // 9. 手工
                            _html += "<input type='text' name='goods_attr[" + val['attr_id'] + "][]'/>";
                        }

                        _html += "</div></div>";
                    });         
                    $("#attr_container").html(_html).parent().show();
                    // console.log(_html);
                }
            });

        }
    });
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