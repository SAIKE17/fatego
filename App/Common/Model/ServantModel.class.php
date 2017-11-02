<?php

namespace Common\Model;

/**
 * Description of ServantModel
 * 英灵基本属性控制器
 * @author SAIKE
 */
class ServantModel extends BaseModel {
    //表名
    protected $tableName = 'servant';
    
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
