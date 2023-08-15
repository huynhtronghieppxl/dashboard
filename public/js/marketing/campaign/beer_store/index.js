let dataTableConfigBeerStore, checkLoadDataConfigBeerStore = 0, checkLoadRunningBeerStore = 0,
    idFoodBeerStore = null,  valueStatusRunningBeerStore ,idCategoryBeerMaterial, information = '', notifyContentDaily = '',
    notifyContentReset = '', hourSendNotify = '', bannerUrl = '', useGuide = '', termCampaign = '';
$(function (){
    $(document).on('select2:open', '.select-material-beer-store-campaign', function () {
        if ($('.select-category-material-beer-store-campaign').val() === null) {
            ErrorNotify('Vui lòng chọn loại quà !');
            $('.select-material-beer-store-campaign').select2('close');
        }
    });
})

async function ChangeStatusRunningBeerStore(){
    let titles = '',
        contents = '',
        textNotify = '',
        icon = '';
    if(valueStatusRunningBeerStore == 1){
         titles = 'Tắt chương trình ?',
         contents = 'Bạn có muốn tắt dụng chương trình tặng bia ?',
         textNotify = 'Tắt chương trình thàng công'
        icon = 'question';
    }else {
        // if(!hasPolicy) {
        //     WarningNotify('Vui Lòng thiết lập chính sách trước khi bật chương trình!');
        //     return false;
        // }
        titles = 'Bật chương trình ?',
        contents = 'Bạn có muốn bật chương trình tặng bia ?',
        icon = 'question',
        textNotify = 'Bật chương trình thàng công'
    }

    sweetAlertComponent(titles, contents, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'beer-store.change-status',
                params = {
                    brand_id: $('.select-brand').val(),
                },
                data = null;
            checkLoadRunningBeerStore = 1;
            let res = await axiosTemplate(method, url, params, data,[$(".select-category-material-beer-store-campaign")]);
            checkLoadRunningBeerStore = 0;
            let text = '';
            switch (res.data.status){
                case 200:
                    SuccessNotify(textNotify);
                    window.location.reload();
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
    })
}

async function loadBeerStoreCampaign() {
    if(checkLoadDataConfigBeerStore) return false;
    let method = 'get',
        url = 'beer-store.get-config',
        params = {
            brand_id: $('.select-brand').val()
        },
        data = null;
    checkLoadDataConfigBeerStore = 1;
    let res = await axiosTemplate(method, url, params, data,[$("#div-layout-store-campaign-campaign")]);
    checkLoadDataConfigBeerStore = 0;
    await dataBeerStoreCampaign(res.data[0].original.data);
    totalAmountBeerStore(res.data[1]);
    idFoodBeerStore = res.data[2]['food_id'];
    information = res.data[2].information;
    notifyContentDaily = res.data[2].notify_content_daily;
    notifyContentReset = res.data[2].notify_content_reset;
    hourSendNotify = res.data[2].hour_send_notify;
    termCampaign = res.data[2].term;
    useGuide = res.data[2].use_guide;
    bannerUrl = res.data[2].banner_image_url;
    valueStatusRunningBeerStore = res.data[2].running_status;
    if(Number(res.data[2].running_status) === 1){
        $('#btn-change-status-disable').removeClass('d-none');
        $('#btn-change-status-enable').addClass('d-none');
    }else {
        $('#btn-change-status-disable').addClass('d-none');
        $('#btn-change-status-enable').removeClass('d-none');
    }
}


async function getBeerMaterial() {
    let method = 'get',
        url = 'beer-store.material',
        params = {
            category_id: idCategoryBeerMaterial,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$(".select-material-beer-store-campaign")]);
    $('.select-material-beer-store-campaign').html(res.data[0]);
}

async function dataBeerStoreCampaign(data){
    let tableApplyingOneGetOneMarketing = $('#table-beer-store-campaign'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'quantity-one', name: 'quantity-one', className: 'text-center'},
            {data: 'quantity-two', name: 'quantity-two', className: 'text-center'},
            {data: 'quantity-three', name: 'quantity-three', className: 'text-center'},
            {data: 'quantity-four', name: 'quantity-four', className: 'text-center'},
            {data: 'quantity-five', name: 'quantity-five', className: 'text-center'},
            {data: 'quantity-six', name: 'quantity-six', className: 'text-center'},
            {data: 'quantity-seven', name: 'quantity-seven', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
        ],
        option = [{
            'title': 'CHÍNH SÁCH',
            'icon': 'fi-rr-box-alt seemt-orange',
            'class': ' seemt-orange seemt-bg-orange seemt-btn-hover-orange',
            'function': 'openModalSetPolicyBeerCampaign',
        },{
            'title': 'Cập nhật',
            'icon': 'fa fa-edit text-primary',
            'class': '',
            'function': 'SaveConfigBeerStore',
        }];
    dataTableConfigBeerStore = await DatatableTemplateNew(tableApplyingOneGetOneMarketing, data , column,  '100vh', fixed_left, fixed_right, option);
    $('#table-beer-store-campaign_filter').addClass('d-none');
    $('#table-beer-store-campaign_paginate').addClass('d-none');
    $('#table-beer-store-campaign_filter').addClass('d-none');
    $('#table-beer-store-campaign_length').addClass('d-none');
    $('#table-beer-store-campaign_info').addClass('d-none');
}

function totalAmountBeerStore(res) {
    $('#first-amount-beer-store').val(formatNumber(res.first_amount));
    $('#second-amount-beer-store').val(formatNumber(res.second_amount));
    $('#third-amount-beer-store').val(formatNumber(res.third_amount));
    $('#fourth-amount-beer-store').val(formatNumber(res.fourth_amount));
    $('#fifth-amount-beer-store').val(formatNumber(res.fifth_amount));
    $('#six-amount-beer-store').val(formatNumber(res.six_amount));
    $('#seven-amount-beer-store').val(formatNumber(res.seven_amount));
}
