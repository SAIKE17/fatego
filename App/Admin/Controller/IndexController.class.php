<?php

namespace Admin\Controller;

/**
 * Description of OrderController
 * 首页控制器
 * @author SAIKE
 */
class IndexController extends BaseController {

    public function index() {
        $this->display();
    }

    /**
     * 主界面
     */
    public function main() {
        $mysql = M()->query("select version() as ver");

        $this->assign('mysql_ver', $mysql[0]['ver']);
        $this->display();
    }

}
