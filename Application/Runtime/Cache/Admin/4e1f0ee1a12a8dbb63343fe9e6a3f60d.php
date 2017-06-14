<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加分类</title>

    <!-- Bootstrap core CSS -->
    <link href="/xiyou/Application/Admin/View//Public/static/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="/xiyou/Application/Admin/View//Public/static/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="/xiyou/Application/Admin/View//Public/static/font-awesome/css/font-awesome.min.css">
</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo U('index/index');?>">管理后台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo U('index/index');?>"><i class="fa fa-dashboard"></i> 仪表盘</a></li>
    <li class="dropdown">
        <a href="<?php echo U('user/index');?>"><i class="fa fa-reorder"></i> 用户管理</a>
    </li>
    <li class="dropdown">
        <a href="<?php echo U('notice/index');?>"><i class="fa fa-edit"></i> 公告管理</a>
    </li>
    <li class="dropdown">
        <a href="<?php echo U('growth/index');?>"><i class="fa fa-file-text-o"></i> 成长管理 </a>
    </li>
    <li class="dropdown">
        <a href="<?php echo U('friend/index');?>"><i class="fa fa-file-text-o"></i> 好友管理 </a>
    </li>
</ul>

            <ul class="nav navbar-nav navbar-right navbar-user">

                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 你好,<?php echo session('username');?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-gear"></i> 设置</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('login/logout');?>"><i class="fa fa-power-off"></i> 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
<div id="page-wrapper">
    <form method="post" action="<?php echo U('user/add');?>">
        <div class="form-group">
            <label for="aa">账号</label>
            <input type="text" name="mobile" class="form-control" id="aa" placeholder="输入账号">
        </div>
        <div class="form-group">
            <label for="aa">请输入密码</label>
            <input type="text" name="password" class="form-control" id="aa" placeholder="输入新密码">
        </div>
        <div class="form-group">
            <label for="aa">确认密码</label>
            <input type="text" name="re_password" class="form-control" id="aa" placeholder="确认密码">
        </div>
        <div class="form-group">
            <label for="aa">用户名</label>
            <input type="text" name="user_name" class="form-control" id="aa" placeholder="输入用户名">
        </div>
        <div class="form-group">
            <label for="aa">真实姓名</label>
            <input type="text" name="real_name" class="form-control" id="aa" placeholder="输入真实姓名">
        </div>

        <div class="form-group">
            <label for="aa">性别</label>
            <select name="sex" id="bb" class="form-control">
                <option value="0">未知</option>
                <option value="1">男</option>
                <option value="2">女</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bb">会员类别</label>
            <select name="class" id="bb" class="form-control">
                <option value="一级会员">一级会员</option>
                <option value="二级会员">二级会员</option>
                <option value="三级会员">三级会员</option>
            </select>
        </div>

        <div class="form-group">
            <label for="cc">等级</label>
            <input type="text" name="grade" class="form-control" id="cc" placeholder="输入等级 默认0">
        </div>

        <button type="submit" class="btn btn-default">添加</button>
    </form>
</div>
<!-- JavaScript -->
<script src="/xiyou/Application/Admin/View//Public/static/js/jquery-1.10.2.js"></script>
<script src="/xiyou/Application/Admin/View//Public/static/js/bootstrap.js"></script>
<script src="/xiyou/Application/Admin/View//Public/static/js/app.js"></script>

</body>
</html>