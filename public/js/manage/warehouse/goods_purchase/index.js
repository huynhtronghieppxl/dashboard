let loadingDataRequestGoodsPurchase = 0, loadingWaitingGoodsPurchase = 0, loadingOrderGoodsPurchase = 0, loadDataListTotalWarehouse = 0,
    loadingDoneGoodsPurchase = 0, loadingCancelGoodsPurchase = 0, loadingHistoryRequestGoodsPurchase = 0,
    loadingReturnGoodsPurchase = 0,
    tabActiveGoodsPurchase = 0,
    tableRequestGoodsPurchase = '', tableWaitingGoodsPurchase = '', tableOrderGoodsPurchase = '',
    tableDoneGoodsPurchase = '', tableCancelGoodsPurchase = '', tableReturnGoodsPurchase = '', tableHistoryRequestGoodsPurchase = '',
    isReturnAllTotalMaterial = 0,
    branchIdGoodsPurchase = $('.select-total-warehouse').val(),
    statusOrderGoodsPurchase = '1,2,3', statusDoneGoodsPurchase = '4,6,7', statusCancelGoodsPurchase = '5', statusHistoryRequestListGoodsPurchase = '2,3,4,5,6,7',
    typeOrderGoodsPurchase = 3, typeDoneGoodsPurchase = 4, typeCancelGoodsPurchase = 5,
    fromDateGoodsPurchase = $('.from-date-goods-purchase-warehouse').val(), toDateGoodsPurchase = $('.to-date-goods-purchase-warehouse').val() ;
$(function () {
    if (getCookieShared('goods-purchase-warehouse-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('goods-purchase-warehouse-user-id-' + idSession));
        tabActiveGoodsPurchase = dataCookie.tab;
        fromDateGoodsPurchase = dataCookie.from;
        toDateGoodsPurchase = dataCookie.to;
        $('.from-date-goods-purchase-warehouse').val(fromDateGoodsPurchase);
        $('.to-date-goods-purchase-warehouse').val(toDateGoodsPurchase);
    }
    dateTimePickerFromMaxToDate($('.from-date-goods-purchase-warehouse'), $('.to-date-goods-purchase-warehouse'));
    $('.select-total-warehouse').select2({
        dropdownParent: $('#div-goods-purchase-warehouse')
    });
    $('.select-total-warehouse').on('change', function () {
        $('.select-total-warehouse').val($(this).val()).trigger('change.select2');
    });

    $('.select-total-warehouse').select2({
        templateResult: function (idioma) {
            let $span = $(`<span>${idioma.text}</span>`);
            return $span;
        },
        templateSelection: function (idioma) {
            if (!idioma.disabled) {
                let $span = $(`<span class="d-flex align-items-center"><i class="fi-rr-school icon-branch" style="transform: translateY(-1px);" data-toggle="tooltip" data-placement="top" data-original-title="Kho tổng"></i>${idioma.text}</span>`);
                return $span;
            } else {
                let $span = $(`<span>${idioma.text}</span>`);
                return $span;
            }
        }
    });

    $('.from-date-goods-purchase-warehouse').on('dp.change', function () {
        fromDateGoodsPurchase = $(this).val();
        $('.from-date-goods-purchase-warehouse').val($(this).val());

    });
    $('.to-date-goods-purchase-warehouse').on('dp.change', function () {
        toDateGoodsPurchase = $(this).val();
        $('.to-date-goods-purchase-warehouse').val($(this).val());
    });

    $('.search-btn-goods-purchase-warehouse').on('click', function (e) {
        if(!checkDateTimePicker($(this))){
            $('.from-date-goods-purchase-warehouse').val(fromDateGoodsPurchase).trigger('dp.change');
            $('.to-date-goods-purchase-warehouse').val(toDateGoodsPurchase).trigger('dp.change');
            return false
        }
        loadingDataGoodsPurchase();
        updateCookieGoodsPurchase();
    });
    $('#nav-goods-purchase-warehouse a[data-id="' + tabActiveGoodsPurchase + '"]').click();
});

function updateCookieGoodsPurchase() {
    saveCookieShared('goods-purchase-warehouse-user-id-' + idSession, JSON.stringify({
        'tab': tabActiveGoodsPurchase,
        'from': $('.from-date-goods-purchase-warehouse').val(),
        'to': $('.to-date-goods-purchase-warehouse').val(),
    }))
}

async function loadData() {
    branchIdGoodsPurchase = $('.select-total-warehouse').val();
    loadingDataGoodsPurchase();
}

async function loadListTotalWarehouse () {
    let method = 'get',
        url = 'goods-purchase-warehouse.list-total-warehouse',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('.select-total-warehouse')]);
    $('.select-total-warehouse').html(res.data[0]);
}

async function loadingDataGoodsPurchase() {
    updateCookieGoodsPurchase();
    switch (tabActiveGoodsPurchase) {
        case 0:
            loadingDataRequestGoodsPurchase = 1;
            loadingWaitingGoodsPurchase = 0;
            loadingOrderGoodsPurchase = 0;
            loadingDoneGoodsPurchase = 0;
            loadingCancelGoodsPurchase = 0;
            loadingReturnGoodsPurchase = 0;
            loadingHistoryRequestGoodsPurchase = 0;
            tableRequestGoodsPurchase.ajax.url("goods-purchase-warehouse.data-request?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase).load();
            break;
        case 1:
            loadingDataRequestGoodsPurchase = 0;
            loadingWaitingGoodsPurchase = 1;
            loadingOrderGoodsPurchase = 0;
            loadingDoneGoodsPurchase = 0;
            loadingCancelGoodsPurchase = 0;
            loadingReturnGoodsPurchase = 0;
            loadingHistoryRequestGoodsPurchase = 0;
            tableWaitingGoodsPurchase.ajax.url("goods-purchase-warehouse.data-order-waiting?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase +  "&branch=" + branchIdGoodsPurchase).load();
            break;
        case 2:
            loadingDataRequestGoodsPurchase = 0;
            loadingWaitingGoodsPurchase = 0;
            loadingOrderGoodsPurchase = 1;
            loadingDoneGoodsPurchase = 0;
            loadingCancelGoodsPurchase = 0;
            loadingReturnGoodsPurchase = 0;
            loadingHistoryRequestGoodsPurchase = 0;
            tableOrderGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase +"&branch=" + branchIdGoodsPurchase + "&status=" + statusOrderGoodsPurchase + '&type=' + typeOrderGoodsPurchase).load();
            break;
        case 3:
            loadingDataRequestGoodsPurchase = 0;
            loadingWaitingGoodsPurchase = 0;
            loadingOrderGoodsPurchase = 0;
            loadingDoneGoodsPurchase = 1;
            loadingCancelGoodsPurchase = 0;
            loadingReturnGoodsPurchase = 0;
            loadingHistoryRequestGoodsPurchase = 0;
            isReturnAllTotalMaterial = 0;
            tableDoneGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase +"&branch=" + branchIdGoodsPurchase + "&status=" + statusDoneGoodsPurchase + '&type=' + typeDoneGoodsPurchase).load();
            break;
        case 4:
            loadingDataRequestGoodsPurchase = 0;
            loadingWaitingGoodsPurchase = 0;
            loadingOrderGoodsPurchase = 0;
            loadingDoneGoodsPurchase = 0;
            loadingCancelGoodsPurchase = 1;
            loadingReturnGoodsPurchase = 0;
            loadingHistoryRequestGoodsPurchase = 0;
            isReturnAllTotalMaterial = -1;
            tableCancelGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusCancelGoodsPurchase + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeCancelGoodsPurchase).load();
            break;
        case 5:
            loadingDataRequestGoodsPurchase = 0;
            loadingWaitingGoodsPurchase = 0;
            loadingOrderGoodsPurchase = 0;
            loadingDoneGoodsPurchase = 0;
            loadingCancelGoodsPurchase = 0;
            loadingReturnGoodsPurchase = 1;
            loadingHistoryRequestGoodsPurchase = 0;
            tableReturnGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-return?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase).load();
            break;
        case 6:
            loadingDataRequestGoodsPurchase = 0;
            loadingWaitingGoodsPurchase = 0;
            loadingOrderGoodsPurchase = 0;
            loadingDoneGoodsPurchase = 0;
            loadingCancelGoodsPurchase = 0;
            loadingReturnGoodsPurchase = 0;
            loadingHistoryRequestGoodsPurchase = 1;
            tableHistoryRequestGoodsPurchase.ajax.url("goods-purchase-warehouse.history-request?&branch=" + branchIdGoodsPurchase + "&status=" + statusHistoryRequestListGoodsPurchase + "&from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase).load();
            break;
    }
}
async function changeActiveTabGoodsPurchase(tab) {
    tabActiveGoodsPurchase = tab;
    if(loadDataListTotalWarehouse === 0) {
        await loadListTotalWarehouse();
        loadDataListTotalWarehouse = 1;
    }
    branchIdGoodsPurchase = $('.select-total-warehouse').val(),
    updateCookieGoodsPurchase();
    switch (tab) {
        case 0:
            if (!tableRequestGoodsPurchase) {
                let element = $('#table-request-goods-purchase'),
                    url = "goods-purchase-warehouse.data-request?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'branch_name', name: 'branch_name', className: 'text-left'},
                        {
                            data: 'employee_created_full_name',
                            name: 'employee_created_full_name', className: 'text-left'
                        },
                        {data: 'quantity', name: 'quantity', className: 'text-center'},
                        {data: 'created_at', name: 'created_at', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableRequestGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingDataRequestGoodsPurchase = 1;
            } else if (loadingDataRequestGoodsPurchase === 0) {
                tableRequestGoodsPurchase.ajax.url("goods-purchase-warehouse.data-request?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase +  "&branch=" + branchIdGoodsPurchase).load();
            }
            break;
        case 1:
            if (!tableWaitingGoodsPurchase) {
                let element = $('#table-waiting-goods-purchase'),
                    url = "goods-purchase-warehouse.data-order-waiting?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', class: 'text-left'},
                        {data: 'supplier_name', name: 'supplier_name'},
                        {
                            data: 'employee_created_full_name',
                            name: 'employee_created_full_name',
                        },
                        {data: 'quantity', name: 'quantity', className: 'text-center'},
                        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
                        {data: 'expected_delivery_time', name: 'action', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableWaitingGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingWaitingGoodsPurchase = 1;
            } else if (loadingWaitingGoodsPurchase === 0) {
                tableWaitingGoodsPurchase.ajax.url("goods-purchase-warehouse.data-order-waiting?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase).load();
            }
            break;
        case 2:
            if (!tableOrderGoodsPurchase) {
                let element = $('#table-order-goods-purchase'),
                    url = "goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusOrderGoodsPurchase + '&type=' + typeOrderGoodsPurchase,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'supplier_name', name: 'supplier_name'},
                        {
                            data: 'employee_created_full_name',
                            name: 'employee_created_full_name',
                        },
                        {data: 'total_material', name: 'total_material', className: 'text-center'},
                        {data: 'amount', name: 'amount', className: 'text-right'},
                        {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
                        {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
                        {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right'},
                        {data: 'delivery_at', name: 'action', className: 'text-center'},
                        {data: 'created_at', name: 'created_at', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableOrderGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingOrderGoodsPurchase = 1;
            } else if (loadingOrderGoodsPurchase === 0) {
                tableOrderGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusOrderGoodsPurchase + '&type=' + typeOrderGoodsPurchase).load();
            }
            break;
        case 3:
            isReturnAllTotalMaterial = 0;
            if (!tableDoneGoodsPurchase) {
                let element = $('#table-done-goods-purchase'),
                    url = "goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusDoneGoodsPurchase + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeDoneGoodsPurchase,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'supplier_name', name: 'supplier_name', className: 'pl-5 text-left' },
                        {
                            data: 'employee_complete_full_name',
                            name: 'employee_complete_full_name',
                            className: 'pl-5 text-left'
                        },
                        {data: 'total_material', name: 'total_material', className: 'text-center'},
                        {data: 'amount', name: 'amount', className: 'text-right'},
                        {data: 'total_amount_of_return_material_reality', name: 'total_amount_of_return_material_reality', className: 'text-right'},
                        {data: 'amount_reality', name: 'amount_reality', className: 'text-right'},
                        {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
                        {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
                        {data: 'restaurant_debt_amount', name: 'restaurant_debt_amount', className: 'text-right'},
                        {data: 'created_at', name: 'action', className: 'text-center'},
                        {data: 'received_at', name: 'received_at', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-right', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableDoneGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingDoneGoodsPurchase = 1;
            } else if (loadingDoneGoodsPurchase === 0) {
                tableDoneGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusDoneGoodsPurchase + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeDoneGoodsPurchase).load();
            }
            break;
        case 4:
            isReturnAllTotalMaterial = -1;
            if (!tableCancelGoodsPurchase) {
                let element = $('#table-cancel-goods-purchase'),
                    url = "goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusCancelGoodsPurchase + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeCancelGoodsPurchase,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'supplier_name', name: 'supplier_name'},
                        {
                            data: 'employee_cancel_full_name',
                            name: 'employee_cancel_full_name',
                        },
                        {data: 'total_material', name: 'total_material', className: 'text-center'},
                        {data: 'amount_reality', name: 'amount_reality', className: 'text-right'},
                        {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
                        {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
                        {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right'},
                        {data: 'delivery_at', name: 'action', className: 'text-center'},
                        {data: 'updated_at', name: 'updated_at', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableCancelGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingCancelGoodsPurchase = 1;
            } else if (loadingCancelGoodsPurchase === 0) {
                tableCancelGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-order?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase + "&status=" + statusCancelGoodsPurchase + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeCancelGoodsPurchase).load();
            }
            break;
        case 5:
            if (!tableReturnGoodsPurchase) {
                let element = $('#table-return-goods-purchase'),
                    url = "goods-purchase-warehouse.data-list-return?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left text'},
                        {data: 'supplier_name', name: 'supplier_name',},
                        {
                            data: 'employee_created_full_name',
                            name: 'employee_created_full_name',
                        },
                        {data: 'total_material', name: 'total_material', className: 'text-center'},
                        {data: 'amount', name: 'amount', className: 'text-right'},
                        {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
                        {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
                        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
                        {data: 'created_at', name: 'created_at', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableReturnGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingReturnGoodsPurchase = 1;
            } else if (loadingReturnGoodsPurchase === 0) {
                tableReturnGoodsPurchase.ajax.url("goods-purchase-warehouse.data-list-return?from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase + "&branch=" + branchIdGoodsPurchase).load();
            }
            break;
        case 6:
            if (!tableHistoryRequestGoodsPurchase) {
                let element = $('#table-history-request-goods-purchase'),
                    url = "goods-purchase-warehouse.history-request?branch=" + branchIdGoodsPurchase + "&status=" + statusHistoryRequestListGoodsPurchase + "&from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase ,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'inventory', name: 'inventory', className: 'text-center'},
                        {data: 'employee_create_full_name', name: 'employee_create_full_name'},
                        {data: 'created_at', name: 'created_at', className: 'text-center'},
                        {data: 'material_quantity', name: 'material_quantity', className: 'text-center'},
                        {data: 'date', name: 'date', className: 'text-center'},
                        {data: 'paid_status', name: 'paid_status', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableHistoryRequestGoodsPurchase = await loadDataGoodsPurchase(element, url, column);
                loadingHistoryRequestGoodsPurchase = 1;
            } else if (loadingHistoryRequestGoodsPurchase === 0) {
                tableHistoryRequestGoodsPurchase.ajax.url("goods-purchase-warehouse.history-request?branch=" + branchIdGoodsPurchase + "&status=" + statusHistoryRequestListGoodsPurchase + "&from=" + fromDateGoodsPurchase + "&to="+ toDateGoodsPurchase).load();
            }
            break;
    }
}

async function loadDataGoodsPurchase(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateGoodsPurchase',
            },
            // {
            //     'title': 'Thêm mới phiếu xuất kho',
            //     'icon': 'fa fa-plus text-blue',
            //     'class': '',
            //     'function': 'openCreateRequestExportWarehouse',
            // }
        ]
    return DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
    $('#total-record-request-history').text(formatNumber(response.count_history_request_order));
    $('#total-record-order').text(formatNumber(response.count_import_order));
    $('#total-record-waiting').text(formatNumber(response.count_waiting_order));
    $('#total-record-received').text(formatNumber(response.count_delivery_order));
    $('#total-record-return').text(formatNumber(response.count_return_order));
    $('#total-record-cancel').text(formatNumber(response.count_cancel_order));
    $('#total-record-done').text(formatNumber(response.count_done_order));
    $('#total-amount-request-goods-purchase').text(formatNumber(response.amount_waiting));
    $('#amount-received').text(formatNumber(response.amount_received));
    $('#vat-received').text(formatNumber(response.vat_received));
    $('#discount-received').text(formatNumber(response.discount_received));
    $('#total-amount-received').text(formatNumber(response.total_amount_received));
    $('#amount-done').text(formatNumber(response.amount_done));
    $('#vat-done').text(formatNumber(response.vat_done));
    $('#discount-done').text(formatNumber(response.discount_done));
    $('#total-amount-done').text(formatNumber(response.total_amount_done));
    $('#total-return-done').text(formatNumber(response.total_return_done));
    $('#total-payment-done').text(formatNumber(response.total_payment_done));

    $('#amount-cancel').text(formatNumber(response.amount_cancel));
    $('#vat-cancel').text(formatNumber(response.vat_cancel));
    $('#discount-cancel').text(formatNumber(response.discount_cancel));
    $('#total-amount-cancel').text(formatNumber(response.total_amount_cancel));

    $('#amount-return').text(formatNumber(response.amount_return));
    $('#vat-return').text(formatNumber(response.vat_return));
    $('#discount-return').text(formatNumber(response.discount_return));
    $('#total-amount-return').text(formatNumber(response.total_amount_return));
}

function confirmRequestOrderWarehouse(id) {
    let title = 'Xác nhận',
        content = 'Xác nhận yêu cầu mua hàng sẽ tạo ra các phiếu mua hàng gửi đến nhà cung cấp !',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'goods-purchase.confirm-request',
                params = null,
                data = {
                    id: id
                };
            let res = await axiosTemplate(method, url, params, data);
            switch(res.data.status) {
                case 200:
                    let success = $('#success-confirm-data-to-server').text();
                    SuccessNotify(success);
                    loadData();
                    break;
                case 500:
                    ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            }
        }
    })
}
