<?php
// +----------------------------------------------------------------------
// | Function:产品控制器
// +----------------------------------------------------------------------
// | Data: 2018年4月10日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    //产品列表页面
    public function index(){
      $part='product';
      $goods=M('goods');
      $cate=M('cate');
      //产品列表
      $map['status']='1';
      $bid=I('bid');
      if(empty($bid)){
        $list=$goods->Field('wx_goods.id as gid,wx_goods.name as gname,wx_cate.name as cname,wx_goods.*,wx_cate.*')->join('wx_cate on wx_goods.bid=wx_cate.id','left')->where('wx_goods.status=1')->select();
        // $list=$comment->Field('wx_comment.id as cid,wx_comment.create_time as c_time,wx_comment.*,wx_user.*')->join('wx_user on wx_comment.uid=wx_user.id','left')->where('wx_comment.status=1')->order('c_time DESC')->select();
      }else{
        $list=$goods->Field('wx_goods.id as gid,wx_goods.name as gname,wx_cate.name as cname,wx_goods.*,wx_cate.*')->join('wx_cate on wx_goods.bid=wx_cate.id','left')->where('wx_goods.status=1 && wx_goods.bid='.$bid)->select();
      }
      $this->assign('list',$list);
      // 产品分类
      $cate=$cate->where('status=1')->select();
      $this->assign('cate',$cate);
      $this->assign('name',$part);
	    $this->display();
    }
    public function detail(){
      $part='product';
      $goods=M('goods');
      $id=I('id');
      $map['id']=$id;
      $map['status']=1;
      $detail=$goods->where($map)->find();
      $str=changeContent($detail['content']);
      $this->assign('detail',$detail);
      $this->assign('str',$str);
      $this->assign('name',$part);
      $this->display();
    }
}
