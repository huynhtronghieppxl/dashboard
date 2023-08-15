let loadingTabMaterialExportInventoryWarehouse = 0, loadingTabGoodsExportInventoryWarehouse = 0,
    loadingTabInternalExportInventoryWarehouse = 0, loadingTabOtherExportInventoryWarehouse = 0, loadingTabCancelExportInventoryWarehouse = 0,
    tabActiveExportInventoryWarehouse = 1,
    tableExportInventoryWarehouseMaterial = '', tableExportInventoryWarehouseGoods = '', tableExportInventoryWarehouseInternal = '',
    tableExportInventoryWarehouseOther = '', tableExportInventoryWarehouseCancel = '',
    branchId = $('.select-branch').val(), typeTabMaterialExportInventoryWarehouse = 1,
    typeTabGoodsExportInventoryWarehouse = 2, typeTabInternalExportInventoryWarehouse = 3, typeTabCancelExportInventoryWarehouse = 5,  typeTabOtherExportInventoryWarehouse = 12,
    typeCountTabCancelInventoryManage = "1,2", typeCountTabInventoryManage = "1,2",
    typeCountTabCancelOutInventoryManage = 5, fromExportInventoryWarehouse = $('.from-date-export-inventory-warehouse').val(),
    toExportInventoryWarehouse = $('.to-date-export-inventory-warehouse').val(),
    columnTableExportInventoryWarehouse = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'export', name: 'export', className: 'text-center'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'total_material', name: 'total_material', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'session_status_name', name: 'session_status_name', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ],
    columnCancelTableExportInventoryWarehouse = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'export', name: 'export', className: 'text-center'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'total_material', name: 'total_material', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ];

$(function () {
    dateTimePickerFromMaxToDate($('.from-date-export-inventory-warehouse') ,$('.to-date-export-inventory-warehouse'));
    if(getCookieShared('export-inventory-warehouse-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('export-inventory-warehouse-user-id-' + idSession));
        fromExportInventoryWarehouse = dataCookie.from;
        toExportInventoryWarehouse = dataCookie.to;
        tabActiveExportInventoryWarehouse = dataCookie.tab;
        $('.from-date-export-inventory-warehouse').val(fromExportInventoryWarehouse);
        $('.to-date-export-inventory-warehouse').val(toExportInventoryWarehouse);
    }
    $('.search-btn-export-inventory-warehouse').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false;
        }
        fromExportInventoryWarehouse = $('.from-date-export-inventory-warehouse').val();
        toExportInventoryWarehouse = $('.to-date-export-inventory-warehouse').val();
        validateDateTemplate($('.from-date-export-inventory-warehouse'), $('.to-date-export-inventory-warehouse'), loadingDataExportInventory);
    });

    $('.from-date-export-inventory-warehouse').on('dp.change', function (e) {
        $('.from-date-export-inventory-warehouse').val($(this).val());
    });
    $('.to-date-export-inventory-warehouse').on('dp.change', function (e) {
        $('.to-date-export-inventory-warehouse').val($(this).val());
    });
    $('#nav-export-inventory-warehouse a[data-id="' + tabActiveExportInventoryWarehouse + '"]').click();
    listBranchByTotalWarehouse(branchId);
});

function updateCookieExportInventory(){
    saveCookieShared('export-inventory-warehouse-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveExportInventoryWarehouse,
        'from' : fromExportInventoryWarehouse,
        'to' : toExportInventoryWarehouse,
    }))
}

async function loadData() {
    branchId = $('.select-branch').val();
    loadingDataExportInventory();
}

async function loadingDataExportInventory() {
    updateCookieExportInventory();
    switch (tabActiveExportInventoryWarehouse) {
        case 1:
            tableExportInventoryWarehouseMaterial.search( '' );
            loadingTabMaterialExportInventoryWarehouse = 1;
            loadingTabGoodsExportInventoryWarehouse = 0;
            loadingTabInternalExportInventoryWarehouse = 0;
            loadingTabOtherExportInventoryWarehouse = 0;
            loadingTabCancelExportInventoryWarehouse = 0;
            tableExportInventoryWarehouseMaterial.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabMaterialExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabMaterialExportInventoryWarehouse + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            break;
        case 2:
            tableExportInventoryWarehouseGoods.search( '' );
            loadingTabMaterialExportInventoryWarehouse = 0;
            loadingTabGoodsExportInventoryWarehouse = 1;
            loadingTabInternalExportInventoryWarehouse = 0;
            loadingTabOtherExportInventoryWarehouse = 0;
            loadingTabCancelExportInventoryWarehouse = 0;
            tableExportInventoryWarehouseGoods.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabGoodsExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabGoodsExportInventoryWarehouse + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage  ).load();
            break;
        case 3:
            tableExportInventoryWarehouseInternal.search( '' );
            loadingTabMaterialExportInventoryWarehouse = 0;
            loadingTabGoodsExportInventoryWarehouse = 0;
            loadingTabInternalExportInventoryWarehouse = 1;
            loadingTabOtherExportInventoryWarehouse = 0;
            loadingTabCancelExportInventoryWarehouse = 0;
            tableExportInventoryWarehouseInternal.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabInternalExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage  + "&type_count=" + typeTabInternalExportInventoryWarehouse + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            break;
        case 12:
            tableExportInventoryWarehouseOther.search( '' );
            loadingTabMaterialExportInventoryWarehouse = 0;
            loadingTabGoodsExportInventoryWarehouse = 0;
            loadingTabInternalExportInventoryWarehouse = 0;
            loadingTabOtherExportInventoryWarehouse = 1;
            loadingTabCancelExportInventoryWarehouse = 0;
            tableExportInventoryWarehouseOther.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabOtherExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabOtherExportInventoryWarehouse + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            break;
        case 5:
            tableExportInventoryWarehouseCancel.search( '' );
            loadingTabMaterialExportInventoryWarehouse = 0;
            loadingTabGoodsExportInventoryWarehouse = 0;
            loadingTabInternalExportInventoryWarehouse = 0;
            loadingTabOtherExportInventoryWarehouse = 0;
            loadingTabCancelExportInventoryWarehouse = 1;
            tableExportInventoryWarehouseCancel.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabCancelExportInventoryWarehouse + '&warehouse_session_statuses=' + '3' + "&type_count=" + typeTabInternalExportInventoryWarehouse + "&warehouse_session_statuses_count=" + typeCountTabCancelInventoryManage).load();
            break;
    }
}

async function changeActiveTabExportInventory(tab) {
    dateTimePickerFromMaxToDate($('.from-date-export-inventory-warehouse') ,$('.to-date-export-inventory-warehouse'));
    tabActiveExportInventoryWarehouse = tab;
    updateCookieExportInventory();
    switch (tab) {
        case 1:
            if (tableExportInventoryWarehouseMaterial === '') {
                let element = $('#table-material-export-inventory-warehouse'),
                    url = "export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabMaterialExportInventoryWarehouse + "&count_type=" + typeTabMaterialExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabMaterialExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableExportInventoryWarehouseMaterial = await loadDataExportInventoryWarehouse(element, url);
                loadingTabMaterialOutInventoryManage = 1;
            } else if (loadingTabMaterialOutInventoryManage === 0) {
                tableExportInventoryWarehouseMaterial.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabMaterialExportInventoryWarehouse + '&warehouse_session_statuses=' + typeTabMaterialExportInventoryWarehouse + "&type_count=" + typeTabMaterialExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 2:
            if (tableExportInventoryWarehouseGoods === '') {
                let element = $('#table-goods-export-inventory-warehouse'),
                    url = "export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabGoodsExportInventoryWarehouse + "&count_type=" + typeTabGoodsExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabGoodsExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableExportInventoryWarehouseGoods = await loadDataExportInventoryWarehouse(element, url);
                loadingTabGoodsOutInventoryManage = 1;
            } else if (loadingTabGoodsOutInventoryManage === 0) {
                tableExportInventoryWarehouseGoods.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabGoodsExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabGoodsExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load()
            }
            break;
        case 3:
            if (tableExportInventoryWarehouseInternal === '') {
                let element = $('#table-internal-export-inventory-warehouse'),
                    url = "export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabInternalExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabInternalExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableExportInventoryWarehouseInternal = await loadDataExportInventoryWarehouse(element, url);
                loadingTabInternalOutInventoryManage = 1;
            } else if (loadingTabInternalOutInventoryManage === 0) {
                tableExportInventoryWarehouseInternal.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabInternalExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabInternalExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 12:
            if (tableExportInventoryWarehouseOther === '') {
                let element = $('#table-other-export-inventory-warehouse'),
                    url = "export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabOtherExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabOtherExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableExportInventoryWarehouseOther = await loadDataExportInventoryWarehouse(element, url);
                loadingTabOtherOutInventoryManage = 1;
            } else if (loadingTabOtherOutInventoryManage === 0) {
                tableExportInventoryWarehouseOther.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabOtherExportInventoryWarehouse + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabOtherExportInventoryWarehouse  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 5:
            if (tableExportInventoryWarehouseCancel === '') {
                let element = $('#table-cancel-export-inventory-warehouse'),
                    url = "export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabCancelExportInventoryWarehouse + '&warehouse_session_statuses=' + '3' + "&type_count=" + typeCountTabCancelOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabCancelInventoryManage ;
                tableExportInventoryWarehouseCancel = await loadDataCancelExportInventoryWarehouse(element, url);
                loadingTabCancelOutInventoryManage = 1;
            } else if (loadingTabCancelOutInventoryManage === 0) {
                tableExportInventoryWarehouseCancel.ajax.url("export-inventory-warehouse.data?from=" + fromExportInventoryWarehouse + "&to=" + toExportInventoryWarehouse + "&branch_id=" + branchId + "&type=" + typeTabCancelExportInventoryWarehouse + '&warehouse_session_statuses=' + '3' + "&type_count=" + typeCountTabCancelOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabCancelInventoryManage ).load();
            }
            break;
    }
}

async function loadDataExportInventoryWarehouse(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateExportInventoryWarehouse',
            },
            {
                'title': 'Thêm mới theo phiếu yêu cầu',
                'icon': 'fa fa-plus',
                'class': '',
                'function': 'openCreateRequestExportInventoryWarehouse',
            }
        ]
    return DatatableServerSideTemplateNew(element, url, columnTableExportInventoryWarehouse, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackExportWarehouse);
}

async function loadDataCancelExportInventoryWarehouse(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateExportInventoryWarehouse',
            },
            {
                'title': 'Thêm mới theo phiếu yêu cầu',
                'icon': 'fa fa-plus text-warning',
                'class': '',
                'function': 'openCreateRequestExportInventoryWarehouse',
            }
        ]
    return DatatableServerSideTemplateNew(element, url, columnCancelTableExportInventoryWarehouse, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackExportWarehouse);
}

function callbackExportWarehouse(response) {
    $('#total-record-material').text(response.count_material);
    $('#total-record-goods').text(response.count_goods);
    $('#total-record-material-internal').text(response.count_internal);
    $('#total-record-other').text(response.count_other);
    $('#total-cancel-other').text(response.count_other_cancel_out);
    $('#total-cancel-export-inventory-warehouse').text(response.total_amount_cancel_out);
    $('#total-material-export-inventory-warehouse').text(response.total_amount_material);
    $('#total-goods-export-inventory-warehouse').text(response.total_amount_goods);
    $('#total-internal-export-inventory-warehouse').text(response.total_amount_internal);
    $('#total-other-export-inventory-warehouse').text(response.total_amount_other);
}

async function listBranchByTotalWarehouse (id) {
    let method = 'get',
        url = 'export-inventory-warehouse.list-branch',
        params = {
            branch_office_id: id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-target-branch-create-export-inventory-warehouse').html(res.data?.[0]);
}
