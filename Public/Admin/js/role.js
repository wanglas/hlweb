//配置
var setting = {
			check: {
				enable: true,
				chkboxType:{ "Y" : "ps", "N" : "ps" }
			},
		    data: {
		        simpleData: {
		            enable: true,
		            idKey: "id",
		            pIdKey: "pid"
		        }
		    },
		    callback: {
		        beforeClick: function (treeId, treeNode) {
		            if (treeNode.isParent) {
		                zTree.expandNode(treeNode);
		                return false;
		            } else {
		                return true;
		            }
		        },
				onClick:function(event, treeId, treeNode){
					//栏目ID
					var catid = treeNode.catid;
					//保存当前点击的栏目ID
					$.cookie('tree_catid',catid,{"expires":1});
				}
		    }
};
//zTree对象
var zTree = null;
head.css('zTree');
$(function(){
	head.use('cookie','zTree', function(){
		$.fn.zTree.init($("#roleTree"), setting, zNodes);
		zTree = $.fn.zTree.getZTreeObj("roleTree");
		zTree.expandAll(true);
	});
	
    $('.submit_btn').bind('click', function (e) {
        e.preventDefault();
        /*var btn = $(this).find('button.J_ajax_submit_btn'),
				form = $(this);*/
        var form = $('#role_form');

		//处理被选中的数据
		form.find('input[name="node_ids"]').val("");
		var  nodes = zTree.getCheckedNodes(true); 
		var str = "";
		$.each(nodes,function(i,value){
			if (str != "") {
				str += ","; 
			}
			str += value.id;
		});
		form.find('input[name="node_ids"]').val(str);
		
        $.ajax({
            type: 'post', cache: false, dataType: 'json',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(result) {
                if (result.data == 'success') {
                	window.location.reload(); 
                } else {
                    alert(result.info);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("出错了," + errorThrown);
            }
        });
    });
});