<?php
/**
 * 短信验证码
 * ==============================================
 * Copyright (c)  2017 xchen All rights reserved.
 * ==============================================
 * Author: xchen <link8@qq.com>
 * Date: 2017年5月31日 9:45
 */

namespace Common\Model;

use Think\Model;

class SmscodeModel extends Model {

    protected $tableName = 'smscode';
    protected $pk = 'sid';
    // 主键是否自动增长
    protected $autoinc = true;
    /* 用户模型自动验证 */
    protected $_validate = array(
        array(
            'idtype',
            array(
                1,
                2,
                3,
                4
            ),
            '验证码类型不正确',
            self::MUST_VALIDATE,
            'in'
        )
    );
    protected $_auto = array(
        array(
            'created',
            NOW_TIME
        ),
        array(
            'ip',
            'get_client_ip',
            self::MODEL_INSERT,
            'function'
        )
    );

    // 短信平台帐号
    private $account = 'xxxx';
    private $password = 'xxxx';
    private $postapi = 'http://xxx/msg/HttpBatchSendSM';

    /**
     * 设置短信平台账号信息
     */
    protected function set_account($account = array()) {
        if (!array_key_exists('account', $account)) {
            E('账号不存在');
        }
        $this->account = $account['account'];

        if (!array_key_exists('password', $account)) {
            E('密码不存在');
        }
        $this->password = $account['password'];
        if (!array_key_exists('postapi', $account)) {
            E('接口不存在');
        }
        $this->postapi = $account['postapi'];
    }

    /**
     * 下发验证码
     * @param number $mobile
     *            手机号码
     * @param number $idtype
     *            验证码类型 1注册 2找回密码 3修改密码
     * @return json
     */
    public function send_smscode() {
        // C ( 'TOKEN_ON', false );
        $post = I('post.');
        $idtype = intval($post['idtype']);
        $mobile = $post['mobile'];

        if (!$this->_check_mobile($mobile)) {
            $this->error = '手机号码格式不正确!';
            return false;
        }

        // 查询手机号码发送间隔
        $res = $this->where("mobile='$mobile'")->order('sid DESC')->find();
        if ($res['created'] + 60 > NOW_TIME) {
            $this->error = '一分钟内只能发送一次验证码!';
            return false;
        }

        // 查询ip发送间隔
        $ip = get_client_ip();
        $time = NOW_TIME - 60 * 5;
        $ipres = $this->where("ip='$ip' AND created>$time")->count();
        if ($ipres >= 5) {
            $this->error = '该ip地址5分钟内发送验证码已达上限，请稍后再试!';
            return false;
        }

        // 查询手机号码当天记录条数
        $dayCountRes = $this->where("mobile='$mobile' AND TO_DAYS(FROM_UNIXTIME(created))=TO_DAYS(now())")->count();
        if ($dayCountRes >= 10) {
            $this->error = '该手机号码当天发送验证码已达上限(10条)!';
            return false;
        }

        // 查询ip当天记录条数
        $dayCountRes = $this->where("ip='$ip' AND TO_DAYS(FROM_UNIXTIME(created))=TO_DAYS(now())")->count();
        if ($dayCountRes >= 30) {
            $this->error = '该ip当天发送验证码已达上限(30条)!';
            return false;
        }

        /* 辅助选项(通用平台可用在注册验证，这里发短信不验证) start */
        if ($idtype == 1) {
            // 是否需要强制验证手机号码是否被注册
            if (C('user_register_mobile_unique')) {
                $ucenter = D('Common/UserCenter');
                $res = $ucenter->findUser("user_name='$mobile' OR mobile='$mobile'");
                if ($res) {
                    $this->error = '该手机号码已注册，请换个试试!';
                    return false;
                }
            }
        } elseif ($idtype == 2) {
            // 找回密码
            $ucenter = D('Common/UserCenter');
            $res = $ucenter->findUser("mobile='$mobile'");
            if (!$res) {
                $this->error = '该手机号码未注册!';
                return false;
            }
        }
        /* 辅助选项 end */

        if (!$this->create()) {
            return false;
        }
        $code = $this->code = self::_rand_no();

        // 发送数据到第三方运营商
        $xml = $this->_post_api_sms($mobile, '验证码：' . $this->code . '（20分钟内有效）请勿泄露,如非本人操作请忽略,谢谢合作。');
        if ($xml[1] == 0 && isset ($xml[1])) {
            // 插入表
            $this->expire = NOW_TIME + 60 * 20;
            $sid = $this->add();
            if ($sid) {
                return array(
                    'sid' => $sid,
                    'mobile' => $mobile,
                    'code' => $code
                );
            } else {
                return false;
            }
        } else {
            $this->error = "短信下发失败，错误代码($xml[1])!";
            return false;
        }
    }

    public function send_sms($mobile, $content) {
        if (!$this->_check_mobile($mobile)) {
            $this->error = '手机号码格式不正确!';
            return false;
        }
        // 发送数据到第三方运营商
        $xml = $this->_post_api_sms($mobile, $content);
        if ($xml[1] == 0 && isset ($xml[1])) {
            return true;
        }
        $this->error = "短信下发失败，错误代码($xml[1])!";
        return false;
    }

    // 下发短信第三方运营商接口 @TODO 需要自己的短信平台，自己稍微改一下
    private function _post_api_sms($mobile, $content) {

        // 本地测试直接返回
        return $xml = array('20150817163814', '0');

        $post_data = array();
        $post_data['account'] = $this->account;
        $post_data['pswd'] = $this->password;
        $post_data['msg'] = $content;
        $post_data['mobile'] = $mobile;
        $post_data['needstatus'] = true;
        $o = '';
        foreach ($post_data as $k => $v) {
            $o .= "$k=" . urlencode($v) . '&';
        }
        $post_data = substr($o, 0, -1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->postapi);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 如果需要将结果直接返回到变量里，那加上这句。
        $result = curl_exec($ch);

        // 成功返回的结果 20150817163814,0
        return $xml = $result ? explode(',', $result) : array();
    }

    /**
     * 验证短信码
     * @param integer $mobile
     *            手机号, $code 验证码, $idtype(1：用户注册 2：用户找回密码验证 3：绑定手机验证码), $sid 流水号
     * @return integer $sid 流水号
     */
    public function check_smscode($mobile, $code, $idtype, $sid) {
        if (!$this->_check_mobile($mobile)) {
            $this->error = '手机号码格式不正确!';
            return false;
        }

        if (strlen($code) != 6) {
            $this->error = '短信验证码必须6位数!';
            return false;
        }

        if ($sid) {
            $this->where("sid=$sid");
        }
        $res = $this->where(array(
            'mobile' => $mobile,
            'code' => $code,
            'idtype' => $idtype
        ))->order('sid DESC')->find();

        if ($res['code'] != $code) {
            $this->error = '短信验证码不正确!';
            return false;
        }
        if ($res['status'] == 1) {
            $this->error = '短信验证码已使用!';
            return false;
        }
        if ($res['expire'] < NOW_TIME) {
            $this->error = '短信验证码已过期!';
            return false;
        }

        return $res['sid'];
    }

    /**
     * 更改短信码状态
     * @param integer $sid 流水号
     */
    public function update_status($sid = 0) {
        return $this->where(array(
            'sid' => $sid
        ))->save(array(
            'status' => 1
        ));
    }

    /**
     * 通过短信码重置用户密码
     * 必填post字段 new_password新密码, mobile手机号， code短信码
     */
    public function reset_user_password($pass_is_md5) {
        $post = I('post.');
        $newpass = $post['new_password'];
        $mobile = $post['mobile'];
        $code = $post['smscode'];

        if (!$this->_check_mobile($mobile)) {
            $this->error = '手机号码格式错误!';
            return false;
        }

        if (strlen($code) != 6) {
            $this->error = '短信验证码位数错误!';
            return false;
        }

        if (strlen($newpass) < 6) {
            $this->error = '密码必须是6-20位字符串!';
            return false;
        }

        $this->startTrans();

        $ucenter = D('Common/UserCenter');
        // 查询手机用户
        $user = $ucenter->findUser(array(
            'mobile' => $mobile
        ));
        if (!$user) {
            $this->error = '该手机号不存在用户信息!';
            return false;
        }

        // 验证短信码
        if (!$smscode_id = $this->check_smscode($mobile, $code, 2)) {
            return false;
        }

        // 更新密码(发送过来的newpass已经是md5后)
        $newpass = $ucenter->passCompile($newpass, $user['salt'], $pass_is_md5);
        if ($newpass == $user['password']) {
            $this->error = '新密码不能与旧密码相同!';
            return false;
        }

        // 更新用户资料 忽略旧密码验证
        $res = $ucenter->updateUserFields($user['user_id'], '', array(
            'password' => $newpass
        ), false, true);
        if ($res === false) {
            $this->error = $ucenter->getError();
            return false;
        }

        // 更新短信码状态
        $res = $this->update_status($smscode_id);
        if ($res === false) {
            $this->error = '密码重置失败(验证码状态无法更新)!';
            $this->rollback();
            return false;
        }

        $this->commit();

        return true;
    }

    /**
     * 生成随机字串
     * @param number $length
     *            长度，默认为6
     * @return string
     */
    private static function _rand_no($length = 6) {
        // 密码字符集，可任意添加你需要的字符
        $chars = "0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $str;
    }

    /**
     * 验证手机格式
     * @param string $mobile
     *            手机
     * @return boolean ture - 正确，false - 错误
     */
    private function _check_mobile($mobile) {
        $ucenter = D('Common/UserCenter');
        return $ucenter->checkMobile($mobile);
    }
}