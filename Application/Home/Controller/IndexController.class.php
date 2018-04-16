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
class IndexController extends Controller {
    //首页
    public function index(){
      $part='index';
      //新闻数据
      $news=M('article')->where('status=1')->limit('4')->order('create_time Desc')->select();
      //产品轮播，并数据分组
      $goods=M('goods')->where('status=1')->order('create_time Desc')->select();
      $arr=array();
      $length=count($goods)/3;
      for($i=0;$i<$length;$i++)
      {
            $arr[] = array_slice($goods, $i * 3 ,3);
      }
      //底部雇佣信息
      // $employ=M('employ')->where('status=1')->order('create_time Asc')->select();
      // print_r($arr);
      // exit;
      $this->assign('arr',$arr);
      // $this->assign('employ',$employ);
      $this->assign('news',$news);
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
      $employ=M('employ')->where('status=1')->order('create_time Asc')->select();
      $this->assign('employ',$employ);
      $this->assign('name',$part);
      $this->display();
    }
}
