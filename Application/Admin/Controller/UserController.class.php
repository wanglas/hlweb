<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonAdminController {
//首页列表加载
    public function index(){
      $user=M('user');
      $count=$user->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$user->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(!empty(IS_POST)){
        $data['user_name']=I('post.user_name');
        $data['user_tel']=I('post.user_tel');
        $data['user_money']=I('post.user_money');
        $data['user_address']=I('post.user_address');
        $data['real_name']=I('post.real_name');
        $data['idcard']=I('post.idcard');
        $data['status']=I('post.status');
        $data['create_time']=time();
        $user=D('user');
        if (false === $user->create()) {
            $this->error($user->getError());
        }
        $list=$user->add($data);

        if($list==false){
            $this->error(L('ADD_ERROR'));
        }else(
          $this->success(L('ADD_SUCCESS'))
        );
      }else{
        $this->display();
      }
    }
//编辑
  public function edit(){
    $user=D('user');
    if(IS_POST){
      $data['id']=I('post.id');
      $data['user_name']=I('post.user_name');
      $data['user_tel']=I('post.user_tel');
      $data['user_money']=I('post.user_money');
      $data['user_address']=I('post.user_address');
      $data['real_name']=I('post.real_name');
      $data['idcard']=I('post.idcard');
      $data['status']=I('post.status');
      $data['update_time']=time();
      if (false === $user->create()) {
          $this->error($user->getError());
      }
      $list=$user->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $people=$user->where('id='.$id)->find();
      $photo=explode('#',$people['photo']);
      $this->assign('photo',$photo);
      $this->assign('people',$people);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $user=M('user');
    $id=I('id');
    $delete=$user->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
  //审核实名认证
  public function pass(){
    $user=M('user');
    $id=I('id');
    $pass=$user->where('id='.$id)->setField('is_certificate','2');
    if($pass==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
