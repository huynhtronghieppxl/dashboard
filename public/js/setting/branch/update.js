// let array_image = [];
// let banner_branch = '';
// let marker_map = [];
// let dropzone_multiple = '';
// let change_data = 0;
//
// let dropzone_for_logo, logo_file_name = '',
//     dropzone_for_banner, banner_file_name = '',
//     dropzone_for_multiple, old_multiple_file_name = [], multiple_file_name = [];
//
// function openModalUpdateBranch(id) {
//     shortcut.add('F4', function () {
//         saveUpdateBranch();
//     });
//     shortcut.add('ESC', function () {
//         $('#dismiss-modal-edit').trigger('click');
//     });
//
//     data_update(id);
//
//     $('#branch-avg-amount-customer-edit').on('focus', function () {
//         $(this).select();
//     });
//     $('#is-wifi-edit').on('click', function () {
//         if ($(this).is(':checked') == true) {
//             $('#check-is-have-wifi').removeClass('d-none');
//         } else {
//             $('#check-is-have-wifi').addClass('d-none');
//         }
//     });
//
//     $(document).on('click', '#selected-all-day', function () {
//         $(this).data('selected', 1);
//         $('#selected-day').data('selected', 0);
//
//         $(this).parents('.select-all-day-of-week').css('border', '1px #ccc solid');
//         $(this).parents('.select-all-day-of-week').css('padding', '1em');
//         $(this).parents('#parents-node').find('#time-open-of-all-day').data('selected', 1);
//         $(this).parents('#parents-node').find('#time-close-of-all-day').data('selected', 1);
//         $('#time-all-day-selected').fadeIn();
//         $('#time-day-selected').fadeOut();
//
//         $('.select-day-of-week').css('border', '1px white solid');
//         $('.select-day-of-week').css('padding', '0');
//     });
//     $(document).on('click', '#selected-day', function () {
//         $(this).data('selected', 1);
//         $('#selected-all-day').data('selected', 0);
//         $(this).parents('.select-day-of-week').css('border', '1px #ccc solid');
//         $(this).parents('.select-day-of-week').css('padding', '1em');
//         $('#time-open-of-all-day').data('selected', 0);
//         $('#time-close-of-all-day').data('selected', 0);
//         $('#time-day-selected').fadeIn('slow');
//         $('#time-all-day-selected').fadeOut();
//         $('.select-all-day-of-week').css('border', '1px white solid');
//         $('.select-all-day-of-week').css('padding', '0');
//
//     });
//     $(document).on('click', '.select-day-of-one', function () {
//         if ($(this).is(':checked') == true) {
//             $(this).parents('#parents-node').find('.time-open-of-day').removeClass('d-none').data('selected', 1);
//             $(this).parents('#parents-node').find('.time-close-of-day').removeClass('d-none').data('selected', 1);
//         } else {
//             $(this).parents('#parents-node').find('.time-open-of-day').addClass('d-none').data('selected', 0);
//             $(this).parents('#parents-node').find('.time-close-of-day').addClass('d-none').data('selected', 0);
//         }
//
//     });
//
//     $('#modal-branch-detail').on('shown.bs.modal', async function () {
//         $('.js-example-basic-single, .js-example-basic-multiple').select2({
//             dropdownParent: $(this),
//         });
//         $(this).find('select').prop('disabled', true);
//         $('.first a').click();
//         await option_default_all_edit();
//         data_branch_edit_country();
//     });
//     $('#branch-country-edit').on('select2:select', async function () {
//         let id = $(this).find('option:checked').val();
//         await $('#branch-city-provice-edit').empty();
//         data_branch_edit_city(id);
//     });
//     $('#branch-city-provice-edit').on('select2:select', async function () {
//         let id = $(this).find('option:checked').val();
//         await $('#branch-district-edit').empty();
//         await $('#branch-neighborhood-village-edit').empty();
//         if ($('#branch-district-edit').find('option[value=""]').length == 0) {
//             $('#branch-district-edit').append(option_default('', '--- Chọn Quận/Huyện ---'));
//         }
//         if ($('#branch-neighborhood-village-edit').find('option[value=""]').length == 0) {
//             $('#branch-neighborhood-village-edit').append(option_default('', '--- Chọn Phường/Xã ---'));
//         }
//         data_branch_edit_district(id);
//     });
//     $('#branch-district-edit').on('select2:select', async function () {
//         let id = $(this).find('option:checked').val();
//         await $('#branch-neighborhood-village-edit').empty();
//         if ($('#branch-neighborhood-village-edit').find('option[value=""]').length == 0) {
//             $('#branch-neighborhood-village-edit').append(option_default('', '--- Chọn Phường/Xã ---'));
//         }
//         data_branch_edit_ward(id);
//     });
// }
//
// function data_update(id) {
//     marker_map = [];
//     let business = [];
//     $('#modal-branch-detail').modal('show');
//     $('.form-control').prop('disabled', true);
//     $('#save_edit_branch').prop('disabled', true);
//     $('a').prop('disabled', true);
//     let method = 'GET',
//         url = 'branch.data-detail',
//         params = {
//             id: id,
//         },
//         data = '';
//     axiosTemplate(method, url, params, data).then(async res => {
//         let update_data = res.data;
//         console.log(update_data);
//         $('#branch-name-edit').val(update_data.name);
//         $('#branch-name-edit').data('id', update_data.id);
//         $('#branch-address-edit').val(update_data.address);
//         $('#branch-address-note-edit').val(update_data.address_note);
//         $('#branch-phone-edit').val(update_data.phone);
//         $('#branch-avg-amount-customer-edit').val(update_data.average_amount_per_customer).trigger('input');
//         $('#branch-wifi-name-edit').val(update_data.wifi_name);
//         $('#branch-wifi-password-edit').val(update_data.wifi_password);
//         $('#branch-street-edit').val(update_data.street_name);
//
//         if (update_data.branch_business_types.length !== 0) {
//             $.each(update_data.branch_business_types, function (index, value) {
//                 business[index] = value.id;
//             });
//         }
//         data_bussiness_type(business);
//
//         //upload banner
//         uploadLogoData(update_data.id, update_data.image_logo);
//         uploadBannerData(update_data.id, update_data.banner_image_url);
//         await get_address_function(update_data.country_id, update_data.city_id, update_data.district_id, update_data.ward_id);
//
//         initMap(parseFloat(update_data.lat), parseFloat(update_data.lng));
//         let item_location = {};
//         item_location.lat = update_data.lat;
//         item_location.lng = update_data.lng;
//         marker_map.push(item_location);
//
//         if (update_data.serve_time.length > 0) {
//             if (update_data.serve_time[0].day_of_week == -1) {
//                 $('#selected-all-day').trigger('click');
//
//                 $('#time-open-of-all-day').val(update_data.serve_time[0]['open_time']);
//                 $('#time-close-of-all-day').val(update_data.serve_time[0]['close_time']);
//             } else {
//                 $('#selected-day').trigger('click');
//                 for (let i = 0, element = update_data.serve_time; i < element.length; i++) {
//                     $('.select-day-of-one[data-value="' + element[i].day_of_week + '"]').prop('checked', true);
//                     $('.select-day-of-one[data-value="' + element[i].day_of_week + '"]').parents('#parents-node').find('.time-open-of-day').removeClass('d-none').val(element[i].open_time);
//                     $('.select-day-of-one[data-value="' + element[i].day_of_week + '"]').parents('#parents-node').find('.time-close-of-day').removeClass('d-none').val(element[i].close_time);
//                 }
//             }
//         }
//
//         if (update_data.is_have_wifi == 1) {
//             $('#is-wifi-edit').prop('checked', true);
//         } else {
//             $('#is-wifi-edit').prop('checked', false);
//         }
//         if (update_data.is_have_air_conditioner == 1) {
//             $('#is-air-conditioner-edit').prop('checked', true);
//         } else {
//             $('#is-air-conditioner-edit').prop('checked', false);
//         }
//         if (update_data.is_free_parking == 1) {
//             $('#is-parking-edit').prop('checked', true);
//         } else {
//             $('#is-parking-edit').prop('checked', false);
//         }
//         if (update_data.is_have_booking_online == 1) {
//             $('#is-booking-online-edit').prop('checked', true);
//         } else {
//             $('#is-booking-online-edit').prop('checked', false);
//         }
//         if (update_data.is_have_car_parking == 1) {
//             $('#is-car-parking-edit').prop('checked', true);
//         } else {
//             $('#is-car-parking-edit').prop('checked', false);
//         }
//         if (update_data.is_have_card_payment == 1) {
//             $('#is-card-payment-edit').prop('checked', true);
//         } else {
//             $('#is-card-payment-edit').prop('checked', false);
//         }
//         if (update_data.is_have_child_corner == 1) {
//             $('#is-child-corner-edit').prop('checked', true);
//         } else {
//             $('#is-child-corner-edit').prop('checked', false);
//         }
//         if (update_data.is_have_invoice == 1) {
//             $('#is-invoice-edit').prop('checked', true);
//         } else {
//             $('#is-invoice-edit').prop('checked', false);
//         }
//         if (update_data.is_have_karaoke == 1) {
//             $('#is-karaoke-edit').prop('checked', true);
//         } else {
//             $('#is-karaoke-edit').prop('checked', false);
//         }
//         if (update_data.is_have_live_music == 1) {
//             $('#is-live-music-edit').prop('checked', true);
//         } else {
//             $('#is-live-music-edit').prop('checked', false);
//         }
//         if (update_data.is_have_order_food_online == 1) {
//             $('#is-order-food-online-edit').prop('checked', true);
//         } else {
//             $('#is-order-food-online-edit').prop('checked', false);
//         }
//         if (update_data.is_have_outdoor == 1) {
//             $('#is-outdoor-edit').prop('checked', true);
//         } else {
//             $('#is-outdoor-edit').prop('checked', false);
//         }
//         if (update_data.is_have_private_room == 1) {
//             $('#is-private-room-edit').prop('checked', true);
//         } else {
//             $('#is-private-room-edit').prop('checked', false);
//         }
//         if (update_data.is_have_shipping == 1) {
//             $('#is-shipping-edit').prop('checked', true);
//         } else {
//             $('#is-shipping-edit').prop('checked', false);
//         }
//         if (update_data.is_use_fingerprint == 1) {
//             $('#is-use-finger-print-edit').prop('checked', true);
//         } else {
//             $('#is-use-finger-print-edit').prop('checked', false);
//         }
//
//         set_day_of_week();
//
//         $('#branch-website-edit').val(update_data.website);
//         $('#branch-facebook-edit').val(update_data.facebook);
//         $('.form-control').prop('disabled', false);
//         $('#save_edit_branch').prop('disabled', false);
//         $('a').prop('disabled', false);
//         uploadMultipleData(update_data.id, update_data.image_urls);
//         array_image = update_data.image_urls;
//         $('#remove-all-image').on('click', function () {
//             $('#review-branch-image-url').html('');
//             array_image = [];
//         });
//
//         shortcut.add('ESC', function () {
//             $('#dismiss-modal-edit').trigger('click');
//         });
//
//     });
// }
//
// // dropzone upload img
// function uploadBannerData(id, old_url) {
//     let template_banner_node = $('#template-review-banner'),
//         template_banner_preview = $('#template-review-banner').parents('#previews-banner').html(),
//         branch_name = $('#branch-name-edit').val(),
//         branch = branch_name.replace(/[\. ,:-]+/g, ""),
//         date_now = Date.now();
//     template_banner_node.parents('#previews-banner').find('#template-review-banner').remove();
//
//     Dropzone.autoDiscover = false;
//     dropzone_for_banner = new Dropzone("form#branch-banner-upload-edit", {
//         url: 'branch.data.banner',
//         maxFiles: 1,
//         autoProcessQueue: false,
//         acceptedFiles: ".jpeg,.jpg,.png,.gif",
//         parallelUploads: 1,
//         previewsContainer: "#previews-banner",
//         dictDefaultMessage: false,
//         // addRemoveLinks: true,
//         clickable: '#branch-banner-upload-edit , #previews-banner',
//         resizeMethod: 'contain',
//         previewTemplate: template_banner_preview,
//         init: function () {
//             this.on("removedfile", function (file) {
//                 banner_file_name = '';
//                 this.removeAllFiles(true);
//             });
//             this.on('addedfile', function (file) {
//                 let name = this.files[0].name;
//                 let extension = name.substr( (name.lastIndexOf('.') +1) );
//                 banner_file_name = 'banner-'+branch+'-'+date_now+'.'+extension;
//             });
//             this.on("maxfilesexceeded", function (file) {
//                 this.removeAllFiles();
//                 this.addFile(file);
//             })
//         }
//     });
//
//     let img_name = old_url,
//         name = img_name.substr(img_name.lastIndexOf('/') + 1),
//         bannerMockFile = {name: name, size: 12345},
//         myBannerDropzone = new Dropzone("form#branch-banner-upload-edit");
//     banner_file_name = name;
//     bannerMockFile.status = Dropzone.SUCCESS;
//     bannerMockFile.accepted = true;
//     myBannerDropzone.options.addedfile.call(myBannerDropzone, bannerMockFile);
//     myBannerDropzone.files.push(bannerMockFile);
//     myBannerDropzone.options.thumbnail.call(myBannerDropzone, bannerMockFile, old_url);
// }
//
// function uploadLogoData(id, old_url) {
//     let template_logo_node = $('#template-review-logo'),
//         template_logo_preview = $('#template-review-logo').parents('#previews-logo').html();
//     template_logo_node.parents('#previews-logo').find('#template-review-logo').remove();
//
//     Dropzone.autoDiscover = false;
//     dropzone_for_logo = new Dropzone("form#branch-logo-upload-edit", {
//         url: 'branch.data.banner',
//         maxFiles: 1,
//         autoProcessQueue: false,
//         acceptedFiles: ".jpeg,.jpg,.png,.gif",
//         parallelUploads: 1,
//         previewsContainer: "#previews-logo",
//         dictDefaultMessage: false,
//         // addRemoveLinks: true,
//         clickable: '#branch-logo-upload-edit , #previews-logo',
//         resizeMethod: 'contain',
//         previewTemplate: template_logo_preview,
//         init: function () {
//             this.on("removedfile", function (file) {
//                 logo_file_name = '';
//                 this.removeAllFiles(true);
//             });
//             this.on('addedfile', function (file) {
//                 logo_file_name = this.files[0].name;
//             });
//             this.on("maxfilesexceeded", function (file) {
//                 this.removeAllFiles();
//                 this.addFile(file);
//             })
//         }
//     });
//
//     let img_name = old_url,
//         name = img_name.substr(img_name.lastIndexOf('/') + 1),
//         logoMockFile = {name: name, size: 12345},
//         myLogoDropzone = new Dropzone("form#branch-logo-upload-edit");
//     logo_file_name = name;
//     logoMockFile.status = Dropzone.SUCCESS;
//     logoMockFile.accepted = true;
//     myLogoDropzone.options.addedfile.call(myLogoDropzone, logoMockFile);
//     myLogoDropzone.files.push(logoMockFile);
//     myLogoDropzone.options.thumbnail.call(myLogoDropzone, logoMockFile, old_url);
// }
//
// async function uploadMultipleData(id, urls) {
//     dropzone_for_multiple = new Dropzone("form#branch-banner-multiple-edit", {
//         url : 'branch.data.banner-multiple',
//         paramName: "file",
//         maxFiles: 50,
//         resizeMethod: 'contain',
//         autoProcessQueue: false,
//         acceptedFiles: ".jpeg,.jpg,.png,.gif",
//         parallelUploads: 1,
//         addRemoveLinks: true,
//         clickable: '#view-select-multiple , #branch-banner-multiple-edit',
//         renameFile: function (file) {
//             let newName = removeVietnameseStringLowerCase(file.name);
//             newName = newName.toLowerCase();
//             return newName;
//         },
//         init: function () {
//             this.on('addedfile', function (file) {
//                 change_data = 1;
//                 //set size image
//                 if (file.size > (1024 * 1024) * 10) {
//                     this.removeFile(file);
//                     ErrorNotify('Ảnh ' + file.name + ' quá 10MB!');
//                 }
//                 if (this.files.length != 0) {
//                     for (let i = 0, dropzone_array = this.files; i < dropzone_array.length - 1; i++) {
//                         if (dropzone_array[i].name == file.name) {
//                             this.removeFile(file);
//                             ErrorNotify('Ảnh ' + file.name + ' đã được chọn!');
//                         }
//                     }
//                 }
//
//                 for (let i = 0; i < this.files.length; i++){
//                     // let img_name = removeVietnameseStringLowerCase(this.files[i].name);
//                     // img_name = img_name.toLowerCase();
//                     multiple_file_name[i] = removeVietnameseStringLowerCase(this.files[i].name);
//                 }
//
//             });
//             this.on("maxfilesexceeded", function (file) {
//                 ErrorNotify('maxfile (không quá 50 files)');
//                 this.removeAllFiles();
//                 this.addFile(file);
//             })
//         },
//
//         success: function (file, response) {
//             if (response === 200) {
//                 let msg_success = '<span class="bg-success rounded-circle p-1 text-white icofont icofont-ui-check" style="z-index: 1000;position: absolute;top: 10%;left: 90%;transform: translate(-50%, -50%)"></span>';
//                 $(file.previewElement).find('.dz-image').prepend(msg_success);
//                 //array_image.push(response[2] + response.data.link_original);
//             } else {
//
//                 let tooltip_error = '<a class="mytooltip" href="javascript:void(0)" style="z-index: 1000;position: absolute;top: 10%;left: 90%;transform: translate(-50%, -50%);color:#ff0000"><div class="fa p-0 m-0 fa fa-info-circle icon-tooltip rounded-circle text-yellow-custom" style="display: contents!important;font-size: 22px!important;"></div><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2">' + response.message + '</span></span></span></a>';
//                 $(file.previewElement).find('.dz-image').prepend(tooltip_error);
//             }
//             this.processQueue();
//         },
//         queuecomplete: function () {
//             // update($('#save_edit_branch'));
//             $('#dismiss-modal-edit').prop('disabled', false);
//             $('#dismiss-modal-edit').trigger('click');
//         }
//     });
//
//     let url_image = '';
//     // multiple_file_name = urls;
//
//     for (let i = 0; i< urls.length;i++){
//         let img_name = urls[i], name = img_name.substr(img_name.lastIndexOf('/') + 1);
//         name = removeVietnameseStringLowerCase(name).toLocaleLowerCase();
//         old_multiple_file_name[i] = name;
//         console.log(name);
//     }
//
//     await $.each(urls, function (index, value) {
//
//         url_image += '<div class="col-lg-3 mb-2">' +
//             '<div class="row">' +
//             '<div class="col-lg-12 text-center">' +
//             '<img src="' + value + '" style="object-fit: cover; height: 10em; width: 100%">' +
//             '</div>' +
//             '</div>' +
//             '</div>';
//     });
//     $('#review-branch-image-url').html(url_image);
// }
//
// function set_day_of_week() {
//     let method = 'GET',
//         url = 'branch.update.day-of-week',
//         params = '',
//         data = '';
//     axiosTemplate(method, url, params, data).then(async res => {
//         // console.log(res);
//         await $('#day-of-week-edit').html(res.data[0] + res.data[1]);
//         $('#time-all-day-selected').fadeOut();
//         $('#time-day-selected').fadeOut();
//         $('.start-time-date-time-picker').datetimepicker({
//             defaultDate: moment(new Date()).hours(8).minutes(0).seconds(0).milliseconds(0),
//             format: 'HH:mm',
//             sideBySide: true
//         });
//         $('.time-out-date-time-picker').datetimepicker({
//             defaultDate: moment(new Date()).hours(0).minutes(0).seconds(0).milliseconds(0),
//             format: 'HH:mm',
//             sideBySide: true
//         });
//     });
// }
//
// async function get_address_function(country_id, city_id, district_id, ward_id) {
//     await data_branch_edit_country();
//     await data_branch_edit_city(country_id, city_id);//vietnam hardcode
//     await data_branch_edit_district(city_id, district_id);
//     await data_branch_edit_ward(district_id, ward_id);
//     if (country_id) {
//         $('#branch-country-edit').val(country_id).trigger('change.select2');
//     } else {
//         $('#branch-country-edit').val('').trigger('change');
//     }
//     if (city_id) {
//         $('#branch-city-provice-edit').val(city_id).trigger('change.select2');
//     } else {
//         $('#branch-city-provice-edit').val('').trigger('change');
//     }
//     if (district_id) {
//         $('#branch-district-edit').val(district_id).trigger('change.select2');
//     } else {
//         $('#branch-district-edit').val('').trigger('change');
//     }
//     if (ward_id) {
//         $('#branch-neighborhood-village-edit').val(ward_id).trigger('change.select2');
//     } else {
//         $('#branch-neighborhood-village-edit').val('').trigger('change');
//     }
// }
//
// //init google map
// function initMap(lat, lng) {
//     console.log(lat, lng)
//     $('#branch-street-edit').on('click keyup keypress', function(e) {
//         $('.pac-container').css('z-index', '99999999');
//         // return false;
//         let keyCode = e.keyCode || e.which;
//         if (keyCode === 13) {
//             e.preventDefault();
//             return false;
//         }
//     });
//
//     let my_location = new google.maps.LatLng(lat, lng);
//     let geocoder = new google.maps.Geocoder;
//
//     let map = new google.maps.Map(document.getElementById('branch-location-edit'), {
//         center: my_location,
//         zoom: 18,
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//     });
//
//     let marker = new google.maps.Marker({
//         position: my_location,
//         map: map,
//         draggable: true,
//     });
//
//     let input = document.getElementById('branch-street-edit');
//     let autocomplete = new google.maps.places.Autocomplete(input);
//     autocomplete.addListener('place_changed', async function () {
//         let place = autocomplete.getPlace();
//         if (place.geometry.viewport) {
//             map.fitBounds(place.geometry.viewport);
//         } else {
//             map.setCenter(place.geometry.location);
//             map.setZoom(17); // Why 17? Because it looks good.
//         }
//         marker.setPosition(place.geometry.location);
//         marker.setVisible(true);
//
//         $('.address-gg').append(place.adr_address);
//         $('#branch-address-edit').val(place.formatted_address);
//
//         marker_map = [];
//         let item_or = {};
//         item_or.lat = place.geometry.location.lat();
//         item_or.lng = place.geometry.location.lng();
//         marker_map.push(item_or);
//         $('#branch-street-edit').val(place.name);
//     });
//     geocodeAddress(geocoder, map);
//
//     return map;
//
//
// }
//
// function geocodeAddress(geocoder, resultsMap) {
//     let address = document.getElementById('branch-address-edit').value;
//     console.log(address)
//     geocoder.geocode({'address': address}, function (results, status) {
//         if (status === google.maps.GeocoderStatus.OK) {
//             resultsMap.setCenter(results[0].geometry.location);
//             let marker = new google.maps.Marker({
//                 map: resultsMap,
//                 position: results[0].geometry.location,
//                 draggable: true,
//             });
//
//         } else {
//             console.log('Geocode was not successful for the following reason: ' + status);
//         }
//     });
// }
//
// async function data_bussiness_type(id) {
//     if ($('#branch-business-type').find('option').length !== 0) {
//         return;
//     } else {
//         let method = 'GET',
//             url = 'branch.data.business.type',
//             params = {business_id: id},
//             data = '';
//         axiosTemplate(method, url, params, data).then(res => {
//             console.log(res.data);
//             if ($('#branch-business-type').find('option').length == 0) {
//                 $('#branch-business-type').append(res.data);
//             }
//         });
//     }
// }
//
// //data res country
// function data_branch_edit_country(country_id) {
//     if ($('#branch-country-edit').find('option[value=""]').length == 0) {
//         $('#branch-country-edit').append(option_default('', '--- Chọn Quốc Gia ---'));
//     }
//     let method = 'GET',
//         url = 'branch.data.countries',
//         params = {country_id: country_id},
//         data = '';
//     axiosTemplate(method, url, params, data).then(res => {
//         // console.log(res.data[1])
//         if ($('#branch-country-edit').find('option').length == 1) {
//             $('#branch-country-edit').append(res.data);
//             $('#branch-country-edit').on('change', function () {
//                 let country_select = $(this).find('option:selected').val();
//                 $('#branch-city-provice-edit').val('').trigger('change.select2');
//                 $('#branch-district-edit').val('').trigger('change.select2');
//                 $('#branch-neighborhood-village-edit').val('').trigger('change.select2');
//                 data_branch_edit_city(country_select, '');
//             });
//         }
//         $('#modal-branch-detail').find('select').prop('disabled', false);
//     });
// }
//
// //data res city
// async function data_branch_edit_city(country_id, id) {
//     if ($('#branch-city-provice-edit').find('option[value=""]').length == 0) {
//         $('#branch-city-provice-edit').append(option_default('', '--- Chọn Thành Phố ---'));
//     }
//     let method = 'GET',
//         url = 'branch.data.cities',
//         params = {
//             id: country_id,
//             city_id: id
//         },
//         data = '';
//     axiosTemplate(method, url, params, data).then(res => {
//         // console.log('city '+res.data.length);
//         if (res.data.length == 0) {
//             $('#branch-city-provice-edit').val('').trigger('change');
//         } else {
//             if ($('#branch-city-provice-edit').find('option').length == 1) {
//                 $('#branch-city-provice-edit').append(res.data);
//                 $('#branch-city-provice-edit').on('change', function () {
//                     $('#branch-district-edit').empty().val('').trigger('change.select2');
//                     $('#branch-neighborhood-village-edit').empty().append(option_default('', '--- Chọn Phường/Xã ---'));
//                     data_branch_edit_district($(this).find('option:selected').val(), '');
//                     console.log($(this).find('option:selected').val());
//                 });
//             }
//             $('#modal-branch-detail').find('select').prop('disabled', false);
//         }
//     });
// }
//
// //data district
// function data_branch_edit_district(city_id, id) {
//     if ($('#branch-district-edit').find('option[value=""]').length == 0) {
//         $('#branch-district-edit').append(option_default('', '--- Chọn Quận/Huyện ---'));
//     }
//     let method = 'GET',
//         url = 'branch.data.districts',
//         params = {
//             id: city_id,
//             district_id: id
//         },
//         data = '';
//     axiosTemplate(method, url, params, data).then(res => {
//         if ($('#branch-district-edit').find('option').length == 1) {
//             $('#branch-district-edit').append(res.data);
//             $('#branch-district-edit').on('change', function () {
//                 $('#branch-neighborhood-village-edit').empty().val('').trigger('change.select2');
//                 data_branch_edit_ward($(this).find('option:selected').val(), '');
//             });
//         }
//         $('#modal-branch-detail').find('select').prop('disabled', false);
//     });
// }
//
// //data ward
// function data_branch_edit_ward(district_id, id) {
//     if ($('#branch-neighborhood-village-edit').find('option[value=""]').length == 0) {
//         $('#branch-neighborhood-village-edit').append(option_default('', '--- Chọn Phường/Xã ---'));
//     }
//     let method = 'GET',
//         url = 'branch.data.wards',
//         params = {
//             id: district_id,
//             ward_id: id
//         },
//         data = '';
//     axiosTemplate(method, url, params, data).then(res => {
//         // console.log(res);
//
//         if ($('#branch-neighborhood-village-edit').find('option').length == 1) {
//             $('#branch-neighborhood-village-edit').append(res.data);
//         }
//         $('#modal-branch-detail').find('select').prop('disabled', false);
//     });
// }
//
// function option_default(value, name) {
//     return '<option value="' + value + '" selected disabled>' + name + '</option>'
// }
//
// function option_default_all_edit() {
//     if ($('#branch-country-edit').find('option').length == 0) {
//         $('#branch-country-edit').append(option_default('', '--- Chọn Quốc Gia ---'));//country
//     }
//     if ($('#branch-city-provice-edit').find('option').length == 0) {
//         $('#branch-city-provice-edit').append(option_default('', '--- Chọn Thành Phố ---'));//cities
//     }
//     if ($('#branch-district-edit').find('option').length == 0) {
//         $('#branch-district-edit').append(option_default('', '--- Chọn Quận/Huyện ---'));//districts
//     }
//     if ($('#branch-neighborhood-village-edit').find('option').length == 0) {
//         $('#branch-neighborhood-village-edit').append(option_default('', '--- Chọn Phường/Xã ---'));//wards
//     }
// }
//
// async function saveUpdateBranch() {
//     let country_update = $('#branch-country-edit').find('option:checked').val(),
//         country_name_update = $('#branch-country-edit').find('option:checked').text(),
//         city_update = $('#branch-city-provice-edit').find('option:checked').val(),
//         city_name_update = $('#branch-city-provice-edit').find('option:checked').text(),
//         district_update = $('#branch-district-edit').find('option:checked').val(),
//         district_name_update = $('#branch-district-edit').find('option:checked').text(),
//         ward_update = $('#branch-neighborhood-village-edit').find('option:checked').val(),
//         ward_name_update = $('#branch-neighborhood-village-edit').find('option:checked').text(),
//         name_update = $('#branch-name-edit').val(),
//         id_update = $('#branch-name-edit').data('id'),
//         address_note_update = $('#branch-address-note-edit').val(),
//         phone_update = $('#branch-phone-edit').val(),
//         avg_amount_customer_update = removeformatNumber($('#branch-avg-amount-customer-edit').val()),
//         wifi_name_update = $('#branch-wifi-name-edit').val(),
//         wifi_password_update = $('#branch-wifi-password-edit').val(),
//         street_name = $('#branch-street-edit').val(),
//         wifi_update = $('#is-wifi-edit:checked').length,
//         air_conditioner_update = $('#is-air-conditioner-edit:checked').length,
//         parking_update = $('#is-parking-edit:checked').length,
//         booking_online_update = $('#is-booking-online-edit:checked').length,
//         car_parking_update = $('#is-car-parking-edit:checked').length,
//         card_payment_update = $('#is-card-payment-edit:checked').length,
//         child_corner_update = $('#is-child-corner-edit:checked').length,
//         invoice_update = $('#is-invoice-edit:checked').length,
//         karaoke_update = $('#is-karaoke-edit:checked').length,
//         live_music_update = $('#is-live-music-edit:checked').length,
//         order_food_online_update = $('#is-order-food-online-edit:checked').length,
//         outdoor_update = $('#is-outdoor-edit:checked').length,
//         private_room_update = $('#is-private-room-edit:checked').length,
//         shipping_update = $('#is-shipping-edit:checked').length,
//         website_update = $('#branch-website-edit').val(),
//         facebook_update = $('#branch-facebook-edit').val(),
//         branch_business_type_ids = [],
//         serve_time = [];
//
//     $.each($('#branch-business-type option:selected'), function () {
//         let item;
//         item = $(this).val();
//         branch_business_type_ids.push(item);
//     });
//
//     // $.each($('.select-the-day-of-week'), function () {
//     //     if (this.data('selected') == 1 && this.data('value') != -1) {
//     //         $.each(this.parents('.select-day-of-week').find('.select-day-of-one:checked'), function () {
//     //             let item = {};
//     //             item.day_of_week = this.data('value');
//     //             item.open_time = this.parents('#parents-node').find('.time-open-of-day').val();
//     //             item.close_time = this.parents('#parents-node').find('.time-close-of-day').val();
//     //             serve_time.push(item);
//     //         });
//     //     } else if (this.data('selected') == 1 && this.data('value') == -1) {
//     //         let item = {};
//     //         item.day_of_week = this.data('value');
//     //         item.open_time = this.parents('#parents-node').find('#time-open-of-all-day').val();
//     //         item.close_time = this.parents('#parents-node').find('#time-close-of-all-day').val();
//     //         serve_time.push(item);
//     //     }
//     // });
//
//     let country_check = checkChange('Quốc Gia', country_update),
//         city_check = checkChange('Thành Phố', city_update),
//         district_check = checkChange('Quận / Huyện', district_update),
//         ward_check = checkChange('Phường / Xã', ward_update);
//
//     if (country_check === false || city_check === false || district_check === false || ward_check === false) {
//         $(this).prop('disabled', false);
//         $(this).addClass('disabled');
//         return false;
//     } else {
//         await dropzone_for_logo.on('sending', function(file, xhr, formData){
//             formData.append('name_file', '');
//         });
//         await dropzone_for_logo.processQueue();
//
//         await dropzone_for_banner.on('sending', function(file, xhr, formData){
//             formData.append('name_file', (banner_file_name));
//         });
//         await dropzone_for_banner.processQueue();
//
//         await dropzone_for_multiple.on('sending', function(file, xhr, formData){
//             formData.append('name_file', multiple_file_name);
//         });
//         await dropzone_for_multiple.processQueue();
//
//         let image_urls = old_multiple_file_name.concat(multiple_file_name);
//
//         let method = 'POST',
//             url = 'branch.update',
//             params = '',
//             data = {
//                 "id": id_update,
//                 "name": name_update,
//                 "phone": phone_update,
//                 "lat": marker_map[0].lat,
//                 "lng": marker_map[0].lng,
//                 "branch_business_type_ids": branch_business_type_ids,
//                 "country_id": country_update,
//                 "country_name": country_name_update,
//                 "city_id": city_update,
//                 "city_name": city_name_update,
//                 "district_id": district_update,
//                 "district_name": district_name_update,
//                 "ward_id": ward_update,
//                 "ward_name": ward_name_update,
//                 "street_name": street_name,
//                 "address_full_text": street_name +', '+ ward_name_update + ', ' + district_name_update + ', ' + city_name_update + ', ' + country_name_update,
//                 "address_note": address_note_update,
//                 "serve_time": serve_time,
//                 "average_amount_per_customer": avg_amount_customer_update,
//                 "is_have_card_payment": card_payment_update,
//                 "is_have_booking_online": booking_online_update,
//                 "is_have_order_food_online": order_food_online_update,
//                 "is_have_shipping": shipping_update,
//                 "is_free_parking": parking_update,
//                 "is_have_car_parking": car_parking_update,
//                 "is_have_air_conditioner": air_conditioner_update,
//                 "is_have_wifi": wifi_update,
//                 "wifi_name": wifi_name_update,
//                 "wifi_password": wifi_password_update,
//                 "is_have_private_room": private_room_update,
//                 "is_have_outdoor": outdoor_update,
//                 "is_have_child_corner": child_corner_update,
//                 "is_have_live_music": live_music_update,
//                 "is_have_karaoke": karaoke_update,
//                 "is_have_invoice": invoice_update,
//                 "website": website_update,
//                 "facebook": facebook_update,
//                 "image_logo" : removeVietnameseStringLowerCase(logo_file_name).toLocaleLowerCase(),
//                 "banner_image_url": removeVietnameseStringLowerCase(banner_file_name).toLocaleLowerCase(),
//                 "image_urls": image_urls
//             };
//         console.log(data); return false;
//         axiosTemplate(method, url, params, data).then(res => {
//             if ($.trim(res.data.status) == 200) {
//                 change_data = 0;
//                 SuccessNotify('Chỉnh sửa thành công');
//                 $('#modal-branch-detail').modal('hide');
//                 loadData();
//                 // table.ajax.reload(null, false);
//                 $(this).prop('disabled', false);
//                 $(this).removeClass('disabled');
//             } else {
//                 $(this).prop('disabled', false);
//                 $(this).removeClass('disabled');
//                 ErrorNotify(res.data.data)
//             }
//         });
//     }
// }
//
//
// $(document).on('click', '#dismiss-modal-edit', function () {
//     $('#modal-branch-detail').modal('hide');
//     $('#modal-branch-detail').find('select').val('').trigger('change.select2');
//     $('#branch-country-edit').empty();
//     $('#branch-city-provice-edit').empty();
//     $('#branch-district-edit').empty();
//     $('#branch-neighborhood-village-edit').empty();
//     $('#wizard-form').find('.form-control').val('');
//     option_default_all_edit();
//     array_image = [];
//     banner_branch = '';
//     dropzone_for_logo.removeAllFiles();
//     dropzone_for_banner.removeAllFiles();
//     dropzone_for_multiple.removeAllFiles();
// });
