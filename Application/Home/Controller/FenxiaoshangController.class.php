<?php
// +----------------------------------------------------------------------
// | Function:分销商控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月10日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class FenxiaoshangController extends CommonHomeController {
  //  主界面
  public function index(){
    $user_info=R('User/user_info');
    $nick_name=R('User/get_nick_name');
    $this->assign('nick_name',$nick_name);
    $this->assign('user_info',$user_info);
    $this->display();
  }
}
?>
