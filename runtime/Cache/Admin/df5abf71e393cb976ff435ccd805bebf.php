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

<form class="J_ajaxForms" name="form" id="form" action="<?php echo U('Adminer/add');?>" method="POST">
	<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><a href="<?php echo U('Adminer/index');?>">返回列表</a></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content  form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control requireinput" value="">
                            </div>
                        </div>
                    <div class="hr-line-dashed"></div>
											<div class="form-group">
													<label class="col-sm-2 control-label">密码</label>
													<div class="col-sm-10">
															<input type="password" name="pwd" class="form-control requireinput" value="">
													</div>
											</div>
										<div class="hr-line-dashed"></div>
											<div class="form-group">
													<label class="col-sm-2 control-label">确认密码</label>
													<div class="col-sm-10">
															<input type="password" name="confirm_pwd" class="form-control requireinput" value="">
													</div>
											</div>
										<div class="hr-line-dashed"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">是否启用</label>
                                <div class="col-sm-10">
																  <input type="radio" name="status" value="1">启用&nbsp;&nbsp;
																	<input type="radio" name="status" value="0">不启用
                                </div>
                            </div>
                    <div class="hr-line-dashed"></div>
                	    <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="submit" class="btn btn-w-m btn-success" " />
                                <input type="reset" class="btn btn-w-m btn-default" " />
                                <!-- <button class="btn btn-white" type="reset">取消</button> -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</form>
</html>