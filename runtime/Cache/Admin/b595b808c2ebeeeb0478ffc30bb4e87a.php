<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
        <title>弘利网站后台</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="/hlweb/Public/Home/images/favicon.ico"/>
    <link href="/hlweb/Public/bootstrap/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/hlweb/Public/bootstrap/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/hlweb/Public/bootstrap/css/animate.min.css" rel="stylesheet">
    <link href="/hlweb/Public/bootstrap/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <script src="/hlweb/Public/js/jquery.js"></script>
    <script src="/hlweb/Public/bootstrap/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/hlweb/Public/bootstrap/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/hlweb/Public/bootstrap/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/hlweb/Public/bootstrap/plugins/layer/layer.min.js"></script>
    <script src="/hlweb/Public/bootstrap/js/base.js"></script>
    <script src="/hlweb/Public/bootstrap/js/contabs.min.js"></script>
    <script src="/hlweb/Public/bootstrap/plugins/pace/pace.min.js"></script>
    <!-- 图标待定 -->
    <link rel="shortcut icon" href="/hlwebpublic/admin2/images/LOGO_favicon.ico">
</head>
<script type="text/javascript">
<!--
var USUALL = [],
/*常用的功能模块*/
TEMP = [],
SUALL = USUALL.concat('-', [{
    name: '最近操作',
    disabled: true
}], TEMP),
SUBMENU_CONFIG = {
    "1": {
        "id": "1",
        "pid": "0",
        "icon": "glyphicon-home",
        "name": "\u516c\u53f8\u4fe1\u606f",
        "url": "\/index.php\/Admin\/menuid\/1.html",
        "child": {
            "2": {
                "id": "2",
                "pid": "1",
                "icon": "fa-home",
                "name": "\u516c\u53f8\u4fe1\u606f",
                "url": "",
                "child": {
                    "3": {
                        "id": "3",
                        "pid": "2",
                        "icon": "",
                        "name": "\u7f51\u7ad9\u4fe1\u606f",
                        "url": "<?php echo U('Index/shouye');?>"
                    },
                    "4": {
                        "id": "4",
                        "pid": "2",
                        "icon": "",
                        "name": "\u516c\u53f8\u9996\u9875",
                        "url": "<?php echo U('Adv/index');?>"
                    },
                    "5": {
                        "id": "5",
                        "pid": "2",
                        "icon": "",
                        "name": "\u6210\u529f\u6848\u4f8b",
                        "url": "<?php echo U('Adv/index');?>"
                    },
                }
            }
        }
    },
    "74": {
        "id": "74",
        "pid": "0",
        "icon": "glyphicon-tag",
        "name": "\u4ea7\u54c1\u7ba1\u7406",
        "url": "\/index.php\/Admin\/menuid\/74.html",
        "child": {
            "75": {
                "id": "75",
                "pid": "74",
                "icon": "fa-list",
                "name": "\u4ea7\u54c1\u7c7b\u522b",
                "url": "\/index.php\/Admin\/Orders\/menuid\/75.html",
                "child": {
                    "76": {
                        "id": "76",
                        "pid": "75",
                        "icon": "",
                        "name": "\u5206\u7c7b\u5217\u8868\u000d\u000a",
                        "url": "<?php echo U('Cate/index');?>"
                    },
                }
            },
            "77": {
                "id": "77",
                "pid": "74",
                "icon": "fa-info-circle",
                "name": "\u4ea7\u54c1\u4fe1\u606f",
                "url": "\/index.php\/Admin\/Orders\/menuid\/75.html",
                "child": {
                    "7701": {
                        "id": "7701",
                        "pid": "77",
                        "icon": "",
                        "name": "\u4ea7\u54c1\u5217\u8868",
                        "url": "<?php echo U('Goods/index');?>"
                    },
                    "7702": {
                        "id": "7702",
                        "pid": "77",
                        "icon": "",
                        "name": "\u65b0\u589e\u4ea7\u54c1",
                        "url": "<?php echo U('Goods/add');?>"
                    },
                }
            },
        }
    },
    "79": {
        "id": "79",
        "pid": "0",
        "icon": "glyphicon-list-alt",
        "name": "\u65b0\u95fb\u7ba1\u7406",
        "url": "\/index.php\/Admin\/menuid\/74.html",
        "child": {
          "7901": {
              "id": "7901",
              "pid": "79",
              "icon": "fa-list",
              "name": "\u65b0\u95fb\u5206\u7c7b",
              "url": "\/index.php\/Admin\/Orders\/menuid\/75.html",
              "child": {
                  "790101": {
                      "id": "790101",
                      "pid": "7901",
                      "icon": "",
                      "name": "\u5206\u7c7b\u5217\u8868",
                      "url": "<?php echo U('ArticleCate/index');?>"
                  },
                  "790102": {
                      "id": "790102",
                      "pid": "7901",
                      "icon": "",
                      "name": "\u65b0\u589e\u5206\u7c7b",
                      "url": "<?php echo U('ArticleCate/add');?>"
                  },
              }
          },
            "7902": {
                "id": "7902",
                "pid": "79",
                "icon": "fa-file",
                "name": "\u65b0\u95fb\u6c47\u603b",
                "url": "\/index.php\/Admin\/Orders\/menuid\/75.html",
                "child": {
                    "790101": {
                        "id": "790201",
                        "pid": "7902",
                        "icon": "",
                        "name": "\u6587\u7ae0\u5217\u8868\u000d\u000a",
                        "url": "<?php echo U('Article/index');?>"
                    },
                    "790102": {
                        "id": "790202",
                        "pid": "7902",
                        "icon": "",
                        "name": "\u65b0\u589e\u6587\u7ae0\u000d\u000a",
                        "url": "<?php echo U('Article/add');?>"
                    },
                }
            },
          }
      },
    "111": {
        "id": "111",
        "pid": "0",
        "icon": "glyphicon-user",
        "name": "\u62db\u8058\u7ba1\u7406",
        "url": "\/index.php\/Admin\/menuid\/111.html",
        "child": {
            "112": {
                "id": "112",
                "pid": "111",
                "icon": "fa-pinterest",
                "name": "\u62db\u8058\u5c97\u4f4d",
                "url": "\/index.php\/Admin\/News\/menuid\/112.html",
                "child": {
                    "113": {
                        "id": "113",
                        "pid": "112",
                        "icon": "",
                        "name": "\u5c97\u4f4d\u5217\u8868",
                        "url": "<?php echo U('Employ/index');?>"
                    },
                }
            },
        }
    },

    "138": {
        "id": "138",
        "pid": "0",
        "icon": "glyphicon-cog",
        "name": "\u7cfb\u7edf\u8bbe\u7f6e",
        "url": "\/index.php\/Admin\/menuid\/138.html",
        "child": {
            "139": {
                "id": "139",
                "pid": "138",
                "icon": "fa-cog",
                "name": "\u7cfb\u7edf\u8bbe\u7f6e",
                "url": "\/index.php\/Admin\/System\/menuid\/139.html",
                "child": {
                    "140": {
                        "id": "140",
                        "pid": "139",
                        "icon": "",
                        "name": "\u670d\u52a1\u5668\u4fe1\u606f",
                        "url": "/hlweb/serverinfo.php"
                    },
                }
            },
            "144": {
                "id": "144",
                "pid": "138",
                "icon": "fa-align-justify",
                "name": "\u6743\u9650\u7ba1\u7406",
                "url": "\/index.php\/Admin\/Admin\/menuid\/144.html",
                "child": {
                    "145": {
                        "id": "145",
                        "pid": "144",
                        "icon": "",
                        "name": "\u6743\u9650\u5217\u8868\u000d\u000a",
                        "url": "<?php echo U('Rule/index');?>"
                    },
                    "146": {
                        "id": "146",
                        "pid": "144",
                        "icon": "",
                        "name": "\u7528\u6237\u7ec4 ",
                        "url": "<?php echo U('Rule/group');?>"
                    },
                    "147": {
                        "id": "147",
                        "pid": "144",
                        "icon": "",
                        "name": "\u7ba1\u7406\u5458\u5217\u8868",
                        "url": "<?php echo U('Rule/admin_user_list');?>"
                    }
                }
            },
            "210": {
                "id": "210",
                "pid": "138",
                "icon": "fa-building",
                "name": "\u6570\u636e\u5e93",
                "url": "\/index.php\/Admin\/Constant\/menuid\/210.html",
                "child": {
                    "211": {
                        "id": "211",
                        "pid": "210",
                        "icon": "",
                        "name": "\u6570\u636e\u5e93\u64cd\u4f5c",
                        "url": "<?php echo U('Db/index');?>"
                    },

                }
            }
        }
    },
},
/*主菜单区*/

imgpath = '',
times = 0,
getdescurl = '',
searchurl = '',
token = "";
//一级菜单展示
$(function () {
var html = [],B_menubar = $('#side-menu');
$.each(SUBMENU_CONFIG, function (i, o) {
    html.push('<li><a class="" href="" data-id="' + o.id + '"  ><span aria-hidden="true" class="glyphicon ' + o.icon + '"></span>' + o.name + '</a></li>');
});
$('.nav-collapse .nav').html(html.join(''));


//一级导航点击
$('.nav-collapse .nav').on('click', 'a',  function (e) {
    //取消事件的默认动作
    e.preventDefault();
    //终止事件 不再派发事件
    e.stopPropagation();
    $(this).parent().parent().addClass('current').siblings().removeClass('current');
    var data_id = $(this).attr('data-id'),
        data_list = SUBMENU_CONFIG[data_id],
        html = [],
        child_html = [],
        child_index = 0;

    if (B_menubar.attr('data-id') == data_id) {
        return false;
    };
    //显示左侧菜单
    show_left_menu(data_list['child']);
    B_menubar.html(html.join('')).attr('data-id', data_id);
    $('#side-menu').metisMenu();
    /*
    *显示左侧菜单
    <li>
   		<a href="#"><i class="fa fa-edit"></i> <span class="nav-label">我的收藏</span><span class="fa arrow"></span></a>
	    <ul class="nav nav-second-level">
	        <li><a class="J_menuItem" href="/index.php/account/shoucang.html">我的收藏</a>
	        </li>
	    </ul>
   </li>
    */
    function show_left_menu(data) {
        for (var attr in data) {
            if (data[attr] && typeof (data[attr]) === 'object') {
                //循环子对象
                if (!data[attr].url && attr === 'child') {
                    //子菜单添加识别属性
                    $.each(data[attr], function (i, o) {
                        child_index++;
                        o.isChild = true;
                        o.child_index = child_index;
                    });
                }
                show_left_menu(data[attr]); //继续执行循环(筛选子菜单)
            } else {
                if (attr === 'name') {
                    data.url = data.url ? data.url : '#';
                    if (!(data['isChild'])) {
                        //一级菜单
                        html.push('<li><a href="#" data-index="' + data.id + '"><i class="fa ' + data.icon + '"></i><span class="nav-label">' + data.name + '</span><span class="fa arrow"></span></a>');
                    } else {
                        //二级菜单
                        child_html.push('<li><a  class="J_menuItem" href="' + data.url + '" data-index="' + data.id + '">' + data.name + '</a></li>');

                        //二级菜单全部push完毕
                        if (data.child_index == child_index) {
                            html.push('<ul class="nav nav-second-level">' + child_html.join('') + '</ul></li>');
                            child_html = [];
                        }
                    }
                }
            }
        }
    };
});

//后台位在第一个导航
$('.nav-collapse .nav > li:first > a').click();
$('#side-menu li:first >  a').click();
$('#side-menu li:first > ul li:first a').click();
});
//-->
</script>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                    <div class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src='/hlweb/Public/Admin/images/tx.jpg' width="85px" height="85px"/></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"></strong></span>
                                <span class="text-muted text-xs block"><?php echo ($name); ?><b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="<?php echo u("Index/change_password");?>">修改密码</a></li>
                                <!-- li><a class="J_menuItem" href="mailbox.html">信箱</a></li -->
                                <li class="divider"></li>
                                <li><a href="<?php echo u("Public/loginout");?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element"><img alt="image" class="img-circle" src='/hlweb/Public/Admin/images/tx.jpg' width="50px" height="50px"/></div>
                    </div>
                <ul class="nav" id="side-menu">
                    <!-- li>
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">账户信息</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="/index.php/account/zhanghuxinxi.html">修改资料</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="/index.php/account/xiugaimima.html">修改密码</a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a class="J_menuItem" href="#"><i class="fa fa-columns"></i> <span class="nav-label">评论管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="/index.php/account/reviews.html">我的评论</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">我的收藏</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="/index.php/account/shoucang.html">我的收藏</a>
                            </li>
                        </ul>
                    </li -->
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <!--form role="search" class="navbar-form-custom" method="post" action="">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form -->

		  <div class="nav-collapse">
            <ul class="nav"></ul>
          </div>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <!-- li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-qq fa-fw"></i> 3条新回复
                                            <span class="pull-right text-muted small">12分钟钱</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li -->
                        <li class="dropdown hidden-xs">
                            <a class="right-sidebar-toggle" aria-expanded="false">
                                <i class="fa fa-tasks"></i> 主题
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="/index.php/Admin/hlweb/Public/logout.html" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="" frameborder="0" data-id=""></iframe>
            </div>
            <div class="footer">
            </div>
        </div>
        <!--右侧部分结束-->
        <!--右侧边栏开始-->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1">
                            <i class="fa fa-gear"></i> 主题
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                            <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                        </div>
                        <div class="skin-setttings">
                            <div class="title">主题设置</div>
                            <div class="setings-item">
                                <span>收起左侧菜单</span>
                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                        <label class="onoffswitch-label" for="collapsemenu">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定顶部</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                        <label class="onoffswitch-label" for="fixednavbar">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setings-item">
                                <span>固定宽度</span>

                                <div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                        <label class="onoffswitch-label" for="boxedlayout">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="title">皮肤选择</div>
                            <div class="setings-item default-skin nb">
                                <span class="skin-name ">
                         <a href="#" class="s-skin-0">默认皮肤</a>
                    </span>
                            </div>
                            <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-1">蓝色主题</a>
                    </span>
                            </div>
                            <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-3">黄色/紫色主题</a>
                    </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--右侧边栏结束-->
    </div>
</body>
</html>