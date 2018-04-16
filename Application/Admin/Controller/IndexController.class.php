<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonAdminController {
//首页框架加载
    public function index(){
      $name=session('admin_name');
      $this->assign('name',$name);
	    $this->display();
    }
//默认首页
   public  function shouye(){
     //统计交易额
     $map['pay_status']='2';
     $total_money=M('order_goods')->where($map)->sum('order_money');
     //统计订单数量
     $order_num=M('orders')->where(1)->count();
     $this->assign('order_num',$order_num);
     $this->assign('total_money',$total_money);
     $this->display();
   }
   public function del(){
     delFileByDir(RUNTIME_PATH);
     $this->success('删除缓存成功！');
   }
}
