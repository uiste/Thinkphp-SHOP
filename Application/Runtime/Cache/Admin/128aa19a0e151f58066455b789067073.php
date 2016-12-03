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
      <ul class="am-icon-users"> 属性管理</ul>
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 &gt; <a href="/index.php/Admin/attribute/lst">属性列表</a></dl>
      
      <dl>
        <button type="button" id="add" class="am-btn am-btn-danger am-round am-btn-xs am-icon-plus"> 添加属性</button>
      </dl>
      <!--这里打开的是新页面-->
    </div>
    <form class="am-form am-g">
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
              <tr class="am-success">
                <th class="table-id">序号</th>
                <th class="table-title">属性名称</th>
                <th class="table-title">商品类型</th>
                <th class="table-title">属性类型</th>
                <th class="table-title">录入方式</th>
                <th class="table-title">可选值</th>
                <th width="150px" class="table-set">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($attrData as $k => $v): ?>
                <tr class="tr1">
                  <td class="td1"><?php echo $v['attr_id'];?></td>
                  <td><?php echo $v['attr_name'];?></td>
                  <td><?php echo $v['type_name'];?></td>
                  <td><?php echo $v['attr_type'] == '1' ? '唯一' : '单选';?></td>
                  <td><?php echo $v['attr_input_type'] == '1' ? '手工' : '列表';?></td>
                  <td><?php echo $v['attr_values'];?></td>
                  <td>    
                        <a href="<?php echo U('Attribute/edt',array('id'=>$v['attr_id'], 'type_id' => I('get.id')),false);?>"><button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="修改"><span class="am-icon-pencil-square-o"></span></button></a>

                        <a href="<?php echo U('Attribute/del',array('id'=>$v['attr_id']),false);?>" onclick="return confirm('确定要删除吗')" ><button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="删除"><span class="am-icon-trash-o"></span></button></a>
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
$('#edit').click(function(){
      console.log($(this).parent().parent().parent().parent('.tr1').find('.td1').text());

});
  $('#add').click(function(){
    // window.location.href = "<?php echo U('User/add');?>";
    // window.location.href = '/index.php/Admin/Type/del/id/' + str;
    window.location.href = '/index.php/Admin/attribute/add';
  });

</script>
 			<div class="foods">
			      <ul>版权所有@2015</ul>
			      <dl><a href="" title="返回头部" class="am-icon-btn am-icon-arrow-up"></a></dl>  
			</div>
		</div>
	</body>
</html>