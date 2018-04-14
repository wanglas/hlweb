<?php
// +----------------------------------------------------------------------
//   后台基础控制器
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {
  public function _empty()
  {
      echo "<script>location.href='/404.html'</script>";
      die;
  }
}
