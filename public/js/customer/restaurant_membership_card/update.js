let idUpdateMemberShipCard, checkSaveUpdateMembershipCard = 0,
    thisUpdateMemberShipCard,nameUpdateMemberShipCard,ColorUpdateMemberShipCard,percentUpdateMemberShipCard,TotalToLevelUpUpdateMemberShipCard,monthPromotionPointUpdateMemberShipCard;

function openModalUpdateMemberShipCard(r) {
    $('#modal-update-membership-card').modal('show');
    shortcut.remove('F2');
    shortcut.add('F4',function() {
        saveModalUpdateMemberShipCard();
    })
    shortcut.add('ESC',function() {
        closeModalUpdateMemberShipCard();
    })
    $('#name-update-membership-card').unbind('input').on('input', function () {
        $('.card-name-update-membership-card').text($(this).val());
    });
    $('#color-update-membership-card').unbind('change').on('change', function () {
        $('#card-color-update-membership-card').attr('style', 'background-color:' + $(this).val());
    });
    $('#type-month-update-membership-card').unbind('change').on('change', function () {
        if ($('#type-month-update-membership-card input[name="duration"]:checked').val() === '1') {
            $('#div-month-update-membership-card').removeClass('d-none');
        } else {
            $('#div-month-update-membership-card').addClass('d-none');
        }
    });
    dataUpdateMemberShipCard(r);
}


async function dataUpdateMemberShipCard(r) {
    thisUpdateMemberShipCard = r;
    idUpdateMemberShipCard = r.data('id');
    let method = 'get',
        url = 'restaurant-membership-card.detail',
        params = {
            id: idUpdateMemberShipCard,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-membership-card')]);
    nameUpdateMemberShipCard = res.data[0].name;
    ColorUpdateMemberShipCard = res.data[0].color_hex_code;
    percentUpdateMemberShipCard = res.data[0].cashback_to_point_percent;
    TotalToLevelUpUpdateMemberShipCard = res.data[0].total_amount_to_level_up;
    monthPromotionPointUpdateMemberShipCard = res.data[0].month_to_expire_promotion_point;
    $('#card-color-update-membership-card').attr('style', 'background-color:' + ColorUpdateMemberShipCard);
    $('#card-name-update-membership-card').text(nameUpdateMemberShipCard);
    $('#card-create-update-membership-card').text(res.data[0].created_at);
    $('#card-point-update-membership-card').text(formatNumber(TotalToLevelUpUpdateMemberShipCard));
    $('#name-update-membership-card').val(nameUpdateMemberShipCard);
    $('#color-update-membership-card').val(ColorUpdateMemberShipCard);
    $('#color-update-membership-card').parent().find('span').find('span').attr('style', 'background-color:' + ColorUpdateMemberShipCard);
    $('#point-update-membership-card').val(formatNumber(TotalToLevelUpUpdateMemberShipCard));
    $('#percent-update-membership-card').val(percentUpdateMemberShipCard);
    if (monthPromotionPointUpdateMemberShipCard > 0) {
        $('#month-update-membership-card').val(monthPromotionPointUpdateMemberShipCard);
        $('#type-month-update-membership-card input[name="duration"]').each(function (i, v) {
            if ($(this).val() === '1') {
                $(this).prop('checked', true);
                $('#div-month-update-membership-card').removeClass('d-none');
            }
        });
    } else {
        $('#type-month-update-membership-card input[name="duration"]').each(function (i, v) {
            if ($(this).val() === '0') {
                $(this).prop('checked', true);
                $('#div-month-update-membership-card').addClass('d-none');
            }
        });
    }
}

async function saveModalUpdateMemberShipCard() {
    if(checkSaveUpdateMembershipCard === 1) return false;
    if(!checkValidateSave($('#modal-update-membership-card'))) return false;
    let name = $('#name-update-membership-card').val(),
        percent = $('#percent-update-membership-card').val(),
        month_to_expire_promotion_point = $('#month-update-membership-card').val(),
        color_hex_code = $('#color-update-membership-card').val(),
        total_to_level_up = removeformatNumber($('#point-update-membership-card').val());
    if ($('#type-month-update-membership-card input[name="duration"]:checked').val() === '0') month_to_expire_promotion_point = '0';
    checkSaveUpdateMembershipCard = 1;

    if(nameUpdateMemberShipCard == name
       && ColorUpdateMemberShipCard == color_hex_code
       && percentUpdateMemberShipCard == percent
       && TotalToLevelUpUpdateMemberShipCard == total_to_level_up) {
        closeModalUpdateMemberShipCard();
        SuccessNotify($('#success-update-data-to-server').text());
        checkSaveUpdateMembershipCard = 0;
        return false;
    }
    let method = 'post',
        url = 'restaurant-membership-card.update',
        params = null,
        data = {
            id: idUpdateMemberShipCard,
            name: name,
            color_hex_code: color_hex_code,
            total_amount_to_level_up: total_to_level_up,
            month_to_expire_promotion_point: 0,
            cashback_to_point_percent: percent,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#load-modal-content-update")]);
    console.log("res1",res);

    checkSaveUpdateMembershipCard = 0;
    switch (res.data.status) {
        case 200:
            closeModalUpdateMemberShipCard();
            SuccessNotify($('#success-update-data-to-server').text());
            thisUpdateMemberShipCard.parents('tr').find('td:eq(1)').html(res.data.data.name);
            thisUpdateMemberShipCard.parents('tr').find('td:eq(2)').html(`<div class="waves-effect waveclassNameht w-75 h-1rem m-auto" style="background-color: ${res.data.data.color_hex_code}"></div>`);
            thisUpdateMemberShipCard.parents('tr').find('td:eq(3)').html(formatNumber(res.data.data.total_amount_to_level_up));
            thisUpdateMemberShipCard.parents('tr').find('td:eq(4)').html(formatNumber(res.data.data.cashback_to_point_percent) + "%");
            thisUpdateMemberShipCard.parents('tr').find('td:eq(5)').html(`<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;"> <i class="fi-rr-time-quarter-to" style="font-size: 14px; vertical-align: middle;"></i><label class="m-0" style="margin-left: -12px !important;">Vĩnh viễn</label></div>`);
            thisUpdateMemberShipCard.parents('tr').find('td:eq(6)').html(`<div class="btn-group btn-group-sm text-center"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="${res.data.data.id}" data-name="${res.data.data.name}" data-color="${res.data.data.color_hex_code}" data-point="${formatNumber(res.data.data.total_amount_to_level_up)}" data-discount="${res.data.data.cashback_to_point_percent}" data-month="${formatNumber(res.data.data.month_to_expire_promotion_point)}" data-create="${res.data.data.created_at}" onclick="openModalUpdateMemberShipCard($(this))"><i class="fi-rr-pencil" style="display: contents"></i></button></div>`);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify($('#error-post-data-to-server').text());
    }
}

function closeModalUpdateMemberShipCard() {
    $('#modal-update-membership-card').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2',function() {
        openModalCreateMemberShipCard();
    });
    resetModalUpdateMemberShipCard()
}

function resetModalUpdateMemberShipCard() {
    $('#name-update-membership-card').val('')
    $('#point-update-membership-card').val(100)
    $('#percent-update-membership-card').val(0)
    $('#month-update-membership-card').val(1)
    $('#type-month-update-membership-card input[name="duration"][value="0"]').prop('checked', true);
    $('#div-month-update-membership-card').addClass('d-none');
}
