// // Input not empty sweetalert
// $(function () {
//     $('select[sweetalert-not-empty]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' + $(this).parents().html() + '</div>');
//         $('select[sweetalert-not-empty]').addClass('border-0');
//     });
//     $('input[data-not-icon]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">'
//             + $(this).parents().html() +
//             '</div>');
//         $('input[data-not-icon]').addClass('border-0');
//         $('input[data-not-icon]').addClass('w-100');
//     });
//     $('input[data-not-empty]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group  p-1">' + $(this).parents().html() + '</div>');
//         $('input[data-not-empty]').addClass('border-0');
//         $('input[data-not-empty]').addClass('w-100');
//     });
//     $('input[customer-not-empty]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted">' +
//             '       <i class="ti-text" style="font-size: 17px"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[customer-not-empty]').addClass('border-valid');
//         $('input[customer-not-empty]').addClass('w-100');
//     });
//     $('input[data-validate=code]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="ion-pound" style="font-size: 16px"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=code]').addClass('border-valid');
//         $('input[data-validate=code]').addClass('w-100');
//     });
//     $('input[data-validate-number]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group  py-1">' + $(this).parents().html() + '</div>');
//         $('input[data-validate-number]').addClass('border-0');
//         $('input[data-validate-number]').addClass('w-100');
//     })
//
//     $('input[data-validate=phone-required]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <div class="dropdown">' +
//             '       <button class="p-0" type="button" style="border: none;" id="button-phone-required" data-check="vn" data-flag="Việt Nam" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
//             '           <img src="files/assets/images/validate/vietnam.png" id="flag-vn" width="35" height="25" style="border-radius: 5px;">' +
//             '       </button>' +
//             '       <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="select-flag-phone-required" style="min-width: 0">' +
//             '           <li class="dropdown-item">' +
//             '               <img src="files/assets/images/validate/vietnam.png" data-check="vn" data-flag="Việt Nam" id="flag-vn" width="20" height="15">' +
//             '           </li>' +
//             '           <li class="dropdown-item">' +
//             '               <img src="files/assets/images/validate/usa.png" data-check="usa" data-flag="Hoa Kỳ" id="flag-us" width="20" height="15">' +
//             '           </li>' +
//             '       </ul>' +
//             '   </div>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=phone-required]').addClass('border-0');
//         $('input[data-validate=phone-required]').addClass('w-100');
//         // $('input[data-validate=phone-required]').addClass('text-right');
//     });
//     // $('input[data-validate=discount-required]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' +
//     //         '   <div class="dropdown">' +
//     //         '       <button class="p-0" type="button" style="border: none;" id="button-discount-required" data-check="0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
//     //         '           <label>%</label>' +
//     //         '       </button>' +
//     //         '       <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="select-discount-required" style="min-width: 0">' +
//     //         '           <li class="dropdown-item">' +
//     //         '               <label data-check="0">%</label>' +
//     //         '           </li>' +
//     //         '           <li class="dropdown-item">' +
//     //         '               <label data-check="1">VNĐ</label>' +
//     //         '           </li>' +
//     //         '       </ul>' +
//     //         '   </div>' + $(this).parents().html() +
//     //         '</div>');
//     //     $('input[data-validate=discount-required]').addClass('border-0');
//     //     $('input[data-validate=discount-required]').addClass('w-100');
//     //     $('input[data-validate=discount-required]').addClass('text-right');
//     // });
//     $('input[data-validate=phone-not-required]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <div class="dropdown">' +
//             '       <button class="p-0" type="button" style="border: none;" id="button-phone-required" data-check="vn" data-flag="Việt Nam" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
//             '           <img src="files/assets/images/validate/vietnam.png" id="flag-vn" width="35" height="25" style="border-radius: 3px;">' +
//             '       </button>' +
//             '       <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="select-flag-phone-required" style="min-width: 0">' +
//             '           <li class="dropdown-item">' +
//             '               <img src="files/assets/images/validate/vietnam.png" data-check="vn" data-flag="Việt Nam" id="flag-vn" width="20" height="15">' +
//             '           </li>' +
//             '           <li class="dropdown-item">' +
//             '               <img src="files/assets/images/validate/usa.png" data-check="usa" data-flag="Hoa Kỳ" id="flag-us" width="20" height="15">' +
//             '           </li>' +
//             '       </ul>' +
//             '   </div>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=phone-not-required]').addClass('border-0');
//         $('input[data-validate=phone-not-required]').addClass('w-100');
//     });
//     $('input[data-validate=mail]').each(function (i, v) {
//         if($(this).attr('data-mail') === undefined){
//             $(this).parent().html('' +
//                 '<div class="input-group">' +
//                 '   <label class="input-add-icon text-muted ">' +
//                 '       <i class="fa fa-envelope" style="font-size: 17px;"></i>' +
//                 '   </label>' + $(this).parents().html() +
//                 '</div>');
//             $('input[data-validate=mail]').addClass('border-valid');
//             $('input[data-validate=mail]').addClass('w-100');
//         }
//     });
//     // $('textarea[data-validate=note]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' + $(this).parents().html() + '</div>');
//     //     $('textarea[data-validate=note]').addClass('border-0');
//     //     $('textarea[data-validate=note]').addClass('w-100');
//     // });
//     $('input[data-validate=passport]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-credit-card" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=passport]').addClass('border-valid');
//         $('input[data-validate=passport]').addClass('w-100');
//     });
//     $('input[data-validate=username]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-user" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=username]').addClass('border-valid');
//         $('input[data-validate=username]').addClass('w-100');
//     });
//     // $('input[data-validate=calendar]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' +
//     //         '   <label class="input-add-icon text-muted ">' +
//     //         '       <i class="fa fa-calendar-check-o" style="font-size: 17px;"></i>' +
//     //         '   </label>' + $(this).parents().html() +
//     //         '</div>');
//     //     $('input[data-validate=calendar]').addClass('border-valid');
//     //     $('input[data-validate=calendar]').addClass('w-100');
//     //     $('input[data-validate=calendar]').attr('maxlength', '10');
//     // });
//     $('input[check-day]').each(function (i, v) {
//         $(this).parent().html('<div class="input-group ">' + $(this).parents().html() + '</div>');
//         $('input[check-day]').addClass('w-100');
//     })
//     $('input[check-month]').each(function (i, v) {
//         $(this).parent().html('<div class="input-group ">' + $(this).parents().html() + '</div>');
//         $('input[check-month]').addClass('w-100');
//     });
//     $('input[data-validate=birthday-place]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-globe" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=birthday-place]').addClass('border-valid');
//         $('input[data-validate=birthday-place]').addClass('w-100');
//     });
//     $('input[data-validate=address]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="typcn typcn-location" style="font-size: 18px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=address]').addClass('border-valid');
//         $('input[data-validate=address]').addClass('w-100');
//     })
//     // $('input[data-validate=percent]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' +
//     //         '   <label class="input-add-icon text-muted ">' +
//     //         '       <i class="fa fa-percent px-1" style="font-size: 12px;"></i>' +
//     //         '   </label>' + $(this).parents().html() +
//     //         '</div>');
//     //     $('input[data-validate=percent]').addClass('border-valid');
//     //     $('input[data-validate=percent]').addClass('w-100');
//     // })
//     $('input[data-validate-time]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="mb-0 my-auto px-2 text-muted ">' +
//             '       <i class="ti-alarm-clock" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate-time]').addClass('border-valid');
//         $('input[data-validate-time]').addClass('w-100');
//     })
//     $('input[data-validate=price]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted">' +
//             '       <i class="fa fa-money" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=price]').addClass('border-valid');
//         $('input[data-validate=price]').addClass('text-right');
//         $('input[data-validate=price]').addClass('w-100');
//     })
//     $('input[data-validate=price-not-required]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-money" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=price-not-required]').addClass('border-valid');
//         $('input[data-validate=price-not-required]').addClass('text-right');
//         $('input[data-validate=price-not-required]').addClass('w-100');
//     })
//     $('input[price-min-max]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-money" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[price-min-max]').addClass('border-valid');
//         $('input[price-min-max]').addClass('text-right');
//     })
//     $('input[data-validate=Count]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-sort px-1" style="font-size: 14px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=Count]').addClass('border-valid');
//         $('input[data-validate=Count]').addClass('w-100');
//     })
//     $('select[select-not-icon]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' + $(this).parents().html() + '</div>');
//         $('select[select-not-icon]').addClass('border-0');
//         $('select[select-not-icon]').addClass('w-100');
//     })
//     $('input[data-validate=search-customer]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' + $(this).parents().html() + '</div>');
//         $('input[data-validate=search-customer]').addClass('custom-form-search');
//     })
//     $('input[data-validate=phone-required-vn-check]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' + $(this).parents().html() + '</div>');
//         $('input[data-validate=phone-required-vn-check]').addClass('custom-form-search');
//     })
//     // $('input[data-validate=search]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' + $(this).parents().html() + '</div>');
//     //     $('input[data-validate=search]').parent().find('span').addClass('custom-find');
//     //     $('input[data-validate=search]').addClass('custom-form-search');
//     //     $('input[data-validate=search]').parent().find('button').addClass('custom-button-search');
//     // })
//     // $('input[data-validate=website]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' +
//     //         '   <label class="input-add-icon text-muted ">' +
//     //         '       <i class="fa fa-desktop" style="font-size: 17px;"></i>' +
//     //         '   </label>' + $(this).parents().html() +
//     //         '</div>');
//     //     $('input[data-validate=website]').addClass('border-valid');
//     //     $('input[data-validate=website]').addClass('w-100');
//     // })
//     $('input[data-validate=facebook]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted">' +
//             '       <i class="fa fa-facebook px-1" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=facebook]').addClass('border-valid');
//         $('input[data-validate=facebook]').addClass('w-100');
//     })
//     $('input[data-validate=address-ip]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="ti-map-alt" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=address-ip]').addClass('border-valid');
//         $('input[data-validate=address-ip]').addClass('w-100');
//     })
//     $('input[data-validate=printer-port]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-sitemap" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=printer-port]').addClass('border-valid');
//         $('input[data-validate=printer-port]').addClass('w-100');
//     })
//     $('input[data-validate=printer-name]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="ti-printer" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=printer-name]').addClass('border-valid');
//         $('input[data-validate=printer-name]').addClass('w-100');
//     })
//     // $('input[data-validate=table]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' + $(this).parents().html() + '</div>');
//     //     $('input[data-validate=table]').addClass('border-valid');
//     //     $('input[data-validate=table]').addClass('w-100');
//     // })
//     $('input[data-time]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="ti-alarm-clock" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-time]').addClass('border-valid');
//         $('input[data-time]').addClass('w-100');
//     });
//     $('input[data-code]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-barcode" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-code]').addClass('border-valid');
//         $('input[data-code]').addClass('w-100');
//     })
//     // $('input[data-phone]').each(function (i, v) {
//     //     $(this).parent().html('' +
//     //         '<div class="input-group ">' +
//     //         '   <label class="input-add-icon text-muted ">' +
//     //         '       <i class="fa fa-phone" style="font-size: 17px;"></i>' +
//     //         '   </label>' + $(this).parents().html() +
//     //         '</div>');
//     //     $('input[data-phone]').addClass('border-valid');
//     //     $('input[data-phone]').addClass('w-100');
//     // });
//     $('input[data-validate=amount-people]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="fa fa-user px-1" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[data-validate=amount-people]').addClass('border-valid');
//         $('input[data-validate=amount-people]').addClass('w-100');
//     });
//     $('input[time-24]').each(function (i, v) {
//         $(this).parent().html('' +
//             '<div class="input-group ">' +
//             '   <label class="input-add-icon text-muted ">' +
//             '       <i class="ti-alarm-clock" style="font-size: 17px;"></i>' +
//             '   </label>' + $(this).parents().html() +
//             '</div>');
//         $('input[time-24]').addClass('border-valid');
//         $('input[time-24]').addClass('w-100');
//     });
//
// })
//
// //====================================== CHECK VALIDATE FORM ===========================================
//
// // Kiểm tra không được để trống
// function checkEmptyTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-not-empty]').each(function (index, el) {
//         let name = $(this).parent().parent().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             console.log($(this).val())
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkEmptyTableTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-table-not-empty]').each(function (index, el) {
//         removeSpan($(this))
//         if ($(this).val() === '' || $(this).val() === null) {
//             addSpanDatatable($(this), "Không được để trống ");
//             $(this).addClass('error-valid');
//             $(this).parent().find('span').attr("style", "right: 11rem;");
//             flag = false;
//         }
//     });
//     return flag;
// }
//
//
// // Kiểm tra khách hàng không được để trống
// function checkCustomerEmptyTemplate(id) {
//     let flag = true;
//     $(id).find('input[customer-not-empty]').each(function (index, el) {
//         let name = $(this).parent().parent().parent().children().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// // Kiểm tra ngày ( lịch )
// function checkCalendarTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-validate=calendar]').each(function (index, el) {
//         let name = $(this).parent().parent().parent().children().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// // // Kiểm tra khách hàng
// // function checkCustomerTemplate(id, name, phone) {
// //     let flag = true;
// //     $(id).parent().parent().children('span').remove()
// //
// //     if (phone !== '' && name === '') {
// //         $(id).parent().parent().prepend('<span class="notify-valid text-center" id="add-error-span" >Vui lòng chọn nút tìm kiếm!</span>')
// //         $(id).parent().addClass('error-valid');
// //         flag = false;
// //     } else if (phone === '') {
// //         $(id).parent().parent().prepend('<span class="notify-valid text-center" id="add-error-span">Vui lòng nhập số để tìm kiếm khách hàng</span>')
// //         $(id).parent().addClass('error-valid');
// //         flag = false;
// //     }
// //
// //     return flag;
// // }
//
// // check require phone when search
// function checkPhoneInSearchTemplate(id, phone) {
//     let flag = true;
//     $(id).parent().parent().children('span').remove()
//
//     if (phone === '') {
//         $(id).parent().parent().prepend('<span class="notify-valid text-center" id="add-error-span">Vui lòng nhập số!</span>')
//         $(id).parent().addClass('error-valid');
//         flag = false;
//     }
//
//     return flag;
// }
//
// // Kiểm tra nội dung ghi chú
// function checkDesTemplate(id) {
//     let flag = true;
//     $(id).find('textarea[data-validate=note]').each(function (index, el) {
//         let des = $(this).parent().parent().parent().children().find('textarea').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + des);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// // Kiểm tra thời gian không được để trống
// function checkTimeTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-validate-time]').each(function (index, el) {
//         let name = $(this).parent().parent().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
//
// function checkTimeEmptyTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-time]').each(function (index, el) {
//         let name = $(this).parent().parent().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkPercentTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-validate=percent]').each(function (index, el) {
//         let name = $(this).parent().parent().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         } else if ($(this).val() <= 1000) {
//             addSpan($(this), name + "Số tiền phải lớn hơn 1000");
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkPriceTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-validate=price]').each(function (index, el) {
//         let name = $(this).parent().parent().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         } else if ($(this).val() <= 1000) {
//             addSpan($(this), name + "Số tiền phải lớn hơn 1000");
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkPriceMinMaxTemplate(id) {
//     let flag = true;
//     $(id).find('input[price-min-max]').each(function (index, el) {
//         removeSpan($(this))
//         let name = $(this).parent().parent().find('label').text();
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         } else if ($(this).val() < 1000) {
//             addSpan($(this), name + "Số tiền phải lớn hơn 1,000");
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         } else if ($(this).val() > 99999999) {
//             addSpan($(this), name + "Số tiền phải nhỏ hơn 99,999,999");
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkNumberTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-validate-number]').each(function (index, el) {
//         let name = $(this).parent().parent().parent().children().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//
//     return flag;
// }
//
// function checkNumber2Template(id) {
//     let flag = true;
//     $(id).find('input[data-validate-day]').each(function (index, el) {
//         let name = $(this).parent().parent().parent().children().find('label').text();
//         removeSpan($(this))
//         if ($(this).val() <= 0) {
//             addSpan($(this), "Phải lớn hơn 0");
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkPhoneTemplate(id) {
//     let flag = true;
//     $(id).find('input[data-validate=phone-required]').each(function (index, el) {
//         let name = $(this).parent().parent().parent().children().find('label').text();
//         removeSpan($(this));
//         let rePhone = /^(09|03|07|08|05).*$/;
//         if ($(this).val() === '') {
//             addSpan($(this), "Không được để trống " + name);
//             $(this).parent().addClass('error-valid');
//             flag = false;
//         } else if ($(this).val().length === 10 && $(this).val().substring(0, 2).match(rePhone)) {
//             $(this).parent().removeClass('error-valid');
//             $(this).parent().removeClass('warning-valid');
//             $(this).parent().addClass('focus-valid');
//             removeSpan($(this));
//         } else if ($(this).val().length !== 10) {
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Số điện thoại chưa đúng 10 số!');
//             flag = false;
//         } else {
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Đầu số không đúng định dạng!');
//             flag = false;
//         }
//     });
//     return flag;
// }
//
// function checkSelectTemplate(id) {
//     let flag = true;
//     $(id).find('select[data-select-not-empty]').each(function (index, el) {
//         let name = $(this).parent().parent().find('label').text();
//         $(this).parent().find('.select2').removeClass('error-valid');
//         removeSpanSelect($(this))
//         if ($(this).find('option[disabled]:selected').val() === '' || $(this).find('option[disabled]:selected').val() === null || $(this).find('option[disabled]:selected').val() === '-2') {
//             addSpanSelect($(this), 'Vui lòng chọn ' + name);
//             $(this).parent().find('.select2').addClass('error-valid');
//             flag = false;
//         } else {
//             $(this).parent().find('.select2').removeClass('error-valid');
//             removeSpanSelect($(this));
//             flag == false ? false : true;
//         }
//     });
//     return flag;
// }
//
// function checkMailTemplate(id) {
//     let flag = true;
//     let reMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     let input_email = $(id).find('input[data-validate=mail]');
//     removeSpan($(this));
//     console.log(input_email.val());
//     if (!input_email.val().match(reMail)) {
//         input_email.parent().addClass('error-valid');
//         addSpan(input_email, 'Nhập mail sai cú pháp!');
//         flag = false;
//     }
//     return flag;
// }
//
// //============================================= ADD TEXT ================================================
//
// // Icon Input
// function addIconText(el) {
//     let input = el.parent().html();
//     let icon = '' +
//         '<div class="input-group ">' +
//         '   <label class="px-2 mt-2 mb-1 text-muted"><i class=" fa fa-user pr-2" style="width:1rem;font-size: 16px; border-right:1px solid rgba(0, 0, 0, .15)"></i></label>' + input +
//         '</div>';
//     el.parent().html(icon);
//     $('#' + el.attr('id')).addClass('border-0');
// }
//
// // Add span
// function addSpan(el, text) {
//     el.parent().parent().prepend('<span class="notify-valid text-center" id="add-error-span">' + text + '</span>');
// }
//
// // Add Span Select
// function addSpanSelect(el, text) {
//     el.parent().prepend('<span class="notify-valid text-center" id="add-error-span">' + text + '</span>');
//
// }
//
// // Add span datatable
// function addSpanDatatable(el, text) {
//     el.parent().prepend('<span class="notify-valid-bottom text-center" id="add-error-span-data">' + text + '</span>');
// }
//
// //  Add Position
// function addPosition(el) {
//     el.parent().addClass('positionRelative');
// }
//
// // Remove Span Select
// function removeSpanSelect(el) {
//     el.parent().find('#add-error-span').remove();
// }
//
// // Remove tag span
// function removeSpan(el) {
//     el.closest('div').parent().children('span').remove();
// }
//
// // Remove span draw data
// function removeSpanDatatable(el) {
//     el.parent().find("#add-error-span-data").remove();
// }
//
// // Remove Position
// function removePosition(el) {
//     el.parent().removeClass('positionRelative');
// }
//
//
// // // Remove All Validate
// // function removeAllValidate() {
// //     if(!$(this).attr('data-valida === undefinedte')){
// //             $('select').prop('selectIndex', 0);
// //             $('select').parent().find('.select2').removeClass('error-valid');
// //             $('input').parent().removeClass('error-valid');
// //             $('input').parent().removeClass('warning-valid');
// //             $('input').parent().removeClass('focus-valid');
// //             $('textarea').parent().removeClass('error-valid');
// //             $('textarea').parent().removeClass('warning-valid');
// //             $('textarea').parent().removeClass('focus-valid');
// //             $('select').parent().find('.error-valid').removeClass('error-valid');
// //             removeSpan($('input'));
// //             removeSpan($('textarea'));
// //             removeSpanSelect($('select'));
// //     }
// // }
//
// //=========================================== VALIDATE FORM ===============================================
// // Input min length
// $(document).on('input', 'input[data-min-length]', function () {
//        if(!$(this).attr('data-validate') === undefined){
//
//         let length = ($(this).val()).length;
//         removeSpan($(this));
//         if ($(this).val() === '') {
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Không được để trống!');
//         } else if (($(this).val()).length < $(this).attr('data-min-length')) {
//             console.log(($(this).val()).length);
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Nhập tối thiểu là ' + $(this).attr('data-min-length') + ' kí tự');
//         } else {
//             removeSpan($(this))
//             $(this).parent().removeClass('warning-valid');
//             $(this).parent().addClass('focus-valid');
//         }
//     }
// })
// $(document).on('focus', 'input[data-min-length]', function () {
//     if(!$(this).attr('data-validate') === undefined){
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//         if (typeof $(this).attr('data-max-length') !== typeof undefined && $(this).attr('data-max-length') !== false) {
//             addSpan($(this), 'Nhập tối thiểu ' + $(this).attr('data-min-length') + 'kí tự và tối đa ' + $(this).attr('data-max-length') + ' kí tự');
//         } else {
//             addSpan($(this), 'Nhập tối thiểu ' + $(this).attr('data-min-length') + ' kí tự');
//         }
//     }
// })
// $(document).on('focusout', 'input[data-min-length]', function () {
//     if(!$(this).attr('data-validate') === undefined){
//         removeSpan($(this));
//         $(this).parent().removeClass('error-valid');
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//     }
// })
//
// // Input max length
// $(document).on('input', 'input[data-max-length]', function () {
//     if(!$(this).attr('data-validate') === undefined){
//         removeSpan($(this));
//         if (typeof $(this).attr('data-min-length') !== typeof undefined && $(this).attr('data-min-length') !== false) {
//             if ($(this).val().length > $(this).attr('data-max-length')) {
//                 $(this).parent().removeClass('focus-valid');
//                 $(this).parent().addClass('warning-valid');
//                 addSpan($(this), 'Nhập tối đa ' + $(this).attr('data-max-length') + ' kí tự');
//             }
//         } else {
//             if ($(this).val() === '') {
//                 $(this).parent().removeClass('focus-valid');
//                 $(this).parent().addClass('warning-valid');
//                 addSpan($(this), 'Không được để trống!');
//             } else if ($(this).val().length > $(this).attr('data-max-length')) {
//                 $(this).parent().removeClass('focus-valid');
//                 $(this).parent().addClass('warning-valid');
//                 addSpan($(this), 'Nhập tối đa ' + $(this).attr('data-max-length') + ' kí tự');
//             } else {
//                 removeSpan($(this))
//                 $(this).parent().removeClass('warning-valid');
//                 $(this).parent().addClass('focus-valid');
//             }
//         }
//     }
// })
// $(document).on('focus', 'input[data-max-length]', function () {
//        if(!$(this).attr('data-validate') === undefined){
//
//
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//         if (typeof $(this).attr('data-min-length') !== typeof undefined && $(this).attr('data-min-length') !== false) {
//             addSpan($(this), 'Nhập tối thiểu ' + $(this).attr('data-min-length') + 'kí tự và tối đa ' + $(this).attr('data-max-length') + ' kí tự');
//             $(this).parent().parent().find('span').attr("style", "width: 16rem");
//         } else {
//             addSpan($(this), 'Nhập tối đa ' + $(this).attr('data-max-length') + ' kí tự');
//         }
//     }
// })
// $(document).on('focusout', 'input[data-max-length]', function () {
//        if(!$(this).attr('data-validate') === undefined){
//
//         removeSpan($(this));
//         $(this).parent().removeClass('error-valid');
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//     }
// })
//
// //  Select Table
// // $(document).on('change', 'select[data-select-table]', function () {
// //     $("table tr").find("td input").each(function (index, i) {
// //         console.log(i);
// //         // Here you can write the logic for validation
// //     });
// // })
//
// // Select Not Empty
// $('select2').ready(function () {
//     $(document).on('change', 'select[data-select-not-empty]', function () {
//         let name = $(this).parent().parent().find('label').text();
//         if ($(this).val() === '' || $(this).val() === '-2') {
//             $(this).parent().find('.select2').removeClass('focus-valid');
//             addSpanSelect($(this).children(), "Vui lòng chọn " + name);
//             $(this).parent().find('.select2').addClass('error-valid');
//         } else {
//             $(this).parent().find('.select2').removeClass('error-valid');
//             removeSpanSelect($(this));
//         }
//     })
// });
//
// // // Select Multiple
// // $(document).on('click', 'select[data-select-multiple]', function () {
// //     addSpan($(this),'Bạn có thể chọn nhiều tùy chọn cùng một lúc')
// // })
// // $(document).on('focus', 'select[data-select-multiple]', function () {
// //     console.log($(this));
// //     $(this).addClass('focus-valid');
// //     addSpan($(this),'Bạn có thể chọn nhiều tùy chọn cùng một lúc')
// // })
// // $(document).on('focusout', 'select[data-select-multiple]', function () {
// //     removeSpanDatatable($(this));
// //     $(this).parent().removeClass('warning-valid');
// //     $(this).parent().removeClass('focus-valid');
// //     $(this).parent().removeClass('error-valid');
// // })
//
//
// // Input not empty Datatable
// $(document).on('input', 'input[data-table-not-empty]', function () {
//     removeSpan($(this));
//     if ($(this).val() === '') {
//         $(this).addClass('warning-valid');
//         addSpanDatatable($(this), 'Không để để trống')
//         // $(this).parent().find('span').attr("style", "right: 2%");
//         $(this).val(formatNumber($(this).attr('data-table-not-empty')));
//         addPosition($(this));
//         $(this).select();
//     } else {
//         removePosition($(this));
//         $(this).removeClass('warning-valid');
//         removeSpanDatatable($(this));
//     }
// })
// $(document).on('focus', 'input[data-table-not-empty]', function () {
//     $(this).addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-table-not-empty]', function () {
//     removeSpanDatatable($(this));
//     removePosition($(this));
//     $(this).removeClass('warning-valid');
//     $(this).removeClass('focus-valid');
//     $(this).removeClass('error-valid');
// })
//
// $(document).on('input', 'input[sweetalert-not-empty]', function () {
//     removeSpan($(this));
//     if ($(this).val() === '') {
//         $(this).addClass('warning-valid');
//         addSpanDatatable($(this), 'Không để để trống')
//         $(this).parent().find('span').attr("style", "top: 2.8rem !important;right: 1.8rem !important");
//         addPosition($(this));
//         $(this).select();
//     } else {
//         removePosition($(this));
//         $(this).removeClass('warning-valid');
//         removeSpanDatatable($(this));
//     }
// })
// $(document).on('focus', 'input[sweetalert-not-empty]', function () {
//     $(this).addClass('focus-valid');
// })
// $(document).on('focusout', 'input[sweetalert-not-empty]', function () {
//     removeSpanDatatable($(this));
//     removePosition($(this));
//     $(this).removeClass('warning-valid');
//     $(this).removeClass('focus-valid');
//     $(this).removeClass('error-valid');
// })
// $(document).on('input', 'input[data-not-empty]', function () {
//     removeSpan($(this));
//     if ($(this).parents('table').length > 0) {
//         removeSpanDatatable($(this));
//         let table_id = $(this).parents('table').attr('id'),
//             tr_index = this.parentNode.parentNode.rowIndex - 1,
//             td_index = this.parentNode.cellIndex;
//
//         let input = $('#' + table_id + ' > tbody > tr:eq(' + tr_index + ') > td:eq(' + td_index + ' )').find('input');
//
//         if ($(this).val() === '') {
//             addSpanDatatable(input, 'Không được để trống');
//             addPosition(input);
//             input.parent().find('span').attr("style", "right: 2%");
//         } else {
//             removeSpanDatatable($(this));
//             removePosition(input);
//             input.removeClass('warning-valid');
//         }
//     } else {
//         if ($(this).val() === '') {
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Không được bỏ trống');
//         } else {
//             $(this).parent().removeClass('warning-valid');
//             $(this).parent().removeClass('error-valid');
//             $(this).parent().addClass('focus-valid');
//             removeSpan($(this));
//         }
//     }
// })
// $(document).on('focus', 'input[data-not-empty]', function () {
//     if ($(this).parents('table').length === 0) {
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[data-not-empty]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[customer-not-empty]', function () {
//     removeSpan($(this));
//     if ($(this).val() === '') {
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Không được bỏ trống');
//     } else {
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('error-valid');
//         $(this).parent().addClass('focus-valid');
//         removeSpan($(this));
//     }
// })
// $(document).on('focus', 'input[customer-not-empty]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[customer-not-empty]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[data-special-characters]', function () {
//     let pecial_characters = /[^a-zA-Z0-9 ]/g, input_pecial_characters = $(this).val();
//     removeSpan($(this));
//     if ($(this).val() === '') {
//         $(this).addClass('error-valid');
//         $('#add-error-span').text('Không được để trống!');
//     } else if (input_pecial_characters.match(pecial_characters)) {
//         $(this).addClass('error-valid');
//         $('#add-error-span').text('Không được nhập kí tự đặc biệt!');
//     } else {
//         $(this).removeClass('error-valid');
//     }
// })
// $(document).on('focus', 'input[data-special-characters]', function () {
//     addSpan($(this), 'Không được nhập kí tự đặc biệt!');
// })
// $(document).on('focusout', 'input[data-special-characters]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate-number]', function () {
//     let number = removeformatNumber($(this).val());
//     number.toString().match(/[^0-9]/g)
// })
// $(document).on('focus', 'input[data-validate-number]', function () {
//     $(this).parent().addClass('focus-valid');
// });
// $(document).on('focusout', 'input[data-validate-number]', function () {
//     removeSpan($(this));
//     if ($(this).val() === '') {
//         $(this).val('0')
//     }
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// });
// $(document).on('click', '#select-flag-phone-required li', function () {
//     let flag = $(this).children('img').attr('src');
//     let data_check = $(this).children('img').attr('data-check');
//     let data_flag = $(this).children('img').attr('data-flag');
//
//     $('#button-phone-required').children('img').attr("src", flag);
//     $('#button-phone-required').attr("data-check", data_check);
//     $('#button-phone-required').attr("data-flag", data_flag);
//     $('input[data-validate=phone-required]').val('');
// });
//
// // $(document).on('click', '#select-discount-required li', function () {
// //     let data_check = $(this).find('label').data('check');
// //     $('#button-discount-required').attr("data-check", data_check);
// //     $('input[data-validate=discount-required]').val('');
// // });
// $(document).on('input', 'input[data-validate=phone-required]', function () {
//     $(this).val($(this).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));
//     let check1 = $('#button-phone-required').attr("data-check"),
//         rePhone = /^(09|03|07|08|05).*$/;
//     switch (check1) {
//         case 'usa':
//             let input = $(this).val().replace(/[^\d]/g, '');
//             if (input.length <= 3) {
//                 input = input.replace(/(\d{0,3})/, "$1");
//             } else if (input.length < 7) {
//                 input = input.replace(/(\d{0,3})(\d{0,3})/, "($1) $2");
//             } else if (input.length <= 10) {
//                 input = input.replace(/(\d{3})(\d{3})(\d{1,4})/, "($1) $2-$3");
//             } else {
//                 input = input.replace(/(\d{3})(\d{1,3})(\d{1,4})(\d.*)/, "($1) $2-$3");
//             }
//             $(this).val(input)
//             break;
//     }
//
//     if ($(this).val() === '') {
//         removeSpan($(this));
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Số điện thoại không được để trống!');
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//     }
//
//     if (check1 == 'vn') {
//         let length_phone = $(this).val().length;
//
//         if ($(this).val().length < 2 || $(this).val().length >= 2 && $(this).val().substring(0, 2).match(rePhone)) {
//             if ($(this).val().length === 10) {
//                 $(this).parent().removeClass('error-valid');
//                 $(this).parent().removeClass('warning-valid');
//                 $(this).parent().addClass('focus-valid');
//                 removeSpan($(this));
//             } else {
//                 $(this).parent().removeClass('focus-valid');
//                 $(this).parent().addClass('warning-valid');
//                 addSpan($(this), 'Số điện thoại chưa đúng 10 số!');
//             }
//         } else {
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Đầu số không đúng định dạng!');
//         }
//     }
// })
// $(document).on('input paste', 'input[data-validate=phone-required-vn-check]', function () {
//     this.value = this.value.replace(/[^0-9]/g, '');
//
//     let rePhone = /^(09|03|07|08|05).*$/;
//
//     if ($(this).val() === '') {
//         removeSpan($(this));
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Số điện thoại không được để trống!');
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//     }
//
//     if ($(this).val().length < 2 || $(this).val().length >= 2 && $(this).val().substring(0, 2).match(rePhone)) {
//         removeSpan($(this));
//         if ($(this).val().length === 10) {
//             $(this).parent().removeClass('error-valid');
//             $(this).parent().removeClass('warning-valid');
//             $(this).parent().addClass('focus-valid');
//         } else {
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Số điện thoại chưa đúng 10 số!');
//         }
//     } else {
//         removeSpan($(this));
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Đầu số không đúng định dạng!');
//     }
// })
// $(document).on('focus', 'input[data-validate=phone-required]', function () {
//     removeSpan($(this));
//     addSpan($(this), 'Số điện thoại ' + $('#button-phone-required').attr("data-flag") + ' gồm 10 số! ');
//     $(this).parent().addClass('focus-valid');
//
// })
// $(document).on('focusout', 'input[data-validate=phone-required]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('error-valid');
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('click', '#select-flag-phone-required li', function () {
//     let flag = $(this).children('img').attr('src');
//     let data_check = $(this).children('img').attr('data-check');
//     let data_flag = $(this).children('img').attr('data-flag');
//
//     $('#button-phone-required').children('img').attr("src", flag);
//     $('#button-phone-required').attr("data-check", data_check);
//     $('#button-phone-required').attr("data-flag", data_flag);
//     $('input[data-validate=phone-required]').val('');
// });
// $(document).on('click', '#select-flag-phone-not-required li', function () {
//     let flag = $(this).children('img').attr('src');
//     let data_check = $(this).children('img').attr('data-check');
//     let data_flag = $(this).children('img').attr('data-flag');
//
//     $('#button-phone-not-required').children('img').attr("src", flag);
//     $('#button-phone-not-required').attr("data-check", data_check);
//     $('#button-phone-not-required').attr("data-flag", data_flag);
//     $('input[data-validate=phone-not-required]').val('');
// });
// $(document).on('input', 'input[data-validate=phone-not-required]', function () {
//     let check2 = $('#button-phone-not-required').attr("data-check"),
//         rePhone = /^(09|03|07|08|05).*$/;
//     switch (check2) {
//         case 'usa':
//             let input = $(this).val().replace(/[^\d]/g, '');
//             if (input.length <= 3) {
//                 input = input.replace(/(\d{0,3})/, "$1");
//             } else if (input.length < 7) {
//                 input = input.replace(/(\d{0,3})(\d{0,3})/, "($1) $2");
//             } else if (input.length <= 10) {
//                 input = input.replace(/(\d{3})(\d{3})(\d{1,4})/, "($1) $2-$3");
//             } else {
//                 input = input.replace(/(\d{3})(\d{1,3})(\d{1,4})(\d.*)/, "($1) $2-$3");
//             }
//             $(this).val(input)
//             break;
//
//     }
//     if (check2 == 'vn') {
//         if ($(this).val().length < 2 || $(this).val().length >= 2 && $(this).val().substring(0, 2).match(rePhone)) {
//             $(this).removeClass('error-valid');
//         } else {
//             $(this).addClass('error-valid');
//             $('#add-error-span').text('Đầu số không đúng định dạng!');
//         }
//     }
// })
// $(document).on('focus', 'input[data-validate=phone-not-required]', function () {
//     addSpan($(this), 'Số điện thoại ' + $('#button-phone-not-required').attr("data-flag") + ' gồm 10 số! ');
// })
// $(document).on('focusout', 'input[data-validate=phone-not-required]', function () {
//     removeSpan($(this));
//     $(this).removeClass('error-valid');
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate=mail]', function () {
//    if($(this).attr('data-mail') === undefined){
//        let reMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//        let input_email = $(this).val();
//        $(this).parent().removeClass('focus-valid');
//        removeSpan($(this));
//        if (input_email !== '' || input_email !== undefined) {
//            if (!input_email.match(reMail)) {
//                $('input[data-validate=mail]').parent().addClass('warning-valid');
//                addSpan($(this), 'Nhập mail đúng cú pháp!');
//            } else {
//                $(this).parent().removeClass('warning-valid');
//                $(this).parent().removeClass('error-valid');
//                $(this).parent().addClass('focus-valid');
//                removeSpan($(this));
//                $("#btn-save-create").prop('disabled', false)
//
//            }
//        }
//    }
// })
// $(document).on('focus', 'input[data-validate=mail]', function () {
//     if($(this).attr('data-mail') === undefined) {
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[data-validate=mail]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'textarea[data-validate=note]', function () {
//         if($(this).attr('data-note') === undefined) {
//             $(this).parent().addClass('focus-valid');
//         }
// })
// $(document).on('focusout', 'textarea[data-validate=note]', function () {
//     if($(this).attr('data-note') === undefined) {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//     }
// })
//
// $(document).on('input', 'input[data-table-min-length]', function () {
//     removeSpanDatatable($(this))
//     if ($(this).val().length < $(this).attr('data-table-min-length')) {
//         $(this).addClass('warning-valid');
//         removeSpanDatatable($(this))
//         addSpanDatatable($(this), 'Nhập tối thiểu là ' + $(this).attr('data-table-min-length'));
//     } else {
//         removeSpanDatatable($(this))
//         $(this).removeClass('warning-valid');
//     }
// })
//
//
// $(document).on('focus', 'input[data-table-min-length]', function () {
//     $(this).removeClass('warning-valid');
//     $(this).addClass('focus-valid');
//     if (typeof $(this).attr('data-table-max-length') !== typeof undefined && $(this).attr('data-max-length') !== false) {
//         removeSpanDatatable($(this), 'Nhập tối thiểu ' + $(this).attr('data-table-min-length') + ' và tối đa ' + $(this).attr('data-max-length'));
//     } else {
//         removeSpanDatatable($(this), 'Nhập tối thiểu ' + $(this).attr('data-table-min-length'));
//     }
// })
// $(document).on('focusout', 'input[data-table-min-length]', function () {
//     removeSpan($(this));
//     $(this).removeClass('error-valid');
//     $(this).removeClass('warning-valid');
//     $(this).removeClass('focus-valid');
// })
// $(document).on('input', 'input[data-table-max-length]', function () {
//     if (typeof $(this).attr('data-min-length') !== typeof undefined && $(this).attr('data-min-length') !== false) {
//         removeSpanDatatable($(this))
//         if ($(this).val().length > $(this).attr('data-table-max-length')) {
//             $(this).addClass('warning-valid');
//             removeSpanDatatable($(this), 'Nhập tối đa ' + $(this).attr('data-table-max-length'));
//         }
//     } else {
//         if ($(this).val().length > $(this).attr('data-table-max-length')) {
//             $(this).addClass('warning-valid');
//             removeSpan($(this))
//             removeSpanDatatable($(this), 'Nhập tối đa ' + $(this).attr('data-table-max-length'));
//         } else {
//             removeSpan($(this))
//             $(this).removeClass('error-valid');
//         }
//     }
// })
// $(document).on('focus', 'input[data-table-max-length]', function () {
//     $(this).removeClass('warning-valid');
//     $(this).addClass('focus-valid');
//     if (typeof $(this).attr('data-table-min-length') !== typeof undefined && $(this).attr('data-table-min-length') !== false) {
//         removeSpanDatatable($(this), 'Nhập tối thiểu ' + $(this).attr('data-table-min-length') + ' và tối đa ' + $(this).attr('data-table-max-length'));
//     } else {
//         removeSpanDatatable($(this), 'Nhập tối đa ' + $(this).attr('data-table-max-length'));
//     }
// })
//
// $(document).on('focusout', 'input[data-table-max-length]', function () {
//     removeSpan($(this));
//     $(this).removeClass('error-valid');
//     $(this).removeClass('warning-valid');
//     $(this).removeClass('focus-valid');
// })
// $(document).on('input', 'input[data-max-value]', function () {
//     if(!$(this).attr('data-validate')){
//         let value = removeformatNumber($(this).val());
//         let value_attr = formatNumber($(this).attr('data-max-value'));
//         removeSpan($(this))
//         if (value > $(this).attr('data-max-value')) {
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//             addSpan($(this), 'Nhập tối đa ' + value_attr);
//             $(this).val(formatNumber($(this).attr('data-max-value')));
//         } else {
//             $(this).parent().removeClass('warning-valid');
//             $(this).parent().addClass('focus-valid');
//             removeSpan($(this))
//         }
//     }
//
// })
// $(document).on('focus', 'input[data-max-value]', function () {
//     if(!$(this).attr('data-validate')) {
//         let value_attr = formatNumber($(this).attr('data-max-value'));
//         removeSpan($(this));
//         addSpan($(this), 'Nhập tối đa ' + value_attr);
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[data-max-value]', function () {
//     if(!$(this).attr('data-validate')) {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//     }
// })
// $(document).on('input', 'input[data-table]', async function () {
//     if(!$(this).attr('data-validate')) {
//         removeSpanDatatable($(this));
//         let table_id = $(this).parents('table').attr('id'),
//             tr_index = this.parentNode.parentNode.rowIndex - 1,
//             td_index = this.parentNode.cellIndex,
//             td_value = removeformatNumber($(this).val()),
//             value_attr = $(this).attr('data-table');
//
//         let input = $('#' + table_id + ' > tbody > tr:eq(' + tr_index + ') > td:eq(' + td_index + ' )').find('input');
//
//         if (td_value > value_attr) {
//             addSpanDatatable(input, 'Nhập tối đa là ' + formatNumber(value_attr));
//             addPosition(input);
//             input.parent().find('span').attr("style", "right: 2%");
//             input.addClass('warning-valid');
//             $(this).val(formatNumber($(this).attr('data-table')));
//         }
//         if ($(this).val() === '') {
//             addSpanDatatable(input, 'Không được để trống');
//             addPosition(input);
//             input.addClass('warning-valid');
//             input.parent().find('span').attr("style", "right: 2%");
//         } else if ($(this).val() < 0) {
//             addSpanDatatable(input, 'Nhập tối thiểu lớn hơn 0');
//             addPosition(input);
//             input.parent().find('span').attr("style", "right: 2%");
//         } else {
//             removeSpanDatatable($(this));
//             removePosition(input);
//             input.removeClass('warning-valid');
//         }
//     }
// })
// $(document).on('click', 'input[data-table]', function () {
//     if(!$(this).attr('data-validate')) {
//
//         let table_id = $(this).parents('table').attr('id'),
//             tr_index = this.parentNode.parentNode.rowIndex - 1,
//             td_index = this.parentNode.cellIndex,
//             input = $('#' + table_id + ' > tbody > tr:eq(' + tr_index + ') > td:eq(' + td_index + ' )').find('input');
//         if ($(this).val() === '') {
//             addSpanDatatable(input, 'Không được để trống');
//             addPosition(input);
//             input.parent().find('span').attr("style", "right: 2%");
//             input.addClass('warning-valid');
//         } else {
//             removeSpanDatatable($(this));
//             removePosition(input);
//             input.removeClass('warning-valid');
//         }
//     }
// })
// $(document).on('focusout', 'input[data-table]', function () {
//     removeSpanDatatable($(this));
//     removePosition($(this));
//     $(this).removeClass('warning-valid');
//     $(this).removeClass('focus-valid');
//     $(this).removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate=passport]', function () {
//     let rePassPort = /[^A-Z0-90-9]+$/g;
//     let lengthPassport = 20;
//     removeSpan($(this))
//     if ($(this).val().match(rePassPort)) {
//         removeSpan($(this));
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Nhập tối thiểu 1 chữ và 20 số');
//     } else if ($(this).val().length > lengthPassport) {
//         removeSpan($(this));
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Nhập tối đa 20 kí tự');
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('error-valid');
//         $(this).parent().addClass('focus-valid');
//         $('#btn-save-create').prop('disabled', false);
//     }
// })
// $(document).on('focus', 'input[data-validate=passport]', function () {
//     $(this).parent().addClass('focus-valid');
//     // $(this).parent().parent().find('span').attr("style", "width: 16rem");
// })
// $(document).on('focusout', 'input[data-validate=passport]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// // $(document).on('focus', 'input[data-validate=calendar]', function () {
// //     $(this).parent().addClass('focus-valid');
// // })
// // $(document).on('focusout', 'input[data-validate=calendar]', function () {
// //     removeSpan($(this));
// //     $(this).parent().removeClass('warning-valid');
// //     $(this).parent().removeClass('focus-valid');
// //     $(this).parent().removeClass('error-valid');
// // })
// $(document).on('input', 'input[check-day]', function () {
//     removeSpan($(this));
//     if ($(this).val() > 31) {
//         addSpan($(this), 'Số ngày không được vượt quá 31 ngày');
//         $(this).parent().removeClass('warning-valid');
//         $(this).val(31)
//     } else if ($(this).val() < 1) {
//         addSpan($(this), 'Số ngày không được nhở hơn 1 ngày');
//         $(this).parent().removeClass('warning-valid');
//         $(this).val(1)
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// });
// $(document).on('focus', 'input[check-day]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[check-day]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[check-month]', function () {
//     removeSpan($(this));
//     if ($(this).val() > 12) {
//         addSpan($(this), 'Số tháng không được vượt quá 12 tháng');
//         $(this).parent().removeClass('warning-valid');
//         $(this).val(12)
//     } else if ($(this).val() < 1) {
//         addSpan($(this), 'Số tháng không được nhỏ hơn 1 tháng');
//         $(this).parent().removeClass('warning-valid');
//         $(this).val(1)
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// });
// $(document).on('focus', 'input[check-month]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[check-month]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate=birthday-place]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=birthday-place]', function () {
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
//     removeSpan($(this));
// })
// $(document).on('focus', 'input[data-validate=address]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=address]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// // $(document).on('input', 'input[data-validate=percent]', function () {
// //     if ($(this).val() === '') {
// //         addSpan($(this), 'Phần trăm tối thiểu 0')
// //         $(this).parent().removeClass('focus-valid');
// //         $(this).parent().addClass('warning-valid');
// //     } else if (removeformatNumber($(this).val()) >= 100) {
// //         addSpan($(this), 'Phần trăm tối đa 100')
// //         $(this).val('100');
// //     } else {
// //         removeSpan($(this));
// //         $(this).parent().removeClass('warning-valid');
// //         $(this).parent().addClass('focus-valid');
// //     }
// // })
// $(document).on('click', 'input[data-validate=percent]', function () {
//     if(!$(this).attr('data-percent')) {
//
//         if ($(this).val() === '0') {
//             $(this).val('');
//         }
//     }
// })
// $(document).on('focus', 'input[data-validate=percent]', function () {
//     if(!$(this).attr('data-percent')) {
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[data-validate=percent]', function () {
//     if(!$(this).attr('data-percent')) {
//         if ($(this).val() === '') {
//             $(this).val('0')
//         }
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//     }
// })
// $(document).on('input', 'input[percent-not-icon]', function () {
//     removeSpan($(this));
//     if ($(this).val() < 0) {
//         addSpan($(this), 'Phần trăm tối thiểu là 0%')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(0);
//     } else if (removeformatNumber($(this).val()) >= 100) {
//         addSpan($(this), 'Phần trăm tối đa 100%')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(100);
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[percent-not-icon]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[max-hour]', function () {
//     removeSpan($(this));
//     if ($(this).val() > 23) {
//         addSpan($(this), 'Thời gian tối đa 23 giờ')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(23);
//     } else if (removeformatNumber($(this).val()) < 0) {
//         addSpan($(this), 'Thời gian tối thiểu 0 giờ')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(0);
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[max-hour]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate-time]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('click', 'input[data-validate-time]', function () {
//     if ($(this).val() === '0') {
//         $(this).val('');
//     }
// })
// $(document).on('focusout', 'input[data-validate-time]', function () {
//     if ($(this).val() === '') {
//         $(this).val('0');
//     }
//     removeSpan($(this));
//     $(this).parent().removeClass('error-valid');
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
// })
// $(document).on('input', 'input[data-validate=price]', function () {
//     if(!$(this).attr('data-money')) {
//         removeSpan($(this));
//         if (removeformatNumber($(this).val()) < '1000' || removeformatNumber($(this).val()) === '') {
//             addSpan($(this), 'Giá tiền tối thiểu là 1000')
//             $(this).parent().removeClass('focus-valid');
//             $(this).parent().addClass('warning-valid');
//         } else {
//             removeSpan($(this));
//             $(this).parent().removeClass('warning-valid');
//             $(this).parent().addClass('focus-valid');
//         }
//     }
// })
// $(document).on('click', 'input[data-validate=price]', function () {
//     if(!$(this).attr('data-money')) {
//
//         if ($(this).val() === '0') {
//             $(this).val('');
//         }
//     }
// })
// $(document).on('focus', 'input[data-validate=price]', function () {
//     if(!$(this).attr('data-money')) {
//
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[data-validate=price]', function () {
//     if(!$(this).attr('data-money')) {
//
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//     }
// })
// $(document).on('input', 'input[price-min-max]', function () {
//     removeSpan($(this));
//     if (removeformatNumber($(this).val()) < '1000') {
//         addSpan($(this), 'Số tiền tối thiểu là 1,000')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//     } else if (removeformatNumber($(this).val()) > '99999999') {
//         addSpan($(this), 'Số tiền tối đa là 99,999,999')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//     } else if (removeformatNumber($(this).val()) === '') {
//         addSpan($(this), 'Số tiền không được trống')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//     } else {
//         removeSpan($(this))
//         $(this).parent().addClass('focus-valid');
//         $(this).parent().removeClass('warning-valid');
//     }
// })
// $(document).on('focus', 'input[price-min-max]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[price-min-max]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate=Count]', function () {
//     if ($(this).val() === '') {
//         addSpan($(this), 'Số lượng tối thiểu là 1')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('click', 'input[data-validate=Count]', function () {
//     if ($(this).val() === '1') {
//         $(this).val('')
//     }
// })
// $(document).on('focus', 'input[data-validate=Count]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=Count]', function () {
//     removeSpan($(this));
//     if ($(this).val() === '') {
//         $(this).val('1')
//     }
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate=search-customer]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=search-customer]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate=phone-required-vn-check]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=phone-required-vn-check]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate=website]', function () {
//     if(!$(this).attr('data-website')) {
//         addSpan($(this), 'Nhập địa chỉ website ( nếu có )');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focusout', 'input[data-validate=website]', function () {
//     if(!$(this).attr('data-website')) {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//     }
// })
// $(document).on('focusout', 'input[data-validate=website]', function () {
//     if(!$(this).attr('data-website')) {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().removeClass('error-valid');
//     }
// })
// $(document).on('focus', 'input[data-validate=facebook]', function () {
//     addSpan($(this), 'Nhập địa chỉ facebook ( nếu có )');
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=facebook]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate=address-ip]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=address-ip]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate=printer-port]', function () {
//     if ($(this).val().match(/[^0-9]/g)) {
//         removeSpan($(this));
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         addSpan($(this), 'Vui lòng chỉ nhập số và lớn hơn 0');
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('fucus-valid');
//     }
// })
// $(document).on('focus', 'input[data-validate=printer-port]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=printer-port]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-validate=printer-name]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=printer-name]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('focus', 'input[data-time]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-time]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate=table-amount]', function () {
//     if ($(this).val() < 1) {
//         removeSpanDatatable($(this));
//         addSpanDatatable($(this), 'Số lượng tối thiểu là 1');
//         $(this).parent().find('span').attr("style", "right: 21.4rem");
//         $(this).parent().find('span:before').attr("style", "right: 7.5rem");
//         $(this).removeClass('focus-valid');
//         $(this).addClass('warning-valid');
//     } else if (removeformatNumber($(this).val()) > 1000000) {
//         removeSpanDatatable($(this));
//         addSpanDatatable($(this), 'Số lượng tối đa là 1,000,000');
//         $(this).parent().find('span').attr("style", "right: 24.2rem");
//         $(this).parent().find('span:before').attr("style", "right: 7.5rem");
//         $(this).removeClass('focus-valid');
//         $(this).addClass('warning-valid');
//     } else {
//         removeSpanDatatable($(this));
//         $(this).removeClass('warning-valid');
//         $(this).addClass('focus-valid');
//     }
// })
// $(document).on('focus', 'input[data-validate=table-amount]', function () {
//     $(this).addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=table-amount]', function () {
//     // removeSpanDatatable($(this));
//     $(this).removeClass('warning-valid');
//     $(this).removeClass('focus-valid');
//     $(this).removeClass('error-valid');
// })
// $(document).on('input', 'input[data-validate=amount-people]', function () {
//     if ($(this).val() === '') {
//         addSpan($(this), 'Số người tối thiểu là 1')
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('click', 'input[data-validate=amount-people]', function () {
//     if ($(this).val() === '1') {
//         $(this).val('');
//     }
// })
// $(document).on('focus', 'input[data-validate=amount-people]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[data-validate=amount-people]', function () {
//     if ($(this).val() === '') {
//         $(this).val('1');
//     }
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
// $(document).on('input', 'input[max-number]', function () {
//     removeSpan($(this));
//     if (removeformatNumber($(this).val()) > 999999999999) {
//         addSpan($(this), 'Số không được lớn hơn 999,999,999,999');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(formatNumber(999999999999));
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focus', 'input[max-number]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[max-number]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
// })
// $(document).on('input', 'input[min-number]', function () {
//     removeSpan($(this));
//     if ($(this).val() < 1) {
//         addSpan($(this), 'Số không được nhỏ hơn 1');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(formatNumber(1));
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focus', 'input[min-number]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[min-number]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
// })
// $(document).on('input', 'input[max-day]', function () {
//     removeSpan($(this));
//     if (removeformatNumber($(this).val()) > 365) {
//         addSpan($(this), 'Số không được lớn hơn 365 ngày');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(formatNumber(365));
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focus', 'input[max-day]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[max-day]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
// })
// $(document).on('input', 'input[max-minute]', function () {
//     removeSpan($(this));
//     if (removeformatNumber($(this).val()) > 864000) {
//         addSpan($(this), 'Số không được lớn hơn 864,000 phút');
//         $(this).parent().removeClass('focus-valid');
//         $(this).parent().addClass('warning-valid');
//         $(this).val(formatNumber(864000));
//     } else {
//         removeSpan($(this));
//         $(this).parent().removeClass('warning-valid');
//         $(this).parent().addClass('focus-valid');
//     }
// })
// $(document).on('focus', 'input[max-minute]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[max-minute]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
// })
// $(document).on('input', 'input[time-24]', function () {
//     if ($(this))
//         if (parseInt(($(this).val()).substring(0, 2)) > 23 || parseInt(($(this).val()).substring(0, 1)) > 2) {
//             $(this).val('0' + ($(this).val()).substring(0, 1) + ':' + ($(this).val()).substring(1, 2));
//         } else if (parseInt(($(this).val()).substring(3, 4)) > 5) {
//             $(this).val(($(this).val()).substring(0, 2) + ':0' + ($(this).val()).substring(3, 4));
//         } else if (parseInt(($(this).val()).substring(4, 4)) > 9) {
//             $(this).val(($(this).val()).substring(0, 2) + ':' + ($(this).val()).substring(3, 4)) + '9';
//         } else if ($(this).val().length > 2) {
//             $(this).val(($(this).val()).substring(0, 2) + ':' + ($(this).val()).substring(3, 5));
//         }
// })
// $(document).on('focus', 'input[time-24]', function () {
//     $(this).parent().addClass('focus-valid');
// })
// $(document).on('focusout', 'input[time-24]', function () {
//     removeSpan($(this));
//     $(this).parent().removeClass('warning-valid');
//     $(this).parent().removeClass('focus-valid');
//     $(this).parent().removeClass('error-valid');
// })
