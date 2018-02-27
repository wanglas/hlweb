<?php
namespace Admin\Controller;
use Think\Controller;
class AdvController extends CommonAdminController {
//首页列表加载
    public function index(){
      $adv=M('adv');
      $count=$adv->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$adv->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $adv=D('adv');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                echo $file['savepath'].$file['savename'];
            }
        }
        $imgurl =$file['savepath'].$file['savename'];
        $data['name']=I('post.name');
        $data['status']=I('post.status');
        $data['img']=$imgurl;
        $data['url']=I('post.url');
        $data['create_time']=get_date();
        $adv=D('adv');
        if (false === $adv->create()) {
            $this->error($adv->getError());
        }
        $list=$adv->add($data);
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
    $adv=D('adv');
    if(IS_POST){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
      $upload->savePath  =      ''; // 设置附件上传（子）目录
      // 上传文件
      $info   =   $upload->upload();
      if(!$info) {// 上传错误提示错误信息
        $id=I('post.id');
        $imgurl=get_imgurl('adv',$id);
      }else{// 上传成功 获取上传文件信息
          foreach($info as $file){
              echo $file['savepath'].$file['savename'];
              $imgurl =$file['savepath'].$file['savename'];
          }
      }
      $data['id']=I('post.id');
      $data['name']=I('post.name');
      $data['status']=I('post.status');
      $data['img']=$imgurl;
      $data['url']=I('post.url');
      $data['upadate_time']=get_date();
      if (false === $adv->create()) {
          $this->error($adv->getError());
      }
      $list=$adv->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $index_adv=$adv->where('id='.$id)->find();
      $this->assign('index_adv',$index_adv);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $adv=D('adv');
    $id=I('id');
    $delete=$adv->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
