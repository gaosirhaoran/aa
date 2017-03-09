$(function () {
    $('#chooseImage').click(function () {
        $('.choose').css('display','block')
        $('button').css('opaticy','0.5')
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
                var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                $('img').css('display','block')
                $('img').attr('src',localIds)
            }
        });
    })
    $('.icon-remove').click(function (){
        $('.choose').css('display','none')
    })
})