<?php 
function dd($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

/**
 * 获取排序后的分类
 * @param  [type]  $data  [description]
 * @param  integer $pid   [description]
 * @param  string  $html  [description]
 * @param  integer $level [description]
 * @return [type]         [description]
 */
function getSortedCategory($data,$pid=0,$html="|---",$level=0)
{
	$temp = array();
	foreach ($data as $k => $v) {
		if($v['pid'] == $pid){
	
			$str = str_repeat($html, $level);
			$v['html'] = $str;
			$temp[] = $v;

			$temp = array_merge($temp,getSortedCategory($data,$v['id'],'|---',$level+1));
		}
		
	}
	return $temp;
}



/**
 * 根据key，返回当前行的所有数据
 * @param  string  $key  字段key
 * @return array         当前行的所有数据
 */

function getSettingValueDataByKey($key)
{
	return M('setting')->getByKey($key);
}

/**
 * 根据key返回field字段
 * @param  string $key   [description]
 * @param  string $field [description]
 * @return string        [description]
 */
function getSettingValueFieldByKey($key,$field)
{
	return M('setting')->getFieldByKey($key,$field);
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
    $ckey_length = 6; // 随机密钥长度 取值 0-32;
    // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
    // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
    // 当此值为 0 时，则不产生随机密钥
    $key = md5($key ? $key : C('DATA_AUTH_KEY'));
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));

    // 加入替换特殊字符 ＋,/
    if ($operation == 'DECODE') {
        $string = str_replace(array(
            '-',
            '_'
        ), array(
            '+',
            '/'
        ), $string);
    }

    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        // 加入替换特殊字符 ＋,/
        return $keyc . str_replace(array(
                '+',
                '/',
                '='
            ), array(
                '-',
                '_',
                ''
            ), base64_encode($result));
        // return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
    }
}

/**
 * 数据简单签名
 */
function dsgin($val = '') {
    return md5(DATA_AUTH_KEY . $val);
}

/**
 * 数据签名认证
 * @param array $data
 *            被认证的数据
 * @return string 签名
 */
function data_auth_sign($data) {
    // 数据类型检测
    if (!is_array($data)) {
        $data = ( array )$data;
    }
    ksort($data); // 排序
    $code = http_build_query($data); // url编码并生成query字符串
    $sign = md5($code . DATA_AUTH_KEY); // 生成签名 //大写 strtoupper
    return $sign;
}

/**
 * 检测用户是否登录 参与auth_sign 签名字段 user_id，user_name，mobile, last_login
 */
function user_auth() {
    $user_id = 0;
    $user_name = '';

    $user_auth = session('user_auth');
    // session未过期
    if (session('user_auth_sign') && $user_auth) {
        // 对比签名
        $user_id = session('user_auth_sign') == data_auth_sign($user_auth) ? $user_auth['user_id'] : 0;
        if ($user_id) {
            $user_name = $user_auth['user_name'];
        }
    } else {
        // 检查cookie签名
        $_auth = cookie('auth');
        if ($_auth) {
            @list ($user_id, $cookie_md5_password) = explode("\t", authcode($_auth, 'DECODE'));
        }
        // 解析cookie存在
        if ($user_id && $cookie_md5_password) {
            $auth_sign = md5($cookie_md5_password . DATA_AUTH_KEY);

            $dao = D('Common/User');
            // 查询session表数据
            $session_table = M('session')->where("MD5(user_id)='%s'", $user_id)->find();
            if ($session_table && $session_table['auth_sign'] == $auth_sign) {
                // 设置用户登录session
                $dao->login($session_table['user_id']);
                $user_id = $session_table['user_id'];
                $user_name = $session_table['user_name'];
            } else {
                // session没有数据表示没有登录 ，或者登录超时， 再查找user表
                $user = M('user')->where("MD5(user_id)='%s'", $user_id)->find();
                if ($user && md5(md5($user['password']) . DATA_AUTH_KEY) == $auth_sign) {
                    // 设置用户登录session
                    $dao->login($user_id);
                    $user_id = $user['user_id'];
                    $user_name = $user['user_name'];
                }
            }
            $user_id = intval($user_id);
        }
    }

    if (empty ($user_id)) {
        session('user_id', null);
        session('user_name', null);
        session('mobile', null);
        session('user_auth', null);
        session('user_auth_sign', null);
        cookie('auth', null);
    }

    define('USER_ID', $user_id);
    define('USER_NAME', $user_name);
}

/**
 * 检测输入的验证码是否正确，$code为用户输入的验证码字符串
 * @return boolean
 */
function check_verify($code, $id = '') {
    $verify = new \Think\Verify ();
    return $verify->check($code, $id);
}