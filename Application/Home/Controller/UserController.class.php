<?php
// +----------------------------------------------------------------------
// | Function:用户控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月5日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class UserController extends CommonHomeController {
//基础函数
    //取用户信息函数
    public function user_info(){
      $user=M('user');
      $map['id']=$_SESSION['uid'];
      $map['status']='1';
      $user_info=$user->where($map)->find();
      return $user_info;
    }
    //取用户信息函数
    public function get_nick_name(){
      $personinfo=M('personinfo');
      $map['uid']=$_SESSION['uid'];
      $list=$personinfo->field('uid,nick_name')->where($map)->find();
      if(empty($list)){
        return '未设置昵称';
      }else{
        return $list['nick_name'];
      }
    }
    //获取订单信息(输入表名)
  public function order_info($table){
    $user_info=$this->user_info();
    $map['user_id']=$user_info['id'];
    $order_info=M($table)->where($map)->order('create_time DESC')->select();
    return $order_info;
    }
  //上传头像
  public function upload(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =      'user/'; // 设置附件上传（子）目录
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
    $data['img']=$imgurl;
    $user=M('user');
    $map['id']=$_SESSION['uid'];
    $user->where($map)->save($data);
    $this->redirect('User/index');
  }

  //用户主页面
  public function index(){
    $user_info=$this->user_info();
    $nick_name=$this->get_nick_name();
    $this->assign('nick_name',$nick_name);
    $this->assign('user_info',$user_info);
    $this->display();
  }

  //个人信息编辑页面
  public function personinfo(){
    $personinfo=M('personinfo');
    if(empty(IS_POST)){
      $user_id=session('uid');
      $info=$personinfo->where('uid='.$user_id)->find();
      if(empty($info)){
        $this->display();
      }else{
        $this->assign('info',$info);
        $this->display();
      }
    }else{
      $user_id=session('uid');
      $info=$personinfo->where('uid='.$user_id)->find();
      if(empty($info)){
        if($personinfo->create()){
          $personinfo->create_time=get_date();
          $personinfo->status='1';
          $personinfo->uid=session('uid');
          $personinfo->add();
          $this->redirect('User/personinfo');
        }else {
          $this->error('出错了，请重试');
        }
      }else{
        if($personinfo->create()){
          $personinfo->update_time=get_date();
          $personinfo->status='2';
          $personinfo->where('uid='.$user_id)->save();
          $this->redirect('User/personinfo');
        }else {
          $this->error('出错了，请重试');
        }
      }
    }
  }
  //密码管理
  public function pwd_list(){
    $this->display();
  }
  // 设置登录密码
  public function add_pwd(){
    if(IS_POST){
      $data['user_pwd']=md5(I('post.user_pwd'));
      $user_info=$this->user_info();
      $user=M('user')->where('id='.$user_info['id'])->save($data);
      $this->success('设置成功');
    }
    $this->display();
  }
  // 设置提现密码
  public function add_tx_pwd(){
    if(IS_POST){
      $data['user_tx_pwd']=md5(I('post.user_tx_pwd'));
      $user_info=$this->user_info();
      $user=M('user')->where('id='.$user_info['id'])->save($data);
      $this->success('设置成功');
    }
    $this->display();
  }

  //我的收藏  collect表   status 1代表收藏  0代表未收藏
  public function collect(){
      $collect=M('collect');
      $uid=session('uid');
      $list=$collect->field('wx_collect.status as c_status,wx_collect.create_time as c_ctime,wx_collect.id as c_id,wx_collect.*,wx_goods.*')->join('wx_goods on wx_collect.gid=wx_goods.id','left')->where('wx_collect.status=1 and wx_collect.uid='.$uid)->order('c_ctime DESC')->select();
      $this->assign('list',$list);
      $this->display();
  }

  //我的地址    初始status都是1    -1带表删除
  public function address(){
      $user_address=M('user_address');
      $uid=session('uid');
      $map['uid']=$uid;
      $map['status']=1;
      $list=$user_address->where($map)->select();
      $this->assign('list',$list);
      $this->display();
  }
  // 添加地址
  public function address_add(){
    if(empty(IS_POST)){
      $this->display();
    }else{
      $user_address=M('user_address');
      if($user_address->create()){
        $user_address->create_time=get_date();
        $user_address->uid=session('uid');
        $user_address->status=1;
        $user_address->add();
        $this->success('操作成功');
      }else{
        $this->error('服务器出错');
      }
    }
  }
  // 编辑地址
  public function address_edit(){
    $user_address=M('user_address');
    $id=I('id');
    if(empty(IS_POST)){
      $map['id']=$id;
      $list=$user_address->where($map)->find();
      $this->assign('list',$list);
      $this->display();
    }else{
      $user_address->create();
      $user_address->update_time=get_date();
      $user_address->save();
      $this->success('操作成功');
    }
  }
  //删除地址
  public function address_del(){
    $user_address=M('user_address');
    $id=I('post.id');
    $map['id']=$id;
    if($user_address->where($map)->setField('status','-1')){
      echo '删除成功!';
    }else{
      echo '操作失败，请重试！';
    }
  }
  //反馈意见
  public function suggest(){
    if(empty(IS_POST)){
      $this->display();
    }else{
      $suggest=M('suggest');
      if($suggest->create()){
        $suggest->create_time=get_date();
        $suggest->uid=session('uid');
        $suggest->status=1;
        $suggest->add();
        $this->success('操作成功');
      }else{
        $this->error('服务器出错');
      }
    }
  }
  //订单中心
  public function ordercenter(){
    //订单
    $order_goods=M('order_goods');
    $uid=session('uid');
    $list=$order_goods->where('user_id='.$uid)->order('create_time desc')->select();
    $this->assign('list',$list);
    $this->display();
   }
  //退出
  public function quit(){
     session(null);
     $this->success('退出成功！');
     $this->redirect('Index/index');
  }

  //用户钱包
  public function pocket(){
     $user_info=$this->user_info();
     $this->assign('user_info',$user_info);
     $this->display();
  }
  // 用户论坛
  public function my_comment(){
     $user_info=$this->user_info();
     $this->assign('user_info',$user_info);
     $this->display();
  }
  // 账户管理
  public function account(){
     $user_info=$this->user_info();
     $this->assign('user_info',$user_info);
     $this->display();
  }
  // 设置用户昵称
  public function set_name(){
    if(IS_POST){
     $user_info=$this->user_info();
     $data['user_name']=I('post.user_name');
     $user=M('user')->where('id='.$user_info['id'])->save($data);
     $this->redirect('User/account');
   }else{
     $this->display();
   }
  }
  // 设置用户实名认证
  public function identify(){
    if(IS_POST){
      $user=M('user');
      if($user->create()){
        //获取用户信息
        $user_info=$this->user_info();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath  =      'identify/'; // 设置附件上传目录
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
        $user->photo=$data["intro_pic"];
        $user->where('id='.$user_info['id'])->save();
        $user->where('id='.$user_info['id'])->setField('is_certificate','1');
        $this->redirect('User/account');
      }else{
        echo '出错了';
      }
   }
   $this->display();
  }
  //我的论坛控制方法
  //用户发表的话题
  public function my_words(){
    $comment=M('comment');
    // ->where('comment.status=1')->order('create_time DESC')
    //注意这里面进行了重命名
    $tel=session('tel');
    $list=$comment->Field('wx_comment.id as cid,wx_comment.create_time as c_time,wx_comment.img as cimg,wx_comment.*,wx_user.*')->join('wx_user on wx_comment.uid=wx_user.id','left')->where('wx_user.user_tel='.$tel)->order('c_time DESC')->select();
    foreach ($list as $key => $value) {
        $v=explode('#',$value['cimg']);
        $list[$key]['cimg']=$v;      //重写字段
    }
    $this->assign('list',$list);
    $this->display();
  }
  //查看详细页
  public function show_detail(){
      $comment=M('comment');
      // 获取id
      $id=I('get.id');
      $father=get_one_info('comment',$id);
      $father['img']=explode('#',$father['img']);
      $user=get_one_info('user',$father['uid']);
      // $father=$comment->Field('wx_comment.id as cid,wx_comment.create_time as c_time,wx_comment.*,wx_user.*')->join('wx_user on wx_comment.uid=wx_user.id','left')->where('wx_comment.cid='.$id)->find();
      $child=$comment->Field('wx_comment.id as cid,wx_comment.create_time as c_time,wx_comment.img as cimg,wx_comment.*,wx_user.*')->join('wx_user on wx_comment.uid=wx_user.id','left')->where('wx_comment.pid='.$id)->order('c_time DESC')->select();//该条信息下的评论。
      foreach ($child as $key => $value) {
          $v=explode('#',$value['cimg']);
          $child[$key]['cimg']=$v;      //重写字段
      }
      $this->assign('father',$father);
      $this->assign('user',$user);
      $this->assign('child',$child);
      $this->display();
  }
  //二级回复
  public function my_second(){
    $data2['pid']=I('get.id');
    session('pid',$data2['pid']);
    if(empty(IS_POST)){
      $this->display();
    }else{
      $comment=M('comment');
      $user_info=R('User/user_info');
      $data2['content']=I('post.content');

      if(empty($data2['content'])){
        $this->redirect('User/index');
      }else{
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath  =      'comment/'; // 设置附件上传目录
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
                 $a.="#"."/yikuai/Uploads/".$value['savepath'].$value['savename'];//我用符号把图片路径拼起来
               }
             }

         $data["intro_pic"]=substr($a,1);
         $info1   =  $upload->upload();
         foreach ($info1 as $key=>$value)
         {
          $data["$key"]=$value['savepath'].$value['savename'];
         }
         $imgurl = $data["intro_pic"];
         $data2['img']=$imgurl;
         $data2['uid']=$user_info['id'];
         $data2['uname']=$user_info['user_name'];
         $data2['pid']=session('pid');
         $data2['create_time']=time();
         $data2['status']='1';
         M('comment')->add($data2);
         $comment->where('id='.$data2['pid'])->setInc('pl_num',1);
         $this->redirect('User/show_detail',array('id'=>$data2['pid']));
      }
  }
}
}
?>
