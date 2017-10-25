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
            $user_name = I('post.user_name/s');
            $password = I('post.password/s');

            if (null == $user_name || null == $password) {
                $this->error('请输入用户名或密码');
            }

            $captcha = I('post.code/s');
            if (null == $captcha || !$this->check_captcha($captcha)) {
                $this->error('请输入正确的验证码');
            }

            $adminModel = D('Admin');
            $admin = $adminModel->where(['user_name' => $user_name])->find();
            if (null == $admin) {
                $this->error('用户不存在');
            }

            $md5_pwd = encryptPwd($password);
            if ($md5_pwd != $admin['password']) {
                $this->error('密码错误');
            }

            if (1 != $admin['status']) { // 用户状态不正确
                $this->error('当前账号已被禁用或删除，请联系管理员');
            }

            // 验证通过，更新用户最后登录时间
            $adminModel->update_login($admin['id']);

            // 缓存用户基本信息
            session('admin_id', $admin['admin_id']);
            session('admin_name', $admin['admin_name']);
            session(C('SESSION_PREFIX') . 'expire', time() + 3 * 3600);

            $this->success('登录成功', '/admin.php/Index/index');
        } else {
            layout(false);
            $this->display();
        }
    }

    /**
     * 用户登出
     */
    public function logout() {
        // 退出登录
        session('admin_id', null);
        session('admin_name', null);
        session('CUR_SESSION_EXPIRE', 0);

        $this->success('您已安全退出！', '/admin.php/Index/index');
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
