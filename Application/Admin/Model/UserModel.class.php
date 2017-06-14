<?php
namespace Admin\Model;
use Common\Model\UserCenterModel;
class UserModel extends UserCenterModel{
    protected $_validate = array(
        array(
            'user_name',
            '2,15',
            '用户名长度错误',
            self::EXISTS_VALIDATE,
            'length'
        ),
        array(
            'user_name',
            'checkDenyName',
            '用户名包含禁止词语',
            self::EXISTS_VALIDATE,
            'callback'
        ),
        array(
            'user_name',
            '',
            '用户名被占用，请换个试试',
            self::EXISTS_VALIDATE,
            'unique'
        ),
        array(
            'mobile',
            'checkMobile',
            '手机号码格式错误',
            self::MUST_VALIDATE,
            'callback'
        ),
        array(
            'mobile',
            'checkDenyMobile',
            '手机号码禁止注册',
            self::MUST_VALIDATE,
            'callback'
        ),
        array('password','re_password','确认密码不正确',0,'confirm')
    );

    //todo 更新用户时候的密码md5加密
    protected $_auto = array(
    	array('grade','',1,'ignore'),
        array('password','',2,'ignore'),
        array('registered','get_time',1,'callback'),
        array('reg_ip','get_ip',1,'callback'),
        array('salt','get_salt',1,'callback'),
        array('password','get_pwd',1,'callback')
    );

    public function get_time(){
        return NOW_TIME;
    }

    public function get_ip(){
        return get_client_ip();
    }

    public function get_pwd(){
        $pwd = I('post.password');
        return self::passCompile($pwd,C('self_salt'),false);
    }

    public function get_salt(){
        $t = self::randStr(6);
        C('self_salt',$t);
        return $t;
    }
}