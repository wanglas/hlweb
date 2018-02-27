	function search_api(api_address,city)
	{        
		var map = new BMap.Map("container"); 
		map.enableScrollWheelZoom();  // 开启鼠标滚轮缩放
        var opts = {type: BMAP_NAVIGATION_CONTROL_ZOOM }  
        map.addControl(new BMap.NavigationControl());  
        // map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);  
        // 创建地理编码服务实例  
        var myGeo = new BMap.Geocoder();  
        // 将结果显示在地图上，并调整地图视野  
        myGeo.getPoint(api_address, function(point){  
            if (point) {  
                map.centerAndZoom(point, 16);  
                map.addOverlay(new BMap.Marker(point));
                $("input[name='xpoint']").attr('value',point.lng);
                $("input[name='ypoint']").attr('value',point.lat);
            }  
        }, city);  
    }
	
	function draw_map(xpoint,ypoint,zoom)
	{
		if(!arguments[2]) zoom = 16;
		var map = new BMap.Map("container"); 
		//添加左侧控制台
        //var opts = {type: BMAP_NAVIGATION_CONTROL_ZOOM }  
        //map.addControl(new BMap.NavigationControl());  
        // map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);  
        // 创建地理编码服务实例  
        var point = new BMap.Point(xpoint,ypoint);
        map.enableScrollWheelZoom();                  // 启用滚轮放大缩小。
		//map.enableKeyboard();                         // 启用键盘操作。
        // 将结果显示在地图上，并调整地图视野  
        map.centerAndZoom(point, zoom);  
        map.addOverlay(new BMap.Marker(point));
	}
	
    /*弹出窗口，并初始化地图*/
    function editMap(x,y,zoom)
    {
        $("#container_front").show();
        creat_map(x,y,zoom);
    }
	
	
	/*对弹出窗口初始化地图*/
    function creat_map(xpoint,ypoint,zoom){
		if(!arguments[2]) zoom = 17;
        var map = new BMap.Map("container_m");  
		map.enableScrollWheelZoom();  // 开启鼠标滚轮缩放
        var point = new BMap.Point(xpoint, ypoint);  
        map.centerAndZoom(point, zoom);  
        var myIcon = new BMap.Icon(red_point, new BMap.Size(28, 38));  
        var marker = new BMap.Marker(point,{icon:myIcon});        // 创建标注  
        //var name=$("input[name='name']").attr('value');
		var name='拖动蓝色标志选择位置';
        var label=create_lable(name);
        marker.setLabel(label);       
        map.addOverlay(marker);                     // 将标注添加到地图中        
        //新坐标
        var myIcon = new BMap.Icon(blue_point, new BMap.Size(21, 27));  
        var marker_change = new BMap.Marker(point, {icon: myIcon});  
        map.addOverlay(marker_change);
		$("#yes_btn").click(function(){ 
			$("input[name='xpoint']").attr('value',marker_change.point.lng);
            $("input[name='ypoint']").attr('value',marker_change.point.lat);
			//获取当前缩放级别
			$("input[name='mapzoom']").attr('value',map.getZoom());
            $("#container_front").hide();
            new_map(marker_change.point.lng,marker_change.point.lat,xpoint,ypoint,map.getZoom());
		});
        //marker_change.addEventListener("dragend", function(e){  
          //  if(confirm('是否更新标记坐标?')){               
            //    $("input[name='xpoint']").attr('value',e.point.lng);
              //  $("input[name='ypoint']").attr('value',e.point.lat);
				//获取当前缩放级别
				//$("input[name='zoom']").attr('value',map.getZoom());
                //$("#container_front").hide();
                //new_map(e.point.lng,e.point.lat,xpoint,ypoint,map.getZoom());
            //}
        //})  
        marker_change.enableDragging(); 
      
        map.addControl(new BMap.NavigationControl()); 
    }


    /*生成2个标记*/
    function new_map(x,y,old_x,old_y,zoom){
        var map = new BMap.Map("container");  
        var xpoint=old_x;
        var ypoint=old_y;
        var point = new BMap.Point(xpoint, ypoint);  
        map.centerAndZoom(point, zoom);
        var point_new=new BMap.Point(x, y);  
        var myIcon_curron = new BMap.Icon(blue_point, new BMap.Size(28, 38));  
        var marker = new BMap.Marker(point_new,{icon:myIcon_curron});  
        var label=create_lable("当前坐标");
        marker.setLabel(label);
        map.addOverlay(marker);                     // 将标注添加到地图中  
        //var opts = {type: BMAP_NAVIGATION_CONTROL_SMALL}  
        //map.addControl(new BMap.NavigationControl(opts)); 
        map.enableScrollWheelZoom();  // 开启鼠标滚轮缩放 
        var myIcon = new BMap.Icon(red_point, new BMap.Size(28, 38));  
        var marker_old = new BMap.Marker(point,{icon:myIcon}); 
        var label_old=create_lable("原始坐标");
        marker_old.setLabel(label_old);
        map.addOverlay(marker_old);
        marker.addEventListener('mouseover',function(){
            map.panTo(new BMap.Point(x,y));
        }); 
        window.setTimeout(function(){  
            map.panTo(point_new);
        }, 500);    
    }
	  function create_lable(name){
        var label = new BMap.Label(name,{"offset":new BMap.Size(-8,-20)});
        label.setStyle({
            borderColor:"#808080",
            color:"#333",
            cursor:"pointer"
        });
        return label;
    }