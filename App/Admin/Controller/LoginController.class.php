<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * Description of BaseController
 * 登陆控制器
 * @author SAIKE
 */
class LoginController extends Controller {


    public function login(){
        layout(false);
        $this->display();
    }

}


