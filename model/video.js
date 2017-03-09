$(function () {
    // 当开始录音按钮点击的时候触发以下事件
    $('#startRecord').click(function () {
        $('.stop').css('display', 'block')
        $('#startRecord').css('opacity', '0.5')
        // 开始录音
        wx.startRecord();
        // 点击停止录音
        $('.icon-volume-down').click(function () {
            $('.stop').css('display', 'none')
            $('.play').css('display', 'block')
            wx.stopRecord({
                success: function (res) {
                    var localId = res.localId;
                    // 点击播放录音
                    $('.icon-play').click(function () {
                        wx.playVoice({
                            localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
                        })
                    })
                    // 点击暂停录音
                    $('.icon-pause').click(function () {
                        wx.pauseVoice({
                            localId: localId // 需要暂停的音频的本地ID，由stopRecord接口获得
                        })
                    })
                    // 停止播放录音
                    $('.icon-stop').click(function () {
                        wx.stopVoice({
                            localId: localId // 需要暂停的音频的本地ID，由stopRecord接口获得
                        })
                    })
                    // 识别语音
                    $('.icon-volume-up').click(function () {
                        wx.translateVoice({
                            localId: localId, // 需要识别的音频的本地Id，由录音相关接口获得
                            isShowProgressTips: 1, // 默认为1，显示进度提示
                            success: function (res) {
                                alert(res.translateResult); // 语音识别的结果
                            }
                        })
                    })
                }
            })
        })
    })
    // 点击空白处隐藏
    $('.icon-remove').click(function () {
        $('.stop').css('display','none')
        $('.play').css('display', 'none')
        $('#startRecord').css('opacity', '1')
    })
})