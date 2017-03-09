<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1,maximum-scale=1, user-scalable=no">
    <title>微信开发</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="image.html">图像接口</a>
    <a href="video.html">录音接口</a>
    <a href="map.html">地图接口</a>

    <?php
        require 'server/wx-config-data.php';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' .
                $wx['appId'] .
                '&redirect_uri=' . 
                'http://zhiyou.yvipy.com/h5-15/gaosir/user.php' .
                '&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
    ?>
    <a href="<?php echo $url; ?>">用户信息</a>
</body>
</html>
