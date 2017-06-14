<?php
namespace Admin\Controller;
use Admin\Controller;

class NoticeController extends BaseController
{
    public function index($key="")
    {
        if($key === ""){
            $model = M('notice');  
        }else{
            $where['intro'] = array('like',"%$key%");
            $model = M('notice')->where($where); 
        } 
        
        $model = $model->where($where)->order('id ASC')->select();
        $this->assign('model',$model);
        $this->display();   
    }

    public function add()
    {
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            $model = D("Notice");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if ($model->add()) {
                    $this->success("公告添加成功", U('notice/index'));
                } else {
                    $this->error("公告添加失败");
                }
            }
        }
    }

    public function update()
    {
        if (!IS_POST) {
            $model = M('notice')->find(I('id',$_GET['id']));
            $this->assign('model',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("notice");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if ($model->save()) {
                    $this->success("公告更新成功", U('notice/index'));
                } else {
                    $this->error("公告更新失败");
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
        $model = M('notice');
        $result = $model->delete($id);
        if($result){
            $this->success("公告删除成功", U('notice/index'));
        }else{
            $this->error("公告删除失败");
        }
    }
}
