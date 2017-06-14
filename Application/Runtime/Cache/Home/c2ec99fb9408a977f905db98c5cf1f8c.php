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
    <title>注册</title>
    <link type="text/css" rel="stylesheet" href="/xiyou/Public/style.css">
</head>
<body>

<div class="container" id="js-container">
    <div class="account-box">
        <form action="" method="post">
            <div class="ui-form">
                <div class="ui-form-group">
                    <div class="label">请选择</div>
                    <div class="input-box">
                        <?php if(is_array($reg_typs)): foreach($reg_typs as $k=>$val): ?><label style="margin-right: 0.2rem"><input type="radio" name="u_type" value="<?php echo ($k); ?>" <?php if(($k) == "1"): ?>checked<?php endif; ?>> <?php echo ($val); ?></label><?php endforeach; endif; ?>
                    </div>
                </div>
                <div class="ui-form-group">
                    <div class="label">玩家账号</div>
                    <div class="input-box"><input type="text" name="mobile" id="mobile" placeholder="手机号" value="" maxlength="11" required></div>
                </div>
                <div class="ui-form-group">
                    <div class="label">推荐人</div>
                    <div class="input-box"><input type="text" name="inviter_mobile" id="inviter_mobile" placeholder="手机号" value="<?php echo ($mobile); ?>" maxlength="11"></div>
                </div>
                <?php $capacha_url = U('Account/capacha'); ?>
                <div class="ui-form-group">
                    <div class="label">验证码</div>
                    <div class="input-box"><input type="text" name="capacha" id="capacha" value="" placeholder="证明不是机器人" required></div>
                    <div class="secode"><img data-src="<?php echo ($capacha_url); ?>" id="refreshCode" src="<?php echo ($capacha_url); ?>"></div>
                </div>
                <div class="ui-form-group">
                    <div class="label">短信码</div>
                    <div class="input-box"><input type="text" name="smscode" id="smscode" placeholder="6位短信码" value="" maxlength="6" required></div>
                    <button type="button" class="btn-send btn-sendsms" id="btn-sendsms" data-idtype="1" data-action="<?php echo U('Account/smscode');?>">获取短信码</button>
                </div>
                <div class="ui-form-group">
                    <div class="label">密 码</div>
                    <div class="input-box"><input type="password" name="password" id="password" value="" placeholder="6-20个字符" required></div>
                </div>
                <div class="ui-form-group">
                    <div class="label">确认密码</div>
                    <div class="input-box"><input type="password" name="password2" id="password2" value="" placeholder="6-20个字符" required></div>
                </div>

                <div class="ui-form-group">
                    <div class="label">昵称</div>
                    <div class="input-box"><input type="text" name="user_name" id="user_name" placeholder="昵称" value="" required></div>
                </div>

                <div class="ui-form-group">
                    <div class="label">真实姓名</div>
                    <div class="input-box"><input type="text" name="real_name" id="real_name" placeholder="真实姓名" value="" required></div>
                </div>
            </div>

            <div class="clearfix">
                <button class="btn btn-pink btn-block" id="btn-phone-submit">注 册</button>
            </div>
            <input type="hidden" name="rest_type" value="1">
        </form>
    </div>

</div>

<script type="text/javascript" src="/xiyou/Public/vender.js"></script>
<script type="text/javascript">
    // 发送短信
    var leftSeconds = 60, timeIntervalId;
    function secodeloadtime() {
        if(leftSeconds<=0){
            clearInterval(timeIntervalId);
            var btn = $('.btn-sendsms');
            btn.html('获取短信码');
            btn.removeAttr("disabled");
            return;
        }
        leftSeconds--;
        $('.btn-sendsms').html(leftSeconds+'秒后重发');
    }
    function checkMobile(phone) {
        if (!phone.match(/^1[3|4|5|7|8][0-9]\d{4,8}$/) || phone == "") {
            return false;
        }
        return true;
    }

    $(function() {
        $('#refreshCode').on('click', function (e) {
            e.preventDefault();
            $(this).attr("src", $(this).data("src") + '?' + Math.random());
        });

        function sendSMS(mobile, capacha, idtype) {
            if (!checkMobile(mobile)) {
                alert("手机号码格式错误");
                return false;
            }
            if (capacha.length < 4) {
                alert("请输入图形验证码");
                return false;
            }
            var _obj = $('.btn-sendsms');
            $.ajax({
                type:"POST",
                data: {mobile:mobile, capacha: capacha, idtype: idtype},
                url:_obj.data('action'),
                dataType:"json",
                async:false,
                beforeSend: function(){
                    _obj.html('发送中...');
                    _obj.attr("disabled","disabled");
                },
                success: function(d) {
                    if(d.status == 1){
                        alert("短信验证码发送成功！");
                        timeIntervalId = setInterval("secodeloadtime()", 1000);
                    }else{
                        alert(decodeURIComponent(d.info));
                        _obj.removeAttr("disabled").html('获取短信码');
                    }
                },
                error:function(d){
                    alert("发送处理失败");
                    _obj.removeAttr("disabled").html('获取短信码');
                }
            });
        }

        $('#btn-sendsms').on('click', function(e) {
            e.preventDefault();
            sendSMS($('#mobile').val(), $('#capacha').val(), $(this).data('idtype'));
        });
    });
</script>
</body>
</html>