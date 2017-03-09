<?php

  /* 
  从微信服务端获取令牌、票据、生成配置数据。
  具体步骤：
  1.用 appId 和 appSecret 到微信服务器换取（发请求） access_token（访问令牌）
    access_token是我们自己的服务调用微信服务的身份标识，之后发起的所有请求都需
    要带access_token。
    access_token最大存活时间是7200s，所以获取之后通常会保存到文件或者内存中
    下次获取令牌时，先检查之前的令牌是否过期，如果没过期，直接用，过期则重新获取
  2.拿着 access_token 到微信服务器获取调用JSAPI的ticket票据
    票据的最大存活时间也是7200s。
  3.将票据、url、时间戳、随机字符串按特定顺序排好，然后使用sha1进行签名（数据摘要）
    签名之后将签名及上述数据返回给浏览器端进行JSAPI配置。
  */


  class JSSDK {

    public $appId;
    public $appSecret;

    /* 构造函数 */
    public function __construct($appId, $appSecret) {
      $this -> appId = $appId;
      $this -> appSecret = $appSecret;
    }

    /* 生成签名的配置数据 */
    public function getSignedConfig($url) {
      $nonceStr = $this -> getNonceStr();
      $timestamp = time();
      $ticket = $this -> getAPITicket();

      $str = 'jsapi_ticket=' . $ticket .
             '&noncestr=' . $nonceStr .
             '&timestamp=' . $timestamp .
             '&url=' . $url;

      $signature = sha1($str);

      return array(
        "appId"     => $this->appId,
        "nonceStr"  => $nonceStr,
        "timestamp" => $timestamp,
        "url"       => $url,
        "signature" => $signature,
        "rawString" => $str
      );
    }

    /* 生成随机字符串 */
    public function getNonceStr($length = 16) {
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $charsCount = strlen($chars);
      $str = "";

      for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, $charsCount - 1), 1);
      }

      return $str;
    }

    /* 获取访问令牌，从网络获取后会保存在文件中，保留7000ms */
    public function getAccessToken() {
      // PHP中读取文件最简单的方法就是 file_get_contents()
      // PHP中发起网络请求的最简单方法也是 file_get_contents()
      // PHP中写入文件最简单的方法是 file_put_contents()

      // __DIR__ 可以获取当前路径（文件夹）
      // __FILE__   可当前文件
      // __FUNCTION__  当前函数名
      // __CLASS__     当前类名
      // __METHOD__    当前方法名（类中的函数）
      // __NAMESPACE__ 当前命名空间（容器，可以起到命名隔离的作用）
      // __LINE__      当前行号
      // PHP中把上面的叫做魔术变量
      $json = file_get_contents(__DIR__ . '/data/access_token.json');
      $data = json_decode($json);

      if ($data -> expire_time < time()) {
        $url = 'https://api.weixin.qq.com/cgi-bin/token' .
               '?grant_type=client_credential' .
               '&appid=' . $this -> appId .
               '&secret=' . $this -> appSecret;

        $res = file_get_contents($url);
        $resObj = json_decode($res);

        if ($resObj -> access_token) {
          $data -> expire_time = time() + 7000;
          $data -> access_token = $resObj -> access_token;
          file_put_contents(__DIR__ . '/data/access_token.json', json_encode($data));
        }
      }

      return $data -> access_token;
    }

    /* 获取API票据，从网络获取后会保存在文件中，保留7000s */
    public function getAPITicket() {
      $json = file_get_contents(__DIR__ . '/data/api_ticket.json');
      $data = json_decode($json);

      if ($data -> expire_time < time()) {
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket' .
               '?type=jsapi' .
               '&access_token=' . $this -> getAccessToken();

        $res = file_get_contents($url);
        $resObj = json_decode($res);

        if ($resObj -> ticket) {
          $data -> expire_time = time() + 7000;
          $data -> ticket = $resObj -> ticket;
          file_put_contents(__DIR__ . '/data/api_ticket.json', json_encode($data));
        }
      }

      return $data -> ticket;
    }

  }

?>