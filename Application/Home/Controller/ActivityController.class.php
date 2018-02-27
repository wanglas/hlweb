<?php
// +----------------------------------------------------------------------
// | Function:商品活动控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月8日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class ActivityController extends Controller {
    //活动表和商品表连查
    public function index(){
      $activity=M('activity');
      $goods=M('goods');
      $comment=M('comment');
      $gid=I('gid');  //获取商品id
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
      //获取评论列表
      $c_map['gid']=$gid;
      $c_map['status']=1;
      $comment_list=$comment->where($c_map)->select();
      //浏览量加1
      $goods->where('id='.$gid)->setInc('view_num',1);
      $list=$goods->field('wx_activity.status as a_status,wx_activity.id as a_id,wx_activity.img as a_img,wx_activity.*,wx_goods.*')->join('wx_activity on wx_goods.id=wx_activity.gid','left')->where('wx_goods.id='.$gid)->find();
      $list['now_price']=$list['discount']*$list['price'];

      //缓存折扣后面价格
      $now_price[0]=$gid;
      $now_price[1]=$list['now_price'];
      session('now_price',$now_price);
      //转换输出（商品详细介绍页面）
      $str=changeContent($list['content']);
      $this->assign('str',$str);
      $this->assign('name',$name);
      $this->assign('list',$list);
      $this->assign('comment_list',$comment_list);
      $this->assign('is_collect',$is_collect);
	    $this->display();
    }
}
