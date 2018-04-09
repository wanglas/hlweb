<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <?php $admin_title = '[title]'; ?>
    <title><?php echo ($admin_title); ?></title>
    <!--[if lt IE 9]><meta http-equiv="refresh" content="0;ie.html" /><![endif]-->
    <link rel="shortcut icon" href="/Public/Home/images/favicon.ico"/>
    <link href="/hlweb/Public/bootstrap/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/hlweb/Public/bootstrap/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/hlweb/Public/bootstrap/css/animate.min.css" rel="stylesheet">
    <link href="/hlweb/Public/bootstrap/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/hlweb/Public/Admin/css/page.css" rel="stylesheet">
    <script src="/hlweb/Public/js/jquery.js"></script>
    <script src="/hlweb/Public/bootstrap/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/hlweb/Public/bootstrap/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/hlweb/Public/bootstrap/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/hlweb/Public/bootstrap/plugins/layer/layer.min.js"></script>
    <script src="/hlweb/Public/bootstrap/js/base.js"></script>
    <script src="/hlweb/Public/bootstrap/js/contabs.min.js"></script>
    <script src="/hlweb/Public/bootstrap/plugins/pace/pace.min.js"></script>
    <!-- <script src="/hlweb/Public/css/style.css"></script> -->
<script type="text/javascript">
<!--
//指定当前组模块URL地址
var URL = '/hlweb/Admin/Index';var PUBLIC = '/hlweb/Public';var ROOT_PATH = '/hlweb';var APP = '/hlweb'+'/'+'<?php echo ($group_name); ?>';var STATIC = '__TMPL__Static';
var CURR_MODULE = '<?php echo ($module_name); ?>';var CURR_ACTION = '<?php echo ($action_name); ?>';var CURR_GROUP = '<?php echo ($group_name); ?>';
//定义JS中使用的语言变量
var CONFIRM_DELETE = '<?php echo (L("CONFIRM_DELETE")); ?>';var AJAX_LOADING = '<?php echo (L("AJAX_LOADING")); ?>';var AJAX_ERROR = '<?php echo (L("AJAX_ERROR")); ?>';var ALREADY_REMOVE = '<?php echo (L("ALREADY_REMOVE")); ?>';var SEARCH_LOADING = '<?php echo (L("SEARCH_LOADING")); ?>';var CLICK_EDIT_CONTENT = '<?php echo (L("CLICK_EDIT_CONTENT")); ?>';
//-->
</script>
</head>


<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">月</span>
                        <h5>交易额</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($total_money); ?></h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i>
                        </div>
                        <small>总收入</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">全年</span>
                        <h5>订单</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($order_num); ?></h1>
                        <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i>
                        </div>
                        <small>新订单</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">今天</span>
                        <h5>访客</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">106,120</h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i>
                        </div>
                        <small>新访客</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">最近一个月</span>
                        <h5>活跃用户</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">80,600</h1>
                        <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                        </div>
                        <small>12月</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>订单</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-white active">天</button>
                                <button type="button" class="btn btn-xs btn-white">月</button>
                                <button type="button" class="btn btn-xs btn-white">年</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <ul class="stat-list">
                                    <li>
                                        <h2 class="no-margins">2,346</h2>
                                        <small>订单总数</small>
                                        <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 48%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">4,422</h2>
                                        <small>最近一个月订单</small>
                                        <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 60%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">9,180</h2>
                                        <small>最近一个月销售额</small>
                                        <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 22%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>消息</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content ibox-heading">
                        <h3><i class="fa fa-envelope-o"></i> 新消息</h3>
                        <small><i class="fa fa-tim"></i> 您有22条未读消息</small>
                    </div>
                    <div class="ibox-content">
                        <div class="feed-activity-list">

                            <div class="feed-element">
                                <div>
                                    <small class="pull-right text-navy">1月前</small>
                                    <strong>井幽幽</strong>
                                    <div>有人说：“一辈子很长，要跟一个有趣的人在一起”。我想关注我的人，应该是那种喜欢找乐子也乐意分享乐趣的人，你们一定挺优秀的。所以单身的应该在这条留言，互相勾搭一下。特别有钱人又帅可以直接私信我！</div>
                                    <small class="text-muted">4月11日 00:00</small>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div>
                                    <small class="pull-right">2月前</small>
                                    <strong>马伯庸 </strong>
                                    <div>又方便，又防水，手感又好，还可以用手机遥控。简直是拍戏利器，由其是跟老师们搭戏的时候…想想还有点小激动啊，嘿嘿。</div>
                                    <small class="text-muted">11月8日 20:08 </small>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div>
                                    <small class="pull-right">5月前</small>
                                    <strong>芒果宓 </strong>
                                    <div>一个完整的梦。</div>
                                    <small class="text-muted">11月8日 20:08 </small>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div>
                                    <small class="pull-right">5月前</small>
                                    <strong>刺猬尼克索</strong>
                                    <div>哈哈哈哈 你卖什么萌啊! 蠢死了</div>
                                    <small class="text-muted">11月8日 20:08 </small>
                                </div>
                            </div>


                            <div class="feed-element">
                                <div>
                                    <small class="pull-right">5月前</small>
                                    <strong>老刀99</strong>
                                    <div>昨天评论里你见过最“温暖和感人”的诗句，整理其中经典100首，值得你收下学习。</div>
                                    <small class="text-muted">11月8日 20:08 </small>
                                </div>
                            </div>
                            <div class="feed-element">
                                <div>
                                    <small class="pull-right">5月前</small>
                                    <strong>娱乐小主 </strong>
                                    <div>你是否想过记录自己的梦？你是否想过有自己的一个记梦本？小时候写日记，没得写了就写昨晚的梦，后来变成了习惯………翻了一晚上自己做过的梦，想哭，想笑…</div>
                                    <small class="text-muted">11月8日 20:08 </small>
                                </div>
                            </div>
                            <div class="feed-element">
                                <div>
                                    <small class="pull-right">5月前</small>
                                    <strong>DMG电影 </strong>
                                    <div>《和外国男票乘地铁，被中国大妈骂不要脸》妹子实在委屈到不行，中国妹子找外国男友很令人不能接受吗？大家都来说说自己的看法</div>
                                    <small class="text-muted">11月8日 20:08 </small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>用户项目列表</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>状态</th>
                                            <th>日期</th>
                                            <th>用户</th>
                                            <th>值</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><small>进行中...</small>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 11:20</td>
                                            <td>青衣5858</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 24%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-warning">已取消</span>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 10:40</td>
                                            <td>徐子崴</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 66%</td>
                                        </tr>
                                        <tr>
                                            <td><small>进行中...</small>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 01:30</td>
                                            <td>姜岚昕</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 54%</td>
                                        </tr>
                                        <tr>
                                            <td><small>进行中...</small>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 02:20</td>
                                            <td>武汉大兵哥</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 12%</td>
                                        </tr>
                                        <tr>
                                            <td><small>进行中...</small>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 09:40</td>
                                            <td>荆莹儿</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 22%</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label label-primary">已完成</span>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 04:10</td>
                                            <td>栾某某</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 66%</td>
                                        </tr>
                                        <tr>
                                            <td><small>进行中...</small>
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> 12:08</td>
                                            <td>范范范二妮</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 23%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>任务列表</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <ul class="todo-list m-t small-list ui-sortable">
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                        <span class="m-l-xs todo-completed">开会</span>

                                    </li>
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                        <span class="m-l-xs  todo-completed">项目开发</span>

                                    </li>
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                        <span class="m-l-xs">修改bug</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1小时</small>
                                    </li>
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                        <span class="m-l-xs">修改bug</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1小时</small>
                                    </li>
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                        <span class="m-l-xs">修改bug</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1小时</small>
                                    </li>
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                        <span class="m-l-xs">修改bug</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1小时</small>
                                    </li>
                                    <li>
                                        <a href="widgets.html#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                        <span class="m-l-xs">修改bug</span>
                                        <small class="label label-primary"><i class="fa fa-clock-o"></i> 1小时</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>交易地区</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table table-hover margin bottom">
                                            <thead>
                                                <tr>
                                                    <th style="width: 1%" class="text-center">序号</th>
                                                    <th>交易</th>
                                                    <th class="text-center">日期</th>
                                                    <th class="text-center">销售额</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>防盗门
                                                        </small>
                                                    </td>
                                                    <td class="text-center small">2014.9.15</td>
                                                    <td class="text-center"><span class="label label-primary">&yen;483.00</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>衣柜
                                                    </td>
                                                    <td class="text-center small">2014.9.15</td>
                                                    <td class="text-center"><span class="label label-primary">&yen;327.00</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>防盗门
                                                    </td>
                                                    <td class="text-center small">2014.9.15</td>
                                                    <td class="text-center"><span class="label label-warning">&yen;125.00</span>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td>橱柜</td>
                                                    <td class="text-center small">2014.9.15</td>
                                                    <td class="text-center"><span class="label label-primary">&yen;344.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td>手机</td>
                                                    <td class="text-center small">2014.9.15</td>
                                                    <td class="text-center"><span class="label label-primary">&yen;235.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">6</td>
                                                    <td>显示器</td>
                                                    <td class="text-center small">2014.9.15</td>
                                                    <td class="text-center"><span class="label label-primary">&yen;100.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="world-map" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</html>