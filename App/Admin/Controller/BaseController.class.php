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
        $this->uid = session(C('SESSION_PREFIX') . 'uid');
        if (null == $this->uid) { // 用户未登录
            redirect('/admin.php/Login/login');
        }

        $expire = session(C('SESSION_PREFIX') . 'expire');
        if ($expire - time() <= 0) { // 已超时
            session(null); // 清空缓存
            redirect('/admin.php/Login/login');
        }

        // 已登录且未超时
        $this->user = json_decode(session(C('SESSION_PREFIX') . 'user'), true);
        // 刷新缓存时间
        session(C('SESSION_PREFIX') . 'expire', time() + 3600); // 有效期一个小时
    }

    /**
     * 空操作,一般用于输出404错误
     */
    public function _empty() {
        if (!IS_AJAX) {
            send_http_status(404);
        }

        if (IS_AJAX && IS_POST) {
            $this->ajaxReturn(array('ret' => 0, 'msg' => '请求地址不存在或已经删除'));
        } else {
            $this->assign('404错误','404错误');
            $this->display('/admin.php/Common/404');
        }
    }

}
