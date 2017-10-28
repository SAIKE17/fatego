<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * Description of CommonController
 * 通用控制器
 * @author SAIKE
 */
class CommonController extends Controller {

    /**
     * 文件上传
     */
    public function upload() {
        $category = I('post.cat/s');
        if (null == $category) {
            $category = 'Admin';
        } else {
            $category = 'System/' . $category;
        }

        $file_dir = C('FILE_UPLOAD_DIR');
        if (null == $file_dir) {
            $file_dir = ROOT_PATH . '/Upload/';
        }

        $files = $this->multi_file_fix($_FILES);
        $upload = new \Think\Upload(); // 实例化上传类
        $upload->maxSize = 200 * 1024 * 1024; // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx'); // 设置附件上传类型
        $upload->rootPath = $file_dir; // 设置附件上传根目录
        $upload->subName = "";

        // 上传文件 
        $list = [];
        $resModel = D('Res');
        foreach ($files as $file) {
            $file_md5 = md5_file($file['tmp_name']);
            // 检测当前文件是否已上传
            $data = $resModel->getDataByMd5($file_md5);
            if (null != $data) {
                $list[] = ['id' => $data['id'], 'md5' => $file_md5, 'url' => $data['url']];
            } else {
                $fileName = create_guid();
                $category = $category . '/' . substr($fileName, 0, 2) . '/' . substr($fileName, 2, 2) . '/' . substr($fileName, 4, 2) . '/';
                $upload->savePath = $category; // 设置附件上传（子）目录
                $upload->saveName = $fileName;
                $ret = $upload->uploadOne($file);
                if ($ret) { // 成功，追加至资源数据库
                    $url = $ret['savepath'] . $ret['savename'];
                    $id = $resModel->addRes($ret);
                    if ($id > 0) {
                        $list[] = ['id' => $id, 'md5' => $ret['md5'], 'url' => $url];
                    } else {
                        @unlink($file_dir . $url);
                    }
                }
            }
        }
        $response = [];
        if (null == $list) {// 上传错误提示错误信息
            $response = ['ret' => -1, 'msg' => $upload->getError()];
        } else {// 上传成功
            $response = ['ret' => 0, 'msg' => 'success', 'files' => $list];
        }

        $this->ajaxReturn($response);
    }

    /**
     * 调整文件上传
     * @param type $files
     * @return type
     */
    protected function multi_file_fix($files = null) {
        $fileArray = array();
        $n = 0;
        foreach ($files as $key => $file) {
            if (is_array($file['name'])) {
                $keys = array_keys($file);
                $count = count($file['name']);
                for ($i = 0; $i < $count; $i++) {
                    $fileArray[$n]['key'] = $key;
                    foreach ($keys as $_key) {
                        $fileArray[$n][$_key] = $file[$_key][$i];
                    }
                    $n++;
                }
            } else {
                $fileArray = $files;
                break;
            }
        }
        return $fileArray;
    }

    /**
     * 显示图片文件
     */
    public function thumb() {
        $src = I('get.src/s');
        $w = I('get.w/d', 0);
        $h = I('get.h/d', 0);

        if ($src) {
            $file_dir = C('FILE_UPLOAD_DIR');
            if (null == $file_dir) {
                $file_dir = ROOT_PATH . '/Upload/';
            }

            $thumbSrc = $file_dir . $src;
            if (is_file($thumbSrc)) {
                $mtime = filemtime($thumbSrc);
                $gmdate_mod = gmdate('D, d M Y H:i:s', $mtime) . ' GMT';
            } else {
                send_http_status(404);
                return false;
            }

            if ($w > 0 && $h > 0) { // 
            } else {
                readfile($thumbSrc);
            }

            header('Last-Modified: ' . $gmdate_mod);
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60 * 60 * 24 * 30)) . ' GMT');
            header('Content-Length: ' . filesize($thumbSrc));
            readfile($thumbSrc);
        }
    }

}
