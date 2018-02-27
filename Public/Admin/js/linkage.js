// 选择框联动
//2011.03.17  龚云云
//www.nbyum.com

jQuery.fn.extend({
    linkage:function(o){    //菜单联动
		
        var obj={};

		obj.data              = o.data        			|| districtData;            //数据
        obj.return_dom        = o.return_dom			|| "linkage";				//获取数据容器
		obj.set				  = o.set					|| "0";						//初始设置，级数和默认值
		obj.name		  	  = o.name					|| "请选择城市";				//初始文字
		obj.level			  = o.level					|| 10;						//联动级数
		obj.set=obj.set.split(",");
		
		var dom=this;
		var level=new Array()		

		
		$linkage_box=$("<div>").addClass("linkage_box");	//选择容器
		$val=$("<input>").addClass(obj.return_dom).attr("type","text").val("").appendTo($(this));
		$close=$("<a>").addClass('close');
		dom.find('input[class='+obj.return_dom+']').hide();
		var html="";
		data=obj.data;
		
		//计算联动级数并显示
		for(var i=0;i<obj.set.length;i++){
			html=data[obj.set[i]]!=null?data[obj.set[i]]['name']:obj.name;	
			level[i]=[obj.set[i],html];	//各级初始化
			$select_text=$("<div>").html(html).addClass("select_text");	//选择框文字
			$linkage_select=$("<div>").addClass("linkage_select").append($select_text).appendTo(dom);	//选择框
			if(data[obj.set[i]]==null||data[obj.set[i]]['cell']==null)		//没有当前级数据或没有子数据则跳出循环
				break;
			data=data[obj.set[i]]['cell']!=null?data[obj.set[i]]['cell']:null;
		}

		selected();
		
		$('.close').live('click',function(){
			$linkage_box.hide();								  
		})
		
		
		
		function choose(i){
			//重置选择值
			for(var j=i;j<level.length;j++){
				level[j]="";
			}

			
			dom.find(".linkage_select:gt("+i+")").hide();	//隐藏小于当前级别的选择框

			//根据父级获取当前级别数据
			data=obj.data;
			var l= 0; 
			while(l<i) 
			{ 
				if(data[level[l][0]]!=null&&data[level[l][0]]['cell']!=null){
					data=data[level[l][0]]['cell'];
					l++; 
				}else{
					return false;
				}
			} 
			
			
			var option="";	//选择项
			
			for(var key in data){
				option +="<span class='"+key+"'>"+data[key]['name'] + "</span>";			
			};
	
			$linkage_box.css({"width":"300px"}).html(option).prepend($close).appendTo(dom.find(".linkage_select").eq(i)).show()
			.children("span").click(function(){
				level[i]=[$(this).attr("class"),$(this).html()];		//记录当前ID和值
				$(".linkage_box").hide();
				
				dom.find(".select_text").eq(i).html(level[i][1]).end().eq(i+1).html("请选择");
	

				dom.find('input[class='+obj.return_dom+']').val(getJSON());
				dom.find('input[class='+obj.return_dom+']').attr('name',obj.return_dom);
				if(data[level[i][0]]!=null&&data[level[l][0]]['cell']!=null){
				
					if(dom.find(".linkage_select").size()<=i+1){		//没有下级则插入下级DOM
						$("<div>").addClass("linkage_select").append($("<div>").html("请选择").addClass("select_text")).appendTo($(this).parent().parent().parent());
						selected();
					}else{
						dom.find(".linkage_select").eq(i+1).show();
					}

					choose(i+1);
				}
			})
		}
		
		//给选择框绑定事件
		function selected(){

			dom.find(".select_text").each(function(i){
				$(this).click(function(){
					choose(i);
				})	
			})
		}
		
		function getJSON(){
			var json="";
			for(var i=0;i<level.length;i++){
				if(level[i][0]!=null)
					json=level[i][0]
			}
			//json=json.substring(0,json.length-1)+"";
			return json;
		}

    }


});