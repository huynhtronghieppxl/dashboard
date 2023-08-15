// messaging.onMessage(function (payload) {
//     console.log('Message received. ', payload);
//     let group = JSON.parse(payload.data.group),
//         sender = JSON.parse(payload.data.sender),
//         domain = JSON.parse(payload.data.domain);
//     const notificationTitle = group.name;
//     const notificationOptions = {
//         body: sender.name + ':' + '' + payload.data.body,
//         icon: domain + group.avatar
//     };
//
//     if (!("Notification" in window)) {
//         console.log("This browser does not support system notifications");
//     }
//     // Let's check whether notification permissions have already been granted
//     else {
//         if (Notification.permission === "granted") {
//             // If it's okay let's create a notification
//             try {
//                 var notification = new Notification(notificationTitle, notificationOptions);
//                 notification.onclick = function (event) {
//                     event.preventDefault(); //prevent the browser from focusing the Notification's tab
//                     window.open(payload.data.tag, '_blank');
//                     notification.close();
//                 }
//             } catch (err) {
//                 try { //Need this part as on Android we can only display notifications thru the serviceworker
//                     navigator.serviceWorker.ready.then(function (registration) {
//                         registration.showNotification(notificationTitle, notificationOptions);
//                     });
//                 } catch (err1) {
//                     console.log(err1.message);
//                 }
//             }
//         }
//     }
// });
//
//
// messaging.onMessage((payload) => {
//     // try{
//     //     if(payload.data.type_id != 1){
//     console.log('data', payload);
//     $('#list-notification').prepend('<li style="box-shadow: 0 1px 0 0 rgb(0 0 0 / 20%), 0 6px 8px 0 rgb(0 0 0 / 19%);" class="visit-notification" onclick="openModalDetailNotification()"><div class="media"> <img class="d-flex align-self-center img-radius" src="http://demo.ads.api.techres.vn:3005/public/resource/TMS/AVATAR/1/29/1/2021/3/8-3-2021/image/thumb/Avatar-nguyenthanhdoai-1615190894217.jpeg" alt="Generic placeholder image"> <div class="media-body"> <h5 class="notification-user">' + payload.notification.title + '</h5> <p class="notification-msg">' + payload.notification.body + '</p> <span class="notification-time"></span></div> <label class="label label-danger">Mới</label>  </div> </li>',)
//     const noteTitle = 'tets';
//     const noteOptions = {
//         body: 'hahahah',
//         icon: 'ahahahh',
//     };
//     new Notification(noteTitle, noteOptions);
//     $('#icon-notification').addClass('icon-notification-animation');
//     // }
//     // else{
//     onNotifyFirebaseChat(payload)
//     // }
//     // }catch(err){
//     //     console.log(err)
//     // }
// });
// $('#icon-notification').click(function () {
//     $('#icon-notification').removeClass('icon-notification-animation');
// });
