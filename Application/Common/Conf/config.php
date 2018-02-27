<?php
return array(
  /* URL访问方式设置 */
  'URL_MODEL' => 1,
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
);
