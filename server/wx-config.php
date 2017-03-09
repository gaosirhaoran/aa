<?php

	/* 开启错误输出 */
	ini_set("display_errors", "On");
	error_reporting(E_ALL | E_STRICT);


  /* 返回浏览器端配置微信所需要的数据 */

  // PHP中可以使用include、include_once、require、require_once 导入PHP文件
  require 'wx-config-data.php';
  require 'wx-jssdk.php';


  // PHP中通过 $_SERVER 可以获取请求头
  // HTTP_REFERER 表示HTTP协议中的 Referer 头
  // 通过 Referer 请求头可以获取请求是从哪个页面发起的
  $url = $_SERVER['HTTP_REFERER'];
  // 因为获取配置数据的过程比较复杂，所以封装了一个类来完成这项任务
  $jssdk = new JSSDK($wx['appId'], $wx['appSecret']); 

  $config = $jssdk -> getSignedConfig($url);

  // 因为返回的是json数据，所以设置一下Content-Type响应头
  header('Content-Type:application/json; charset=UTF-8');
  echo json_encode($config);

?>