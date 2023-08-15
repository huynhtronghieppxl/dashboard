let loadingTabMaterialInInventorySupplier = 0, loadingTabGoodsInInventorySupplier = 0, loadingTabInternalInInventorySupplier = 0, loadingTabOtherInInventorySupplier = 0,
    tabActiveInInventoryManageSupplier = 1,
    tableInInventoryManageMaterialSupplier = '', tableInInventoryManageGoodsSupplier = '', tableInInventoryManageInternalSupplier = '',
    tableInInventoryManageOtherSupplier = '';
let branchIdInInventorySupplier = $('.select-branch').val(), typeTabMaterialInInventorySupplier = 1, typeTabGoodsInInventorySupplier = 2, typeTabInternalInInventorySupplier = 3, typeTabOtherInInventorySupplier = 12, fromInInventorySupplier= $('.from-date-in-inventory-supplier').val(), toInInventorySupplier= $('.to-date-in-inventory-supplier').val(),
    columnsTableInInventorySupplier = [
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
    dateTimePickerFromMaxToDate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'));
    if(getCookieShared('in-inventory-supplier-user-id-'+ idSession)){
        let dataCookie = JSON.parse(getCookieShared('in-inventory-supplier-user-id-'+ idSession));
        fromInInventorySupplier = dataCookie.from;
        toInInventorySupplier = dataCookie.to;
        tabActiveInInventoryManageSupplier = dataCookie.tab;
        $('.from-date-in-inventory-supplier').val(fromInInventorySupplier);
        $('.to-date-in-inventory-supplier').val(toInInventorySupplier);
    }
    $('.search-date-btn-in-inventory-supplier').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false
        }
        fromInInventorySupplier = $('.from-date-in-inventory-supplier').val();
        toInInventorySupplier = $('.to-date-in-inventory-supplier').val();
        validateDateTemplate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'), loadingData);
    });
    $('.from-date-in-inventory-supplier').on('dp.change', function () {
        $('.from-date-in-inventory-supplier').val($(this).val());
        $('.from-date-in-inventory-supplier').val($(this).val());
    });
    $('.to-date-in-inventory-supplier').on('dp.change', function () {
        $('.to-date-in-inventory-supplier').val($(this).val());
    });
    $('#nav-in-inventory-supplier a[data-id="' + tabActiveInInventoryManageSupplier + '"]').click();
});

function updateCookieInInventory(){
    saveCookieShared('in-inventory-supplier-user-id-'+ idSession, JSON.stringify({
        'tab' : tabActiveInInventoryManageSupplier,
        'from' : fromInInventorySupplier,
        'to' : toInInventorySupplier,
    }))
}

async function loadData() {
    branchIdInInventorySupplier = $('.select-branch').val();
    validateDateTemplate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'), loadingData);
}

async function loadingData() {
    updateCookieInInventory()
    switch (tabActiveInInventoryManageSupplier) {
        case 1:
            loadingTabMaterialInInventorySupplier = 1;
            loadingTabGoodsInInventorySupplier = 0;
            loadingTabInternalInInventorySupplier = 0;
            loadingTabOtherInInventorySupplier = 0;
            tableInInventoryManageMaterialSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabMaterialInInventorySupplier).load();
            break;
        case 2:
            loadingTabMaterialInInventorySupplier = 0;
            loadingTabGoodsInInventorySupplier = 1;
            loadingTabInternalInInventorySupplier = 0;
            loadingTabOtherInInventorySupplier = 0;
            tableInInventoryManageGoodsSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabGoodsInInventorySupplier).load();
            break;
        case 3:
            loadingTabMaterialInInventorySupplier = 0;
            loadingTabGoodsInInventorySupplier = 0;
            loadingTabInternalInInventorySupplier = 1;
            loadingTabOtherInInventorySupplier = 0;
            tableInInventoryManageInternalSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabInternalInInventorySupplier).load();
            break;
        case 12:
            loadingTabMaterialInInventorySupplier = 0;
            loadingTabGoodsInInventorySupplier = 0;
            loadingTabInternalInInventorySupplier = 0;
            loadingTabOtherInInventorySupplier = 1;
            tableInInventoryManageOtherSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabOtherInInventorySupplier).load();
            break;
    }
}

async function changeActiveTabMaterialData(tab) {
    tabActiveInInventoryManageSupplier = tab;
    updateCookieInInventory()
    switch (tab) {
        case 1:
            dateTimePickerFromToDate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'));
            if (tableInInventoryManageMaterialSupplier === '') {
                let element = $('#table-material-in-inventory-supplier'),
                    url = "in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabMaterialInInventorySupplier;
                tableInInventoryManageMaterialSupplier = await loadDataInInventoryManage(element, url);
                loadingTabMaterialInInventorySupplier = 1;
            } else if (loadingTabMaterialInInventorySupplier === 0) {
                tableInInventoryManageMaterialSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabMaterialInInventorySupplier).load();
            }
            break;
        case 2:
            dateTimePickerFromToDate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'));
            if (tableInInventoryManageGoodsSupplier === '') {
                let element = $('#table-goods-in-inventory-supplier'),
                    url = "in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabGoodsInInventorySupplier;
                tableInInventoryManageGoodsSupplier = await loadDataInInventoryManage(element, url);
                loadingTabGoodsInInventorySupplier = 1;

            } else if (loadingTabGoodsInInventorySupplier === 0) {
                tableInInventoryManageGoodsSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabGoodsInInventorySupplier).load();
            }
            break;
        case 3:
            dateTimePickerFromToDate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'));
            if (tableInInventoryManageInternalSupplier === '') {
                let element = $('#table-internal-in-inventory-supplier'),
                    url = "in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabInternalInInventorySupplier;
                tableInInventoryManageInternalSupplier = await loadDataInInventoryManage(element, url);
                loadingTabInternalInInventorySupplier = 1;
            } else if (loadingTabInternalInInventorySupplier === 0) {
                tableInInventoryManageInternalSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabInternalInInventorySupplier).load();
            }
            break;
        case 12:
            dateTimePickerFromToDate($('.from-date-in-inventory-supplier'), $('.to-date-in-inventory-supplier'));
            if (tableInInventoryManageOtherSupplier === '') {
                let element = $('#table-other-in-inventory-supplier'),
                    url = "in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabOtherInInventorySupplier;
                tableInInventoryManageOtherSupplier = await loadDataInInventoryManage(element, url);
                loadingTabOtherInInventorySupplier = 1;
            } else if (loadingTabOtherInInventorySupplier === 0) {
                tableInInventoryManageOtherSupplier.ajax.url("in-inventory-supplier.data?from=" + fromInInventorySupplier + "&to=" + toInInventorySupplier + "&branch_id=" + branchIdInInventorySupplier + "&type=" + typeTabOtherInInventorySupplier).load();
            }
            break;
    }
}

async function loadDataInInventoryManage(element, url){
    let fixedLeftTable = 2,
        fixedRightTable = 2,
        optionRenderTable = []
    return DatatableServerSideTemplateNew(element, url, columnsTableInInventorySupplier, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response){
    $('#total-record-material').text(response.count_material);
    $('#total-record-goods').text(response.count_goods);
    $('#total-record-material-internal').text(response.count_internal);
    $('#total-record-other').text(response.count_other);
    $('#total-material-in-inventory-supplier').text(response.total_amount_material);
    $('#total-goods-in-inventory-supplier').text(response.total_amount_goods);
    $('#total-internal-in-inventory-supplier').text(response.total_amount_internal);
    $('#total-other-in-inventory-supplier').text(response.total_amount_other);
    $('#amount-material-in-inventory-supplier').text(response.amount_material);
    $('#amount-goods-in-inventory-supplier').text(response.amount_goods);
    $('#amount-internal-in-inventory-supplier').text(response.amount_internal);
    $('#amount-other-in-inventory-supplier').text(response.amount_other);
    $('#discount-material-in-inventory-supplier').text(response.discount_amount_material);
    $('#discount-goods-in-inventory-supplier').text(response.discount_amount_goods);
    $('#discount-internal-in-inventory-supplier').text(response.discount_amount_internal);
    $('#discount-other-in-inventory-supplier').text(response.discount_amount_other);
    $('#vat-material-in-inventory-supplier').text(response.vat_amount_material);
    $('#vat-goods-in-inventory-supplier').text(response.vat_amount_goods);
    $('#vat-internal-in-inventory-supplier').text(response.vat_amount_internal);
    $('#vat-other-in-inventory-supplier').text(response.vat_amount_other);
}
