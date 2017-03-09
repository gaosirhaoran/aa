/* 配置微信需要从服务端获取一些数据，这些数据是服务
   端根据微信服务器返回的数据生成的。*/

// 从服务获取配置数据
$.getJSON('server/wx-config.php', function (data) {
  wx.config({
    'debug': false,                 // 开启调试模式
    'appId': data.appId,            // 微信后分配的App唯一标识符
    'timestamp': data.timestamp,    // 时间标记（服务端返回的配置数据是有时效的）
    'nonceStr': data.nonceStr,      // 加密或签名用的随机字符串
    'signature': data.signature,    // 签名（能够证明数据是否被篡改）
    'jsApiList': [                  // 打算调用的微信的JSAPI的列表，只有在这个列表中的方法才能调用成功
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
      'onMenuShareQQ',
      'onMenuShareWeibo',
      'onMenuShareQZone',
      'startRecord',
      'stopRecord',
      'onVoiceRecordEnd',
      'playVoice',
      'pauseVoice',
      'stopVoice',
      'onVoicePlayEnd',
      'uploadVoice',
      'downloadVoice',
      'chooseImage',
      'previewImage',
      'uploadImage',
      'downloadImage',
      'translateVoice',
      'getNetworkType',
      'openLocation',
      'getLocation',
      'hideOptionMenu',
      'showOptionMenu',
      'hideMenuItems',
      'showMenuItems',
      'hideAllNonBaseMenuItem',
      'showAllNonBaseMenuItem',
      'closeWindow',
      'scanQRCode',
      'chooseWXPay',
      'openProductSpecificView',
      'addCard',
      'chooseCard',
      'openCard'
    ]
  })
})


