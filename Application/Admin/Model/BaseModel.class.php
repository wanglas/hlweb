<?php
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
class BaseModel extends Model{
  //核对登陆管理员和密码
      public function checkNamePwd($name, $pwd) {
          //实例化模型admin
          $admin = M('adminer');
          //接收控制器传的数据，进行判断是否一致。并且返回
          $map['name']=$name;
          $info = $admin->where($map)->find();
          //如果name属性数据存在则进行判断对应的密码是否一致，同时返回。
          if ($info != null) {
              //验证密码
              if ($info['pwd'] == $pwd) {
                  return $info;
              } else {
                  return false;
              }
          } else {
              return false;
            }
    }
}
?>
