let loadingTabCustomer = 0, loadingTabUsePoint = 0,
    tabActiveCustomer = 1,
    tableCustomer = '', tableCustomerUsePoint = '';

$(function () {
    if(getCookieShared('customers-aloline-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('customers-aloline-user-id-' + idSession));
        tabActiveCustomer = dataCookie.tab;
    }
    $('#nav-tab-customer-aloline a[data-id="' + tabActiveCustomer + '"]').click()
    loadData()
});

function updateCookieCustomerAloline(){
    saveCookieShared('customers-aloline-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveCustomer,
    }))
}

async function loadData() {
    loadingData()
}

async function loadingData() {
    updateCookieCustomerAloline()
    if (tabActiveCustomer === 1) {
        loadingTabCustomer = 1;
        loadingTabUsePoint = 0;
        tableCustomer.ajax.url("customers.data?type=" + 1).load();
    } else if (tabActiveCustomer === 2) {
        loadingTabCustomer = 0;
        loadingTabUsePoint = 1;
        tableCustomerUsePoint.ajax.url("customers.data-use-point-customer?type=" + 2).load();
    }
}

async function changeActiveTabCustomer(tab) {
    tabActiveCustomer = tab;
    updateCookieCustomerAloline()
    if (tabActiveCustomer === 1) {
        if (tableCustomer === '') {
            let element = $('#table-customers'),
                url = "customers.data?type=" + 1,
                column = [
                    {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
                    {data: 'avatar', name: 'avatar', className: 'text-left'},
                    {data: 'phone', name: 'phone', className: 'text-left', width: '15%'},
                    {data: 'point', name: 'point', className: 'text-right'},
                    {data: 'accumulate_point', name: 'accumulate_point', className: 'text-right', width: '15%'},
                    {data: 'promotion_point', name: 'promotion_point', className: 'text-right'},
                    {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                ];
            tableCustomer = await loadDataCustomer(element, url, column);
            loadingTabCustomer = 1;
        } else if (loadingTabCustomer === 0) {
            tableCustomer.ajax.url("customers.data?type=" + 1).load();
        }
    } else if (tabActiveCustomer === 2) {
        if (tableCustomerUsePoint === '') {
            let element = $('#table-customers-use-points'),
                url = "customers.data-use-point-customer?type=" + 2,
                column = [
                    {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
                    {data: 'avatar', name: 'avatar', className: 'text-left'},
                    {data: 'phone', name: 'phone', className: 'text-left'},
                    {data: 'point_use', name: 'point_use', className: 'text-right'},
                    {data: 'accumulate_point_use', name: 'accumulate_point_use', className: 'text-right'},
                    {data: 'promotion_point_use', name: 'promotion_point_use', className: 'text-right'},
                    {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                ];
            tableCustomerUsePoint = await loadDataCustomer(element, url, column);
            loadingTabUsePoint = 1;
        } else if (loadingTabUsePoint === 0) {
            tableCustomerUsePoint.ajax.url("customers.data-use-point-customer?type=" + 2).load();
        }
    }
}

async function loadDataCustomer(element, url, column){
    let fixedLeftTable = 2,
        fixedRightTable = 2
        optionRenderTable = [{
            'title': 'Gán thẻ tag cho nhiều khách hàng',
            'icon': 'fi-rr-shuffle',
            'class': 'd-none',
            'function': 'openModalAssignCustomerTagForCustomers',
        }]
    return DatatableServerSideTemplateNew(element, url, column, vh_table_tab, fixedLeftTable, fixedRightTable, [], callbackCustomerData);
}

function callbackCustomerData(response) {
    $('#total-customer').text(response.customer);
    $('#total-customer-use-points').text(response.customer_use_point);
    $('#alo-point-customer').text(response.total_alo_point);
    $('#alo-point-customer-use-point').text(response.total_alo_point);
    $('#point-customer').text(response.total_point);
    $('#accumulate-point-customer').text(response.total_accumulate_point);
    $('#promotion-point-customer').text(response.total_promotion_point);
    $('#point-customer-use-point').text(response.total_point_use);
    $('#accumulate-point-customer-use-point').text(response.total_accumulate_point_use);
    $('#promotion-point-customer-use-point').text(response.total_promotion_point_use);
}
