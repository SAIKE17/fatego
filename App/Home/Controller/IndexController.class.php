<?php
namespace Home\Controller;

class IndexController extends BaseController {
    public function index(){
        layout(false);
        $this->displayHtml('首页');
    }
}