<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">
    <title>用户信息</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <article>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      

      if (isset($_GET['code'])) {
        require 'server/wx-config-data.php';
        
        $code = $_GET['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?&appid=' . 
              $wx['appId'] . 
              '&secret=' .
              $wx['appSecret'] . 
              '&code=' . 
              $code .
              '&grant_type=authorization_code';

        $json = file_get_contents($url);
        $data = json_decode($json);
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . 
                $data -> access_token . 
                '&openid=' . 
                $data -> openid .
                '&lang=zh_CN';

        $json = file_get_contents($url);
        $data = json_decode($json);


        switch ($data -> sex) {
          case 1:
            $data -> sex = '男';
            break;
          case 2:
            $data -> sex = '女';
            break;
          default:
            $data -> sex = '未知';
        }


        echo '<p><img src="' . $data -> headimgurl . '"></p>' .
            '<p>' . $data -> openid . '</p>' .
            '<p>' . $data -> nickname . '</p>' .
            '<p>' . $data -> sex . '</p>' .
            '<p>' . $data -> country . '</p>' .
            '<p>' . $data -> province . '</p>' .
            '<p>' . $data -> city . '</p>';
      }
      else {
        echo '<p>没有Code，不能查看用户信息！</p>';
      }		
    ?>
    </article>
  </body>
</html>