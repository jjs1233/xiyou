<?php
namespace Admin\Controller;
use Admin\Controller;

class FriendController extends BaseController
{
    public function index($key="")
    {
        if($key === ""){
            $model = D('Friend');  
        }else{
            $where['username'] = array('like',"%$key%");
            $where['friendname'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = D('Friend')->where($where); 
        } 
        
        $model = $model->where($where)->relation(true)->order('id ASC')->select();
        $this->assign('model',$model);
        $this->display();   
    }


    public function add()
    {
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            $model = D("Friend");
            if (!$model->create()) {
                $this->error($model->getError());
            } else {
                if ($model->add()) {
                    $this->success("朋友添加成功", U('friend/index'));
                } else {
                    $this->error("朋友添加失败");
                }
            }
        }
    }

    public function update()
    {
        if (!IS_POST) {
            $model = D('friend')->relation(true)->find(I('id',$_GET['id']));
        
            $this->assign('model',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Friend");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if ($model->save()) {
                    $this->success("更新朋友成功", U('friend/index'));
                } else {
                    $this->error("更新朋友失败");
                }        
            }
        }
    }

    public function delete($id)
    {
    	$id = intval($id);
        $model = M('friend');
        $result = $model->delete($id);
        if($result){
            $this->success("用户删除成功", U('friend/index'));
        }else{
            $this->error("用户删除失败");
        }
    }
}
