<?php
// +----------------------------------------------------------------------
// | Function:购物车控制器
// +----------------------------------------------------------------------
// | Data: 2017年11月13日
// +----------------------------------------------------------------------
// | Author: wanglas <869184782@qq.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller{

	public static $ordersModel = null;
	public static $orderGoodsModel = null;

	public function _initialize() {
		/* 对用户传入的变量进行转义操作。 */
		if (MAGIC_QUOTES_GPC) {
			if (!empty($_GET)) {
				$_GET = stripslashesDeep($_GET);
			}
			if (!empty($_POST)) {
				$_POST = stripslashesDeep($_POST);
			}
			$_COOKIE = stripslashesDeep($_COOKIE);
			$_REQUEST = stripslashesDeep($_REQUEST);
		}
		if(self::$ordersModel == null){
			self::$ordersModel = M('orders');
		}
		if(self::$orderGoodsModel == null){
			self::$orderGoodsModel = M('order_goods');
		}
	}
	/**
	 * 购物车界面
	 */
	public function index() {
		$uid=session('uid');
		if(!$uid){
			$this->error('请您先登录~');
		}
		import("Org.Util.Cart");
		$gc = M("goods_cart");
		$uid = session('uid');
		$this->assign('shoptype', '1');
		// 如果登陆了，取数据库
		if ($uid) {
				$cart = $gc->where(array('uid' => $uid))->select();
		} else {
				$cart = $_SESSION['cart']['goods'];
		}
		$cart = new \Org\Util\Cart();
		$goods = $cart->getGoods();
		// $goods_str =  file_get_contents('goods.txt');
		// $goods = json_decode($goods_str,1);
		// print_r($goods);die;
		$this->total = $cart->getTotalPrice();
		$this->total_rows = $cart->getTotalNums();
		if (IS_AJAX) {
			if (empty($goods)) {
				$this->ajaxReturn('');
			} else {
				$arr['total'] = $this->total;
				$arr['total_rows'] = $this->total_rows;

				$this->ajaxReturn($arr);
			}
		} else {
			if (empty($goods)) {
				$this->display('index');
			} else {
				foreach($goods  as $k => $v){
					$img=get_img($v['id'],goods);
					$goods[$k]['img']=$img;
				}
				$this->assign('cart', $goods);
				$this->display();
			}
		}
	}

	/**
	 * 添加购物车
	 */
	Public function addCart() {
		$goodsModel=M('goods');
		$uid = session('uid');
		$pid = (int) I("post.pid");
		$num = I("post.num") ? (int) I("post.num") : 1;
			$goods =$goodsModel->where(array('id' => $pid))->find();
			//session数据
			$add['id'] = $pid;
			$add['num'] = $num;
			$add['name'] = $goods['name'];
			$add['price'] = $goods['price'];
			$add['create_time'] =time();
			// $add['options'] = array("cid"=>$cid);
			$cart = new \Org\Util\Cart();
			$result = $cart->add($add);
			if ($result) {

				$total = $cart->getTotalPrice();
				$total_rows = $cart->getTotalNums();
				$this->ajaxReturn(array('status' => 1));
			} else {
				//$this->ajaxReturn(0, 'JSON');
				$this->ajaxReturn(array('status' => 0));
			}
		}

	/**
	 * 删除购物车商品
	 */
	Public function delGoods() {
		$uid = session('uid');
		import("Org.Util.Cart");
		$cart = new \Org\Util\Cart();
		$result = $cart->del($_POST['sid']);
		if ($result) {
			$this->ajaxReturn(array('status' => 1));
		} else {
			$this->ajaxReturn(array('status' => 2));
		}
	}
	/**
	 * ajax 改变数量,更新购物车
	 */
	Public function updateCart() {
		$goodsModel=M('goods');
		import("Org.Util.Cart");
		//$gc = M('goods_cart');
		$uid = session('uid');
		$pid = $_POST['pid']; //商品的id
		//$ssid = $_POST['ssid']; //数据库的id
		$num = (int) $_POST['num'];

		$preg = "/^[1-9]{1,}/";
		if (!preg_match($preg, $num)) {
			$this->ajaxReturn(array('status'=>-1));
		}
		$sid = $_POST['sid']; //sid session的sid
		// $stock = $goodsModel->getStock($pid);
			$sess['sid'] = $sid;
			$sess['num'] = $num;
			$sess['pid'] = $pid;
			$cart = new \Org\Util\Cart();
			$result = $cart->update($sess);

			if ($result) {
				$this->ajaxReturn(array('status'=>1));
			} else {
				$this->ajaxReturn(array('status'=>0));
			}

	}

	/**
	 * 删除单个商品
	 */
	Public function delCart() {
		import("Org.Util.Cart");
		Cart::del($_POST['rec_id']);
		$this->ajaxReturn($data, 'success', 1);
	}
	/**
	 * 删除全部商品
	 */
	Public function emptyCart() {
		import("Org.Util.Cart");
		Cart::delAll();
		$this->ajaxReturn(1, 'success', 1);
	}


	// 订单撤销
	public function orderCancel() {
		$uid = session('uid');
		$orders_sn = I("order_sn");
		$reason = I("reason");//理由
		$OrderGoods = D('OrderGoods');
		$data['pay_status'] = self::$ordersModel->PAY_STATUS_CANCEL;//订单取消
		$data['order_sn'] = $orders_sn;
		$data['user_cancel_flag'] = 1;
		$data['cancel_reason'] = $reason;
		$orderResult = self::$ordersModel->updateOrderInfo($data);
		if ($ordergoodsResult !== false) {
			$this->ajaxReturn(array('status' => 1, 'msg' => 'Your order has been cancelled!',
									'url' => U('Account/order')));
		} else {
			$this->ajaxReturn(array('status' => 0, 'msg' => 'Your order has been cancelled, please try again later!',
									'url' => U('Account/order')));
		}
	}



	/**
	 * 提交订单
	 */
	function address_search() {
		$cityid = $_POST['cityid'];
		$address = $_POST['address'];
		//$order_sn = $_SESSION['order_sn'];
		$model = M("city");
		//$sql = "SELECT c.*,cc.title FROM " . C('DB_PREFIX') . "city c left outer join " . C('DB_PREFIX') . "company cc on c.cid = cc.id where c.cityid=$cityid AND c.address like '%$address%' ";
		//$r = $model->query($sql, false);
		$cid = $_SESSION['dianpu_id'] ? $_SESSION['dianpu_id'] : 1;
		$arrid = $this->getChildId($cityid, 'area');
		$strid = implode(',', $arrid);
		$cidarrlist = $this->getOtherId();
		$strcidlist = implode(',', $cidarrlist);
		$result = $model
				->where(
						"cid IN ($strcidlist) AND cityid IN ($strid) AND `address` like '%$address%'")
				->select();
		if ($result) {
			$this->ajaxReturn($result, 'success', 1);
		} else {
			$this->ajaxReturn("", 'nodata', 0);
		}
	}


	/**
	 * 订单界面
	 */
	Public function order() {
		$goodsModel=M('goods');
		$uid = session('uid');
		if (!$uid) {
			$this->redirect('CommonHome/getOpenId');
			exit();
		}
		import("Org.Util.Cart");
		$cart = new \Org\Util\Cart();
		$goods = $cart->getSelectGoods();
		// file_put_contents('text.txt',$goods);测试是否拿到数据
		if (!$goods) {
			$this->ajaxReturn(array('status'=>0,'msg'=>'no select goods~'));
		}
		$yunfei = $ku = "";
		$glists = '';
		// 总计价格积分
		foreach ($goods as $key => $val) {
			// $freight = $val['freight'];
			//       if($freight){
			//       	$goods_freight = getFreight($freight,$val['total']);
			//       } else{
			//       	$goods_freight = 0 ;
			//       }
			$result[$key] = $val;
			// $result[$key]['goods_freight'] = $goods_freight;
			$goods_info = $goodsModel->where(array("id" => $val['id']))->find();
			$result[$key]['goods_info'] = $goods_info;
			// $yunfei += $goods_freight;
			// $ku += $goods_info['points'];
			$total += $val['price'] * $val['num'];
			$total_rows += $val['num'];
			$glists .= $val['id'] . ',';
		}
		$glists = rtrim($glists, ",");
		if (!$result) {
			$this->ajaxReturn(array('status'=>0,'msg'=>'no confirm goods'));
		}
		// $userAdress = D(C('TB_USER_ADDRESS'));
		// $getAdress = $userAdress->getAdress();
		$this->total = $total;
		$this->total_rows = $total_rows;
		// 收货地址
		// $this->assign('getAdress', $getAdress);
		//支付列表
		// $payment_list = M(C('TB_PAYMENT'))->where("status=1")->order("sort ASC")
		// 		->select();
		// $this->assign('payment_list', $payment_list);
		// $this->assign('yunfei', $yunfei);
		// $this->assign('ku', $ku);
		// $this->assign('data', $data);
		// foreach( $result as
    //
		// 	)
		//把结算订单中商品存储
		session('selGoods',$result);
		session('total',$total);
		//地址列表
		$list=get_address_list($uid);
		$this->assign('list',$list);
		$this->assign('cart', $result);
		$this->assign('total', $total);
		$this->assign('glists', $glists);
		$this->display();
	}

	/*
	 * 成功
	 */

	Public function order_done() {
		import('ORG.Util.String');
		$uid = session('uid');
		$ordersData = "";
		//$pay_status = '960';
		if (!$uid) {
			$this->display("Member/login");
			exit();
		}
		$rechangeMoney = I('rechangeMoney');
		$order_sn = I('get.order_sn');
		$orderId = I('get.oid');
		$tepResult = true;
		$this->assign('shoptype', '3');
		//已经有订单号的情况
		if ($order_sn) {

			// 保存当前支付页面
			session('pay_url', $_SERVER['REQUEST_URI']);
			$data['orders_sn'] = $order_sn;
			$orderInfo = self::$ordersModel->OrderInfo($data);
			//dump($orderInfo);
			$oid = $orderInfo['order_id'];
			$ogid = $orderInfo['ogid_list'];
			$totalAll = $orderInfo['money'];
			$this->assign('payType', $orderInfo['type']);
			$this->assign('order_sn', $order_sn);
			$this->assign('totalAll', $totalAll);
			$this->assign('ogid', $ogid);
			$this->assign('oid', $oid);
			$this->assign('goods_number', $orderInfo['goods_number']);
			//使用余额的情况, doAfter
		} elseif (!empty($rechangeMoney)) {
			if (!is_numeric($rechangeMoney)) {
				$this->error("Please enter a valid number!");
			} else {
				$order_goods = D('OrderGoods');//订单
				//$orders = D('Orders');//
				// 支付
				self::$ordersModel->startTrans();
				// 购物车标识
				$order_sn = getOrderUniqid();
				$or['order_sn'] = $order_sn;
				$payType = 3;//在线充值
				$or['pid'] = $payType;//在线支付
				$or['uid'] = $uid;
				$or['aid'] = $aid;
				$or['cid'] = 0;
				$or['ccid'] = 0;
				$or['scid'] = 0;
				$or['type'] = $payType;
				$or['addtime'] = gmtTime();
				$or['total'] = $rechangeMoney;
				$oid = self::$ordersModel->add($or);

				$order_goods->oid = $oid;
				$order_goods->freight = 0;
				$order_goods->goods_name = 'Online recharge';
				$order_goods->address = $citytext;
				$order_goods->goods_number = 1;
				$order_goods->goods_id = $gid;
				$order_goods->pay_status = self::$ordersModel->PAY_STATUS_UNPAID; //960已下单
				$order_goods->realname = $realname;
				$order_goods->tel = $mobile;
				$order_goods->zipcode = $adressResult['zipcode']; //邮编
				$order_goods->address_detail = $address;
				$order_goods->order_sn = $or['order_sn'];
				$order_goods->create_time = time();
				$order_goods->update_time = time();
				$order_goods->goods_price = $rechangeMoney;
				$order_goods->order_money = $rechangeMoney;
				$order_goods->user_id = $uid;
				$order_goods->image_path = '/Public/picao/images/cz.png';
				//$one_money = $order_goods->goods_number * $order_goods->goods_price;
				$order_goods->type = $payType;
				$goods_name .= $order_goods->goods_name . "\n";
				$goods_name .= '  ' . $order_goods->goods_number . '' . '×'
						. $order_goods->goods_price . '        '
						. vip_price($goodsData['price']) * $v['num'] . "\n";
				$order_goods->remark = $goods_name;
				$add_result = $order_goods->add();

				$this->assign('order_sn', $order_sn);
				$this->assign('totalAll', $rechangeMoney);
				$this->assign('payType', $payType);
				$this->assign('ogid', $add_result);
				$this->assign('oid', $oid);

				if (!$add_result || !$oid) {
					$tepResult = false;
				}
				if ($tepResult) {
					self::$ordersModel->commit();
				} else {
					self::$ordersModel->rollback();
				}
			}
		} else {
			$aid = I('post.aid');
			if (empty($aid)) {
				$this->error("Please input consignee address!");
			}
			$adressResult = M(C('TB_USER_ADDRESS'))
					->where(array("id" => $aid, "uid" => $uid))->find();
			if (!$adressResult) {
				$this->error("Consignee address is not existed!");
			}
			$realname = $adressResult['realname'];
			$address = $adressResult['address'];
			$citytext = getParentCityName($adressResult['city']);
			$mobile = $adressResult['mobile'];
			$payType = I('post.payType');
			if (empty($payType)) {
				$this->error("Please select payment tethod!");
			}else{
				$payTypeList = explode(',', $payType);
				$payType = $payTypeList[0];
				$payTypeNid = $payTypeList[1];
			}
			import("Org.Util.Cart");
			$cart = new \Org\Util\Cart();
			$goods = $cart->getSelectGoods('ALL');//获取购物车信息
			// $goods_str =  file_get_contents('goods.txt');
			// $goods = json_decode($goods_str,1);
			// file_put_contents('goods.txt',json_encode($goods)."\r\n",FILE_APPEND);
			if (!$goods) {
				$this->error("Your shopping cart is empty,please add goods to cart!", U('Index/index'));
			}
			$totalAll = $cart->getGoodsTotalPrice();//总价格
			$goods_number= $cart->getTotalNums();
			$order_goods = D('OrderGoods');//订单
			$goodsModel = M('Goods');
			$goodsCompanyModel = M('goods_company');
			//优惠券coupon
			$couponModel = M('coupon');
			$couponId = I('post.coupon_use');
			$couponWhere['id'] = $couponId;
			$couponData = M('coupon')->where($couponWhere)->find();
			// 支付
			self::$ordersModel->startTrans();
			//配送
			$scid = I('post.scid');//配送商铺ID
			$ccid = I('post.cityid');
			if ($scid) {
				$city = M('city');
				$shi = getCcid($ccid, 1);
				$pei_address = $city->where(array('id' => $sendcity))->getField("address");
			}
			$yunfei = 0;
			// 货到付款
			if ($payTypeNid == 'Cash') {
				$pay_status = self::$ordersModel->PAY_STATUS_WAITING;//'963';
			}
			foreach ($goods as $k => $v) {
				$gid = $v['id'];
				$goodsData = $goodsModel->where(array('id' => $gid))->find();
				$arr_cid[] = $goodsData['cid'];
			}
			$shangjia_cid = array_unique($arr_cid);//购物车商家id
			foreach ($shangjia_cid as $v) {
				$order_sn_cid[$v] = 'LQ' . uniqid();//array('1'=>'a','2'=>'b');
			}
			// 购物车标识
			$ShoppingCart = getOrderUniqid();
			$or['order_sn'] = $ShoppingCart;
			$or['pid'] = $payType;
			$or['uid'] = $uid;
			$or['aid'] = $aid;
			$or['cid'] = $_SESSION['dianpu_id'];
			$or['ccid'] = $ccid;
			$or['scid'] = $scid;
			$or['type'] = $payType;
			$or['addtime'] = gmtTime();
			$or['total'] = $totalAll;
			$oid = self::$ordersModel->add($or);

			if (!$oid) {
				$tepResult = false;
			} else {
				foreach ($goods as $k => $v) {
					//$or['order_money'] = $this->total;
					//返回订单ID
					$gid = $v['id'];
					$goodsData = $goodsModel->where(array('id' => $gid))
							->find();
					if ($goodsData["freight"]) {
						$goods_freight = getFreight($goodsData["freight"],$v['total']);
					} else {
						$goods_freight = 0;
					}
					$cid = $goodsData['cid'];//goodsData商品数据
					$order_sn = $order_sn_cid[$cid];//同一个商家一个订单号
					//订单编号order_sn
					//$order_sns .= $order_sn.',';//购物车多个订单编号
					//$oid_list  .= $oid .',';//编号
					$yunfei += $goods_freight;
					$order_goods->oid = $oid;
					$order_goods->ShoppingCart = $ShoppingCart;//购物车标识
					$order_goods->freight = $goods_freight;
					$order_goods->goods_name = $goodsData["name"];
					$order_goods->address = $citytext;
					$order_goods->goods_number = $v['num'];
					$order_goods->goods_id = $gid;
					$order_goods->pay_status = $pay_status;
					$order_goods->realname = $realname;
					$order_goods->tel = $mobile;
					$order_goods->zipcode = $adressResult['zipcode']; //邮编
					$order_goods->address_detail = $address;
					$order_goods->order_sn = $order_sn;
					$order_goods->create_time = time();
					$order_goods->update_time = time();
					$order_goods->goods_price = $goodsData['price'];
					$order_goods->order_money = vip_price(
							$goodsData['price']) * $v['num'];
					$order_goods->user_id = session('ieflex_id');
					$order_goods->image_path = getImgaePath($goodsData['image']);
					//$one_money = $order_goods->goods_number * $order_goods->goods_price;
					$order_goods->type = $payType;
					$goods_name .= $order_goods->goods_name . "\n";
					$goods_name .= '  ' . $order_goods->goods_number . '份'
							. '×' . $order_goods->goods_price . '        '
							. vip_price($goodsData['price']) * $v['num']
							. "\n";
					$order_goods->remark = $goods_name;
					$add_result = $order_goods->add();

					if (!$add_result) {
						$tepResult = false;
						break;
					}
					$ogid_list .= $add_result . ',';//编号

					// dump($couponId);
					if ($couponId) {
						$rsultCoupon = couponCheck($couponId, $gid);
						if ($rsultCoupon) {
							//	dump($rsultCoupon);
							//优惠券
							$ocid = self::$ordersModel->data($or)->add();
							$order_goods->oid = $oid;
							//$order_goods->ShoppingCart = $ShoppingCart;//购物车标识
							$order_goods->freight = 0;
							$order_goods->goods_name = 'Use coupon';
							$order_goods->address = $citytext;
							$order_goods->goods_number = 0;
							$order_goods->goods_id = $gid;
							$order_goods->pay_status = $pay_status; //960已下单
							$order_goods->realname = $realname;
							$order_goods->tel = $mobile;
							$order_goods->zipcode = $adressResult['zipcode']; //邮编
							$order_goods->address_detail = $address;
							$order_goods->order_sn = $order_sn;
							$order_goods->create_time = time();
							$order_goods->update_time = time();
							$order_goods->goods_price = $couponData[price];
							$order_goods->order_money = -$couponData[price];
							$order_goods->user_id = $uid;
							$order_goods->image_path = '/Public/eng/images/coupons.jpg';
							//$one_money = $order_goods->goods_number * $order_goods->goods_price;
							$order_goods->type = $payType;
							$goods_name .= $order_goods->goods_name . "\n";
							$goods_name .= '  ' . $order_goods->goods_number
									. ' ' . '×' . $order_goods->goods_price
									. '        '
									. vip_price($goodsData['price'])
											* $v['num'] . "\n";
							$order_goods->remark = $goods_name;
							$ogcid = $order_goods->add();
							$totalAll = $totalAll - $couponData[price];//优惠券
							$useCouponResult = $couponModel
									->where(array('id' => $couponId))
									->save(array('status' => -1));
							if (!$ogcid || !$useCouponResult) {
								$tepResult = false;
								break;
							}
						}
					}
				}
			}
			if ($tepResult) {
				$cart->delAll();
				$commitResult = self::$ordersModel->commit();
				if($commitResult){
					$payAction = A(Pay);
					$payResult = $payAction->doPay($payType);
					exit();
				}
			} else {
				self::$ordersModel->rollback();
			}
			//发邮件
			/*
			$message ="";
			foreach ($goods as $v => $k) {
					$message .= '商品名称：' . $k['name'] . '   ' . '数量：' . $k['num'] . ' 个   ' . '单价：' . $k['price'] . ' 个   '.  "<br/>";
			}
			$message .= '收货地址：' . $citytext.$address .  "<br/>";
			$message .= '联系电话：' . $mobile .  "<br/>";
			$admin_email = MgC("SITE_SERVICE_EMAIL"); //接受邮箱
			$username = MgC("SMTP_ACCOUNT");
			$fromname = MgC("SITE_NAME");
			$server = MgC("SMTP_SERVER");
			$pass_word = MgC("SMTP_PASSWORD");
			//发送通知邮件
			$mail = SendMailSmtp($email, $username, $fromname, $server, '用户订单', $message, $username, $pass_word);
			 */
			//$OrderLog = D('OrderLog');
			//创建订单日志
			//$order_sns = implode(',',$order_sn_cid);
			//$OrderLog->createorder($oid_list,$order_sns);
			$this->assign('order_sn', $ShoppingCart);
			$this->assign('goods_number', $goods_number);
			$this->assign('payType', $payType);
			$this->assign('ogid', rtrim($ogid_list, ','));
			$this->assign('oid', $oid);
			$this->assign('totalAll', $totalAll);
			if ($payType == 'Cash') {
				$this->display('order_success');
				exit;
			}
		}
		//支付列表
		$payment_list = D(C('TB_PAYMENT'))->where("status=1")->order("sort ASC")->select();
		$this->assign('payment_list', $payment_list);
		//$order_info = D("Orders")->OrderInfo(array('orders_sn' => $order_sn));
		//dump($order_info);
		//$this->assign('order_info', $order_info);
		$user_info = M('account')->where(array('user_id' => $uid))->find();
		$this->assign('user_info', $user_info);
		$this->display();
	}

	/**
	 * 订单详情页面
	 */
	Public function orderView() {
		$model = D('OrdersView');
		$uid = session('uid');
		$ogid = I('get.ogid');
		$oid = I('get.oid');
		$orders_sn = I("get.orders_sn");
		if ($ogid) {
			$where['order_goods.id'] = array('in', $ogid);
		}
		//验证订单是否是自己
		$where['orders.order_sn'] = $orders_sn;
		$info = $model->where($where)->find();
		//dump($info);
		$pay_status = $info['pay_status'];
		$this->assign("orders_sn", $orders_sn);
		//dump($pay_status);
		if ($pay_status == '967') {
			$OrdersView = D('OrdersView');
			$info = $OrdersView
					->field(
							'orders_sn,create_time,sum(order_money) as order_money,memo')
					->where(array('orders_sn' => $orders_sn))
					->group('order_id')->select();
			$this->assign('info', $info[0]);
			$this->display('orderrefund_1');
		} else {
			$payinfo = M('payinfo_log')->where(array("OrderNo" => $orders_sn))
					->find();
			if ($payinfo != "") {
				$this->assign("paytype", $payinfo['Ext1']);
			}
			$this->assign("info", $info);
			$this->display();
		}

	}

	/**
		+------------------------------------------------------------------------------
	 * 获取配送地址列表控制器，自动补全功能
		CommonAction.class.php
		create : 2013-5-22
		author: vic
		+------------------------------------------------------------------------------
	 */
	function getAddrs() {
		$a = trim($_GET["q"]);
		$result = array();
		$clist = M("send_caddress")
				->where("status=1 AND `address` like '%$a%'")->select();
		foreach ($clist as $key => $value) {
			array_push($result,
					array("address" => $value['address'],
							"cid" => $value['cid']));
		}
		die(json_encode($result));
	}
	/**
	 * [confirm_order 确认收货]
	 * @param  author dk
	 * @return [type]        [description]
	 */
	public function confirmOrder() {
		//验证是否登陆
		$uid = session('uid');
		if (!$uid) {
			//$this->display("/Member/login");
			$this
					->ajaxReturn(
							array('status' => 1, 'msg' => 'Please login first！',
									'url' => U('Member/login')));
		}
		$orders_sn = I("order_sn");
		$reason = I("reason");//理由
		//$order_goods = D('OrderGoods');
		/*$where = array(
				"pay_status" => '960',
				"user_id"	=> $uid,
				"order_sn"		=> $order_sn
		);
		$result = $order_goods->field('oid')->where($where)->select();
		if($result != "") {
				$r = $order_goods->where($where)->save(array("pay_status"=>'965',"reason"=>$reason));
				if($r != "") {
						$OrderLog = D('OrderLog');
						foreach ($result as $k => $v) {
								$oid .= $v['oid'].',';
						}
						$OrderLog->orderCancel($oid,$order_sn);
						$this->ajaxReturn(array('status'=>1,'msg'=>'您的订单已取消！','url'=>'/index.php/account/order.html'));
				}
		}else{
				$sql = D('Sql');
				$sql->errorsql($order_goods->getLastSql(),json_encode(I()));

				$this->error("请正常操作！","/index.php/account/order.html");
		}*/
		$modelOrders = D('Orders');
		$OrderGoods = D('OrderGoods');
		$data['pay_status'] = $modelOrders->PAY_STATUS_CONFIRM;//订单取消
		$data['order_sn'] = $orders_sn;
		$orderResult = $modelOrders->updateOrderInfo($data);
		if ($ordergoodsResult !== false) {
			//$this->success('订单取消成功');
			$this
					->ajaxReturn(
							array('status' => 1, 'msg' => 'You have confirmed receipt！',
									'url' => '/index.php/account/order.html'));
		} else {
			//$this->error('订单取消失败');
			$this
					->ajaxReturn(
							array('status' => 0, 'msg' => 'You confirm receipt failed, please try again later！',
									'url' => '/index.php/account/order.html'));
		}
		/*$orders_sn = I('orders_sn');
		$password = I('password');
		$vip = D('Vip');//'status'=>1,
		$data = $vip->field('pay_password')->where(array('id'=>$uid))->find();
		//echo $data['pay_password'].'|||'. md5($password);
		if($data['pay_password'] == md5($password) ){
				$order_goods = D('OrderGoods');
				$goods_data['out_trade_no'] = $orders_sn;
				$goods_data['pay_status'] = '964';//订单完成//$order_goods->field('sum(order_money) as order_money')->where(array('order_sn'=>$order_sn))->find();
				$ordergoodsResult = $order_goods->update_pay_status($goods_data,$goods_data['pay_status'],null);
				//$order_money = $goods_data['order_money'];
				//$score = $order_money % 2;
		///dump($ordergoodsResult);
		//exit();
				if($ordergoodsResult !==false){
						//$vip = D(C('TB_USER'));
						//$order_goods = $vip->set_score($score,2);
						$rs['status'] = true;
						$this->ajaxReturn($rs);
				}else{
						$sql = D('Sql');
						$sql->errorsql($order_goods->getLastSql(),json_encode(I()));
						$rs['status'] = flase;
						$rs['error'] = "数据异常";
						$this->ajaxReturn($rs);
				}
		}else{
				$sql = D('Sql');
				$sql->errorsql($vip->getLastSql(),json_encode(I()));
				$rs['status'] = flase;
				$rs['error'] = "密码不对请重新输入";
				$this->ajaxReturn($rs);
		}*/
	}
	/**
	 * [orderrefund 退款]
	 * @return [type] [description]
	 */
	public function orderrefund() {
		//验证是否登陆
		$uid = session('uid');
		if (!$uid) {
			$this->display("Member/login");
			exit();
		}
		$orders_sn = I('orders_sn');
		//$OrdersView = D('OrdersView');
		$trade = D('Orders');
		$data['orders_sn'] = $orders_sn;
		$orderInfo = $trade->OrderInfo($data);
		//dump($orderInfo);
		$oid = $orderInfo['order_id'];
		$ogid = $orderInfo['ogid_list'];
		$orders_money = $orderInfo['money'];
		//dump($orderInfo[orders_info][0]['pay_status']);
		if (IS_POST) {
			$orderrefund = D('OrderRefund');
			$type = I('type');
			$reason = I('reason');
			$money = I('money');//退款金额小于等于订单金额
			if (empty($money)) {
				$this->error('Please enter the refund amount');
			}
			if ($orderInfo[orders_info][0]['pay_status'] == '966') {
				$this->error('Order has been processed');
			}
			$OrderGoods = D('OrderGoods');
			//$OrderGoods_data = $OrderGoods->field('sum(order_money) as order_money')->where(array('order_sn'=>$orders_sn))->select();
			$shuoming = I('shuoming');
			$image = I('image');
			$pay_status = '966';//申请退款/退货
			// if($type == '退货'){
			//     $pay_status = '966';
			// }else{
			//     $pay_status = '967';//申请退款
			// }
			//dump($orderrefund);
			if ($orders_money <= $money) {
				if ($orderrefund
						->orderrefund_add($orders_sn, $type, $reason, $money,
								$shuoming, $image)) {
					//后期开启事务
					$goods_data['out_trade_no'] = $orders_sn;
					//$goods_data['pay_status'] = $pay_status;
					//$OrderGoods->where(array('order_sn'=>$orders_sn))->save(array('pay_status'=>$pay_status));//退货
					$ordergoodsResult = $OrderGoods
							->update_pay_status($goods_data, $pay_status, null);
					//$OrderLog = D('OrderLog');
					//$OrderLog->orderrefund($oid,$orders_sn,$type);
					$this->success('Operation succeeded!');
				} else {
					$sql = D('Sql');
					$sql->errorsql($orderrefund->getLastSql(), json_encode(I));
					$this->error('Return operation failed, please try again later!');
				}
			} else {
				$this->error('Refund amount exceeds total order');
			}
		} else {
			//$info = $OrdersView->field('order_sn,create_time,sum(order_money) as order_money')->where(array('order_sn'=>$orders_sn))->group('order_sn')->select();
			$this->assign('info', $orderInfo['orders_info'][0]);
			$this->assign('orders_sn', $orders_sn);
			$this->assign('orders_money', $orders_money);
			$this->assign('ogid', $ogid);
		}
		$this->display();
	}
	public function orderrefund_1() {
		//验证是否登陆
		$uid = session('uid');
		if (!$uid) {
			$this->display("/Member/login");
			exit();
		}
		$orders_sn = I('orders_sn');
		$OrdersView = D('OrdersView');
		if (IS_POST) {
			$orderrefund = D('Orderrefund');
			$type = 'Refund';
			$express_name = I('express_name');
			$express = I('express');
			$fahuo_shuoming = I('fahuo_shuoming');
			$OrderGoods = D('OrderGoods');
			$shuoming = I('shuoming');
			$image = I('image');
			$pay_status = '967';//退货中
			if ($orderrefund
					->orderrefund_add1($orders_sn, $type, $fahuo_shuoming,
							$image, $express_name, $express)) {
				//后期开启事务
				$OrderGoods->where(array('order_sn' => $orders_sn))
						->save(array('pay_status' => $pay_status));//退货
				$OrderLog = D('OrderLog');
				$OrderLog->orderrefund($oid, $orders_sn, $type);
				$this->success('Operation succeeded!');
			} else {
				$sql = D('Sql');
				$sql->errorsql($orderrefund->getLastSql(), json_encode(I));
				$this->success('Operation failed!');
			}

		}
	}
	}
?>
