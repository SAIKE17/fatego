<?php

namespace Common\Model;

/**
 * Description of AdminModel
 * 礼装模型
 * @author SAIKE
 */
class MysticCodeModel extends BaseModel {

    // 表名
    protected $tableName = 'mysticcode';
    
    /**
     * 获取英灵列表
     * @param type $params
     */
    public function getList($params) {
        $where = [];
        
        if (null != $params['keywords']) {
            $where['name'] = ['like', '%' . $params['keywords'] . '%' ];
        }
                
        $count = $this->where($where)->count();
        if (0 == $count) {
            return [
                'count' => 0,
                'data' => []
            ];
        }
        
        $list = $this->page($params['cur_page'], $params['page_size'])->where($where)->select();
        if (null == $list) {
            return [
                'count' => 0,
                'data' => []
            ];
        }
        
        return [
            'count' => $count,
            'data' => $list
        ]; 
    }

}
