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
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      'cate/'; // 设置附件上传（子）目录
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
        $data['create_time']=date('Y-m-d H:i:s');
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
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
      $upload->savePath  =      'cate/'; // 设置附件上传（子）目录
      // 上传文件
      $info   =   $upload->upload();
      if(!$info) {// 上传错误提示错误信息
        $id=I('post.id');
        $imgurl=get_imgurl('cate',$id);
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
      $data['update_time']=date('Y-m-d H:i:s');
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
