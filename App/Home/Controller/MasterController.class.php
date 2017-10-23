<?php
namespace Home\Controller;

class MasterController extends BaseController {
    public function master(){
        $this->displayHtml('个人中心');
    }
}