<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * Description of BaseController
 * 登陆控制器
 * @author SAIKE
 */
class LoginController extends Controller {

    /**
     * 登陆
     */
    public function login() {
        if (IS_POST) {
            
            $a = I('post.');
            
            $this->error("登陆失败！");
            $this->success("登陆成功！");
        } else {
            layout(false);
            $this->display();
        }
    }

    /**
     * 获取验证码
     */
    public function captcha() {
        // 验证码参数
        $config = array(
            'imageW' => 100,
            'imageH' => 28,
            'length' => 4,
            'useNoise' => false,
            'fontSize' => 14,
            'bg' => array(255, 255, 255),
        );

        // 生成验证码
        $verify = new \Think\Verify($config);
        $verify->entry('fls');
    }

    /**
     * 检测验证码
     */
    private function check_captcha($code, $id = 'fls') {
        $verify = new \Think\Verify();

        return $verify->check($code, $id);
    }

}
