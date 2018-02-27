<?php
namespace Admin\Controller;
use Think\Controller;
class CityController extends Controller {
//首页列表加载
    public function index(){
      $city=M('city');
      $count=$city->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['name']=array('like','%'.$name.'%');
        $list=$city->where($map)->select();
      }else{
        $list=$city->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
      $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $city=M('city');
        if (false === $city->create()) {
            $this->error($city->getError());
        }
        //插入数据
        $city->create_time=get_date();
        $list=$city->add();
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
    $city=M('city');
    if(IS_POST){
      if (false === $city->create()) {
          $this->error($city->getError());
      }
      //更新数据
      $city->img=$imgurl;
      $city->update_time=get_date();
      $list=$city->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $city_detail=$city->where('id='.$id)->find();
      $this->assign('city_detail',$city_detail);  //该手机信息
      $this->display();
    }
  }
  //删除
  public function delete(){
    $city=D('city');
    $id=I('id');
    $delete=$city->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
  //手机属性预览
  public function show(){
    $id=I('id');   //手机id
    $city_property=D('city_property');
    $city=D('city');
    $goodname=$city->where('id='.$id)->find();   //手机表对应行
    $list=$city_property->where('gid='.$id)->select();
    $this->assign('list',$list);
    $this->assign('goodname',$goodname);
    $this->display();
  }
}
