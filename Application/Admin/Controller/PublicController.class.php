<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
//登录页面
  public function login(){
    $this->display();
  }
//核对管理员登录信息
  public function checklogin(){
    if(!empty($_POST)){
      $admin = new \Admin\Model\BaseModel;   //注意大小写
      $name=I('post.username');
      $pwd=MD5(I('post.password'));
      $rst = $admin->checkNamePwd($name,$pwd);
      //  == 全等于
        if ($rst === false) {
            echo '用户名或密码错误';
          } else {
            session("admin_name", $rst['username']);
            $_SESSION['uid']=$rst['id'];
            $this->redirect('Index/index', 0);
          }
      }
        exit;
        $this->display();
    }

    //退出系统
     function loginout() {
         session(null);
         $this->redirect('Public/login', 0);
     }

}
 ?>
