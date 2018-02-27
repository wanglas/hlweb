<?php
namespace Admin\Controller;
use Think\Controller;
class IphoneController extends CommonAdminController {
//首页列表加载
    public function index(){
      $iphone=M('iphone');
      $count=$iphone->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      if(IS_POST){
        $name=I('post.name');
        $map['user_name']=array('like','%'.$name.'%');
        $list=$iphone->where($map)->select();
      }else{
        $list=$iphone->where(1)->limit($Page->firstRow.','.$Page->listRows)->select();
      }
      $this->assign('list',$list);
      $this->assign('page',$show);
      $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $iphone=M('iphone');

        // $upload = new \Think\Upload();// 实例化上传类
        // $upload->maxSize   =     3145728 ;// 设置附件上传大小
        // $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        // $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        // $upload->savePath  =      'iphone/'; // 设置附件上传（子）目录
        // // 上传文件
        // $info   =   $upload->upload();
        // if(!$info) {// 上传错误提示错误信息
        //     $this->error($upload->getError());
        // }else{// 上传成功 获取上传文件信息
        //     foreach($info as $file){
        //         echo $file['savepath'].$file['savename'];
        //     }
        // }
        // $imgurl =$file['savepath'].$file['savename'];
        if (false === $iphone->create()) {
            $this->error($iphone->getError());
        }
        //插入数据
        // $iphone->img=$imgurl;
        //获取的人员id和设备分类id
        $uid=I('post.user_id');
        $eqc_id=I('post.c_iphone_id');
        $eqc_name=get_eqc_name($eqc_id);
        //根据人员id获取对应信息
        $user_info=get_one_user($uid);
        $iphone->c_iphone=$eqc_name;
        $iphone->user_name=$user_info['user_name'];
        $iphone->dept_id=$user_info['cid'];
        $iphone->dept_name=$user_info['c_name'];
        $iphone->create_time=time();
        $iphone->update_time=time();
        $list=$iphone->add();
        if($list==false){
            $this->error(L('ADD_ERROR'));
        }else(
          $this->success(L('ADD_SUCCESS'))
        );
      }else{
        $eqcate_list=get_table_list('eqcate');
        $user_list=get_user('1');
        $this->assign('user_list',$user_list);
        $this->assign('eqcate_list',$eqcate_list);
        $this->display();
      }
    }
//编辑
  public function edit(){
    $iphone=D('iphone');
    $cate=D('cate');
    if(IS_POST){
      if (false === $iphone->create()) {
          $this->error($iphone->getError());
      }
      //更新数据
      $iphone->update_time=time();
      $list=$iphone->save();
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $ipid=I('id');
      $ip_info=get_one_info('iphone',$ipid);
      $eqcate_list=get_table_list('eqcate');
      $user_list=get_user('1');
      $this->assign('ip_info',$ip_info);
      $this->assign('user_list',$user_list);
      $this->assign('eqcate_list',$eqcate_list);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $iphone=D('iphone');
    $id=I('id');
    $delete=$iphone->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
  //打印
  public function print_xls(){
    $iphone=M('iphone');
    $list=$iphone->field('number,c_iphone,dept_name,user_name,mac,phone_num,buy_date')->where(1)->select();
    $arr=array('设备编号','电话型号','使用部门','使用人','MAC参数','分机号','购买时间');
    array_unshift($list,$arr);
    create_xls($list);
  }
}
