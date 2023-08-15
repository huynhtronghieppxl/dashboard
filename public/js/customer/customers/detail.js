let color = '',
    tableOrderCustomersDetail = '', phone, from, to;

function openDetailCustomers(r) {
    $('#modal-detail-customers').modal('show');
    phone = r.data('phone')
    from = r.data('from')
    to = r.data('to')
    loadDataDetailCustomer(r.data('id'));
    shortcut.add('ESC', function () {
        closeModalDetailCustomers();
    })
}

async function loadDataDetailCustomer(id) {
    let method = 'get',
        url = 'customers.detail',
        params = {
            id: id,
            branch_id: $('.select-branch').val(),
            phone: phone !== '' ? phone : '',
            from: from !== '' ? from : '',
            to: to !== '' ? to : ''
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#load-user-card-full"),
        $("#table-order-customers-detail"),
        $("#table-history-point-order-food-customers-detail"),
        $("#table-history-point-customers-detail"),
        $("#table-history-recharge-card-customers-detail"),
    ]);
    dataDetailCustomer(res.data[0]);
    dataTableDetailCustomer(res);
    dataTotalDetailCustomer(res.data[7]);
    dataTotalPriceDetailCustomer(res.data[6]);
}

async function dataDetailCustomer(data) {
    $('#status-detail-customers').html(data.status);
    $('#avatar-detail-customers').attr('src', data.avatar);
    $('#name-detail-customers').text(data.name);
    $('#birthday-detail-customers').text(data.birthday);
    $('#gender-detail-customers').text(data.gender);
    $('#phone-detail-customers').text(data.phone);
    $('#email-detail-customers').text(data.email);
    $('#point-detail-customers').text(data.point);
    $('#alo-point-detail-customers').text(data.alo_point);
    $('#accumulate-point-detail-customers').text(data.accumulate_point);
    $('#promotion-point-detail-customers').text(data.promotion_point);
    $('#address-detail-customers').text(data.address_full_text);
    $('#company-name-detail-customers').text(data.company_name);
    $('#company-tax-detail-customers').text(data.company_tax_number);
    $('#company-phone-detail-customers').text(data.company_phone);
    $('#company-address-detail-customers').text(data.company_address);
    $('#name-card-detail-customers').text(data.restaurant_membership_card.name);
    $('#used-amount-detail-customers').text(data.used_amount);
    $('#card-color-detail-membership-card').css('background-color', data.restaurant_membership_card.color_hex_code);
    $('#card-name-detail-membership-card').text(data.restaurant_membership_card.name);
    $('#card-created-at-detail-membership-card').text(data.restaurant_membership_card.created_at);
    $('#card-point-detail-membership-card').text(data.point);
}

async function dataTableDetailCustomer(data) {
    let idOrder = $('#table-order-customers-detail'),
        idHistoryPoint = $('#table-history-point-customers-detail'),
        idHistoryPointOrder = $('#table-history-point-order-food-customers-detail'),
        idHistoryRecharge = $('#table-history-recharge-card-customers-detail'),
        columnOrder = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'id', name: 'id', class: 'text-left'},
            {data: 'table_name', name: 'table_name', className: 'text-center'},
            {data: 'employee_name', name: 'employee_name', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'vat', name: 'vat', className: 'text-center'},
            {data: 'discount_amount', name: 'discount_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'payment_day', name: 'payment_day', className: 'text-center'},
            {data: 'order_status_name', name: 'order_status_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        columnHistoryPoint = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'note', name: 'note', class: 'text-left'},
            {data: 'point', name: 'point', className: 'text-right'},
            {data: 'accumulate_point', name: 'accumulate_point', className: 'text-right'},
            {data: 'promotion_point', name: 'promotion_point', className: 'text-right'},
            {data: 'total_all_point', name: 'total_all_point', className: 'text-right'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'}
        ],
        columnHistoryPointOrder = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'note', name: 'note', class: 'text-left'},
            {data: 'order_id', name: 'order_id', className: 'text-left'},
            {data: 'accumulate_point', name: 'accumulate_point', className: 'text-right'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        columnHistoryRecharge = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_top_up_card_name', name: 'restaurant_top_up_card_name', class: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'bonus_amount', name: 'bonus_amount', className: 'text-right'},
            {data: 'employee_create_name', name: 'employee_create_name', className: 'text-left'},
            {data: 'top_up_at', name: 'top_up_at', className: 'text-center'},
            {data: 'branch_name', name: 'branch_name', className: 'text-left'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option =[],
        scroll_Y = "60vh",
        fixedLeft = 1,
        fixedRight = '';
    tableOrderCustomersDetail = await DatatableTemplateNew(idOrder, data.data[1].original.data, columnOrder, scroll_Y, fixedLeft, fixedRight,option);
    $(document).on('input paste', '#table-order-customers-detail_filter', async function () {
        let totalPrice = 0;
        await tableOrderCustomersDetail.rows({'search': 'applied'}).every(function () {
            let row = $(this.node());
            totalPrice += removeformatNumber(row.find('td:eq(7)').text());
        })
        $('#total-amount-detail-customers').text(formatNumber(totalPrice));
    })
    DatatableTemplateNew(idHistoryPoint, data.data[3].original.data, columnHistoryPoint, scroll_Y, fixedLeft, fixedRight,option);
    DatatableTemplateNew(idHistoryPointOrder, data.data[4].original.data, columnHistoryPointOrder, scroll_Y, fixedLeft, fixedRight,option);
    DatatableTemplateNew(idHistoryRecharge, data.data[2].original.data, columnHistoryRecharge, scroll_Y, fixedLeft, fixedRight,option);
    $('#table-history-point-order-food-customers-detail tbody tr td:nth-child(2)').attr('style','white-space:normal')
    $('#total-record-tab4-detail-customers').text( data.data[2].original.recordsTotal)
}

function dataTotalPriceDetailCustomer(data) {
    $('#total-amount-detail-customers').text(data.total_price);
}

function dataTotalDetailCustomer(data) {
    $('#total-record-tab1-detail-customers').text(data.total_record_bill);
    $('#total-record-tab2-detail-customers').text(data.total_record_ads);
    $('#total-record-tab3-detail-customers').text(data.total_record_foods);
    $('#total-record-tab4-detail-customers').text(0); // API chưa có dữ liệu
}

function closeModalDetailCustomers() {
    shortcut.remove('ESC');
    $('#modal-detail-customers').modal('hide');
    resetModalDetailCustomers();
}

function resetModalDetailCustomers() {
    $('#first-tab-loading-modal').click();
    $('#name-detail-customers').text('---');
    $('#birthday-detail-customers').text('---');
    $('#gender-detail-customers').text('---');
    $('#phone-detail-customers').text('---');
    $('#email-detail-customers').text('---');
    $('#address-detail-customers').text('---');
    $('#name-card-detail-customers').text('---');
    $('#used-amount-detail-customers').text(0);
    $('#point-detail-customers').text(0);
    $('#alo-point-detail-customers').text(0);
    $('#accumulate-point-detail-customers').text(0);
    $('#promotion-point-detail-customers').text(0);
    $('#company-name-detail-customers').text('---');
    $('#company-tax-detail-customers').text('---');
    $('#company-phone-detail-customers').text('---');
    $('#company-address-detail-customers').text('---');
    $('#avatar-detail-customers').attr('src', '');
    $('#card-color-detail-membership-card').css('background-color', '#b9f2ff');
    $('#card-name-detail-membership-card').text('---');
    $('#card-created-at-detail-membership-card').text('---');
    $('#card-point-detail-membership-card').text(0);
}
