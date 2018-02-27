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
var URL = '/hlweb/index.php/Admin/Goods';var PUBLIC = '/hlweb/Public';var ROOT_PATH = '/hlweb';var APP = '/hlweb/index.php'+'/'+'<?php echo ($group_name); ?>';var STATIC = '__TMPL__Static';
var CURR_MODULE = '<?php echo ($module_name); ?>';var CURR_ACTION = '<?php echo ($action_name); ?>';var CURR_GROUP = '<?php echo ($group_name); ?>';
//定义JS中使用的语言变量
var CONFIRM_DELETE = '<?php echo (L("CONFIRM_DELETE")); ?>';var AJAX_LOADING = '<?php echo (L("AJAX_LOADING")); ?>';var AJAX_ERROR = '<?php echo (L("AJAX_ERROR")); ?>';var ALREADY_REMOVE = '<?php echo (L("ALREADY_REMOVE")); ?>';var SEARCH_LOADING = '<?php echo (L("SEARCH_LOADING")); ?>';var CLICK_EDIT_CONTENT = '<?php echo (L("CLICK_EDIT_CONTENT")); ?>';
//-->
</script>
</head>

<link rel="stylesheet" href="/hlweb/Public/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/hlweb/Public/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/hlweb/Public/kindeditor/lang/zh_CN.js"></script>
<!-- <script charset="utf-8" src="/hlweb/Public/kindeditor/jquery-1.9.1.min.js"></script> -->
<form class="J_ajaxForms" name="form" id="form" action="<?php echo U('Goods/add');?>" method="POST" enctype="multipart/form-data">
	<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><a href="<?php echo U('Goods/index');?>">返回列表</a></h5>
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
                            <label class="col-sm-2 control-label">商品名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control requireinput" value="">
                            </div>
                        </div>
									 <div class="hr-line-dashed"></div>
												<div class="form-group">
																<label class="col-sm-2 control-label">商品分类</label>
																<div class="col-sm-10">
																		<select name="cid" id="cateid"  class="form-control">
																			<!-- 在select中添加multiple="multiple"属性，name改为数组name[],可以实现多选。 -->
																						<option value="0">==请选择==</option>
																					<?php if(is_array($cates_list)): foreach($cates_list as $key=>$cl): ?><option value="<?php echo ($cl["id"]); ?>" ><?php echo ($cl["name"]); ?></option><?php endforeach; endif; ?>
																		</select>
																</div>
														</div>
                    <div class="hr-line-dashed"></div>
										<div class="form-group">
														<label class="col-sm-2 control-label">所属城市(没有不选)</label>
														<div class="col-sm-10">
																<select name="city_id" id="city_id"  class="form-control">
																	<!-- 在select中添加multiple="multiple"属性，name改为数组name[],可以实现多选。 -->
																				<option value="0">==请选择==</option>
																			<?php if(is_array($city_list)): foreach($city_list as $key=>$city): ?><option value="<?php echo ($city["id"]); ?>" ><?php echo ($city["city_name"]); ?></option><?php endforeach; endif; ?>
																</select>
														</div>
												</div>
								<div class="hr-line-dashed"></div>
										<div class="form-group">
												<label class="col-sm-2 control-label">售卖价格</label>
												<div class="col-sm-10">
														<input type="text" name="price" class="form-control requireinput" value="">
												</div>
										</div>
							 		<div class="hr-line-dashed"></div>
											<div class="form-group">
													<label class="col-sm-2 control-label">市场价格</label>
													<div class="col-sm-10">
															<input type="text" name="market_price" class="form-control requireinput" value="">
													</div>
											</div>
										<div class="hr-line-dashed"></div>
										<div class="form-group">
												<label class="col-sm-2 control-label">售卖规格(件，个，箱)</label>
												<div class="col-sm-10">
														<input type="text" name="sale_way_name" class="form-control requireinput" value="">
												</div>
										</div>
									<div class="hr-line-dashed"></div>
											<div class="form-group">
															<label class="col-sm-2 control-label">上传图片(头图)</label>
																<div class="col-sm-10">
																		<input type="file" name="img" value="">
																</div>
											</div>
											<div class="hr-line-dashed"></div>
													<div class="form-group">
																	<label class="col-sm-2 control-label">详情</label>
																		<div class="col-sm-10">
																				<textarea name="content" style="width:800px;height:400px;"></textarea>
																				<select type="mutiple" name="firstimage" id="firstimage">
																		        <option value="">请选择</option>
																		    </select>
																		    <br />
																		    <label for="images" style="display:none">
																			     <select name="images[]" multiple="multiple" id="images">
																			    </select>
																				</label>
																		</div>
													</div>
										<div class="hr-line-dashed"></div>
												<div class="form-group">
														<label class="col-sm-2 control-label">人气（浏览量）</label>
														<div class="col-sm-10">
																<input type="text" name="view_num" class="form-control requireinput" value="0">
														</div>
												</div>
											<div class="hr-line-dashed"></div>
												<div class="form-group">
														<label class="col-sm-2 control-label">销售量</label>
														<div class="col-sm-10">
																<input type="text" name="sale_num" class="form-control requireinput" value="0">
														</div>
												</div>
											<div class="hr-line-dashed"></div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">是否上架</label>

                                <div class="col-sm-10">
                                    <input type="radio" name="status" value="1" checked="checked">上架&nbsp;&nbsp;
																		<input type="radio" name="status" value="0">下架
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
<script type="text/javascript">
$(function(){
	var editor;
	KindEditor.ready(function(K) {
			editor = K.create('textarea[name="content"]', {
					allowFileManager : true,
					autoHeightMode : true,
					afterCreate : function() {
							this.loadPlugin('autoheight');
					},
					afterUpload : function(url) {
							var firstimageoption = '<option value="' + url + '">' + url + '</option>';
							var selectoption = '<option value="' + url + '" selected="selected">' + url + '</option>';
							$("#firstimage").append(firstimageoption);
							$("#images").append(selectoption);
					}
			});
});
});

</script>
</html>