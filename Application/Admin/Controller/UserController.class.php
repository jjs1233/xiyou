<?php
namespace Admin\Controller;
use Admin\Controller;

class UserController extends BaseController
{
    public function index($key="")
    {
        if($key === ""){
            $model = M('user');  
        }else{
            $where['username'] = array('like',"%$key%");
            $model = M('user')->where($where); 
        } 
        
        $users = $model->where($where)->order('user_id ASC')->select();
        $this->assign('model',$users);
        $this->display();   
    }


    public function add()
    {
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            $model = D("user");
            //验证确认密码
            $t = check_re_password();
            if($t){
                $this->error($t);
            };
            //验证账号
            $t = check_mobile_live();
            if($t){
                $this->error($t);
            };
            //验证用户名是否重复
            $t = check_username_live();
            if($t){
                $this->error($t);
            };

            if (!$model->create()) {
                $this->error($model->getError());
            }else {
                if($model->add()){
                    $this->success("用户添加成功", U('user/index'));
                }else{
                    $this->error("用户添加失败");
                }  
            }
        }
    }

    public function update()
    {
        if (!IS_POST) {
            $model = M('user')->find(I('id',$_GET['id']));
            $this->assign('model',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("user");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if($_POST['password'] != NULL){
                    $err = update_password($model);
                    if($err != NULL){
                        $this->error($err);
                        exit();
                    }
                }
                if ($model->save()) {
                    $this->success("用户更新成功", U('user/index'));
                } else {
                    $this->error("用户更新失败");
                }        
            }
        }
    }

    public function delete($id)
    {
    	$id = intval($id);
        $model = M('user');
        $result = $model->delete($id);
        if($result){
            $this->success("用户删除成功", U('user/index'));
        }else{
            $this->error("用户删除失败");
        }
    }
}
