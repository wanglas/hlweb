<?php
// +----------------------------------------------------------------------
// | Function:商品控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月8日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    // 根据分类获取商品列表(按照销量排序)
    public function index(){
      $goods=M('goods');
      $cid=I('id');
      session('cid',$cid);
      $map['cid']=$cid;
      $map['status']=1;
      $list=$goods->where($map)->order('sale_num desc')->select();
      $name=get_cate_name($cid);
      $this->assign('name',$name);
      $this->assign('list',$list);
	    $this->display();
    }
    // 根据分类获取商品列表（按照人气排序）
    public function index_view(){
      $goods=M('goods');
      $cid=session('cid');
      $map['cid']=$cid;
      $map['status']=1;
      $list=$goods->where($map)->order('view_num desc')->select();
      $name=get_cate_name($cid);
      $this->assign('name',$name);
      $this->assign('list',$list);
      $this->display();
    }
    // 根据分类获取商品列表(按照销量排序)
    public function index_sale(){
      $goods=M('goods');
      if($_SESSION['cid']){
        $cid=session('cid');
      }else{
        $cid=I('id');
        session('cid',$cid);
      }
      $map['cid']=$cid;
      $map['status']=1;
      $list=$goods->where($map)->order('sale_num desc')->select();
      $name=get_cate_name($cid);
      $this->assign('name',$name);
      $this->assign('list',$list);
      $this->display();
    }
    // 根据城市获取商品
    public function index_city(){
      $goods=M('goods');
      $city_id=I('id');
      $map['city_id']=$city_id;
      $list=$goods->where($map)->order('sale_num desc')->select();
      $name=get_city_name($city_id);
      $this->assign('name',$name);
      $this->assign('list',$list);
      $this->display();
    }

    // 商品详细页面
    public function detail(){
      //获取商品详细信息,浏览量加1.
      $goods=M('goods');
      $comment=M('comment');
      $gid=I('gid');   //商品id
      $detail=$goods->where('id='.$gid)->find();
      $c_map['gid']=$gid;
      $c_map['status']=1;
      $comment_list=$comment->where($c_map)->select();
      $goods->where('id='.$gid)->setInc('view_num',1);
      $catename=get_cate_name($detail['cid']);
      // 先判断是否登录，之后判断是否收藏
      if(session('uid')){
        $uid=session('uid');
        $collect=M('collect');
        $map['uid']=$uid;
        $map['gid']=$gid;
        $list=$collect->where($map)->find();
        if($list){
          if($list['status']==1){
            $is_collect=1;
          }else{
            $is_collect=0;
          }
        }else{
          $is_collect=0;
        }

      }else{
        $is_collect=0;
      }
      //转换输出
      $str=changeContent($detail['content']);
      $this->assign('comment_list',$comment_list);
      $this->assign('is_collect',$is_collect);
      $this->assign('catename',$catename);
      $this->assign('detail',$detail);
      $this->assign('str',$str);
      $this->display();
    }
    //立即购买
    public function buy_now(){
      $uid=session('uid');
      if($uid){
        $goods=M('goods');
        $gid=I('id');
        $detail=$goods->where('id='.$gid)->find();
        //比对是否是同一个商品，之后替换价格
        $now_price=session('now_price');
        if($gid==$now_price[0]){
          $detail['price']=$now_price[1];
        }
        $list=get_address_list($uid);
        $this->assign('list',$list);
        $this->assign('detail',$detail);
        $this->display();
      }else{
        $this->error('请在登录后购买！');
      }
    }
    // 商品收藏   1 代表未登录 2代表取消收藏  3 代表 收藏成功
    public function collect_add(){
      if(empty(session('uid'))){
        echo '1';
      }else {
        $collect=M('collect');
        $gid=I('post.gid');
        //先确定是否已收藏
        $map['gid']=$gid;
        $map['uid']=session('uid');
        $data=$collect->where($map)->find();
        if($data){
          if($data['status']==1){
            $collect->where('id='.$data['id'])->setField('status',0);
            echo '2';
          }else{
            $collect->where('id='.$data['id'])->setField('status',1);
            echo '3';
          }
        }else{
          if($collect->create()){
            $collect->gid=$gid;
            $collect->create_time=get_date();
            $collect->uid=session('uid');
            $collect->status=1;
            $collect->add();
            echo '3';
          }else{
            echo '服务器出错，请重试!';
          }
        }
      }
    }
}
