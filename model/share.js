wx.ready(function () {
    //  alert('ok')
    //分享到朋友圈
    wx.onMenuShareTimeline({
        title: '分享到朋友圈', // 分享标题
        link: '这是我第一次做微信公众号开发，很开心', // 分享链接
        imgUrl: 'http://zhiyou.yvipy.com/app/image/logo.jpg', // 分享图标
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    })
    //分享给朋友
    wx.onMenuShareAppMessage({
        title: '分享给朋友', // 分享标题
        desc: '你好，给你看看我自己做的', // 分享描述
        link: 'http://zhiyou.yvipy.com', // 分享链接
        imgUrl: 'http://zhiyou.yvipy.com/app/image/friend.jpg', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    })
})