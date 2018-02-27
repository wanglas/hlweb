<?php
//供应商控制器
namespace Home\Controller;
use Think\Controller;
class SupplierController extends CommonHomeController {
    // 供应商首页
    public function index(){
      $supplier=M('supplier');
      $list=$supplier->where('status=1')->select();
      //取出图片
      foreach ($list as $key => $value) {
          $v=explode('#',$value['img']);
          $list[$key]['img']=$v['0'];      //重写字段
      }
      $this->assign('list',$list);
	    $this->display();
    }
    // 供应商详细页面s
    public function detail(){
      $supplier=M('supplier');
      $id=I('id');
      $detail=$supplier->where('id='.$id)->find();
      //取出图片
      $arr=explode('#',$detail['img']);
      $this->assign('arr',$arr);
      $this->assign('detail',$detail);
      $this->display();
    }
}
