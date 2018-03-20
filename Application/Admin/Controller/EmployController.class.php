<?php
// 招聘控制器
namespace Admin\Controller;
use Think\Controller;
class EmployController extends CommonAdminController {
//首页列表加载
    public function index(){
      $employ=M('employ');
      $count=$employ->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['title']=array('like','%'.$name.'%');
        $list=$employ->where($map)->select();
      }else{
        $list=$employ->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $employ=M('employ');
        if (false === $employ->create()) {
            $this->error($employ->getError());
        }
        $employ->create_time=time();
        $list=$employ->add();
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
    $employ=M('employ');
    if(IS_POST){
      if (false === $employ->create()) {
          $this->error($employ->getError());
      }
      $employ->update_time=time();
      $list=$employ->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else{
        $this->success(L('EDIT_SUCCESS'));
      }
    }else{
      $id=I('id');
      $employ_detail=$employ->where('id='.$id)->find();
      $this->assign('employ_detail',$employ_detail);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $employ=M('employ');
    $id=I('id');
    $delete=$employ->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
