<?php
include('common.php');
/**
 * select下拉数据提供(获取status=1的所有行）
 *
 * @access  public
 * @param   表名
 *
 * @return   二维数组
 */
  function get_table_list($table){
   $model=M($table);
   $map['status']=1;
   $result=$model->where($map)->select();
   if(empty($result)){
     $this->error();
   }else{
     return $result;
   }
 }
 /**
  * 获取表中一条数据
  *
  * @access  public
  * @param   $table表名  $id 传入id
  *
  * @return   二维数组
  */
   function get_one_info($table,$id){
    $model=M($table);
    $map['id']=$id;
    $result=$model->where($map)->find();
    if(empty($result)){
      $this->error();
    }else{
      return $result;
    }
  }
 /**
  * 根据id获取该条信息所在表的name字段
  *
  * @access  public
  * @param   $table表名   $id
  *
  * @return $name 单独一个name字段
  */
   function get_name($table,$id){
    $model=M($table);
    $map['status']=1;
    $map['id']=$id;
    $result=$model->where($map)->find();
    $name=$result['name'];
    if(empty($result)){
      $this->error();
    }else{
      return $name;
    }
  }

  /**
   * 生成订单号
   *
   * @access  public
   * @param   无传入值
   *
   * @return 生成唯一订单编号
   */
   function  order_sn(){

      return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    /**
     * 取消订单
     *
     * @access  public
     * @param   $table 传入表名  $id  主键值
     *
     * @return 取消订单
     */
     function cancel_order($table,$id){
       $model=M($table);
       $map['id']=$id;
       $model->where($map)->setField('status',6);
     }

     /**
      * 判断银行卡所属银行
      *
      * @access  public
      * @param   $card  传入卡号
      *
      * @return 银行卡名字
      */
     function bankInfo($card,$bankList)
          {
            $card_8 = substr($card, 0, 8);
            if (isset($bankList[$card_8])) {
              return $bankList[$card_8];
              return;
            }
            $card_6 = substr($card, 0, 6);
            if (isset($bankList[$card_6])) {
              return $bankList[$card_6];
              return;
            }
            $card_5 = substr($card, 0, 5);
            if (isset($bankList[$card_5])) {
              return $bankList[$card_5];
              return;
            }
            $card_4 = substr($card, 0, 4);
            if (isset($bankList[$card_4])) {
              return $bankList[$card_4];
              return;
            }
            return '该卡号信息暂未录入';
          }
      /**
      * 获取当前状态的用户id
      *
      * @access  public
      * @param
      *
      * @return 用户id
        */
      function get_user_id(){
        $user=M('user');
        $map['id']=session('uid');
        $map['status']='1';
        $user_info=$user->where($map)->find();
        if ($user_info) {
          return $user_info['id'];
        }else{
          $this->error();
        }
      }
 ?>
