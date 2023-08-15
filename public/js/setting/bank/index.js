let dataTableBankEnable = [],
    dataTableBankDisable = [],
    tabBankDataChange = 0,
    checkChangeStatusBank = 0,
    checkAssignBank = 0,
    thisRowChangeStatusBank,
    dataOptionBank,
    checkDataBankBankData = 0;

$(function () {
    if (getCookieShared('bank-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('bank-data-user-id-' + idSession));
        tabBankDataChange = dataCookie.tabBankDataChange;
    }

    $('#nav-bank-data .nav-link').on('click', function () {
        tabBankDataChange = $(this).data('tab');
        if (tabBankDataChange === 1) {
            $('.bank-is-default').addClass('d-none')
        } else {
            $('.bank-is-default').removeClass('d-none')
        }
        updateCookieBankData();
    })
    $('#nav-bank-data .nav-link[data-tab="' + tabBankDataChange + '"]').click();

    $('.select-brand-bank-data').on('change', function () {
        loadData();
    })

    loadData();
});

async function loadData() {
    $('#name-bank-account').html();
    let restaurant_brand_id = $('.select-brand-bank-data').val();
    let method = 'get',
        url = 'bank-setting.data',
        params = {
            restaurant_brand_id: restaurant_brand_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-enable-bank-data'), $('#table-disable-bank-data')]);
    let isChecked = res.data[0].original.data.find((item) => item.is_default === 1)
    if (isChecked) {
        $('#name-bank-account').text(`${isChecked.bank_name} - ${isChecked.bank_account_name}`)
    }
    $('#name-branch').text($('.select-brand-bank-data').find(':selected').text());
    dataTableBankData(res);
    dataTotalBankData(res.data[2]);
}

async function dataBankOptionBankData() {
    if (checkDataBankBankData === 1) {
        return false;
    }

    if (dataOptionBank) {
        return false
    }

    let method = 'get',
        url = 'bank-setting.bank',
        params = null,
        data = null;
    checkDataBankBankData = 1;
    let res = await axiosTemplate(method, url, params, data, [$('#bank-create-bank-data'), $('#bank-update-bank-data')])
    checkDataBankBankData = 0;
    dataOptionBank = res.data[0]
    $('#bank-create-bank-data').html(res.data[0]);
    $('#bank-update-bank-data').html(res.data[0]);
}

async function changeStatusBank(r) {
    if (checkChangeStatusBank === 1) {
        return;
    }
    thisRowChangeStatusBank = r;
    let title = 'Đổi trạng thái ?',
        content = 'Đổi trạng thái hoạt động cho tài khoản !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'bank-setting.change-status',
                params = null,
                data = {id: r.data('id')},
                text = $('#success-status-data-to-server').text();
            checkChangeStatusBank = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkChangeStatusBank = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify(text);
                    drawTableChangeStatusBank(res.data.data);
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
    })
}

function drawTableChangeStatusBank(data) {
    if (data.status === 1) {
        removeRowDatatableTemplate(dataTableBankDisable, thisRowChangeStatusBank, true)
        addRowDatatableTemplate(dataTableBankEnable, {
            'checkbox': data.checkbox,
            'bank_name': data.bank_name,
            'bank_number': data.bank_number,
            'bank_account_name': data.bank_account_name,
            'action': data.action,
            'keysearch': data.keysearch,
        })
        $('#total-record-enable').text(parseInt($('#total-record-enable').text()) + 1);
        $('#total-record-disable').text(parseInt($('#total-record-disable').text()) - 1);
    } else {
        removeRowDatatableTemplate(dataTableBankEnable, thisRowChangeStatusBank, true)
        addRowDatatableTemplate(dataTableBankDisable, {
            'bank_name': data.bank_name,
            'bank_number': data.bank_number,
            'bank_account_name': data.bank_account_name,
            'action': data.action,
            'keysearch': data.keysearch,
        })
        $('#total-record-enable').text(parseInt($('#total-record-enable').text()) - 1);
        $('#total-record-disable').text(parseInt($('#total-record-disable').text()) + 1);
    }
}

async function assignBank(r) {
    if (checkAssignBank === 1) {
        return false;
    }
    if (r.is('checked')) {
        return false
    }

    let checked = r.parents('table').find('.pointer-none:checkbox:checked');
    if (checked) {
        checked.prop('checked', false);
        checked.removeClass('pointer-none')
    }

    let title = 'Đổi Tài khoản thanh toán mặc định',
        content = 'Bạn có chắc chắn muốn đổi tài khoản thanh toán mặc định?',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'bank-setting.assign',
                params = {
                    id: r.data('id'),
                    restaurant_brand_id: $('.select-brand-bank-data').val(),
                },
                data = null,
                text = $('#success-status-data-to-server').text();
            checkAssignBank = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-bank-data'), $('#table-disable-bank-data')]);
            checkAssignBank = 0;
            switch (res.data.status) {
                case 200:
                    let success = $('#success-update-data-to-server').text();
                    SuccessNotify(success);
                    r.addClass('pointer-none')
                    r.prop('checked', true);
                    $('#name-bank-account').text(`${r.parents('tr').find('td:eq(2)').text()} - ${r.parents('tr').find('td:eq(4)').text()}`)
                    $('#name-branch').text($('.select-brand-bank-data').find(':selected').text());
                    break;
                case 500:
                    r.prop('checked', false);
                    checked.prop('checked', true);
                    checked.addClass('pointer-none')
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    r.prop('checked', false);
                    checked.prop('checked', true);
                    checked.addClass('pointer-none')
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        } else {
            r.prop('checked', false);
            checked.prop('checked', true);
            checked.addClass('pointer-none')
        }
    });
}

async function dataTableBankData(data) {
    let idEnableBank = $('#table-enable-bank-data'),
        idDisableBank = $('#table-disable-bank-data'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'bank_name', name: 'bank_name', className: 'text-left'},
            {data: 'bank_number', name: 'bank_number', className: 'text-center'},
            {data: 'bank_account_name', name: 'bank_account_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        columns2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'bank_name', name: 'bank_name', className: 'text-left'},
            {data: 'bank_number', name: 'bank_number', className: 'text-center'},
            {data: 'bank_account_name', name: 'bank_account_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateBankData',
        }];
    dataTableBankEnable = await DatatableTemplateNew(idEnableBank, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    dataTableBankDisable = await DatatableTemplateNew(idDisableBank, data.data[1].original.data, columns2, vh_of_table, fixed_left, fixed_right, option);
}

function dataTotalBankData(data) {
    $('#total-record-enable').text(data.total_record_enable);
    $('#total-record-disable').text(data.total_record_disable);
}

function updateCookieBankData() {
    saveCookieShared('bank-data-user-id-' + idSession, JSON.stringify({
        tabBankDataChange: tabBankDataChange
    }))
}
