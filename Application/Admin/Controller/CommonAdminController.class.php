<?php
// +----------------------------------------------------------------------
//   后台基础控制器
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class CommonAdminController extends Controller {

  /**
  * 初始化方法
  */
//登陆验证
  protected function _initialize(){
      if(null==session("admin_name")){
          $this->redirect('Public/login');
        }
          // $auth=new \Think\Auth();
          // $rule_name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
          // $result=$auth->check($rule_name,$_SESSION['user']['id']);
          // if(!$result){
          //   $this->error('您没有权限访问');
          // }
    }

  //   上线之后修改锁定ip登陆
  //   $ip=get_client_ip();
  //   echo $ip;
  //   if($ip=='127.0.0.1'){
  //       if(null==session("admin_name")){
  //         $this->redirect('Public/login');
  //       }
  //     }else{
  //       exit('不允许登录的IP');
  //   }
  // }

  /**
   * 核对两次密码是否一致
   *
   * @access  public
   * @param   $pwd   第一次密码   $ c_pwd   第二次输入密码
   *
   * @return
   */
   public function check_twice_pwd($pwd,$c_pwd){
     if(!(trim($pwd)==trim($c_pwd))){
        $this->error(L('TWICE_PWD_DIFFERENT'));;
     }
   }
   /**
    * 判断后台管理员是否已存在
    *
    * @access  public
    * @param   $name  所要判断的名字
    *
    * @return
    */
    public function is_exist_name($name){
      $model=M('adminer');
      $map['name']=$name;
      $result=$model->where($map)->find();
      if(!empty($result)){
        $this->error(L('ALREADY_EXIST'));
      }
    }
}
