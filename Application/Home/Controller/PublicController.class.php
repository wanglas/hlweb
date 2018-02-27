<?php
// 前台用户中心控制器
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
   //登录界面
    public function login(){
      if(null==session('tel') && null==session('uid')){
        $this->display();
      }else{
        $this->redirect('User/index');
      }
      }      
  //登陆加注册核对   判断是否已有该用户
   public function check_login(){
     $user=M('user');
     $tel=I('post.tel');
     $yzm=I('post.yzm');

     $sessyzm=session('phoneyzm')['yzm'];
     $sessphone=session('phoneyzm')['phone'];
     if($tel==$sessphone&&$yzm==$sessyzm&&!empty($tel)&&!empty($yzm)){
       $data['user_tel']=$tel;
       $data['create_time']=time();
       $data['status']='1';
       $map['user_tel']=$tel;
       $result=$user->where($map)->find();
        if(empty($result)){
          $user->add($data);
        }
        session('tel',$tel);
        $result=$user->where('tel='.$tel)->find();
        session('uid',$result['id']);
        $this->redirect('User/index');
     }else{
         echo "<script>alert('提交数据错误');</script>";
         $this->redirect('Public/login');
     }
    $this->redirect('User/index');
   }
   //密码登陆核对
   public function check_login2(){
     if(!empty($_POST)){
       $home= new \Home\Model\BaseModel;   //注意大小写
       $tel=I('post.tel');
       $pwd=md5(I('post.passwd'));
       $rst = $home->checkNamePwd($tel,$pwd);
       //  == 全等于
         if ($rst === false) {
             echo '手机号或密码错误';
           } else {
             session("tel", $rst['user_tel']);
             session('uid',$rst['id']);
             $this->redirect('User/index', 0);
           }
       }
         exit;
         $this->display();
     }

//当前定位session化
  // public function position(){
  //   if(null==session('city')){
  //     echo '0';     //尚未定位
  //   }else{
  //     echo '1';     //已经定位
  //   }
  // }
  // public function session_city_add(){
  //   $city=I('post.city');
  //   echo json_encode($city);
  //   session('city',$city);
  // }
  // public function session_city_get(){
  //   $city=session('city');
  //   echo json_encode($city);
  // }
  //公共提示页面(待完成)
  public function tip($message){
    $this->assign('message',$message);
  }
}
?>
