<?php
//文章控制器
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    // 文章首页
    public function index(){
      $part='news';
      $article=M('article');
      $list=$article->where('status=1')->select();
      $this->assign('list',$list);
      $this->assign('name',$part);
	    $this->display();
    }
    // 文章首页
    public function detail(){
      $article=M('article');
      $id=I('id');
      $detail=$article->where('id='.$id)->find();
      $str=changeContent($detail['content']);
      $this->assign('detail',$detail);
      $this->assign('str',$str);
      $this->display();
    }
}
