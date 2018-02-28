<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleCateController extends CommonAdminController {
//首页列表加载
    public function index(){
      $article_cate=M('article_cate');
      $count=$article_cate->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$article_cate->where(1)->order('sort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $article_cate=M('article_cate');
        if (false === $article_cate->create()) {
            $this->error($article_cate->getError());
        }
        $article_cate->create_time=time();
        $list=$article_cate->add();
        if($list==false){
            $this->error(L('ADD_ERROR'));
        }else(
          $this->success()
        );
      }else{
        $this->display();
      }
    }
//编辑
  public function edit(){
    $article_cate=M('article_cate');
    if(IS_POST){
      if (false === $article_cate->create()) {
          $this->error($article_cate->getError());
      }
      $article_cate->update_time=time();
      $list=$article_cate->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $article_cate_detail=$article_cate->where('id='.$id)->find();
      $this->assign('article_cate_detail',$article_cate_detail);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $article_cate=M('article_cate');
    $id=I('id');
    $delete=$article_cate->where('id='.$id)->setField('status',-1);
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
