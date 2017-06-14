<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//session
	const token = 'dasdasdasdacncuscuisucins';

    public function index(){
    	$this->display();
    }

    /**
    *@package 控制条界面
    **/
    public function admin(){
    	$this->check_token();
    	$this->display();
    }

    /**
    *@package 公告
    **/
    public function notice(){
    	$this->check_token();

    	if(empty($_GET['page'])){
    		$_GET['page'] = 1; 
    	}

    	$l = 3;
    	$pro = M('notice')->order('date desc,id desc')->page($_GET['page'],$l)->select();

    	if(empty($pro)){
    		$this->error('异常');
    	}else{
			$this->datas = $pro;
    	}

    	$cou = M('notice')->count();
    	$this->pages = $cou / $l;

    	$this->display();
    }
 

    /**
    *@package 成长记录 
    **/
    public function growth(){
    	$this->check_token();

        if(empty($_GET['page'])){
            $_GET['page'] = 1; 
        }

        $l = 5;
    	$datas = M('growth')->where(array('user_id' => session('user_id')))->order('date asc')->page($_GET['page'],$l)->select();

        $cou = M('growth')->where(array('user_id' => session('user_id')))->count();

        $this->pages = $cou / $l;

    	$this->datas = $datas;
         
    	$this->display();
    }

    /**
    *@package 我的好友 
    **/
    public function friend(){
    	$this->check_token();
        if(empty($_GET['class'])){
            session('class','一级会员');
        }else{
            session('class',$_GET['class']);
        }
        $model = M('friend')->alias('s')->join('__USER__ f on s.friend_id = f.user_id')->where(array('f.class' => session('class'),'f.master_id' => session('user_id')));

    	$datas = $model->field('user_name,mobile,real_name,class,grade')->select();
        
        $l = 10;
        $cou = $model->count();

        $this->pages = $cou / $l;

    	$this->datas = $datas;
    	
    	$this->display();
    }

    /**
    *@package 验证token
    **/
    private function check_token(){
        $this->username = session('user_name');
        $this->mobile = session('mobile');
    	if(session('token') != self::token){
    		exit("404 not found");
    	}
    }
}
?>