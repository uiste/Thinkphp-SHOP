<?php
/*
 *  Copyright (c) 2014 The CCP project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a Beijing Speedtong Information Technology Co.,Ltd license
 *  that can be found in the LICENSE file in the root of the web site.
 *
 *   http://www.yuntongxun.com
 *
 *  An additional intellectual property rights grant can be found
 *  in the file PATENTS.  All contributing project authors may
 *  be found in the AUTHORS file in the root of the source tree.
 */
include_once("./CCPRestSmsSDK.php");

//主帐号,对应开官网发者主账号下的 ACCOUNT SID
$accountSid= '8aaf070858cd982e0158e43b5c4e0f3a';

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
$accountToken= '79c78807fac2488889b2fb19526ff1f2';

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
$appId='8aaf070858cd982e0158e43b60750f41';

//请求地址
//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
//生产环境（用户应用上线使用）：app.cloopen.com
$serverIP='sandboxapp.cloopen.com'; // 注意：需要把这里的url地址改为上面的沙河环境


//请求端口，生产环境和沙盒环境一致
$serverPort='8883';

//REST版本号，在官网文档REST介绍中获得。
$softVersion='2013-12-26';


/**
  * 发送模板短信
  * @param to 手机号码集合,用英文逗号分开
  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
  * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
  */       
function sendTemplateSMS($to,$datas,$tempId)
{
     global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
     $rest = new REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);

     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
         $data = array(
            'sign' => 1,
            'code' => 'error code',
            'msg' => '调用失败！'
         );
         echo json_encode($data);exit();
     }
     if($result->statusCode!=0) {
          $data = array(
            'sign' => 2,
            'code' => 'error code' . $result->statusCode,
            'msg' => '调用失败！' . $result->statusMsg
         );
         echo json_encode($data);exit();
     }else{
         $smsmessage = $result->TemplateSMS;
          $data = array(
            'sign' => 0,
            'code' => 'success',
            'msg' => '发送验证码成功！' . $smsmessage->dateCreated . $smsmessage->smsMessageSid
         );
         echo json_encode($data);exit();
     }
}

/**
 * 生成随机字符串
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大小写字母；
 * 1，数字；2，小写字母；3，大写字母；4，特殊字符；
 * -1，数字+大小写字母+特殊字符
 * @return string
 */
 function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[rand(0, $count)];
    }
    return $code;
 }

//用一个手机号码60s只能发送一次验证码
function getStatusBykey($key, $time = 60)
{
    $m = new Memcache();
    $m->connect('localhost',11211);
    $flag = $m->get($key);
    if($flag){
        return true;
    }else{
        $m->set($key,'1', MEMCACHE_COMPRESSED, $time);
        return false;
    }

}
// 同一个手机号码一天只能有3次发送机会
function getStatusBykeyInday($key, $number = 3)
{
    $m = new Memcache();
    $m->connect('localhost',11211);
    $flag = intval( $m->get($key) );
    if( $flag <= $number ){
        $hasTime = strtotime(date('Y-m-d 23:59:59')) - time();
        $m->set($key, ++$flag, MEMCACHE_COMPRESSED, $hasTime);
        return true;
    }else{
        return false;
    }
}


//Demo调用 
//**************************************举例说明***********************************************************************
//*假设您用测试Demo的APP ID，则需使用默认模板ID 1，发送手机号是13800000000，传入参数为6532和5，则调用方式为           *
//*result = sendTemplateSMS("13800000000" ,array('6532','5'),"1");																		  *
//*则13800000000手机号收到的短信内容是：【云通讯】您使用的是云通讯短信模板，您的验证码是6532，请于5分钟内正确输入     *
//*********************************************************************************************************************
$phone = $_GET['phone'];
// if(!getStatusBykeyInday('xxx_' . $phone) || getStatusBykey(md5($phone))){
//     $data = array(
//         'sign' => 3,
//         'code' => 'dont send code in 60s',
//         'msg' => '不要在60s连续发送验证码,切一天只能使用三次'
//     );
//     echo json_encode($data);exit();
// }
// 生成
$code = randCode(4, 1); // 4的数字
$time = 3; // 单位minutes
setcookie('code', $code, time() + $time * 60, '/');

sendTemplateSMS( $phone , array($code, $time), "1");
//手机号码，替换内容数组，模板ID
?>
