<?php
require_once 'const.php';
return array(
	//'配置项'=>'配置值'
		//数据库配置信息
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => 'localhost', // 服务器地址
		'DB_NAME' => 'hlweb', // 数据库名（诚心家品）
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => '54wanglas', // 密码
		'DB_PORT' => 3306, // 端口
		'DB_PREFIX' => 'wx_', // 数据库表前缀
		'DB_CHARSET'=> 'utf8', // 字符集
		'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
/*         'TMPL_L_DELIM'=>'<{',
        'TMPL_R_DELIM'=>'}>', */
    'PAGE_ROLLPAGE'    => 5,      // 分页显示页数
    'PAGE_LISTROWS'    => 30,     // 分页每页显示记录数
    'URL_HTML_SUFFIX'=>'html',
		//自定义success和error的提示页面模板
		'TMPL_ACTION_SUCCESS'=>'Public:success',
		'TMPL_ACTION_ERROR'=>'Public:error',
);
