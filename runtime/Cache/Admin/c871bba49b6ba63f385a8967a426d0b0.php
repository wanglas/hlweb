<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <?php $admin_title = $msgTitle; ?>
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


    <div class="middle-box text-center animated fadeInDown">
        <h2><?php echo ($msgTitle); ?></h2>
        <h3 class="font-bold"><?php echo ($message); ?></h3>
        <div class="error-desc">
            
                               您的操作已经完成...
            <?php if(!isset($closeWin)): ?><br/>系统将在 <strong style="color:blue;" class="wait-second"><?php echo ($waitSecond); ?></strong> 秒后自动返回
            <p><a href="<?php echo($jumpUrl); ?>" class="btn btn-primary m-t">返回</a></p><?php endif; ?>
        </div>
    </div>
<script type="text/javascript">
<?php if($jumpUrl != ''): ?>var timeout = 0;
var waitSecond = parseInt(<?php echo ($waitSecond); ?>);
var refreshFun = function(){
	timeout++;
	if(waitSecond <= timeout)
		location.href = "<?php echo ($jumpUrl); ?>";
	else
	{
		$('.wait-second').html(waitSecond - timeout);
		setTimeout(refreshFun,1000);
	}
};
setTimeout(refreshFun,1000);<?php endif; ?>
</script>
</html>