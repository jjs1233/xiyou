<?php
/**
 * app应用会员模型 此直接调用统一用户模型api
 * ==============================================
 * Copyright (c)  2017 xchen All rights reserved.
 * ==============================================
 * Author: xchen <link8@qq.com>
 * Date: 2017年5月31日 9:45
 */

namespace Common\Model;

use Think\Model;

class UserModel extends Model {

    /**
     * 指定登录用户
     * @param integer $uid
     *            用户ID
     * @param integer $cookie_expire 记住cookie登录时间
     * @return boolean ture-登录成功，false-登录失败
     */
    public function login($uid, $cookie_expire = 3600) {
        // 检测是否在当前应用注册
        $user = $this->field(true)->find($uid);
        if (!$user) {
            $this->error = '未找到用户信息！';
            return false;
        } elseif (1 != $user['status']) {
            $this->error = '用户未激活或已禁用！'; // 应用级别禁用
            return false;
        }

        // 用户登录cookie 防止session过期退出登录
        $this->setCookie($user, $cookie_expire);

        // 用户登录session
        $this->setSession($user);

        return true;
    }

    /**
     * 设置用户登录 cookie
     * @param array $user
     *            用户信息数组
     * @param int $expire
     *            过期时间 单位 秒
     * @return string
     */
    private function setCookie($user, $expire = 3600) {
        if (empty ($user)) {
            return;
        }

        // 散列加密
        $pass = md5($user['password']);
        $id = md5($user['user_id']);

        // echo $aa = authcode ( "$id\t$pass", 'ENCODE' );
        // echo '<br>';
        // echo $bb = authcode ( $aa, 'DECODE' );
        // echo '<br>';
        // print_r ( explode ( "\t", $bb ) );
        // exit ();

        cookie("auth", authcode("$id\t$pass", 'ENCODE'), array(
            'expire' => $expire,
            'httponly' => true
        ));
    }

    /**
     * 设置用户登录session 及签名
     */
    private function setSession($user = array()) {
        if (empty ($user)) {
            return;
        }
        $user_auth = array(
            'user_id' => $user['user_id'],
            'user_name' => $user['user_name'],
            'mobile' => $user['mobile'],
            'last_login' => $user['last_login']
        );
        // 额外定义， user_id， mobile, user_name 注意：thinkphp的bug在模版中调用 session 如 'user_auth.user_id'是获取不到的
        session('user_id', $user['user_id']);
        session('mobile', $user['mobile']);
        session('user_name', $user['user_name']);

        session('user_auth', $user_auth);
        session('user_auth', $user_auth);
        session('user_auth_sign', data_auth_sign($user_auth));

        // 更新session表在线状态
        $this->update_session_online($user);
    }

    /**
     * 更新session表在线状态
     */
    private function update_session_online($user) {
        // 检查 session 在线时间
        $onlinehold = C('SESSION_EXPIRE');

        // 删除超时 session表记录
        $m = new Model ('session');
        $m->where("last_action<" . (NOW_TIME - $onlinehold))->delete();

        // 更新当前用户 session表记录
        $data = array(
            'user_id' => $user['user_id'],
            'mobile' => $user['mobile'],
            'user_name' => $user['user_name'],
            'session_id' => md5(session_id() . DATA_AUTH_KEY),
            'auth_sign' => md5(md5($user['password']) . DATA_AUTH_KEY),
            'agent' => $_SERVER['HTTP_USER_AGENT'] ? serialize($_SERVER['HTTP_USER_AGENT']) : serialize(array()),
            'last_action' => NOW_TIME,
            'last_ip' => get_client_ip()
        );
        $res = $m->add($data, array(), true);
        if ($res) {
            // 更新用户信息
            M('user')->where("user_id=" . $user['user_id'])->save(array(
                'last_action' => NOW_TIME
            ));
        }
    }

    /**
     * 注销当前用户
     * @return void
     */
    public function logout() {
        if (M('session')->where("user_id=" . session('user_id'))->delete()) {
            session('user_id', null);
            session('mobile', null);
            session('user_name', null);

            session('user_auth', null);
            session('user_auth_sign', null);
            cookie('auth', null);
            return true;
        }
    }
}
 