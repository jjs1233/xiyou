<?php 
    function get_sex($sex){
    	if($sex == 1){
    		return '女';
    	}elseif($sex == 2){
    		return  '女';
    	}else{
    		return '未知';
    	}
    }

    //检查账号是否已经存在
    function check_mobile_live(){
    	$mobile = I('post.mobile');
    	$user = M('User')->where(array('mobile' => $mobile))->find();
    	if($user){
    		return '账号已经存在';
    	}
    }
    //检查用户名是否已经存在
    function check_username_live(){
    	$m = I('post.user_name');
    	$user = M('User')->where(array('user_name' => $m))->find();
    	if($user){
    		return '用户名已经存在';
    	}
    }

    //检查确认密码是否正确
    function check_re_password(){
    	$post = I('post.');
    	$p = $post['password'];
    	$r_p = $post['re_password'];
    	if(empty($p)){
    		return '密码不能为空';
    	}
    	if($p != $r_p){
    		return '确认密码输入错误';
    	}
    	return false;
    }

    function passCompile($str, $key = '', $pass_is_md5 = false) {
        return '' === $str ? '' : md5(($pass_is_md5 ? $str : md5($str)) . $key . C('DATA_AUTH_KEY'));
    }
  	//
    function update_password(&$m){
    	$post = I('post.');
    	$p = $post['password'];
    	$id = $post['user_id'];
    	$user = M('User')->find($id);
    	$t = passCompile($p,$user['salt']);
    	if($user['password'] == $t){
    		return '新密码与旧密码相同';
    	}else{
    		$m->password = $t;
    	}
    }
?>