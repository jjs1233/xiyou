<?php
/**
 * 用户登录注册
 * ==============================================
 * Copyright (c)  2017 xchen All rights reserved.
 * ==============================================
 * Author: xchen <link8@qq.com>
 * Date: 2017年5月31日 9:45
 */

namespace Home\Controller;

use Common\Api\UserApi;

class AccountController extends BaseController {

    const token = 'dasdasdasdacncuscuisucins';
    /**
     * 登录
     */
    public function login() {
        if (IS_POST) {
            $user = UserApi::login();
            if (!$user) {
                $this->error(UserApi::$error);
            }
            session('token',self::token);
            $this->success('认证成功,页面跳转中...', U('Index/admin'));
            exit();
        }

        $this->display();
    }

    /**
     * 注销登录
     */
    public function logout() {
        if (session('user_id')) {
            D('Common/User')->logout();
            $this->success('注销帐号...', U('Index/index'));
            exit();
        } else {
            $this->error('没有权限操作', U('Index/index'));
        }
    }

    /**
     * 注册
     */
    public function register() {
        if (IS_POST) {
            $user = UserApi::register();
            if (!$user) {
                $this->error(UserApi::$error);
            }
            session('token',self::token);
            $this->success('注册成功,页面跳转中...', U('Index/admin'));
            exit();
        }

        // 邀请注册手机号
        $mobile = I('get.mobile');
        if ($mobile) {
            $user = M('user')->field('user_id,mobile')->where(array('mobile' => $mobile))->find();
            if (!$user) {
                $this->error('不存在的用户标识!');
            }
        }

        $this->assign('reg_typs', C('user_register_type'));
        $this->assign('mobile', $mobile);
        $this->display();
    }

    /**
     * 生成验证码
     */
    public function capacha($size = '') {
        $config = array(
            'expire' => 600,  // 秒
            'fontSize' => 22,  /* 字体大小 默认25 */
            'length' => 4,  // 验证码位数
            'fontttf' => '5.ttf'
        );
        if ($size == 'small') {
            $config['fontSize'] = 14;
            $config['imageW'] = 112;
            $config['imageH'] = 46;
            $config['useNoise'] = false;
            $config['bg'] = array(
                237,
                247,
                255
            );
        }
        $Verify = new \Think\Verify ($config);
        $Verify->entry();
    }

    /**
     * 发送短信验证码 ajax请求
     * 发送必填参数 mobile, idtype(1注册2找回密码4商户找回密码), capacha
     */
    public function smscode() {
        if (IS_POST) {
            if (empty ($_POST['capacha'])) {
                $this->error('请输入图形验证码！', '', true);
            }
            // 验证图形验证码
            if (!check_verify($_POST['capacha'])) {
                $this->error('图形验证码输入错误！', '', true);
            }
            $this->_smscode();
        }
    }

    /**
     * 发送验证码
     * 发送参数 mobile, idtype(1注册 2找回密码 3修改密码)
     */
    private function _smscode() {
        $m = D('Common/Smscode');
        $res = $m->send_smscode();
        if ($res === false) {
            $this->error($m->getError(), '', true);
        } else {
            $this->success('success', '', true);
        }
    }

}