function draw_map(xpoint,ypoint,zoom)
{
    if(!arguments[2]) zoom = 16;
    var map = new BMap.Map("view_container"); 
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
    var marker=new BMap.Marker(point);
    map.addOverlay(marker);
}