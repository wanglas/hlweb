<?php
// +----------------------------------------------------------------------
// | Function:首页控制器
// +----------------------------------------------------------------------
// | Data: 2018年4月2日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    //首页
    public function index(){
      $part='product';
      $this->assign('name',$part);
	    $this->display();
    }
    //公司介绍
    public function introduction(){
      $part='introduction';
      $this->assign('name',$part);
      $this->display();
    }
    //成功案例
    public function successplan(){
      $part='successplan';
      $this->assign('name',$part);
      $this->display();
    }
    //联系我们
    public function contactus(){
      $part='contactus';
      $this->assign('name',$part);
      $this->display();
    }
    //招聘
    public function employ(){
      $part='employ';
      $this->assign('name',$part);
      $this->display();
    }
}
