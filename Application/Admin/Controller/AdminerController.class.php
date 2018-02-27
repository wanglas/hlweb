<?php
// +----------------------------------------------------------------------
//   系统设置管理员控制器
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
class AdminerController extends CommonAdminController {
//首页列表加载
    public function index(){
      $adminer=M('adminer');
      $count=$adminer->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$adminer->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $data['name']=I('post.name');
        $data['pwd']=md5(I('post.pwd'));
        $confirm=I('post.confirm_pwd');
        $data['status']=I('post.status');
        $data['create_time']=time();
        parent::check_twice_pwd($data['pwd'],md5($confirm));
        parent::is_exist_name($data['name']);
        $adminer=D('Adminer');
        if (false === $adminer->create()) {
            $this->error($adminer->getError());
        }
        $list=$adminer->add($data);

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
    $adminer=D('adminer');
    if(IS_POST){
      $data['id']=I('post.id');
      $data['name']=I('post.name');
      $data['pwd']=md5(I('post.pwd'));
      $confirm=I('post.confirm_pwd');
      parent::check_twice_pwd($data['pwd'],md5($confirm));
      $data['status']=I('post.status');
      $data['update_time']=time();
      if (false === $adminer->create()) {
          $this->error($adminer->getError());
      }
      $list=$adminer->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $manager=$adminer->where('id='.$id)->find();
      $this->assign('manager',$manager);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $adminer=D('adminer');
    $id=I('id');
    $delete=$adminer->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
