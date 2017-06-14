<?php
/**
 * 控制器基类
 * ==============================================
 * Copyright (c)  2017 xchen All rights reserved.
 * ==============================================
 * Author: xchen <link8@qq.com>
 * Date: 2017年5月31日 9:45
 */

namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller {

    /**
     * 控制器初始化
     */
    protected function _initialize() {
        // 用户认证
        //user_auth();
    }

    /**
     * 验证是否登录
     */
    protected function checkLogin() {
        if (session('user_id') < 1) {
            if (IS_AJAX) {
                $data['info'] = '操作超时，请重新登录！';
                $data['status'] = '0';
                $data['url'] = base64_encode($_SERVER["HTTP_REFERER"]);
                $this->ajaxReturn($data);
            }
            $this->redirect('Account/login', array('referer' => base64_encode($_SERVER["HTTP_REFERER"])), 0, "需要登录系统");
        }
    }

}