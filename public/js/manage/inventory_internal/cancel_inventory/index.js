let tableEnableCancelInventoryInternalManage,
    tableDisableCancelInventoryInternalManage,
    fromCancelInventoryInternal = $('.from-date-cancel-inventory-internal-manage').val(),
    toCancelInventoryInternal = $('.to-date-cancel-inventory-internal-manage').val(),
    tabActiveCancelInventoryInternal = 1, checkConfirmCancelInventoryManage = 0;
$(function () {
    $('#nav-tab-cancel-inventory-internal-manage .nav-link').on('click', function (){
        tabActiveCancelInventoryInternal = $(this).attr('data-id');
        updateCookieCancelInventoryInternal()
    })
    dateTimePickerFromMaxToDate($('.from-date-cancel-inventory-internal-manage'), $('.to-date-cancel-inventory-internal-manage'))
    if(getCookieShared('cancel-inventory-internal-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('cancel-inventory-internal-manage-user-id-' + idSession));
        fromCancelInventoryInternal = dataCookie.from;
        toCancelInventoryInternal = dataCookie.to;
        tabActiveCancelInventoryInternal = dataCookie.tab;
        $('.from-date-cancel-inventory-internal-manage').val(fromCancelInventoryInternal);
        $('.to-date-cancel-inventory-internal-manage').val(toCancelInventoryInternal)
    }
    $('.search-btn-cancel-inventory-internal-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromCancelInventoryInternal = $('.from-date-cancel-inventory-internal-manage').val();
        toCancelInventoryInternal = $('.to-date-cancel-inventory-internal-manage').val();
        validateDateTemplate($('.from-date-cancel-inventory-internal-manage'), $('.to-date-cancel-inventory-internal-manage'), loadData);
    });
    loadData();
    $('.from-date-cancel-inventory-internal-manage').on('dp.change', function () {
        $('.from-date-cancel-inventory-internal-manage').val($(this).val());
    });
    $('.to-date-cancel-inventory-internal-manage').on('dp.change', function () {
        $('.to-date-cancel-inventory-internal-manage').val($(this).val());
    });
    $('#nav-tab-cancel-inventory-internal-manage a[data-id="' + tabActiveCancelInventoryInternal + '"]').click()
});

function updateCookieCancelInventoryInternal(){
    saveCookieShared('cancel-inventory-internal-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveCancelInventoryInternal,
        'from' : fromCancelInventoryInternal,
        'to' : toCancelInventoryInternal
    }))
}

async function loadData() {
    updateCookieCancelInventoryInternal()
    !$('.select-branch').val() ? await updateSessionBrandNew($('.select-brand')) : false;
    let branch = $('#select-branch-cancel-inventory-internal').val(),
        from = $('.from-date-cancel-inventory-internal-manage').val(),
        to = $('.to-date-cancel-inventory-internal-manage').val(),
        method = 'get',
        url = 'cancel-inventory-internal-manage.data',
        params = {branch: branch, from: from, to: to},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    dataTableCancelInventoryManage(res);
    dataTotalCancelInventoryManage(res.data[2]);
}

async function dataTableCancelInventoryManage(data) {
    let tableKitChenCancelInventoryInternalManage = $('#table-kitchen-cancel-inventory-internal-manage'),
        tableBarCancelInventoryInternalManage = $('#table-bar-cancel-inventory-internal-manage'),
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', class: 'text-left'},
            {data: 'employee', name: 'employee',className: 'text-left'},
            {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
            {data: 'total_material', name: 'total_material', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        fixed_left = 0,
        fixed_right = 0,
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openCreateCancelInventoryManage'
        }];
    tableEnableCancelInventoryInternalManage = await DatatableTemplateNew(tableKitChenCancelInventoryInternalManage, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDisableCancelInventoryInternalManage = await DatatableTemplateNew(tableBarCancelInventoryInternalManage, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-kitchen').text(tableEnableCancelInventoryInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-bar').text(tableDisableCancelInventoryInternalManage.rows({'search': 'applied'}).count())
    })
}

function dataTotalCancelInventoryManage(data) {
    $('#total-record-kitchen').text(data.total_record_kitchen);
    $('#total-record-bar').text(data.total_record_bar);
}

function confirmCancelInventoryManage(id, branch) {
    if (checkConfirmCancelInventoryManage === 1) return false;
    let title = 'Xác nhận Phiếu hủy';
    let text = '';
    let icon = 'warning';
    sweetAlertComponent(title, text, icon).then(async result => {
        if (result.value) {
            checkConfirmCancelInventoryManage = 1;
            let method = 'post';
            let url = 'cancel-inventory-internal-manage.confirm';
            let params = {
                id: id,
                branch: branch
            };
            let data = null;
            let res = await axiosTemplate(method, url, params, data);
            checkConfirmCancelInventoryManage = 0;
            let text = $('#success-confirm-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    });
}

