<?php
namespace Admin\Controller;
use Think\Controller;
class ActivityController extends CommonAdminController {
//首页列表加载
    public function index(){
      $activity=M('activity');
      $count=$activity->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['title']=array('like','%'.$name.'%');
        $list=$activity->where($map)->select();
      }else{
        $list=$activity->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
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
        $upload->savePath  =      'activity/'; // 设置附件上传（子）目录
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
        $activity=M('activity');
        if (false === $activity->create()) {
            $this->error($activity->getError());
        }
        //时间戳为了方便比较
        $activity->saletime=strtotime(I('post.saletime'));
        $activity->nosaletime=strtotime(I('post.nosaletime'));
        $activity->img=$imgurl;
        $activity->create_time=get_date();
        $list=$activity->add();
        if($list==false){
            $this->error(L('ADD_ERROR'));
        }else(
          $this->success(L('ADD_SUCCESS'))
        );
      }else{
        $goods=M('goods');
        $goods_list=$goods->where('status=1')->select();
        $this->assign('goods_list',$goods_list);
        $this->display();
      }
    }
//编辑
  public function edit(){
    $activity=M('activity');
    if(IS_POST){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
      $upload->savePath  =      'activity/'; // 设置附件上传（子）目录
      // 上传文件
      $info   =   $upload->upload();
      if(!$info) {// 上传错误提示错误信息
          // $this->error($upload->getError());
          $id=I('post.id');
          $imgurl=get_imgurl('activity',$id);
      }else{// 上传成功 获取上传文件信息
          foreach($info as $file){
              echo $file['savepath'].$file['savename'];
              $imgurl =$file['savepath'].$file['savename'];
          }
      }
      if (false === $activity->create()) {
          $this->error($activity->getError());
      }
      //时间戳为了方便比较
      $activity->saletime=strtotime(I('post.saletime'));
      $activity->nosaletime=strtotime(I('post.nosaletime'));
      $activity->img=$imgurl;
      $activity->update_time=get_date();
      $list=$activity->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $goods=M('goods');
      $goods_list=$goods->where('status=1')->select();
      $activity_detail=$activity->where('id='.$id)->find();
      $goodname=get_good_name($activity_detail['gid']);
      $this->assign('goods_list',$goods_list);
      $this->assign('goodname',$goodname);
      $this->assign('activity_detail',$activity_detail);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $activity=M('activity');
    $id=I('id');
    $delete=$activity->where('id='.$id)->setField('status',-1);
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
