<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class FriendModel extends RelationModel{
	protected $_link =array(
		'Master' => array(
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'User',
			'mapping_name' => 'master',
			'foreign_key' => 'master_id',
			'parent_key' => 'user_id',
			'mapping_fields' => 'mobile,user_name,real_name'
			),
		'Friend' => array(
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'User',
			'mapping_name' => 'friend',
			'foreign_key' => 'friend_id',
			'parent_key' => 'user_id',
			'mapping_fields' => 'mobile,user_name,real_name'
			)
	);

    protected $_validate = array(
        array('master','require','请填写主人账号！'), //
        array('master','/^1[3|4|5|8][0-9]\d{4,8}$/','请填写正确的主人账号',1,'regex',1),
        array('friend','require','请填写朋友账号！'), //
        array('friend','/^1[3|4|5|8][0-9]\d{4,8}$/','请填写正确的朋友账号',1,'regex',1),
        array('master','check_same','主人和朋友账号不能相同',1,'callback'),
        array('master','check_has','该主人和朋友关系已经存在',1,'callback'),
        array('master','check_master','该主人账号不存在',1,'callback'),
        array('master','check_friend','该朋友账号不存在',1,'callback'),
    );

    protected $_auto = array(
    	array('master_id','get_master_id',3,'callback'),
    	array('friend_id','get_friend_id',3,'callback'),
    );

    protected function check_master(){
    	$user = M('User');
       	if($user->where(array('mobile' => I('post.master')))->find()){
    		return true;
    	}else{
    		return false;
    	}
    }

    protected function check_friend(){
    	$user = M('User');
    	if($user->where(array('mobile' => I('post.friend')))->find()){
    		return true;
    	}else{
    		return false;
    	}
    }

    //验证主人和朋友账号
    protected function check_same(){
    	$m = I('post.master');
    	$f = I('post.friend');
    	if($m == $f){
    		return false;
    	}else{
            return true;
    	}
    }

    protected function check_has(){
        $m_id = self::get_master_id();
        $f_id = self::get_friend_id();
        if($this->where(array('master_id' => $m_id,'friend_id' => $f_id))->find()){
            return false;
        }else{
            return true;
        }
    }

    protected function get_master_id(){
    	$user = M('User');
    	$t = $user->where(array('mobile' => I('post.master')))->find();
    	if($t){
    		return $t['user_id'];
    	}else{
    		return false;
    	}
    }

    protected function get_friend_id(){
    	$user = M('User');
    	$t = $user->where(array('mobile' => I('post.friend')))->find();
    	if($t){
    		return $t['user_id'];
    	}else{
    		return false;
    	}
    }
}