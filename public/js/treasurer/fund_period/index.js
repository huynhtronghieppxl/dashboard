let tabCurrentFundPeriodTab = 1,
    checkSaveConfirmFundPeriodTreasurer = 0,
    checkCancelFundPeriodTreasurer = 0,
    tableWaitingFundPeriodTreasurer,
    tableDoneFundPeriodTreasurer,
    tableCancelFundPeriodTreasurer,
    idConfirmFundPeriodTreasurer,
    branchConfirmFundPeriodTreasurer = -1;


$(function () {
    if (getCookieShared('fund-period-treasurer-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('fund-period-treasurer-user-id-' + idSession));
        tabCurrentFundPeriodTab = dataCookie.tab;
    }
    loadData();
    $(document).on('#input-reason-alert-cancel-restaurant-order', 'input', function () {
    });
    $(document).on('click', function () {
        $('#description-last-closing-amount-fund-period-treasurer').parent('.input-group').removeClass('focus-valid');
    });
    $('#nav-tab-fund-period .nav-link').on('click', function () {
        tabCurrentFundPeriodTab = $(this).attr('data-id');
        updateCookieFundPeriod();
    })
    $(document).on('input paste keyup', '#content-body-techres input[type="search"]', async function () {
        $('#total-record-waiting-fund-period-treasurer').text(tableWaitingFundPeriodTreasurer.rows({'search': 'applied'}).count());
        $('#total-record-done-fund-period-treasurer').text(tableDoneFundPeriodTreasurer.rows({'search': 'applied'}).count());
        $('#total-record-cancel-fund-period-treasurer').text(tableCancelFundPeriodTreasurer.rows({'search': 'applied'}).count());

        let totalWaiting = searchTableWaiting(tableWaitingFundPeriodTreasurer),
            totalDone = searchTableDone(tableDoneFundPeriodTreasurer),
            totalCancel = searchTableDone(tableCancelFundPeriodTreasurer)

        $('#total-open-waiting-fund-period-treasurer').text(formatNumber(totalWaiting[0]))
        $('#total-in-waiting-fund-period-treasurer').text(formatNumber(totalWaiting[1]))
        $('#total-out-waiting-fund-period-treasurer').text(formatNumber(totalWaiting[2]))
        $('#total-close-waiting-fund-period-treasurer').text(formatNumber(totalWaiting[3]))

        $('#total-open-done-fund-period-treasurer').text(formatNumber(totalDone[0]))
        $('#total-in-done-fund-period-treasurer').text(formatNumber(totalDone[1]))
        $('#total-out-done-fund-period-treasurer').text(formatNumber(totalDone[2]))
        $('#total-close-done-fund-period-treasurer').text(formatNumber(totalDone[3]))

        $('#total-open-cancel-fund-period-treasurer').text(formatNumber(totalCancel[0]))
        $('#total-in-cancel-fund-period-treasurer').text(formatNumber(totalCancel[1]))
        $('#total-out-cancel-fund-period-treasurer').text(formatNumber(totalCancel[2]))
        $('#total-close-cancel-fund-period-treasurer').text(formatNumber(totalCancel[3]))

    })
    $('#nav-tab-fund-period a[data-id="' + tabCurrentFundPeriodTab + '"]').click();
});

function searchTableWaiting(datatable){
    let totalOpen = 0, totalIn = 0, totalOut = 0, totalClose = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalOpen += removeformatNumber(row.find('td:eq(3)').text());
        totalIn += removeformatNumber(row.find('td:eq(4)').text());
        totalOut += removeformatNumber(row.find('td:eq(5)').text());
        totalClose += removeformatNumber(row.find('td:eq(6)').text());
    })
    return [totalOpen, totalIn, totalOut, totalClose]
}

function searchTableDone(datatable){
    let totalOpen = 0, totalIn = 0, totalOut = 0, totalClose = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalOpen += removeformatNumber(row.find('td:eq(4)').text());
        totalIn += removeformatNumber(row.find('td:eq(5)').text());
        totalOut += removeformatNumber(row.find('td:eq(6)').text());
        totalClose += removeformatNumber(row.find('td:eq(7)').text());
    })
    return [totalOpen, totalIn, totalOut, totalClose]
}

async function loadData() {
    let branch = branchConfirmFundPeriodTreasurer,
        method = 'get',
        url = 'fund-period-treasurer.data',
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-waiting-fund-period-treasurer'),
        $('#table-done-fund-period-treasurer'),
    ]);
    dataTableFundPeriodTreasurer(res);
    dataTotalFundPeriodTreasurer(res.data[3]);
}

function updateCookieFundPeriod(){
    saveCookieShared('fund-period-treasurer-user-id-' +idSession, JSON.stringify({
        'tab' : tabCurrentFundPeriodTab,
    }))
}

async function dataTableFundPeriodTreasurer(data) {
    let idWaiting = $('#table-waiting-fund-period-treasurer'),
        idDone = $('#table-done-fund-period-treasurer'),
        idCancle = $('#table-cancel-fund-period-treasurer'),
        columns1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'employee_name', name: 'employee_name', className: 'text-left'},
            {data: 'openning_amount', name: 'openning_amount', className: 'text-left'},
            {data: 'in_amount', name: 'in_amount', className: 'text-right'},
            {data: 'out_amount', name: 'out_amount', className: 'text-right'},
            {data: 'closing_amount', name: 'closing_amount', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columns2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'employee_name', name: 'employee_name', className: 'text-left'},
            {data: 'employee_complete_name', name: 'employee_complete_name', className: 'text-left'},
            {data: 'openning_amount', name: 'openning_amount', className: 'text-right'},
            {data: 'in_amount', name: 'in_amount', className: 'text-right'},
            {data: 'out_amount', name: 'out_amount', className: 'text-right'},
            {data: 'closing_amount', name: 'closing_amount', className: 'text-right'},
            {data: 'last_closing_amount', name: 'last_closing_amount', className: 'text-right'},
            {data: 'changing_last_closing_amount', name: 'changing_last_closing_amount', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columns3 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'employee_name', name: 'employee_name', className: 'text-left'},
            {data: 'employee_complete_name', name: 'employee_complete_name', className: 'text-left'},
            {data: 'openning_amount', name: 'openning_amount', className: 'text-right'},
            {data: 'in_amount', name: 'in_amount', className: 'text-right'},
            {data: 'out_amount', name: 'out_amount', className: 'text-right'},
            {data: 'closing_amount', name: 'closing_amount', className: 'text-right'},
            {data: 'keysearch', className: 'd-none'},
        ],
        fixedLeft = 0,
        fixedRight = 0;
    let option = [];
    tableWaitingFundPeriodTreasurer = await DatatableTemplateNew(idWaiting, data.data[0].original.data, columns1, vh_of_table, fixedLeft, fixedRight,option);
    tableDoneFundPeriodTreasurer = await DatatableTemplateNew(idDone, data.data[1].original.data, columns2, vh_of_table, fixedLeft, fixedRight,option);
    tableCancelFundPeriodTreasurer = await DatatableTemplateNew(idCancle, data.data[2].original.data, columns3, vh_of_table, fixedLeft, fixedRight,option);
}

function dataTotalFundPeriodTreasurer(data) {
    $('#total-record-waiting-fund-period-treasurer').text(data.total_record_waiting);
    $('#total-record-done-fund-period-treasurer').text(data.total_record_done);
    $('#total-record-cancel-fund-period-treasurer').text(data.total_record_cancel);
    $('#total-open-waiting-fund-period-treasurer').text(data.data_total_opening_amount_waiting);
    $('#total-in-waiting-fund-period-treasurer').text(data.data_total_in_amount_waiting);
    $('#total-out-waiting-fund-period-treasurer').text(data.data_total_out_amount_waiting);
    $('#total-order-waiting-fund-period-treasurer').text(data.data_total_order_amount_waiting);
    $('#total-close-waiting-fund-period-treasurer').text(data.data_total_closing_amount_waiting);
    $('#total-change-waiting-fund-period-treasurer').text(data.data_total_changing_amount_waiting);
    $('#total-open-done-fund-period-treasurer').text(data.data_total_opening_amount_done);
    $('#total-in-done-fund-period-treasurer').text(data.data_total_in_amount_done);
    $('#total-out-done-fund-period-treasurer').text(data.data_total_out_amount_done);
    $('#total-order-done-fund-period-treasurer').text(data.data_total_order_amount_done);
    $('#total-close-done-fund-period-treasurer').text(data.data_total_closing_amount_done);
    $('#total-change-done-fund-period-treasurer').text(data.data_total_changing_amount_done);
    $('#total-last-close-done-fund-period-treasurer').text(data.data_total_last_closing_amount_done);
    $('#total-change-last-close-done-fund-period-treasurer').text(data.data_total_change_last_closing_amount_done);
    $('#total-open-cancel-fund-period-treasurer').text(data.data_total_opening_amount_cancel);
    $('#total-in-cancel-fund-period-treasurer').text(data.data_total_in_amount_cancel);
    $('#total-out-cancel-fund-period-treasurer').text(data.data_total_out_amount_cancel);
    $('#total-order-cancel-fund-period-treasurer').text(data.data_total_order_amount_cancel);
    $('#total-close-cancel-fund-period-treasurer').text(data.data_total_closing_amount_cancel);
    $('#total-change-cancel-fund-period-treasurer').text(data.data_total_changing_amount_cancel);
    $('#value-last-closing-amount-fund-period-treasurer').val(data.data_total_closing_amount_waiting);
}

function confirmFundPeriodTreasurer(r) {
    $('#modal-fund-period-treasurer').modal('show');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalConfirmFundPeriodTreasurer();
    });
    shortcut.add('F4', function () {
        saveModalConfirmFundPeriodTreasurer();
    });
    $('#value-last-closing-amount-fund-period-treasurer').val(r.data('amount'))
    idConfirmFundPeriodTreasurer = r.data('id')
    branchConfirmFundPeriodTreasurer = r.data('branch')
}

async function saveModalConfirmFundPeriodTreasurer() {
    if(checkSaveConfirmFundPeriodTreasurer === 1) return false;
    if(!checkValidateSave($('#modal-fund-period-treasurer'))) return false;
    checkSaveConfirmFundPeriodTreasurer = 1;
    let method = 'post',
        note = $('#description-last-closing-amount-fund-period-treasurer').val(),
        url = 'fund-period-treasurer.confirm',
        params = null,
        data = {
            id: idConfirmFundPeriodTreasurer,
            branch: branchConfirmFundPeriodTreasurer,
            note: note,
            last_closing_amount: removeformatNumber($('#value-last-closing-amount-fund-period-treasurer').val()),
        };
    let res = await axiosTemplate(method, url, params, data)
    checkSaveConfirmFundPeriodTreasurer = 0;
    let text = '';
    switch (res.data.status){
        case 200:
            text = $('#success-confirm-data-to-server').text();
            SuccessNotify(text);
            closeModalConfirmFundPeriodTreasurer();
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

function closeModalConfirmFundPeriodTreasurer() {
    $('#modal-fund-period-treasurer').modal('hide');
    $('#description-last-closing-amount-fund-period-treasurer').val('')
}

function cancelFundPeriodTreasurer(id, branch) {
    if(checkCancelFundPeriodTreasurer === 1) return false;
    let title = 'Huỷ ?',
        content = 'Huỷ chốt kỳ !',
        icon = 'question';
    sweetAlertInputComponent(title,'id-cancel-update-fund-period', content, icon).then(async (result) => {
        if (result.isConfirmed) {
            checkCancelFundPeriodTreasurer = 1;
            let method = 'post',
                url = 'fund-period-treasurer.cancel',
                params = null,
                data = {
                    id: id,
                    branch: branch,
                    reason: result.value
                };
            let res = await axiosTemplate(method, url, params, data);
            checkCancelFundPeriodTreasurer = 0;
            if (res.data.status === 200) {
                let text = $('#success-cancel-data-to-server').text();
                SuccessNotify(text);
                loadData();
            } else {
                let text = $('#error-post-data-to-server').text();
                if (res.data.message !== null) {
                    text = res.data.message;
                }
                ErrorNotify(text);
            }
        }
    });
}
