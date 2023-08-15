/**
 * Auth: Hiệp
 */

let localStream, roomId = "";
let dataCallVideo, videoCallVideo = document.getElementById('video-call-visible-message'),
    audioCall = document.getElementById('audio-call-visible-message'),
    memberCreateCall;
const videoGrid = document.getElementById("video-call-remote");
let remoteStream, rtcPeerConnection;
let isCallAudio = 0, timeWaitingCalling;
let checkButton = 0, keyRoomID = '';
const peers = {};
/** ---------------------------------- THIẾT LẬP CẤU HÌNH ----------------------------------*/
const config = {
    iceServers: [
        {
            urls: 'stun:stun.aloapp.vn:3478',
            username: 'kelvin',
            credentials: '12345'
        },
        {urls: 'stun:stun.l.google.com:19302'},
        {urls: 'stun:stun1.l.google.com:19302'},
        {urls: 'stun:stun2.l.google.com:19302'},
        {urls: 'stun:stun3.l.google.com:19302'},
        {urls: 'stun:stun4.l.google.com:19302'},
        {
            urls: 'turn:turn.aloapp.vn:3478',
            username: 'kelvin',
            credential: '12345'
        },
    ],
};
const peerConnection = new RTCPeerConnection(config);

$(function () {
    /** ---------------------------------- PHÍA NGƯỜI GỌI ----------------------------------*/
    /**
     * Bắt đầu cuộc gọi thoại
     */
    $(document).on('click', '#start-call, #start-call-popup', async function (){
        $('.btn-camera-call-visible-message').attr('disabled','true');
        $('.btn-camera-call-visible-message').addClass('disabled');
        reloadBackCallAudioMessage()
        isCheckinput(1);
        isCallAudio = 1;
        randomString();
        $('#modal-call-visible-message').modal('show');
        $('.footer-call-visible-message button').removeClass('d-none');
        $('.connect-call').addClass('d-none');
        $('.body-call-visible-message img').attr('src', $('#header-visible-message img').attr('src'));
        $('.background-image-call-visible-message').attr('src', $('#header-visible-message img').attr('src'));
        $('.header-call-visible-message').text($('.header-chat-name').text());
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            key_room: roomId,
            message_type: 22,
            call_time: "",
            call_member_create: idSession,
            type: "String"
        }
        // localStream.getTracks()[0].stop();
        videoCallVideo.pause();
        videoCallVideo.src = "";
        $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam-off"></i>');
        $('.btn-mic-call-visible-message').attr('data-original-title', 'Tắt micro');
        $('.btn-mic-call-visible-message').html('<i class="zmdi zmdi-mic"></i>');
        console.log('call-connect', data);
        socket.emit('call-connect', data);
        // timeWaitingCalling = setTimeout(callConnectNoAnswerMesager, 30000);
    });

    /**
     * Bắt đầu cuộc gọi video
     */
    $('#start-video-call').on('click', async function (event) {
        $('#modal-call-visible-message .modal-content').css('width', '700px');
        $('.body-call-visible-message img').addClass('video-call-image-visible-message');
        $('.countdown-animation').addClass('calling-animation');
        $('.status-call').addClass('status-call-video');
        randomString();
        $('#video-call-visible-message').removeClass('d-none');
        $('#modal-call-visible-message').modal('show');
        $('.footer-call-visible-message button').removeClass('d-none');
        $('.connect-call').addClass('d-none');
        $('.header-call-visible-message').text($('.header-chat-name').text());
        $('.body-call-visible-message img').removeClass('d-none');
        $('.btn-camera-call-visible-message').data('original-title', 'Tắt camera');
        $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam"></i>');
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            key_room: roomId,
            message_type: 21,
            call_time: "00:00",
            call_member_create: idSession,
            type: "String"
        }
        console.log('call-connect', data);
        socket.emit('call-connect', data);
    });

    /**
     * Huỷ cuộc gọi hoặc hoàn tất cuộc gọi
     */
    $(document).on('click', '.btn-cancel-call-visible-message', function () {
        if(checkButton == 1) {
            $('.btn-cancel-call-visible-message').attr('data-type', 2);
            let data = '';
            if ($('#video-call-visible-message').hasClass('d-none')) {
                data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    key_room: roomId,
                    message_type: 22,
                    call_time: "00:00",
                    call_member_create: idSession,
                    type: "String"
                }
            } else {
                data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    key_room: roomId,
                    message_type: 21,
                    call_time: "00:00",
                    call_member_create: idSession,
                    type: "String"
                }
                localStream.getTracks()[0].stop();
                videoCallVideo.pause();
                videoCallVideo.src = "";
            }
            resetCall();
            console.log('call-cancel', data);
            socket.emit('call-cancel', data);
            closeFormCallVisibleMessage();
            renderCallCancelMessage(data);
        }
        else {
            let data = '';
            if ($('#video-call-visible-message').hasClass('d-none')) {
                data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    key_room: roomId,
                    message_type: 22,
                    call_time: "00:00",
                    call_member_create: idSession,
                    type: "String"
                }
            } else {
                data = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    key_room: roomId,
                    message_type: 21,
                    call_time: "00:00",
                    call_member_create: idSession,
                    type: "String"
                }
                localStream.getTracks()[0].stop();
                videoCallVideo.pause();
                videoCallVideo.src = "";
            }
            resetCall();
            console.log('call-complete', data);
            socket.emit('call-complete', data);
            closeFormCallVisibleMessage();
            renderCallCompleteMessage(data);
        }
    });

    /**
     * Hoàn tất cuộc gọi
     */


    /**
     * Gọi lại
     */
    $('.re-connect-call .btn-re-connect').on('click', function () {
        $('.footer-call-visible-message button').removeClass('d-none');
        $('.connect-call').addClass('d-none');
        $('.body-call-visible-message img').attr('src', $('#header-visible-message img').attr('src'));
        $('.body-call-visible-message img').addClass('calling-animation');
        $('.background-image-call-visible-message').attr('src', $('#header-visible-message img').attr('src'));
        $('.header-call-visible-message').text($('.header-chat-name').text());
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            key_room: roomId,
            message_type: 22,
            call_time: "3:23",
            call_member_create: 484,
            type: "String"
        }
        console.log('call-connect', data);
        socket.emit('call-connect', data);
    });

    /**
     * Đóng form gọi
     */
    $('.re-connect-call .btn-end').on('click', function () {
        closeFormCallVisibleMessage();
    });
    /**
     * Mở/tắt camera
     */
    $('.btn-camera-call-visible-message').on('click', async function () {
        $('.countdown-animation').addClass('calling-animation');
        if ($(this).find('.zmdi-videocam').length === 0) {
            $(this).html('<i class="zmdi zmdi-videocam"></i>');
            $('#modal-call-visible-message .modal-content').css('width', '700px');
            $('.body-call-visible-message img').addClass('video-call-image-visible-message');
            $('.status-call').addClass('status-call-video');
            $('#video-call-visible-message').removeClass('d-none');
            $(this).attr('data-original-title', 'Tắt camera');
            videoCallVideo.pause();
            await setLocalStream(mediaConstraints)
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                status: 1,
            }
            if (isCallAudio === 1) {
                let dataChangeCall = {
                    member_id: idSession,
                    group_id: idCurrentConversation,
                    key_room: keyRoomID,
                    message_type: 21,
                    call_time: "00:00",
                    call_member_create: idSession,
                }
                socket.emit('change-call', dataChangeCall);
            }
            isCallAudio = 0;

            console.log('turn-on-off-camera', data)
            socket.emit('turn-on-off-camera', data);
        } else {
            reloadBackCallAudioMessage()
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                status: 0,
            }
            console.log('turn-on-off-camera', data);
            socket.emit('turn-on-off-camera', data);
        }
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    });

    /**
     * Mở/tắt mic
     */
    $('.btn-mic-call-visible-message').on('click', function () {
        if ($(this).find('.zmdi-mic').length === 0) {
            $(this).attr('data-original-title', 'Mở micro');
            $(this).html('<i class="zmdi zmdi-mic"></i>');
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                status: 1
            }
            console.log('turn-on-off-mic', data);
            socket.emit('turn-on-off-mic', data);
            localStream.getTracks()[0].enabled = true;
        } else {
            $(this).data('data-original-title', 'Tắt micro');
            $(this).html('<i class="zmdi zmdi-mic-off"></i>');
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                status: 0
            }
            console.log('turn-on-off-mic', data);
            socket.emit('turn-on-off-mic', data);
            localStream.getTracks()[0].enabled = false;
        }
    });

    /**
     * ----------- Phía người nhận cuộc gọi ---------------
     */

    /**
     * Chấp nhận cuộc gọi video call
     */
    $(document).on('click', '.btn-accept.video-call-accept', async function () {
        $('.video-call-local-visibel-message').addClass('video-call-accept-visible-message');
        $('.countdown-animation').addClass('d-none');
        $('#video-call-visible-message').removeClass('d-none');
        $('#video-call-remote').removeClass('d-none');
        $('.body-call-visible-message img').addClass('d-none');
        $('.body-call-visible-message video').removeClass('d-none');
        $('.btn-camera-call-visible-message').data('original-title', 'Đóng camera');
        $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam"></i>');
        $('.video-call-you').removeClass('d-none');
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            key_room: keyRoomID,
            message_type: 21,
            call_time: "00:00",
            call_member_create: memberCreateCall,
            type: "String"
        }
        console.log('call-accept', data);
        socket.emit('call-accept', data);
        await setLocalStreamAudio(mediaConstraintsAudio)
        $('.footer-call-visible-message button').removeClass('d-none');
        $('.connect-call').addClass('d-none');
        $('.body-call-visible-message .status-call').addClass('d-none');
        $('.body-call-visible-message .count-time').removeClass('d-none');
        countTimeCallVisibleMessage();
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    })

    /**
     * Chấp nhận cuộc gọi audio
     */
    $(document).on('click', '.connect-call .btn-accept.call-accept', async function () {
        isCallAudio = 1;
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            key_room: roomId,
            message_type: 22,
            call_time: "3:23",
            call_member_create: idSession,
            type: "String"
        }
        await setLocalStreamAudio(mediaConstraints);
        console.log('call-accept', data);
        socket.emit('call-accept', data);
        $('.btn-camera-call-visible-message').data('original-title', 'Mở camera');
        $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam-off"></i>');
        $('.footer-call-visible-message button').removeClass('d-none');
        $('.connect-call').addClass('d-none');
        $('.countdown-animation').removeClass('calling-animation');
        $('.body-call-visible-message .status-call').addClass('d-none');
        $('.body-call-visible-message .count-time').removeClass('d-none');
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
        countTimeCallVisibleMessage();
    })

    /**
     * Nhấn nút từ chối khi cuộc gọi audio đến
     */
     $(document).on('click', '.connect-call .btn-end', function () {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            key_room: roomId,
            message_type: 22,
            call_time: "3:23",
            call_member_create: memberCreateCall,
            type: "String"
        }
        console.log('call-reject', data);
        socket.emit('call-reject', data);
        closeFormCallVisibleMessage();
         renderCallRejectMessage(data);
    });

    /**
     * Nhấn nút từ chối khi cuộc gọi video đến
     */
    $(document).on('click', '.btn-end-video', function () {
        if($('#main-class').hasClass('reject-require-open-camera')) {
            return false;
        }
        else {
            let data = {
                member_id: idSession,
                group_id: idCurrentConversation,
                key_room: roomId,
                message_type: 21,
                call_time: "00:00",
                call_member_create: memberCreateCall,
                type: "String"
            }
            console.log('call-reject', data);
            socket.emit('call-reject', data);
            closeFormCallVisibleMessage();
        }
    });

    /**
     * Nhấn nút từ chối mở camera khi đối phương yêu cầu
     */
    $(document).on('click', '.reject-require-open-camera', function () {
        let data = {
            member_id: idSession,
            group_id: idCurrentConversation,
            // key_room: roomId,
            // message_type: 21,
            // call_time: "00:00",
            // call_member_create: memberCreateCall,
            // type: "String"
        }
        console.log('reject-to-camera', data);
        socket.emit('reject-to-camera', data);
        // closeFormCallVisibleMessage();
        backupLayoutRejectVideoCallMessage()
    });

})

function backupLayoutRejectVideoCallMessage() {
    $('.time-call-visible-message').removeClass('d-none');
    $('.status-call').addClass('d-none');
    $('.footer-call-visible-message button').removeClass('d-none');
    $('.connect-call').addClass('d-none');
    $('#modal-call-visible-message .modal-content').css('width', '300px');
    $('#video-call-visible-message').addClass('d-none');
    $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam-off"></i>');
    $('.body-call-visible-message img').removeClass('video-call-image-visible-message');
    $('.status-call').removeClass('status-call-video');
    $('.btn-camera-call-visible-message').attr('data-original-title', 'Mở camera');
    offCameraMe(mediaConstraints);
}

function playVideoStream(videoTagId, stream) {
    let video = document.getElementById(videoTagId);
    video.srcObject = stream;
    video.onloadeddata = function () {
        video.play();
    }
}


function notifyCallVisibleMessage(data) {
    if (data.call_status === "call_connect") {
        openFormCallVisibleMessage(data);
    } else {
        closeFormCallVisibleMessage();
    }
}

function openFormVideoCallVisibleMessage(data) {
    // let sender = JSON.parse(data.sender);
    $('#modal-call-video-visible-message-me').modal('show');
    // $('.footer-call-visible-message button').addClass('d-none');
    $('.footer-call-visible-message-you').addClass('d-none');
    $('.connect-call').removeClass('d-none');
    $('.body-call-visible-message-you img').attr('src', domainSession + data.avatar);
    $('.background-image-call-visible-message-you').attr('src', domainSession + data.avatar);
    // $('.header-call-visible-message').text(data.name);
    $('.body-call-visible-message-you .status-call').text('Có cuộc gọi ...');
    $('.body-call-visible-message-you .status-call').removeClass('d-none');
    $('.body-call-visible-message-you .count-time').addClass('d-none');
}

function openFormCallVisibleMessage(data) {
    // let sender = JSON.parse(data.sender);
    memberCreateCall = data.call_member_create;
    if (data.message_type == 21) {
        $('.countdown-animation').addClass('img-res-accept-video');
        $('#modal-call-visible-message .modal-content').css('width', '700px');
        $('.btn-end').addClass('btn-end-video');
        $('.btn-end-video').removeClass('btn-end');
        $('.btn-accept').addClass('video-call-accept');
        $('.btn-accept').html('<i class="fa fa-video-camera"></i>');
    } else {
        $('.btn-accept').html('<i class="zmdi zmdi-phone"></i>')
        $('.body-call-visible-message img').addClass('calling-animation');
        $('.btn-accept').addClass('call-accept');
    }
    $('.header-call-visible-message').text(data.full_name);
    $('.countdown-animation').attr('src', domainSession + data.avatar)
    $('#modal-call-visible-message').modal('show');
    $('.footer-call-visible-message button').addClass('d-none');
    $('.connect-call').removeClass('d-none');
    $('.body-call-visible-message img').attr('src', domainSession + data.avatar);
    $('.background-image-call-visible-message').attr('src', domainSession + data.avatar);
    $('.header-call-visible-message').text(data.name);
    $('.body-call-visible-message .status-call').text('Có cuộc gọi ...');
    $('.body-call-visible-message .status-call').removeClass('d-none');
    $('.body-call-visible-message .count-time').addClass('d-none');
}

function closeFormCallVisibleMessage() {
    console.log('đã vào tới đây rồi');
    $('#modal-call-visible-message').modal('hide');
    $('#modal-call-video-visible-message-me').modal('hide');
    $('.body-call-visible-message video').addClass('d-none');
    $('.body-call-visible-message img').removeClass('d-none');
    $('.btn-camera-call-visible-message').data('original-title', 'Đóng camera');
    $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam"></i>');
    $('.btn-mic-call-visible-message').data('original-title', 'Tắt micro');
    $('.btn-mic-call-visible-message').html('<i class="zmdi zmdi-mic-off"></i>');
    $('.body-call-visible-message .status-call').text('Đang kết nối ...');
}

function countTimeCallVisibleMessage() {
    let totalSeconds = 0;
    setInterval(setTime, 1000);

    function setTime() {
        ++totalSeconds;
        $('.body-call-visible-message .count-time').text(pad(parseInt(totalSeconds / 60)) + ':' + pad(totalSeconds % 60));
    }

    function pad(val) {
        val = val.toString();
        return (val.length < 2) ? "0" + val : val;
    }
}

function streamWebCam(stream) {
    const mediaSource = new MediaSource(stream);
    try {
        videoCallVideo.srcObject = stream;
    } catch (error) {
        videoCallVideo.src = URL.createObjectURL(mediaSource);
    }
    videoCallVideo.play();
    dataCallVideo = stream;
}

function throwError(e) {
    alert(e.name);
}

/**
 * counter-calling
 */
let circle = document.getElementById('pink-halo');
let timeSecond, interval, angle, angle_increment;

function counterAnimation() {
    timeSecond = 30;
    interval = 30;
    angle = 0;
    angle_increment = 302 / t;
    $('#modal-call-visible-message').modal('show');
    $('.counter-animation').removeClass('d-none');
    window.timer = window.setInterval(function () {
        circle.setAttribute("stroke-dasharray", angle + ", 303");
        if (angle >= 302) {
            window.clearInterval(window.timer);
        }
        angle += angle_increment / (1000 / interval);
    }.bind(this), interval);
}

function closeCounterAnimation() {
    $('.counter-animation').addClass('d-none');
    circle.setAttribute("stroke-dasharray", 0 + ", 303");
    window.clearInterval(window.timer);
}

function gotRemoteStream(event) {
    videoCallVideo.srcObject = event.streams[0];
}

async function setLocalStream(mediaConstraints) {
    let stream
    try {
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;
        stream = await navigator.mediaDevices.getUserMedia({video: true, audio: true }, streamWebCam, throwError);
    } catch (error) {
        console.error('Could not get user media', error)
    }

    localStream = stream
    videoCallVideo.srcObject = stream;
}
async function setLocalStreamAudio(mediaConstraints) {
    let stream
    try {
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;
        stream = await navigator.mediaDevices.getUserMedia({audio: true }, throwError);
    } catch (error) {
        console.error('Could not get user media', error)
    }
    localStream = stream;
}


async function offCameraMe(mediaConstraints) {
    let stream
    try {
        stream = await navigator.mediaDevices.getUserMedia(mediaConstraints)
    } catch (error) {
        console.error('Could not get user media', error)
    }
    localStream = stream
    videoCallVideo.srcObject = stream
}

async function offCameraYou(mediaConstraints) {
    let stream
    try {
        stream = await navigator.mediaDevices.getUserMedia(mediaConstraints)
    } catch (error) {
        console.error('Could not get user media', error)
    }
    localStream = stream
    videoGrid.srcObject = stream
}


const mediaConstraints = {
    audio: false,
    video: {width: 1280, height: 720},
}

const mediaConstraintsAudio = {
    audio: true,
}

/**
 *
 */

function addLocalTracks(rtcPeerConnection) {
    localStream.getTracks().forEach((track) => {
        rtcPeerConnection.addTrack(track, localStream)
    })
}


async function createOffer(rtcPeerConnection) {
    console.log('createOffer', rtcPeerConnection);
    let sessionDescription
    try {
        sessionDescription = await rtcPeerConnection.createOffer();
        await rtcPeerConnection.setLocalDescription(sessionDescription)
    } catch (error) {
        console.error(error)
    }
    console.log('make-offer', {
        group_id: idCurrentConversation,
        offer: sessionDescription,
        member_id: idSession
    })
    socket.emit('make-offer', {
        group_id: idCurrentConversation,
        offer: sessionDescription,
        member_id: idSession
    })
}

async function createAnswer(rtcPeerConnection) {
    console.log('createAnswer', rtcPeerConnection);
    let sessionDescription
    try {
        sessionDescription = await rtcPeerConnection.createAnswer()
        await rtcPeerConnection.setLocalDescription(sessionDescription)
    } catch (error) {
        console.error(error)
    }
    console.log('make-answer', {
        group_id: idCurrentConversation,
        answer: sessionDescription,
        member_id: idSession,
    })
    socket.emit('make-answer', {
        group_id: idCurrentConversation,
        answer: sessionDescription,
        member_id: idSession,
    })
}

function setRemoteStream(event) {
    videoGrid.srcObject = event.streams[0]
    remoteStream = event.stream
}

function localRemote(event) {
    videoCallVideo.srcObject = event.streams[0]
    localStream = event.stream
}

function sendIceCandidate(event) {
    if (event.candidate) {
        console.log('ice-candidate', {
            member_id: idSession,
            candidate: event.candidate.candidate,
            group_id: idCurrentConversation
        })
        socket.emit('ice-candidate', {
            member_id: idSession,
            candidate: event.candidate.candidate,
            group_id: idCurrentConversation
        })
    }
}

function resetCall() {
    $('#video-call-visible-message').addClass('d-none');
    $('#video-call-remote').addClass('d-none');
    $('.count-time').addClass('d-none');
    $('.connect-call').addClass('d-none');
    $('.re-connect-call').addClass('d-none');
    $('.count-time').text('00:00');
    $('.status-call').removeClass('d-none');
    window.clearInterval(window.timer);
    timeSecond = 30;
    interval = 30;
    angle = 0;
    angle_increment = 302 / t;
    clearTimeout(window.timer);
}


function randomString() {
    let chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    for (let x = 0; x < 12; x++) {
        i = Math.floor(Math.random() * 62);
        roomId += chars.charAt(i);
    }
    console.log('room id: ', roomId);
}

/**
 * Sự kiện thông báo ngưng cuộc gọi sau 30s đối phương không nhấc máy
 */
function callConnectNoAnswerMesager() {
    let data = {
        member_id: idSession,
        group_id: idCurrentConversation,
        key_room: roomId,
        message_type: 22,
        call_time: "00:00",
        call_member_create: idSession
    }
    console.log('call-no-answer', data);
    socket.emit('call-no-answer', data);
    closeFormCallVisibleMessage();

    /**
     * Render ra tin nhắn cuộc gọi nhỡ
     */
    renderNoAnswerMessager(data);
}

/**
 * Chuyển sang gọi thoại không sử dụng video
 */
async function reloadBackCallAudioMessage() {
    $('.body-call-visible-message img').addClass('calling-animation');
    $('.btn-camera-call-visible-message').html('<i class="zmdi zmdi-videocam-off"></i>');
    $('#modal-call-visible-message .modal-content').css('width', '300px');
    $('.body-call-visible-message img').removeClass('video-call-image-visible-message');
    $('.status-call').removeClass('status-call-video');
    $('#video-call-visible-message').addClass('d-none');
    $('.btn-camera-call-visible-message').attr('data-original-title', 'Mở camera');
    offCameraMe(mediaConstraints);

}
