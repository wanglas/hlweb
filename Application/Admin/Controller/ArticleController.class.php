<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonAdminController {
//首页列表加载
    public function index(){
      $article=M('article');
      $count=$article->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['title']=array('like','%'.$name.'%');
        $list=$article->where($map)->select();
      }else{
        $list=$article->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      'article/'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                echo $file['savepath'].$file['savename'];
            }
        }
        $imgurl = $file['savepath'].$file['savename'];
        $article=M('article');
        if (false === $article->create()) {
            $this->error($article->getError());
        }
        $article->img=$imgurl;
        $article->create_time=date('Y-m-d H:i:s');
        $list=$article->add();
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
    $article=M('article');
    if(IS_POST){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
      $upload->savePath  =      'article/'; // 设置附件上传（子）目录
      // 上传文件
      $info   =   $upload->upload();
      if(!$info) {// 上传错误提示错误信息
          // $this->error($upload->getError());
          $id=I('post.id');
          $imgurl=get_imgurl('article',$id);
      }else{// 上传成功 获取上传文件信息
          foreach($info as $file){
              echo $file['savepath'].$file['savename'];
              $imgurl =$file['savepath'].$file['savename'];
          }
      }
      if (false === $article->create()) {
          $this->error($article->getError());
      }
      $article->img=$imgurl;
      $article->update_time=date('Y-m-d H:i:s');
      $list=$article->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $article_detail=$article->where('id='.$id)->find();
      $this->assign('article_detail',$article_detail);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $article=M('article');
    $id=I('id');
    $delete=$article->where('id='.$id)->setField('status',-1);
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}