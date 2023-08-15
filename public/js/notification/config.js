const firebaseConfig = {
    apiKey: "AIzaSyDEgXdhIllWTcGMvOThfJ7vZgElGYZ3lXI",
    authDomain: "techres-tms.firebaseapp.com",
    databaseURL: "https://techres-tms.firebaseio.com",
    projectId: "techres-tms",
    storageBucket: "techres-tms.appspot.com",
    messagingSenderId: "507549433713",
    appId: "1:507549433713:web:8eca878e1c859d26",
    measurementId: "G-93KVHGFENG"
}
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
navigator.serviceWorker
    .register('firebase-messaging-sw.js')
    .then((registration) => {
        firebase.messaging().useServiceWorker(registration);
    });
$(function (){
    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationTitle = payload.data.title;
        const notificationOptions = {
            body: payload.data.content,
            icon: '/images/tms/logo2.jpeg',
            dir: 'auto', // use for derection of message
            vibrate: [200, 100, 200]
        };
        let notification = new Notification(notificationTitle, notificationOptions);
        getActionNotification(payload);
        notification.onclick = function (event) {
            event.preventDefault();
            getActionNotification(payload)
            notification.close();
        }
        setTimeout(function () {
            notification.close();
        }, 10000);

        // switch (parseInt(payload.data.type)) {
        //     case 15:
        //         if (!("Notification" in window)) {
        //             console.log("Trình duyệt không hỗ trợ notification");
        //         } else {
        //             const notificationTitle = payload.data.title;
        //             const notificationOptions = {
        //                 body: payload.data.content,
        //                 icon: payload.data.avatar,
        //             };
        //             if (!("Notification" in window)) {
        //                 console.log("Trình duyệt không hỗ trợ notification");
        //             } else if (Notification.permission === "granted") {
        //                 console.log(notificationTitle , 'notification');
        //                 let notification = new Notification(notificationTitle, notificationOptions);
        //                 notification.onclick = function (event) {
        //                     event.preventDefault();
        //                     window.open('/visible-message', '_blank',);
        //                     notification.close();
        //                 }
        //                 setTimeout(function () {
        //                     notification.close();
        //                 }, 10000);
        //             } else {
        //                 Notification.requestPermission();
        //             }
        //         }
        //         break
        //     case 5:
        //         if (parseInt(payload.data.type_message) === 21 || parseInt(payload.data.type_message) === 22) {
        //             notifyCallVisibleMessage(payload.data);
        //         } else {
        //             let group = JSON.parse(payload.data.group),
        //                 sender = JSON.parse(payload.data.sender);
        //             const notificationTitle = payload.data.title;
        //             const notificationOptions = {
        //                 body: sender.name + ': ' + payload.data.body,
        //                 icon: domainSession + group.avatar,
        //             };
        //
        //             if (!("Notification" in window)) {
        //                 console.log("Trình duyệt không hỗ trợ notification");
        //             } else {
        //                 if (!("Notification" in window)) {
        //                     console.log("Trình duyệt không hỗ trợ notification");
        //                 } else if (Notification.permission === "granted") {
        //                     let notification = new Notification(notificationTitle, notificationOptions);
        //                     notification.onclick = function (event) {
        //                         event.preventDefault();
        //                         window.open('/visible-message', '_blank',);
        //                         notification.close();
        //                     }
        //                     setTimeout(function () {
        //                         notification.close();
        //                     }, 10000);
        //                 } else {
        //                     Notification.requestPermission();
        //                 }
        //             }
        //         }
        //         break;
        // }
    });
})


function getActionNotification(data) {
    let objectData = JSON.parse(data.data.json_addition_data)
    switch (parseInt(data.data.object_type)){
        /**
        * Tài khoản nhân viên
        * */
        case 100:
            console.log(objectData);
            // window.open('/payment-bill-treasurer', '_blank',);
            break;
        /**
         * Phiếu thu chi
         * */
        case 102 :
            console.log(objectData);
            // window.open('/payment-bill-treasurer', '_blank',);
            break;
        /**
         * Bảng lương
         * */
        case 104:
            window.open('/salary-employee-treasurer', '_blank',);
            break;
        /**
         * Đặt bàn
         * */
        case 107:
            window.open('/booking-table-manage', '_blank',);
            break;
        /**
         * Phiếu yêu cầu
         * */
        case 115:
            window.open('/supplier-order', '_blank',);
            break;

        /**
         * Phiếu mua hàng
         * */
        case 118:
            window.open('/supplier-order', '_blank',);
            break;

        /**
         * Đơn hàng
         * */
        case 119:
            window.open('/supplier-order', '_blank',);
            break;

        /**
         * Nguyên liệu
         * */
        case 121:
            window.open('/material-data', '_blank',);
            break;

        /**
         * Gán nhà cung cấp
         * */
        case 122:
            window.open('/list-supplier-data', '_blank',);
            break;

        /**
         * Đơn vị nguyên liệu
         * */
        case 123:
            window.open('/unit-data', '_blank',);
            break;

        /**
         * Quy cách nguyên liệu
         * */
        case 124:
            window.open('/specifications-data', '_blank',);
            break;

        /**
         * Danh mục nhà hàng
         * */
        case 125:
            window.open('/payment-bill-treasurer', '_blank',);
            break;

        /**
         * Đơn vị món ăn
         * */
        case 126:
            window.open('/unit-food-data', '_blank',);
            break;

        /**
         * món ăn
         * */
        case 127:
            window.open('/food-brand-manage', '_blank',);
            break;

        /**
         * Nhân viên
         * */
        case 128:
            window.open('/payment-bill-treasurer', '_blank',);
            break;
    }
}
