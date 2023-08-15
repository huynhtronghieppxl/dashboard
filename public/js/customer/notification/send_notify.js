let send_notification_dropzone, notification_image_url, id_send_notification_customer;

$(function () {

    $('#upload-img-send-notification-customer').unbind('change').on('change', async function () {
        let img_file= await document.querySelector('#upload-img-send-notification-customer').files[0];
        let url_img = URL.createObjectURL(img_file);
        $('#thumbnail-upload-img-send-notification-customer').attr('src', url_img)

        let data = new FormData();
        data.append("file", img_file);

        let method = 'post',
            url = 'birthday-gift.post-img',
            params = null;
        let res = await axiosTemplate(method, url, params, data);

        if (res.status === 200){
            $('#thumbnail-upload-img-send-notification-customer').attr('data-link', res.data.data[0].link_original)
        }else{
            $('#thumbnail-upload-img-send-notification-customer').attr('data-link', '');
        }

        $('#upload-img-send-notification-customer').val('').clone(true);
    })

    let template_banner_node_send_notification = $('#template-review-notification-img');
    let template_banner_preview_send_notification = template_banner_node_send_notification.parents('#previews-banner-send-notification-img').html();
    template_banner_node_send_notification.parents('#previews-banner-send-notification-img').find('#template-review-notification-img').remove();
    Dropzone.autoDiscover = false;
    send_notification_dropzone = new Dropzone("form#upload-img-send-notification-customer", {
        url: 'notification.post-img',
        maxFiles: 1,
        maxFilesize: 5, //MB
        resizeMethod: 'contain',
        autoProcessQueue: false,
        previewsContainer: "#previews-banner-send-notification-img",
        clickable: '#clickable-dropzone-send-notification',
        acceptedFiles: ".jpeg,.jpg,.png",
        previewTemplate: template_banner_preview_send_notification,
        dictFileTooBig: "Ảnh đã vượt quá 5MB, vui lòng chọn ảnh khác!",
        dictMaxFilesExceeded: "Chức năng này chỉ có thể upload 1 ảnh!",
        // addRemoveLinks: true,
        init: function () {
            this.on("removedfile", function (file) {
                notification_image_url = '';
                this.removeAllFiles(true);
            });
            this.on('addedfile', function (file) {
                notification_image_url = this.files[0].name;

                if (file.size > 5 * 1024 * 1024) {
                    this.removeFile(file);
                    ErrorNotify('File ' + file.name + ' đã vượt quá 5MB!');
                    setThumbnailDropzone("form#upload-img-send-notification-customer");
                }

                if (file.type != "image/jpeg" && file.type != "image/png" && file.type != "image/jpg") {
                    this.removeFile(file);
                    ErrorNotify($('#not_type').text() + '!');
                    setThumbnailDropzone("form#upload-img-send-notification-customer");
                }
            });
            this.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("success", function (file, response) {
                sendNotificationCustomer(response);
            });
        }
    });

    $('.dz-remove, .dz-default.dz-message').addClass('d-none');

    setThumbnailDropzone("form#upload-img-send-notification-customer");
})

async function openModalSendNotificationCustomer(r) {
    $('#modal-send-notification-customer').modal('show');
    shortcut.remove('F2');
    shortcut.add('F4', function () {
        sendNotificationCustomer();
    });
    shortcut.add('ESC', function () {
        closeSendNotificationCustomer();
    });

    addLoading('notification.get-all-restaurant-membership-card', '.page-body');
    addLoading('notification.post-img', '.page-body');

    $('#restaurant-membership-card-id').select2({
        dropdownParent: $('#modal-send-notification-customer'),
        theme: 'material'
    });

    $('#modal-send-notification-customer input[type=radio][name=restaurant-membership-card-type]').change(function() {
        if (this.value == -1) {
            $('#restaurant-membership-card-id').val('');
            $('#select-restaurant-membership-card-id').addClass('d-none');
        } else if (this.value == 1) {
            $('#select-restaurant-membership-card-id').removeClass('d-none');
        }
    });

    id_send_notification_customer = await r.attr('data-id');

    let method = 'get',
        url = 'notification.get-all-restaurant-membership-card',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#restaurant-membership-card-id').html(res.data[0]);

    $("#btn-send-notification-customer").on('click', async function(){
        let icon = 'warning', title = 'Xác nhận gửi thông báo!', content;
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                await send_notification_dropzone.processQueue();
            }
        })
    });
}

function setThumbnailDropzone(id_form){
    let mockFile = {name: "default.jpg", size: 12345},
        myDropzone = new Dropzone(id_form);
    mockFile.status = Dropzone.SUCCESS;
    mockFile.accepted = true;
    myDropzone.options.addedfile.call(myDropzone, mockFile);
    myDropzone.files.push(mockFile);
    myDropzone.options.thumbnail.call(myDropzone, mockFile, "/images/img_file.png");
}

async function sendNotificationCustomer(img_url) {
    let test_type = $('input[name="restaurant-membership-card-type"]:checked').val(),
        rmc_id = (test_type == -1) ? ["-1"] : $('#restaurant-membership-card-id').val();

    let method = 'post',
        url = 'notification.send-notify',
        data = {
            id: id_send_notification_customer,
            image_url: img_url,
            object_id: 1,
            restaurant_membership_card_id: rmc_id
        },
        params = null;
    let res = await axiosTemplate(method, url, params, data);

    if (res.data.status === 200) {
        SuccessNotify('Gửi thành công!');
        closeSendNotificationCustomer();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }

}

function closeSendNotificationCustomer() {
    $('#modal-send-notification-customer').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateNotificationCustomer();
    });
    send_notification_dropzone.removeAllFiles(true);
    setThumbnailDropzone("form#upload-img-send-notification-customer");
    $("input[name='restaurant-membership-card-type'][value='-1']").prop('checked', true).trigger('change');
    $('#restaurant-membership-card-id').val('');
}
