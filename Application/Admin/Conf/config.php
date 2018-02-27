<?php
return array(
	//'配置项'=>'配置值'
		//数据库配置信息
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => 'localhost', // 服务器地址
		'DB_NAME' => 'cxjp', // 数据库名（诚心家品）
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => '54wanglas', // 密码
		'DB_PORT' => 3306, // 端口
		'DB_PREFIX' => 'wx_', // 数据库表前缀
		'DB_CHARSET'=> 'utf8', // 字符集
		'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

		//模板自动跳转设置
		'TMPL_ACTION_SUCCESS' => 'Public:success',
		'TMPL_ACTION_ERROR' => 'Public:error',

		//多语言定义
		'LANG_SWITCH_ON' => true,   // 开启语言包功能
	  'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
		'DEFAULT_LANG' => 'zh-cn', // 默认语言
		'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
		'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
		'ADMIN_TEMPLATE'     => 'Admin', // 默认变量Template/
);
