let checkConfirmChecklistGoodsManage = 0, fromCheckListGoodManage = $('.from-date-checklist-goods-manage').val(),
    toCheckListGoodManage = $('.to-date-checklist-goods-manage').val(),
    tabActiveCheckListGoodManage = 1, tableMaterialSearchCheckList, tableGoodSearchCheckList, tableInternalSearchCheckList, tableOtherSearchCheckList, tableCancelSearchCheckList;
$(async function () {
    if(getCookieShared('checklist-goods-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('checklist-goods-manage-user-id-' + idSession));
        fromCheckListGoodManage = dataCookie.from;
        toCheckListGoodManage = dataCookie.to;
        tabActiveCheckListGoodManage = dataCookie.tab;
        $('.from-date-checklist-goods-manage').val(fromCheckListGoodManage);
        $('.to-date-checklist-goods-manage').val(toCheckListGoodManage)
    }
    $('.from-date-checklist-goods-manage').on('dp.change', function () {
        $('.from-date-checklist-goods-manage').val($(this).val());
    });
    $('.to-date-checklist-goods-manage').on('dp.change', function () {
        $('.to-date-checklist-goods-manage').val($(this).val());
    });
    $('.search-btn-checklist-goods-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromCheckListGoodManage = $('.from-date-checklist-goods-manage').val();
        toCheckListGoodManage = $('.to-date-checklist-goods-manage').val();
        validateDateTemplate($('.from-date-checklist-goods-manage'), $('.to-date-checklist-goods-manage'), loadData);
    });
    $('#nav-tab-checklist-good .nav-link').on('click', function (){
        tabActiveCheckListGoodManage = $(this).attr('data-id')
        updateCookieCheckListGood()
    })
    // dateTimePickerTemplate($('.from-date-checklist-goods-manage'));
    // dateTimePickerTemplate($('.to-date-checklist-goods-manage'));
    dateTimePickerFromMaxToDate($('.from-date-checklist-goods-manage'), $('.to-date-checklist-goods-manage'));
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
    $('#nav-tab-checklist-good a[data-id="' + tabActiveCheckListGoodManage + '"]').click();

});

function updateCookieCheckListGood(){
    saveCookieShared('checklist-goods-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveCheckListGoodManage,
        'from' : fromCheckListGoodManage,
        'to' : toCheckListGoodManage,
    }))
}

async function loadData() {
    updateCookieCheckListGood();
    let branch = $('.select-branch').val(),
        from = $('.from-date-checklist-goods-manage').val(),
        to = $('.to-date-checklist-goods-manage').val(),
        method = 'get',
        url = 'checklist-goods-manage.data',
        params = {
            branch: branch,
            from: from,
            to: to
        },
        data = null;
    let res = await (axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]));
    dataTableCheckListGoodsManage(res);
    dataTotalCheckListGoodsManage(res.data[5]);
}

async function dataTableCheckListGoodsManage(data) {
    let tableMaterialChecklistGoodsManage = $('#table-material-checklist-goods-manage'),
        tableGoodChecklistGoodsManage = $('#table-goods-checklist-goods-manage'),
        tableInternalChecklistGoodsManage = $('#table-internal-checklist-goods-manage'),
        tableOtherChecklistGoodsManage = $('#table-other-checklist-goods-manage'),
        tableCancelChecklistGoodsManage = $('#table-cancel-checklist-goods-manage'),
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
            'function': 'openCreateCheckListGoodsManage',
        }]
    tableMaterialSearchCheckList = await DatatableTemplateNew(tableMaterialChecklistGoodsManage, data.data[0].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableGoodSearchCheckList = await DatatableTemplateNew(tableGoodChecklistGoodsManage, data.data[1].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableInternalSearchCheckList= await DatatableTemplateNew(tableInternalChecklistGoodsManage, data.data[2].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableOtherSearchCheckList = await DatatableTemplateNew(tableOtherChecklistGoodsManage, data.data[3].original.data, columns1, vh_of_table, fixed_left, fixed_right, option);
    tableCancelSearchCheckList = await DatatableTemplateNew(tableCancelChecklistGoodsManage, data.data[4].original.data, columns2, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', '#table-material-checklist-goods-manage_filter', async function () {
        $('#total-record-material').text(await tableMaterialSearchCheckList.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-goods-checklist-goods-manage_filter',async function () {
        $('#total-record-goods').text(tableGoodSearchCheckList.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-internal-checklist-goods-manage_filter',async function () {
        $('#total-record-internal').text(tableInternalSearchCheckList.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-other-checklist-goods-manage_filter',async function () {
        $('#total-record-other').text(tableOtherSearchCheckList.rows({'search':'applied'}).count())
    })

    $(document).on('input paste keyup keydown', '#table-cancel-checklist-goods-manage_filter',async function () {
        $('#total-record-cancel').text(tableCancelSearchCheckList.rows({'search':'applied'}).count())
    })
}

function dataTotalCheckListGoodsManage(data) {
    $('#total-record-material').text(data.total_record_material);
    $('#total-record-goods').text(data.total_record_goods);
    $('#total-record-internal').text(data.total_record_internal);
    $('#total-record-other').text(data.total_record_other);
    $('#total-record-cancel').text(data.total_record_cancel);
}

function confirmCheckListGoodsManage(r, status) {
    let id = r.data('id');
    if (checkConfirmChecklistGoodsManage === 1) return false;
    let title = 'Xác nhận ?',
        content = status === 1 ? 'Xác nhận số liệu kiểm kê !' : 'Xác nhận cân bằng kho sẽ hoàn tất phiếu kiểm kê và chốt kỳ kiểm kê !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkConfirmChecklistGoodsManage = 1;
            let method = 'post',
                url = 'checklist-goods-manage.confirm-checklist',
                params = null,
                data = {
                    id: id,
                    reason : '',
                    is_export_inventory_next_month : 0,
                    status: status
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#content-body-techres')
            ]);
            checkConfirmChecklistGoodsManage = 0;
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
    if (checkConfirmChecklistGoodsManage === 1) return false;
    let title = 'Xác nhận ?',
        content = 'Xác nhận hoàn tất phiếu kiểm kê sẽ chốt kỳ kiểm kê cho tháng tiếp theo !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkConfirmChecklistGoodsManage = 1;
            let method = 'post',
                url = 'checklist-goods-manage.confirm-checklist',
                params = null,
                data = {
                    id: id,
                    reason : '',
                    status : 2,
                    is_export_inventory_next_month : 1,
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#content-body-techres')
            ]);
            checkConfirmChecklistGoodsManage = 0;
            let text = '';
            switch (res.status){
                case 200:
                    text = $('#success-confirm-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    ErrorNotify(text);
                    break;
                default :
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}
