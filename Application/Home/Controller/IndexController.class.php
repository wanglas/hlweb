<?php
// +----------------------------------------------------------------------
// | Function:首页控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月8日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
        //首页逻辑
    public function index(){
      //取出轮播图片数据
      $adv=M('adv');
      $adv=$adv->where('status=1')->select();
      //获取商品分类
      $cate=M('cate');
      $cate=$cate->where('status=1')->select();
      //获取各种活动
      $activity=M('activity');
      $a_map['status']=1;
      $time_now=time();
      $a_map['saletime']=array('lt',$time_now);  //小玉
      $a_map['nosaletime']=array('gt',$time_now);
      $activity_list=$activity->where($a_map)->select();
      foreach ($activity_list as $key => $value) {
          $v=$value['discount'];
          $activity_list[$key]['discount']=10*$v;      //重写字段将折扣从小树提成整数
      }
      $this->assign('cate',$cate);
      $this->assign('activity_list',$activity_list);
      $this->assign('adv',$adv);
	    $this->display();
    }
    //获取分类数据
    public function get_cate(){
      $cate=M('cate');
      $cate=$cate->where('status=1')->select();
      $this->assign('cate',$cate);
      $this->display();
    }
}
