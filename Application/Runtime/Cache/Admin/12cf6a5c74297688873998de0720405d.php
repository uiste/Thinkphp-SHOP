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
    <div class="listbiaoti am-cf">
        <ul class="am-icon-flag on">
            栏目名称
        </ul>
        <dl class="am-icon-home" style="float: right;">
            当前位置： 首页 &gt;
            <a href="<?php echo U('lst');?>">
                商品列表
            </a>
        </dl>
        <dl>
            <button type="button" id="add" class="am-btn am-btn-danger am-round am-btn-xs am-icon-plus">
                添加商品
            </button>
        </dl>
    </div>
    <div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">
        <form action="/index.php/Admin/Goods/lst?gn=&ob=goods_id&ow=asc" method="get" id="searchForm">
            <ul>
                <li style="margin-right: 0;">
                    <span class="tubiao am-icon-calendar">
                    </span>
                    <input type="text" class="am-form-field am-input-sm am-input-zm  am-icon-calendar"
                    placeholder="添加日期" data-am-datepicker="{theme: 'success',}">
                </li>
                <li>
                    <input type="text" name="gn" value="<?php echo ($_GET['gn']); ?>" class="am-form-field am-input-sm am-input-xm" placeholder="请输入产品名称">
                </li>
                <li>
                    <input type="radio" name="ob" value="goods_id" checked>编号
                </li>
                <li>
                    <input type="radio" name="ob" value="goods_price" <?php echo I('get.ob')=='goods_price'?'checked':'' ?> >价格
                </li>
                <li>|</li>
                <li>
                    <input type="radio" name="ow" value="desc" checked>降序
                </li>
                <li>
                    <input type="radio" name="ow" value="asc" <?php echo I('get.ow')=='asc'?'checked':'' ?> >升序
                </li>

                <li>
                    <button type="submit" class="am-btn am-radius am-btn-xs am-btn-success"
                    style="margin-top: -1px;">
                        搜索
                    </button>
                </li>
            </ul>
        </form>
    </div>
    <form class="am-form am-g">
        <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
                <tr class="am-success">
                    <th class="table-check"><input type="checkbox"></th>
                    <th class="table-id">排序</th>
                    <th class="table-id">编号</th>
                    <th class="table-title">商品名称</th>
                    <th class="table-type">商品货号</th>
                    <th class="table-price">商品价格</th>
                    <th class="table-type">商品类别</th>
                    <th class="table-type">商品描述</th>
                    <th class="table-type">商品图片</th>
                    <th class="table-author am-hide-sm-only"  style="text-align: center;" >上架/下架</th>
                    <th class="table-date am-hide-sm-only" style="text-align: center;" >添加日期</th>
                    <th width="163px" class="table-set" style="text-align: center;" >操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($goodsData)): $i = 0; $__LIST__ = $goodsData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>
                            <input type="text" class="am-form-field am-radius am-input-sm">
                        </td>
                        <td><?php echo ($vo["goods_id"]); ?></td>
                        <td><?php echo ($vo["goods_name"]); ?></td>
                        <td><?php echo ($vo["goods_sn"]); ?></td>
                        <td><?php echo ($vo["goods_price"]); ?></td>
                        <td><?php echo ($vo["cate_name"]); ?></td>
                        <td><?php echo ($vo["goods_descp"]); ?></td>
                        <td><a href="<?php echo C('VIEW_ROOT_PATH') . $vo['goods_img']; ?>" data-lightbox='renyizhi' ><img src="<?php echo C('VIEW_ROOT_PATH') . $vo['goods_thumb']; ?>"></a></td>
                        <td class="am-hide-sm-only"  style="text-align: center;" >
                        <?php  if ($vo['is_sale']) { echo '<i class="am-icon-check am-text-warning">'; }else{ echo '<i class="am-icon-close am-text-primary"></i>'; } ?> 
                        </td>
                        <td class="am-hide-sm-only" style="text-align: center;" ><?php echo (date('Y-m-d',$vo["add_time"])); ?></td>
                        <td >
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    
                                    <a href="#"><button class="am-btn am-btn-default am-btn-xs am-text-success am-round" title="查看"><span class="am-icon-search"></span></button></a>

                                    <a href="/index.php/Admin/Goods/edt/id/<?php echo $vo['goods_id'] ?>"><button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="修改"><span class="am-icon-pencil-square-o"></span></button></a>

                                    <!-- <a href="<?php ?>" onclick="return confirm('确定要删除吗')" ><button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="删除"><span class="am-icon-trash-o"></span></button></a> -->
                                    <a href="javascript:;?>" class="del" goods_id="<?php echo $vo['goods_id']; ?>" onclick="return confirm('确定要删除吗')" ><button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="删除"><span class="am-icon-trash-o"></span></button></a>
                                </div>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="am-btn-group am-btn-group-xs">
            <button type="button" class="am-btn am-btn-default">
                <span class="am-icon-save">
                </span>
                上架
            </button>
            <button type="button" class="am-btn am-btn-default">
                <span class="am-icon-save">
                </span>
                下架
            </button>
            <button type="button" class="am-btn am-btn-default">
                <span class="am-icon-save">
                </span>
                保存
            </button>
            <button type="button" class="am-btn am-btn-default">
                <span class="am-icon-trash-o">
                </span>
                删除
            </button>
        </div>
        <ul class="am-pagination am-fr">
            <?php echo ($show); ?>
        </ul>
        <hr>
        <p>
            注：拓展小功能暂未添加，敬请期待
        </p>
    </form>
<script type="text/javascript" src="/Public/Lib/lightbox/lightbox-plus-jquery.js"></script>
<script type="text/javascript">
// 动态搜索
$("input[name='gn']").blur(function(){
    var gn = $.trim( $(this).val() );
    if (gn == '') {return false}; // 如果是空字符串就不进行刷新

    // 失去焦点的链接地址处理
    var _href = window.location.href;
    console.log(_href)
    var reg = /p\/[0-9]+\.html/g;
    var _new_href = _href.replace(reg, '');
    console.log(_new_href)
    _new_href += 'gn/' +gn;
    window.location.href = _new_href;
    
})
// js动态排序
$("input[type='radio']").click(function(event) {
    var _val = $(this).val();
    $('#searchForm').submit();
});
$('.del').click(function(){
    _aaa = $(this);
    var _goods_id = _aaa.attr('goods_id')
    $.ajax({
    
        url: '/index.php/Admin/Goods/del/id/' + _goods_id,
        type: 'GET',
        dataType: 'json',
        success:function(json){
            alert(json.msg)
            _aaa.parent().parent().parent().parent().remove();
        }
    });
})
  $('#add').click(function(){
    window.location.href = '/index.php/Admin/Goods/add';
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