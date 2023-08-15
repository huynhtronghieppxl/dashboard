let focus_status_booking_manage = 0,
    branchIdBookingTableManage = -1,
    nameBranchBookingTable = '',
    dataTableProcessingBookingManage,
    dataTableDoneBookingManage, checkAcceptCustomerBookingTableManage,
    dataTableCancelBookingManage,
    clickOffStatusBranchBookingTableManage,
    dataListGiftBooking = [],
    typeTimeBookingTable = 2, typeBranchDetailBookingTable, tabBookingManage = 1, statusEnableBooking
    , monthBookingTable, fromBookingTable, toBookingTable, typeSettingBookingTable = 0, nameBranch, vh_of_modal,
    isEnableBookingBrand = 0,
    isLoadingTotalBooking = 0,
    checkLoadDataCreateBooking = 0;

$(async function () {
    dateTimePickerNormalTemplate($('.from-date-booking-table-manage'));
    dateTimePickerNormalTemplate($('.to-date-booking-table-manage'));
    dateTimePickerMonthYearTemplate($('.month-booking-table-manage'));
    $('.search-time-booking-table-manage').on('click', function () {
        if (!checkDateTimePicker($(this))) {
            return false
        }
        fromBookingTable = $('.from-date-booking-table-manage').val();
        toBookingTable = $('.to-date-booking-table-manage').val();
        $('.select-type-booking-table-manage option[value=4]').data('from', $('.from-date-booking-table-manage').val());
        $('.select-type-booking-table-manage option[value=4]').data('to', $('.to-date-booking-table-manage').val());
        cookieBookingTable()
        loadData();
    });
    $('.from-date-booking-table-manage').on('dp.change', function () {
        $('.from-date-booking-table-manage').val($(this).val())
        $('.select-type-booking-table-manage option[value=4]').attr('data-from', $(this).val())
    })
    $('.to-date-booking-table-manage').on('dp.change', function () {
        $('.to-date-booking-table-manage').val($(this).val())
        $('.select-type-booking-table-manage option[value=4]').attr('data-to', $(this).val())
    })
    $('.month-booking-table-manage').on('dp.change', function () {
        $('.month-booking-table-manage').val($(this).val())
        $('.select-type-booking-table-manage option[value=3]').attr('data-from', moment($(this).val(), 'MM/YYYY').startOf('month').format('DD/MM/YYYY'))
        $('.select-type-booking-table-manage option[value=3]').attr('data-to', moment($(this).val(), 'MM/YYYY').endOf('month').format('DD/MM/YYYY'))
    })
    $('.search-month-booking-table-manage').on('click', function () {
        monthBookingTable = $('.month-booking-table-manage').val();
        $('.select-type-booking-table-manage option[value=3]').data('from', moment(monthBookingTable, 'MM/YYYY').startOf('month').format('DD/MM/YYYY'))
        $('.select-type-booking-table-manage option[value=3]').data('to', moment(monthBookingTable, 'MM/YYYY').endOf('month').format('DD/MM/YYYY'))
        cookieBookingTable()
        loadData();
    });
    vh_of_modal = $('#modal-update-booking-table-manage .modal-content').outerHeight(true) - ($('#modal-update-booking-table-manage .modal-header').outerHeight(true) + $('#modal-update-booking-table-manage .modal-footer').outerHeight(true)) + 'px';
    $('#list-branch-booking').addClass('d-none');
    $('#data-visible-booking-manage').addClass('d-none');
    //get cookie
    if (getCookieShared('booking-table-manage-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('booking-table-manage-user-id-' + idSession));
        typeSettingBookingTable = dataCookie.typeSetting;
        typeBranchDetailBookingTable = dataCookie.typeBranch;
        tabBookingManage = dataCookie.tab;
        typeTimeBookingTable = dataCookie.typeTime;
        monthBookingTable = dataCookie.month;
        fromBookingTable = dataCookie.from;
        toBookingTable = dataCookie.to;
        nameBranch = dataCookie.nameBranch;
        nameBranchBookingTable = dataCookie.nameBranch;
        statusEnableBooking = dataCookie.statusEnableBooking
        branchIdBookingTableManage = dataCookie.branchIdBookingTableManage
        if (monthBookingTable) {
            $('.month-booking-table-manage').val(monthBookingTable);
        }
        if (fromBookingTable) {
            $('.from-date-booking-table-manage').val(fromBookingTable);
            $('.select-type-booking-table-manage option[value=4]').attr('data-from', fromBookingTable);
        }
        if (toBookingTable) {
            $('.to-date-booking-table-manage').val(toBookingTable);
            $('.select-type-booking-table-manage option[value=4]').attr('data-to', toBookingTable);
        }
        $('.select-type-booking-table-manage').val(typeTimeBookingTable).trigger('change.select2')
        if (+typeTimeBookingTable === 3) {
            $('.div-time-booking-table-manage').addClass('d-none');
            $('.div-month-booking-table-manage').removeClass('d-none');
        }
        if (+typeTimeBookingTable === 4) {
            $('.div-time-booking-table-manage').removeClass('d-none');
            $('.div-month-booking-table-manage').addClass('d-none');
        }

        if (+typeSettingBookingTable !== 0 && branchIdBookingTableManage == $('.select-branch').val()) {
            $('#form-list-branch-booking').addClass('d-none');
            $('#data-visible-booking-manage').removeClass('d-none');
            dataVisibleBookingManage(branchIdBookingTableManage);
        } else {
            $('#list-branch-booking').removeClass('d-none');
            if ($('.select-branch').val()) {
                dataListBranchBookingManage();
            } else {
                await updateSessionBrandNew($('.select-brand'));
            }
        }
    } else {
        $('#list-branch-booking').removeClass('d-none');
        $('#data-visible-booking-manage').addClass('d-none');
        if (!$('.select-branch').val()) {
            await updateSessionBrandNew($('.select-brand'));
        } else {
            dataListBranchBookingManage();
        }
    }
    $('#btn-back-list-branch').on('click', function () {
        typeSettingBookingTable = 0;
        branchIdBookingTableManage = -1;
        monthBookingTable = '';
        typeTimeBookingTable = 2;
        tabBookingManage = 1;
        fromBookingTable = '';
        nameBranchBookingTable = '';
        toBookingTable = '';
        isEnableBookingBrand = '';
        $('#data-visible-booking-manage').addClass('d-none');
        $('#form-list-branch-booking').removeClass('d-none');
        $('#button-service-1').addClass('d-none')
        $('#list-branch-booking').removeClass('d-none');
        $('.div-time-booking-table-manage').addClass('d-none');
        $('.div-month-booking-table-manage').addClass('d-none');
        checkLoadDataCreateBooking = 0;
        cookieBookingTable();
        !$('.branch-booking-table-box').length ? dataListBranchBookingManage() : false;

    })
    if ($('#enable_booking').is(':checked')) {
        $('.branch-setting-detail').removeClass('d-none');
    }

    $('.select-type-booking-table-manage').on('change', function () {
        typeTimeBookingTable = $(this).val();
        cookieBookingTable();
        switch ($(this).val()) {
            case '1':
                $('.div-time-booking-table-manage').addClass('d-none');
                $('.div-month-booking-table-manage').addClass('d-none');
                dataVisibleBookingManage(branchIdBookingTableManage);
                break;
            case '2':
                $('.div-time-booking-table-manage').addClass('d-none');
                $('.div-month-booking-table-manage').addClass('d-none');
                dataVisibleBookingManage(branchIdBookingTableManage);
                break;
            case '3':
                $('.div-time-booking-table-manage').addClass('d-none');
                $('.div-month-booking-table-manage').removeClass('d-none');
                dataVisibleBookingManage(branchIdBookingTableManage);
                break;
            case '4':
                $('.div-month-booking-table-manage').addClass('d-none');
                $('.div-time-booking-table-manage').removeClass('d-none');
                if (!checkDateTimePicker($('#search-time-booking-table-manage'))) {
                    return false
                } else {
                    dataVisibleBookingManage(branchIdBookingTableManage);
                }
                break;

        }
        monthBookingTable = $('.month-booking-table-manage').val();
        fromBookingTable = $('.from-date-booking-table-manage').val();
        toBookingTable = $('.to-date-booking-table-manage').val();
        $('.select-type-booking-table-manage').val($(this).val()).trigger('change.select2')
        cookieBookingTable()
    })
    $('#type-branch-detail .btn-detail-branch-booking').on('click', function () {
        statusEnableBooking = $(this).data('enable-booking')
        typeBranchDetailBookingTable = $(this).data('type');
        nameBranch = $(this).data('name')
        nameBranchBookingTable = $(this).data('name')
        cookieBookingTable();
    })
    $('#nav-tabs-booking-table a').on('click', function () {
        tabBookingManage = $(this).data('tab');
        cookieBookingTable();
    })

    $('.select-type-booking-table-manage').on('change', function () {
        typeTimeBookingTable = $(this).val();
        cookieBookingTable()
    })
    $('#nav-tabs-booking-table a[data-tab="' + tabBookingManage + '"]').click()
});

//set Cookie
function cookieBookingTable() {
    saveCookieShared('booking-table-manage-user-id-' + idSession, JSON.stringify({
        'typeSetting': typeSettingBookingTable,
        'typeBranch': typeBranchDetailBookingTable,
        'tab': tabBookingManage,
        'typeTime': typeTimeBookingTable,
        'month': monthBookingTable,
        'from': fromBookingTable,
        'to': toBookingTable,
        'nameBranch': nameBranchBookingTable,
        'statusEnableBooking': statusEnableBooking,
        'branchIdBookingTableManage': branchIdBookingTableManage,
        'isEnableBookingBrand': isEnableBookingBrand
    }))
}

async function loadData() {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
    if (typeSettingBookingTable != 0 && branchIdBookingTableManage == $('.select-branch').val()) {
        $('#form-list-branch-booking').addClass('d-none');
        $('#data-visible-booking-manage').removeClass('d-none');
        dataVisibleBookingManage(branchIdBookingTableManage);
    } else {
        $('#list-branch-booking').removeClass('d-none');
        $('#data-visible-booking-manage').addClass('d-none');
        dataListBranchBookingManage();
    }
}

async function totalBookingPressing(id) {
    let method = 'get',
        url = 'booking-table-manage.total-booking',
        params = {
            restaurant_brand_id: $('.select-brand').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, []);
    for (let i = 0; i < res.data.data.length; i++) {
        $('#number-booking-prosesing-' + res.data.data[i]['branch_id']).text(res.data.data[i]['total']);
    }
}

async function detailBranch(button) {
    if (button.parents('.box-image').find('.js-switch').is(':checked')) {
        isEnableBookingBrand = 1
    } else isEnableBookingBrand = 0
    typeSettingBookingTable = 1;
    cookieBookingTable();
    $('#nav-tabs-booking-table a.nav-link').removeClass('active');
    $('#nav-tabs-booking-table a.nav-link[data-tab="' + 1 + '"]').addClass('active');
    $('#nav-tabs-booking-table a.nav-link[data-tab="' + 1 + '"]').click();
    if (button.attr('data-enable-booking') == '0') {
        $('#button-service-1').addClass('d-none');
        statusEnableBooking = 0
    } else {
        $('#button-service-1').removeClass('d-none');
        statusEnableBooking = 1
    }
    $('#branch_id').val(button.attr('data-id'));
    branchIdBookingTableManage = button.attr('data-id');
    nameBranchBookingTable = button.attr('data-name');
    $('#data-visible-booking-manage').removeClass('d-none');
    $('#form-list-branch-booking').addClass('d-none');
    cookieBookingTable()
    dataVisibleBookingManage(branchIdBookingTableManage);
    // totalBookingPressing(branchIdBookingTableManage);
    typeTimeBookingTable = 2;
    $('.select-type-booking-table-manage').val(typeTimeBookingTable).trigger('change.select2')
}

async function dataVisibleBookingManage(id) {
    let dataCookie
    if (getCookieShared('booking-table-manage-user-id-' + idSession)) {
        dataCookie = JSON.parse(getCookieShared('booking-table-manage-user-id-' + idSession));
    }
    let method = 'get',
        url = 'branch-detail.data-booking',
        from = $('.select-type-booking-table-manage option:selected').data('from'),
        to = $('.select-type-booking-table-manage option:selected').data('to'),
        branch = id,
        params = {from: from, to: to, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-processing-booking-table-manage'),
        $('#table-done-booking-table-manage'),
        $('#table-cancel-booking-table-manage'),
        $('#list-branch-booking')
    ]);
    dataTableBookingTableManage(res);
    dataTotalBookingTableManage(res.data[3]);
}

async function dataListBranchBookingManage() {
    let method = 'get',
        url = 'branch-detail.data-list-branch-booking',
        data = null;
    let res = await axiosTemplate(method, url, null, data, [$('#list-branch-booking')]);
    $('#list-branch-booking').html(res.data);
    totalBookingPressing();
    $('.js-switch').each(function () {
        let switchery = new Switchery(this);
        if ($(this).attr('data-disabled-brand') == 0) {
            switchery.disable()
        }
    });
    $('.switchery').on('click', function () {
        if ($(this).parents('li').find('input').attr('data-disabled-brand') == 0) {
            WarningNotify('Chức năng đặt bàn của thương hiệu này đang tắt')
            return
        }
    });
    // totalBookingPressing()
    $('#nav-tabs-booking-table a.nav-link').removeClass('active');
    $('#nav-tabs-booking-table a.nav-link[data-tab="' + tabBookingManage + '"]').addClass('active');
    $('#nav-tabs-booking-table a.nav-link[data-tab="' + tabBookingManage + '"]').click();
}

async function dataTableBookingTableManage(data) {
    let option1 = '';
    let option2 = [{
        'title': 'Thêm mới (F2)',
        'icon': 'fa fa-plus text-primary',
        'class': '',
        'function': 'openModalCreateBookingTableManage',
    }]
    let checkOption = statusEnableBooking === 0 ? option1 : option2
    let id1 = $('#table-processing-booking-table-manage'),
        id2 = $('#table-done-booking-table-manage'),
        id3 = $('#table-cancel-booking-table-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-left'},
            {data: 'booking_type_name', name: 'booking_type_name', className: 'text-left'},
            {data: 'employee_create_name', name: 'employee', className: 'text-left'},
            {data: 'deposit_amount', name: 'deposit_amount', className: 'text-right', width: '15%'},
            {data: 'return_deposit_amount', name: 'return_deposit_amount', className: 'text-right', width: '15%'},
            {data: 'number_slot', name: 'number_slot', className: 'text-center', width: '15%'},
            {data: 'booking_time', name: 'booking_time', className: 'text-center'},
            {data: 'status_text', name: 'status_text', className: 'text-center'},
            {data: 'action', name: 'action', className: '', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-left'},
            {data: 'booking_type_name', name: 'booking_type_name', className: 'text-left'},
            {data: 'employee_create_name', name: 'employee', className: 'text-left'},
            {data: 'deposit_amount', name: 'deposit_amount', className: 'text-right', width: '15%'},
            {data: 'return_deposit_amount', name: 'return_deposit_amount', className: 'text-right', width: '15%'},
            {data: 'number_slot', name: 'number_slot', className: 'text-center', width: '15%'},
            {data: 'booking_time', name: 'booking_time', className: 'text-center'},
            {data: 'status_text', name: 'status_text', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'}
        ],
        option = checkOption
    dataTableProcessingBookingManage = await DatatableTemplateNew(id1, data.data[0].original.data, column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableDoneBookingManage = await DatatableTemplateNew(id2, data.data[1].original.data, column2, vh_of_table, fixed_left, fixed_right, option);
    dataTableCancelBookingManage = await DatatableTemplateNew(id3, data.data[2].original.data, column2, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste keyup keydown', 'input[type="search"]', async function () {
        $('#total-record-done').text(dataTableDoneBookingManage.rows({'search': 'applied'}).count());
        $('#total-record-processing').text(dataTableProcessingBookingManage.rows({'search': 'applied'}).count());
        $('#total-record-cancel').text(dataTableCancelBookingManage.rows({'search': 'applied'}).count());
        searchTable(dataTableProcessingBookingManage,
            $('#total-deposit-amount-booking-manage-in-processing-table'),
            $('#total-return-deposit-amount-booking-manage-in-processing-table'),
            $('#total-customer-booking-manage-in-processing-table'))
        searchTable(dataTableDoneBookingManage,
            $('#total-deposit-amount-booking-manage-in-completed-table'),
            $('#total-return-deposit-amount-booking-manage-in-completed-table'),
            $('#total-customer-booking-manage-in-completed-table'))
        searchTable(dataTableCancelBookingManage,
            $('#total-deposit-amount-booking-manage-in-cancel-table'),
            $('#total-return-deposit-amount-booking-manage-in-cancel-table'),
            $('#total-customer-booking-manage-in-cancel-table'))

    })
}

function searchTable(data, idDeposit, idReturn, idCustomer) {
    let totalDepositAmount = 0,
        totalReturnAmount = 0,
        totalCustomer = 0;
    data.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalDepositAmount += removeformatNumber(row.find('td:eq(5)').text());
        totalReturnAmount += removeformatNumber(row.find('td:eq(6)').text());
        totalCustomer += removeformatNumber(row.find('td:eq(7)').text());
    })
    idDeposit.text(formatNumber(totalDepositAmount));
    idReturn.text(formatNumber(totalReturnAmount));
    idCustomer.text(formatNumber(totalCustomer));
}

function dataTotalBookingTableManage(data) {
    $('#total-record-processing').text(data.total_record_processing);
    $('#total-record-done').text(data.total_record_done);
    $('#total-record-cancel').text(data.total_record_cancel);
    $('#total-customer-booking-manage-in-processing-table').text(data.total_customer_table_processing);
    $('#total-customer-booking-manage-in-completed-table').text(data.total_customer_table_done);
    $('#total-customer-booking-manage-in-cancel-table').text(data.total_customer_table_cancel);
    $('#total-deposit-amount-booking-manage-in-processing-table').text(data.total_deposit_amount_table_processing);
    $('#total-deposit-amount-booking-manage-in-cancel-table').text(data.total_deposit_amount_table_cancel);
    $('#total-deposit-amount-booking-manage-in-completed-table').text(data.total_deposit_amount_table_done);
    $('#total-return-deposit-amount-booking-manage-in-processing-table').text(data.total_return_deposit_amount_table_processing)
    $('#total-return-deposit-amount-booking-manage-in-completed-table').text(data.total_return_deposit_amount_table_done)
    $('#total-return-deposit-amount-booking-manage-in-cancel-table').text(data.total_return_deposit_amount_table_cancel)

}

function changeStatusSettingBookingManage(r) {
    branchIdBookingTableManage = r.data('id');
    clickOffStatusBranchBookingTableManage = r;
    if (focus_status_booking_manage === 0) {
        if (r.is(':checked') === false) {
            let title = 'Hủy kích hoạt đặt bàn trực tuyến ?',
                content = '',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    let method = 'post',
                        url = 'booking-table-manage.setting',
                        params = {branch: branchIdBookingTableManage, booking: 0},
                        data = null;
                    let res = await axiosTemplate(method, url, params, data);
                    let text = '';
                    switch (res.data.status) {
                        case 200:
                            SuccessNotify('Hủy kích hoạt đặt bàn trực tuyến thành công')
                            r.parents('.box-image').find('.btn-detail-branch-booking').attr('data-enable-booking', 0)
                            break;
                        case 500:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            ErrorNotify(text);
                            return false;
                            break;
                        default:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            WarningNotify(text);
                            return false;
                    }
                    r.prop('checked', false);
                } else {
                    focus_status_booking_manage = 1;
                    r.click();
                    focus_status_booking_manage = 0;
                }
            })
        } else {
            let title = 'Kích hoạt đặt bàn trực tuyến ?',
                content = '',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    let method = 'post',
                        url = 'booking-table-manage.setting',
                        params = {branch: branchIdBookingTableManage, booking: 1},
                        data = null;
                    let res = await axiosTemplate(method, url, params, data);
                    let text = '';
                    switch (res.data.status) {
                        case 200:
                            SuccessNotify('Kích hoạt đặt bàn trực tuyến thành công')
                            r.parents('.box-image').find('.btn-detail-branch-booking').attr('data-enable-booking', 1)
                            break;
                        case 500:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            ErrorNotify(text);
                            return false;
                            break;
                        default:
                            text = $('#error-post-data-to-server').text();
                            if (res.data.message !== null) {
                                text = res.data.message;
                            }
                            WarningNotify(text)
                    }
                    r.prop('checked', true);
                } else {
                    focus_status_booking_manage = 1;
                    r.click();
                    focus_status_booking_manage = 0;
                }
            })
        }
    }
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
}

let checkConfirmBookingTableManage = 0;

async function confirmBookingTableManage(r) {
    if (checkConfirmBookingTableManage === 1) return false;
    checkConfirmBookingTableManage = 1;
    let title = 'Xác nhận đặt bàn ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.confirm',
                params = null,
                data = {
                    id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-modal-confirm-booking-table-manage')
            ]);
            checkConfirmBookingTableManage = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-confirm-data-to-server ').text();
                    SuccessNotify(text);
                    r.parents('tr').find('td:eq(9)').html(String(res.data.data.status_text));
                    r.parents('.btn-group').html(res.data.data.action);
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
        } else {
            checkConfirmBookingTableManage = 0;
        }
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
    })
}

let checkSetupBookingTableManage = 0;

async function setupBookingTableManage(r) {
    if (checkSetupBookingTableManage === 1) return false;
    checkSetupBookingTableManage = 1;
    let title = 'Setup đặt bàn?',
        content = '',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.setup',
                params = null,
                data = {
                    booking_id: r.data('id'),
                    branch_id: r.data('branch')
                };
            let res = await axiosTemplate(method, url, params, data);
            checkSetupBookingTableManage = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Setup thành công!');
                    r.parents('tr').find('td:eq(9)').html(String(res.data.data.status_text));
                    r.parents('.btn-group').html(res.data.data.action);
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
        } else {
            checkSetupBookingTableManage = 0;
        }
    })
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
}

let checkConfirmDepositBookingDataTableManage = 0;

function confirmDepositBookingDataTableManage(r) {
    if (checkConfirmDepositBookingDataTableManage === 1) return false;
    checkConfirmDepositBookingDataTableManage = 1;
    let title = 'Xác nhận cọc ?',
        content = '',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.confirm-deposit',
                params = null,
                data = {
                    booking_id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data);
            checkConfirmDepositBookingDataTableManage = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Xác nhận cọc thành công!');
                    r.parents('tr').find('td:eq(9)').html(res.data.data.status_text)
                    r.parents('.btn-group').html(res.data.data.action);
                    break;
                case 500:
                    text = 'Xác nhận cọc không thành công!';
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    return false;
                    break;
                default:
                    text = 'Xác nhận cọc không thành công!';
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
                    return false;
            }
        } else {
            checkConfirmDepositBookingDataTableManage = 0;
        }
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
}

async function acceptCustomerBookingTableManage(r) {
    if (checkAcceptCustomerBookingTableManage === 1) return false;
    checkAcceptCustomerBookingTableManage = 1;
    let title = 'Nhận khách tại bàn này?',
        content = '',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table-manage.accept-customer',
                params = null,
                data = {
                    id: r.data('id'),
                    branch: r.data('branch'),
                };
            let res = await axiosTemplate(method, url, params, data);
            checkAcceptCustomerBookingTableManage = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    SuccessNotify('Nhận khách thành công!');
                    r.parents('tr').find('td:eq(9)').html(res.data.data.status_text)
                    r.parents('.btn-group').html(res.data.data.action);
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
        } else {
            checkAcceptCustomerBookingTableManage = 0;
        }
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
    })

}
