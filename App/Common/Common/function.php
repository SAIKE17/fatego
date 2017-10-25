<?php

/**
 * 当前时间
 * @return 当前Y-m-d H:i:s
 */
function nowTime() {
    return date('Y-m-d H:i:s');
}

/**
 * 密码加密
 * @param string $pwd
 * @param string $prefix
 * @return string
 */
function encryptPwd($pwd, $prefix = "fulishe") {
    return strtoupper(md5($prefix . $pwd));
}
