let dataTableBillManage = null,  branchIdBillManage, statusBillManage = $('#bill-select-status').val() ,
    fromBillManage = $('.from-date-bill-manage').val(), toBillManage = $('.to-date-bill-manage').val(),
    accumulatePointBillManage, originalPriceBillManage,
    amountBillManage, VATBillManage, discountBillManage, pointBillManage,
    totalSlotCustomerBillManage, averageProfitBillManage,
    totalAmountBillManage, restaurantBrandId,dataListExcelBillManage, filterStatusOrder = $('#filter-status-order').val();

$(async function () {
    dateTimePickerTemplate($('.from-date-bill-manage'));
    dateTimePickerTemplate($('.to-date-bill-manage'));
    if(getCookieShared('bill-manage-user-id' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('bill-manage-user-id' + idSession));
        fromBillManage = dataCookie.from;
        toBillManage = dataCookie.to;
        statusBillManage = dataCookie.status;
        $('.from-date-bill-manage').val(fromBillManage)
        $('.to-date-bill-manage').val(toBillManage)
    }
    $(document).on('click', '.to-date-bill-manage', function (){
        if(getCookieShared('bill-manage-user-id' + idSession) !== undefined){
            $(this).val(toBillManage)
            this.select()
        }
    })
    restaurantBrandId =  $('.select-brand').val();
    branchIdBillManage = $('.select-branch').val();
    $('.from-date-bill-manage').on('dp.change', function () {
        $('.from-date-bill-manage').val($(this).val());
    });
    $('.to-date-bill-manage').on('dp.change', function () {
        $('.to-date-bill-manage').val($(this).val());
    });
    $('#search-btn-bill-manage').on('click', function () {
        if(!checkDateTimePicker($(this))){
            return false
        }
        fromBillManage = $('.from-date-bill-manage').val();
        toBillManage = $('.to-date-bill-manage').val();
        validateDateTemplate($('.from-date-bill-manage'), $('.to-date-bill-manage'), loadData);
        updateCookieBillManage()
    });
    if(!branchIdBillManage) {
        await updateSessionBrandNew($('.select-brand'));
        branchIdBillManage = $('.select-branch').val();
    }

    $('#bill-select-status').on('select2:select', function () {
        statusBillManage = $(this).val();
        updateCookieBillManage()
        dataTableBillManage.ajax.url("bill-manage.data?from=" + fromBillManage + "&to=" + toBillManage + "&branch_id=" + branchIdBillManage + "&status=" + statusBillManage + "&restaurant_brand_id=" + restaurantBrandId).load();
        dataExcelBillManage();
    });
    $('#filter-status-order').on('change', function () {
        filterStatusOrder = $(this).val();
        loadDataBill();
    })
    loadDataBill();
    // dataExcelBillManage();
});

function updateCookieBillManage(){
    saveCookieShared('bill-manage-user-id' + idSession, JSON.stringify({
        from : fromBillManage,
        to : toBillManage,
        status: statusBillManage
    }))
}

function loadData() {
    if(!branchIdBillManage) return false;
    filterStatusOrder = $('#filter-status-order').val()
    restaurantBrandId =  $('.select-brand').val();
    branchIdBillManage = $('.select-branch').val();
    dataTableBillManage.ajax.url("bill-manage.data?from=" + fromBillManage + "&to=" + toBillManage + "&branch_id=" + branchIdBillManage + "&status=" + statusBillManage + "&restaurant_brand_id=" + restaurantBrandId + '&filter_status_order=' + filterStatusOrder).load();
    loadDataBill();
}
async function dataExcelBillManage(){
    let method = 'get',
        url = 'bill-manage.data-excel',
        params = {
            restaurant_brand_id : restaurantBrandId,
            branch_id: branchIdBillManage,
            status: statusBillManage,
            from : $('.from-date-bill-manage').val(),
            to : $('.to-date-bill-manage').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataListExcelBillManage = res.data.data.list
    amountBillManage = res.data.data.amount;
    VATBillManage = res.data.data.vat_amount;
    discountBillManage = res.data.data.discount_amount;
    pointBillManage = res.data.data.membership_total_point_used_amount;
    accumulatePointBillManage = res.data.data.membership_promotion_point_used;
    totalAmountBillManage = res.data.data.total_amount;
    originalPriceBillManage = res.data.data.original_price;
    totalSlotCustomerBillManage = res.data.data.total_customer_slot_number;
}

async function loadDataBill() {
    $('#bill-select-status').val(statusBillManage).trigger('change.select2')
    let element = $('#table-order'),
        url = "bill-manage.data?from=" + fromBillManage + "&to=" + toBillManage + "&branch_id=" + branchIdBillManage + "&status=" + statusBillManage + "&restaurant_brand_id=" + restaurantBrandId + '&filter_status_order=' + filterStatusOrder,
        column = [
            {data: 'index', name: 'index', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', class: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-left'},
            {data: 'employee.name', name: 'employee.name', className: 'text-left'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
            {data: 'membership_total_point_used_amount', name: 'membership_total_point_used_amount', className: 'text-right'},
            {data: 'using_slot', name: 'using_slot', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'membership_point_added', name: 'membership_point_added', className: 'text-right'},
            {data: 'original_price', name: 'original_price', className: 'text-right'},
            {data: 'rate_profit', name: 'rate_profit', className: 'text-right'},
            {data: 'payment_date', name: 'payment_date', className: 'text-center'},
            {data: 'order_status_name', name: 'order_status_name', className: 'text-center'},
            {data: 'is_service_restaurant_charge', name: 'is_service_restaurant_charge', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    dataTableBillManage = await loadDataBillManage(element, url, column);
    dataExcelBillManage();
}

async function loadDataBillManage(element, url, column){
    let fixedLeftTable = 2,
        fixedRightTable = 2
        optionRenderTable = [{
            'title': 'Xuất Excel',
            'icon': 'fi-rr-print mr-1',
            'class': '',
            'function': 'exportBillManage'
        }]
    return DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadData);
}

function callbackLoadData(response) {
    console.log(response)
    $('#amount').text(response.amount);
    $('#total-vat').text(response.vat_amount);
    $('#total-discount').text(response.discount_amount);
    $('#total-point').text(response.membership_total_point_used_amount);
    $('#total-amount').text(response.total_amount);
    $('#total-accumulate').text(response.membership_point_added);
    $('#total-original-price').text(response.total_original_price);
    $('#total-customer-bill-manager').text(response.total_customer_slot_number);
    $('#total-profit-bill-manager').text(response.average_rate_profit) + '%';
    averageProfitBillManage = response.average_rate_profit;
}
