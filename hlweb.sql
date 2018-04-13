-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-13 09:12:14
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hlweb`
--

-- --------------------------------------------------------

--
-- 表的结构 `wx_adv`
--

CREATE TABLE `wx_adv` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '名字',
  `url` varchar(1000) NOT NULL COMMENT '商品或者活动链接',
  `img` varchar(1000) NOT NULL COMMENT '图片路径',
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_adv`
--

INSERT INTO `wx_adv` (`id`, `name`, `url`, `img`, `status`, `create_time`, `update_time`) VALUES
(6, '活动', '', '2017-11-02/59fad4c1ba50d.jpg', 1, 1509610689, 0),
(7, '城市地图', '', '2017-11-02/59fadff542725.jpg', 0, 1509613557, 1509613757);

-- --------------------------------------------------------

--
-- 表的结构 `wx_article`
--

CREATE TABLE `wx_article` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL COMMENT '发布年份',
  `main` varchar(100) NOT NULL COMMENT '简介',
  `content` text NOT NULL,
  `cid` tinyint(5) NOT NULL COMMENT '文章分类id',
  `cname` varchar(50) NOT NULL COMMENT '分类名称',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  `view_num` int(11) NOT NULL COMMENT '浏览量',
  `status` int(10) NOT NULL COMMENT '状态',
  `is_imp` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL COMMENT '图片路径',
  `key_words` varchar(100) NOT NULL COMMENT '文章关键词'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_article`
--

INSERT INTO `wx_article` (`id`, `title`, `year`, `main`, `content`, `cid`, `cname`, `create_time`, `update_time`, `view_num`, `status`, `is_imp`, `img`, `key_words`) VALUES
(9, '精密机械零件加工', '2018', '精密零件加工精度以纳米，甚至最后以原子单位(原子晶格距离为0.1～0.2纳米)为目标时，超精密零件切削加工方法已不能适应，', '&lt;p style=&quot;color:#666666;font-family:宋体;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:16px;&quot;&gt;1、精密机械零件加工&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#666666;font-family:宋体;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:16px;&quot;&gt; 精密零件加工精度以纳米，甚至最后以原子单位(原子晶格距离为0.1～0.2纳米)为目标时，超精密零件切削加工方法已不能适应，必要借助特种精密零件加工的方法，即应用化学能、电化学能、热能或电能等，使这些能量超越原子间的联合能，从而去除工件外表的部分原子间的附着、联合或晶格变形，以达到超精密加工的目的。属于这类加工的有机械化学抛光、离子溅射和离子注入、电子束曝射、激光束加工、金属蒸镀和分子束外延等。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#666666;font-family:宋体;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:16px;&quot;&gt; 2、精密机械零件切削加工&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#666666;font-family:宋体;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:16px;&quot;&gt; 主要有精密车削、镜面磨削和研磨等。在精密车床上用通过精细研磨的单晶金刚石车刀举行微量车削,切削厚度仅1微米左右，常用于加工有色金属材料的球面、非球面和平面的反射镜等高精度、外表高度光洁的零件。例如加工核聚变装置用的直径为800毫米的非球面反射镜，最高精度可达0.1微米，外表粗糙度为Rz0.05微米。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;color:#666666;font-family:宋体;background-color:#FFFFFF;&quot;&gt;\r\n	&lt;span style=&quot;font-size:16px;&quot;&gt; 以上便是本文的详细介绍，希望对大家有帮助!如果你还想了解更多关于产品的相关信息，请您与我们的客服人员取得联系!&lt;/span&gt; \r\n&lt;/p&gt;', 3, '公司新闻', 1522655031, 1523326879, 0, 1, 1, 'article/2018-04-02/5ac1df37e345a.jpg', '精密加工');

-- --------------------------------------------------------

--
-- 表的结构 `wx_article_cate`
--

CREATE TABLE `wx_article_cate` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` tinyint(5) NOT NULL COMMENT '排序',
  `pid` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_article_cate`
--

INSERT INTO `wx_article_cate` (`id`, `name`, `sort`, `pid`, `status`, `create_time`, `update_time`) VALUES
(3, '公司新闻', 1, 0, 1, 1522654983, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_group`
--

CREATE TABLE `wx_auth_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组表';

--
-- 转存表中的数据 `wx_auth_group`
--

INSERT INTO `wx_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '6,96,20,156,157,21,7,8,9,10,11,12,13,14,15,16,123,124,125,140,135,136,137,138,139,149,150,151,152,153,154,155,141,142,143,144,145,146,147,148'),
(2, '产品管理员', 1, '6,96,1,2,3,4,56,57,60,61,63,71,72,65,67,74,75,66,68,69,70,73,77,78,82,83,88,89,90,99,91,92,97,98,104,105,106,107,108,118,109,110,111,112,117,113,114'),
(4, '文章编辑', 1, '6,96,57,60,61,63,71,72,65,67,74,75,66,68,69,73,79,80,78,82,83,88,89,90,99,100,97,98,104,105,106,107,108,118,109,110,111,112,117,113,114'),
(7, '人事', 1, '96,128,134,133');

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_group_access`
--

CREATE TABLE `wx_auth_group_access` (
  `uid` int(11) UNSIGNED NOT NULL COMMENT '用户id',
  `group_id` int(11) UNSIGNED NOT NULL COMMENT '用户组id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

--
-- 转存表中的数据 `wx_auth_group_access`
--

INSERT INTO `wx_auth_group_access` (`uid`, `group_id`) VALUES
(88, 1),
(88, 4),
(88, 7),
(89, 1),
(89, 2),
(89, 4),
(90, 7),
(91, 1),
(92, 1),
(92, 2),
(92, 4),
(92, 7);

-- --------------------------------------------------------

--
-- 表的结构 `wx_auth_rule`
--

CREATE TABLE `wx_auth_rule` (
  `id` int(11) UNSIGNED NOT NULL,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='规则表';

--
-- 转存表中的数据 `wx_auth_rule`
--

INSERT INTO `wx_auth_rule` (`id`, `pid`, `name`, `title`, `status`, `type`, `condition`) VALUES
(156, 20, 'Admin/Db/index', '数据库操作', 1, 1, ''),
(157, 156, 'Admin/Db/db_backup', '数据库备份', 1, 1, ''),
(135, 0, 'Admin/Employ/index', '招聘管理', 1, 1, ''),
(136, 135, 'Admin/Employ/add', '增加岗位', 1, 1, ''),
(21, 0, 'Admin/ShowNav/rule', '权限控制', 1, 1, ''),
(7, 21, 'Admin/Rule/index', '权限管理', 1, 1, ''),
(8, 7, 'Admin/Rule/add', '添加权限', 1, 1, ''),
(9, 7, 'Admin/Rule/edit', '修改权限', 1, 1, ''),
(10, 7, 'Admin/Rule/delete', '删除权限', 1, 1, ''),
(11, 21, 'Admin/Rule/group', '用户组管理', 1, 1, ''),
(12, 11, 'Admin/Rule/add_group', '添加用户组', 1, 1, ''),
(13, 11, 'Admin/Rule/edit_group', '修改用户组', 1, 1, ''),
(14, 11, 'Admin/Rule/delete_group', '删除用户组', 1, 1, ''),
(15, 11, 'Admin/Rule/rule_group', '分配权限', 1, 1, ''),
(16, 11, 'Admin/Rule/check_user', '添加成员', 1, 1, ''),
(140, 21, 'Admin/Rule/admin_user_list', '管理员列表', 1, 1, ''),
(20, 0, 'Admin/ShowNav/config', '系统设置', 1, 1, ''),
(6, 0, 'Admin/Index/index', '后台首页', 1, 1, ''),
(138, 135, 'Admin/Employ/edit', '编辑岗位', 1, 1, ''),
(96, 6, 'Admin/Index/shouye', '欢迎界面', 1, 1, ''),
(141, 0, 'Admin/Article/index', '新闻管理', 1, 1, ''),
(142, 141, 'Admin/Article/add', '发布新闻', 1, 1, ''),
(143, 141, 'Admin/Article/edit', '编辑新闻', 1, 1, ''),
(144, 141, 'Admin/Article/delete', '删除新闻', 1, 1, ''),
(145, 141, 'Admin/ArticleCate/index', '新闻分类列表', 1, 1, ''),
(147, 141, 'Admin/ArticleCate/edit', '编辑新闻分类', 1, 1, ''),
(148, 141, 'Admin/ArticleCate/delete', '删除新闻分类', 1, 1, ''),
(149, 139, 'Admin/Cate/index', '产品分类列表', 1, 1, ''),
(150, 139, 'Admin/Cate/add', '新增产品分类', 1, 1, ''),
(151, 139, 'Admin/Cate/edit', '编辑产品分类', 1, 1, ''),
(146, 141, 'Admin/ArticleCate/add', '新增新闻分类', 1, 1, ''),
(123, 11, 'Admin/Rule/add_user_to_group', '设置为管理员', 1, 1, ''),
(124, 11, 'Admin/Rule/add_admin', '添加管理员', 1, 1, ''),
(125, 11, 'Admin/Rule/edit_admin', '修改管理员', 1, 1, ''),
(137, 135, 'Admin/Employ/delete', '删除岗位', 1, 1, ''),
(139, 0, 'Admin/Goods/index', '产品管理', 1, 1, ''),
(152, 139, 'Admin/Cate/delete', '删除产品分类', 1, 1, ''),
(153, 139, 'Admin/Goods/add', '新增产品', 1, 1, ''),
(154, 139, 'Admin/Goods/edit', '编辑产品', 1, 1, ''),
(155, 139, 'Admin/Goods/delete', '删除产品', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `wx_cate`
--

CREATE TABLE `wx_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '分类',
  `status` int(11) NOT NULL COMMENT '状态',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `update_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌表';

--
-- 转存表中的数据 `wx_cate`
--

INSERT INTO `wx_cate` (`id`, `name`, `status`, `create_time`, `update_time`) VALUES
(8, '塑料件', 1, '1523340992', '');

-- --------------------------------------------------------

--
-- 表的结构 `wx_employ`
--

CREATE TABLE `wx_employ` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `num` int(10) NOT NULL COMMENT '数量',
  `content` text NOT NULL COMMENT '要求',
  `status` tinyint(4) NOT NULL,
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_employ`
--

INSERT INTO `wx_employ` (`id`, `name`, `num`, `content`, `status`, `create_time`, `update_time`) VALUES
(2, '注塑技工', 4, '年龄55周岁以下，三年以上注塑工作经验；能够维修和保养注塑机；能够适应倒班；', 1, 1522656213, 1523340674),
(3, '注塑操作工', 4, '年龄55周岁以下，有注塑工作经验；熟悉操作注塑机；能够适应倒班；', 1, 1522658489, 1522658586),
(4, '剪水口操作工', 4, '年龄45周岁以下，有生产注塑料件经验；了解注塑工艺流程；', 1, 1522658538, 1523434592);

-- --------------------------------------------------------

--
-- 表的结构 `wx_goods`
--

CREATE TABLE `wx_goods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '品牌id',
  `bname` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `caizhi` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `img` varchar(1000) NOT NULL COMMENT '缩率图路径',
  `content` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

--
-- 转存表中的数据 `wx_goods`
--

INSERT INTO `wx_goods` (`id`, `name`, `bid`, `bname`, `code`, `caizhi`, `color`, `weight`, `img`, `content`, `status`, `create_time`, `update_time`) VALUES
(15, '口鼻罩盖', 8, '', 'LJ09-1', '聚丙烯PP-Eps30R', '淡蓝色', '12（±0.2）g', 'goods/2018-04-12/5aced0471a54f.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043056_51281.png&quot; alt=&quot;&quot; /&gt;', 0, 1523332740, 1523507125),
(16, '扣件', 8, '', 'LJ12', '聚丙烯PPF401/T30S', '无色透明', '0.97（±0.1）g', 'goods/2018-04-12/5acec6138cb5c.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043557_68043.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500563, 0),
(18, '支架', 8, '', 'LJ14', '聚丙烯PPF401/T30S', '无色透明', '4.6（±0.2）g', 'goods/2018-04-12/5acec5ad55926.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043417_35111.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500461, 0),
(19, '插件', 8, '', 'LJ11', '聚丙烯PPF401/T30S', '无色透明', '0.82（±0.1）g', 'goods/2018-04-12/5acec5dcb1dcc.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043505_37520.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500508, 0),
(20, '头带', 8, '', 'LJ10', '聚乙烯PE-2426H', '淡蓝色', '4.9（±0.2）g', 'goods/2018-04-12/5acec4c7b65c7.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043026_79128.png&quot; alt=&quot;&quot; /&gt;', 1, 1523340846, 1523500231),
(21, '过滤件盒体', 8, '', 'LJ17', 'ABS757K', '样件为准', '24g', 'goods/2018-04-12/5aced00ec2137.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043652_63618.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500616, 1523503118),
(22, '过滤件盒盖', 8, '', 'LJ18', 'ABS757K', '样件为准', '12（±0.2）g', 'goods/2018-04-12/5acec67b1962a.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043742_58040.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500667, 0),
(23, '过滤件隔板', 8, '', 'LJ19', 'ABS757K', '样件为准', '6.4（±0.2）g', 'goods/2018-04-12/5acec6aa2ff40.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043830_22348.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500714, 0),
(24, '滤尘盒体', 8, '', 'LJ15', 'ABS757K', '样件为准', '23.2g', 'goods/2018-04-12/5aced039381f1.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412043929_17407.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500773, 1523503161),
(25, '滤尘盒盖', 8, '', 'LJ16', '聚乙烯PE-2426H', '淡蓝色', '12.4g', 'goods/2018-04-12/5acecfd22f978.png', '&lt;img src=&quot;/hlweb/Public/Uploads/image/20180412/20180412044015_84921.png&quot; alt=&quot;&quot; /&gt;', 1, 1523500818, 1523503058);

-- --------------------------------------------------------

--
-- 表的结构 `wx_users`
--

CREATE TABLE `wx_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT NULL COMMENT '激活码',
  `phone` bigint(11) UNSIGNED DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '最后登录时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_users`
--

INSERT INTO `wx_users` (`id`, `username`, `password`, `avatar`, `email`, `email_code`, `phone`, `status`, `register_time`, `last_login_ip`, `last_login_time`) VALUES
(88, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '/Upload/avatar/user1.jpg', '', '', NULL, 1, 1449199996, '', 0),
(92, 'wanglas', '964c626716f3264666fced3f344edc84', '', '869184782@qq.com', NULL, 13252817441, 1, 1522397838, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wx_adv`
--
ALTER TABLE `wx_adv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_article`
--
ALTER TABLE `wx_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_article_cate`
--
ALTER TABLE `wx_article_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_auth_group`
--
ALTER TABLE `wx_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_auth_group_access`
--
ALTER TABLE `wx_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `wx_auth_rule`
--
ALTER TABLE `wx_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `wx_cate`
--
ALTER TABLE `wx_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_employ`
--
ALTER TABLE `wx_employ`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_goods`
--
ALTER TABLE `wx_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_users`
--
ALTER TABLE `wx_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_login_key` (`username`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `wx_adv`
--
ALTER TABLE `wx_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `wx_article`
--
ALTER TABLE `wx_article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `wx_article_cate`
--
ALTER TABLE `wx_article_cate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `wx_auth_group`
--
ALTER TABLE `wx_auth_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `wx_auth_rule`
--
ALTER TABLE `wx_auth_rule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
--
-- 使用表AUTO_INCREMENT `wx_cate`
--
ALTER TABLE `wx_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `wx_employ`
--
ALTER TABLE `wx_employ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `wx_goods`
--
ALTER TABLE `wx_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `wx_users`
--
ALTER TABLE `wx_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
