/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');


const config = {
    apiKey: "AIzaSyDEgXdhIllWTcGMvOThfJ7vZgElGYZ3lXI",
    authDomain: "techres-tms.firebaseapp.com",
    databaseURL: "https://techres-tms.firebaseio.com",
    projectId: "techres-tms",
    storageBucket: "techres-tms.appspot.com",
    messagingSenderId: "507549433713",
    appId: "1:507549433713:web:8eca878e1c859d26",
    measurementId: "G-93KVHGFENG"
};
firebase.initializeApp(config);
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log(payload)
    let group = JSON.parse(payload.data.group),
        sender = JSON.parse(payload.data.sender),
        domain = 'https://api.upload.techres.vn';
    const notificationTitle = group.name;
    const notificationOptions = {
        body: sender.name + ':' + '' + payload.data.body,
        icon: domain + group.avatar
    };
    return self.registration.showNotification(notificationTitle,notificationOptions);
});

// self.addEventListener('notificationclick', function (event) {
//     event.notification.close();
//     const url = 'https://dashboard.techres.vn/chat'
//     event.waitUntil(
//         clients.matchAll({type: 'window'}).then( windowClients => {
//             // Check if there is already a window/tab open with the target URL
//             for (var i = 0; i < windowClients.length; i++) {
//                 var client = windowClients[i];
//                 // If so, just focus it.
//                 if (client.url === url && 'focus' in client) {
//                     return client.focus();
//                 }
//             }
//             // If not, then open the target URL in a new window/tab.
//             if (clients.openWindow) {
//                 return clients.openWindow(url);
//             }
//         })
//     );
// })

// messaging.setBackgroundMessageHandler(function (payload) {
//     console.log(payload)
//     let group = JSON.parse(payload.data.group),
//         sender = JSON.parse(payload.data.sender),
//         domain = 'https://api.upload.techres.vn';
//     const notificationTitle = group.name;
//     const notificationOptions = {
//         body: sender.name + ':' + '' + payload.data.body,
//         icon: domain + group.avatar
//     };
//     return self.registration.showNotification(notificationTitle,notificationOptions);
// });


// messaging.setBackgroundMessageHandler(function(payload) {
//     console.log(
//         "[firebase-messaging-sw.js] Received background message ",
//         payload,
//     );
//     const notificationTitle = "Background Message Title";
//     const notificationOptions = {
//         body: "Background Message body.",
//         icon: "/itwonders-web-logo.png",
//     };
//     return self.registration.showNotification(
//         notificationTitle,
//         notificationOptions,
//     );
// });
//
// onBackgroundMessage(messaging, (payload) => {
//     console.log('[firebase-messaging-sw.js] Received background message ', payload);
//
//     if (!(self.Notification && self.Notification.permission === 'granted')) {
//         return;
//     }
//
//     self.registration.showNotification(payload.data.title, {
//         body: payload.data.body,
//         icon: '/pwa/icon-512x512.png',
//         badge: '/favicon.ico',
//         tag: 'renotify',
//         renotify: true,
//         //actions: [{action: 'google', url: "https://www.google.fr"}]
//     })
//         .then(() => self.registration.getNotifications())
//         .then(notifications => {
//             setTimeout(() => notifications.forEach(notification => notification.close()), 3000);
//         });
// });
messaging.setBackgroundMessageHandler(function(payload) {
    const notificationTitle = 'Data Message Title';
    const notificationOptions = {
        body: 'Data Message body',
        icon: 'alarm.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});


