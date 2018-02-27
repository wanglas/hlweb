<?php
namespace Admin\Controller;
use Think\Controller;
class TestController extends CommonAdminController {
    /*
    *缓存测试
    *
    */
    public function cache_test(){
        S('name','wanglas',10);
        $name=S('name');
        $this->assign('name',$name);
        $this->display();
    }
}
