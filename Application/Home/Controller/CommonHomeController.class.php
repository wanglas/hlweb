<?php
//++++++++前台基础类
namespace Home\Controller;
use Think\Controller;
class CommonHomeController extends Controller{
  // 登陆验证
  protected function _initialize(){
      if(session("uid")==null){
        session('uid',16);
          // $this->getOpenId();
          $this->redirect('User/index');
        }
    }
    // 获取用户openid
    public function getOpenId(){
     $url = 'http://cxjp.xhnxxw.com/index.php/Home/Orders/access_token/';
     $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb16047f8b5dcb2ac&redirect_uri='.urlencode($url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
     header('location:'.$url);
    }
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
    * 核对当前用户是否进行了实名认证
    * @access  public
    * @param
    *
    * @return
    */
    public function check_identify(){
        $user=M('user');
        $id=get_user_id();
        $info=$user->where('id='.$id)->find();
        if ($info['is_certificate']=='2') {
            echo '2';   //已经完成实名认证
        }else if($info['is_certificate']=='1'){
            echo '1';   //审核中
        }else{
            echo '0';  //未进行实名认证
        }
      }

}


 ?>
