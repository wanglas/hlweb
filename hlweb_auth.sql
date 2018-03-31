-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-31 08:43:25
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
-- 表的结构 `wx_adminer`
--

CREATE TABLE `wx_adminer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL COMMENT '密码',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL,
  `status` int(10) NOT NULL COMMENT '是否有效'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理员表';

--
-- 转存表中的数据 `wx_adminer`
--

INSERT INTO `wx_adminer` (`id`, `name`, `pwd`, `create_time`, `update_time`, `status`) VALUES
(2, 'wanglas', '964c626716f3264666fced3f344edc84', 1502693822, 0, 1),
(3, 'root', '932b19338fc62c7b98a1050be794b206', 1520049943, 0, 1);

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
  `main` varchar(100) NOT NULL COMMENT '简介',
  `content` text NOT NULL,
  `cid` tinyint(5) NOT NULL COMMENT '文章分类id',
  `cname` varchar(50) NOT NULL COMMENT '分类名称',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  `view_num` int(11) NOT NULL COMMENT '浏览量',
  `status` int(10) NOT NULL COMMENT '状态',
  `img` varchar(1000) NOT NULL COMMENT '图片路径',
  `key_words` varchar(100) NOT NULL COMMENT '文章关键词'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_article`
--

INSERT INTO `wx_article` (`id`, `title`, `main`, `content`, `cid`, `cname`, `create_time`, `update_time`, `view_num`, `status`, `img`, `key_words`) VALUES
(6, '宝顺安恭贺新春2', '嘻嘻', '&lt;p style=&quot;background:white;&quot;&gt;\r\n	&lt;strong&gt;尊敬的客户：&lt;/strong&gt; \r\n&lt;/p&gt;\r\n&lt;p style=&quot;background:white;&quot;&gt;\r\n	您好&lt;span&gt;!&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p style=&quot;text-indent:25.0pt;background:white;&quot;&gt;\r\n	新年甫至，紫气东来，万象更新。沈阳宝顺安安全设备有限公司全体员工怀着无比感恩的心情，向您致以最亲切的问候和最诚挚的谢意&lt;span&gt;!&lt;/span&gt;在此，宝顺安给您拜年了！&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot;&gt;\r\n	&lt;img src=&quot;/hlweb/Public/Uploads/image/20180228/20180228092623_14097.jpg&quot; alt=&quot;&quot; width=&quot;800&quot; height=&quot;168&quot; title=&quot;&quot; align=&quot;&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;text-indent:25.0pt;&quot;&gt;\r\n	回望&lt;span&gt;2017&lt;/span&gt;年，在各界伙伴的鼎力相助下&lt;span&gt;,&lt;/span&gt;沈阳宝顺安安全设备有限公司得到了长足的发展，销售业绩蒸蒸日上，业务范围也进一步得到了扩展，这使我们对未来充满信心，并从中感受到收获的喜悦，也深深感谢支持我们的新朋老友！&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; style=&quot;text-indent:25.0pt;&quot;&gt;\r\n	2017年是呼吸防护行业\r\n&lt;/p&gt;', 1, '行业动态', 1519804301, 1520049444, 0, 1, 'article/2018-02-28/5a965f8d49b4a.jpg', '新春快乐'),
(8, '测试', '', '', 1, '行业动态', 1520049685, 0, 0, 0, '', '');

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
(1, '行业动态', 3, 0, 1, 1519783415, 1519790636),
(2, '招聘计划', 2, 0, 1, 1519783441, 1519790653);

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
(1, '超级管理员', 1, '6,96,20,1,2,3,21,7,8,9,10,11,12,13,14,15,16,123,124,125,140,135,136,137,138,139,141,142,143,144,145,146,147,148'),
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
(1, 20, 'Admin/ShowNav/nav', '菜单管理', 1, 1, ''),
(2, 1, 'Admin/Nav/index', '菜单列表', 1, 1, ''),
(3, 1, 'Admin/Nav/add', '添加菜单', 1, 1, ''),
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
(146, 141, 'Admin/ArticleCate/add', '新增新闻分类', 1, 1, ''),
(123, 11, 'Admin/Rule/add_user_to_group', '设置为管理员', 1, 1, ''),
(124, 11, 'Admin/Rule/add_admin', '添加管理员', 1, 1, ''),
(125, 11, 'Admin/Rule/edit_admin', '修改管理员', 1, 1, ''),
(137, 135, 'Admin/Employ/delete', '删除岗位', 1, 1, ''),
(139, 0, 'Admin/OrderGoods/index', '产品管理', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `wx_cate`
--

CREATE TABLE `wx_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '品牌名称',
  `img` varchar(255) NOT NULL COMMENT '图片路径',
  `status` int(11) NOT NULL COMMENT '状态',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `update_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌表';

--
-- 转存表中的数据 `wx_cate`
--

INSERT INTO `wx_cate` (`id`, `name`, `img`, `status`, `create_time`, `update_time`) VALUES
(1, '水产类', 'cate/2017-11-03/59fbbe1b64c75.jpg', 1, '2017-11-03 08:53:47', ''),
(2, '鲜肉类', 'cate/2017-11-03/59fbbe389aeba.jpg', 1, '2017-11-03 08:54:16', ''),
(3, '水果类', 'cate/2017-11-03/59fbbe501bb8a.jpg', 1, '2017-11-03 08:54:40', ''),
(4, '酒水类', 'cate/2017-11-03/59fbbe82f1042.jpg', 1, '2017-11-03 08:55:30', ''),
(5, '蛋类', 'cate/2017-11-03/59fbbe8bc1e51.jpg', 1, '2017-11-03 08:55:39', ''),
(6, '食品类', 'cate/2017-11-03/59fbbeaa31935.jpg', 1, '2017-11-03 08:56:10', '');

-- --------------------------------------------------------

--
-- 表的结构 `wx_comment`
--

CREATE TABLE `wx_comment` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `uname` varchar(10) NOT NULL COMMENT '用户名',
  `pid` int(11) NOT NULL COMMENT '父id',
  `oid` int(11) NOT NULL COMMENT '相应订单id',
  `content` text NOT NULL COMMENT '内容',
  `img` varchar(1000) NOT NULL COMMENT '评论图片地址',
  `dz_num` int(11) NOT NULL COMMENT '点赞数量',
  `pl_num` int(11) NOT NULL COMMENT '评论数量',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` varchar(10) NOT NULL,
  `status` int(11) NOT NULL COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

--
-- 转存表中的数据 `wx_comment`
--

INSERT INTO `wx_comment` (`id`, `uid`, `uname`, `pid`, `oid`, `content`, `img`, `dz_num`, `pl_num`, `create_time`, `update_time`, `status`) VALUES
(59, 5, 'wanglas', 0, 0, '1231231231231', '', 102, 2, 1502432445, '', 1),
(60, 5, 'wanglas', 59, 0, '1', '', 6, 0, 1502432943, '', 1),
(61, 5, 'wanglas', 0, 0, '第二条', '', 51, 4, 1502437914, '', 1),
(62, 5, 'wanglas', 61, 0, '1', '', 0, 0, 1502438148, '', 1),
(63, 5, 'wanglas', 59, 0, '123', '', 14, 0, 1502670425, '', 1),
(64, 5, 'wanglas', 61, 0, '哈哈', '', 0, 0, 1502690039, '', 1),
(65, 5, 'wanglas', 61, 0, '测试', '', 0, 0, 1502690064, '', 1),
(66, 5, 'Yasuo', 61, 0, '测试', '', 0, 0, 1505114731, '', 1),
(67, 5, 'Yasuo', 0, 0, '再次测试', '', 17, 0, 1505295189, '', 1),
(68, 5, 'Yasuo', 0, 0, '2017.9.14\r\n', '', 4, 1, 1505369828, '', 1),
(69, 5, 'Yasuo', 68, 0, '回复9.14', '', 0, 1, 1505370081, '', 1),
(70, 5, 'Yasuo', 69, 0, '回复9.14——2', '', 0, 0, 1505370109, '', 1),
(71, 5, 'Yasuo', 0, 0, '哈哈哈', '', 0, 0, 1505373021, '', 1),
(72, 5, 'Yasuo', 0, 0, '哈哈', '', 0, 0, 1505374012, '', 1),
(73, 5, 'Yasuo', 0, 0, '', 'comment/2017-09-15/59bb25083d420.png', 0, 0, 1505436936, '', 1),
(74, 5, 'Yasuo', 0, 0, '', 'comment/2017-09-15/59bb258d4464a.png#comment/2017-09-15/59bb258d44d82.png', 0, 0, 1505437069, '', 1),
(75, 5, 'Yasuo', 0, 0, '9.15', 'comment/2017-09-15/59bb25d798d10.png#comment/2017-09-15/59bb25d79936a.png', 0, 0, 1505437143, '', 1),
(76, 5, 'Yasuo', 0, 0, '9.15', 'comment/2017-09-15/59bb28b4e4a43.png', 0, 0, 1505437876, '', 1),
(77, 5, 'Yasuo', 0, 0, '9.15——2', 'comment/2017-09-15/59bb28ca1a9ac.png', 0, 0, 1505437898, '', 1),
(78, 5, 'Yasuo', 0, 0, '9.15——2', 'comment/2017-09-15/59bb29025882a.png', 0, 0, 1505437954, '', 1),
(79, 5, 'Yasuo', 0, 0, '1123', 'comment/2017-09-15/59bb2a620f416.png', 0, 0, 1505438306, '', 1),
(80, 5, 'Yasuo', 0, 0, '123', 'comment/2017-09-15/59bb2a8523c0e.png#comment/2017-09-15/59bb2a852424e.png#comment/2017-09-15/59bb2a8524813.png', 0, 0, 1505438341, '', 1),
(81, 5, 'Yasuo', 0, 0, '123', 'comment/2017-09-15/59bb375d5cf5d.png#comment/2017-09-15/59bb375d5d937.png#comment/2017-09-15/59bb375d5e4a5.png', 0, 0, 1505441629, '', 1),
(82, 5, 'Yasuo', 0, 0, '9.15_4', 'yikuai/Uploads/comment/2017-09-15/59bb3c43973c1.png#yikuai/Uploads/comment/2017-09-15/59bb3c4397b06.png#yikuai/Uploads/comment/2017-09-15/59bb3c439847c.png#yikuai/Uploads/comment/2017-09-15/59bb3c4398c4c.png', 0, 0, 1505442883, '', 1),
(83, 5, 'Yasuo', 0, 0, 'final', '/yikuai/Uploads/comment/2017-09-15/59bb3d7034e92.png#/yikuai/Uploads/comment/2017-09-15/59bb3d703551e.png#/yikuai/Uploads/comment/2017-09-15/59bb3d7035ce0.png#/yikuai/Uploads/comment/2017-09-15/59bb3d703654c.png#/yikuai/Uploads/comment/2017-09-15/59bb3d7036c21.png#/yikuai/Uploads/comment/2017-09-15/59bb3d703744d.png', 0, 3, 1505443184, '', 1),
(84, 5, 'Yasuo', 0, 0, '测试', '', 0, 0, 1505445165, '', 1),
(85, 5, 'Yasuo', 0, 0, '测试', '', 0, 0, 1505445170, '', 1),
(86, 5, 'Yasuo', 0, 0, '测试', '', 0, 0, 1505445256, '', 1),
(87, 5, 'Yasuo', 0, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb45ffa704f.png', 0, 0, 1505445375, '', 1),
(88, 5, 'Yasuo', 0, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb466f01f9d.png', 0, 0, 1505445487, '', 1),
(89, 5, 'Yasuo', 0, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb46c681cf5.png', 0, 0, 1505445574, '', 1),
(90, 5, 'Yasuo', 0, 0, '123123', '/yikuai/Uploads/comment/2017-09-15/59bb4a3e21fd7.png', 1, 0, 1505446462, '', 1),
(91, 5, 'Yasuo', 0, 0, 'final_1', '/yikuai/Uploads/comment/2017-09-15/59bb4a76abf7e.png', 0, 0, 1505446518, '', 1),
(92, 5, 'Yasuo', 0, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb4aad22f2c.png', 18, 4, 1505446573, '', 1),
(93, 5, 'Yasuo', 83, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb4ac626408.png', 0, 0, 1505446598, '', 1),
(94, 5, 'Yasuo', 83, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb4ad3bcd79.png', 0, 0, 1505446611, '', 1),
(95, 5, 'Yasuo', 83, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb4ad57814c.png', 0, 0, 1505446613, '', 1),
(96, 5, 'Yasuo', 83, 0, '23123', '/yikuai/Uploads/comment/2017-09-15/59bb4aea360d1.png', 0, 0, 1505446634, '', 1),
(97, 5, 'Yasuo', 83, 0, '666', '/yikuai/Uploads/comment/2017-09-15/59bb4aff750e3.png', 0, 0, 1505446655, '', 1),
(98, 5, 'Yasuo', 83, 0, '测试图片数量', '/yikuai/Uploads/comment/2017-09-15/59bb4c0ca75ae.png#/yikuai/Uploads/comment/2017-09-15/59bb4c0ca7c9f.png', 2, 0, 1505446924, '', 1),
(99, 5, 'Yasuo', 92, 0, '子评论测试', '/yikuai/Uploads/comment/2017-09-15/59bb4e8359a7e.png', 4, 1, 1505447555, '', 1),
(100, 5, 'Yasuo', 99, 0, '三级评论测试', '/yikuai/Uploads/comment/2017-09-15/59bb4ea7ae381.png', 0, 0, 1505447591, '', 1),
(101, 5, 'Yasuo', 92, 0, '用户中心下二级评论测试', '0', 0, 0, 1505619000, '', 1),
(102, 5, 'Yasuo', 92, 0, '二次测试', '/yikuai/Uploads/comment/2017-09-17/59bdee7225a66.png', 0, 0, 1505619570, '', 1),
(103, 5, 'Yasuo', 92, 0, '哈哈', '/yikuai/Uploads/comment/2017-09-17/59bdef2a75307.png', 0, 0, 1505619754, '', 1);

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
(1, '2', 2, '2', 1, 1521535219, 1521536003);

-- --------------------------------------------------------

--
-- 表的结构 `wx_goods`
--

CREATE TABLE `wx_goods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '品牌id',
  `price` decimal(10,0) NOT NULL COMMENT '回收初始价格价',
  `img` varchar(1000) NOT NULL COMMENT '缩率图路径',
  `is_recover` int(11) NOT NULL COMMENT '是否可回收',
  `is_repair` int(11) NOT NULL COMMENT '是否可维修',
  `status` int(11) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

--
-- 转存表中的数据 `wx_goods`
--

INSERT INTO `wx_goods` (`id`, `name`, `bid`, `price`, `img`, `is_recover`, `is_repair`, `status`, `create_time`, `update_time`) VALUES
(8, '小米', 3, '0', '/yikuai/Uploads/2017-08-08/5989121f0549a.jpg', 0, 0, 1, 1501569249, 1502155295),
(9, 'iphone4', 1, '6000', '/yikuai/Uploads/2017-09-01/59a8bb978a397.png', 1, 1, 1, 1501570984, 1504230295),
(10, '华为mate10', 2, '1000', '/yikuai/Uploads/2017-08-15/59929ee121c60.jpg', 0, 0, 1, 1501572314, 1502781153),
(11, 'iphone8', 1, '8888', '/yikuai/Uploads/2017-09-12/59b7381a6325b.png', 1, 1, 1, 1502781185, 1505179674),
(12, 'iPhone se', 1, '2000', '/yikuai/Uploads/2017-08-21/599a877f8414c.jpg', 0, 1, 1, 1503295495, 1503299455),
(13, 'OPPO r8', 8, '1888', '/yikuai/Uploads/2017-08-21/599a898106735.jpg', 1, 1, 1, 1503299937, 1503299969),
(14, 'Iphone7 plus', 1, '2000', '/yikuai/Uploads/2017-09-12/59b755d13a4c2.png', 1, 1, 1, 1505184902, 1505187281);

-- --------------------------------------------------------

--
-- 表的结构 `wx_goodsrepair`
--

CREATE TABLE `wx_goodsrepair` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL COMMENT '图标路径',
  `pid` int(11) NOT NULL COMMENT '父类id',
  `create_time` varchar(10) NOT NULL COMMENT '创建时间',
  `update_time` varchar(10) NOT NULL COMMENT '更新时间',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='故障分类表';

--
-- 转存表中的数据 `wx_goodsrepair`
--

INSERT INTO `wx_goodsrepair` (`id`, `name`, `img`, `pid`, `create_time`, `update_time`, `status`) VALUES
(1, '屏幕', '/yikuai/Uploads/goodsrepair/2017-08-21/599a810b35a14.png', 0, '1503282838', '1503297803', 1),
(3, '屏幕完全碎裂', '', 1, '1503283224', '1503283891', 1),
(6, '电池', '/yikuai/Uploads/goodsrepair/2017-08-21/599a816dc8b43.png', 0, '1503297901', '', 1),
(7, '按键', '/yikuai/Uploads/goodsrepair/2017-08-21/599a817d001f1.png', 0, '1503297917', '', 1),
(8, '声音', '/yikuai/Uploads/goodsrepair/2017-08-21/599a818daf340.jpg', 0, '1503297933', '', 1),
(9, '信号', '/yikuai/Uploads/goodsrepair/2017-08-21/599a8199856cd.jpg', 0, '1503297945', '', 1),
(10, '主板', '/yikuai/Uploads/goodsrepair/2017-08-21/599a81a732697.png', 0, '1503297959', '', 1),
(11, '外壳', '/yikuai/Uploads/goodsrepair/2017-08-21/599a81b22bd6c.png', 0, '1503297970', '', 1),
(12, '软件', '/yikuai/Uploads/goodsrepair/2017-08-21/599a81c7e25e9.png', 0, '1503297991', '', 1),
(13, '摄像头', '/yikuai/Uploads/goodsrepair/2017-08-21/599a81d2460b4.png', 0, '1503298002', '', 1),
(14, '其他', '/yikuai/Uploads/goodsrepair/2017-09-21/59c339bd5171e.png', 0, '1503283628', '1505966525', 1),
(15, '屏幕划痕', '无', 1, '1503371736', '', 1),
(16, '电池无法充电', '无', 6, '1505179205', '1505179333', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wx_goods_property`
--

CREATE TABLE `wx_goods_property` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '属性名',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `gname` varchar(255) NOT NULL COMMENT '手机名称',
  `price` int(100) NOT NULL COMMENT '回收价格',
  `bid` int(11) NOT NULL COMMENT '品牌id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` int(11) NOT NULL COMMENT '状态',
  `pid` int(11) NOT NULL COMMENT '父分类'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品属性表';

--
-- 转存表中的数据 `wx_goods_property`
--

INSERT INTO `wx_goods_property` (`id`, `name`, `gid`, `gname`, `price`, `bid`, `create_time`, `update_time`, `status`, `pid`) VALUES
(2, '内存大小', 8, '', 0, 0, 1501577578, 1501639443, 1, 0),
(3, '128G', 8, '', 0, 0, 1501577718, 0, 1, 2),
(4, '尺寸', 8, '', 0, 0, 1501635879, 0, 1, 0),
(5, '8g', 9, '', 0, 0, 1501635985, 0, 1, 2),
(6, '5.7寸', 8, '', 0, 0, 1501644118, 0, 1, 4),
(7, '64G', 9, '', 0, 0, 1501644146, 1502176322, 1, 2),
(8, '64G', 8, '', 0, 0, 1502176417, 0, 1, 2),
(9, '内存', 10, '华为mate10', 0, 0, 1502178543, 0, 1, 0),
(10, '来源', 9, 'iphone4', 0, 0, 1502180287, 0, 1, 0),
(11, '港版', 9, 'iphone4', 250, 0, 1502180325, 0, 1, 10),
(12, '内存', 9, 'iphone4', 200, 0, 1502239582, 0, 1, 0),
(13, '16G', 9, 'iphone4', 400, 0, 1502239609, 0, 1, 12),
(14, '256G', 9, 'iphone4', 100, 0, 1502239622, 0, 1, 12),
(15, '保修', 9, 'iphone4', 0, 0, 1502239634, 0, 1, 0),
(16, '一个月', 9, 'iphone4', -300, 0, 1502239649, 1502239881, 1, 15),
(17, '国行', 9, 'iphone4', 0, 0, 1502258331, 0, 1, 10),
(18, '64G', 11, 'iphone8', 1000, 0, 1505179449, 0, 1, 12);

-- --------------------------------------------------------

--
-- 表的结构 `wx_personinfo`
--

CREATE TABLE `wx_personinfo` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(100) NOT NULL COMMENT '姓名',
  `tel` varchar(100) NOT NULL COMMENT '电话',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `nick_name` varchar(255) NOT NULL COMMENT '昵称',
  `sex` int(10) NOT NULL COMMENT '性别（1男，2女）',
  `address` varchar(255) NOT NULL COMMENT '城市位置',
  `detail_address` varchar(255) NOT NULL COMMENT '详细位置',
  `birthday` varchar(255) NOT NULL COMMENT '生日',
  `instruction` varchar(1000) NOT NULL COMMENT '个人介绍',
  `create_time` varchar(100) NOT NULL COMMENT '创建时间',
  `update_time` varchar(100) NOT NULL COMMENT '更新时间',
  `status` int(10) NOT NULL COMMENT '是否第一次录入（1是 2否）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_personinfo`
--

INSERT INTO `wx_personinfo` (`id`, `uid`, `name`, `tel`, `email`, `nick_name`, `sex`, `address`, `detail_address`, `birthday`, `instruction`, `create_time`, `update_time`, `status`) VALUES
(1, 0, '???', '15698843358', '869184782@qq.com', 'yasuo', 1, '???/???/???', '???', '1996.03.09', '???', '', '2017-11-03 16:37:12', 1),
(2, 0, '???', '15698843358', '869184782@qq.com', 'yasuo', 1, '???/???/???', '???', '1996.03.09', '???', '', '2017-11-03 16:37:18', 1),
(3, 5, '王佳驰', '15698843358', '869184782@qq.com', 'yasuo', 1, '辽宁省/沈阳市/大东区', '白塔路', '1996.03.09123', '很棒的', '', '2017-11-03 17:03:52', 2);

-- --------------------------------------------------------

--
-- 表的结构 `wx_quickorder`
--

CREATE TABLE `wx_quickorder` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `uname` varchar(11) NOT NULL COMMENT '用户姓名',
  `tel` varchar(100) NOT NULL COMMENT '电话',
  `address` varchar(1000) NOT NULL COMMENT '地址',
  `service` int(10) NOT NULL COMMENT '1代表维修，2代表回收',
  `content` varchar(1000) NOT NULL COMMENT '内容',
  `create_time` varchar(10) NOT NULL,
  `update_time` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wx_quickorder`
--

INSERT INTO `wx_quickorder` (`id`, `uid`, `uname`, `tel`, `address`, `service`, `content`, `create_time`, `update_time`, `status`) VALUES
(1, 5, '0', '', '', 0, '&lt;p&gt;测试 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/p&gt;', '1503625625', '', 1),
(2, 0, '王佳驰', '15698843358', '白塔路', 1, '坏了', '1506389094', '', 1),
(3, 0, '二次', '15698843358', '玩咖鸡翅', 2, '还是坏了', '1506389173', '', 1),
(4, 0, '王佳驰', '15698843358', '白塔路', 1, '坏了', '1506395299', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wx_user`
--

CREATE TABLE `wx_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL COMMENT '姓名',
  `img` varchar(255) NOT NULL COMMENT '图片路径',
  `user_pwd` varchar(255) NOT NULL COMMENT '密码',
  `user_tx_pwd` varchar(255) NOT NULL COMMENT '用户·提现密码',
  `user_tel` varchar(1000) NOT NULL COMMENT '电话',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  `user_address` varchar(255) NOT NULL COMMENT '会员地址',
  `user_money` decimal(10,0) NOT NULL COMMENT '用户总额',
  `user_money_useful` decimal(10,0) NOT NULL COMMENT '可用余额',
  `user_money_wait` decimal(10,0) NOT NULL COMMENT '待入账',
  `real_name` varchar(255) NOT NULL COMMENT '真实姓名',
  `idcard` varchar(255) NOT NULL COMMENT '身份证',
  `collect_gid` varchar(1000) NOT NULL COMMENT '商品收藏',
  `collect_aid` varchar(1000) NOT NULL COMMENT '文章收藏',
  `idcard_photo_z` varchar(1000) NOT NULL COMMENT '身份证正面',
  `photo` varchar(1000) NOT NULL COMMENT '身份证正反面',
  `idcard_photo_f` varchar(1000) NOT NULL COMMENT '身份证反面',
  `status` int(11) NOT NULL COMMENT '状态',
  `is_certificate` int(11) NOT NULL COMMENT '是否认证'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `wx_user`
--

INSERT INTO `wx_user` (`id`, `user_name`, `img`, `user_pwd`, `user_tx_pwd`, `user_tel`, `create_time`, `updatetime`, `user_address`, `user_money`, `user_money_useful`, `user_money_wait`, `real_name`, `idcard`, `collect_gid`, `collect_aid`, `idcard_photo_z`, `photo`, `idcard_photo_f`, `status`, `is_certificate`) VALUES
(5, 'Yasuo', 'user/2017-11-03/59fbe8688f31a.jpeg', '964c626716f3264666fced3f344edc84', 'd41d8cd98f00b204e9800998ecf8427e', '15698843358', 1502273674, 0, '', '1000', '233', '0', '王佳驰', '220524199603090317', '0', '', '', 'identify/2017-09-25/59c85df5bde28.png#identify/2017-09-25/59c85df5be472.png', '', 1, 2),
(6, '', '/yikuai/Uploads/user/2017-08-11/598d0e73e3b0b.jpg', '', '', '15698843360', 1502273801, 0, '', '0', '0', '0', '', '', '0', '', '', '', '', 1, 0),
(11, '', '/yikuai/Uploads/user/2017-08-14/599137a47fede.jpg', '', '', '15604614105', 1502689166, 0, '', '0', '0', '0', '', '', '0', '', '', '', '', 1, 0),
(13, '', '', '', '', '13889134996', 1504849384, 0, '', '0', '0', '0', '', '', '0', '', '', '', '', 1, 0),
(14, '', '', '', '', '15668851988', 1505443542, 0, '', '0', '0', '0', '', '', '0', '', '', '', '', 1, 0);

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
(89, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '/Upload/avatar/user2.jpg', '', '', NULL, 1, 1449199996, '', 0),
(90, 'hr', 'e10adc3949ba59abbe56e057f20f883e', '', '869184782@qq.com', NULL, 123456, 1, 1522396020, '', 0),
(91, 'hr', 'e10adc3949ba59abbe56e057f20f883e', '', '869184782@qq.com', NULL, 1111, 1, 1522396363, '', 0),
(92, 'wanglas', '964c626716f3264666fced3f344edc84', '', '869184782@qq.com', NULL, 15698843358, 1, 1522397838, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wx_adminer`
--
ALTER TABLE `wx_adminer`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wx_comment`
--
ALTER TABLE `wx_comment`
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
-- Indexes for table `wx_goodsrepair`
--
ALTER TABLE `wx_goodsrepair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_goods_property`
--
ALTER TABLE `wx_goods_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_personinfo`
--
ALTER TABLE `wx_personinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_quickorder`
--
ALTER TABLE `wx_quickorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wx_user`
--
ALTER TABLE `wx_user`
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
-- 使用表AUTO_INCREMENT `wx_adminer`
--
ALTER TABLE `wx_adminer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `wx_adv`
--
ALTER TABLE `wx_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `wx_article`
--
ALTER TABLE `wx_article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `wx_article_cate`
--
ALTER TABLE `wx_article_cate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `wx_auth_group`
--
ALTER TABLE `wx_auth_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `wx_auth_rule`
--
ALTER TABLE `wx_auth_rule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- 使用表AUTO_INCREMENT `wx_cate`
--
ALTER TABLE `wx_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `wx_comment`
--
ALTER TABLE `wx_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- 使用表AUTO_INCREMENT `wx_employ`
--
ALTER TABLE `wx_employ`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `wx_goods`
--
ALTER TABLE `wx_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `wx_goodsrepair`
--
ALTER TABLE `wx_goodsrepair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `wx_goods_property`
--
ALTER TABLE `wx_goods_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `wx_personinfo`
--
ALTER TABLE `wx_personinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `wx_quickorder`
--
ALTER TABLE `wx_quickorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `wx_user`
--
ALTER TABLE `wx_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `wx_users`
--
ALTER TABLE `wx_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
