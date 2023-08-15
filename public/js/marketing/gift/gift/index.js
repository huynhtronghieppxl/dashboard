let tableEnableGiftMarketing,
    tableDisableGiftMarketing,
    thisTableGiftMarketing,
    checkSaveChangeStatusGift = 0,
    tabGiftMarketing = 0,
    foodsInit = '';

$(async function () {
    if(getCookieShared('gift-marketing-user-id' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('gift-marketing-user-id' + idSession));
        tabGiftMarketing = dataCookie.tab
    }
    ckEditorTemplate(['description-update-gift-marketing', 'content-update-gift-marketing', 'term-update-gift-marketing', 'use-guide-update-gift-marketing']);
    ckEditorTemplate(['description-create-gift-marketing', 'content-create-gift-marketing', 'use-guide-create-gift-marketing', 'term-create-gift-marketing']);
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'))
    }else {
        loadData();
    }

    $('#nav-gift-marketing .nav-link').on('click', function (){
        tabGiftMarketing = $(this).data('tab');
        updateCookieGiftMarketing();
    })
    $('#nav-gift-marketing .nav-link[data-tab="'+ tabGiftMarketing +'"]').click();
    $('#div-layout-gift-marketing .select-brand').on('change', loadDataFoodGiftMarketing);
    loadDataFoodGiftMarketing();
});

function updateCookieGiftMarketing(){
    saveCookieShared('gift-marketing-user-id' + idSession, JSON.stringify({
        tab: tabGiftMarketing
    }))
}

async function loadData() {
    let method = 'get',
        url = 'gift-marketing.data',
        brand = $('.select-brand').val(),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#div-layout-gift-marketing")]);
    dataTableGiftMarketing(res);
    $('#total-record-enable').text(res.data[2].total_record_enable);
    $('#total-record-disable').text(res.data[2].total_record_disable);
    // if(!$('.select-branch').val()) {
    //     await updateSessionBrandNew($('.select-brand'))
    // }
}

async function dataTableGiftMarketing(data) {
    let id1 = $('#table-enable-gift-marketing'),
        id2 = $('#table-disable-gift-marketing'),
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'logo', width: '5%', className: 'text-left'},
            {data: 'type', className: 'text-center'},
            {data: 'value', className: 'text-center'},
            {data: 'day', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none', width: '5%'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateGiftMarketing',
        }]
    tableEnableGiftMarketing = await DatatableTemplateNew(id1, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDisableGiftMarketing = await DatatableTemplateNew(id2, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);

    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-enable').text(tableEnableGiftMarketing.rows({'search': 'applied'}).count())
        $('#total-record-disable').text(tableDisableGiftMarketing.rows({'search': 'applied'}).count())
    })
}

function changeStatusGiftMarketing(r) {
    if (checkSaveChangeStatusGift === 1) return false;
    thisTableGiftMarketing = r;
    let title = 'Thay đổi trạng thái hoạt động',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'gift-marketing.change-status',
                params = null,
                data = {
                    id: r.data('id'),
                    confirmed: 0,
                };
            checkSaveChangeStatusGift = 1;
            let res = await axiosTemplate(method, url, params, data,[
                $("#table-enable-gift-marketing"),
                $("#table-disable-gift-marketing"),
                $("#thumbnail-gift-logo-create-gift-marketing"),
            ]);
            checkSaveChangeStatusGift = 0;
            let text = $('#success-status-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    drawTableStatusGiftMarketing(res.data.data);
                    break;
                case 300:
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-primary btn-sweet-alert',
                            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
                        },
                        buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Thay đổi trạng thái hoạt động !',
                        icon: 'question',
                        html:
                            '<label class="text-center font-1-em f-w-400">' + res.data.message + '</label>' ,
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: $('#button-btn-confirm-component').text(),
                        cancelButtonText: $('#button-btn-cancel-component').text(),
                        reverseButtons: true,
                        focusConfirm: true
                    }).then(async (result) => {
                        if(result.isConfirmed){
                            let method = 'post',
                                url = 'gift-marketing.change-status',
                                params = null,
                                data = {
                                    id: r.data('id'),
                                    confirmed: 1,
                                };
                            let res = await axiosTemplate(method, url, params, data,[
                                $("#table-enable-gift-marketing"),
                                $("#table-disable-gift-marketing"),
                                $("#thumbnail-gift-logo-create-gift-marketing"),
                            ]);
                            if (res.status === 200) {
                                SuccessNotify($('#success-status-data-to-server').text());
                                drawTableStatusGiftMarketing(res.data.data);
                            }
                        }
                    });
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

function drawTableStatusGiftMarketing(data) {
    let tableStatus;
    if (data.is_active === 0) {
        $('#tab-gift-marketing-2').click();
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) - 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) + 1));
        removeRowDatatableTemplate(tableEnableGiftMarketing,thisTableGiftMarketing, true);
      tableStatus = tableDisableGiftMarketing;
    } else {
        $('#tab-gift-marketing-1').click();
        $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
        $('#total-record-disable').text(formatNumber(removeformatNumber($('#total-record-disable').text()) - 1));
        removeRowDatatableTemplate(tableDisableGiftMarketing,thisTableGiftMarketing, true);
    tableStatus = tableEnableGiftMarketing;
    }
    addRowDatatableTemplate(tableStatus,{
        'type': data.gift_type,
        'value': data.value,
        'day': data.day,
        'action': data.action,
        'logo': data.logo,
        'keysearch': data.keysearch,
    })
}

async function loadDataFoodGiftMarketing() {
        let method = 'get',
            url = 'gift-marketing.food',
            params = {
                brand: $('.select-brand').val(),
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data,[
            $("#select-branch-create-gift-marketing"),
            $("#value-food-create-gift-marketing"),
            $("#table-food-create-gift-marketing"),
        ]);
        $('#value-food-create-gift-marketing').html(res.data[0]);
        $('#value-food-update-gift-marketing').html(res.data[0]);
        foodsInit = res.data[0];
}
