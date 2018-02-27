<?php
// 维修控制器
namespace Home\Controller;
use Think\Controller;
class RepairController extends Controller {
  //维修列表页面
    public function index(){
      $brand=M('brand');
      $goods=M('goods');
      $left_list=$brand->where('status=1')->select();
      $qid=I('get.qid');
      if(!empty(I('get.qid'))){
        //从首页点过来，开启session，后面保持记录
        session('qid',$qid);
      }
      $qname=get_name(goodsrepair,session('qid'));
      if(empty(I('get.bid'))){
        $bid=1;
        $map['status']=1;
        $map['is_repair']=1;
        $map['bid']=$bid;
        $right_list=$goods->where($map)->select();
      }else{
        $bid=I('get.bid');
        $map['status']=1;
        $map['is_repair']=1;
        $map['bid']=$bid;
        $right_list=$goods->where($map)->select();   //后期这里可以在前端用js传参（默认取第一个的值）
      }
      $this->assign('bid',$bid);
      $this->assign('qname',$qname);
      $this->assign('left_list',$left_list);
      $this->assign('right_list',$right_list);
      $this->display();
    }
    //维修订单页面
    public function order(){
      if(IS_POST){

      }else{
      $repairprice=M('repairprice');
      $gid=I('get.gid');
      $phone=phone_info($gid);
      $qname=get_name(goodsrepair,session('qid'));
      //按照维修大类取下面子分类
      $map['status']=1;
      $map['pqid']=session('qid');
      $map['gid']=$gid;
      $qlist=$repairprice->where($map)->select();
      $this->assign('qlist',$qlist);   //故障子类别
      $this->assign('qname',$qname);   //故障父类别
      $this->assign('phone',$phone);   //所选择手机信息
      $this->display();
    }
}
    //维修订单处理   1,未支付；2，已支付：6，已取消。
    public function repairorder(){
      $gid=I('post.gid');
      $phone=phone_info($gid);
      $user_info=R('User/user_info');
      //开始向回收订单中插入数据，初始订单状态为1(待填写订单)
      $data['gid']=$gid;
      $data['user_id']=$user_info['id'];
      $data['gname']=$phone['name'];
      $data['img']=$phone['img'];
      $data['sn']=repair_sn();
      $data['service_address']=I('post.service_address');
      $data['province']=I('post.province');
      $data['city']=I('post.city');
      $data['area']=I('post.area');
      $data['service_time']=I('post.service_time');
      $data['qid']=I('post.qid');
      $qinfo=get_repaiprice_info($data['qid']);
      $data['qname']=$qinfo['qname'];
      $data['price']=$qinfo['repair_price'];
      $data['remark']=I('post.remark');
      $data['tel']=I('post.tel');
      $data['create_time']=time();
      $data['status']=1;
      $repairorder=M('repairorder')->add($data);
      $this->redirect('Pay/repairpay');
    }
    //取消交易
    public function cancel(){
      $id=I('get.id');
      $recover=M('repairorder')->where('id='.$id)->setField('status',6);
      $this->redirect('User/ordercenter');
    }
    //维修订单详细页
    public function detail(){
      $oid=I('get.id');
      $order=get_order_info(repairorder,$oid);
      $this->assign('order',$order);
      $this->display();
    }
}
