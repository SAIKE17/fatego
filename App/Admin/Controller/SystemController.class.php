<?php

namespace Admin\Controller;

use Think\Controller;

class SystemController extends BaseController {

    public function admin_list() {
        layout(false);
        $this->display('/System/test');
    }
    
    public function test(){
//        layout(false);
        $this->display();
    }

}

