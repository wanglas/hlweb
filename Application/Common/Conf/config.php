<?php
return array(
  /* URL访问方式设置 */
  'URL_MODEL' => 2,
  'URL_HTML_SUFFIX' => '.html', // URL伪静态后缀设置
  'URL_ROUTER_ON'   => true,
  'URL_PATHINFO_DEPR' => '/', // PATHINFO模式下，各参数之间的分割符号
  'URL_CASE_INSENSITIVE' => true, // URL地址是否不区分大小写
    // 语言包
  'LANG_SWITCH_ON' => true,   // 开启语言包功能
  'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
  'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
  'VAR_LANGUAGE'     => 'l', // 默认语言切换变量

  'DATA_CACHE_TYPE' => 'Memcache',
  'MEMCACHE_HOST'   => 'tcp://172.17.124.180:12000',
  'DATA_CACHE_TIME' => '3600',

  'AUTH_CONFIG' => array(
   'AUTH_ON' => true, //认证开关
   'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
   'AUTH_GROUP' => 'wx_auth_group', //用户组数据表名
   'AUTH_GROUP_ACCESS' => 'wx_auth_group_access', //用户组明细表
   'AUTH_RULE' => 'wx_auth_rule', //权限规则表
   'AUTH_USER' => 'wx_users'//用户信息表
)
);
