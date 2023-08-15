async function loadDataVoucherPromotion() {
    let method = 'get',
        url = 'voucher-promotion.data',
        params = {
            restaurant_brand_id: $('#restaurant-branch-id-selected span').attr('data-value'),
            branch_id: $('#change_branch').val(),
            from_date: $('#from-date-voucher-promotion').val(),
            to_date: $('#to-date-voucher-promotion').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#table-applying-voucher-promotion"),
        $("#table-pending-voucher-promotion"),
        $("#table-pausing-voucher-promotion"),
        $("#table-expired-voucher-promotion"),
    ]);
    dataTotalVoucherPromotion(res.data[4]);
    dataTableVoucherPromotion(res);
}

async function dataTableVoucherPromotion(data) {
    let id1 = $('#table-applying-voucher-promotion'),
        id2 = $('#table-pending-voucher-promotion'),
        id3 = $('#table-pausing-voucher-promotion'),
        id4 = $('#table-expired-voucher-promotion'),
        fixed_left = 1,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'hour', name: 'hour', className: 'text-center'},
            {data: 'time', name: 'time', className: 'text-center'},
            {data: 'date', name: 'date', className: 'text-center'},
            {data: 'count', name: 'count', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
        ];
    await DatatableTemplateNew(id1, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right);
    await DatatableTemplateNew(id2, data.data[1].original.data, column, vh_of_table, fixed_left, fixed_right);
    await DatatableTemplateNew(id3, data.data[2].original.data, column, vh_of_table, fixed_left, fixed_right);
    await DatatableTemplateNew(id4, data.data[3].original.data, column, vh_of_table, fixed_left, fixed_right);
}

function dataTotalVoucherPromotion(data) {
    $('#total-record-pending-voucher-promotion').text(data.total_record_pending);
    $('#total-record-applying-voucher-promotion').text(data.total_record_applying);
    $('#total-record-pausing-voucher-promotion').text(data.total_record_pausing);
    $('#total-record-expired-voucher-promotion').text(data.total_record_expired);
}

function btnBackPomotion(){
    $('#layout-voucher-promotion').addClass('d-none');
    $('#button-service-1').addClass('d-none');
    $('#button-service-2').addClass('d-none');
    $('#list-promotion-landing').removeClass('d-none');
    $('#layout-happy-time-promotion').addClass('d-none')
    $('#form-btn-back-branch').addClass('d-none');
}
