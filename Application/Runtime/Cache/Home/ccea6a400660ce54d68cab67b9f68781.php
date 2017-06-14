<?php if (!defined('THINK_PATH')) exit();?><html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta http-equiv="cleartype" content="on">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=1,minimal-ui">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <title>登录</title>
    <link type="text/css" rel="stylesheet" href="/xiyou/Public/css/style.css">
    <link type="text/css" rel="stylesheet" href="/xiyou/Public/css/account.css">
</head>
<body>

<div class="container" id="js-container">
    <div class="account-box">
        <h3 class="text-center">西游记之大闹天宫</h3>
        <form action="<?php echo U(check_login);?>" method="post">
            <div class="ui-form">
                <div class="ui-form-group">
                    <div class="label">账 号</div>
                    <div class="input-box"><input type="text" name="username" id="username" value="" placeholder="请输入手机号/用户名" required></div>
                </div>
                <div class="ui-form-group">
                    <div class="label">密 码</div>
                    <div class="input-box"><input type="password" name="password" id="password" value="" placeholder="请输入密码" required></div>
                </div>
            </div>
            <br>
            <div class="clearfix ui-checkbox"><label><input type="checkbox" name="autologin" id="autologin"> 记住密码</label></div>
            <br>
            <div class="clearfix">
                <button class="btn btn-blue btn-block" id="btn-submit">登 录</button>
            </div>
        </form>
    </div>

</div>
</body>
</html>