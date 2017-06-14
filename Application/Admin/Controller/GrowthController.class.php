<?php
namespace Admin\Controller;
use Admin\Controller;


class GrowthController extends BaseController
{
    public function index($key="")
    {
        if($key === ""){
            $model = M('growth');  
        }else{
            $where['money'] = array('like',"%$key%");
            $where['soul'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = M('growth')->where($where); 
        } 
        
        $model = $model->where($where)->select();
        foreach ($model as $key => $value) {
        $model[$key]['user'] = M('user')->where(
            array('user_id' => $value['user_id']))->find();
        }
        $this->model = $model;
        $this->display();   
    }


    public function add()
    {
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            $user = M('user')->where(array('mobile' => $_POST['mobile']))->find();
            $_POST['user_id'] = $user['id'];
            $model = D("growth");
            if (!$model->create()) {
                $this->error($model->getError());
            } else {
                if ($model->add()) {
                    $this->success("成长添加成功", U('growth/index'));
                } else {
                    $this->error("成长添加失败");
                }
            }
        }
    }
    
    public function update()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('growth')->find(I('id',$_GET['id']));
            $model['user'] = M('user')->where(array('id' => $model['user_id']))->find();
            $this->assign('model',$model);
            $this->display();
        }
        if (IS_POST) {
            $user = M('user')->where(array('username' => $_POST['username']))->find();
            if($user == NULL){
                $this->error('该账号不存在');
                exit();
            }
            $_POST['user_id'] = $user['user_id'];
            $model = D("growth");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if ($model->save()) {
                    $this->success("成长更新成功", U('growth/index'));
                } else {
                    $this->error("成长更新失败");
                }        
            }
        }
    }
    /**
     * 删除分类
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $id = intval($id);
        $model = M('growth');
        $result = $model->delete($id);
        if($result){
            $this->success("分类删除成功", U('growth/index'));
        }else{
            $this->error("分类删除失败");
        }
    }
}
