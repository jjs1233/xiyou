<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <title>网站设置 - <?php echo C('Site.Title');?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="/xiyou/Static/System/Css/amazeui.min.css"/>
  <link rel="stylesheet" href="/xiyou/Static/System/Css/system.min.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <a href="<?php echo U('/Index/index');?>">
  <div class="am-topbar-brand">
    <strong>奇迹大陆</strong> <small>管理后台</small>
  </div>
  </a>


  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> <?php echo ($ThisUser['username']); ?> <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="<?php echo U('Set/password');?>"><span class="am-icon-user"></span> 修改密码</a></li>
          <li><a href="<?php echo U('Base/out');?>"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- nav start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar" id="left_nav" style="min-height:500px;">
      <ul class="am-list admin-sidebar-list">
        <li><a href="<?php echo U('Index/index');?>"><span class="am-icon-home"></span> 管理首页</a></li>
        
        <li class="admin-parent">
          <a href="javascript:;"  class="am-cf am-collapsed" data-am-collapse="{target: '#collapse-system'}"><span class="am-icon-wrench"></span> 系统设置 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub <?php if(CONTROLLER_NAME == 'Set'): ?>am-in<?php endif; ?> " id="collapse-system">
        <?php if($ThisUser['agent'] == 0): ?><li <?php if(CONTROLLER_NAME == 'site'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Set/site');?>" class="am-cf"><span class="am-icon-plug"></span> 网站设置</a></li><?php endif; ?>
            <li><a href="<?php echo U('Set/password');?>"><span class="am-icon-puzzle-piece"></span> 密码设置</a></li>
          </ul>
        </li>
        
       
        
        <?php if($ThisUser['agent'] == 0): ?><li><a href="<?php echo U('Agent/text');?>"><span class="am-icon-tasks"></span> 客服管理</a></li><?php endif; ?>

        <?php if($ThisUser['agent'] == 0): ?><li><a href="<?php echo U('Member/index');?>"><span class="am-icon-renren"></span> 会员管理</a></li><?php endif; ?>

        <li class="admin-parent">
          <a href="javascript:;"  class="am-cf am-collapsed" data-am-collapse="{target: '#collapse-recharge'}"><span class="am-icon-weixin"></span> 资讯管理 	<span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub <?php if(CONTROLLER_NAME == 'Article'): ?>am-in<?php endif; ?>" id="collapse-recharge">
            <li><a href="<?php echo U('Article/cls');?>"><span class="am-icon-plus"></span> 分类管理</a></li>
            <li><a href="<?php echo U('Article/index');?>"><span class="am-icon-plus"></span> 文章管理</a></li>
          </ul>
        </li>

		<?php if($ThisUser['agent'] == 0): ?><li><a href="<?php echo U('weixin/imgedit/id/3');?>"><span class="am-icon-plus"></span> 游戏介绍</a></li>
		<li><a href="<?php echo U('weixin/imgedit/id/4');?>"><span class="am-icon-plus"></span> 家长监护</a></li><?php endif; ?>
		

      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 版权所有</p>                     
        </div>
      </div>

    </div>
  </div>

  <!-- nav end -->
<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">系统设置</strong> / <small>网站设置</small></div>
    </div>
    <hr/>

    <div class="am-g">

      <div class="am-u-sm-12 am-u-md-8">
        <form class="am-form am-form-horizontal" action="" method="post">
          
          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">网站标题</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" name="Title" value="<?php echo C('Site.Title');?>" placeholder="">
            </div>
          </div>
          
          
          

          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">网站关键词</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" name="Keywords" value="<?php echo C('Site.Keywords');?>" placeholder="">
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">网站描述</label>
            <div class="am-u-sm-9">
              <textarea rows="5" name="Description" ><?php echo C('Site.Description');?></textarea>
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">网站网址</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" name="Url" value="<?php echo C('Site.Url');?>" placeholder="">
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">网站备案号</label>
            <div class="am-u-sm-9">
              <input type="text" id="user-name" name="Record" value="<?php echo C('Site.Record');?>" placeholder="">
            </div>
          </div>

		  <div class="am-form-group">
            <label for="is_open" class="am-u-sm-3 am-form-label">网站状态</label>
            <div class="am-u-sm-9">
				<input type="radio" name='is_open' class="am-radio-inline" <?php if(C('Site.is_open') == 1): ?>checked<?php endif; ?>  value="1" id="" />打开
				<input type="radio" name='is_open' class="am-radio-inline" <?php if(C('Site.is_open') == 2): ?>checked<?php endif; ?> value="2" id="" />关闭
            </div>
          </div>

		  <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">关闭原因公告</label>
            <div class="am-u-sm-9">
              <input type="text" name="close_desc" value="<?php echo C('Site.close_desc');?>" placeholder="">
            </div>
          </div>


          <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <button type="submit" class="am-btn am-btn-primary">保存修改</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- content end -->

</div>









<footer data-am-widget="footer"
          class="am-footer am-footer-default"
           data-am-footer="{  }">
    <div class="am-footer-switch">
    <span class="am-footer-ysp" data-rel="mobile"
          data-am-modal="{target: '#am-switch-mode'}">
          
    </span>
      <span class="am-footer-divider"> | </span>
      <a id="godesktop" data-rel="desktop"  href="#">
          shanghai moten network
      </a>
    </div>
    <div class="am-footer-miscs ">

          <p>由 <a href="http://www.bcreat.com/" title=""
                                                target="_blank" class=""></a>
            提供技术支持</p>
        <p>CopyRight©2016  AllMobilize Inc.</p>
    </div>
</footer>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/xiyou/Static/System/Js/jquery.min.js"></script>
<script src="/xiyou/Static/System/Js/amazeui.min.js"></script>
<script src="/xiyou/Static/System/Js/menu.js"></script>
<!--<![endif]-->

<script type="text/javascript">
		$(function () {
			$("#left_nav").css('height',$(document).height()+"px");
		})
</script>

<script charset="utf-8" src="/xiyou/Static/Common/kindeditor/kindeditor-all-min.js"></script>
</body>
</html>