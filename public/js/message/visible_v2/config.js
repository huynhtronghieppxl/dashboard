/** Connect socket **/
let socket = "";
let idCurrentConversation = "";
let typeCurrentConversation = "";
$(function () {
    socket = io.connect(domainSocket, {
        transports: ['polling'],
    });
    socket.on('connect', function () {
        console.log('Socket connected');
    });
    socket.on('disconnect', function () {
        console.log('Socket disconnected');
        $('.box-load-not-connect').removeClass('d-none');
        $('.em.bg-blue.new-notify-unread-message').addClass('d-none');
        $('#layout-right-visible-message').css('flex', '1');
        $('#layout-right-visible-message').html(`<div class="layout-right-visible-message-container"> <img src="images/message/not-connect.gif" style="width: 500px; height: 500px; margin: 0 auto; display: block;"></div>`);
    });
    /** Connect Supplier **/
    let dataSupplier = {
        member_id: idSession,
        app_name: 'supplier',
    };
    socket.emit('client-connection-tms-supplier', dataSupplier);
});

function joinRoomGroupPersonal() {
    saveCookieShared('id-current-conversation', idCurrentConversation);
    if (typeCurrentConversation === 3) {
        let room = {
            group_id: idCurrentConversation,
            member_id: idSession,
            app_name: 'tms',
            code: '',
        };
        socket.emit('join-room-tms-supplier', room);
    } else {
        let room = {
            group_id: idCurrentConversation,
            member_id: idSession,
            os_name: 'web_dashboard',
        };
        socket.emit('join-room', room);
    }
}

function leaveRoomGroupPersonal() {
    if (typeCurrentConversation === 3) {
        let room = {
            group_id: getCookieShared('id-current-conversation'),
            member_id: idSession,
            app_name: 'tms',
        };
        socket.emit('leave-room-tms-supplier', room);
    } else {
        let room = {
            group_id: getCookieShared('id-current-conversation'),
            member_id: idSession,
            os_name: 'web_dashboard',
        };
        socket.emit('leave-room', room);
    }
}

function joinRoomForConnection() {
    saveCookieShared('id-current-for-conversation', idCurrentConversation);
    let room = {
        group_id: idCurrentConversation,
        member_id: idSession,
        os_name: 'web',
    };
    console.log("kết nối lại room", room);
    socket.emit('join-room-for-connection', room);
}

function leaveRoomForConnection() {
    let room = {
        group_id: getCookieShared('id-current-for-conversation'),
        member_id: idSession,
        os_name: 'web',
    };
    console.log("ngắt kết nối room", room);
    socket.emit('leave-room-for-connection', room);
}

