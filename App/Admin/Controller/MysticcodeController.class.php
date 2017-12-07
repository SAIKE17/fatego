<?php

namespace Admin\Controller;

/**
 * Description of MysticcodeController
 * 礼装控制器
 * @author SAIKE
 */
class MysticcodeController extends BaseController {

    public function mysticcode_list() {
        if(IS_POST){
            // 构建请求参数
            $params = [
                'cur_page' => I('post.cur_page/d', 1),
                'page_size' => I('post.page_size/d', 25),
                'keywords' => I('post.keywords/s')
            ];

            $data = D('MysticCode')->getList($params);
            $this->ajaxReturn(['rows' => $data['data'], 'total' => $data['count']]);
        }else{
            $this->display();
        }
        
    }

    public function mysticcode_add() {
        if (IS_POST) {
            $name = I('post.mname/s', '');
            if (null == $name) {
                $this->error("请输入礼装名称！");
            }

            $img1 = I('post.img1/s', '');
            if (null == $img1) {
                $this->error("请上传礼装图片！");
            }

            $img2 = I('post.img2/s', '');
            if (null == $img2) {
                $this->error("请上传礼装缩略图！");
            }

            $level = I('post.level/d', 0);
            if ($level <= 0) {
                $this->error("请选择礼装等级！");
            }

            $cost = I('post.cost/d', 0);
            if ($cost <= 0) {
                $this->error("请选择礼装cost！");
            }

            $bas_atk = I('post.bas_atk/d', 0);
            $max_atk = I('post.max_atk/d', 0);
            if ($bas_atk <= 0 || $max_atk <= 0) {
                $this->error("请输入正确的攻击力数值！");
            }

            if ($bas_atk > $max_atk) {
                $this->error("最大攻击力必须大于基础攻击力！");
            }

            $bas_hp = I('post.bas_hp/d', 0);
            $max_hp = I('post.max_hp/d', 0);
            if ($bas_hp <= 0 || $max_hp <= 0) {
                $this->error("请输入正确的生命值数值！");
            }

            if ($bas_hp > $max_hp) {
                $this->error("最大生命值必须大于基础生命值！");
            }

            $intro = I('post.intro/s', '');
            if (null == $intro) {
                $this->error("请输入英灵入手途径");
            }

            $mcModel = D('MysticCode');
            $mcRet = $mcModel->add([
                'name' => $name,
                'level' => $level,
                'pic' => $img1,
                'thumb' => $img2,
                'cost' => $cost,
                'bas_hp' => $bas_hp,
                'bas_atk' => $bas_atk,
                'max_hp' => $max_hp,
                'max_atk' => $max_atk,
                'skill_explain' => $intro
            ]);
            
            if(false === $mcRet){
                $this->error("添加礼装信息失败！");
            }
            
            $this->success("添加礼装信息成功！","/admin.php/Myticcode/mysticcode_list");
        } else {
            $this->display();
        }
    }

}
