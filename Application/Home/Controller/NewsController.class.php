<?php
//文章控制器
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    //定义模块常量
    public static $part='news';
    // 文章首页
    public function index(){
      $part=self::$part;
      // 时间轴新闻列表
      $article=M('article');
      $now_year=date("Y");
      $length=$now_year-2018;
      if($length==0){
        $list=$article->where('status=1 && year=2018')->order('create_time DESC')->select();
        $arr[0][year]='2018';
        $arr[0][article]=$list;
      }else{
        for($length;$length>=0;$length--){
          $year=$now_year-$length;
          $list=$article->where('status=1 && year='.$year)->order('create_time DESC')->select();
          $arr[$length][year]=$year;
          $arr[$length][article]=$list;
        }
        $arr=array_reverse($arr);
      }
      // 重要新闻部分
      $imp_list=$article->where('status=1 & is_imp=1')->select();
      $imp_length=count($imp_list);
      if($imp_length<4){
        $imp_status=0;
      }
      // print_r($arr);
      // exit;
      $this->assign('arr',$arr);
      $this->assign('imp_list',$imp_list);
      $this->assign('imp_status',$imp_status);
      $this->assign('name',$part);
	    $this->display();
    }
    // 文章首页
    public function detail(){
      $part=self::$part;
      $article=M('article');
      $id=I('id');
      $map['id']=$id;
      $detail=$article->where($map)->find();
      $str=changeContent($detail['content']);
      // 重要新闻部分
      $imp_list=$article->where('status=1 & is_imp=1')->select();
      $imp_length=count($imp_list);
      if($imp_length<4){
        $imp_status=0;
      }
      $this->assign('imp_list',$imp_list);
      $this->assign('imp_status',$imp_status);
      $this->assign('detail',$detail);
      $this->assign('str',$str);
      $this->assign('name',$part);
      $this->display();
    }
}
