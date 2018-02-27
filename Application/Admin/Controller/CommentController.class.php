<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends CommonAdminController {
//首页列表加载
    public function index(){
      $comment=M('comment');
      $goods=M('goods');
      $count=$comment->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$comment->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      foreach( $list as $k => $v){
        $gname=get_good_name($list[$k]['gid']);
        $list[$k]['gname']=$gname;
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(!empty(IS_POST)){
        $data['uname']=I('post.uname');
        $data['content']=I('post.content');
        $data['dz_num']=I('post.dz_num');
        $data['pl_num']=I('post.pl_num');
        $data['status']=I('post.status');
        $data['create_time']=time();
        $comment=D('comment');
        if (false === $comment->create()) {
            $this->error($comment->getError());
        }
        $list=$comment->add($data);

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
    $comment=D('comment');
    if(!empty(IS_POST)){
      $data['id']=I('id');
      $data['dz_num']=I('post.dz_num');
      $data['pl_num']=I('post.pl_num');
      $data['status']=I('post.status');
      $data['update_time']=time();
      if (false === $comment->create()) {
          $this->error($comment->getError());
      }
      $list=$comment->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $comment=$comment->where('id='.$id)->find();
      $this->assign('comment',$comment);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $comment=D('comment');
    $id=I('id');
    $delete=$comment->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
