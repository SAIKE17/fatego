<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * Description of BaseController
 * 基础控制器
 * @author SAIKE
 */
class BaseController extends Controller {

    // 用户ID
    public $uid = null;
    // 用户信息
    public $user = null;

    /**
     * 初始化
     */
    public function _initialize() {
//        $this->uid = session(C('SESSION_PREFIX') . 'uid');
//        if (null == $this->uid) { // 用户未登录
//            redirect('/admin.php/Login/index');
//        }
//
//        $expire = session(C('SESSION_PREFIX') . 'expire');
//        if ($expire - time() <= 0) { // 已超时
//            session(null); // 清空缓存
//            redirect('/Admin/Login/index');
//        }
//
//        // 已登录且未超时
//        $this->user = json_decode(session(C('SESSION_PREFIX') . 'user'), true);
//        // 刷新缓存时间
//        session(C('SESSION_PREFIX') . 'expire', time() + 3600); // 有效期一个小时
    }

}
