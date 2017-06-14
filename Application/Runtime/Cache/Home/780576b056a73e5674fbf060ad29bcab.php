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
            <li><a href="javascript:void(0)">成长记录</a></li>
            <li><a href="">交易记录</a></li>
            <li><a href="<?php echo U('friend');?>">我的好友</a></li>
            <li><a href="<?php echo U('notice');?>">公告</a></li>
            <li><a href="">注册</a></li>
            <li><a href="">设置</a></li>
            <li><a href="">客服</a></li>
            <li class="pasture"><a href=""><i class="arrow"></i>我的牧场</a></li>
        </ul>
    </div>

    <div class="index-content friend" >
    <table id="demo" class="my_table">
    成长记录
    <span style="font-size: 17px;">当前用户 : <?php echo ($username); ?></span>&nbsp;&nbsp;&nbsp;
    <span style="font-size: 17px;">账号 : <?php echo ($mobile); ?></span>
        <thead>
            <tr>
                <th>金钱</th>
                <th>灵气</th>
                <th>百分比</th>
                <th>变化</th>
                <th>日期</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datas as $k => $v) { if($k > 0){ $change = $v['money'] - $datas[$k-1]['money']; $percent = $change / $datas[$k-1]['money']; }else{ $percent = "0"; $change = 0; } echo "<tr><th>".$v['money']."</th><th>".$v['soul']."</th><th>".sprintf("%.2f", $percent*100)."%"."</th><th>".$change."</th><th>".date('Y-m-d',strtotime($v['date']))."</th></tr>"; } ?>
        </tbody>
    </table>
        <div class="page">
            <?php $__FOR_START_482944932__=0;$__FOR_END_482944932__=$pages;for($i=$__FOR_START_482944932__;$i < $__FOR_END_482944932__;$i+=1){ ?><a href="<?php echo U('growth',array('page' => $i+1));?>"><?php echo ($i+1); ?></a><?php } ?>
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