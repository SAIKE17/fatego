<?php

namespace Admin\Controller;

/**
 * Description of MysticcodeController
 * 素材控制器
 * @author SAIKE
 */
class MaterialController extends BaseController {

    public function material_list() {
        if (IS_POST) {
            // 构建请求参数
            $params = [
                'cur_page' => I('post.cur_page/d', 1),
                'page_size' => I('post.page_size/d', 25),
                'keywords' => I('post.keywords/s')
            ];

            $data = D('Material')->getList($params);
            $this->ajaxReturn(['rows' => $data['data'], 'total' => $data['count']]);
        } else {
            $this->display();
        }
    }

    /**
     * 素材添加
     */
    public function material_add() {
        if (IS_POST) {
            $name = I('post.mname/s', '');
            if (null == $name) {
                $this->error("请输入素材名称！");
            }

            $fallen_place = I('post.fallen_place/s', '');
            if (null == $fallen_place) {
                $this->error("请输入掉落地点！");
            }

            $effect = I('post.effect/s', '');
            if (null == $effect) {
                $this->error("请输入素材作用！");
            }

            $intro = I('post.intro/s', '');
            if (null == $intro) {
                $this->error("请输入素材简介！");
            }

            $type = I('post.type/d', 0);
            if (0 == $type) {
                $this->error("请选择掉落箱子类型！");
            }

            $img = I('post.img/s', '');
            if (null == $img) {
                $this->error("请上传素材图片！");
            }

            $materialModel = D("Material");
            $mData = $materialModel->where(['name' => $name, 'type' => $type])->find();
            if (null != $mData) {
                $this->error("该素材已存在！");
            }

            $res = $materialModel->add([
                'name' => $name,
                'pic' => $img,
                'type' => $type,
                'fallen_place' => $fallen_place,
                'effect' => $effect,
                'introduction' => $intro
            ]);

            if (false === $res) {
                $this->error("添加素材信息失败！");
            }

            $this->success("添加素材信息成功！", "/admin.php/Material/material_list");
        } else {
            $this->display();
        }
    }

}
