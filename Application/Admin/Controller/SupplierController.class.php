<?php
//后台供应商控制器
namespace Admin\Controller;
use Think\Controller;
class SupplierController extends CommonAdminController {
//首页列表加载
    public function index(){
      $supplier=M('supplier');
      $count=$supplier->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['company_name']=array('like','%'.$name.'%');
        $list=$supplier->where($map)->select();
      }else{
        $list=$supplier->where(1)->order('create_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
    //添加
    public function add(){
      $supplier=M('supplier');
      if(IS_POST){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath  =      'supplier/'; // 设置附件上传目录
        $info=array();
        foreach ($_FILES['photo']['name'] as $key=>$value){
            $file1=array();
            $file1["photo"]['name']=$value;
            $file1["photo"]['type']=$_FILES['photo']["type"][$key];
            $file1["photo"]['tmp_name']=$_FILES['photo']["tmp_name"][$key];
            $file1["photo"]['error']=$_FILES['photo']["error"][$key];
            $file1["photo"]['size']=$_FILES['photo']["size"][$key];
            $info   =   $upload->upload();
            foreach ($info as $key=>$value)
               {
                 $a.="#".$value['savepath'].$value['savename'];//我用符号把图片路径拼起来
               }
             }

         $data["intro_pic"]=substr($a,1);
         $imgurl = $data["intro_pic"];
         //开始自动创建
         if (false === $supplier->create()) {
             $this->error($supplier->getError());
         }
        $supplier->img=$imgurl;
        $supplier->create_time=get_date();
        $list=$supplier->add();
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
    $supplier=M('supplier');
    if(IS_POST){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   =     3145728 ;// 设置附件上传大小
      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
      $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
      $upload->savePath  =      'supplier/'; // 设置附件上传（子）目录
      // 上传文件
      $info=array();
      $info   =   $upload->upload();
      if(!$info) {
        // 上传错误提示错误信息
          // $this->error($upload->getError());
          $id=I('post.id');
          $imgurl=get_imgurl('supplier',$id);
      }else{
        // 上传成功 获取上传文件信息
        foreach ($_FILES['photo']['name'] as $key=>$value){
            $file1=array();
            $file1["photo"]['name']=$value;
            $file1["photo"]['type']=$_FILES['photo']["type"][$key];
            $file1["photo"]['tmp_name']=$_FILES['photo']["tmp_name"][$key];
            $file1["photo"]['error']=$_FILES['photo']["error"][$key];
            $file1["photo"]['size']=$_FILES['photo']["size"][$key];
            foreach ($info as $key=>$value)
               {
                 $a.="#".$value['savepath'].$value['savename'];//我用符号把图片路径拼起来
               }
             }
         $data["intro_pic"]=substr($a,1);
         $imgurl = $data["intro_pic"];
      }
      //开始数据插入
      if (false === $supplier->create()) {
          $this->error($supplier->getError());
      }
      $supplier->img=$imgurl;
      $supplier->update_time=get_date();
      $list=$supplier->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $supplier_detail=$supplier->where('id='.$id)->find();
      $photo=explode('#',$supplier_detail['img']);
      $this->assign('photo',$photo);
      $this->assign('supplier_detail',$supplier_detail);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $supplier=M('supplier');
    $id=I('id');
    $delete=$supplier->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
