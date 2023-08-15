let loadingTabKitchenInInventoryManage = 0, loadingTabBarInInventoryManage = 0, loadingTabSaleInInventoryManage = 0, loadingTabFoodInInventoryManage = 0, loadingTabOtherInInventoryManage = 0,
    tabActiveInInventoryManage = 1,
    tableInInventoryManageKitchen = '',
    tableInInventoryManageBar = '',
    tableInInventoryManageSale = '',
    tableInInventoryManageFood = '';
let branchIdInInventoryManage = $('#select-branch-in-inventory-internal').val(), typeTabKitchenInInventoryManage = 1, typeTabBarInInventoryManage = 2,
    typeTabSaleInInventoryManage = 3, typeTabFoodInInventoryManage = 4, typeTabOtherInInventoryManage = 0,
    fromInInventoryManage = $('.from-date-in-inventory-internal-manage').val(), toInInventoryManage = $('.to-date-in-inventory-internal-manage').val(),
    columnInInventoryManage = [
        {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'code', name: 'code', class: 'text-left'},
        {data: 'employee', name: 'employee', className: 'text-left'},
        {data: 'created_at', name: 'created_at', className: 'text-center'},
        {data: 'total_material', name: 'total_material', className: 'text-center'},
        {data: 'total_amount', name: 'total_amount', class: 'text-right'},
        {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        {data: 'keysearch', className: 'd-none'},
    ],
    fixedLeftTableInInventoryManage = 0,
    fixedRightTableInInventoryManage = 0;

$(function () {
    dateTimePickerFromMaxToDate($('.from-date-in-inventory-internal-manage'), $('.to-date-in-inventory-internal-manage'))
    if(getCookieShared('in-inventory-internal-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('in-inventory-internal-manage-user-id-' + idSession));
        fromInInventoryManage = dataCookie.from;
        toInInventoryManage = dataCookie.to;
        tabActiveInInventoryManage = dataCookie.tab;

        $('.from-date-in-inventory-internal-manage').val(fromInInventoryManage);
        $('.to-date-in-inventory-internal-manage').val(toInInventoryManage)
    }
    $('.search-btn-in-inventory-internal-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false;
        fromInInventoryManage = $('.from-date-in-inventory-internal-manage').val();
        toInInventoryManage = $('.to-date-in-inventory-internal-manage').val();
        validateDateTemplate($('.from-date-in-inventory-internal-manage'), $('.to-date-in-inventory-internal-manage'), loadingDataInInventoryManage);
    });
    $('.from-date-in-inventory-internal-manage').on('dp.change', function () {
        $('.from-date-in-inventory-internal-manage').val($(this).val());
    });
    $('.to-date-in-inventory-internal-manage').on('dp.change', function () {
        $('.to-date-in-inventory-internal-manage').val($(this).val());
    });
    $('#nav-tab-in-inventory-internal-manage a[data-id="' + tabActiveInInventoryManage + '"]').click()
});


async function loadData() {
    branchIdInInventoryManage = $('#select-branch-in-inventory-internal').val();
    loadingDataInInventoryManage();
}

function updateCookieInInventoryInternal(){
    saveCookieShared('in-inventory-internal-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveInInventoryManage,
        'from' : fromInInventoryManage,
        'to' : toInInventoryManage,
    }))
}

async function loadingDataInInventoryManage() {
    updateCookieInInventoryInternal()
    switch (tabActiveInInventoryManage) {
        case 1:
            loadingTabKitchenInInventoryManage = 1;
            loadingTabBarInInventoryManage = 0;
            loadingTabSaleInInventoryManage = 0;
            loadingTabFoodInInventoryManage = 0;
            if(tableInInventoryManageKitchen) {
                tableInInventoryManageKitchen.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabKitchenInInventoryManage).load();
            }
            break;
        case 2:
            loadingTabKitchenInInventoryManage = 0;
            loadingTabBarInInventoryManage = 1;
            loadingTabSaleInInventoryManage = 0;
            loadingTabFoodInInventoryManage = 0;
            if(tableInInventoryManageBar) {
                tableInInventoryManageBar.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabBarInInventoryManage).load();
            }
            break;
        case 3:
            loadingTabKitchenInInventoryManage = 0;
            loadingTabBarInInventoryManage = 0;
            loadingTabSaleInInventoryManage = 1;
            loadingTabFoodInInventoryManage = 0;
            if(tableInInventoryManageSale) {
                tableInInventoryManageSale.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabSaleInInventoryManage).load();
            }
            break;
        case 4:
            loadingTabKitchenInInventoryManage = 0;
            loadingTabBarInInventoryManage = 0;
            loadingTabSaleInInventoryManage = 0;
            loadingTabFoodInInventoryManage = 1;
            if(tableInInventoryManageFood) {
                tableInInventoryManageFood.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabFoodInInventoryManage).load();
            }
            break;
    }
}

async function changeActiveTabData(tab) {
    tabActiveInInventoryManage = tab;
    updateCookieInInventoryInternal()
    !branchIdInInventoryManage ? await updateSessionBrandNew($('.select-brand')) : false;
    switch (tab) {
        case 1:
            if (tableInInventoryManageKitchen === '') {
                loadDataKitchenInInventoryManage();
                loadingTabKitchenInInventoryManage = 1;
            } else if (loadingTabKitchenInInventoryManage === 0) {
                tableInInventoryManageKitchen.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabKitchenInInventoryManage).load();
            }
            break;
        case 2:
            if (tableInInventoryManageBar === '') {
                loadDataBarInInventoryManage();
                loadingTabBarInInventoryManage = 1;
            } else if (loadingTabBarInInventoryManage === 0) {
                tableInInventoryManageBar.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabBarInInventoryManage).load();
            }
            break;
        case 3:
            if (tableInInventoryManageSale === '') {
                loadDataSaleInInventoryManage();
                loadingTabSaleInInventoryManage = 1;
            } else if (loadingTabSaleInInventoryManage === 0) {
                tableInInventoryManageSale.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabSaleInInventoryManage).load();
            }
            break;
        case 4:
            if (tableInInventoryManageFood === '') {
                loadDataFoodInInventoryManage();
                loadingTabFoodInInventoryManage = 1;
            } else if (loadingTabFoodInInventoryManage === 0) {
                tableInInventoryManageFood.ajax.url("in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabFoodInInventoryManage).load();
            }
            break;
    }
}

async function loadDataKitchenInInventoryManage() {
    loadingTabKitchenInInventoryManage = 1;
    let id = $('#table-kitchen-in-inventory-internal-manage'),
        url = "in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabKitchenInInventoryManage;
    tableInInventoryManageKitchen = await DatatableServerSideTemplateNew(id, url, columnInInventoryManage, vh_of_table, fixedLeftTableInInventoryManage, fixedRightTableInInventoryManage, [], callbackLoadDataInInventoryManage);
}

async function loadDataBarInInventoryManage() {
    loadingTabBarInInventoryManage = 1;
    let id = $('#table-bar-in-inventory-internal-manage'),
        url = "in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabBarInInventoryManage;
    tableInInventoryManageBar = await DatatableServerSideTemplateNew(id, url, columnInInventoryManage, vh_of_table, fixedLeftTableInInventoryManage, fixedRightTableInInventoryManage, [], callbackLoadDataInInventoryManage);
}

async function loadDataSaleInInventoryManage() {
    loadingTabSaleInInventoryManage = 1;
    let id = $('#table-employee-in-inventory-internal-manage'),
        url = "in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabSaleInInventoryManage;
    tableInInventoryManageSale = await DatatableServerSideTemplateNew(id, url, columnInInventoryManage, vh_of_table, fixedLeftTableInInventoryManage, fixedRightTableInInventoryManage, [], callbackLoadDataInInventoryManage);
}

async function loadDataFoodInInventoryManage() {
    loadingTabFoodInInventoryManage = 1;
    let id = $('#table-food-in-inventory-internal-manage'),
        url = "in-inventory-internal-manage.data?from=" + fromInInventoryManage + "&to=" + toInInventoryManage + "&branch_id=" + branchIdInInventoryManage + "&type=" + typeTabFoodInInventoryManage;
    tableInInventoryManageFood = await DatatableServerSideTemplateNew(id, url, columnInInventoryManage, vh_of_table, fixedLeftTableInInventoryManage, fixedRightTableInInventoryManage, [], callbackLoadDataInInventoryManage);
}

function callbackLoadDataInInventoryManage(response) {
    console.log(response)
    $('#total-record-kitchen').text(response.config[1].data.warehouse_inner_session_kitchen);
    $('#total-record-bar').text(response.config[1].data.warehouse_inner_session_bar);
    $('#total-record-employee').text(response.config[1].data.warehouse_inner_session_employee_sale);
    $('#total-record-internal').text(response.config[1].data.warehouse_inner_session_food);
    $('#total-record-other').text(response.config[1].data.warehouse_inner_session_another);

    $('#total-amount-kitchen-in-inventory-internal-manage').text(formatNumber(response.config[1].data.total_amount_kitchen));
    $('#total-amount-bar-in-inventory-internal-manage').text(formatNumber(response.config[1].data.total_amount_bar));
    $('#total-amount-employee-sale-in-inventory-internal-manage').text(formatNumber(response.config[1].data.total_amount_employee_sale));
    $('#total-amount-food-in-inventory-internal-manage').text(formatNumber(response.config[1].data.total_amount_food));
}
