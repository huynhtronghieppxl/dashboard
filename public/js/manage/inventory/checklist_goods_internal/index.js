let fromCheckListGoodInternal = $('.from-date-checklist-goods-internal-manage').val(),
    toCheckListGoodInternal = $('.to-date-checklist-goods-internal-manage').val(),
    tabActiveCheckListGoodInternal = 1,
    typeCheckListGoodInternal = 1,
    checkConfirmCheckListGoodInternal = 0;

$(async function () {
    if (getCookieShared('checklist-goods-internal-manage-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('checklist-goods-internal-manage-user-id-' + idSession));
        // fromCheckListGoodInternal = dataCookie.from;
        // toCheckListGoodInternal = dataCookie.to;
        tabActiveCheckListGoodInternal = dataCookie.tab;
        typeCheckListGoodInternal = dataCookie.type
        // $('.from-date-checklist-goods-internal-manage').val(fromCheckListGoodInternal);
        // $('.to-date-checklist-goods-internal-manage').val(toCheckListGoodInternal)
    }
    $('#nav-tab-checklist-goods-internal-manage .nav-link').on('click', function () {
        if(tabActiveCheckListGoodInternal !=$(this).attr('data-id')){
            tabActiveCheckListGoodInternal = $(this).attr('data-id')
            let today = new Date(),
                firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1),
                formattedCurrentDate = today.toLocaleDateString('vi-VN', {day: '2-digit', month: '2-digit', year: 'numeric'}),
                formattedDate = firstDayOfMonth.toLocaleDateString('vi-VN', {day: '2-digit', month: '2-digit', year: 'numeric'});
            $('.from-date-checklist-goods-internal-manage').val(formattedDate);
            $('.to-date-checklist-goods-internal-manage').val(formattedCurrentDate)
            updateCookieCheckListGoodInternal();
        }

    })
    dateTimePickerFromMaxToDate($('.from-date-checklist-goods-internal-manage'), $('.to-date-checklist-goods-internal-manage'))
    $('.search-btn-checklist-goods-internal-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromCheckListGoodInternal = $('.from-date-checklist-goods-internal-manage').val();
        toCheckListGoodInternal = $('.to-date-checklist-goods-internal-manage').val();
        validateDateTemplate($('.from-date-checklist-goods-internal-manage'), $('.to-date-checklist-goods-internal-manage'), loadData);
    });
    $('.from-date-checklist-goods-internal-manage').on('dp.change', function () {
        $('.from-date-checklist-goods-internal-manage').val($(this).val());
    });
    $('.to-date-checklist-goods-internal-manage').on('dp.change', function () {
        $('.to-date-checklist-goods-internal-manage').val($(this).val());
    });
    $('.select-type-checklist-goods-internal-manage').on('select2:select', function () {
        typeCheckListGoodInternal = $(this).val();
        updateCookieCheckListGoodInternal();
        $('.select-type-checklist-goods-internal-manage').val($(this).val()).trigger('change.select2');
        validateDateTemplate($('.from-date-checklist-goods-internal-manage'), $('.to-date-checklist-goods-internal-manage'), loadData);
    })
    $('.select-type-checklist-goods-internal-manage').val(typeCheckListGoodInternal).trigger('change.select2');
    $('#nav-tab-checklist-goods-internal-manage a[data-id="' + tabActiveCheckListGoodInternal + '"]').click();
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

function updateCookieCheckListGoodInternal() {
    saveCookieShared('checklist-goods-internal-manage-user-id-' + idSession, JSON.stringify({
        'tab': tabActiveCheckListGoodInternal,
        'from': fromCheckListGoodInternal,
        'to': toCheckListGoodInternal,
        'type': typeCheckListGoodInternal,
    }))
}

async function loadData() {
    updateCookieCheckListGoodInternal()
    let branch = $('#select-branch-checklist-goods-internal').val(),
        from = $('.from-date-checklist-goods-internal-manage').val(),
        to = $('.to-date-checklist-goods-internal-manage').val(),
        type = $('.select-type-checklist-goods-internal-manage').val(),
        method = 'get',
        url = 'checklist-goods-internal-manage.data',
        params = {
            branch: branch,
            from: from,
            to: to,
            type: type
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    dataTableCheckListGoodsInternalDayManage(res);
    dataTotalCheckListGoodsInternalDayManage(res.data[4]);
}

let tablePendingChecklistGoodInternalManage,tableWarningChecklistGoodInternalManage,tableCompleteChecklistGoodInternalManage,tableCancelChecklistGoodInternalManage;

async function dataTableCheckListGoodsInternalDayManage(data) {
    let idTablePendingChecklistGoodInternalManage = $('#table-pending-checklist-goods-internal-manage'),
        idTableWaitingChecklistGoodInternalManage = $('#table-waiting-checklist-goods-internal-manage'),
        idTableCompleteChecklistGoodInternalManage = $('#table-complete-checklist-goods-internal-manage'),
        idTableCancelChecklistGoodInternalManage = $('#table-cancel-checklist-goods-internal-manage'),
        fixed_left = 2,
        fixed_right = 1,
        columnsPendingAndWarning = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee', name: 'employee', className: 'text-left'},
            {data: 'branch_inner_inventory_type', name: 'branch_inner_inventory_type', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        columnsCompleteAndCancel = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee', name: 'employee', className: 'text-left'},
            {data: 'employee_update', name: 'employee_update', className: 'text-left'},
            {data: 'branch_inner_inventory_type', name: 'branch_inner_inventory_type', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ], option = [
            {
                'title': 'Thêm mới ngày',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateCheckListGoodsInternalManage',
            },
            {
                'title': 'Thêm mới kỳ',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreatePeriodCheckListGoodsInternalManage',
            }];
    tablePendingChecklistGoodInternalManage = await DatatableTemplateNew(idTablePendingChecklistGoodInternalManage, data.data[0].original.data, columnsPendingAndWarning, vh_of_table, fixed_left, fixed_right, option);
    tableWarningChecklistGoodInternalManage = await DatatableTemplateNew(idTableWaitingChecklistGoodInternalManage, data.data[1].original.data, columnsPendingAndWarning, vh_of_table, fixed_left, fixed_right, option);
    tableCompleteChecklistGoodInternalManage = await DatatableTemplateNew(idTableCompleteChecklistGoodInternalManage, data.data[2].original.data, columnsCompleteAndCancel, vh_of_table, fixed_left, fixed_right, option);
    tableCancelChecklistGoodInternalManage = await DatatableTemplateNew(idTableCancelChecklistGoodInternalManage, data.data[3].original.data, columnsCompleteAndCancel, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-pending').text(tablePendingChecklistGoodInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-waiting').text(tableWarningChecklistGoodInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-complete').text(tableCompleteChecklistGoodInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-cancel').text(tableCancelChecklistGoodInternalManage.rows({'search': 'applied'}).count())
    })
}

function dataTotalCheckListGoodsInternalDayManage(data) {
    $('#total-record-pending').text(data.total_record_pending);
    $('#total-record-waiting').text(data.total_record_waiting);
    $('#total-record-complete').text(data.total_record_complete);
    $('#total-record-cancel').text(data.total_record_cancel);
}

function confirmChecklistGoodsInternalManage(r, status, exportNextMonth) {
    let id = r.data('id');
    if (checkConfirmCheckListGoodInternal === 1) return false;
    let title = exportNextMonth === 1 ? 'Xác nhận hoàn tất phiếu kiểm kê sẽ chốt kỳ kiểm kê cho tháng tiếp theo !' :'Xác nhận hoàn tất phiếu kiểm kê',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkConfirmCheckListGoodInternal = 1;
            let method = 'post',
                url = 'checklist-goods-internal-manage.confirm',
                params = null,
                data = {
                    id: id,
                    reason : '',
                    status: status,
                    is_export_inventory_next_month : exportNextMonth,
            };
            let res = await axiosTemplate(method, url, params, data);
            checkConfirmCheckListGoodInternal = 0;


            let text = $('#success-confirm-data-to-server').text();
            switch (res.status){
                case 200:
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
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.message !== null) {
                        text = res.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}


function confirmCheckListGoodsInternalNextMonthGoodsManage(r, status, exportNextMonth) {
    let id = r.data('id');
    if (checkConfirmCheckListGoodInternal === 1) return false;
    let title = 'Xác nhận ?',
        content = 'Xác nhận hoàn tất phiếu kiểm kê sẽ chốt kỳ kiểm kê cho tháng tiếp theo !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkConfirmCheckListGoodInternal = 1;
            let method = 'post',
                url = 'checklist-goods-internal-manage.confirm',
                params = null,
                data = {
                    id: id,
                    reason : '',
                    status: status,
                    is_export_inventory_next_month : exportNextMonth,
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#content-body-techres')
            ]);
            checkConfirmCheckListGoodInternal = 0;
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
