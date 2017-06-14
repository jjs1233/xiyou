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
    <title>控制台</title>
    <link type="text/css" rel="stylesheet" href="/xiyou/Public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/xiyou/Public/css/my.css">
    <style type="text/css">
        body{ background: #fff url(/xiyou/Public/images/idx_bg.png) no-repeat; background-size: cover;}
    </style>
</head>
<body>

<div class="container" id="js-container">

    <div class="index-sidebar">
        <ul>
            <li><a href="<?php echo U('growth');?>">成长记录</a></li>
            <li><a href="">交易记录</a></li>
            <li><a href="javascript:void(0)">我的好友</a></li>
            <li><a href="<?php echo U('notice');?>">公告</a></li>
            <li><a href="">注册</a></li>
            <li><a href="">设置</a></li>
            <li><a href="">客服</a></li>
            <li class="pasture"><a href=""><i class="arrow"></i>我的牧场</a></li>
        </ul>
    </div>

    <div class="index-content friend" >
    <table id="demo" class="my_table">
    <span style="font-size: 17px;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我的好友<br>
    当前用户 : <?php echo ($username); ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo U('friend',array('class' => '一级会员'));?>">一级会员</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo U('friend',array('class' => '二级会员'));?>">二级会员</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo U('friend',array('class' => '三级会员'));?>">三级会员</a>
    </span>
        <thead >
            <tr>
                <th>编号</th>
                <th>好友账号</th>
                <th>用户名</th>
                <th>真实姓名</th>
                <th>会员类别</th>
                <th>等级</th>
            </tr>
        </thead>
        <tbody>
                <?php if(is_array($datas)): foreach($datas as $key=>$v): ?><tr>
                <th><?php echo ($key+1); ?></th>
                <th><?php echo ($v['mobile']); ?></th>
                <th><?php echo ($v['user_name']); ?></th>
                <th><?php echo ($v['real_name']); ?></th>
                <th><?php echo ($v['class']); ?></th>
                <th><?php echo ($v['grade']); ?></th>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
        <div class="page">
            <?php $__FOR_START_1580715110__=0;$__FOR_END_1580715110__=$pages;for($i=$__FOR_START_1580715110__;$i < $__FOR_END_1580715110__;$i+=1){ ?><a href="<?php echo U('friend',array('page' => $i+1));?>"><?php echo ($i+1); ?></a><?php } ?>
        </div>
    </div>

    <div class="index-foot ui-flex ui-flex-hv">
        <li></li>
        <li><a href="">注入</a></li>
        <li><a href="">折取</a></li>
        <li><a href="">交易</a></li>
        <li><a href="">申购</a></li>
        <li><a href="">刷新</a></li>
        <li></li>
    </div>

</div>
</body>
</html>