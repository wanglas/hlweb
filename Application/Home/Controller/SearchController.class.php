<?php
// +----------------------------------------------------------------------
// | Function:搜索控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月11日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
    //商品表模糊查询
    public function index(){
	      $this->display();
      }
    //
    public function result(){
      if(IS_POST){
        $goods=M('goods');
        $info=I('post.info');
        $map['name']=array('like','%'.$info.'%');
        $map['status']=1;
        $list=$goods->where($map)->select();
        $this->assign('list',$list);
        $this->display();
      }else{
         $this->redirect('Search/index');
      }
    }
}
