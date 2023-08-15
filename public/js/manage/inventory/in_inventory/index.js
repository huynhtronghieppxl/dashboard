let loadingTabMaterialInInventory = 0, loadingTabGoodsInInventory = 0, loadingTabInternalInInventory = 0, loadingTabOtherInInventory = 0,
    tabActiveInInventoryManage = 1,
    tableInInventoryManageMaterial = '', tableInInventoryManageGoods = '', tableInInventoryManageInternal = '',
    tableInInventoryManageOther = '';
let branchIdInInventory= $('.select-branch').val(), typeTabMaterialInInventory = 1, typeTabGoodsInInventory = 2, typeTabInternalInInventory = 3, typeTabOtherInInventory = 12, fromInInventory = $('.from-date-in-inventory-manage').val(), toInInventory = $('.to-date-in-inventory-manage').val(),
    columnsTableInInventory = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', className: 'text-left'},
        {data: 'employee', name: 'employee',className: 'text-left'},
        {data: 'restaurant_supplier.name', name: 'restaurant_supplier', className: 'text-left title-name-new-table'},
        {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
        {data: 'amount', name: 'amount', className: 'text-right'},
        {data: 'discount', name: 'discount', className: 'text-right'},
        {data: 'vat', name: 'vat', className: 'text-right'},
        {data: 'total_amount', name: 'total_amount', className: 'text-right'},
        {data: 'paid_status_name', name: 'paid_status_name', className: 'text-center', width: '5%'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ];

$(function () {
    dateTimePickerFromMaxToDate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'));
    if(getCookieShared('in-inventory-manage-user-id-'+ idSession)){
        let dataCookie = JSON.parse(getCookieShared('in-inventory-manage-user-id-'+ idSession));
        fromInInventory = dataCookie.from;
        toInInventory = dataCookie.to;
        tabActiveInInventoryManage = dataCookie.tab;
        $('.from-date-in-inventory-manage').val(fromInInventory);
        $('.to-date-in-inventory-manage').val(toInInventory);
    }
    $('.search-date-btn-in-inventory-manage').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false
        }
        fromInInventory = $('.from-date-in-inventory-manage').val();
        toInInventory = $('.to-date-in-inventory-manage').val();
        validateDateTemplate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'), loadingData);
    });
    $('.from-date-in-inventory-manage').on('dp.change', function () {
        $('.from-date-in-inventory-manage').val($(this).val());
        $('.from-date-in-inventory-manage').val($(this).val());
    });
    $('.to-date-in-inventory-manage').on('dp.change', function () {
        $('.to-date-in-inventory-manage').val($(this).val());
    });
    $('#nav-in-inventory-manage a[data-id="' + tabActiveInInventoryManage + '"]').click();
});

function updateCookieInInventory(){
    saveCookieShared('in-inventory-manage-user-id-'+ idSession, JSON.stringify({
        'tab' : tabActiveInInventoryManage,
        'from' : fromInInventory,
        'to' : toInInventory,
    }))
}

async function loadData() {
    branchIdInInventory = $('.select-branch').val();
    validateDateTemplate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'), loadingData);
}

async function loadingData() {
    updateCookieInInventory()
    switch (tabActiveInInventoryManage) {
        case 1:
            loadingTabMaterialInInventory = 1;
            loadingTabGoodsInInventory = 0;
            loadingTabInternalInInventory = 0;
            loadingTabOtherInInventory = 0;
            tableInInventoryManageMaterial.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabMaterialInInventory).load();
            break;
        case 2:
            loadingTabMaterialInInventory = 0;
            loadingTabGoodsInInventory = 1;
            loadingTabInternalInInventory = 0;
            loadingTabOtherInInventory = 0;
            tableInInventoryManageGoods.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabGoodsInInventory).load();
            break;
        case 3:
            loadingTabMaterialInInventory = 0;
            loadingTabGoodsInInventory = 0;
            loadingTabInternalInInventory = 1;
            loadingTabOtherInInventory = 0;
            tableInInventoryManageInternal.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabInternalInInventory).load();
            break;
        case 12:
            loadingTabMaterialInInventory = 0;
            loadingTabGoodsInInventory = 0;
            loadingTabInternalInInventory = 0;
            loadingTabOtherInInventory = 1;
            tableInInventoryManageOther.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabOtherInInventory).load();
            break;
    }
}

async function changeActiveTabMaterialData(tab) {
    tabActiveInInventoryManage = tab;
    updateCookieInInventory()
    switch (tab) {
        case 1:
            dateTimePickerFromToDate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'));
            if (tableInInventoryManageMaterial === '') {
                let element = $('#table-material-in-inventory-manage'),
                    url = "in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabMaterialInInventory;
                tableInInventoryManageMaterial = await loadDataInInventoryManage(element, url);
                loadingTabMaterialInInventory = 1;
            } else if (loadingTabMaterialInInventory === 0) {
                tableInInventoryManageMaterial.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabMaterialInInventory).load();
            }
            break;
        case 2:
            dateTimePickerFromToDate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'));
            if (tableInInventoryManageGoods === '') {
                let element = $('#table-goods-in-inventory-manage'),
                    url = "in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabGoodsInInventory;
                tableInInventoryManageGoods = await loadDataInInventoryManage(element, url);
                loadingTabGoodsInInventory = 1;

            } else if (loadingTabGoodsInInventory === 0) {
                tableInInventoryManageGoods.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabGoodsInInventory).load();
            }
            break;
        case 3:
            dateTimePickerFromToDate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'));
            if (tableInInventoryManageInternal === '') {
                let element = $('#table-internal-in-inventory-manage'),
                    url = "in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabInternalInInventory;
                tableInInventoryManageInternal = await loadDataInInventoryManage(element, url);
                loadingTabInternalInInventory = 1;
            } else if (loadingTabInternalInInventory === 0) {
                tableInInventoryManageInternal.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabInternalInInventory).load();
            }
            break;
        case 12:
            dateTimePickerFromToDate($('.from-date-in-inventory-manage'), $('.to-date-in-inventory-manage'));
            if (tableInInventoryManageOther === '') {
                let element = $('#table-other-in-inventory-manage'),
                    url = "in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabOtherInInventory;
                tableInInventoryManageOther = await loadDataInInventoryManage(element, url);
                loadingTabOtherInInventory = 1;
            } else if (loadingTabOtherInInventory === 0) {
                tableInInventoryManageOther.ajax.url("in-inventory-manage.data?from=" + fromInInventory + "&to=" + toInInventory + "&branch_id=" + branchIdInInventory + "&type=" + typeTabOtherInInventory).load();
            }
            break;
    }
}

async function loadDataInInventoryManage(element, url){
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, columnsTableInInventory, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response){
    $('#total-record-material').text(response.count_material);
    $('#total-record-goods').text(response.count_goods);
    $('#total-record-material-internal').text(response.count_internal);
    $('#total-record-other').text(response.count_other);
    $('#total-material-in-inventory-manage').text(response.total_amount_material);
    $('#total-goods-in-inventory-manage').text(response.total_amount_goods);
    $('#total-internal-in-inventory-manage').text(response.total_amount_internal);
    $('#total-other-in-inventory-manage').text(response.total_amount_other);
    $('#amount-material-in-inventory-manage').text(response.amount_material);
    $('#amount-goods-in-inventory-manage').text(response.amount_goods);
    $('#amount-internal-in-inventory-manage').text(response.amount_internal);
    $('#amount-other-in-inventory-manage').text(response.amount_other);
    $('#discount-material-in-inventory-manage').text(response.discount_amount_material);
    $('#discount-goods-in-inventory-manage').text(response.discount_amount_goods);
    $('#discount-internal-in-inventory-manage').text(response.discount_amount_internal);
    $('#discount-other-in-inventory-manage').text(response.discount_amount_other);
    $('#vat-material-in-inventory-manage').text(response.vat_amount_material);
    $('#vat-goods-in-inventory-manage').text(response.vat_amount_goods);
    $('#vat-internal-in-inventory-manage').text(response.vat_amount_internal);
    $('#vat-other-in-inventory-manage').text(response.vat_amount_other);
}
