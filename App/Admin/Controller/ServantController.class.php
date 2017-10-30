<?php

namespace Admin\Controller;

/**
 * Description of MysticcodeController
 * 英灵控制器
 * @author SAIKE
 */
class ServantController extends BaseController{
    
    public function servant_list(){
        $this->display();
    }
    
    public function servant_add(){
        if(IS_POST){
            
            $this->error("保存英灵基本属性失败！");
            $this->success("保存英灵基本属性成功！");
        }else{
            $this->display();
        }
        
    }
}
