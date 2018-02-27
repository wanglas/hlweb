<?php
namespace Admin\Controller;
use Think\Controller;
class OrderGoodsController extends CommonAdminController {
//首页列表加载
    public function index(){
      $order_goods=M('order_goods');
      $count=$order_goods->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $sn=trim(I('post.sn'));
        $map['order_sn']=$sn;
        $list=$order_goods->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
      }else{
        $list=$order_goods->where(1)->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    // public function add(){
    //   if(IS_POST){
    //     $data['user_name']=$_POST['user_name'];
    //     $data['user_tel']=$_POST['user_tel'];
    //     $data['status']=$_POST['status'];
    //     $data['create_time']=time();
    //     $order_goods=D('order_goods');
    //     if (false === $order_goods->create()) {
    //         $this->error($order_goods->getError());
    //     }
    //     $list=$order_goods->add($data);
    //
    //     if($list==false){
    //         $this->error(L('ADD_ERROR'));
    //     }else(
    //       $this->success(L('ADD_SUCCESS'))
    //     );
    //   }else{
    //     $this->display();
    //   }
    // }
//编辑
  public function edit(){
    $order_goods=M('order_goods');
    if(IS_POST){
      if (false === $order_goods->create()) {
          $this->error($order_goods->getError());
      }
      $order_goods->update_time=time();
      $list=$order_goods->where('id='.I('post.id'))->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $detail=$order_goods->where('id='.$id)->find();
      $orders=M('orders');
      $content=$orders->where('order_sn='.$detail['order_sn'])->find();
      $this->assign('detail',$detail);
      $this->assign('content',$content['content']);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $order_goods=M('order_goods');
    $id=I('id');
    $delete=$order_goods->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
