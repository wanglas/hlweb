<?php
//共用基础类
// wanglas
 /**
  * 输出字符串时间
  *
  * @access  public
  * @param   表名
  *
  * @return   二维数组
  */
 function  get_date(){
   $time=date('Y-m-d H:i:s');
   return $time;
 }
 /**
  * 获取分类名称
  *
  * @access  public
  * @param   表名
  *
  * @return   二维数组
  */
 function  get_cate_name($id){
   $cate=M('cate');
   $info=$cate->where('id='.$id)->find();
   $name=$info['name'];
   return $name;
 }
 /**
  * 获取城市名称
  *
  * @access  public
  * @param   表名
  *
  * @return   二维数组
  */
 function  get_city_name($id){
   $city=M('city');
   $info=$city->where('id='.$id)->find();
   $name=$info['city_name'];
   return $name;
 }
 /**
  * 获取商品信息
  *
  * @access  public
  * @param   表名
  *
  * @return   array
  */
 function  get_good_info($id){
   $model=M('goods');
   $info=$model->where('id='.$id)->find();
   return $info;
 }
 /**
  * 获取图片
  *
  * @access  public
  * @param   表名
  *
  * @return   图片字段
  */
 function  get_img($id,$model){
   $model=M($model);
   $info=$model->where('id='.$id)->find();
   $img=$info['img'];
   return $img;
 }
 /**
  * 获取有效的收货地址
  *
  * @access  public
  * @param   uid
  *
  * @return   收货地址列表
  */
 function  get_address_list($uid){
   $address=M('user_address');
   $map['status']='1';
   $map['uid']=$uid;
   $address_list=$address->where($map)->order('create_time desc')->select();
   return $address_list;
 }
 /**
  * 获取选中的收货地址
  *
  * @access  public
  * @param   uid
  *
  * @return   收货地址列表
  */
 function  get_address_info($id){
   $address=M('user_address');
   $map['id']=$id;
   $address=$address->where($map)->find();
   return $address;
 }
 /**
  * 获取订单信息
  *
  * @access  public
  * @param   传入订单号
  *
  * @return 返回订单信息
  */
  function  get_sn_info($sn){
    $model=M('orders');
    $map['order_sn']=$sn;
    $info=$model->where($map)->find();
    return $info;
   }
   /**
    * 根据id获取用户信息
    *
    * @access  public
    * @param    $id   输入信息     操作wx_user 表
    *
    * @return $name 单独一个name字段
    */
    function get_user_info($id){
     $model=M('user');
     $map['id']=$id;
     $result=$model->where($map)->find();
     if(empty($result)){
       $this->error();
     }else{
       return $result;
     }
   }
   /**
    * editor转换输出
    *
    * @access  public
    * @param    $str   输入信息
    *
    * @return $str
    */
    function changeContent($str){
      $str= htmlspecialchars_decode($str);
      return $str;
   }
 ?>
