<?php

namespace Admin\Controller;

/**
 * Description of MysticcodeController
 * 素材控制器
 * @author SAIKE
 */
class MaterialController extends BaseController{
    
    public function material_list(){
        $this->display();
    }
    
    /**
     * 素材添加
     */
    public function material_add(){
        if(IS_POST){
            
        }else{
            $this->display();
        }
        
    }
}
