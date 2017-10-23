<?php
namespace Home\Controller;

class LoginController extends BaseController {
    public function login(){
        layout(false);
        $this->displayHtml('登录');
    }
}