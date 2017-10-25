<?php

namespace Common\Model;

use \Think\Model;

/**
 * Description of BaseModel
 * 基本模型
 * @author SAIKE
 */
class BaseModel extends Model {

    /**
     * 更新
     * @param $data 包含主键的内容更新
     */
    public function update($data) {
        return $this->save($data);
    }

}
