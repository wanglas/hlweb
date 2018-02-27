<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>注册用户</title>
            <meta name="description" content="响网shop.hsxaing.COM-专业的综合网上购物商城，为您提供愉悦的网上商城购物体验! ">
                <meta name="Keywords" content="网上购物,网上商城,手机,笔记本,电脑,MP3,CD,VCD,DV,相机,数码,配件,手表,存储卡,响网商城"></meta>
                <link type="text/css" rel="stylesheet" href="__PUBLIC__/shop/css/passport.base.css">
                    <link rel="stylesheet" type="text/css" href="__PUBLIC__/shop/css/regist2013.css" />
                    <link type="text/css" rel="stylesheet" href="__PUBLIC__/shop/css/regist.entry2013.css">
                        <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/form.css" />
                        <include file="Public:jsheader" />
                        <script src='__PUBLIC__/formValidator/formValidator-4.1.3.js'></script>
                        <script src='__PUBLIC__/formValidator/formValidatorRegex.js'></script>
                            <script type="text/javascript">
                function fleshVerify() {
                    var time = new Date().getTime();
                    $("#verifyImg").attr('src',
                            "{:U('/Admin/Index/verify?type=gif?rand=')}" + time);
                }
                //表单验证
                $(function() {
                    $('#loginname').focus();
                    if (top.location != self.location) {
                        top.location.href = self.location.href;
                        return;
                    }
                    $("#verifyImg").click(function() {
                        fleshVerify();
                    });
                    $(document).keypress(function(e) {
                        if (e.keyCode == 13) {
                            login()
                        }
                    });
                    
                    /*$.formValidator.initConfig({formID:"form1",theme:"ArrowSolidBox",submitOnce:true,
                		onError:function(msg,obj,errorlist){
                			$("#errorlist").empty();
                			$.map(errorlist,function(msg){
                				$("#errorlist").append("<li>" + msg + "</li>")
                			});
                			alert(msg);
                		},
                		ajaxPrompt : '有数据正在异步验证，请稍等...'
                	});*/
                    $.formValidator.initConfig({formID:"form1",theme:'ArrowSolidBox',mode:'AutoTip',onError:function(msg){alert(msg)},inIframe:true});
                   /* $("#loginname").formValidator({
                        onshow: "用户名需要在3-20字符之间！",
                        onfocus: "请输入用户名！",
                        oncorrect: "可以注册"
                    }).inputValidator({
                        min: 3,
                        max: 20,
                        onerror: "用户名需要在3-20字符之间！"
                    }).ajaxValidator({
                        type: "get",
                        url: "{:U('Member/ajaxUser')}",
                        datatype: "json",
                        success: function(data) {
                            if (data.status == 'success') {
                                return true;
                            } else {
                                this.onerror = data.info;
                                return false
                            }
                        },
                        error: function() {
                            alert("服务器没有返回数据，可能服务器忙，请重试");
                        },
                        onwait: "正在对用户名进行合法性校验，请稍候..."
                    });*/

                	$("#loginname").formValidator({onShow:"用户名需要在3-20字符之间！"
                    	,onFocus:"请输入用户名！"
                        ,onCorrect:"该用户名可以注册"}).inputValidator({min:3,max:20,onError:"用户名需要在3-20字符之间！"})
            	    .ajaxValidator({
                		dataType : "json",
                		async : true,
                		url : "{:U('Member/ajaxUser')}",
                		success : function(data){
                			if (data.status == 'success') {
                                return true;
                            } else {
                                this.onerror = data.info;
                                return false
                            }
                		},
                		buttons: $("#button"),
                		error: function(jqXHR, textStatus, errorThrown){alert("服务器没有返回数据，可能服务器忙，请重试"+errorThrown);},
                		onError : "该用户名不可用，请更换用户名",
                		onWait : "正在对用户名进行合法性校验，请稍候..."
            	    }).defaultPassed();
                    //$("#password").formValidator({onShow:"请输入密码",onFocus:"至少1个长度",onCorrect:"密码合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"},onError:"密码不能为空,请确认"});
                	//$("#password1").formValidator({onShow:"输再次输入密码",onFocus:"至少1个长度",onCorrect:"密码一致"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"重复密码两边不能有空符号"},onError:"重复密码不能为空,请确认"}).compareValidator({desID:"password1",operateor:"=",onError:"2次密码不一致,请确认"});

                    $("#password").formValidator({
                        onShow: "密码需要在6-20字符之间！ ",
                        onFocus: "请输入密码！ ",
                        onempty: "请输入密码！ ",
                        onCorrect: "输入正确"
                    }).inputValidator({
                        min: 6,
                        max: 20,
                        onerror: "密码需要在6-20字符之间！ "
                    });
                    $("#password1").formValidator({
                        onShow: "请再次输入密码！",
                        onFocus: "请再次输入密码！",
                        onCorrect: "输入正确"
                    }).compareValidator({
                    	desID: "password",
                        operateor: "=",
                        onError: "两次输入的密码不一样！"
                    });
                    $("#email").formValidator({
                        onShow: "请输入邮箱！",
                        onFocus: "请输入邮箱！",
                        onCorrect: "OK"
                    }).inputValidator({
                        min: 5,
                        max: 100,
                        onError: "邮箱需要在5-100字符之间！"
                    }).regexValidator({
                        regexp: "^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$",
                        datatype: "email",
                        onError: "邮箱格式不正确！"
                    });
                    $("#verify").formValidator({
                        onShow: "请输入验证码！",
                        onFocus: "请输入验证码！"

                    }).inputValidator({
                        min: 4,
                        max: 4,
                        onError: "请输入验证码！"
                    });
                	$.formValidator.reloadAutoTip();
                });
                            </script>
      </head>
                        <body>
                            <div class="w">
                                <div id="logo"><a href="__ROOT__"><img src="__PUBLIC__/shop/images/logo-201306.png" alt="响网" width="144" height="56"></a><b></b></div>
                            </div>                            
                            <form id="login" method="post" action="{:U('Member/doRegister')}" name="form1" id="form1">
                                <div class=" w1" id="entry">
                                    <div class="mc " id="bgDiv" style='height:430px;'>
                                        <div id="entry-bg" style="width: 414px; height: 354px; background-image: url(__PUBLIC__/shop/images/rBEhVVHD-JgIAAAAAAC4yUMt3aAAAAaXwCHGmQAALjh056.jpg); background-position: 0px 0px; background-repeat: no-repeat no-repeat;"> 
                                        </div>
                                        <div class="form ">
                                            <div class="item fore1" style='margin-top:20px;'> <span>邮箱/用户名</span>
                                                <div class="item-ifo">
                                        <input type="text" id="loginname" name="username"  class="text" value="" style="width:260px" />

                                                </div>
                                            </div>
                                            <div class="item fore2" style='margin-top:20px;'> <span>密码</span>
                                                <div class="item-ifo">
                                            <input type="password" id="password" name="password" required="" placeholder="密码" class="text" style="width:100px" />
   
                                                </div>
                                            </div>
                                            <div class="item fore2" style='margin-top:20px;'> <span>重复密码</span>
                                                <div class="item-ifo">
                                            <input type="password" id="password1" name="password1" required="" placeholder="重复密码" class="text" style="width:260px" />

                                                </div>
                                            </div>
                                            <div class="item fore2" style='margin-top:20px;'> <span>验证码</span>
                                                <div class="item-ifo">
                                                    <input type="text" id="verify" class="text text-1" name='verify' required="" placeholder="验证码"  style="width:150px">
                                                        <label class="img"> 
                                                            <img style="cursor:pointer;width:100px;height:33px;display:block;" src="{:U('Member/verify')}"  id="verifyImg"> </label>
                                                        <label class="ftx23 hline">看不清？<br>
                                                                <a href="javascript:void(0)" class="flk13" onClick='fleshVerify()'>换一张</a></label>
                                                        <label id="authcode_succeed" class="blank invisible"></label>
                                                        <label id="authcode_error" class="hide"></label>
                                                </div>
                                            </div>
                                            <br></br>
                                            <div class="item login-btn2013">
                                                <input type="submit"  value="注册" tabindex="8" id="button">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="free-regist" style='width: 200px;'> 
                                        <span style='width: 200px;'><a href="{:U('Member/login')}">已有帐号？现在登录</a></span>
                                    </div>
                                </div>
                            </form>
                            <div class="w1">
                                <div class="mb"><img height="59" src="__PUBLIC__/shop/images/bm-bg.jpg"></div>
                            </div>
                            <div class="w">
                                <div id="footer-2013">
                                    <div class="links"> <a href="/aboutus/more.html" target="blank">网站介绍</a>　<a href="/aboutus/more2.html" target="blank">关于我们</a>　<a class="v3home" onClick="SetHome(this, window.location)" href="javascript:void(0);">设为首页</a>　<a class="v3home" href="javascript:void(0);" onClick="AddFavorite(window.location, document.title)">加入收藏</a> </div>
                                    <div class="copyright">©2012-2013　华商晨报版权所有　页面设计：响网设计团队　网站后台：响网技术团队　辽ICP备12007681号-1　电话：024-96128<br>
                                    </div>
                                </div>
                            </div>
                        </body>
                        </html>