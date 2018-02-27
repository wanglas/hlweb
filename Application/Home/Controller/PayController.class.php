<?php
// 维修控制器
namespace Home\Controller;
use Think\Controller;
class PayController extends Controller {

  /**
  * 支付测试
  * 微信访问:http://daoshi.sdxiaochengxu.com/payment.php/WexinApi/WeixinPay/pay
  */
  public $appid = 'wx70c0d53da4514c17';

  public $appsecret = '394d708e06a3c2b704bdfc6e0dc5be06';

  public $key = '394d708e06a3c2b704bdfc6e0dc5be06';

  public $mch_id = '1488894512';

  function wxpay(){
		// alert($_REQUEST['money']);die;
		// $data= M('order')->where('order_id='.$_POST['id'])->find();
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
		$arr = array(
			'appid' => $this->appid,
			'mch_id' => $this->mch_id,
			'nonce_str' => $this->getNonceStr(),
			'body' =>'红包充值',
			'out_trade_no' => date('Y-m-d H:i:s',time).mt_rand(0000,9999),
			'total_fee' => $_REQUEST['money'] * 100,
			// 'total_fee' => 1,
			'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],
			'notify_url' => 'http://syykx-sj.com/index.php/home/Pay/weixin/',
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
			$money = $postObj->total_fee;
			$money = (iconv("gbk", "UTF-8", $money))/100;
			$data['money'] = $money;
			$openid = $postObj->openid;
			$openid = iconv("gbk", "UTF-8", $openid);
			$data['openid'] = $openid;
			$transaction_id = $postObj->transaction_id;
			$transaction_id = iconv("gbk", "UTF-8", $transaction_id);
			$data['orderid'] = $transaction_id;
			$user = M('user')->where('openid = "'.$openid.'"')->find();
			$data['uid'] = $user['id'];
			$data['time'] = date('Y-m-d H:i:s',time());
			$where['orderid'] = $transaction_id;
			$list = M('newdata') ->where($where)->select();
			if($list){
			}else{
			$result = M('newdata') -> add($data);
			$list = M('yongjin')->select();
			//佣金提成
			$firstuser = M('user')->where('id='.$user['tid'])->find();
			if($firstuser){
				M('user')->where('id='.$user['tid'])->setInc('allmoney',($money*$list[0]['first'])/100);
				$info[0]['uid'] = $user['tid'];
				$info[0]['type'] = 1;
				$info[0]['money'] = ($money*$list[0]['first'])/100;
				$info[0]['time'] =  date('Y-m-d H:i:s',time());
				$seconduser = M('user')->where('id='.$firstuser['tid'])->find();
					if($seconduser){
						M('user')->where('id='.$firstuser['tid'])->setInc('allmoney',($money*$list[0]['second'])/100);
						$info[1]['uid'] = $firstuser['tid'];
						$info[1]['type'] = 1;
						$info[1]['money'] = ($money*$list[0]['second'])/100;
						$info[1]['time'] =  date('Y-m-d H:i:s',time());
						$threeuser = M('user')->where('id='.$seconduser['tid'])->find();
							if($threeuser){
								M('user')->where('id='.$seconduser['tid'])->setInc('allmoney',($money*$list[0]['three'])/100);
								$info[2]['uid'] = $seconduser['tid'];
								$info[2]['type'] = 1;
								$info[2]['money'] = ($money*$list[0]['three'])/100;
								$info[2]['time'] =  date('Y-m-d H:i:s',time());
					}
				}
			}
			foreach ($info as $k => $v){
				M('moneylist')->add($v);
			}
		}
	}
	die('<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>');
	}

  //微信授权
	public function access_token(){
		$tid = $_REQUEST['tid'];
    	$code = $_REQUEST['code'];
    	$res = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx70c0d53da4514c17&secret=394d708e06a3c2b704bdfc6e0dc5be06&code=".$code."&grant_type=authorization_code");
    	$list = json_decode($res);
    	$access_token = $list->access_token;
    	$openid = $list->openid;
    	$row = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
    	$arr = json_decode($row);

    	if ($arr->openid) {
    		$data['username'] = base64_encode($arr->nickname);
	    	$data['headimage'] = $arr->headimgurl;
	    	$data['openid'] = $arr->openid;
	    	$data['tid'] = $tid;


			$id = M('user')->where("openid='".$data['openid']."'")->getField('id');
			if(!$id){
				$id = M('user')->add($data);
			}
	    	$_SESSION['user_id'] = $id;
			$_SESSION['openid'] = $data['openid'];
			if($_SESSION['user_id']){
				$this->redirect('Home/index/index');
			}

    	}


    }
  public function pay(){
      $id= I('get.id');
      $order_info=get_order_info('repair_order','$id');
      $order_sn=$order_info['sn'];
      $openId = '';
      $jsApiParameters = wxpay($openId,'江南极客',$order_sn,1);
      print_r($jsApiParameters);
      exit;
      $this->assign(array(
          'data' => $jsApiParameters
      ));
      $this->display();
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
