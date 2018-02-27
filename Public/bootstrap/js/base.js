//自定义js
//公共配置
$(document).ready(function () {

    // MetsiMenu
    $('#side-menu').metisMenu();

    // 打开右侧边栏
    $('.right-sidebar-toggle').click(function () {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    // 右侧边栏使用slimscroll
    $('.sidebar-container').slimScroll({
        height: '100%',
        railOpacity: 0.4,
        wheelStep: 10
    });

    // 打开聊天窗口
    $('.open-small-chat').click(function () {
        $(this).children().toggleClass('fa-comments').toggleClass('fa-remove');
        $('.small-chat-box').toggleClass('active');
    });

    // 聊天窗口使用slimscroll
    $('.small-chat-box .content').slimScroll({
        height: '234px',
        railOpacity: 0.4
    });

    // Small todo handler
    $('.check-link').click(function () {
        var button = $(this).find('i');
        var label = $(this).next('span');
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        label.toggleClass('todo-completed');
        return false;
    });

    //固定菜单栏
    $(function () {
        $('.sidebar-collapse').slimScroll({
            height: '100%',
            railOpacity: 0.9,
            alwaysVisible: false
        });
    });


    // 菜单切换
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });


    // 侧边栏高度
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");
    }
    fix_height();

    $(window).bind("load resize click scroll", function () {
        if (!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    //侧边栏滚动
    $(window).scroll(function () {
        if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav')) {
            $('#right-sidebar').addClass('sidebar-top');
        } else {
            $('#right-sidebar').removeClass('sidebar-top');
        }
    });

    $('.full-height-scroll').slimScroll({
        height: '100%'
    });

    $(document).on('click','#side-menu>li', function () {
        if ($('body').hasClass('mini-navbar')) {
            NavToggle();
        }
    });
    
    $('#side-menu>li li a').click(function () {
        if ($(window).width() < 769) {
            NavToggle();
        }
    });

    $('.nav-close').click(NavToggle);

    //ios浏览器兼容性处理
    if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
        $('#content-main').css('overflow-y', 'auto');
    }
    
    $(".collapse-link").click(function() {
		var o = $(this).closest("div.ibox"),
			e = $(this).find("i"),
			i = o.find("div.ibox-content");
		i.slideToggle(200), e.toggleClass("fa-chevron-up").toggleClass("fa-chevron-down"), o.toggleClass("").toggleClass("border-bottom"), setTimeout(function() {
			o.resize(), o.find("[id^=map-]").resize()
		}, 50)
	});
    $(".close-link").click(function() {
		var o = $(this).closest("div.ibox");
		o.remove()
	});

});

$(window).bind("load resize", function () {
    if ($(this).width() < 769) {
        $('body').addClass('mini-navbar');
        $('.navbar-static-side').fadeIn();
    }
});

function NavToggle() {
    $('.navbar-minimalize').trigger('click');
}

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        $('#side-menu').removeAttr('style');
    }
}


//主题设置
$(function () {

    // 顶部菜单固定
    $('#fixednavbar').click(function () {
        if ($('#fixednavbar').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'on');
            }
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'off');
            }
        }
    });


    // 收起左侧菜单
    $('#collapsemenu').click(function () {
        if ($('#collapsemenu').is(':checked')) {
            $("body").addClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport) {
                localStorage.setItem("collapse_menu", 'on');
            }

        } else {
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport) {
                localStorage.setItem("collapse_menu", 'off');
            }
        }
    });

    // 固定宽度
    $('#boxedlayout').click(function () {
        if ($('#boxedlayout').is(':checked')) {
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'off');
            }


            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'on');
            }
        } else {
            $("body").removeClass('boxed-layout');

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'off');
            }
        }
    });

    // 默认主题
    $('.s-skin-0').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        return false;
    });

    // 蓝色主题
    $('.s-skin-1').click(function () {
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
        return false;
    });

    // 黄色主题
    $('.s-skin-3').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
        return false;
    });

    if (localStorageSupport) {
        var collapse = localStorage.getItem("collapse_menu");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");

        if (collapse == 'on') {
            $('#collapsemenu').prop('checked', 'checked')
        }
        if (fixednavbar == 'on') {
            $('#fixednavbar').prop('checked', 'checked')
        }
        if (boxedlayout == 'on') {
            $('#boxedlayout').prop('checked', 'checked')
        }
    }

    if (localStorageSupport) {

        var collapse = localStorage.getItem("collapse_menu");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");

        var body = $('body');

        if (collapse == 'on') {
            if (!body.hasClass('body-small')) {
                body.addClass('mini-navbar');
            }
        }

        if (fixednavbar == 'on') {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            body.addClass('fixed-nav');
        }

        if (boxedlayout == 'on') {
            body.addClass('boxed-layout');
        }
    }
});

//判断浏览器是否支持html5本地存储
function localStorageSupport() {
    return (('localStorage' in window) && window['localStorage'] !== null)
}

(function($) {
    $.ajaxError = function(msg) {
        ajaxError = true;
        if (!msg)
            msg = AJAX_ERROR;
        layer.msg(msg, {
        	  offset: 'rt',
        	  anim:2
        	});
    };
    $.getStringLength = function(str) {
        str = $.trim(str);
        if (str == "")
            return 0;
        var length = 0;
        for (var i = 0; i < str.length; i++) {
            if (str.charCodeAt(i) > 255)
                length += 2;
            else
                length++;
        }
        return length;
    }
    $.getLengthString = function(str, length, isSpace) {
        if (arguments.length < 3)
            var isSpace = true;
        if ($.trim(str) == "")
            return "";
        var tempStr = "";
        var strLength = 0;
        for (var i = 0; i < str.length; i++) {
            if (str.charCodeAt(i) > 255)
                strLength += 2;
            else {
                if (str.charAt(i) == " ") {
                    if (isSpace)
                        strLength++;
                } else
                    strLength++;
            }
            if (length >= strLength)
                tempStr += str.charAt(i);
        }
        return tempStr;
    }
    $.windowCenter = function(obj) {
        var windowWH = $.getWindowWH();
        var windowWidth = windowWH[0];
        var windowHeight = windowWH[1];
        var objWidth = obj.width();
        var objHeight = obj.height();
        var objTop = tooltipTop + $.getBodyScrollTop();
        var objLeft = (windowWidth - objWidth) / 2;
        obj.css({
            position: "absolute",
            display: "block",
            "z-index": 1000,
            top: objTop,
            left: objLeft
        });
    }
    $.getBodyScrollTop = function() {
        var scrollPos;
        if (typeof window.pageYOffset != 'undefined') {
            scrollPos = window.pageYOffset;
        } else if (typeof document.compatMode != 'undefined'
                && document.compatMode != 'BackCompat') {
            scrollPos = document.documentElement.scrollTop;
        } else if (typeof document.body != 'undefined') {
            scrollPos = document.body.scrollTop;
        }
        return scrollPos;
    }
    $.getWindowWH = function() {
        var width = $.support.cssFloat ? $(document.documentElement).width()
                : $(window).width();
        var height = $.support.cssFloat ? $(document.documentElement).height()
                : $(document).height();
        return [width, height];
    }
    $.checkRequire = function(value) {
        var reg = /.+/;
        return reg.test($.trim(value));
    }
    $.minLength = function(value, length, isByte) {
        var strLength = $.trim(value).length;
        if (isByte)
            strLength = $.getStringLength(value);
        return strLength >= length;
    };
    $.maxLength = function(value, length, isByte) {
        var strLength = $.trim(value).length;
        if (isByte)
            strLength = $.getStringLength(value);
        return strLength <= length;
    };
    $.rangeLength = function(value, minLength, maxLength, isByte) {
        var strLength = $.trim(value).length;
        if (isByte)
            strLength = $.getStringLength(value);
        return strLength >= minLength && strLength <= maxLength;
    }
    $.checkMobilePhone = function(value) {
        return /^(13\d{9}|18\d{9}|15\d{9})$/i.test($.trim(value));
    }
    $.checkPhone = function(val) {
        var flag = 0;
        val = $.trim(val);
        var num = ".0123456789/-()";
        for (var i = 0; i < (val.length); i++) {
            tmp = val.substring(i, i + 1);
            if (num.indexOf(tmp) < 0)
                flag++;
        }
        if (flag > 0)
            return true;
        else
            return false;
    }
    $.checkEmail = function(val) {
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        return reg.test(val);
    };
    $.checkUrl = function(val) {
        var reg = /^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
        return reg.test(val);
    };
    $.checkCurrency = function(val) {
        var reg = /^\d+(\.\d+)?$/;
        return reg.test(val);
    };
    $.checkNumber = function(val) {
        var reg = /^\d+$/;
        return reg.test(val);
    };
    $.checkInteger = function(val) {
        var reg = /^[-\+]?\d+$/;
        return reg.test(val);
    };
    $.checkDouble = function(val) {
        var reg = /^[-\+]?\d+(\.\d+)?$/;
        return reg.test(val);
    };
    $.checkEnglish = function(val) {
        var reg = /^[A-Za-z]+$/;
        return reg.test(val);
    };
    $.checkQQMsn = function(val) {
        var reg = /^[1-9]*[1-9][0-9]*$|^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        return reg.test(val);
    };
    
    $.cookie = function(name,value,options) {
    	if (typeof value != 'undefined') { // name and value given, set cookie
    		options = options || {};
    		if (value === null) {
    			value = '';
    			options.expires = -1;
    		}
    		var expires = '';
    		if (options.expires
    				&& (typeof options.expires == 'number' || options.expires.toUTCString)) {
    			var date;
    			if (typeof options.expires == 'number') {
    				date = new Date();
    				date.setTime(date.getTime()
    						+ (options.expires * 24 * 60 * 60 * 1000));
    			} else {
    				date = options.expires;
    			}
    			expires = '; expires=' + date.toUTCString(); // use expires
    															// attribute,
    															// max-age is not
    															// supported by IE
    		}
    		var path = options.path ? '; path=' + options.path : '';
    		var domain = options.domain ? '; domain=' + options.domain : '';
    		var secure = options.secure ? '; secure' : '';
    		document.cookie = [ name, '=', encodeURIComponent(value), expires,
    				path, domain, secure ].join('');
    	} else { // only name given, get cookie
    		var cookieValue = null;
    		if (document.cookie && document.cookie != '') {
    			var cookies = document.cookie.split(';');
    			for ( var i = 0; i < cookies.length; i++) {
    				var cookie = jQuery.trim(cookies[i]);
    				// Does this cookie string begin with the name we want?
    				if (cookie.substring(0, name.length + 1) == (name + '=')) {
    					cookieValue = decodeURIComponent(cookie
    							.substring(name.length + 1));
    					break;
    				}
    			}
    		}
    		return cookieValue;
    	}
    };
    
})(jQuery);

function checkAll(id) {
    $("#" + id + " tbody tr:not([disabled]) input[name='key']").each(
            function() {
                if (this.checked)
                    this.checked = false;
                else
                    this.checked = true;
            });
}
function addData(obj) {
	if (obj == null){
		obj = '';
	}
    var fun = function() {
        location.href = APP + '/' + CURR_MODULE + '/add/obj/'+obj;
    };
    setTimeout(fun, 1);
}

function addSubData(obj, id, pk) {
	if (obj == null){
		obj = '';
	}
    var fun = function() {
        location.href = APP + '/' + CURR_MODULE + '/add/pid/' + id + '/obj/'+obj;
    };
    setTimeout(fun, 1);
}
function editData(obj, id, pk,action) {
	if (obj == null){
		obj = '';
	}
	if(action=='' || action == undefined || action == null){
		action = 'edit';
	}
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    location.href = APP + '/' + CURR_MODULE + '/'+action+'/' + pk + '/' + id + '/obj/'+obj;
}

function editSubData(obj, id, pk) {
	if (obj == null){
		obj = '';
	}
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    var fun = function() {
        var pid = $("#pid").val();
        location.href = APP + '/' + CURR_MODULE + '/editsub/pid/'+ pid + '/' + pk + '/' + id+ '/obj/'+obj;
    };
    setTimeout(fun, 1);
}
function returnList(url) {
    var fun = function() {
        var pid = $("#pid").val();
        location.href = url + '/id/' + pid;
    };
    setTimeout(fun, 1);
}
function deleteData(obj, id, pk) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    location.href = APP + '/' + CURR_MODULE + '/delete/' + pk + '/' + id;
}

/**
 * 调用数据。内部调用
 * @param {type} obj
 * @param {type} id
 * @returns {undefined}
 */
function internalCall(obj, id) {
    prompt('请复制(CTRL+C)以下内容并添加到模板中', '{:block(' + id + ')}');
}

//添加block_item 数据
function addItem(obj, id) {
    var fun = function() {
        location.href = APP + '/' + CURR_MODULE + '/itemdata/' + 'id' + '/' + id;
    };
    setTimeout(fun, 1);
}

function dataDel(obj, id, pk) {
    var ids = new Array();
    if (isNaN(id)) {
        $("#" + id + " input:checked[name='key']").each(function() {
            ids.push(this.value);
        });
    } else {
        ids.push(id);
        var parent = $(obj).parent().parent();
        id = parent.parent().parent().attr('id');
    }
    ids = ids.join(',');
    if (ids == '')
        return false;
    if (!window.confirm(CONFIRM_DELETE))
        return false;
    var query = new Object();
    query.id = ids;
    $.ajax({
        url: APP + '/' + CURR_MODULE + '/deletedata',
        type: "POST",
        cache: false,
        data: query,
        dataType: "json",
        success: function(result) {
            if (result.isErr == 0) {
                $("#" + id + " tbody tr input[name='key']")
                        .each(
                        function() {
                            if ((',' + ids + ',').indexOf(','
                                    + this.value + ',') != -1) {
                                parent = $(this).parent()
                                        .parent();
                                this.checked = false;
                                $('td span,td a', parent)
                                        .each(
                                        function() {
                                            if (typeof (this.onclick) == 'function'
                                                    && this.onclick
                                                    .toString() != '') {
                                                if (this.onclick
                                                        .toString()
                                                        .indexOf(
                                                        'toggleStatus') != -1) {
                                                    var img = $(
                                                            'img',
                                                            this)
                                                            .get(
                                                            0);
                                                    img.src = img.src
                                                            .replace(
                                                            'status',
                                                            'disabled');
                                                }
                                                this.onclick = '';
                                            }
                                        });
                                parent.attr({
                                    "disabled": true,
                                    "title": ALREADY_REMOVE
                                });
                                $("td", parent).attr({
                                    "disabled": true
                                }).addClass('disabled');
                                $("td *", parent).attr({
                                    "disabled": true
                                }).addClass('disabled');
                            }
                            if ($("#"
                                    + id
                                    + " tbody tr:not([disabled])").length == 0)
                                location.reload(true);
                        });
            } else
                $.ajaxError(result.content);
        }
    });
}

function dataEdit(obj, id, pk) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    // var fun = function(){
    location.href = APP + '/' + CURR_MODULE + '/dataedit/' + pk + '/' + id;
    // };
    // setTimeout(fun,1);
}

function sendData(obj, id, pk) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    var vipid = $('#vipid').val();
    location.href = APP + '/' + CURR_MODULE + '/send/' + pk + '/' + id
            + '/vipid/' + vipid;
}



function dealData(obj, id, pk) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    // var fun = function(){
    location.href = APP + '/' + CURR_MODULE + '/deal/' + pk + '/' + id;
    // };
    // setTimeout(fun,1);
}
function viewData(obj, id, pk, page) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    location.href = APP + '/' + CURR_MODULE + '/view/' + pk + '/' + id;
}
function downloadData(obj, id, pk, page) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    location.href = APP + '/' + CURR_MODULE + '/download/' + pk + '/' + id;
}
function resultData(obj, id, pk, page) {
    if (isNaN(id))
        id = $("#" + id + " input:checked[name='key']").eq(0).val();
    if (!id)
        return false;
    if (pk == null)
        pk = 'id';
    location.href = APP + '/' + CURR_MODULE + '/result/' + pk + '/' + id;
}
function removeImg(obj, id, field, relMod) {
    var query = new Object();
    query.id = id;
    query.field = field;
    query.rel_mod = relMod;
    $.ajax({
        url: APP + '/' + CURR_MODULE + '/deleteImg',
        type: "POST",
        cache: false,
        data: query,
        dataType: "json",
        success: function(result) {
            if (result.isErr == 0)
                $(obj).parent().remove();
            else
                $.ajaxError(result.content);
        }
    });
}


function removeData(obj, id, pk) {
    var ids = new Array();
    if (isNaN(id)) {
        $("#" + id + " input:checked[name='key']").each(function() {
            ids.push(this.value);
        });
    } else {
        ids.push(id);
        var parent = $(obj).parent().parent();
        id = parent.parent().parent().attr('id');
    }
    ids = ids.join(',');
    if (ids == '')
        return false;
    if (!window.confirm(CONFIRM_DELETE))
        return false;
    var query = new Object();
    query.id = ids;
    $
            .ajax({
        url: APP + '/' + CURR_MODULE + '/delete',
        type: "POST",
        cache: false,
        data: query,
        dataType: "json",
        success: function(result) {
            if (result.isErr == 0) {
                $("#" + id + " tbody tr input[name='key']")
                        .each(
                        function() {
                            if ((',' + ids + ',').indexOf(','
                                    + this.value + ',') != -1) {
                                parent = $(this).parent()
                                        .parent();
                                this.checked = false;
                                $('td span,td a', parent)
                                        .each(
                                        function() {
                                            if (typeof (this.onclick) == 'function'
                                                    && this.onclick
                                                    .toString() != '') {
                                                if (this.onclick
                                                        .toString()
                                                        .indexOf(
                                                        'toggleStatus') != -1) {
                                                    var img = $(
                                                            'img',
                                                            this)
                                                            .get(
                                                            0);
                                                    img.src = img.src
                                                            .replace(
                                                            'status',
                                                            'disabled');
                                                }
                                                this.onclick = '';
                                            }
                                        });
                                parent.attr({
                                    "disabled": true,
                                    "title": ALREADY_REMOVE
                                });
                                $("td", parent).attr({
                                    "disabled": true
                                }).addClass('disabled');
                                $("td *", parent).attr({
                                    "disabled": true
                                }).addClass('disabled');
                            }
                            if ($("#"
                                    + id
                                    + " tbody tr:not([disabled])").length == 0)
                                location.reload(true);
                        });
            } else
                $.ajaxError(result.content);
        }
    });
}


/**
 * 删除collection_content表数据
 * @param {type} obj
 * @param {type} id
 * @param {type} pk
 * @returns {Boolean}
 */
function removeAcqui(obj, id, pk) {
    var ids = new Array();
    if (isNaN(id)) {
        $("#" + id + " input:checked[name='key']").each(function() {
            ids.push(this.value);
        });
    } else {
        ids.push(id);
        var parent = $(obj).parent().parent();
        id = parent.parent().parent().attr('id');
    }
    ids = ids.join(',');
    if (ids == '')
        return false;
    if (!window.confirm(CONFIRM_DELETE))
        return false;
    var query = new Object();
    query.id = ids;
    $
            .ajax({
        url: APP + '/' + CURR_MODULE + '/removeAcqui',
        type: "POST",
        cache: false,
        data: query,
        dataType: "json",
        success: function(result) {
            if (result.isErr == 0) {
                $("#" + id + " tbody tr input[name='key']")
                        .each(
                        function() {
                            if ((',' + ids + ',').indexOf(','
                                    + this.value + ',') != -1) {
                                parent = $(this).parent()
                                        .parent();
                                this.checked = false;
                                $('td span,td a', parent)
                                        .each(
                                        function() {
                                            if (typeof (this.onclick) == 'function'
                                                    && this.onclick
                                                    .toString() != '') {
                                                if (this.onclick
                                                        .toString()
                                                        .indexOf(
                                                        'toggleStatus') != -1) {
                                                    var img = $(
                                                            'img',
                                                            this)
                                                            .get(
                                                            0);
                                                    img.src = img.src
                                                            .replace(
                                                            'status',
                                                            'disabled');
                                                }
                                                this.onclick = '';
                                            }
                                        });
                                parent.attr({
                                    "disabled": true,
                                    "title": ALREADY_REMOVE
                                });
                                $("td", parent).attr({
                                    "disabled": true
                                }).addClass('disabled');
                                $("td *", parent).attr({
                                    "disabled": true
                                }).addClass('disabled');
                            }
                            if ($("#"
                                    + id
                                    + " tbody tr:not([disabled])").length == 0)
                                location.reload(true);
                        });
            } else
                $.ajaxError(result.content);
        }
    });
}

//弹出对话框
function dialog(id, linkurl, title, w, h, callback_fun,backinput) {
    if (!w)
        w = 700;
    if (!h)
        h = 500;
    //head.css('artDialog');
    head.load(PUBLIC+"/js/artDialog/artDialog.js", PUBLIC+"/js/artDialog/plugins/iframeTools.js", PUBLIC+"/js/artDialog/skins/aero.css", function() {
        art.dialog.open(linkurl, {
            id: id,
            title: title,
            width: w,
            height: h,
            lock: true,
            fixed: true,
            background: "#CCCCCC",
            opacity: 0,
            button: [{
                    name: title,
                    callback: function() {
                        var ifr = this.iframe.contentWindow;
                        callback_fun(ifr,backinput);
                    }
                }]
        });
    });

}
//yyyy-MM-dd HH:mm:ss
function change_picktime(date){
		if (date){
		WdatePicker({dateFmt:''+date+''});
		}else{
			WdatePicker();
		}
}	
function updateBodyDivHeight(){
	jQuery(".body-table-div").height(jQuery(".fanwe-body").height() );
	if(jQuery(".body-table-div").get(0)!=undefined){
		if(jQuery(".body-table-div").get(0).scrollHeight > jQuery(".body-table-div").height()){
			var width = jQuery(".body-table-div").width() - 16;
			jQuery(".body-table-div > *").each(function(){
				if(!$(this).hasClass('ajax-loading')&&!$(this).hasClass('no-width')){
					//如果是表格
					if($(this).hasClass('table-list')){
						//$(this).width(width - jQuery(".no-width").width() - 4)	
					} else {
						//$(this).width(width);
					}
				}
			});
		}
	}

}

jQuery(function($) {
    $(".ajax-loading").bind(
            'ajaxSend',
            function() {
                $(".ajax-loading").removeClass("ajax-error").html(AJAX_LOADING)
                        .stop(true).show();
                $(".ajax-loading").css({
                    "opacity": 1
                });
            });
    $(".ajax-loading").bind('ajaxError', function() {
        $.ajaxError();
    });
    $(".ajax-loading").bind('ajaxSuccess', function() {
        if (!ajaxError)
            $(".ajax-loading").hide();
        ajaxError = false;
    });
    $(".tabs-title .tt-item").click(
            function() {
                $(".tabs-title .tt-item").removeClass('active');
                $(this).addClass('active');
                $(".tabs-body .tabs-item").removeClass('tabs-active');
                $(
                        ".tabs-body .tabs-item[rel='"
                        + this.getAttribute('rel') + "']").addClass(
                        'tabs-active');
            });
    $(".table-form tr > th:first-child").addClass('first');
    $('a').focus(function() {
        this.blur();
    });
    $(".handle-btns .link-button").hover(function() {
        $(this).addClass("link-button-hover");
    }, function() {
        $(this).removeClass("link-button-hover");
    });
    $(".handle-btns .img-button").hover(function() {
        $(this).addClass("img-button-hover");
    }, function() {
        $(this).removeClass("img-button-hover");
    });
    $(".label_box input").on('change', $(".label_box input"), function() {
        if (this.checked)
            $(this).parent().addClass('active');
        else
            $(this).parent().removeClass('active');
    });
    
	updateBodyDivHeight();
	$(window).resize(function(){
		updateBodyDivHeight();
	});
});

jQuery(function($) {
	$(document)
			.mousemove(
					function(e) {
						var obj = e.target;
						if ($(obj).attr('tagName') == 'span'
								&& typeof (obj.onclick) == 'function'
								&& (obj.onclick.toString().indexOf('textEdit') != -1 || obj.onclick
										.toString().indexOf('numberEdit') != -1)) {
							obj.title = CLICK_EDIT_CONTENT;
							$(obj).addClass('select');
							$(obj).one('mouseout', function() {
								$(obj).removeClass('select');
							});
						}
					});
});
function createInputEdit(obj,id,name,type) {
	var module = obj.getAttribute('module');
	var val = $.trim($(obj).html());
	var input;
	if ($("#" + module + "_" + name + "_" + id).length == 0) {
		var txt = document.createElement("INPUT");
		txt.id = module + "_" + name + "_" + id;
		txt.className = 'textinput';
		$(obj).parent().append(txt);
		input = $(txt);
		input.keypress(function(e) {
			if (e.keyCode == 13) {
				this.blur();
				return false;
			}
			if (e.keyCode == 27) {
				$(obj).show();
				$(this).hide();
			}
		});
		input.blur(function() {
			if ($.trim(this.value).length > 0) {
				var err = false;
				var value = $.trim(this.value);
				val = $.trim($(obj).html());
				if (type == 'number') {
					val = parseFloat(val);
					value = parseFloat(value);
					if (isNaN(value))
						err = true;
				}
				if (val == value || err) {
					$(obj).show();
					$(this).hide();
					return false;
				}
				submitEdit(obj, module, id, value, name);
			} else {
				$(obj).show();
				$(this).hide();
			}
		});
	} else
		input = $("#" + module + "_" + name + "_" + id);
	input.val(val);
	var width = $(obj).width() + 12;
	if (width > $(obj).parent().width() - 12)
		width = $(obj).parent().width() - 12;
	input.show();
	input.width(width).focus();
	$(obj).hide();
}
function textEdit(obj,id,name) {
	createInputEdit(obj, id, name, 'text')
}
function numberEdit(obj,id,name) {
	createInputEdit(obj, id, name, 'number')
}
function submitEdit(obj,module,id,val,name) {
	var query = new Object();
	query.field = name;
	query.val = val;
	query.id = id;
	$.ajax({
		url : APP + '/' + module + '/editField',
		type : "POST",
		cache : false,
		data : query,
		dataType : "json",
		error : function() {
			$(obj).show();
			$("#" + module + "_" + name + "_" + id).hide();
		},
		success : function(result) {
			if (result.data == 0)
				$(obj).html(result.info);
			else
				$.ajaxError(result.info);
			$(obj).show();
			$("#" + module + "_" + name + "_" + id).hide();
		}
	});
}
function sortBy(field,sort,action,ext) {
	var url = location.href;
	url = url.replace(/(p=\d+?&)|(p=\d+?$)/g, '');
	var len = url.length;
	if (url.substr(len - 1) == '&') {
		url = url.substr(0, len - 1);
	}
	if (url.substr(len - 5) == '.html') {
		url = url.substr(0, len - 5);
	}
	if (url.search(/_order=.+?&/g) > -1) {
		url = url.replace(/_order=.+?&/g, '_order=' + field + '&');
	} else if (url.search(/_order=.+?$/g) > -1) {
		url = url.replace(/_order=.+?$/g, '_order=' + field);
	} else {
		url += '/_order/' + field;
	}
	if (url.search(/_sort=.+?&/g) > -1) {
		url = url.replace(/_sort=.+?&/g, '_sort=' + sort + '&');
	} else if (url.search(/_sort=.+?$/g) > -1) {
		url = url.replace(/_sort=.+?$/g, '_sort=' + sort);
	} else {
		url += '/_sort/' + sort;
	}
	var fun = function() {
		location.href = url;
	};
	setTimeout(fun, 1);
	// location.href =
	// APP+'?'+VAR_MODULE+'='+CURR_MODULE+'&'+VAR_ACTION+'='+action+'&_order='+field+'&_sort='+sort+
	// (ext ? '&'+ext : '' );
}

function toggleStatus(obj,id,name) {
	if ($('img', obj).length == 0)
		return false;
	var module = obj.getAttribute('module');
	// var module=CURR_MODULE;
	var query = new Object();
	query.field = name;
	query.val = $('img', obj).get(0).getAttribute('status');
	query.id = id;
	$.ajax({
		url : APP + '/' + module + '/toggleStatus',
		type : "POST",
		cache : false,
		data : query,
		dataType : "json",
		success : function(result) {
			if (result.isErr == 0) {
				var img = $('img', obj).get(0);
				var src = img.src.replace(query.val + '.gif', result.content
						+ '.gif');
				img.setAttribute('status', result.content);
				img.src = src;
			} else
				$.ajaxError();
		}
	});
}
