<?php
namespace Admin\Controller;
use Think\Controller;
class CateController extends CommonAdminController {
//首页列表加载
    public function index(){
      $cate=M('cate');
      $count=$cate->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$cate->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $data['name']=I('post.name');
        $data['status']=I('post.status');
        $data['create_time']=time();
        $cate=D('cate');
        if (false === $cate->create()) {
            $this->error($cate->getError());
        }
        $list=$cate->add($data);

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
    $cate=D('cate');
    if(IS_POST){
      $data['id']=I('post.id');
      $data['name']=I('post.name');
      $data['status']=I('post.status');
      $data['update_time']=time();
      if (false === $cate->create()) {
          $this->error($cate->getError());
      }
      $list=$cate->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $pinpai=$cate->where('id='.$id)->find();
      $this->assign('pinpai',$pinpai);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $cate=M('cate');
    $id=I('id');
    $delete=$cate->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
