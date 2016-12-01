<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加管理员</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        <style type="text/css">
            label.error{
                border: 1px solid #CCC;
                margin-left:4px;
                padding: 4px;
                color: red; 
                font-size: 16px;
                background: #DDD;
            }
        </style>
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：管理员管理-》添加管理员信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/Admin/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
        <!-- 提交地址 /index.php/Admin/Admin/add 代表当前地址 | 为空的时候也是代表当前的地址-->
            <form action="/index.php/Admin/Admin/add" method="post" enctype="multipart/form-data" id="add_form" class="add_form">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>管理员名称</td>
                    <td><input type="text" name="username" /></td>
                </tr>
                
                <tr>
                    <td>管理员密码</td>
                    <td><input type="password" name="password" id="checkpassword" class="chkpwd" /></td>
                </tr>
                 <tr>
                    <td>管理员确认密码</td>
                    <td><input type="password" name="pwd" /></td>
                </tr>
                <tr>
                    <td>管理员邮箱</td>
                    <td><input type="text" name="email" /></td>
                </tr>
                <tr>
                    <td>管理员备注</td>
                    <td>
                        <textarea name="mark_up" cols="40" rows="5"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
<!-- js引入 -->
<script type="text/javascript" src="/Public/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/Public/Js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/Js/validate_zh_cn.js"></script>
<script type="text/javascript">
    // 1. 获取表单
    $("#add_form").validate({
        rules:{
            'username':{
                'required':true, // username字段不能为空
                'rangelength':[3,7] // username字段长度
            },
            'password':{
                'required':true, // username字段不能为空
                'rangelength':[5,8] // username字段长度
            },
            'pwd':{
                'required':true,
                'equalTo':'#checkpassword' // equalTo的值是通过jQuery选择器定义的
            },
            'email':{
                'required':true,
                'email':true,
            }
        }
    });
</script>
</html>