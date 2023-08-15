let checkSaveIsRunningMedia = 0, checkSendBannerToAloline = 0,
    checkCancelMedia = 0,
    tabCurrentMediaMarketing = 0, tableRestaurantBannerAdvMarketing, tableRestaurantVideoAdvMarketing;

$(function () {
    if(getCookieShared('media-restaurant-marketing-user-id' + idSession)){
        let data = JSON.parse(getCookieShared('media-restaurant-marketing-user-id' + idSession));
        tabCurrentMediaMarketing = data.tab;
    }
    loadData();
    $('#tab-media-restaurant .nav-link').on('click',function (){
        tabCurrentMediaMarketing = $(this).attr('data-type');
        updateCookie();
    })
    $('#tab-media-restaurant a[data-type="' +tabCurrentMediaMarketing+ '"]').click();

});
function updateCookie(){
    saveCookieShared('media-restaurant-marketing-user-id' + idSession, JSON.stringify({
        'tab' : tabCurrentMediaMarketing,
    }))
}

function openModalUploadMediaRestaurant() {
    switch ($('#tab-media-restaurant li a.active').data('type')) {
        case 0:
            openModalCreateImageMarketing();
            break;
        case 1:
            openModalCreateVideoMarketing();
            break;
    }
}

async function loadData() {
    let method = 'get',
        url = 'media-restaurant-marketing.data',
        params = {
            brand: $('.select-brand').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#index-media-restaurant-marketing')]);
    dataTableMediaRestaurant(res);
    $('#total-record-banner-adv').text(res.data[2].total_banner_adv);
    $('#total-record-video-adv').text(res.data[2].total_video_adv);
}

async function dataTableMediaRestaurant(data) {
    let restaurantBannerAdvMarketing = $('#restaurant-banner-adv-marketing'),
        restaurantVideoAdvMarketing = $('#restaurant-video-adv-marketing'),
        fixed_left = '',
        fixed_right = '',
        columnRestaurantBannerAdvMarketing = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'media_url', name: 'media_url', width: '10%', class: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'is_running', name: 'is_running', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            // {data: 'checkbox', name: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columnRestaurantVideoAdvMarketing = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'media_url', name: 'media_url', className: 'text-center', width: '10%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'is_running', name: 'is_running', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalUploadMediaRestaurant',
        }]
    tableRestaurantBannerAdvMarketing = await DatatableTemplateNew(restaurantBannerAdvMarketing, data.data[0].original.data, columnRestaurantBannerAdvMarketing, vh_of_table, fixed_left, fixed_right, option);
    tableRestaurantVideoAdvMarketing = await DatatableTemplateNew(restaurantVideoAdvMarketing, data.data[1].original.data, columnRestaurantVideoAdvMarketing, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-banner-adv').text(tableRestaurantBannerAdvMarketing.rows({'search': 'applied'}).count())
        $('#total-record-video-adv').text(tableRestaurantVideoAdvMarketing.rows({'search': 'applied'}).count())
    })
}

async function checkBannerToAloline(r) {
    //0 là bật, 1 là tắt
    let is_aloline_advert = 0;
    let title = 'Ngưng hình ảnh Banner cho tài khoản Aloline?';
    let check = true;
    if(r.is(':checked')){
        check = false;
        is_aloline_advert = 1;
        title = 'Xác nhận hình ảnh Banner cho tài khoản Aloline?'
    }
    if (checkSendBannerToAloline === 1) return false;
    let text = '', icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            checkSendBannerToAloline = 1;
            let method = 'POST',
                url = 'media-restaurant-marketing.send-to-aloline',
                params = {
                    id: r.val(),
                },
                data = {
                    url: r.data('url'),
                    length: r.data('length-by-second'),
                    monitor: r.data('monitor'),
                    type: r.data('type'),
                    name: r.data('name'),
                    is_aloline_advert: is_aloline_advert
                };
            let res = await axiosTemplate(method, url, params, data);
            checkSendBannerToAloline = 0;
            let text = '';
            switch (res.data.status){
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    WarningNotify(text);
            }
        }else{
            r.prop('checked', !r.is(':checked'))
        }
    });
}

async function changeIsRunningMedia(r) {
    if (checkSaveIsRunningMedia === 1) return false;
    let title = 'Đổi trạng thái ?', text = '', icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            checkSaveIsRunningMedia = 1;
            let method = 'POST',
                url = 'media-restaurant-marketing.change-is-running',
                params = {id: r.data('id')},
                data = '';
            let res = await axiosTemplate(method, url, params, data);
            checkSaveIsRunningMedia = 0;
            let text = '';
            switch (res.data.status){
                case 200:
                    text = $('#success-status-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    WarningNotify(text);
            }
        }
    });
}

async function cancelMedia(r) {
    if (checkCancelMedia === 1) return false;
    checkCancelMedia = 1;
    let title = 'Huỷ ?', text = 'Huỷ sẽ không thể khôi phục lại !', icon = 'question';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            let method = 'POST',
                url = 'media-restaurant-marketing.cancel',
                params = {id: r.data('id')},
                data = '';
            let res = await axiosTemplate(method, url, params, data);
            checkCancelMedia = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) text = res.data.message;
                    WarningNotify(text);
            }
        }
    });
}

function viewVideoMedia(src) {
    $('#modal-detail-video-adv-marketing').modal('show');
    $('#data-detail-upload-video-adv-marketing').attr('src', src);
}

function closeModalDetailVideoAdvMarketing() {
    $('#modal-detail-video-adv-marketing').modal('hide');
    $('#data-detail-upload-video-adv-marketing').attr('src', '');
}



