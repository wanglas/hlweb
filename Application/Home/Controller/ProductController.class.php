<?php
// +----------------------------------------------------------------------
// | Function:首页控制器
// +----------------------------------------------------------------------
// | Data: 2018年4月2日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    //首页
    public function index(){
      $part='product';
      $this->assign('name',$part);
	    $this->display();
    }
}
