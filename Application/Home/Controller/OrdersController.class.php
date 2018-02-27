<?php
// +----------------------------------------------------------------------
// | Function:订单控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月18日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class OrdersController extends Controller {
  //支付配置
  public $appid = 'wxb16047f8b5dcb2ac';

  public $appsecret = '65e591bb9a853f944f021fa7bf2a7c45';

  public $key = '123asd34214eqwed124bq2123ih12sd8';

  public $mch_id = '1489493402';

    //buy_now 下立即生成订单
    public function build_order(){
      if (IS_POST) {
        $orders=M('orders');
        $order_goods=M('order_goods');
        //获取表单信息
        $gid=I('post.gid');
        $aid=I('post.aid');
        $num=I('post.num');
        $ginfo=get_good_info($gid);
        //核对是否活动商品
        $now_price=session('now_price');
        if($gid==$now_price[0]){
          $ginfo['price']=$now_price[1];
        }
        $total=$num*$ginfo['price'];
        $order_sn=order_sn();
        //向orders表中填入信息
        $orders->create();
        $orders->order_sn=$order_sn;
        $orders->uid=session('uid');
        $orders->aid=$aid;
        $orders->total=$total;
        $orders->addtime=time();
        $orders->add();

        //获取刚生成的订单
        $sninfo=get_sn_info($order_sn);
        $ainfo=get_address_info($aid);
        //订单中具体包含的商品
        $order_goods->create();
        $order_goods->oid=$sninfo['id'];
        $order_goods->order_sn=$order_sn;
        $order_goods->address=$ainfo['location'];
        $order_goods->address_detail=$ainfo['detail'];
        $order_goods->realname=$ainfo['name'];
        $order_goods->tel=$ainfo['tel'];
        $order_goods->pay_status=0;     //0 未付款   1付款中  2 已付款
        $order_goods->order_status=0;   //0  未确认   1确认  2   已取消  3 无效  4退款
        $order_goods->shipping_status=0;    ///0未发货   1 已发货  2 已收货  4 退货
        $order_goods->goods_name=$ginfo['name'];
        $order_goods->goods_number=$num;
        $order_goods->goods_id=$ginfo['id'];
        $order_goods->goods_price=$ginfo['price'];
        $order_goods->goods_sale_way_name=$ginfo['sale_way_name'];
        $order_goods->order_money=$total;
        $order_goods->user_id=session('uid');
        $order_goods->is_comment=0;
        $order_goods->image_path=$ginfo['img'];
        $order_goods->create_time=time();
        $order_goods->add();
        $this->redirect('User/ordercenter');
      }
      $this->redirect('Goods/buy_now');
    }
    //cart_buy_now 购物车立即生成订单
    public function cart_build_order(){
      if (IS_POST) {
        $orders=M('orders');
        $order_goods=M('order_goods');
        //获取表单信息
        $selgoods=session('selGoods');
        $total=session('total');
        $aid=I('post.aid');   //地址信息
        $order_sn=order_sn();
        //向orders表中填入信息
        $orders->create();
        $orders->order_sn=$order_sn;
        $orders->uid=session('uid');
        $orders->aid=$aid;
        $orders->total=$total;
        $orders->addtime=time();
        $orders->add();
        //获取刚生成的订单
        $sninfo=get_sn_info($order_sn);
        $ainfo=get_address_info($aid);
        //获取结算订单商品
        //订单中具体包含的商品
        foreach ($selgoods as $key => $val ){
          $order_goods->create();
          $order_goods->oid=$sninfo['id'];
          $order_goods->order_sn=$order_sn;
          $order_goods->address=$ainfo['location'];
          $order_goods->address_detail=$ainfo['detail'];
          $order_goods->realname=$ainfo['name'];
          $order_goods->tel=$ainfo['tel'];
          $order_goods->pay_status=0;     //0 未付款   1付款中  2 已付款
          $order_goods->order_status=0;   //0  未确认   1确认  2   已取消  3 无效  4退款
          $order_goods->shipping_status=0;    ///0未发货   1 已发货  2 已收货  4 退货
          $order_goods->goods_name=$val['name'];
          $order_goods->goods_number=$val['num'];
          $order_goods->goods_id=$val['id'];
          $order_goods->goods_price=$val['price'];
          $order_goods->goods_sale_way_name=$val['goods_info']['sale_way_name'];
          $order_goods->order_money=$val['total'];
          $order_goods->user_id=session('uid');
          $order_goods->is_comment=0;
          $order_goods->image_path=$val['goods_info']['img'];
          $order_goods->create_time=time();
          $order_goods->add();
        }
        $this->redirect('User/ordercenter');
      }
      $this->redirect('Goods/buy_now');
    }
  //查看订单详情页面
  public function detail(){
    $id=I('get.id');
    $order_goods=M('order_goods');
    $detail=$order_goods->where('id='.$id)->find();
    $this->assign('detail',$detail);
    $this->display();
  }
  //订单状态修改函数
      //取消订单
      public function cancel(){
        $id=I('get.id');
        $order=get_order_info(recoverorder,$id);           //获取回收订单信息
        $user=M('user');
        $user_info=R('User/user_info');
        $money=$user_info['user_money_wait']-$order['total_price'];      //获取取消订单后的金额
        $user->where('id='.$order['user_id'])->setField('user_money_wait',$money);
        $recover=M('recoverorder')->where('id='.$id)->setField('status',6);
        $this->redirect('User/ordercenter');
      }
  //微信支付
  function wxpay(){
    $money=I('post.money');
    $id=I('post.id');   //对应订单子订单
    $order_goods=M('order_goods');
    $orderinfo=$order_goods->where('id='.$id)->find();
    $out_trade_no= $orderinfo['create_time'].mt_rand(0000,9999);
    $order_goods->where('id='.$id)->setField('out_trade_no',$out_trade_no);
    // $data= M('order')->where('order_id='.$_POST['id'])->find();
    $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    $arr = array(
      'appid' => $this->appid,
      'mch_id' => $this->mch_id,
      'nonce_str' => $this->getNonceStr(),
      'body' =>$orderinfo['goods_name'],
      'out_trade_no' => $out_trade_no,
      'total_fee' => $money * 100,
      // 'total_fee' => 1,
      'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],
      'notify_url' => 'http://cxjp.xhnxxw.com/index.php/Home/Orders/weixin/',
      // 'notify_url' => 'http://qianghongbao.php024.com/weixin.php/',
      'trade_type' => 'JSAPI',
      'openid' => $_SESSION['openid']
    );
    $arr['sign'] = $this->sign($arr);
    $data = $this->ToXml($arr);
    $result = $this->postData($url,$data);
    $options = array(
      'appId' => $this->appid,
      'timeStamp' => (string)time(),
      'nonceStr' => $this->getNonceStr(),
      'package' => 'prepay_id='.$result['prepay_id'],
      'signType' => 'MD5',
    );
    $options['paySign'] = $this->sign($options);
    die(json_encode($options));
  }
  //支付回调处理
	public function weixin(){
		$postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		if($postObj->return_code == 'SUCCESS'){
      //获取交易金额 ,修改订单状态。
      $money = $postObj->total_fee;
			$money = (iconv("gbk", "UTF-8", $money))/100;
      $out_trade_no= $postObj->out_trade_no;
      $out_trade_no = (iconv("gbk", "UTF-8", $out_trade_no));
      $order_goods=M('order_goods');
      $order_goods->pay_money=$money;
      $order_goods->payment_notify_time=time();
      $order_goods->pay_status='2';
      $map['out_trade_no']=$out_trade_no;
			$order_goods->where($map)->save();
      //商品销售量+1
      $o_soninfo=M('order_goods')->where('out_trade_no='.$out_trade_no)->find();
      M('goods')->where('id='.$o_soninfo['goods_id'])->setInc('sale_num');
	}
	die('<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>');
	}
  //微信授权
	public function access_token(){
		  // $tid = $_REQUEST['tid'];
    	$code = $_REQUEST['code'];
    	$res = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxb16047f8b5dcb2ac&secret=65e591bb9a853f944f021fa7bf2a7c45&code=".$code."&grant_type=authorization_code");
    	$list = json_decode($res);
    	$access_token = $list->access_token;
    	$openid = $list->openid;
    	$row = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
    	$arr = json_decode($row);
    	if ($arr->openid) {
  	    	$data['openid'] = $arr->openid;
          $data['create_time'] =time();
          $data['status']='1';
          $data['img']=$arr->headimgurl;
  	    	// $data['tid'] = $tid;
  			$id = M('user')->where("openid='".$data['openid']."'")->getField('id');
  			if(!$id){
  				$id = M('user')->add($data);
  			}
  	    	$_SESSION['uid'] = $id;
          session('uid',$id);
  			  $_SESSION['openid'] = $data['openid'];
  			if($_SESSION['uid']){
  				$this->redirect('User/index');
  			}
    	}
    }
	//微信官方接口

		function ToXml($arr){
		$xml = '<xml>';
		foreach ($arr as $key => $value){
			if(is_numeric($value)){
				$xml .= '<'.$key.'>'.$value.'</'.$key.'>';
			}else{
				$xml .= '<'.$key.'><![CDATA['.$value.']]></'.$key.'>';
			}
		}
		$xml .= '</xml>';
		return $xml;
	}
	function getNonceStr(){
		$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		for ($i = 0;$i < 32;$i++ ){
			$string .= substr($chars,mt_rand(0,strlen($chars) - 1),1);
		}
		return $string;
	}
	function postData($url,$data){
		$options = array(
			'http' => array(
				'method' => 'POST',
				'content' => $data,
				'timeout' => 15 * 60,
				'header' => 'Content-type:application/xml;encoding=utf-8'
			)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url,false,$context);
		$result = json_decode(json_encode(simplexml_load_string($result,'SimpleXMLElement',LIBXML_NOCDATA)),true);
		return $result;
	}
	function sign($arr){
		ksort($arr);
		$string = '';
		foreach ($arr as $key => $value){
			if($key != 'sign' && $value != '' && !is_array($value)) $string .= $key.'='.$value.'&';
		}
		$string = trim($string,'&');
		$string .= '&key='.$this->key;
		$string = md5($string);
		$string = strtoupper($string);
		return $string;
	}
}
