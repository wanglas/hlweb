<?php
// +----------------------------------------------------------------------
// | ieflex cms
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2015 All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: guanxi <ieflex@qq.com>
// +----------------------------------------------------------------------

/**
 * 购物车类
 * 使用SESSION和数据库
 * @package     tools_class
 * @author      李辉 <ieflex@qq.com>
 */
namespace Org\Util;
class Cart {

    /**
     * SESSION购物车中的名称
     * @var string
     */
    private $cartName = 'cart'; //购物车名 session名字
    private $dbCartName = 'goods_cart'; //购物车名
	  private $selGoods = 'sel_goods'; // 挑选商品
	  private $model;

    public function __construct(){
    	$this->model = D($this->dbCartName);
        if(M('goods_cart')){
	        //用户登陆时
	        $uid = session('uid');
	        if($uid){
	        	$model = $this->model;
	        	$sessionCart = $this->getSessionData();
	        	//dump($sessionCart['goods']);
	        	if(isset($sessionCart['goods'])){
	        		//没有就插入

	        		foreach ($sessionCart['goods'] as $key=>$v){
	        			$condition["uid"] = $uid;
	        			$condition["sid"] = $key;
	        			$result = $model->where($condition)->find();
	        			//echo $model->getLastSql();
	        			if(!$result){

				        	$cdata["uid"] = $uid;
				        	$cdata["sid"] = $key;
				        	$cdata["gid"] = $v['id'];
				        	$cdata["name"] = $v['name'];
			                $cdata['num'] = $v['num'];
			                $cdata['price'] = $v['price'];
		                	$savedata = $model->add($cdata);
	        			}
	        		}

	        	}
	        	//清空SESSION数据
	        	$this->delSessionAll();
	        	$where["uid"] = $uid;
	        	$dbCart = $model->where($where)->select();
	        	//添加到session里
	        	 foreach ($dbCart as $key=>$value){
				     $c['id'] = $value["gid"];
				     $c['num'] = $value["num"];
				     $c['name'] = $value['name'];
				     $c['price'] = $value['price'];
             $c['sid'] = $value['sid'];
				     $this->addSessionCart($c);
				}
	        }
        }
    }
    /**
     * 添加购物车
     * @access  public
     * @param array $data
     * <code>
     * $data为数组包含以下几个值
     * $Data=array(
     *  "id"=>1,                        //商品ID
     *  "name"=>"后盾网2周年西服",         //商品名称
     *  "num"=>2,                       //商品数量
     *  "price"=>188.88,                //商品价格
     *  "options"=>array(               //其他参数，如价格、颜色可以是数组或字符串|可以不添加
     *      "color"=>"red",
     *      "size"=>"L"
     *  )
     * </code>
     * @return void
     */

    public function add($data) {
        if (!is_array($data) || !isset($data['id']) || !isset($data['name']) || !isset($data['num']) || !isset($data['price'])) {
            throw_exception("购物车参数错误！");
        }
        $data = isset($data[0]) ? $data : array($data);
        $goods = $this->getGoods(); //获得商品数据
        $cdata = array();
        //添加商品支持多商品添加
        foreach ($data as $v) {
            $options = isset($v['options']) ? $v['options'] : '';
            $sid = $this->getSid($v);//substr(md5($v['id'] . serialize($options)), 0, 8); //生成维一ID用于处理相同商品有不同属性时
            if (isset($goods[$sid])) {
                if ($v['num'] == 0) {//如果数量为0删除商品
                    unset($goods[$sid]);
                    continue;
                }
                //已经存在相同商品时增加商品数量
                $goods[$sid]['num'] = $goods[$sid]['num'] + $v['num'];
                $goods[$sid]['total'] = $goods[$sid]['num'] * $goods[$sid]['price'];
                if(M('goods_cart')){
    		        	$uid = session('uid');
    		        	if($uid){
    			        	$model = $this->model;
    			        	$where["uid"] = $uid;
    			        	$where["sid"] = $sid;

    		                $cdata['num'] = $goods[$sid]['num'];
    		                $cdata['price'] = $goods[$sid]['price'];
    	                	$savedata = $model->where($where)->save($cdata);
    	                    if(!$savedata){
    			                //todo
    			            }
    		        	}
                }
            } else {
                if ($v['num'] == 0){
                    continue;
                }
                $goods[$sid] = $v;
                $goods[$sid]['total'] = $v['num'] * $v['price'];
                if(M('goods_cart')){
    		        	$uid = session('uid');
    		        	if($uid){
    			        	$model = $this->model;
    			        	$cdata["uid"] = $uid;
    			        	$cdata["sid"] = $sid;
    			        	$cdata["gid"] = $v['id'];
    			        	$cdata["name"] = $v['name'];
    		            $cdata['num'] = $v['num'];
    		            $cdata['price'] = $v['price'];
    						    $cdata['total'] = $v['num'] * $v['price'];
    	                	$savedata = $model->add($cdata);
    	                	//echo $model->getLastSql();
    	                	if(!$savedata){
    			                //todo
    			            }
    		        	}
                }
            }
        }
        $this->save($goods);
        return true;
    }


    /**
     * 添加购物车
     * @access  public
     * @param array $data
     * <code>
     * $data为数组包含以下几个值
     * $Data=array(
     *  "id"=>1,                        //商品ID
     *  "name"=>"西服",         //商品名称
     *  "num"=>2,                       //商品数量
     *  "price"=>188.88,                //商品价格
     *  "options"=>array(               //其他参数，如价格、颜色可以是数组或字符串|可以不添加
     *      "color"=>"red",
     *      "size"=>"L"
     *  )
     * </code>
     * @return void
     */

    public function addSessionCart($data) {
        if (!is_array($data) || !isset($data['id']) || !isset($data['name']) || !isset($data['num']) || !isset($data['price'])) {
            throw_exception("购物车参数错误！");
        }
        $data = isset($data[0]) ? $data : array($data);
        $goods = $this->getGoods(); //获得商品数据
        //添加商品增持多商品添加
        foreach ($data as $v) {
            $options = isset($v['options']) ? $v['options'] : '';
            $sid = $this->getSid($v);//substr(md5($v['id'] . serialize($options)), 0, 8); //生成维一ID用于处理相同商品有不同属性时
            if (isset($goods[$sid])) {
                if ($v['num'] == 0) {//如果数量为0删除商品
                    unset($goods[$sid]);
                    continue;
                }
                //已经存在相同商品时增加商品数量
                $goods[$sid]['num'] = $goods[$sid]['num'] + $v['num'];
                $goods[$sid]['total'] = $goods[$sid]['num'] * $goods[$sid]['price'];
            } else {
                if ($v['num'] == 0){
                    continue;
                }
                $goods[$sid] = $v;
                $goods[$sid]['total'] = $v['num'] * $v['price'];
            }
        }

        $this->save($goods);
        return true;
    }

    /**
     * 更新购物车
     * @param array $data
     * $data为数组包含以下几个值
     * $Data=array(
     *  "sid"=>1,                        //商品的唯一SID，不是商品的ID
     *  "num"=>2,                       //商品数量
     */
    public function update($data) {
        $goods = $this->getGoods(); //获得商品数据
        if (!isset($data['sid']) || !isset($data['num'])) {
            return false;
        }
        $data = isset($data[0]) ? $data : array($data); //允许一次删除多个商品
        foreach ($data as $dataOne) {
            foreach ($goods as $k => $v) {
                if ($k == $dataOne['sid']) {
                    //判断数量是否为0
                    if ($dataOne['num'] == 0) {
                        unset($goods[$k]);

                       if(M('goods_cart')){
      					        $uid = session('uid');
                        //用户登陆时
      					        if($uid){
      					        	$model = $this->model;
      					        	$uid = session('uid');
      					        	$condition["uid"] = $uid;
      					        	$condition["sid"] = $k;
      			                	$savedata = $model->where($condition)->delete();
      			                	if(!$savedata){
      			                		//todo
      			                	}
      		        			   }
                		    }
                        continue;
                    }
                    //判断数量不为0的时候
                    $goods[$k]['num'] = $dataOne['num'];
                    $goods[$k]['total'] = $dataOne['num'] * $goods[$k]['price'];
                    if(M('goods_cart')){
      			        	$model = $this->model;
      			        	$uid = session('uid');
      			        	$where["uid"] = $uid;
      			        	$where["sid"] = $k;
  		                $cdata['num'] = $goods[$k]['num'];
  		                $cdata['price'] = $goods[$k]['price'];
  	                	$savedata = $model->where($where)->save($cdata);
	                    if(!$savedata){
			                //todo
			                 }
                	}
                }
            }
        }
        $this->save($goods);
        return true;
    }

    /**
     * 更新购物车
     * @param array $data
     * $data为数组包含以下几个值
     * $Data=array(
     *  "sid"=>1,                        //商品的唯一SID，不是商品的ID
     *  "num"=>2,                       //商品数量
     */
    public function updateSessionCart($data) {
        $goods = $this->getGoods(); //获得商品数据
        if (!isset($data['sid']) || !isset($data['num'])) {
            error(L("cart_update_error"));
        }
        $data = isset($data[0]) ? $data : array($data); //允许一次删除多个商品
        foreach ($data as $dataOne) {
            foreach ($goods as $k => $v) {
                if ($k == $dataOne['sid']) {
                    if ($dataOne['num'] == 0) {
                        unset($goods[$k]);
                        continue;
                    }
                    $goods[$k]['num'] = $dataOne['num'];
                }
            }
        }
        $this->save($goods);
    }

    /**
     * 统计购物车中商品数量
     */
    public function getTotalNums() {
        $goods = $this->getGoods(); //获得商品数据
        $rows = 0;
        foreach ($goods as $v) {
            $rows+=$v['num'];
        }
        return $rows;
    }

    /**
     * 获得商品汇总价格
     */
    public function getTotalPrice() {
        $goods = $this->getGoods(); //获得商品数据
        $total = 0;
        foreach ($goods as $v) {
            $vip_price = $v['price'];
            //$total+= ceil($vip_price * $v['num']);
            $total+= $vip_price * $v['num'];
        }
        return $total;
    }

	 /**
     * 结算后获取商品总价格
     */
    public function getGoodsTotalPrice() {
        $goods = $this->getGoodsInfo(); //获得商品数据
        $total = 0;
        foreach ($goods as $v) {
            $total+=vip_price($v['price']) * $v['num'];
        }
        return $total;
    }



    /**
     * 删除购物车
     * @param array $data
     * 必须传递商品的sid值
     */
    public function del($data) {
        $goods = $this->getGoods(); //获得商品数据
        if (empty($goods)) {
            return false;
        }
        $sid = array(); //要删除的商品SID集合
        if (is_string($data)) {
            $sid['sid'] = $data;
        }
        if (is_array($data) && !isset($data['sid'])) {
            return false;
        }

        $sid = isset($sid[0]) ? $sid : array($sid); //可以一次删除多个商品
        foreach ($sid as $d) {
            foreach ($goods as $k => $v) {
                if ($k == $d['sid']) {
                    unset($goods[$k]);
                    if(M('goods_cart')){
                    	//用户登陆时
      				        $uid = session('uid');
      				        if($uid){
      				        	$model = $this->model;
      				        	$uid = session('uid');
      				        	$condition["uid"] = $uid;
      				        	$condition["sid"] = $k;
      		                	$savedata = $model->where($condition)->delete();
      		                	if(!$savedata){
      		                		//todo
      		                	}
      	        			}else{

                      }
                	}
                }
            }
        }
        $this->save($goods);
        return true;
    }

    /**
     * 删除购物车
     * @param array $data
     * 必须传递商品的sid值
     */
    public function delSessionCart($data) {
        $goods = $this->getGoods(); //获得商品数据
        if (empty($goods)) {
            return false;
        }
        $sid = array(); //要删除的商品SID集合
        if (is_string($data)) {
            $sid['sid'] = $data;
        }
        if (is_array($data) && !isset($data['sid'])) {
            return false;
        }

        $sid = isset($sid[0]) ? $sid : array($sid); //可以一次删除多个商品
        foreach ($sid as $d) {
            foreach ($goods as $k => $v) {
                if ($k == $d['sid']) {
                    unset($goods[$k]);
                }
            }
        }
        $this->save($goods);
        return true;
    }

    /**
     * 清空购物车中的所有商品
     */
    public function delAll() {
    	//清空购物车中已选
        $data = session($this->cartName);
		$selGoods = session($this->selGoods);
		if( $selGoods != "" ) {
			foreach($data['goods'] as $key=>$val) {
				if($selGoods[$key] != "" ){
					unset($data['goods'][$key]);
				}
			}
		}
		session($this->selGoods,null);
		//清空数据库
        if(M('goods_cart')){
        	//用户登陆时
	        $uid = session('uid');
	        if($uid){
			     $model = $this->model;
			     $uid = session('uid');
			     $condition["uid"] = $uid;
	             $savedata = $model->where($condition)->delete();
	        }
        }
        //清空Session
		$this->delSessionAll();
    }


    /**
     * 清空购物车中的所有商品
     */
    public function delSessionAll() {
        $data = array();
        $data['goods'] = array();
        $data['total_rows'] = 0;
        $data['total'] = 0;
        session($this->cartName, $data);
    }

    /**
     * 获得购物车商品数据
     */
    public function getGoods() {
        $cartName = $this->cartName;
        $data = session($this->cartName);
        if ($data) {
            return isset($data['goods']) ? $data['goods'] : null;
        }
        $data = array("goods" => array(), "total_rows" => 0, "total" => 0);
        session($this->cartName, $data);
        return null;
    }
	/**
     * 获得勾选的商品信息
     */
    public function getSelectGoods($nid) {
    	if($nid == 'ALL'){
    		$data = $this->getGoods();
    		//保存全部商品作为已选商品
    		$this->selGoodsAdd($data);
    		return $data;
    	} else{
			$result= "";
			$cartname = session($this->cartName);
      $uid = session('uid');
      // $cartname=M('goods_cart')->where('uid='.$uid)->select();
      // return $cartname;
			$gid_arr =I('post.gid_arr');  //已经拿到商品id数组
			if($gid_arr != "" && is_array($gid_arr)) {
        foreach ($cartname['goods'] as $k=>$v){
          foreach($gid_arr as $key=>$val){
            if($v['id']==$val){
              $result[]=$v;
            }
          }
        }
			}else{
        return 'is not array';
			}
			$this->selGoodsAdd($result);
			return $result;
    	}
    }

	/**
     * 获得结单信息
     */
    public function getGoodsInfo() {
        $data = session($this->selGoods);
        if ($data != "") {
			return $data;
        }else{
			return false;
		}
    }

	/**
     * 保存勾选商品信息
     */
    public function selGoodsAdd($array) {
		if(is_array($array)) {
			session($this->selGoods,$array);
			return true;
		}else{
			return false;
		}

    }






    /**
     * 获得购物车中的所有数据，包括商品数据、总数量、总价格
     */
    public function getSessionData() {
        return session($this->cartName);
    }
    /**
     * 获得商品唯一标识
     */
    private function getSid($data) {
    	$options = isset($data['options']) ? $data['options'] : '';
        return md5($data['id'] . serialize($options));
    }
    /**
     * 保存数据
     */
    private function save($goods) {
        $_SESSION[$this->cartName]['goods'] = $goods;
        $_SESSION[$this->cartName]['total_rows'] = $this->getTotalNums();
        $_SESSION[$this->cartName]['total'] = $this->getTotalPrice();
    }
}

?>
