let checkSaveUpdateSettingMembershipCard = 0;

$(function (){
    $(document).on('input focusout', '#percent-amount-update-setting-restaurant-membership-card', function () {
        if($('#percent-amount-update-setting-restaurant-membership-card').val() === '' ){
            $('#percent-amount-update-setting-restaurant-membership-card').val('0');
            ErrorNotify('Không được để trống');
            $(this).select();
        }
        if($('#percent-amount-update-setting-restaurant-membership-card').val() > 100 ){
            $('#percent-amount-update-setting-restaurant-membership-card').val('100');
            ErrorNotify('Tối đa 100%');
            $(this).select();
        }
    });

    $(document).on('input', '#percent-amount-update-setting-restaurant-membership-card', function () {
        if($('#percent-amount-update-setting-restaurant-membership-card').val() === '' ){
            $('#percent-amount-update-setting-restaurant-membership-card').val('0');
        }
        if($('#percent-amount-update-setting-restaurant-membership-card').val() > 100 ){
            $('#percent-amount-update-setting-restaurant-membership-card').val('100');
            ErrorNotify('Tối đa 100%');
        }
    });
    $(document).on('input', '#percent-amount-update-alo-point-in-each-bill', function () {
        if($('#percent-amount-update-setting-restaurant-membership-card').val() < 0 ){
            $('#percent-amount-update-setting-restaurant-membership-card').val('0');
        }
        if($('#percent-amount-update-alo-point-in-each-bill').val() > 100){
            $('#percent-amount-update-alo-point-in-each-bill').val('100');
            ErrorNotify('Tối đa 100%');
        }
    });
    $('#percent-amount-update-setting-restaurant-membership-card').click(function () {
        $(this).val('');
    });
})

async function openModalEditSettingMemberShipCard(){
    addLoading('restaurant-membership-card.data-setting', '#loading-modal-update-setting-restaurant-membership-card');
    $('#modal-update-setting-restaurant-membership-card').modal('show');
    dataUpdateSettingMembershipCard();
};


async function dataUpdateSettingMembershipCard() {
    let method = 'get',
        url = 'restaurant-detail-membership-card.data-setting',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-membership-card')]);
    // CKEDITOR.instances['update-condition-setting-restaurant-membership-card'].setData(res.data[0].data.membership_card_benefit_policy);
    // CKEDITOR.instances['update-point-setting-restaurant-membership-card'].setData(res.data[0].data.membership_card_point_policy);
    // CKEDITOR.instances['update-benefit-setting-restaurant-membership-card'].setData(res.data[0].data.membership_card_benefit_policy);
    // CKEDITOR.instances['update-level-setting-restaurant-membership-card'].setData(res.data[0].data.membership_card_level_policy);

    CKEDITOR.instances['update-use-guide-setting-restaurant-membership-card'].setData(res.data[0].data.membership_card_use_guide);
    CKEDITOR.instances['update-term-setting-restaurant-membership-card'].setData(res.data[0].data.membership_card_policy);
    $('#percent-amount-update-setting-restaurant-membership-card').val(res.data[1].data.maximum_percent_order_amount_to_promotion_point_allow_use_in_each_bill);
    $('#percent-amount-update-alo-point-in-each-bill').val(res.data[1].data.maximum_money_by_alo_point_allow_use_in_each_bill);
    $('#update-alo-point-allow-use-in-each-bill').val(res.data[1].data.maximum_percent_order_amount_to_alo_point_allow_use_in_each_bill);
}

function CloseModalSettingMembershipCard(){
    $('#modal-update-setting-restaurant-membership-card').modal('hide');
}

async function saveModalUpdateSettingMembershipCard() {
    if(checkSaveUpdateSettingMembershipCard === 1) return false;
    // addLoading('restaurant-membership-card.update-setting', '#loading-modal-update-setting-restaurant-membership-card');
    let
        // condition = CKEDITOR.instances['update-condition-setting-restaurant-membership-card'].getData(),
        // point = CKEDITOR.instances['update-point-setting-restaurant-membership-card'].getData(),
        // benefit = CKEDITOR.instances['update-benefit-setting-restaurant-membership-card'].getData(),
        // level = CKEDITOR.instances['update-level-setting-restaurant-membership-card'].getData(),
        use_guide = CKEDITOR.instances['update-use-guide-setting-restaurant-membership-card'].getData(),
        policy = CKEDITOR.instances['update-term-setting-restaurant-membership-card'].getData(),
        amount = $('#update-percent-amount-setting-restaurant-membership-card').val(),
        amount_alo_point = $('#update-percent-amount-alo-point-in-each-bill').val(),
        alo_point = removeformatNumber($('#update-alo-point-allow-use-in-each-bill').val());

    checkSaveUpdateSettingMembershipCard = 1;
    let method = 'post',
        url = 'update-restaurant-membership-card.update-setting',
        params = {
            use_guide : use_guide,
            policy : policy,
            // amount: amount,
            // amount_alo_point:amount_alo_point,
            // alo_point:alo_point
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-membership-card')]);
    console.log(res, "abc")
    checkSaveUpdateSettingMembershipCard = 0;
    switch (res.data[0].status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            CloseModalSettingMembershipCard();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify($('#error-post-data-to-server').text());
    }
}

