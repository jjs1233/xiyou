<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>管理员登录 - <?php echo C('Site.Title');?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" href="/xiyou/Static/System/Css/auth.min.css"/>
</head>
<body>


<div class="content">
	<div class="right">
    	<form method="post" action="">
            <h3>用户登录</h3>
            <input class="username" name="username" type="text" placeholder="用户名" required>
            <input class="password" name="password" type="password" placeholder="密码" required>
            <div class="bottons">
                <input type="submit" value="登 录" class="subdata">
            </div>
        </form>
    </div>
</div>
<footer>
</footer>


</body>
</html>