<?php

namespace Admin\Controller;

/**
 * Description of MysticcodeController
 * 英灵控制器
 * @author SAIKE
 */
class ServantController extends BaseController {

    public function servant_list() {
        if (IS_POST) {
            // 构建请求参数
            $params = [
                'cur_page' => I('post.cur_page/d', 1),
                'page_size' => I('post.page_size/d', 25),
                'keywords' => I('post.keywords/s')
            ];
            
            $data = D('Servant')->getList($params);
            $this->ajaxReturn(['rows' => $data['data'], 'total' => $data['count']]);
        } else {
            $this->display();
        }
    }

    public function servant_add() {
        if (IS_POST) {
            //接受参数并且验证
            $name = I('post.sname/s');
            if (null == name) {
                $this->error("请输入英灵名称！");
            }

            $level = I('post.level/d');
            if ($level < 0) {
                $this->error("请输入正确的等级（1~100）！");
            }

            $painter = I('post.painter/s', '');
            if (null == $painter) {
                $this->error("请输入绘师！");
            }

            $attack_np = I('post.attack_np/f');
            if ($attack_up < 0) {
                $this->error("请输入攻击np率！");
            }

            $stunt_np = I('post.stunt_np/f');
            if ($stunt_np < 0) {
                $this->error("请输入宝具np率！");
            }

            $cv = I('post.cv/s', '');
            if (null == $cv) {
                $this->error("请输入英灵声优！");
            }

            $attributes = I('post.attributes/s');
            if (null == $attributes) {
                $this->error("请输入英灵属性！");
            }

            $area = I('post.area/s', '');
            if (null == $area) {
                $this->error("请输入英灵出处！");
            }

            $height = I('post.height/f');
            if ($height < 0) {
                $this->error("请输入英灵身高（cm）！");
            }

            $weight = I('post.weight/f');
            if ($weight < 0) {
                $this->error("请输入英灵体重（kg）！");
            }

            $star_drop_rate = I('post.star_drop_rate/f');
            if ($star_drop_rate < 0) {
                $this->error("请输入英灵掉星率！");
            }

            $death_rate = I('post.death_rate/f');
            if ($death_rate < 0) {
                $this->error("请输入英灵攻击即死率！");
            }

            $crit_weight = I('post.crit_weight/d');
            if ($crit_weight < 0) {
                $this->error("请输入暴击权重！");
            }

            $growing_value = I('post.growing_value/s', '');
            if (null == $growing_value) {
                $this->error("请输入成长曲线（凹，凸，平）！");
            }

            $nickname = I('post.nickname/s', '');
            if (null == $nickname) {
                $this->error("请输入英灵昵称！");
            }

            $characteristic = I('post.characteristic/s', '');
            if (null == $characteristic) {
                $this->error("请输入英灵特性！");
            }

            $get_way = I('post.get_way/s', '');
            if (null == $get_way) {
                $this->error("请输入英灵入手途径！");
            }

            $slevel = I('post.slevel/d');
            if ($slevel < 0) {
                $this->error("请选择英灵星级！");
            }

            $faction = I('post.faction/s', '');
            if (null == $faction) {
                $this->error("请输入攻击np率！");
            }

            $professional = I('post.professional/s');
            if (null == $professional) {
                $this->error("请选择英灵职阶！");
            }

            $sex = I('post.sex/d');
            if (null == $sex) {
                $this->error("请选择英灵性别！");
            }

            $servantModel = D('Servant');
            $servantData = $servantModel->where(['name' => $name])->find();
            if ($servantData != null) {
                $this->error("该英灵已存在！");
            }

            //构建上传数据
            $data = [
                'name' => $name,
                'level' => $level,
                'star_level' => $slevel,
                'faction' => $faction,
                'professional' => $professional,
                'painter' => $painter,
                'attack_np' => $attack_np,
                'stunt_np' => $stunt_np,
                'cv' => $cv,
                'attributes' => $attributes,
                'sex' => $sex,
                'area' => $area,
                'height' => $height,
                'weight' => $weight,
                'star_drop_rate' => $star_drop_rate,
                'death_rate' => $death_rate,
                'crit_weight' => $crit_weight,
                'growing_value' => $growing_value,
                'nickname' => $nickname,
                'characteristic' => $characteristic,
                'get_way' => $get_way
            ];

            $res = $servantModel->add($data);
            if ($res == false) {
                $this->error("保存英灵基本属性失败！");
            }

            $this->success('保存英灵基本属性成功！', '/admin.php/Servant/servant_list');
        } else {
            $this->display();
        }
    }

}
