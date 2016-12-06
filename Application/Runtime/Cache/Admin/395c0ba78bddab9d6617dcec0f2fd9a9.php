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
<style type="text/css">
  td,th{text-align: center;}
</style>
<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-users"> 栏目管理</ul>
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 &gt; <a href="/index.php/Admin/Category/lst">栏目列表</a></dl>
      
      <dl>
        <button type="button" id="add" class="am-btn am-btn-danger am-round am-btn-xs am-icon-plus"> 添加栏目</button>
      </dl>
      <!--这里打开的是新页面-->
    </div>
    <form class="am-form am-g" >
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped" id="event_table">
            <thead>
              <tr class="am-success">
                <th class="table-id">序号</th>
                <th class="table-title">栏目名称</th>
                <th width="130px" class="table-set">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cateData as $k => $v): ?>
                <tr class="tr1">
                  <td class="td1"><?php echo $v['cate_id'];?></td>
                  <td><?php echo str_repeat('&emsp;&emsp;&emsp;&emsp;', $v['level']),$v['cate_name'];?></td>
                  <td>    
                        <a href="/index.php/Admin/Category/edt/id/<?php echo $v['cate_id'] ?>"><button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="修改"><span class="am-icon-pencil-square-o"></span></button></a>
                        <button onclick="return confirm('确定要删除吗')" id="del1" cate_id="<?php echo $v['cate_id']; ?>" type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="删除"><span id="del2" class="am-icon-trash-o"></span></button>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <ul class="am-pagination am-fr">
                <li class="am-disabled"><a href="#">«</a></li>
                <li class="am-active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
              </ul>
          <hr>
    </form>
<script type="text/javascript">
/**********事件委托完成AJAX删除************/
// event事件对象，target触发此事件的目标节点
  $('#event_table').click(function(event){
        var _target = $(event.target);
        var _class = _target.attr('id');
        if (_class == 'del1' || _class == 'del2') {
            var cate_id = _class == 'del1' ? _target.attr('cate_id') : _target.parent().attr('cate_id')
            $.ajax({
              url: '/index.php/Admin/Category/ajaxDel/id/' + cate_id,
              type: 'GET',
              dataType: 'json',
              success:function(json){
                if (json.sign == 1) {
                  // alert(json.msg)
                  _class == 'del1' ? _target.parent().parent().remove() : ''
                  _class == 'del2' ? _target.parent().parent().parent().remove() : ''
                }else{
                  // alert(json.msg)
                }
              }
            });
        };
  });
  $('#add').click(function(){
    // window.location.href = "<?php echo U('User/add');?>";
    // window.location.href = '/index.php/Admin/Category/del/id/' + str;
    window.location.href = '/index.php/Admin/Category/add';
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