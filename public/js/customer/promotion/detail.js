function openModalDetailPromotion(id) {
    $('#modal-detail-customer-promotion-data').modal('show');
    addLoading('promotion.detail', '#loading-modal-detail-customer-promotion');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalDetailCustomerPromotion();
    });
    dataDetailPromotion(id);
}

async function dataDetailPromotion(id) {
    let method = 'get',
        url = 'promotion.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#name-detail-promotion').text(res.data[0].name);
    $('#description-detail-promotion').text(res.data[0].description);
    $('#short-description-detail-promotion').text(res.data[0].short_description);
    $('#employee-create-detail-promotion').text(res.data[0].employee_create.full_name);
    $('#min-order-total-detail-promotion').text(formatNumber(res.data[0].min_order_total_amount_required));
    $('#max-promotion-detail-promotion').text(formatNumber(res.data[0].max_promotion_amount));
    $('#discount-detail-promotion').text(res.data[0].discount_amount);
    $('#day-of-week-detail-promotion').text(res.data[0].day_of_weeks_text);
    $('#from-hour-detail-promotion').text(res.data[0].from_hour);
    $('#to-hour-detail-promotion').text(res.data[0].to_hour);
    $('#from-date-detail-promotion').text(res.data[0].from_date);
    $('#to-date-detail-promotion').text(res.data[0].to_date);
    $('#type-detail-promotion').text(res.data[0].type);
    $('#list-img-detail-customer-promotion').html(res.data[1]);
}

// async function dataTableDetailVoucher(data) {
//     let id = $('#table-voucher-detail'),
//         column = [
//             {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//             {data: 'code', name: 'code', className: 'text-center'},
//             {data: 'branchs', name: 'branchs', className: 'text-center'},
//             {data: 'max_use_count', name: 'max_use_count', className: 'text-center'},
//             {data: 'reusable_count', name: 'reusable_count', className: 'text-center'},
//             {data: 'used_count', name: 'used_count', className: 'text-center'},
//             {data: 'created_at', name: 'created_at', className: 'text-center'},
//             {data: 'status', name: 'status', className: 'text-center'},
//         ],
//         scroll_Y = "40vh",
//         fixed_left = 2,
//         fixed_right = 1;
//     DatatableTemplate(id, data, column, scroll_Y, fixed_left, fixed_right)
// }

function closeModalDetailCustomerPromotion() {
    $('#modal-detail-customer-promotion-data').modal('hide');
}
