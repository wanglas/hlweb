$(function() {
    // 返回顶部
    function gotoTop(min_height) {
        // 预定义返回顶部的html代码，它的css样式默认为不显示
        var gotoTop_html = '<div id="gotoTop">返回顶部</div>';
        // 将返回顶部的html代码插入页面上id为page的元素的末尾
        $("body").append(gotoTop_html);
        $("#gotoTop").click(// 定义返回顶部点击向上滚动的动画
                function() {
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                }).hover(// 为返回顶部增加鼠标进入的反馈效果，用添加删除css类实现
                function() {
                    $(this).addClass("hover");
                }, function() {
            $(this).removeClass("hover");
        });
        // 获取页面的最小高度，无传入值则默认为600像素
        min_height ? min_height = min_height : min_height = 600;
        // 为窗口的scroll事件绑定处理函数
        $(window).scroll(function() {
            // 获取窗口的滚动条的垂直位置
            var s = $(window).scrollTop();
            // 当窗口的滚动条的垂直位置大于页面的最小高度时，让返回顶部元素渐现，否则渐隐
            if (s > min_height) {
                $("#gotoTop").fadeIn(100);
            } else {
                $("#gotoTop").fadeOut(200);
            }
            ;
        });
    }
    ;
    //不支持placeholder浏览器下对placeholder进行处理
    if (document.createElement('input').placeholder !== '') {
        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur().parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });
        });
    }
    gotoTop();
});
/**
 * 
 * @param {type} name 名称
 * @param {type} value 变量
 * @param {type} options  options = '{expires:1,b:2}'; options = eval('(' + options + ')');
 * @returns {unresolved}
 */
jQuery.cookie = function(name, value, options) {
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
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
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
function AddFavorite(sURL, sTitle) {
    try {
        window.external.addFavorite(sURL, sTitle);
    } catch (e) {
        try {
            window.sidebar.addPanel(sTitle, sURL, "");
        } catch (e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}
function SetHome(obj, vrl) {
    try {
        obj.style.behavior = 'url(#default#homepage)';
        obj.setHomePage(vrl);
    } catch (e) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager
                        .enablePrivilege("UniversalXPConnect");
            } catch (e) {
                alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
            }
            var prefs = Components.classes['@mozilla.org/preferences-service;1']
                    .getService(Components.interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage', vrl);
        } else {
            alert('抱歉，您的浏览器不支持自动设置首页, 请使用浏览器菜单手动设置!');
        }
    }
}