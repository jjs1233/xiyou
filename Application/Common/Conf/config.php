<?php

// 签名key，必须牢记
define('DATA_AUTH_KEY', 'xxxxx12312');

return array(
	//'配置项'=>'配置值'

    /* 安全处理 @注意，一定要安全过滤用户输入 */
    'DEFAULT_FILTER'=>'htmlspecialchars,addslashes', // 全局过滤函数 默认htmlspecialchars
    'VAR_FILTERS'=>'filter_default,filter_exp', // 安全过滤

    /*数据库配置定义*/
    'DB_TYPE'       => 'mysql',
    'DB_HOST'       => '127.0.0.1',
    'DB_NAME'       => 'xiyou',
    'DB_USER'       => 'root',
    'DB_PWD'        => 'w;',
    'DB_PORT'       => '3306',
    'DB_PREFIX'     => 'ghs_',
    'DB_CHARSET'=> 'utf8',
    'DB_PARAMS' => array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_CASE => PDO::CASE_NATURAL),

    /*cookie配置定义*/
    'COOKIE_PREFIX'         =>  'mytest_',      // Cookie前缀 避免冲突
    'COOKIE_EXPIRE'         =>  0,    	// Cookie有效期
    'COOKIE_DOMAIN'         =>  '',      // Cookie有效域名
    'COOKIE_PATH'           =>  '/',     // Cookie路径
    'COOKIE_HTTPONLY'       =>  '',     // Cookie的httponly

    'SESSION_PREFIX'        =>  'mytest_',
    'SESSION_EXPIRE' => 1800, /* session 在线时间 一般15分钟 */
    'VAR_SESSION_ID'=>'mytest_session_id', /* sessionID的提交变量 php.ini 默认为 PHPSESSID */
    'SESSION_AUTO_START'    =>  true, /* 是否自动开启Session */

    /* 缓存配置 */
    'DATA_CACHE_PREFIX' => 'mytestnsp_', // 缓存前缀
    'DATA_CACHE_TYPE'   => 'File', // 数据缓存类型
    'DATA_CACHE_TIME' => 60,
    'DATA_CACHE_CHECK' => false, //数据缓存是否校验缓存

    /* 自定义配置 */
    'user_register_mobile_unique'=> true, // 注册手机唯一(一个手机只能注册一个帐号)
    'user_login_verify_code_require'=> false, // 登录开启验证码
    'user_register_type'=> array('1'=>'灵力+激活码','2'=>'推广币+猴毛')
);