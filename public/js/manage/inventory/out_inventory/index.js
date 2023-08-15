let loadingTabMaterialOutInventoryManage = 0, loadingTabGoodsOutInventoryManage = 0, loadingTabInternalOutInventoryManage = 0, loadingTabOtherOutInventoryManage = 0, loadingTabCancelOutInventoryManage,
    tabActiveOutInventoryManage = 1,
    tableOutInventoryManageMaterial = '', tableOutInventoryManageGoods = '', tableOutInventoryManageInternal = '',
    tableOutInventoryManageOther = '', tableOutInventoryManageCancel = '',
    branchIdOutInventoryManage = $('.select-branch').val(), typeTabMaterialOutInventoryManage = 1,
    typeTabGoodsOutInventoryManage = 2, typeTabInternalOutInventoryManage = 3, typeTabOtherOutInventoryManage = 12,
    typeCountTabCancelInventoryManage = "1,2", typeCountTabInventoryManage = "1,2",
    typeTabCancelOutInventoryManage = '', typeCountTabCancelOutInventoryManage = 5, fromOutInventoryManage = $('.from-date-out-inventory-manage').val(),
    toOutInventoryManage = $('.to-date-out-inventory-manage').val(),
    columnTableOutInventoryManage = [
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
    columnCancelTableOutInventoryManage = [
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
    dateTimePickerFromMaxToDate($('.from-date-out-inventory-manage') ,$('.to-date-out-inventory-manage'));
    if(getCookieShared('out-inventory-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('out-inventory-manage-user-id-' + idSession));
        fromOutInventoryManage = dataCookie.from;
        toOutInventoryManage = dataCookie.to;
        tabActiveOutInventoryManage = dataCookie.tab;
        $('.from-date-out-inventory-manage').val(fromOutInventoryManage);
        $('.to-date-out-inventory-manage').val(toOutInventoryManage)
    }
    $('.search-btn-out-inventory-manage').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false
        }
        fromOutInventoryManage = $('.from-date-out-inventory-manage').val();
        toOutInventoryManage = $('.to-date-out-inventory-manage').val();
        validateDateTemplate($('.from-date-out-inventory-manage'), $('.to-date-out-inventory-manage'), loadingData);
    });

    $('.from-date-out-inventory-manage').on('dp.change', function (e) {
        $('.from-date-out-inventory-manage').val($(this).val());
        $('.from-date-out-inventory-manage').data('DateTimePicker').date(e.date);
    });
    $('.to-date-out-inventory-manage').on('dp.change', function (e) {
        $('.to-date-out-inventory-manage').val($(this).val());
        $('.to-date-out-inventory-manage').data('DateTimePicker').date(e.date);
    });
    $('#nav-out-inventory-manage a[data-id="' + tabActiveOutInventoryManage + '"]').click();
});

function updateCookieOutInventory(){
    saveCookieShared('out-inventory-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveOutInventoryManage,
        'from' : fromOutInventoryManage,
        'to' : toOutInventoryManage,
    }))
}

async function loadData() {
    branchIdOutInventoryManage = $('.select-branch').val();
    loadingData();
}

async function loadingData() {
    updateCookieOutInventory()
    switch (tabActiveOutInventoryManage) {
        case 1:
            tableOutInventoryManageMaterial.search( '' );
            loadingTabMaterialOutInventoryManage = 1;
            loadingTabGoodsOutInventoryManage = 0;
            loadingTabInternalOutInventoryManage = 0;
            loadingTabOtherOutInventoryManage = 0;
            if(tableOutInventoryManageMaterial) {
                tableOutInventoryManageMaterial.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabMaterialOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabMaterialOutInventoryManage + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 2:
            tableOutInventoryManageGoods.search( '' );
            loadingTabMaterialOutInventoryManage = 0;
            loadingTabGoodsOutInventoryManage = 1;
            loadingTabInternalOutInventoryManage = 0;
            loadingTabOtherOutInventoryManage = 0;
            loadingTabCancelOutInventoryManage = 0;
            if(tableOutInventoryManageGoods) {
                tableOutInventoryManageGoods.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabGoodsOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabGoodsOutInventoryManage + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage  ).load();
            }
            break;
        case 3:
            tableOutInventoryManageInternal.search( '' );
            loadingTabMaterialOutInventoryManage = 0;
            loadingTabGoodsOutInventoryManage = 0;
            loadingTabInternalOutInventoryManage = 1;
            loadingTabOtherOutInventoryManage = 0;
            loadingTabCancelOutInventoryManage = 0;
            if(tableOutInventoryManageInternal) {
                tableOutInventoryManageInternal.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabInternalOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage  + "&type_count=" + typeTabInternalOutInventoryManage + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 12:
            tableOutInventoryManageOther.search( '' );
            loadingTabMaterialOutInventoryManage = 0;
            loadingTabGoodsOutInventoryManage = 0;
            loadingTabInternalOutInventoryManage = 0;
            loadingTabOtherOutInventoryManage = 1;
            loadingTabOtherOutInventoryManage = 0;
            loadingTabCancelOutInventoryManage = 0;
            if(tableOutInventoryManageOther) {
                tableOutInventoryManageOther.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabOtherOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabOtherOutInventoryManage + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 5:
            tableOutInventoryManageCancel.search( '' );
            loadingTabMaterialOutInventoryManage = 0;
            loadingTabGoodsOutInventoryManage = 0;
            loadingTabInternalOutInventoryManage = 0;
            loadingTabOtherOutInventoryManage = 0;
            loadingTabOtherOutInventoryManage = 0;
            loadingTabCancelOutInventoryManage = 1;
            if(tableOutInventoryManageCancel) {
                tableOutInventoryManageCancel.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabCancelOutInventoryManage + '&warehouse_session_statuses=' + '3' + "&type_count=" + typeTabInternalOutInventoryManage + "&warehouse_session_statuses_count=" + typeCountTabCancelInventoryManage).load();
            }
            break;
    }
}

async function changeActiveTabMaterialData(tab) {
    !branchIdOutInventoryManage ? await updateSessionBrandNew($('.select-brand')) : false;
    dateTimePickerFromMaxToDate($('.from-date-out-inventory-manage') ,$('.to-date-out-inventory-manage'));
    tabActiveOutInventoryManage = tab;
    updateCookieOutInventory()
    switch (tab) {
        case 1:
            if (tableOutInventoryManageMaterial === '') {
                let element = $('#table-material-out-inventory-manage'),
                    url = "out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabMaterialOutInventoryManage + "&count_type=" + typeTabMaterialOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabMaterialOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableOutInventoryManageMaterial = await loadDataOutInventoryManage(element, url);
                loadingTabMaterialOutInventoryManage = 1;
            } else if (loadingTabMaterialOutInventoryManage === 0) {
                tableOutInventoryManageMaterial.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabMaterialOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabMaterialOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 2:
            if (tableOutInventoryManageGoods === '') {
                let element = $('#table-goods-out-inventory-manage'),
                    url = "out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabGoodsOutInventoryManage + "&count_type=" + typeTabGoodsOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabGoodsOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableOutInventoryManageGoods = await loadDataOutInventoryManage(element, url);
                loadingTabGoodsOutInventoryManage = 1;
            } else if (loadingTabGoodsOutInventoryManage === 0) {
                tableOutInventoryManageGoods.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabGoodsOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabGoodsOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load()
            }
            break;
        case 3:
            if (tableOutInventoryManageInternal === '') {
                let element = $('#table-internal-out-inventory-manage'),
                    url = "out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabInternalOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabInternalOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableOutInventoryManageInternal = await loadDataOutInventoryManage(element, url);
                loadingTabInternalOutInventoryManage = 1;
            } else if (loadingTabInternalOutInventoryManage === 0) {
                tableOutInventoryManageInternal.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabInternalOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabInternalOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 12:
            if (tableOutInventoryManageOther === '') {
                let element = $('#table-other-out-inventory-manage'),
                    url = "out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabOtherOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabOtherOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ;
                tableOutInventoryManageOther = await loadDataOutInventoryManage(element, url);
                loadingTabOtherOutInventoryManage = 1;
            } else if (loadingTabOtherOutInventoryManage === 0) {
                tableOutInventoryManageOther.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabOtherOutInventoryManage + '&warehouse_session_statuses=' + typeCountTabInventoryManage + "&type_count=" + typeTabOtherOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabInventoryManage ).load();
            }
            break;
        case 5:
            if (tableOutInventoryManageCancel === '') {
                let element = $('#table-cancel-out-inventory-manage'),
                    url = "out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabCancelOutInventoryManage + '&warehouse_session_statuses=' + '3' + "&type_count=" + typeCountTabCancelOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabCancelInventoryManage ;
                tableOutInventoryManageCancel = await loadDataCancelOutInventoryManage(element, url);
                loadingTabCancelOutInventoryManage = 1;
            } else if (loadingTabCancelOutInventoryManage === 0) {
                tableOutInventoryManageCancel.ajax.url("out-inventory-manage.data?from=" + fromOutInventoryManage + "&to=" + toOutInventoryManage + "&branch_id=" + branchIdOutInventoryManage + "&type=" + typeTabCancelOutInventoryManage + '&warehouse_session_statuses=' + '3' + "&type_count=" + typeCountTabCancelOutInventoryManage  + "&warehouse_session_statuses_count=" + typeCountTabCancelInventoryManage ).load();
            }
            break;
    }
}

async function loadDataOutInventoryManage(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateOutInventoryManage',
            },
            {
                'title': 'Thêm mới theo phiếu yêu cầu',
                'icon': 'fa fa-plus',
                'class': '',
                'function': 'openCreateRequestOutInventoryManage',
            }
        ]
    return DatatableServerSideTemplateNew(element, url, columnTableOutInventoryManage, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

async function loadDataCancelOutInventoryManage(element, url) {
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateOutInventoryManage',
            },
            {
                'title': 'Thêm mới theo phiếu yêu cầu',
                'icon': 'fa fa-plus text-warning',
                'class': '',
                'function': 'openCreateRequestOutInventoryManage',
            }
        ]
    return DatatableServerSideTemplateNew(element, url, columnCancelTableOutInventoryManage, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
    $('#total-record-material').text(response.count_material);
    $('#total-record-goods').text(response.count_goods);
    $('#total-record-material-internal').text(response.count_internal);
    $('#total-record-other').text(response.count_other);
    $('#total-cancel-other').text(response.count_other_cancel_out);
    $('#total-cancel-out-inventory-manage').text(response.total_amount_cancel_out);
    $('#total-material-out-inventory-manage').text(response.total_amount_material);
    $('#total-goods-out-inventory-manage').text(response.total_amount_goods);
    $('#total-internal-out-inventory-manage').text(response.total_amount_internal);
    $('#total-other-out-inventory-manage').text(response.total_amount_other);
}
