<?php
//论坛模块控制器
namespace  Home\Controller;
use Think\Controller;
class CommentController extends Controller{
  // 评论首页
  public function index(){
    $id=$_REQUEST['id'];    //这是订单拆分完order_goods 的id
    $gid=$_REQUEST['gid'];  //商品id
    $uid=session('uid');
    if(IS_POST){
      $comment=M('comment');
      $order_goods=M('order_goods');
      // 先判断是否已经评论
      $is_comment=$order_goods->where('id='.$id)->find();
      if($is_comment['is_comment']==1){
        $this->redirect('User/ordercenter');
      }
      $userinfo=get_user_info($uid);
      $comment->create();
      $comment->create_time=time();
      $comment->uid=$uid;
      $comment->uname=R('User/get_nick_name');
      $comment->user_img=$userinfo['img'];
      $comment->status=1;
      $comment->add();
      $order_goods->where('id='.$id)->setField('is_comment','1');
      $this->redirect('User/ordercenter');
    }else {
      $ginfo=get_good_info($gid);
      $this->assign('gid',$gid);
      $this->assign('id',$id);
      $this->assign('ginfo',$ginfo);
      $this->display();
    }
  }
  //二级平论
  public function second(){
    $data2['pid']=I('get.id');
    session('pid',$data2['pid']);
    if(empty(IS_POST)){
      $this->display();
    }else{
      $comment=M('comment');
      $user_info=R('User/user_info');
      $data2['content']=I('post.content');

      if(empty($data2['content'])){
        $this->redirect('Comment/index');
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
         $this->redirect('Comment/show_detail',array('id'=>$data2['pid']));
      }
  }
}
  //评论详情页面
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
  //发表评论页面
  public function say(){
    if(empty(IS_POST)){
      $this->display();
    }else{
      $user_info=R('User/user_info');
      $data2['content']=I('post.content');
      if(empty($data2['content'])){
        $this->redirect('Comment/say');
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
         $data2['content']=I('post.content');
         $data2['img']=$imgurl;
         $data2['uid']=$user_info['id'];
         $data2['uname']=$user_info['user_name'];
         $data2['create_time']=time();
         $data2['status']='1';
         M('comment')->add($data2);
         $this->redirect('Comment/index');
      }

    }
  }
  //点赞
  public function dz(){
    $comment=M('comment');
    $id=I('post.cid');
    $map['id']=$id;
    $comment->where($map)->setInc('dz_num',1);
    $dz_num=$comment->where($map)->find();
    $dz_num=$dz_num['dz_num'];
    echo $dz_num;
  }


}
?>
