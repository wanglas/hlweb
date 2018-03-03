<?php
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
   * 根据id获取表的name字段
   *
   * @access  public
   * @param    $id  $table
   *
   * @return $name 单独一个name字段
   */
    function get_name($table,$id){
     $model=M($table);
     $map['id']=$id;
     $result=$model->field('id,name')->where($map)->find();
     $name=$result['name'];
     if(empty($result)){
       $this->error();
     }else{
       return $name;
     }
   }
  /**
   * 根据id获取该条信息所在表的img字段
   *
   * @access  public
   * @param   $table表名   $id
   *
   * @return $name 单独一个name字段
   */
    function get_imgurl($table,$id){
     $model=M($table);
     $map['id']=$id;
     $result=$model->where($map)->find();
     $img=$result['img'];
     if(empty($result)){
       $this->error();
     }else{
       return $img;
     }
   }
  /**
   * 根据id获取该条信息所在表的pid字段
   *
   * @access  public
   * @param   $table表名   $id   默认状态许可
   *
   * @return
   */
    function get_pid($table,$id){
     $model=M($table);
     $map['status']=1;
     $map['id']=$id;
     $result=$model->where($map)->find();
     $pid=$result['pid'];
     if(empty($result)){
       $this->error();
     }else{
       return $pid;
     }
   }
   /**
    * 根据传入信息准确搜索(查询准确数据，唯一存在)
    *
    * @access  public
    * @param   $table表名   $info   输入信息
    *
    * @return $name 单独一个name字段
    */
     function exact_search($table,$field,$info){
      $model=M($table);
      $map[$field]=$info;
      $result=$model->where($map)->find();
      if(empty($result)){
        $this->error();
      }else{
        return $result;
      }
    }
 ?>
