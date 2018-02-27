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
var URL = '/hlweb/index.php/Admin/OrderGoods';var PUBLIC = '/hlweb/Public';var ROOT_PATH = '/hlweb';var APP = '/hlweb/index.php'+'/'+'<?php echo ($group_name); ?>';var STATIC = '__TMPL__Static';
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
                        <h5>搜索	</h5>
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
                     <!-- 搜索 -->
                        <form action="<?php echo U('OrderGoods/index');?>" role="form" class="form-inline" method="post">
                            <div class="form-group">
                            <label for="exampleInputEmail2" class="sr-only">名称</label>
                            <input type="text" placeholder="订单编号"  name="sn" value="" class="form-control">
                            </div>
                            <input class="btn btn-w-m btn-success" type="submit" value="搜索" />
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>
                            <!-- <div class="btn btn-success">
                              <a href="<?php echo U('OrderGoods/add');?>" style="color:white;"><span class="bold">新增</span></a>
                            </div> -->
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
                              <th >编号</th>
                              <th >订单编号</th>
                              <th >商品名称</th>
                              <th >数量</th>
                              <th >单价</th>
                              <th >总价</th>
                              <th >下单人姓名</th>
                              <th >下单人电话</th>
                              <th >收货区域</th>
                              <th >详细地址</th>
                              <th >下单时间</th>
                              <th >是否付款</th>
                              <th >订单状态</th>
                              <th >操作</th>
                            </tr>
                          </tread>
                          <tbody>
                            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["order_sn"]); ?></td>
                                <td><?php echo ($vo["goods_name"]); ?></td>
                                <td><?php echo ($vo["goods_number"]); echo ($vo["goods_sale_way_name"]); ?></td>
                                <td><?php echo ($vo["goods_price"]); ?></td>
                                <td><?php echo ($vo["order_money"]); ?></td>
                                <td><?php echo ($vo["realname"]); ?></td>
                                <td><?php echo ($vo["tel"]); ?></td>
                                <td><?php echo ($vo["address"]); ?></td>
                                <td><?php echo ($vo["address_detail"]); ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$vo[create_time]);?></td>
                                <td>
                                  <?php if($vo['pay_status'] == 0): ?><span style="color:red;font-weight:bold;">未付款</span><?php endif; ?>
                                  <?php if($vo['pay_status'] == 2): ?><span style="color:green;font-weight:bold;">已付款</span><?php endif; ?>
                                </td>
                                <td>
                                  <?php if($vo['shipping_status'] == 0): ?>未发货订单<?php endif; ?>
                                  <?php if($vo['shipping_status'] == 1): ?><span style="color:green;font-weight:bold;">已发货订单<span><?php endif; ?>
                                  <?php if($vo['shipping_status'] == 2): ?>已收货订单<?php endif; ?>
                                  <?php if($vo['shipping_status'] == 4): ?>退货订单<?php endif; ?>
                                </td>
                                <!-- <td><?php if($vo[rstatus] == 1): ?>启用<else condition="$vo[rstatus] eq 0" />禁用<?php endif; ?> </td> -->
                                <!-- 用[] -->
                                <td>
                                    <a href="<?php echo U('OrderGoods/edit',array('id'=>$vo['id']));?>">编辑</a>&nbsp;&nbsp;
                                    <a href="<?php echo U('OrderGoods/delete',array('id'=>$vo['id']));?>">删除</a>
                                </td>
                              </tr><?php endforeach; endif; ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	<div class="page1"><?php echo ($page); ?></div>
</div>
</html>