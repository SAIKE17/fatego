<?php

namespace Common\Model;

/**
 * Description of ResModel
 * 资源模型表
 * @author SAIKE
 */
class ResModel extends BaseModel {

    protected $tableName = 'resource';

    /**
     * 通过ID获取文件信息
     * @param int $id
     * @return []
     */
    public function getDataById($id) {
        $data = $this->where(['id' => $id])->find();

        return (null == $data) ? [] : $data;
    }
    
    /**
     * 通过md5获取文件信息
     * @param string $md5
     * @return []
     */
    public function getDataByMd5($md5) {
        $data = $this->where(['md5' => $md5])->find();

        return (null == $data) ? [] : $data;
    }
    
    /**
     * 通过图片路径获取信息
     * @param string $url
     * @return int
     */
    public function getDataByUrl($url){
        $data = $this->where(['url' => $url])->find();
        
        return (null == $data) ? [] : $data;
    }
    
    public function addRes($file) {
        $id = $this->add([
            'md5' => $file['md5'],
            'url' => $file['savepath'] . $file['savename'],
            'ext' => $file['ext'],
            'type' => $file['type'],
            'size' => $file['size']
        ]);
        
        return (false == $id) ? 0 : $id;
    }

}
