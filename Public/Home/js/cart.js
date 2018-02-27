$(document).ready(function() {
	$('#minus').on('click', function () {
        var v = $("#buy-num").val();
    	if (isNaN(v)) {
    		layer.msg('Please enter a valid number!', function(){});
    		$("#buy-num").focus();
    		return false;
    	}else{
    		if(parseInt(v)>1){
    			$("#buy-num").val(parseInt(v,10)-1);
    		}

    	}
    });
	$('#plus').on('click', function () {
        var v = $("#buy-num").val();
    	if (isNaN(v)) {
    		layer.msg('Please enter a valid number!', function(){});
    		$("#buy-num").focus();
    		return false;
    	}else{
			$("#buy-num").val(parseInt(v,10)+1);
    	}
    });

	$('#add_goods').on('click', function () {
		
        var goodid = $(this).attr('goodid');
        var num = 1;
            var doAddCart = "{:U('Cart/addCart')}";
            var urlCart = "{:U('Cart/index')}";
            if(goodid != undefined){
                $.post(doAddCart, {pid: goodid, num: num}, function(data) {
                    if (data.status == 1) {
                    	//layer.msg('Add success!');
                    	$("#simpleCart_quantity").html(data.data['total_rows']);
                        //ShowDiv('MyDiv','fade',data.data['total_rows'],data.data['total']);
                       //window.location.href = "{:U('Index/cart')}";
                    }
                    if (data.status == 2) {
                        window.location.href = urlCart;
                    }
                    if (data.status == 0) {
                    	layer.msg(data.info, function(){});
                    }
                }, 'json');
            }
    });
	 var doDelCart = $("#doDelCart").val();
    $('.del').click(function() {
        var sid = $(this).attr('sid');
        var pid = $(this).attr('pid');
    	layer.confirm('Confirmed to delete?', {
    		title: false,//不显示标题
    	    btn: ['OK','Cancel'], //按钮
    	    shade: false //不显示遮罩
    	}, function(index){
    		layer.close(index);
            $.post(doDelCart, {sid: sid, pid: pid}, function(data) {
                if (data.status == 1) {
                    window.location.href = window.location.href;
            		/*$('.rem_'+pid).fadeOut('slow', function(c){
            			$('.rem_'+pid).remove();
            		});*/
                }
            }, 'json')
    		}, function(){
    	});
    });

	$(".color-quality-left").each(function(){
		var i=$(this);
		var p=i.find("ul>li");
		p.click(function(){
			if(!!$(this).hasClass("selected")){
				$(this).removeClass("selected");
				i.removeAttr("data-attrval");
			}else{
				$(this).addClass("selected").siblings("li").removeClass("selected");
				i.attr("data-attrval",$(this).attr("data-aid"))
			}
			//getattrprice() //输出价格
		})
	});

	 $('#doCheckout').on('click', function(c){
			//$('#checkoutForm').submit();
	});


	$("#buy-num").blur(function() {
        var num = $("#buy-num").val();
        var pid = $("#choose_id").val();
        if (isNaN(num)) {
            alert("请重新选择购买的数量 !");
            $("#buy-num").val(1);
            return false;
        }
        if (num == '') {
            alert("请重新选择购买的数量 !");
            $("#buy-num").val(1);
            return false;
        }
        if (num == 0) {
            alert("请重新选择 !");
            $("#buy-num").val(1);
            return false;
        }
        $.post("{:U('Index/stock')}", {num: num, pid: pid}, function(data) {
            if (data.status == 0) {
                alert(data.info);
                $("#buy-num").val(1);
            }
        }, 'json')
    })

    $(".guanzu").click(function() {
        var pid = $("#choose_id").val();
        $.post("{:U('Index/ajaxFavorite')}", {pid: pid}, function(data) {
            if (data.status == 0) {
                alert(data.info);
                window.location.href = "{:U('Member/login')}";
            }
            if (data.status == 1) {
                alert(data.info);
            }
        }, 'json');
        return false;
    });

});
//http://demo.genban.org/demo/324/
