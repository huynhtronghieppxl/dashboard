function openModalDetailHappyTimePromotion(id) {
    $('#modal-detail-happy-time-promotion-data').modal('show');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalDetailHappyTimePromotion();
    });
    dataDetailHappyTimePromotion(id);
}

async function dataDetailHappyTimePromotion(id) {
    let method = 'get',
        url = 'happy-time-promotion.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$("#loading-modal-detail-customer-happy-time-promotion")]);
    $('#name-detail-happy-time-promotion').text(res.data[0].name);
    $('#description-detail-happy-time-promotion').text(res.data[0].description);
    $('#short-description-detail-happy-time-promotion').text(res.data[0].short_description);
    $('#employee-create-detail-happy-time-promotion').text(res.data[0].employee_create.full_name);
    $('#min-order-total-detail-happy-time-promotion').text(formatNumber(res.data[0].min_order_total_amount_required));
    $('#max-promotion-detail-happy-time-promotion').text(formatNumber(res.data[0].max_promotion_amount));
    $('#discount-detail-happy-time-promotion').text(res.data[0].discount_amount);
    $('#day-of-week-detail-happy-time-promotion').text(res.data[0].day_of_weeks_text);
    $('#from-hour-detail-happy-time-promotion').text(res.data[0].from_hour);
    $('#to-hour-detail-happy-time-promotion').text(res.data[0].to_hour);
    $('#from-date-detail-happy-time-promotion').text(res.data[0].from_date);
    $('#to-date-detail-happy-time-promotion').text(res.data[0].to_date);
    $('#type-detail-happy-time-promotion').text(res.data[0].type);
    $('#list-img-detail-customer-promotion').html(res.data[1]);
}

function closeModalDetailHappyTimePromotion() {
    $('#modal-detail-happy-time-promotion-data').modal('hide');
}
