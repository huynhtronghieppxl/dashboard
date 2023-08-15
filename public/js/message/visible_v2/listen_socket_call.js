$(function (){
    /**
     * Thông báo phản hồi camera của đối phương đã đóng - mở
     */
    socket.on('res-turn-on-off-camera/' + idSession, async data => {
        console.log('res-turn-on-off-camera/', data)
        if (data.status === 0) {
            offCameraYou(mediaConstraints);
            $('.on-off-camera').removeClass('d-none');
        } else {
            rtcPeerConnection = new RTCPeerConnection(config);
            await addLocalTracks(rtcPeerConnection);
            rtcPeerConnection.ontrack = setRemoteStream;
            rtcPeerConnection.onicecandidate = sendIceCandidate;
            await createOffer(rtcPeerConnection);
            await setLocalStream(mediaConstraints);
            $('.on-off-camera').addClass('d-none');
        }
    })

    /**
     * Thông báo phản hồi micro của đối phương đã đóng - mở
     */
    socket.on('res-turn-on-off-mic/' + idSession, async data => {
        console.log('res-turn-on-off-mic/', data);
        if (data.status === 0) {
            $('.on-off-mic').removeClass('d-none');
        } else {
            $('.on-off-mic').addClass('d-none');
        }
    })

    /**
     * Bắt tín hiệu nhận biết đối phương đã từ chối cuộc gọi
     */
    socket.on('res-call-reject/' + idSession, async data => {
        console.log('res-call-reject/', data, idSession);
        $('.body-call-visible-message .status-call').addClass('d-none');
        $('.body-call-visible-message .count-time').removeClass('d-none');
        $('.body-call-visible-message img').removeClass('calling-animation');
        $('.body-call-visible-message .status-call').text('Từ chối cuộc gọi');
        videoCallVideo.pause();
        videoCallVideo.src = "";
        closeFormCallVisibleMessage();
        localStream.getTracks()[0].stop();
        renderCallCancelMessage(data);
    });

    /**
     * Bắt tín hiệu nhận biết đối phương đã hủy cuộc gọi
     */
    socket.on('res-call-cancel/' + idSession, async data => {
        console.log('res-call-cancel/', data, idSession);
        $('.body-call-visible-message .status-call').addClass('d-none');
        $('.body-call-visible-message .count-time').removeClass('d-none');
        $('.body-call-visible-message img').removeClass('calling-animation');
        $('.body-call-visible-message .status-call').text('Từ chối cuộc gọi');
        videoGrid.pause();
        videoGrid.src = "";
        videoCallVideo.pause();
        videoCallVideo.src = "";
        resetCall();
        closeFormCallVisibleMessage();
        renderNoAnswerMessager(data);
    });

    /**
     * Bắt tín hiệu nhận biết cuộc gọi hoàn tất
     */
    socket.on('res-call-complete/' + idSession, async data => {
        console.log('res-call-complete/', data, idSession);
        $('.body-call-visible-message .status-call').addClass('d-none');
        $('.body-call-visible-message .count-time').removeClass('d-none');
        $('.body-call-visible-message img').removeClass('calling-animation');
        $('.body-call-visible-message .status-call').text('Cuộc gọi hoàn tất');
        videoGrid.pause();
        videoGrid.src = "";
        videoCallVideo.pause();
        videoCallVideo.src = "";
        resetCall();
        closeFormCallVisibleMessage();
        renderCallCompleteMessage(data)
    });

    /**
     * Bắt tín hiệu nhận biết đã bỏ lỡ một cuộc gọi
     */
    socket.on('res-call-no-answer/' + idSession, async data => {
        console.log('res-call-no-answer/', data, idSession);
        $('.body-call-visible-message .status-call').addClass('d-none');
        $('.body-call-visible-message .count-time').removeClass('d-none');
        $('.body-call-visible-message img').removeClass('calling-animation');
        $('.body-call-visible-message .status-call').text('Từ chối cuộc gọi');
        videoGrid.pause();
        videoGrid.src = "";
        videoCallVideo.pause();
        videoCallVideo.src = "";
        resetCall();
        closeFormCallVisibleMessage();
    });

    /**
     * Bắt tín hiệu nhận biết có cuộc gọi đến
     */
    socket.on('res-call-connect/' + idSession, async data => {
        console.log('res-call-connect/', data);
        keyRoomID = data.key_room;
        openFormCallVisibleMessage(data);
    })

    /**
     * Bắt được tín hiệu thay đổi cuộc gọi giữa gọi thường - gọi video
     */
    socket.on('res-change-call/' + idSession, async data => {
        console.log('res-change-call/', data);
        keyRoomID = data.key_room;
        $('#main-class').removeClass('btn-end-video');
        $('#main-class').addClass('reject-require-open-camera');
        openFormCallVisibleMessage(data);
    })

    /**
     * Nhận tín hiệu đối phương từ chối yêu cầu mở camera của mình
     */
    socket.on('res-reject-to-camera/' + idSession, async data => {
        console.log('res-reject-to-camera/', data);
        $('#main-class').addClass('btn-end-video');
        $('#main-class').removeClass('reject-require-open-camera');
        // closeFormCallVisibleMessage();
        backupLayoutRejectVideoCallMessage();
    })

    /**
     * Socket người khác đã chấp nhận cuộc gọi đến của mình
     */
    socket.on('res-call-accept/' + idSession, async data => {
        $('.btn-camera-call-visible-message').removeAttr('disabled');
        $('.btn-camera-call-visible-message').removeClass('disabled');
        isCheckinput(2)
        console.log('res-call-accept/', data);
        if (data.message_type == 21) {
            $('.count-time').removeClass('d-none');
            $('.status-call').addClass('d-none');
            $('.countdown-animation').addClass('d-none');
            $('#video-call-remote').removeClass('d-none');
            $('.video-call-local-visibel-message').addClass('video-call-accept-visible-message');
            rtcPeerConnection = new RTCPeerConnection(config);
            await addLocalTracks(rtcPeerConnection);
            rtcPeerConnection.ontrack = setRemoteStream;
            rtcPeerConnection.onicecandidate = sendIceCandidate;
            await createOffer(rtcPeerConnection);
            countTimeCallVisibleMessage();
        } else {
            $('.body-call-visible-message .status-call').addClass('d-none');
            $('.body-call-visible-message .count-time').removeClass('d-none');
            $('.body-call-visible-message img').removeClass('calling-animation');
            rtcPeerConnection = new RTCPeerConnection(config);
            await setLocalStreamAudio(mediaConstraintsAudio);
            await addLocalTracks(rtcPeerConnection);
            rtcPeerConnection.onicecandidate = sendIceCandidate;
            await createOffer(rtcPeerConnection);
            countTimeCallVisibleMessage();
        }

        /** Hủy sự kiện tự động tắt sau 30s khi không được kết nối thành công */
        clearTimeout(timeWaitingCalling);
    })

    /**
     * Nhận được tín hiệu yêu cầu kết nối từ người gọi
     */
    socket.on('res-make-offer/' + idSession, async data => {
        console.log('res-make-offer/', data)
        rtcPeerConnection = new RTCPeerConnection(config);
        addLocalTracks(rtcPeerConnection);
        rtcPeerConnection.ontrack = setRemoteStream;
        rtcPeerConnection.onicecandidate = sendIceCandidate;
        rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(data.offer));
        await createAnswer(rtcPeerConnection);
    })

    /**
     * Nhận được tín hiệu phản hồi chấp nhận kết nối của người được gọi
     */
    socket.on('res-make-answer/' + idSession, async data => {
        console.log('res-make-answer/', data);
        await rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(data.answer));
    })

    /**
     * Nhận được tín hiệu ice-candidate của đối phương
     */
    socket.on('res-ice-candidate/' + idSession, async data => {
        console.log('Socket event callback: webrtc_ice_candidate', data);
        // ICE candidate configuration.
        let candidate = new RTCIceCandidate({
            sdpMLineIndex: 0,
            sdpMid: 0,
            candidate: data.candidate,
        })
        console.log(candidate);
        rtcPeerConnection.addIceCandidate(candidate);
    })
})

async function isCheckinput(num) {
    checkButton = num;
}



