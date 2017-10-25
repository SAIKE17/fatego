<?php

namespace Common\Model;

/**
 * Description of AdminModel
 * 管理员模型
 * @author SAIKE
 */
class AdminModel extends BaseModel {

    // 表名
    protected $tableName = 'admin';

    /**
     * 更新用户登录时间
     * @param type $admin_id
     */
    public function update_login($admin_id) {
        $curTime = nowTime();
        $this->where(['id' => $admin_id])->save([
            'last_login_ip' => get_client_ip(),
            'last_login_time' => $curTime,
            'update_time' => $curTime
        ]);
    }

}
