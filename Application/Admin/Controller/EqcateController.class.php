<?php
namespace Admin\Controller;
use Think\Controller;
class eqcateController extends CommonAdminController {
//首页列表加载
    public function index(){
      $eqcate=M("eqcate");
      $count=$eqcate->where(1)->count();
      $Page=new \Think\Page($count,25);
      $show=$Page->show();
      $list=$eqcate->where(1)->limit($Page->firstRow.','.$Page->listRows)->select();
      $this->assign('list',$list);
      $this->assign('page',$show);
	    $this->display();
    }
//添加
    public function add(){
      if(IS_POST){
        $eqcate = M("eqcate"); // 实例化eqcate对象
        if($eqcate->create()){
            $result = $eqcate->add();
            if($result){
                $this->success(L('ADD_SUCCESS'));
            }else{
              $this->error(L('ADD_ERROR'));
            }
        }
      }else{
        $list=get_table_list('eqcate');
        $this->assign('list',$list);
        $this->display();
      }
    }
//编辑
  public function edit(){
    $eqcate=D("eqcate");
    if(IS_POST){
      $data['id']=I('post.id');
      $data['name']=I('post.name');
      if (false === $eqcate->create()) {
          $this->error($eqcate->getError());
      }
      $list=$eqcate->save($data);
      if($list==false){
          $this->error(L('EDIT_ERROR'));
      }else(
        $this->success(L('EDIT_SUCCESS'))
      );
    }else{
      $id=I('id');
      $pinpai=$eqcate->where('id='.$id)->find();
      $list=get_table_list('eqcate');
      $this->assign('list',$list);
      $this->assign('pinpai',$pinpai);
      $this->display();
    }
  }
  //删除
  public function delete(){
    $eqcate=M("eqcate");
    $id=I('id');
    $delete=$eqcate->where('id='.$id)->delete();
    if($delete==false){
        $this->error(L('REMOVE_ERROR'));
    }else(
      $this->success(L('REMOVE_SUCCESS'))
    );
  }
}
