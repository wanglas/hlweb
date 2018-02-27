<?php
namespace Admin\Controller;
use Think\Controller;
class SuggestController extends CommonAdminController {
//首页列表加载
    public function index(){
      $suggest=M('suggest');
      $count=$suggest->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$suggest->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
  public function edit(){
    $suggest=D('suggest');
    if(IS_POST){
      $data['id']=I('post.id');
      $data['name']=I('post.name');
      $data['status']=I('post.status');
      $data['update_time']=get_date();
      if (false === $suggest->create()) {
          $this->error($suggest->getError());
      }
      $list=$suggest->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $index_suggest=$suggest->where('id='.$id)->find();
      $this->assign('index_suggest',$index_suggest);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $suggest=D('suggest');
    $id=I('id');
    $delete=$suggest->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
