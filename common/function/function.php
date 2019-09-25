<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用公共文件  控制器直接调用

//json输出格式 传入数据即可
function my_json($data){
    if(is_array($data)){
        return  json_encode($data,JSON_UNESCAPED_UNICODE);
    }else{
        return  $data;
    }
}

function json_encode_UN($array)
{
    if(version_compare(PHP_VERSION,'5.4.0','<')){
        $str = json_encode($array);
        $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i",function($matchs){
            return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
        },$str);
        return $str;
    }else{
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

/**
 * 获取客户端IP地址
 * @param integer   $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean   $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function ip(){
    static $ip = NULL;
    if ( $ip !== NULL ) return $ip;
    if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ){
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown',$arr);
        if(false !== $pos){
            unset($arr[$pos]);
        }
        $ip = trim($arr[0]);
    }elseif( isset($_SERVER['HTTP_CLIENT_IP']) ){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif( isset($_SERVER['REMOTE_ADDR']) ){
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? $ip : 'unknow';
    return $ip;
}

//创建随机数  微信签名用的
function createNonceStr($length = 32) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

function generateQRfromGoogle($chl,$widhtHeight ='150',$EC_level='L',$margin='0')

{
    $chl = urlencode($chl);

    echo '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.' 

    &cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl.'" alt="QR code" widhtHeight="'.$widhtHeight.' 

    " widhtHeight="'.$widhtHeight.'"/>';

}
function  dump($arr){
    echo "<pre/>";
    var_dump($arr);
}
/**
 * 发送post请求
 * @param string $url
 * @return bool|mixed
 */
function request_post($url = '', $param = '')
{
    if (empty($url) || empty($param)) {
        return false;
    }
    $postUrl = $url;
    $curlPost = $param;
    $ch = curl_init(); //初始化curl
    curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//严格校验2
    curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上

    //设置证书
    //使用证书：cert 与 key 分别属于两个.pem文件
    //默认格式为PEM，可以注释
//    curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
//    curl_setopt($ch,CURLOPT_SSLCERT, './28/5badd5b2df157.pem');
//    //默认格式为PEM，可以注释
//    curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
//    curl_setopt($ch,CURLOPT_SSLKEY,'./28/5badd5bb4d9a5.pem');
    curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10000);
    $data = curl_exec($ch); //运行curl
    curl_close($ch);
    return $data;
}

/**
 * 发送get请求
 * @param string $url
 * @return bool|mixed
 */
function request_get($url = '')
{
    if (empty($url)) {
        return false;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//严格校验2
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

//提交json 格式
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
        )
    );
    $response = curl_exec($ch);
//    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $response;
}

