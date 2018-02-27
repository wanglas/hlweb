<?php
namespace Home\Controller;
use \Think\Controller;
class ApiController extends Controller {
/**
     * 发送验证码接口
     */
    public function registerApi()
    {
        $phone =I('post.tel');
        //初始化必填
        $options['accountsid']='807819fa01a18ea9490d4ba685f35ecb';
        $options['token']='475d381e890b746fd366fbde76c16cf3';
        $appId = "e60a61ecb2b2443baa1a5b7d03eef59a";

        $ucpass = new \Org\Util\Ucpaas($options);
        $yzm =rand(100000,999999);
        session('phoneyzm',array('phone' => $phone, 'yzm' => $yzm, 'expire' => 180));
        $to = $phone;
        $templateId='193242';
        $param=$yzm;//要发送的短信内容
        $ucpass->templateSMS($appId,$to,$templateId,$param);

    }

}

?>
