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
    <title>首页</title>
    <link type="text/css" rel="stylesheet" href="/xiyou/Public/style.css">
    <style type="text/css">
        a{ color: #00a0f8}
        body{ font-size: .3rem}
    </style>
</head>
<body style="text-align: center;">

<div style="">
    <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p>
    <br/>版本 V<?php echo (THINK_VERSION); ?>
</div>

<br>
<p style="color: #00a0f8">登录session状态：</p>
<p>session.user_id : <?php echo (session('user_id')); ?></p>
<p>session.user_name : <?php echo (session('user_name')); ?></p>
<p>session.mobile : <?php echo (session('mobile')); ?></p>

<br><br>
<p>
<a href="<?php echo U('Account/login');?>">登 录</a>
<a href="<?php echo U('Account/register');?>">注 册</a>
<a href="<?php echo U('Account/register');?>">用户后台</a>

    <br>
<a href="<?php echo U('Account/logout');?>">注销帐号</a>

</p>
</body>
</html>