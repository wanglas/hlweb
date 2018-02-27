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
var URL = '/hlweb/index.php/Admin/Adminer';var PUBLIC = '/hlweb/Public';var ROOT_PATH = '/hlweb';var APP = '/hlweb/index.php'+'/'+'<?php echo ($group_name); ?>';var STATIC = '__TMPL__Static';
var CURR_MODULE = '<?php echo ($module_name); ?>';var CURR_ACTION = '<?php echo ($action_name); ?>';var CURR_GROUP = '<?php echo ($group_name); ?>';
//定义JS中使用的语言变量
var CONFIRM_DELETE = '<?php echo (L("CONFIRM_DELETE")); ?>';var AJAX_LOADING = '<?php echo (L("AJAX_LOADING")); ?>';var AJAX_ERROR = '<?php echo (L("AJAX_ERROR")); ?>';var ALREADY_REMOVE = '<?php echo (L("ALREADY_REMOVE")); ?>';var SEARCH_LOADING = '<?php echo (L("SEARCH_LOADING")); ?>';var CLICK_EDIT_CONTENT = '<?php echo (L("CLICK_EDIT_CONTENT")); ?>';
//-->
</script>
</head>

<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>
                            <div class="btn btn-success">
                              <a href="<?php echo U('Adminer/add');?>" style="color:white;"><span class="bold">新增</span></a>
                            </div>

                            </h5>
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
                        <!-- addData_attribute:<?php echo (L("ADD")); ?>:id, -->
                        <table class="table">
                          <tread>
                            <tr width="100%">
                              <th width="20%">编号</th>
                              <th width="25%">管理员</th>
                              <th width="25%">是否启用</th>
                              <th width="20%">操作</th>
                            </tr>
                          </tread>
                          <tbody>
                            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php if ($vo[status]==1){echo '启用';} if ($vo[status]==0) {echo '禁用';} ?></td>
                                <!-- <td><?php if($vo[status] == 1): ?>启用<else condition="$vo[status] eq 0" />禁用<?php endif; ?> </td> -->
                                <!-- 用[] -->
                                <td>
                                    <a href="<?php echo U('Adminer/edit',array('id'=>$vo[id]));?>">编辑</a>&nbsp;&nbsp;
                                    <a href="<?php echo U('Adminer/delete',array('id'=>$vo[id]));?>">删除</a>
                                </td>
                              </tr><?php endforeach; endif; ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	<div class="pager"><?php echo ($page); ?></div>
</div>
</html>