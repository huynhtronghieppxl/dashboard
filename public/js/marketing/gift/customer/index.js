let tableNotUseCustomerGiftMarketing;

$(function () {
    addLoading("customer-gift-marketing.data");
    loadData();
    shortcut.add('F2', function () {
        openModalCreateCustomerGiftMarketing();
    });
});

async function loadData() {
    let method = 'get',
        url = 'customer-gift-marketing.data',
        brand = $('#restaurant-branch-id-selected span').attr('data-value'),
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableCustomerGiftMarketing(res);
    $('#total-record-not-use').text(res.data[3].total_record_not_use);
    $('#total-record-use').text(res.data[3].total_record_use);
    $('#total-record-expired').text(res.data[3].total_record_expired);
}

async function dataTableCustomerGiftMarketing(data) {
    let id1 = $('#table-not-use-customer-gift-marketing'),
        id2 = $('#table-use-customer-gift-marketing'),
        id3 = $('#table-expired-customer-gift-marketing'),
        fixed_left = 2,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'customer_name', className: 'text-center'},
            {data: 'customer_phone', className: 'text-center'},
            {data: 'name', className: 'text-center'},
            {data: 'open', className: 'text-center'},
            {data: 'description', className: 'text-center'},
            {data: 'type', className: 'text-center'},
            {data: 'value', className: 'text-center'},
            {data: 'quantity', className: 'text-center'},
            {data: 'created_at', className: 'text-center'},
            {data: 'expire_at', className: 'text-center'},
        ];
    tableNotUseCustomerGiftMarketing = await DatatableTemplate(id1, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right);
    DatatableTemplateNew(id2, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right);
    DatatableTemplateNew(id3, data.data[2].original.data, columns, vh_of_table, fixed_left, fixed_right);
}
