let checkConfirmInventoryWarehouseManage = 0, fromInventoryWarehouseManage = $('.from-date-inventory-warehouse-manage').val(),
    toInventoryWarehouseManage = $('.to-date-inventory-warehouse-manage').val(),
    tabActiveInventoryWarehouseManage = 1, tableMaterialSearchInventoryWarehouse, tableGoodSearchInventoryWarehouse, tableInternalSearchInventoryWarehouse, tableOtherSearchInventoryWarehouse, tableCancelSearchInventoryWarehouse;
$(function () {
    if(getCookieShared('inventory-warehouse-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('inventory-warehouse-manage-user-id-' + idSession));
        fromInventoryWarehouseManage = dataCookie.from;
        toInventoryWarehouseManage = dataCookie.to;
        tabActiveInventoryWarehouseManage = dataCookie.tab;
        $('.from-date-inventory-warehouse-manage').val(fromInventoryWarehouseManage);
        $('.to-date-inventory-warehouse-manage').val(toInventoryWarehouseManage)
    }
    $('.from-date-inventory-warehouse-manage').on('dp.change', function () {
        $('.from-date-inventory-warehouse-manage').val($(this).val());
    });
    $('.to-date-inventory-warehouse-manage').on('dp.change', function () {
        $('.to-date-inventory-warehouse-manage').val($(this).val());
    });
    $('.search-btn-inventory-warehouse-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromInventoryWarehouseManage = $('.from-date-inventory-warehouse-manage').val();
        toInventoryWarehouseManage = $('.to-date-inventory-warehouse-manage').val();
        validateDateTemplate($('.from-date-inventory-warehouse-manage'), $('.to-date-inventory-warehouse-manage'), loadData);
    });
    $('#nav-tab-inventory-warehouse .nav-link').on('click', function (){
        tabActiveInventoryWarehouseManage = $(this).attr('data-id')
        updateCookieInventoryWarehouse()
    })
    dateTimePickerFromMaxToDate($('.from-date-inventory-warehouse-manage'), $('.to-date-inventory-warehouse-manage'))
    loadData();
    $('#nav-tab-inventory-warehouse a[data-id="' + tabActiveInventoryWarehouseManage + '"]').click()

});

function updateCookieInventoryWarehouse(){
    saveCookieShared('inventory-warehouse-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveInventoryWarehouseManage,
        'from' : fromInventoryWarehouseManage,
        'to' : toInventoryWarehouseManage,
    }))
}

async function loadData() {
    updateCookieInventoryWarehouse()
    let branch = $('.select-branch').val(),
        from = $('.from-date-inventory-warehouse-manage').val(),
        to = $('.to-date-inventory-warehouse-manage').val(),
        method = 'get',
        url = 'inventory.data',
        params = {
            branch: branch,
            from: from,
            to: to
        },
        data = null;
    let res = await (axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]));
    dataTableInventoryWarehouseManage(res);
    dataTotalInventoryWarehouseManage(res.data[5]);
}

async function dataTableInventoryWarehouseManage(data) {
    let tableMaterialInventoryWarehouseManage = $('#table-material-inventory-warehouse-manage'),
        tableGoodInventoryWarehouseManage = $('#table-goods-inventory-warehouse-manage'),
        tableInternalInventoryWarehouseManage = $('#table-internal-inventory-warehouse-manage'),
        tableOtherInventoryWarehouseManage = $('#table-other-inventory-warehouse-manage'),
        tableCancelInventoryWarehouseManage = $('#table-cancel-inventory-warehouse-manage'),
        fixed_left = 2,
        fixed_right = 1,
        columns1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee_create_name', name: 'employee', className: 'text-left'},
            {data: 'employee_confirm_name', name: 'employee_confirm', className: 'text-left'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'status_text', name: 'status_text', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        columns2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee_create_name', name: 'employee', className: 'text-left'},
            {data: 'employee_cancel_name', name: 'employee_cancel', className: 'text-left'},
            {data: 'time', name: 'time', className: 'text-center'},
            // {data: 'status_text', name: 'status_text', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openCreateInventoryWarehouseManage',
        }]
    tableMaterialSearchInventoryWarehouse = await DatatableTemplateNew(tableMaterialInventoryWarehouseManage, data.data[0].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableGoodSearchInventoryWarehouse = await DatatableTemplateNew(tableGoodInventoryWarehouseManage, data.data[1].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableInternalSearchInventoryWarehouse= await DatatableTemplateNew(tableInternalInventoryWarehouseManage, data.data[2].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableOtherSearchInventoryWarehouse = await DatatableTemplateNew(tableOtherInventoryWarehouseManage, data.data[3].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableCancelSearchInventoryWarehouse = await DatatableTemplateNew(tableCancelInventoryWarehouseManage, data.data[4].original.data, columns2, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', '#table-material-inventory-warehouse-manage_filter', async function () {
        $('#total-record-material').text(await tableMaterialSearchInventoryWarehouse.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-goods-inventory-warehouse-manage_filter',async function () {
        $('#total-record-goods').text(tableGoodSearchInventoryWarehouse.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-internal-inventory-warehouse-manage_filter',async function () {
        $('#total-record-internal').text(tableInternalSearchInventoryWarehouse.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-other-inventory-warehouse-manage_filter',async function () {
        $('#total-record-other').text(tableOtherSearchInventoryWarehouse.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-cancel-inventory-warehouse-manage_filter',async function () {
        $('#total-record-cancel').text(tableCancelSearchInventoryWarehouse.rows({'search':'applied'}).count())
    })
}

function dataTotalInventoryWarehouseManage(data) {
    $('#total-record-material').text(data.total_record_material);
    $('#total-record-goods').text(data.total_record_goods);
    $('#total-record-internal').text(data.total_record_internal);
    $('#total-record-other').text(data.total_record_other);
    $('#total-record-cancel').text(data.total_record_cancel);
}

function confirmInventoryWarehouseManage(r) {
    let id = r.data('id');
    if (checkConfirmInventoryWarehouseManage === 1) return false;
    let title = 'Xác nhận ?',
        content = 'Xác nhận hoàn tất phiếu kiểm kê sẽ chốt kỳ kiểm kê !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkConfirmInventoryWarehouseManage = 1;
            let method = 'post',
                url = 'inventory.confirm-checklist',
                params = null,
                data = {
                    id: id,
                    reason : r.data('reason'),
                    is_confirm : 1,
                    is_export_inventory_next_month : 0,
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#content-body-techres')
            ]);
            checkConfirmInventoryWarehouseManage = 0;
            let text = '';
            switch (res.data.status){
                case 200:
                    text = $('#success-confirm-data-to-server').text();
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
                default :
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}
function confirmCheckListNextMonthGoodsManage(r) {
    let id = r.data('id');
    if (checkConfirmInventoryWarehouseManage === 1) return false;
    let title = 'Xác nhận ?',
        content = 'Xác nhận hoàn tất phiếu kiểm kê sẽ chốt kỳ kiểm kê cho tháng tiếp theo !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkConfirmInventoryWarehouseManage = 1;
            let method = 'post',
                url = 'inventory.confirm-checklist',
                params = null,
                data = {
                    id: id,
                    reason : r.data('reason'),
                    is_confirm : 1,
                    is_export_inventory_next_month : 1,
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#content-body-techres')
            ]);
            checkConfirmInventoryWarehouseManage = 0;
            let text = '';
            switch (res.data.status){
                case 200:
                    text = $('#success-confirm-data-to-server').text();
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
                default :
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}
