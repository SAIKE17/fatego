<?php

return array(
    // URL模式
    'URL_MODEL' => 2,
    // 模块配置
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'),
    // 默认模块，方便前台页面的路径规划，更多配置可以通过路由来设置
    'DEFAULT_MODULE' => 'Home',
    // 模板缓存
    'TMPL_CACHE_ON' => false,
    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' => true,
    // 关闭debug仍然显示错误信息
    'SHOW_ERROR_MSG' => true,
    // 加载其他配置文件
    'LOAD_EXT_CONFIG' => 'alipay',
    // 数据库配置
//    'DB_TYPE'   => 'mysql',     // 数据库类型
//    'DB_HOST'   => '115.29.164.100', // 服务器地址
//    'DB_NAME'   => 'db_jidu',       // 数据库名
//    'DB_USER'   => 'jd_admin',      // 用户名
//    'DB_PWD'    => 'jd_2017',    // 密码
//    'DB_PORT'   => '3306',      // 端口
//    'DB_TYPE' => 'mysql', // 数据库类型
//    'DB_HOST' => 'localhost', // 服务器地址
//    'DB_NAME' => 'fatego', // 数据库名
//    'DB_USER' => 'root', // 用户名
//    'DB_PWD' => 'xiaoLong17', // 密码
//    'DB_PORT' => '3306', // 端口
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => '120.77.172.148', // 服务器地址
    'DB_NAME' => 'fatego', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => 'root', // 密码
    'DB_PORT' => '3306', // 端口
    // 模板解析设置
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => '/Public',
        '__STATIC__' => '/Public/static',
        '__ADMIN__' => '/Public/Admin',
        '__HOME__' => '/Public/Home',
        '__UPLOAD__' => '/Upload',
    ),
);
