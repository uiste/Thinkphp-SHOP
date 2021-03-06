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
<!-- <script src="/Public/Admin/assets/js/jquery.min.js"></script> -->
<script src="http://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="/Public/Admin/assets/js/app.js"></script>

<!-- 引入封装了failback的接口--initGeetest -->
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<style type="text/css">
    .inp {
        border: 1px solid gray;
        padding: 0 10px;
        width: 200px;
        height: 30px;
        font-size: 18px;
    }
    .btn {
        border: 1px solid gray;
        width: 100px;
        height: 30px;
        font-size: 18px;
        cursor: pointer;
    }
    #embed-captcha {
        width: 300px;
        margin: 0 auto;
    }
    .show {
        display: block;
    }
    .hide {
        display: none;
    }
    #notice {
        color: red;
        text-align: center;
    }
</style>
</head>
<body>
<body data-type="login" class="theme-black">
    <div class="am-g tpl-g">
        <div class="tpl-login">
            <div class="tpl-login-content">
                <!-- 后台logo -->
                <!-- <div class="tpl-login-logo" style="background: url(/Public/Admin/assets/img/logo.png) center no-repeat;"> -->
                <div class="popup">
                    <div class="am-form tpl-form-line-form">
                        <div class="am-form-group">
                            <input id="username" name="username" type="text" class="tpl-form-input" placeholder="请输入账号">
                        </div>
                        <div class="am-form-group">
                            <input id="password" name="password" type="password" class="tpl-form-input" placeholder="请输入密码">
                        </div>
                        <!-- Thinkphp验证码 -->
                        <!-- <div class="am-form-group">
                            <input type="text" class="tpl-form-input" id="code" name="code" placeholder="请输入验证码">
                            <img class="am-round" alt="140*140" src="<?php ?>" width="300" height="60" onclick="this.src='/index.php/Admin/Login/code/' + Math.random();"/>
                        </div> -->
                        <div class="am-form-group tpl-login-remember-me">
                            <input id="remember-me" type="checkbox">
                            <label for="remember-me">
                            记住密码
                             </label>
                        </div>
                        <!-- geektest验证码 -->
                        <div id="popup-captcha"></div>
                        <div class="am-form-group">
                        <!-- <input class="btn" id="popup-submit" type="submit" value="提交"> -->
                            <input type="submit" id="popup-submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn" value="提交">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var handlerPopup = function (captchaObj) {
        // 成功的回调
        captchaObj.onSuccess(function () {
            var validate = captchaObj.getValidate();
            $.ajax({
                url: "/index.php/Admin/Login/login", // 进行二次验证
                type: "post",
                dataType: "json",
                data: {
                    type: "pc",
                    username: $('#username').val(),
                    password: $('#password').val(),
                    geetest_challenge: validate.geetest_challenge,
                    geetest_validate: validate.geetest_validate,
                    geetest_seccode: validate.geetest_seccode
                },
                success: function (data) {
                    // console.log(data);
                    if (data && (data.status == "success")) {
                        window.location.href = '/index.php/Admin/Index/index'
                    } else {
                        alert(data.msg)
                    }
                }
            });
        });
        $("#popup-submit").click(function () {
            captchaObj.show();
        });
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#popup-captcha");
        // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
    };
    // 验证开始需要向网站主后台获取id，challenge，success（是否启用failback）
    $.ajax({
        url: "/Public/Lib/gtcode/web/StartCaptchaServlet.php?type=pc&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "popup", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerPopup);
        }
    });
</script>
</html>