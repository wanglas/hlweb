<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends CommonAdminController {
//首页列表加载
    public function index(){
      $goods=M('goods');
      $count=$goods->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['name']=array('like','%'.$name.'%');
        $list=$goods->where($map)->select();
      }else{
        $list=$goods->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
      $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $goods=D('goods');

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      'goods/'; // 设置附件上传（子）目录
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
        if (false === $goods->create()) {
            $this->error($goods->getError());
        }
        //插入数据
        $goods->img=$imgurl;
        $goods->create_time=get_date();
        $list=$goods->add();
        if($list==false){
            $this->error(L('ADD_ERROR'));
        }else(
          $this->success(L('ADD_SUCCESS'))
        );
      }else{
        // 分类列
        $cate=M('cate');
        $cates_list=$cate->where(1)->select();
        //城市列
        $city=M('city');
        $city_list=$city->where(1)->select();
        $this->assign('city_list',$city_list);
        $this->assign('cates_list',$cates_list);
        $this->display();
      }
    }
//编辑
  public function edit(){
    $goods=D('goods');
    $cate=D('cate');
    if(IS_POST){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
      $upload->savePath  =      'goods/'; // 设置附件上传（子）目录
      // 上传文件
      $info   =   $upload->upload();
      if(!$info) {// 上传错误提示错误信息
        $id=I('post.id');
        $imgurl=get_imgurl('goods',$id);
      }else{// 上传成功 获取上传文件信息
          foreach($info as $file){
              echo $file['savepath'].$file['savename'];
              $imgurl =$file['savepath'].$file['savename'];
          }
      }
      if (false === $goods->create()) {
          $this->error($goods->getError());
      }
      //更新数据
      $goods->img=$imgurl;
      $goods->update_time=get_date();
      $list=$goods->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $good_detail=$goods->where('id='.$id)->find();
      $catename=$cate->where('id='.$good_detail['cid'])->find();
      $cates_list=$cate->where(1)->select();
      //城市列
      $city=M('city');
      $city_list=$city->where(1)->select();
      $cityname=$city->where('id='.$good_detail['city_id'])->find();
      $this->assign('city_list',$city_list);
      $this->assign('cates_list',$cates_list);
      $this->assign('catename',$catename);
      $this->assign('cityname',$cityname);
      $this->assign('good_detail',$good_detail);  //该手机信息
      $this->display();
    }
  }
  //删除
  public function delete(){
    $goods=D('goods');
    $id=I('id');
    $delete=$goods->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
  //手机属性预览
  public function show(){
    $id=I('id');   //手机id
    $goods_property=D('goods_property');
    $goods=D('goods');
    $goodname=$goods->where('id='.$id)->find();   //手机表对应行
    $list=$goods_property->where('gid='.$id)->select();
    $this->assign('list',$list);
    $this->assign('goodname',$goodname);
    $this->display();
  }
}
