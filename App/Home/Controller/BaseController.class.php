<?php

/**
 * Description of BaseController
 * 控制器基类
 * @author bluey
 */

namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller {
    
    // 当前用户UID
    public $uId = null;
    
    // 用户对象
    public $user_name = '';

    /**
     * 控制器初始化操作
     */
    public function _initialize() {
        $this->uId = session('?userid') ? session('userid') : null;
        $isexpire = ((time() - session('CURSEESIONEXPIRE')) > 0) ? true : false;
        if (!isset($this->uId) || $isexpire) {  // 用户未登录/登录已超时
            session('userid', null);               // 清空用户ID
            session('user_name', null);             // 清空用户登录
        } else {
//            $this->user_name = session('?user_name') ? session('user_name') : '';
            session('CURSEESIONEXPIRE', time() + 3600); // 刷新过期时间
        }
        
        // 基础赋值
        $this->assign('userid', $this->uId);
        $this->assign('user_name', $this->user_name);   
    }

    /**
     * 空操作,一般用于输出404错误
     */
    public function _empty() {
        if (!IS_AJAX) {
            send_http_status(404);
        }

        if (IS_AJAX && IS_POST) {
            $this->ajaxReturn(array('ret' => 0, 'msg' => '请求地址不存在或已经删除'));
        } else {
            $this->displayHtml('404错误', 'Common:404');
        }
    }

    /**
     * 扩展渲染模板,(设置网页标题)
     * @param string $htmlTitle
     */
    public function displayHtml($htmlTitle, $tpl = '') {
        $this->assign('html_title', $htmlTitle);
        $this->display($tpl);
    }

    /**
     * 扩展渲染模板,$tags = [['key'=> '', 'value'=>'',],]
     * @param string $htmlTitle
     */
    public function displayTags($tags, $tpl = '') {
        if (is_array($tags)) {
            foreach ($tags as $v) {
                $this->assign($v['key'], $v['value']);
            }
        }
        $this->display($tpl);
    }

    /**
     * 基于tp的pageBar
     */
    public function pageBar($totalRows, $listRows = 20, $parameter = array()) {
        $page = new \Think\Page($totalRows, $listRows, $parameter);
        $page->rollPage = 5;
        $page->lastSuffix = false;
        $page->setConfig('header', '<span class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</span>&nbsp;');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        return $page->show();
    }
    

}
