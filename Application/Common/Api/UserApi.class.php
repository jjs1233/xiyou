<?php
/**
 * 用户接口类
 * ==============================================
 * Copyright (c)  2017 xchen All rights reserved.
 * ==============================================
 * Author: xchen <link8@qq.com>
 * Date: 2017年5月31日 9:45
 */
namespace Common\Api;

class UserApi {

    public static $error = '';
    const COOKIE_TIME = 3600;
    const AUTO_LOGIN_COOKIE_TIME = 604800; // 7天

    /**
     * 登录
     */
    public static function login($pass_is_md5 = false) {
        $post = I('post.');
        $username = $post['username'];
        $password = $post['password'];
        $capacha = $post['capacha'];

        if (empty($username) || empty($password)) {
            self::$error = '用户名和密码必填！';
            return false;
        }
        // 检测验证码
        if (C('user_login_verify_code_require')) {
            if (!check_verify($capacha)) {
                self::$error = '验证码输入错误！';
                return false;
            }
        }
        $ucenter = D('Common/UserCenter');
        $login_type = 1;
        if ($ucenter->checkMobile($username)) {
            $login_type = 3;
        }

        $user_id = $ucenter->login($username, $password, $login_type, $pass_is_md5);
        // UC登录成功
        if ($user_id) {
            $cookie_time = self::COOKIE_TIME;
            if ($post['autologin']) {
                $cookie_time = self::AUTO_LOGIN_COOKIE_TIME;
            }

            // 登录当前用户
            $user = D('Common/User');
            if ($user->login($user_id, $cookie_time)) {
                // 写入登录日志

                $url = U('Index/index');

                // 判断来源跳转
                $referer = I('request.referer');
                if ($referer) {
                    $referer = base64_decode($referer);
                    if (!stripos(strtolower($referer), 'Accout/login')) {
                        // 判断是否外站连接
                        $url = $referer;
                    }
                }

                return array(
                    'user_id' => $user_id,
                    'url' => $url
                );
            }
        }
        self::$error = $ucenter->getError();
        return false;
    }

    public static function register($pass_is_md5 = false) {
        $post = I('post.');
        $username = $post['user_name'];
        $real_name = $post['real_name'];
        $password = $post['password'];
        $mobile = $post['mobile'];
        $smscode = $post['smscode'];
        $u_type = $post['u_type'];


        if ($mobile && $password && $smscode) {
            $username = $username ? $username : $mobile;

            // 验证短信码
            $sms = D('Common/Smscode');
            if (!$smscode_id = $sms->check_smscode($mobile, $smscode, 1)) {
                self::$error = $sms->getError();
                return false;
            }

            $ucenter = D('Common/UserCenter');
            $ucenter->setInviterId($post['inviter_mobile']); // 邀请人手机
            $user_id = $ucenter->register($u_type, $username, $password, $real_name, $mobile, '', $pass_is_md5);
           if (!$user_id) {
               self::$error = $ucenter->getError();
                return false;
            }

            // 更新短信码状态
            $sms->update_status($smscode_id);

            $cookie_time = self::COOKIE_TIME;
            if ($post['autologin']) {
                $cookie_time = self::AUTO_LOGIN_COOKIE_TIME;
            }

            // 登录当前用户
            $user = D('Common/User');
            if ($user->login($user_id, $cookie_time)) {
                return $user_id;
            }
            self::$error = $user->getError();
            return false;
        } else {
            self::$error = '却少必填参数';
            return false;
        }
    }

    /**
     * @param int $user_id
     * @param bool $verifyCapacha 开启验证码
     * @return bool|int
     */
    public static function password($user_id = 0, $verifyCapacha = true) {
        $post = I('post.');
        $newpass = $post['new_password'];
        $oldpwd = $post['old_password'];
        $capacha = $post['capacha'];

        // 检测验证码
        if ($verifyCapacha) {
            if (!check_verify($capacha)) {
                self::$error = '验证码输入错误！';
                return false;
            }
        }

        $ucenter = D('Common/UserCenter');
        $user = $ucenter->findUser(array('user_id' => $user_id));
        if (!$user) {
            self::$error = '用户不存在';
            return false;
        }

        // 更新密码
        $newpass = $ucenter->passCompile($newpass, $user['salt'], false);
        if ($newpass == $user['password']) {
            self::$error = '新密码不能与原密码相同!';
            return false;
        }

        // 更新用户资料
        $res = $ucenter->updateUserFields($user['user_id'], $oldpwd, array(
            'password' => $newpass
        ));
        if ($res === false) {
            self::$error = $ucenter->getError();
            return false;
        }

        return $user_id;
    }

    /**
     * @param rest_type =1 短信码重置密码 必填post字段 new_password新密码, mobile手机号， code短信码
     * @return bool
     */
    public static function reset_pwd($pass_is_md5 = false) {
        // 短信码重置密码
        if ($_POST['rest_type'] == 1) {
            $sms = D('Common/Smscode');
            $res = $sms->reset_user_password($pass_is_md5);
            if ($res === false) {
                self::$error = $sms->getError();
                return false;
            } else {
                return true;
            }
        } else {
            // 邮箱重置
        }
        return false;
    }

}