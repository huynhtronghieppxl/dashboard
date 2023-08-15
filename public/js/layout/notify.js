// let lengthNotifyHeader = 0, positionNotifyHeader = '', checkLoadingNotifyHeader = 0;
//
// $(function () {
//     countNotifyHeader();
//     $('#list-notify-header').scroll(function () {
//         if (lengthNotifyHeader === 5) {
//             if ($(this).scrollTop() + $(this).innerHeight() + 5 >= $(this)[0].scrollHeight) {
//                 loadNotifyHeader();
//             }
//         }
//     });
//     $('#header-notify-hidden a').on('click', function () {
//         if ($('#list-notify-header').html() === '' && !($('#header-notify-hidden .dropdowns').hasClass('active'))) {
//             loadNotifyHeader();
//         }
//     });
// })
//
// async function checkNotifyHeader() {
//     if (getCookieShared('count-notify-header') !== undefined) {
//         $('#count-notify-not-seen-header').text(getCookieShared('count-notify-header'));
//         $('#list-notify-header').html(JSON.parse(getCookieShared('list-notify-header')));
//         lengthNotifyHeader = getCookieShared('length-notify-header');
//         positionNotifyHeader = getCookieShared('position-notify-header');
//     } else {
//         saveCookieShared('position-notify-header', 1);
//         loadNotifyHeader();
//     }
// }
//
// /**
//  * Đếm số lượng thông báo tin nhắn mới
//  */
// async function countNotifyHeader() {
//     if(getCookieShared('notify-message-id-' + idSession) === undefined){
//         let method = 'get',
//             url = 'count-notify-header',
//             params = null,
//             data = null;
//         let res = await axiosTemplate(method, url, params, data);
//         /**
//          * Kiểm tra ẩn hiện số lượng thông báo mới
//          */
//         if(res.data[0] >= 1){
//             $('#count-notify-not-seen-header').removeClass('d-none');
//         }
//         else {
//             $('#count-notify-not-seen-header').addClass('d-none');
//         }
//         if(res.data[0] >= 99) res.data[0] = '99+';
//         $('#count-notify-not-seen-header').text(res.data[0]);
//         /**
//          * Kiểm tra ẩn hiện số lượng tin nhắn mới
//          */
//         if(res.data[1].message_not_seen_all <= 0){
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').addClass('d-none');
//             faviconMessage.badge('');
//             res.data[1].message_not_seen_all = 0;
//         }
//         else {
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').removeClass('d-none');
//             faviconMessage.badge(res.data[1].message_not_seen_all);
//         }
//         if(res.data[1].message_not_seen_all >= 99) {
//             res.data[1].message_not_seen_all = 99;
//             faviconMessage.badge(99);
//         }
//         $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(res.data[1].message_not_seen_all);
//         saveCookieShared('notify-message-id-' + idSession , res.data[1].message_not_seen_all);
//         /**
//          * Kiểm tra ẩn hiện số lượng tin nhắn mới mục Công ty
//          */
//         let numberCountmessageRestaurant = res.data[1].message_not_seen_group + res.data[1].message_not_seen_personal + res.data[1].message_not_seen_two_personal;
//         $('#number-count-message-not-seen-restaurant').text(numberCountmessageRestaurant);
//         if(numberCountmessageRestaurant >= 1){
//             $('#set-number-count-message-not-seen-restaurant').removeClass('d-none');
//         }
//         else {
//             $('#set-number-count-message-not-seen-restaurant').addClass('d-none');
//         }
//         /**
//          * Kiểm tra ẩn hiện số lượng tin nhắn mới mục nhà cung cấp
//          */
//         let numberCountmessageSupplier = res.data[1].message_not_seen_tms_supplier;
//         $('#number-count-message-not-seen-supplier').text(numberCountmessageSupplier);
//         if(numberCountmessageSupplier >= 1){
//             $('#set-number-count-message-not-seen-supplier').removeClass('d-none');
//         }
//         else {
//             $('#set-number-count-message-not-seen-supplier').addClass('d-none');
//         }
//         (res.data.data > 0) ? $('#count-notify-not-seen-header').removeClass('d-none') : $('#count-notify-not-seen-header').addClass('d-none');
//         (res.data.data > 99) ? $('#count-notify-not-seen-header').text('99+') : $('#count-notify-not-seen-header').text(res.data[0]);
//     }else {
//         if(getCookieShared('notify-message-id-' + idSession) <= 0){
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').addClass('d-none');
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(0);
//             faviconMessage.badge('');
//         }else {
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').removeClass('d-none');
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text(getCookieShared('notify-message-id-' + idSession));
//             faviconMessage.badge(getCookieShared('notify-message-id-' + idSession));
//         }
//         if(getCookieShared('notify-message-id-' + idSession) >= 99) {
//             $('.link-input-show-box-list-coversation-message .new-notify-unread-message').text('99');
//             faviconMessage.badge(99);
//         }
//     }
//
// }
//
// async function loadNotifyHeader() {
//     if (checkLoadingNotifyHeader === 1) return false;
//     checkLoadingNotifyHeader = 1;
//     let method = 'get',
//         url = 'notify-header',
//         params = {position: positionNotifyHeader, limit: 5},
//         data = null;
//     let res = await axiosTemplate(method, url, params, data, [$('#list-notify-header')]);
//     await $('#list-notify-header').append(res.data[0]);
//     if (res.data[1] > 0) {
//         positionNotifyHeader = res.data[2].data.list[res.data[2].data.list.length - 1]._id;
//     }
//     lengthNotifyHeader = res.data[1];
//     checkLoadingNotifyHeader = 0;
//     // saveCookieShared('count-notify-header', res.data[2]);
//     // saveCookieShared('length-notify-header', res.data[1]);
//     // if (getCookieShared('position-notify-header') === 1) {
//     //     saveCookieShared('position-notify-header', 1);
//     //     saveCookieShared('list-notify-header', JSON.stringify(res.data[0]));
//     //     positionNotifyHeader = 1;
//     // } else {
//     //     saveCookieShared('position-notify-header', removeformatNumber(getCookieShared('position-notify-header')) + 1);
//     //     saveCookieShared('list-notify-header', (getCookieShared('list-notify-header') + JSON.stringify(res.data[0])).replace('undefined', ''));
//     //     positionNotifyHeader = removeformatNumber(getCookieShared('position-notify-header')) + 1;
//     // }
// }
//
// async function onNofityHeader(data) {
//     let icon = '';
//     switch (data.data.type) {
//         case 1: // tài khoản
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-user"></i>';
//             break;
//         case 2: // công việc
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-wpforms"></i>';
//             break;
//         case 3: // tin tức
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-newspaper-o"></i>';
//             break;
//         case 6: // đơn nghỉ phép
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-mail-reply"></i>';
//             break;
//         case 7: // sinh nhật
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-birthday-cake"></i>';
//             break;
//         case 8: // thông báo
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-bell"></i>';
//             break;
//         case 10: // kaizen
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-certificate"></i>';
//             break;
//         case 11: // điểm khách hàng
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-venus-double"></i>';
//             break;
//         case 12: // bảng lương
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-credit-card"></i>';
//             break;
//         case 13: // thưởng phạt
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-retweet"></i>';
//             break;
//         case 14: // ứng lương
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-money"></i>';
//             break;
//         case 15: // đặt bàn
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-info-circle"></i>';
//             break;
//         case 16: // Đặt hàng nhà cung cấp
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-plus-square"></i>';
//             break;
//         case 17: // Quảng cáo
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-television"></i>';
//             break;
//         case 18: // Phiếu mua hàng
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-location-arrow"></i>';
//             break;
//         case 19: // Phiếu yêu cầu thanh toán
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-bell-o"></i>';
//             break;
//         case 20: // Đơn hàng NCC
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-cart-plus"></i>';
//             break;
//         case 21: // Mục tiêu
//             icon = '<i style="color: #0c5460; float: right" class="fa fa-2x fa-bar-chart-o"></i>';
//             break;
//         default:
//             return false;
//     }
//     $('#count-notify-not-seen-header').find('li.default-notify').remove();
//     let item = '<li style="background-color: #d2d2d2">' + '<div class="media">' + '<img class="d-flex align-self-center img-radius" src="' + $('#domain-ads-template').val() + JSON.parse(data.data.sender).avatar + '"alt="avatar">' + '<div class="media-body">' + '<h5 class="notification-user">' + JSON.parse(data.data.sender).name + icon + '</h5>' + '<p class="notification-msg">' + data.data.title + '</p>' + '<span class="notification-time">' + moment().format('hh:mm DD/MM/YYYY') + '</span>' + '</div>' + '</div>' + '</li>';
//     $('#count-notify-not-seen-header').text(removeformatNumber($('#count-notify-not-seen-header').text()) + 1);
//     $('#list-notify-header').append(item);
//     // saveCookieShared('count-notify-header', removeformatNumber(getCookieShared('list-notify-header')) + 1);
//     // saveCookieShared('list-notify-header', (getCookieShared('list-notify-header') + JSON.stringify(item)).replace('undefined', ''));
// }
//
//
async function logoutFunction() {
    // let url = '/push-token-logout',
    //     method = 'post',
    //     params = null,
    //     data = null;
    // let res = await axiosTemplate(method, url, params,data,[]);
    // let text = '';
    // switch(res.data.status) {
    //     case 200:
    //         text = $('#success-delete-data-to-server').text();
            location.href = 'logout';
            firebase.auth().signOut();
            deleteCookieShared('config-firebase');
            deleteCookieShared('tab-active-'+idSession )
    //         break;
    //     case 500:
    //         text = $('#error-post-data-to-server').text();
    //         if (res.data.message !== null) {
    //             text = res.data.message;
    //         }
    //         ErrorNotify(text);
    //         break;
    //     default:
    //         text = $('#error-post-data-to-server').text();
    //         if (res.data.message !== null) {
    //             text = res.data.message;
    //         }
    //         WarningNotify(text);
    // }
    location.href = 'logout';
}
