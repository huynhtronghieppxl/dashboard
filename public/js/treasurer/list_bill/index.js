let tableWaitingSupplier = null,
    fromListBill = $('#from-date-list-bill-treasurer').val(),
    toListBill = $('#to-date-list-bill-treasurer').val(),
    restaurantBrandId, branchIdListBill, statusListBill, filterStatusOrder = $('#filter-status-order').val(), loadBrandNoOfficeListBillTreasurer = 0;
$(async function () {
    dateTimePickerFromToDate($('#from-date-list-bill-treasurer'), $('#to-date-list-bill-treasurer'))
    if(getCookieShared('list-bill-treasurer-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('list-bill-treasurer-user-id-' + idSession));
        fromListBill = dataCookie.fromListBill;
        toListBill = dataCookie.toListBill
        $('#from-date-list-bill-treasurer').val(fromListBill)
        $('#to-date-list-bill-treasurer').val(toListBill)
    }
    $('#search-btn-list-bill-treasurer').on('click', function () {
        fromListBill = $('#from-date-list-bill-treasurer').val();
        toListBill = $('#to-date-list-bill-treasurer').val();
        updateCookieListBill();
        validateDateTemplate($('#from-date-list-bill-treasurer'), $('#to-date-list-bill-treasurer'), loadDataBill());
    });
    $('#tab2-detail-bill-manage .js-example-basic-single').select2({
        dropdownParent: $('#tab2-detail-bill-manage')
    });

    // Lọc trạng thái tính phí dịch vụ
    $('#filter-status-order').on('change', function () {
        filterStatusOrder = $('#filter-status-order').val()
        loadDataBill()
    })
    fromListBill = $('#from-date-list-bill-treasurer').val();
    toListBill = $('#to-date-list-bill-treasurer').val();
    status = $('#list-bill-select-status').val();
    branchIdListBill = $('.select-branch').val();
    restaurantBrandId =  $('.select-brand').val();
    if(loadBrandNoOfficeListBillTreasurer === 0) {
        await updateSessionBrandNew($('.select-brand'));
        loadBrandNoOfficeListBillTreasurer = 1;
    }
    $(document).on('click', '#search-btn-bill-liabilities', function () {
        fromListBill = $('#from-date-list-bill-treasurer').val();
        toListBill = $('#to-date-list-bill-treasurer').val();
        if (moment(fromListBill, 'DD/MM/YYYY').clone().format('x') > moment(to, 'DD/MM/YYYY').clone().format('x')) {
            WarningNotify('Ngày bắt đầu không được lớn hơn ngày kết thúc !');
            return false;
        } else {
            tableWaitingSupplier.ajax.url("list-bill-treasurer.data?from=" + fromListBill + "&to=" + toListBill + "&branch_id=" + branchIdListBill + "&restaurant_brand_id=" + restaurantBrandId + "&filter_status_order=" + filterStatusOrder).load();
        }
    });
    $('#list-bill-select-status').on('select2:select', function () {
        statusListBill = $(this).val();
        data_table.ajax.url("list-bill-treasurer.data?from=" + fromListBill + "&to=" + toListBill + "&branch_id=" + branch_id + "&status=" + statusListBill + "&restaurant_brand_id=" + restaurantBrandId + "&filter_status_order=" + filterStatusOrder).load();
    });
    await loadDataBill();
});

function updateCookieListBill() {
    saveCookieShared('list-bill-treasurer-user-id-' + idSession, JSON.stringify({
        'fromListBill' : fromListBill,
        'toListBill' : toListBill,
    }))
}

function loadData() {
    restaurantBrandId =  $('.select-brand').val();
    branchIdListBill = $('.select-branch').val();
    if (!loadBrandNoOfficeListBillTreasurer) return false;
    tableWaitingSupplier.ajax.url("list-bill-treasurer.data?from=" + fromListBill + "&to=" + toListBill + "&branch_id=" + branchIdListBill + "&restaurant_brand_id=" + restaurantBrandId + "&filter_status_order=" + filterStatusOrder).load();
}

async function loadDataBill() {
    let element = $('#table-order'),
        url = "list-bill-treasurer.data?from=" + fromListBill + "&to=" + toListBill + "&branch_id=" + branchIdListBill + "&restaurant_brand_id=" + restaurantBrandId + "&filter_status_order=" + filterStatusOrder,
        fixedLeftTable = 0,
        fixedRightTable = 0,
        column = [
                    {data: 'index', name: 'index', class: 'text-center', width: '5%'},
                    {data: 'id', name: 'id', class: 'text-left'},
                    {data: 'table_name', name: 'table_name', className: 'text-left'},
                    {data: 'employee_full_name', name: 'employee_full_name', className: 'text-left'},
                    {data: 'customer_name', name: 'customer_name', className: 'text-left'},
                    {data: 'amount', name: 'amount', className: 'text-right'},
                    {data: 'vat_amount', name: 'vat_amount', className: 'text-right'},
                    {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
                    {data: 'membership_total_point_used_amount', name: 'membership_total_point_used_amount',
                        className: $('.point-table-list-bill').hasClass('d-none') ? 'd-none' : 'text-right'},
                    {data: 'using_slot', name: 'using_slot', className: 'text-center'},
                    {data: 'total_amount', name: 'total_amount', className: 'text-right'},
                    {data: 'payment_date', name: 'payment_date'},
                    // {data: 'updated_at', name: 'updated_at', className: 'text-center'},
                    {data: 'order_status_name', name: 'order_status_name', className: 'text-center'},
                    {data: 'is_service_restaurant_charge', name: 'is_service_restaurant_charge', className: 'text-center', width: '5%'},
                    {data: 'action', name: 'action', className: 'text-center', width: '5%'},
                    {data: 'keysearch', className: 'd-none'},
        ];
        optionRenderTable = [];
    tableWaitingSupplier = await DatatableServerSideTemplateNew(element, url, column, vh_of_table, fixedLeftTable, fixedRightTable, optionRenderTable, callbackLoadBillData);
}

function exportExcel() {
    let id = $('#table-order');
    let name = $('#title').text();
    exportExcelTemplate(id, tableWaitingSupplier, name);
}

function callbackLoadBillData(response){
    console.log(response)
    $('#amount').text(response.amount);
    $('#total-vat').text(response.vat_amount);
    $('#total-discount').text(response.discount_amount);
    $('#total-point').text(response.membership_accumulate_point_used);
    $('#total-amount').text(response.total_amount);
    $('#total-slot-customer').text(response.total_slot_customer);
}
