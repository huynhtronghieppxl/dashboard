let branchIdCancelInventory = $('.select-branch').val(), typeTabMaterialCancelInventory = 1, typeTabGoodsCancelInventory = 2, typeTabInternalCancelInventory = 3, typeTabOtherCancelInventory = 12,
    fromCancelInventory = $('.from-date-cancel-inventory-internal-manage').val(),
    toCancelInventory = $('.to-date-cancel-inventory-internal-manage').val(),
    loadingTabMaterialCancelInventory = 0, loadingTabGoodsCancelInventory = 0, loadingTabInternalCancelInventory = 0, loadingTabOtherCancelInventory = 0,
    tabActiveCancelInventory = 0,
    tableCancelInventoryManageMaterial = '', tableCancelInventoryManageGoods = '',
    tableCancelInventoryManageInternal = '', tableCancelInventoryManageOther = '',
    columTableCancelInventory = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'total_material', name: 'total_material', className: 'text-center'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ];

$(function () {
    shortcut.add("F2", function () {
        openCreateCancelInventoryManage();
    });
    if(getCookieShared('cancel-inventory-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('cancel-inventory-user-id-' + idSession));
        fromCancelInventory = dataCookie.from;
        toCancelInventory = dataCookie.to;
        tabActiveCancelInventory = dataCookie.tab;

        $('.from-date-cancel-inventory-internal-manage').val(fromCancelInventory);
        $('.to-date-cancel-inventory-internal-manage').val(toCancelInventory)
    }
    dateTimePickerFromMaxToDate($('.from-date-cancel-inventory-internal-manage'), $('.to-date-cancel-inventory-internal-manage'))
    $('.from-date-cancel-inventory-internal-manage').on('dp.change', function () {
        $('.from-date-cancel-inventory-internal-manage').val($(this).val());
    });
    $('.to-date-cancel-inventory-internal-manage').on('dp.change', function () {
        $('.to-date-cancel-inventory-internal-manage').val($(this).val());
    });

    $('.search-btn-cancel-inventory-internal-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromCancelInventory = $('.from-date-cancel-inventory-internal-manage').val();
        toCancelInventory = $('.to-date-cancel-inventory-internal-manage').val();
        validateDateTemplate($('.from-date-cancel-inventory-internal-manage'), $('.to-date-cancel-inventory-internal-manage'), loadingData);
    });
    $('#tab-change-cancel-inventory-manage a[data-id="'  + tabActiveCancelInventory + '"]').click()
});

async function loadData() {
    branchIdCancelInventory = $('.select-branch').val();
    loadingData();
}

function updateCookieCancelInventory(){
    saveCookieShared('cancel-inventory-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveCancelInventory,
        'from' : fromCancelInventory,
        'to' : toCancelInventory,
    }))
}

async function loadingData() {
    updateCookieCancelInventory()
    switch (tabActiveCancelInventory) {
        case 0:
            loadingTabMaterialCancelInventory = 1;
            loadingTabGoodsCancelInventory = 0;
            loadingTabInternalCancelInventory = 0;
            loadingTabOtherCancelInventory = 0;
            if(tableCancelInventoryManageMaterial) {
                tableCancelInventoryManageMaterial.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabMaterialCancelInventory).load();
            }
            break;
        case 1:
            loadingTabMaterialCancelInventory = 0;
            loadingTabGoodsCancelInventory = 1;
            loadingTabInternalCancelInventory = 0;
            loadingTabOtherCancelInventory = 0;
            if(tableCancelInventoryManageGoods) {
                tableCancelInventoryManageGoods.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabGoodsCancelInventory).load();
            }
            break;
        case 2:
            loadingTabMaterialCancelInventory = 0;
            loadingTabGoodsCancelInventory = 0;
            loadingTabInternalCancelInventory = 1;
            loadingTabOtherCancelInventory = 0;
            if(tableCancelInventoryManageInternal) {
                tableCancelInventoryManageInternal.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabInternalCancelInventory).load();
            }
            break;
        case 3:
            loadingTabMaterialCancelInventory = 0;
            loadingTabGoodsCancelInventory = 0;
            loadingTabInternalCancelInventory = 0;
            loadingTabOtherCancelInventory = 1;
            if(tableCancelInventoryManageOther) {
                tableCancelInventoryManageOther.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabOtherCancelInventory).load();
            }
            break;
    }
}

async function changeActiveTabCancelInventoryInternalManage(tab) {
    !branchIdCancelInventory ? await updateSessionBrandNew($('.select-brand')) : false;
    tabActiveCancelInventory = tab;
    updateCookieCancelInventory()
    switch (tab) {
        case 0:
            if (tableCancelInventoryManageMaterial === '') {
                let element = $('#table-material-cancel-inventory-manage'),
                    url = "cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabMaterialCancelInventory;
                tableCancelInventoryManageMaterial = await loadDataCancelInventoryManage(element, url);
                loadingTabMaterialCancelInventory = 1;
            } else if (loadingTabMaterialCancelInventory === 0) {
                tableCancelInventoryManageMaterial.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabMaterialCancelInventory).load();
            }
            break;
        case 1:
            if (tableCancelInventoryManageGoods === '') {
                let element = $('#table-goods-cancel-inventory-manage'),
                    url = "cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabGoodsCancelInventory;
                tableCancelInventoryManageGoods = await loadDataCancelInventoryManage(element, url);
                loadingTabGoodsCancelInventory = 1;
            } else if (loadingTabGoodsCancelInventory === 0) {
                tableCancelInventoryManageGoods.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabGoodsCancelInventory).load();
            }
            break;
        case 2:
            if (tableCancelInventoryManageInternal === '') {
                let element = $('#table-internal-cancel-inventory-manage'),
                    url = "cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabInternalCancelInventory;
                tableCancelInventoryManageInternal = await loadDataCancelInventoryManage(element, url);
                loadingTabInternalCancelInventory = 1;
            } else if (loadingTabInternalCancelInventory === 0) {
                tableCancelInventoryManageInternal.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabInternalCancelInventory).load();
            }
            break;
        case 3:
            if (tableCancelInventoryManageOther === '') {
                let element = $('#table-other-cancel-inventory-manage'),
                    url = "cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabOtherCancelInventory;
                tableCancelInventoryManageOther = await loadDataCancelInventoryManage(element, url);
                loadingTabOtherCancelInventory = 1;
            } else if (loadingTabOtherCancelInventory === 0) {
                tableCancelInventoryManageOther.ajax.url("cancel-inventory-manage.data?from=" + fromCancelInventory + "&to=" + toCancelInventory + "&branch_id=" + branchIdCancelInventory + "&type=" + typeTabOtherCancelInventory).load();
            }
            break;
    }
}


function loadDataCancelInventoryManage(element, url) {
    let fixedLeftTable = 0,
        fixedRightTable = 0,
        optionRenderTable = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateCancelInventoryManage',
            },
        ]
    return DatatableServerSideTemplateNew(element, url, columTableCancelInventory, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
    $('#total-record-material').text(response.count_material);
    $('#total-record-goods').text(response.count_goods);
    $('#total-record-material-internal').text(response.count_internal);
    $('#total-record-other').text(response.count_other);
}

