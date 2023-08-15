let loadingDataRequestSupplierOrder = 0, loadingWaitingSupplierOrder = 0, loadingOrderSupplierOrder = 0,
    loadingDoneSupplierOrder = 0, loadingCancelSupplierOrder = 0, loadingHistoryRequestSupplierOrder = 0,
    loadingReturnSupplierOrder = 0,
    tabActiveSupplierOrder = 0,
    tableRequestSupplierOrder = '', tableWaitingSupplierOrder = '', tableOrderSupplierOrder = '',
    tableDoneSupplierOrder = '', tableCancelSupplierOrder = '', tableReturnSupplierOrder = '', tableHistoryRequestSupplierOrder = '',
    isReturnAllTotalMaterial = 0,
    branchIdSupplierOrder = $('.select-branch').val(), brandIdSupplierOder = $('.select-brand').val(), employee_create_id = '', employee_confirm_id = '', employee_cancel_id = '',
    statusOrderSupplierOrder = '1,2,3', statusDoneSupplierOrder = '4,6,7', statusCancelSupplierOrder = '5', statusHistoryRequestListSupplierOrder = '2,4,5,6,7',
    typeOrderSupplierOrder = 3, typeCancelSupplierOrder = 4, typeDoneSupplierOrder = 5,
    fromDateSupplierOrder = $('.from-date-supplier-order').val(), toDateSupplierOrder = $('.to-date-supplier-order').val() ;
$(async function () {
    if (getCookieShared('supplier-order-manager-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('supplier-order-manager-user-id-' + idSession));
        tabActiveSupplierOrder = dataCookie.tab;
        fromDateSupplierOrder = dataCookie.from;
        toDateSupplierOrder = dataCookie.to;
        // statusHistoryRequestListSupplierOrder = dataCookie.status;
        $('.from-date-supplier-order').val(fromDateSupplierOrder);
        $('.to-date-supplier-order').val(toDateSupplierOrder);
        // $('.from-date-supplier-order').data("DateTimePicker").date(fromDateSupplierOrder);
        // $('.to-date-supplier-order').data("DateTimePicker").date(toDateSupplierOrder);
    }
    dateTimePickerFromMaxToDate($('.from-date-supplier-order'), $('.to-date-supplier-order'));

    $('.select-branch').on('dp.change', function () {
        $('.select-branch').val($(this).val());
        branchIdSupplierOrder = $('.select-branch').val();
    })

    $('.from-date-supplier-order').on('dp.change', function () {
        fromDateSupplierOrder = $(this).val();
        $('.from-date-supplier-order').val($(this).val());

    });
    $('.to-date-supplier-order').on('dp.change', function () {
        toDateSupplierOrder = $(this).val();
        $('.to-date-supplier-order').val($(this).val());
    });

    $('.search-date-btn-supplier-order').on('click', function (e) {
        if(!checkDateTimePicker($(this))){
            return false;
        }
        fromDateSupplierOrder = $('.from-date-supplier-order').val();
        toDateSupplierOrder = $('.to-date-supplier-order').val();
        loadingData();

    });
    $('#nav-supplier-order-manage a[data-id="' + tabActiveSupplierOrder + '"]').click();

});

function updateCookieSupplierOrder() {
    saveCookieShared('supplier-order-manager-user-id-' + idSession, JSON.stringify({
        'tab': tabActiveSupplierOrder,
        'from': $('.from-date-supplier-order').val(),
        'to': $('.to-date-supplier-order').val(),
    }))
}

async function loadData() {
    branchIdSupplierOrder = $('.select-branch').val();
    brandIdSupplierOder = $('.select-brand').val();
    loadingData();
}

async function loadingData() {
    updateCookieSupplierOrder();
    switch (tabActiveSupplierOrder) {
        case 0:
            loadingDataRequestSupplierOrder = 1;
            loadingWaitingSupplierOrder = 0;
            loadingOrderSupplierOrder = 0;
            loadingDoneSupplierOrder = 0;
            loadingCancelSupplierOrder = 0;
            loadingReturnSupplierOrder = 0;
            loadingHistoryRequestSupplierOrder = 0;
            employee_create_id = '';
            employee_confirm_id = '';
            employee_cancel_id = '';
            if(tableRequestSupplierOrder) {
                tableRequestSupplierOrder.ajax.url("supplier-order.data-list-request?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&brand=" + brandIdSupplierOder + "&employee_create_id=" + employee_create_id + "&employee_confirm_id=" + employee_confirm_id + "&employee_cancel_id=" + employee_cancel_id).load();
            }
            break;
        case 1:
            loadingDataRequestSupplierOrder = 0;
            loadingWaitingSupplierOrder = 1;
            loadingOrderSupplierOrder = 0;
            loadingDoneSupplierOrder = 0;
            loadingCancelSupplierOrder = 0;
            loadingReturnSupplierOrder = 0;
            loadingHistoryRequestSupplierOrder = 0;
            if(tableWaitingSupplierOrder) {
                tableWaitingSupplierOrder.ajax.url("supplier-order.data-list-order-restaurant?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder +  "&branch=" + branchIdSupplierOrder).load();
            }
            break;
        case 2:
            loadingDataRequestSupplierOrder = 0;
            loadingWaitingSupplierOrder = 0;
            loadingOrderSupplierOrder = 1;
            loadingDoneSupplierOrder = 0;
            loadingCancelSupplierOrder = 0;
            loadingReturnSupplierOrder = 0;
            loadingHistoryRequestSupplierOrder = 0;
            if(tableOrderSupplierOrder) {
                tableOrderSupplierOrder.ajax.url("supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder +"&branch=" + branchIdSupplierOrder + "&status=" + statusOrderSupplierOrder + '&type=' + typeOrderSupplierOrder).load();
            }
            break;
        case 3:
            loadingDataRequestSupplierOrder = 0;
            loadingWaitingSupplierOrder = 0;
            loadingOrderSupplierOrder = 0;
            loadingDoneSupplierOrder = 1;
            loadingCancelSupplierOrder = 0;
            loadingReturnSupplierOrder = 0;
            isReturnAllTotalMaterial = 0;
            loadingHistoryRequestSupplierOrder = 0;
            if(tableDoneSupplierOrder) {
                tableDoneSupplierOrder.ajax.url("supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder +"&branch=" + branchIdSupplierOrder + "&status=" + statusDoneSupplierOrder + '&type=' + typeCancelSupplierOrder).load();
            }
            break;
        case 4:
            loadingDataRequestSupplierOrder = 0;
            loadingWaitingSupplierOrder = 0;
            loadingOrderSupplierOrder = 0;
            loadingDoneSupplierOrder = 0;
            loadingCancelSupplierOrder = 1;
            loadingReturnSupplierOrder = 0;
            loadingHistoryRequestSupplierOrder = 0;
            isReturnAllTotalMaterial = -1;
            if(tableCancelSupplierOrder) {
                tableCancelSupplierOrder.ajax.url("supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusCancelSupplierOrder + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeDoneSupplierOrder).load();
            }
            break;
        case 5:
            loadingDataRequestSupplierOrder = 0;
            loadingWaitingSupplierOrder = 0;
            loadingOrderSupplierOrder = 0;
            loadingDoneSupplierOrder = 0;
            loadingCancelSupplierOrder = 0;
            loadingReturnSupplierOrder = 1;
            loadingHistoryRequestSupplierOrder = 0;
            if(tableReturnSupplierOrder) {
                tableReturnSupplierOrder.ajax.url("supplier-order.data-list-return?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder).load();
            }
            break;
        case 6:
            loadingDataRequestSupplierOrder = 0;
            loadingWaitingSupplierOrder = 0;
            loadingOrderSupplierOrder = 0;
            loadingDoneSupplierOrder = 0;
            loadingCancelSupplierOrder = 0;
            loadingReturnSupplierOrder = 0;
            loadingHistoryRequestSupplierOrder = 1;
            if(tableHistoryRequestSupplierOrder) {
                tableHistoryRequestSupplierOrder.ajax.url("restaurant-material-order-request?&branch=" + branchIdSupplierOrder + "&status=" + statusHistoryRequestListSupplierOrder + "&from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder).load();
            }
            break;
    }
}
async function changeActiveTabSupplierOrder(tab) {
    !branchIdSupplierOrder ? await updateSessionBrandNew($('.select-brand')) : false;
    tabActiveSupplierOrder = tab;
    if(moment(fromDateSupplierOrder, 'DD/MM/YYYY').isAfter(moment(toDateSupplierOrder, 'DD/MM/YYYY'))) {
        toDateSupplierOrder = moment().format('DD/MM/YYYY');
        fromDateSupplierOrder = moment().startOf('month').format('DD/MM/YYYY');
        $('.from-date-supplier-order').val(fromDateSupplierOrder);
        $('.to-date-supplier-order').val(toDateSupplierOrder);
    }
    branchIdSupplierOrder = $('.select-branch').val();
    updateCookieSupplierOrder();
    switch (tab) {
        case 0:
            if (tableRequestSupplierOrder === '') {
                let element = $('#table-request-supplier-order'),
                    url = "supplier-order.data-list-request?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'inventory', name: 'inventory', className: 'text-left'},
                        {
                            data: 'employee_create_full_name',
                            name: 'employee_create_full_name', className: 'text-left'
                        },
                        {data: 'account_material_quantity', name: 'account_material_quantity', className: 'text-center'},
                        {data: 'date', name: 'date', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableRequestSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingDataRequestSupplierOrder = 1;
            } else if (loadingDataRequestSupplierOrder === 0) {
                tableRequestSupplierOrder.ajax.url("supplier-order.data-list-request?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder +  "&branch=" + branchIdSupplierOrder).load();
            }
            break;
        case 1:
            if (tableWaitingSupplierOrder === '') {
                let element = $('#table-waiting-supplier-order'),
                    url = "supplier-order.data-list-order-restaurant?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder,
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
                tableWaitingSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingWaitingSupplierOrder = 1;
            } else if (loadingWaitingSupplierOrder === 0) {
                tableWaitingSupplierOrder.ajax.url("supplier-order.data-list-order-restaurant?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder).load();
            }
            break;
        case 2:
            if (tableOrderSupplierOrder === '') {
                let element = $('#table-order-supplier-order'),
                    url = "supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusOrderSupplierOrder + '&type=' + typeOrderSupplierOrder,
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
                tableOrderSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingOrderSupplierOrder = 1;
            } else if (loadingOrderSupplierOrder === 0) {
                tableOrderSupplierOrder.ajax.url("supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusOrderSupplierOrder + '&type=' + typeOrderSupplierOrder).load();
            }
            break;
        case 3:
            isReturnAllTotalMaterial = 0;
            if (tableDoneSupplierOrder === '') {
                let element = $('#table-done-supplier-order'),
                    url = "supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusDoneSupplierOrder + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeCancelSupplierOrder,
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
                tableDoneSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingDoneSupplierOrder = 1;
            } else if (loadingDoneSupplierOrder === 0) {
                tableDoneSupplierOrder.ajax.url("supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusDoneSupplierOrder + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeCancelSupplierOrder).load();
            }
            break;
        case 4:
            isReturnAllTotalMaterial = -1;
            if (tableCancelSupplierOrder === '') {
                let element = $('#table-cancel-supplier-order'),
                    url = "supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusCancelSupplierOrder + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeDoneSupplierOrder,
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
                tableCancelSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingCancelSupplierOrder = 1;
            } else if (loadingCancelSupplierOrder === 0) {
                tableCancelSupplierOrder.ajax.url("supplier-order.data-list-order?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder + "&status=" + statusCancelSupplierOrder + "&is_return_all_total_material=" + isReturnAllTotalMaterial + '&type=' + typeDoneSupplierOrder).load();
            }
            break;
        case 5:
            if (tableReturnSupplierOrder === '') {
                let element = $('#table-return-supplier-order'),
                    url = "supplier-order.data-list-return?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder,
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
                        // {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
                        // {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
                        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
                        {data: 'created_at', name: 'created_at', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableReturnSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingReturnSupplierOrder = 1;
            } else if (loadingReturnSupplierOrder === 0) {
                tableReturnSupplierOrder.ajax.url("supplier-order.data-list-return?from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder + "&branch=" + branchIdSupplierOrder).load();
            }
            break;
        case 6:
            if (tableHistoryRequestSupplierOrder === '') {
                let element = $('#table-history-request-supplier-order'),
                    url = "restaurant-material-order-request?branch=" + branchIdSupplierOrder + "&status=" + statusHistoryRequestListSupplierOrder + "&from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder ,
                    column = [
                        {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                        {data: 'code', name: 'code', className: 'text-left'},
                        {data: 'inventory', name: 'inventory', className: 'text-left'},
                        {data: 'employee_create_full_name', name: 'employee_create_full_name'},
                        {data: 'created_at', name: 'created_at', className: 'text-center'},
                        {data: 'material_quantity', name: 'material_quantity', className: 'text-center'},
                        {data: 'date', name: 'date', className: 'text-center'},
                        {data: 'paid_status', name: 'paid_status', className: 'text-center'},
                        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                        {data: 'keysearch', className: 'd-none'},
                    ];
                tableHistoryRequestSupplierOrder = await loadDataSupplierOrder(element, url, column);
                loadingHistoryRequestSupplierOrder = 1;
            } else if (loadingHistoryRequestSupplierOrder === 0) {
                tableHistoryRequestSupplierOrder.ajax.url("restaurant-material-order-request?branch=" + branchIdSupplierOrder + "&status=" + statusHistoryRequestListSupplierOrder + "&from=" + fromDateSupplierOrder + "&to="+ toDateSupplierOrder).load();
            }
            break;
    }
}

async function loadDataSupplierOrder(element, url, column) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateSupplierOrder',
            },
            {
                'title': 'Thêm mới phiếu xuất kho',
                'icon': 'fa fa-plus text-blue',
                'class': '',
                'function': 'openCreateRequestOutInventoryManage',
            }
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
    $('#total-amount-request-supplier-order').text(formatNumber(response.amount_waiting));
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

function confirmRequestSupplierOrder(id) {
    let title = 'Xác nhận',
        content = 'Xác nhận yêu cầu mua hàng sẽ tạo ra các phiếu mua hàng gửi đến nhà cung cấp !',
        icon = 'warning';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'supplier-order.confirm-request',
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
