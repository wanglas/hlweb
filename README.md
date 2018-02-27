###session配置

1.session('cid')      分类。
2.session('city_id')  城市  
<!-- 登陆的时候缓存了电话号和用户id -->
3.session('tel',$tel);
4.session('uid',$result['id']);
5.		//把结算订单中商品存储 写在ordersController
		session('selGoods',$result);
6.session('total')   价格
7.session('now_price')  
ps:sesion()  乱传入值会造成session清空

支付的时候不能用session传值

#订单状态
$order_goods->pay_status=0;     //0 未付款   1付款中  2 已付款
$order_goods->order_status=0;   //0  未确认   1确认  2   已取消  3 无效  4退款
$order_goods->shipping_status=0;    ///0未发货   1 已发货  2 已收货  4 退货


###待开发功能（不足）
1.后台管理员权限分配  Auth/RBAC 两种选择。
2.首页统计。
3.支付功能。
4.邮寄公司选择列表。
5.没有使用自定义标签,耦合度底。
6.没有上传图片也可以提交,在php中进行if判断    #已完成
7.一些操作都可以封装城函数（表命加id）
8.验证码    #完成

###效果图
1.先进行页开发


###前端
1.设置内边框  'box-sizing': 'border-box',
2.图片完全填充       background-size: 100% auto;
3.input的样式可以修改
4.去除a标签点击变色。
5.textarea的placeholder不显示是因为标签之间有空格
6.kindeditor 上线后如果无法上传图片就是文件夹权限问题
7.不显示图片可能是因为路径不对

###后端
1.查询不好使就使用数组查询。


#####上线功能
1.维修故障表有个字段报错(上线之后)   #ok
2.上线部署为debug为false
3.phpmyadmin 改为  syykx_mysql


#####form表单
1.form标签中的name不能为空？？ 否则不能提交

####调用方法

1.调用common中的方法，不需要写$this;
$a=functionname();

####查询语句

1.like查询         $map['name']=array('like','%'.$name.'%');

####jq使用

1.获取select所选中的那行其他属性       var area=$('.district').find("option:selected").attr('data-title');


####坑

1.手机需要具备可回收和可维修两种状态
2.Using $this when not in object context  可能是使用了没有声明的变量或者类
3.最好使用 多表连查，减少冗余字段的使用，否则会造成信息丢失。
4.数据库初期设计最好保持字段一致性,想好需要公用的函数设计。
5.项目上线以后图片上传提示uploads不存在，就是因为在linux运行下uploads以及它下面的目录没有写权限，将权限改成777权限。
6.两表连查别忘了left,where条件填写表名加上字段名

####其他信息
1.
//回收手机模块订单状态判断
//  <if condition="$recover['status'] eq 1">待填写订单</if>
//  <if condition="$recover['status'] eq 2">待发货订单</if>
//  <if condition="$recover['status'] eq 3">已发货订单</if>
//  <if condition="$recover['status'] eq 4">已收货订单</if>
//  <if condition="$recover['status'] eq 5">已完成订单</if>
//  <if condition="$recover['status'] eq 6">已取消订单</if>

//  <if condition="$recover['status'] eq 10">已删除订单</if>    这个状态可以后续完善
2.
维修手机订单状态判断
//1.待支付订单1
//2.已支付订单2
//3.已取消订单6

3.
快速下单 1代表维修 2代表回收

###前端开发
没有钱或者没到提前金额的时候，按钮显示灰色的

####THINKPHP
1.前台输出  {$ma.title|mb_substr=0,5,'utf-8'}中文    {$vo['cardnum']|substr=-4,4}   从倒数低4位开始截取，长度为4
            正确的写法
            ｛$a['a']['b']|substr=0,2｝ //显示前面，两个字符
            ｛$a['a']['b']|substr=0,-2｝//删除后面，两个字符
            ｛$a['a']['b']|substr=2,-2｝//删除前后，两个字符
            ｛$a['a']['b']|substr=-4,2｝//显示后4到前进2字符
            ｛$a['a']['b']|substr=-4,-2｝//显示后4到后2字符



###Linux命令
1.ldd  查看动态依赖库

###常用名词
1.QPS.每秒查询率QPS是对一个特定的查询服务器在规定时间内所处理流量多少的衡量标准。

###值得一试
1.ajax刷新列表
2.下拉刷新（js）
3.商品自动上下架
4.购物车
