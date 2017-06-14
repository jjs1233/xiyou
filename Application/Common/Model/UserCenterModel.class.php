<?php
/**
 * 统一用户中心模型
 * ==============================================
 * Copyright (c)  2017 xchen All rights reserved.
 * ==============================================
 * Author: xchen <link8@qq.com>
 * Date: 2017年5月31日 9:45
 */

namespace Common\Model;

use Think\Model;

class UserCenterModel extends Model {
    protected $tableName = 'user';
    protected $pk = 'user_id';

    // 主键自动增长
    protected $autoinc = true;
    /* 自动验证 (存在时验证模式，字段必填时调用方法前 需要验证非空) */
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
        /* 验证手机号码 (存在时验证模式) */
        array(
            'mobile',
            'checkMobile',
            '手机号码格式错误',
            self::MUST_VALIDATE,
            'callback'
        ),

        /* 验证手机是否禁止注册 TODO: */
        array(
            'mobile',
            'checkDenyMobile',
            '手机号码禁止注册',
            self::MUST_VALIDATE,
            'callback'
        ),
        array(
            'mobile',
            'checkMobileUnique',
            '手机号码已被注册,请换个试试',
            self::MUST_VALIDATE,
            'callback'
        )
    );


    /**
     * 邀请注册人手机
     */
    private $inviter_mobile = '';

    /**
     * 检测用户名是不是被禁止注册
     * @param string $user_name
     *            用户名
     * @return boolean ture - 未禁用，false - 禁止注册
     */
    protected function checkDenyName($user_name) {
        return true; // TODO: 暂不限制
    }

    /**
     * 验证手机格式
     * @param string $mobile
     *            手机
     * @return boolean ture - 正确，false - 错误
     */
    public function checkMobile($mobile) {
        $exp = "/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|17[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]{8}$/";
        if (preg_match($exp, $mobile)) {
            return true;
        }
        return false;
    }

    /**
     * 验证手机是否唯一
     * @param string $mobile
     *            手机
     * @return boolean ture - 通过，false - 未通过(已被注册)
     */
    protected function checkMobileUnique($mobile) {
        // 是否需要强制验证手机号码是否被注册
        if (C('user_register_mobile_unique')) {
            if ($this->where("mobile='%s'", $mobile)->find()) {
                $this->error = '手机号码已被注册，请换个试试';
                return false;
            }
        }
        return true;
    }

    /**
     * 检测手机是不是被禁止注册
     * @param string $mobile
     *            手机
     * @return boolean ture - 未禁用，false - 禁止注册
     */
    protected function checkDenyMobile($mobile) {
        return true; // TODO: 暂不限制
    }

    /**
     * 根据配置指定用户状态
     * @return integer 用户状态
     */
    protected function getStatus() {
        return 1; // TODO: 暂不限制
    }

    /**
     * 用户登录认证 status(0待审 1激活 2锁定)
     * @param string $user_name用户名
     * @param string $password
     *            用户密码
     * @param integer $type
     *            用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer 登录成功-用户ID，登录失败-错误编号
     */
    public function login($user_name, $password, $type = 1, $pass_is_md5 = false) {
        $map = array();
        switch ($type) {
            case 1 :
                $map['user_name'] = $user_name;
                break;
            case 3 :
                $map['mobile'] = $user_name;
                break;
            case 4 :
                $map['user_id'] = $user_name;
                break;
            default :
                $this->error = '参数错误';
                return false;
        }

        // 获取用户数据
        $user = $this->findUser($map);
        if ($user) {
            if (empty ($user['status'])) {
                $this->error = '用户待激活';
                return false;
            }
            if ($user['status'] == 2) {
                $this->error = '用户已被锁定';
                return false;
            }
            if ($this->passCompile($password, $user['salt'], $pass_is_md5) === $user['password']) {
                // 更新用户登录信息
                $this->updateLogin($user['user_id']);
                return $user['user_id'];
            } else {
                $this->error = '账号或密码错误';
                return false;
            }
        } else {
            $this->error = '用户不存在';
            return false;
        }
    }

    /**
     * 更新用户登录信息
     * @param integer $user_id
     *            用户ID
     */
    protected function updateLogin($user_id) {
        $data = array(
            'user_id' => $user_id,
            'last_login' => NOW_TIME,
            'last_login_ip' => get_client_ip(),
            'logins' => array('exp', '`logins`+1')
        );
        $this->save($data);
    }

    /**
     * 设置邀请注册id
     * @param string $mobile
     */
    public function setInviterId($mobile = '') {
        if ($this->checkMobile($mobile)) {
            $this->inviter_mobile = $mobile;
        }
    }

    /**
     * 注册一个新用户
     * @param integer $u_type
     *            类型
     * @param string $user_name
     *            用户名
     * @param string $password
     *            用户密码
     * @param string $real_name
     *            真实姓名
     * @param string $mobile
     *            用户手机号码
     * @param string $salt
     *            加盐
     * @return integer 注册成功-用户信息，注册失败-错误编号
     */
    public function register($u_type, $user_name, $password = '', $real_name = '', $mobile = '', $salt = '', $pass_is_md5 = false) {
        if ($this->inviter_mobile) {
            $inviter_id = $this->field('user_id')->where(array('mobile' => $this->inviter_mobile))->find();
            if (!$inviter_id) {
                $this->error = '邀请用户不存在';
                return false;
            }
        }
        $u_type = intval($u_type);
        if (!in_array($u_type, array_keys(C('user_register_type')))) {
            $this->error = '用户类型错误';
            return false;
        }

        $ip = get_client_ip();
        $salt = $salt ? $salt : self::randStr(6);
        $password = $password ? $password : self::randStr(8);
        $data = array(
            'u_type' => $u_type,
            'user_name' => $user_name,
            'real_name' => $real_name,
            'password' => $this->passCompile($password, $salt, $pass_is_md5),
            'mobile' => $mobile,
            'salt' => $salt,
            'status' => $this->getStatus(),
            'last_login' => NOW_TIME,
            'last_login_ip' => $ip,
            'registered' => NOW_TIME,
            'reg_ip' => $ip,
            'inviter_mobile' => $this->inviter_mobile
        );

        /* 添加用户 */
        if ($this->create($data)) {
            $this->startTrans();

            $uid = $this->add();
            if ($uid === false) {
                $this->error = '注册失败';
                return false;
            }

            // 生成用户扩展资料

            // 修改粉丝数
            $res = $this->where(array('mobile' => $this->inviter_mobile))->setInc('fans_num');
            if ($res === false) {
                $this->error = '写入用户粉丝数据失败';
                $this->rollback();
                return false;
            }

            $this->commit();
            return $uid;
        } else {
            $this->error = $this->getError();
            return false;
        }
    }

    /**
     * 统一查找主表用户
     * @param unknown $where
     */
    public function findUser($where) {
        return $this->where($where)->order('user_id DESC')->find();
    }

    /**
     * 获取用户信息
     * @param string $uid
     *            用户ID或用户名
     * @param boolean $is_user_name
     *            是否使用用户名查询
     * @return array 用户信息
     */
    public function info($uid, $is_user_name = false) {
        $map = array();
        if ($is_user_name) { // 通过用户名获取
            $map['user_name'] = $uid;
        } else {
            $map['user_id'] = $uid;
        }
        $user = $this->findUser($map);
        if (!$user) {
            $this->error = '用户不存在';
            return false;
        }
        if ($user['status'] == 0) {
            $this->error = '用户未激活';
            return false;
        }
        if ($user['status'] == 2) {
            $this->error = '用户被禁用';
            return false;
        }
        return $user;
    }

    /**
     * 获取用户全部信息
     * @param array $where
     *            检索条件
     * @return array 用户信息
     */
    public function allinfo($where) {
        return $this->field('password', true)->where($where)->find();
    }

    /**
     * 更新用户表信息
     * @param int $uid
     *            用户id
     * @param string $password
     *            输入密码(原密码)，用来验证
     * @param array $data
     *            修改的字段数组
     * @param bool $pass_is_md5
     *            发送密码 $password_in 字段是否已经md5编译 此参数 $ignore_password＝true时失效
     * @param bool $ignore_password
     *            是否忽略原密码验证 默认false
     * @return true 修改成功，false 修改失败
     */
    public function updateUserFields($uid, $password_in, $data, $pass_is_md5 = false, $ignore_password = false) {
        if (empty ($uid) || empty ($data)) {
            $this->error = '必填参数缺失！';
            return false;
        }

        // 更新前检查用户密码
        if (!$ignore_password) {
            if (empty ($password_in)) {
                $this->error = '请输入用户密码！';
                return false;
            }
            if (!$this->verifyUserPass($uid, $password_in, $pass_is_md5) && !$ignore_password) {
                $this->error = '用户密码不正确！';
                return false;
            }
        }

        return $this->where(array(
            'user_id' => $uid
        ))->data($data)->save();
    }

    /**
     * 更新用户资料表信息
     * @param int $uid
     *            用户id
     * @param string $password_in
     *            输入密码(原密码)，用来验证
     * @param array $data
     *            修改的字段数组
     * @param bool $pass_is_md5
     *            发送密码 $password_in 字段是否已经md5编译 此参数 $ignore_password＝true时失效
     * @param bool $ignore_password
     *            是否忽略原密码验证 默认false
     * @return true 修改成功，false 修改失败
     */
    public function updateUserInfoFields($uid, $password_in, $data, $pass_is_md5 = false, $ignore_password = false) {
        if (empty ($uid) || empty ($data)) {
            $this->error = '参数错误！';
            return false;
        }

        // 更新前检查用户密码
        if (!$ignore_password) {
            if (empty ($password_in)) {
                $this->error = '请输入用户密码！';
                return false;
            }
            if (!$this->verifyUserPass($uid, $password_in, $pass_is_md5)) {
                $this->error = '用户密码不正确！';
                return false;
            }
        }

        // 动态验证
        $rules = array(
            array(
                'sex',
                array(
                    0,
                    1,
                    2
                ),
                '性别不正确',
                self::EXISTS_VALIDATE,
                'in'
            )
        );

        // 更新用户信息
        $data = $this->validate($rules)->create($data);
        if (!$data) {
            return false;
        }

        return $this->where(array('user_id' => $uid))->save($data);
    }

    /**
     * 检测用户信息
     * @param string $field
     *            用户名
     * @param integer $type
     *            用户名类型 1-用户名，2-用户邮箱，3-用户电话
     * @return integer 错误编号
     */
    public function checkField($field, $type = 1) {
        $data = array();
        switch ($type) {
            case 1 :
                $data['username'] = $field;
                break;
            case 2 :
                $data['email'] = $field;
                break;
            case 3 :
                $data['mobile'] = $field;
                break;
            default :
                return false; // 参数错误
        }
        if (!$data = $this->create($data)) {
            return false;
        }
        return $data;
    }

    /**
     * 验证用户密码
     * @param int $uid
     *            用户id
     * @param string $password_in
     *            输入的密码
     * @return true 验证成功，false 验证失败
     */
    protected function verifyUserPass($uid, $password_in, $pass_is_md5 = false) {
        $user = $this->field('password,salt')->where('user_id=%d', $uid)->find();
        if ($this->passCompile($password_in, $user['salt'], $pass_is_md5) === $user['password']) {
            return true;
        }
        return false;
    }

    /**
     * 系统密码生成方法
     * @param string $str
     *            要加密的字符串
     * @param string $key
     *            加密密钥
     * @param bool $pass_is_md5
     *            传入的密码是否为md5后的结果 用于密码生成和校验
     * @return string
     */
    public function passCompile($str, $key = '', $pass_is_md5 = false) {
        return '' === $str ? '' : md5(($pass_is_md5 ? $str : md5($str)) . $key . C('DATA_AUTH_KEY'));
    }

    /**
     * 生成随机字串
     * @param number $length
     *            长度，默认为16，最长为32字节
     * @return string
     */
    public static function randStr($length = 32) {
        // 密码字符集，可任意添加你需要的字符
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }
}
 