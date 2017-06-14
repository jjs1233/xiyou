<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分类列表</title>

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
    
    <div class="row">
        <div class="col-md-6">
            <a href="<?php echo U('friend/add');?>" class="btn btn-success">添加朋友</a>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>编号</th>
                <th>主人账号</th>
                <th>主人用户名</th>
                <th>主人姓名</th>
                <th>朋友账号</th>
                <th>朋友用户名</th>
                <th>朋友姓名</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($model)): foreach($model as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v['master']['mobile']); ?></td>
                <td><?php echo ($v['master']['user_name']); ?></td>
                <td><?php echo ($v['master']['real_name']); ?></td>
                <td><?php echo ($v['friend']['mobile']); ?></td>
                <td><?php echo ($v['friend']['user_name']); ?></td>
                <td><?php echo ($v['friend']['real_name']); ?></td>
                <td><a href="<?php echo U('friend/update',array('id'=>$v['id']));?>">编辑</a> | <a href="<?php echo U('friend/delete',array('id'=>$v['id']));?>" style="color:red;" onclick="javascript:return del('您真的确定要删除吗？\n\n删除后将不能恢复!');">删除</a></td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
    <?php echo ($page); ?>
</div>


<!-- JavaScript -->
<script src="/xiyou/Application/Admin/View//Public/static/js/jquery-1.10.2.js"></script>
<script src="/xiyou/Application/Admin/View//Public/static/js/bootstrap.js"></script>
<script src="/xiyou/Application/Admin/View//Public/static/js/app.js"></script>

</body>
</html>