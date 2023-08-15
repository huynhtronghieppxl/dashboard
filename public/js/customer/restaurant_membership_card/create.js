let checkSaveCreateMemberShipCard = 0;

$(function (){
    $('#load-modal-content input').on('input',function (){
        $('.btn-renew').removeClass('d-none')
    })
    $('.btn-renew').on('click', function (){
        $(this).addClass('d-none');
    })
})

function openModalCreateMemberShipCard() {
    $('#modal-create-membership-card').modal('show');
    shortcut.remove("F2");
    shortcut.add('ESC', function () {
        closeModalCreateMemberShipCard()
    });

    $('#branch-modal-create-membership-card').select2({
        dropdownParent: $('#modal-create-membership-card'),
    });
    $('#show-card-name-membership-card').unbind('input').on('input', function () {
        $('.show-card-name-membership-card').text($(this).val());
    });
    $('#card-color-membership-card').unbind('change').on('change', function () {
        $('#show-card-color-membership-card').attr('style', 'background-color:' + $(this).val());
    });
    $('#type-month-membership-card').unbind('change').on('change', function () {
        if ($('#type-month-membership-card input[name="duration"]:checked').val() === '1') {
            $('#div-show-card-month-membership-card').removeClass('d-none');
        } else {
            $('#div-show-card-month-membership-card').addClass('d-none');
        }
    });
    dataMemberShipCard();
}

async function  dataMemberShipCard() {
    let method = 'get',
        url = 'restaurant-membership-card.data-template',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-membership-card')]);
    $('#content-template-membership-card').html('');
    $.each(res.data[0], function (index, value) {
        $('#content-template-membership-card').append('<div class="col-md-6">\n' +
            '<div id="checkbox-membership-card-' + value.id + '" class="custom-card-value-focus-2 checkbox-membership-card card-block z-depth-bottom waves-effect rounded text-light py-3 m-2 w-100"  style="background-color: ' + value.color_hex_code + '; padding-right: 2.5rem !important; padding-left: 1.5rem !important;" onclick="selectTemplateMemberShipCard(' + value.id + ', $(this))"\n' +
            '                             id="card-color-update-membership-card" style="border-radius: 15px !important;">\n' +
            '                            <div class="row align-items-center">\n' +
            '                                <div class="col-lg-7 pl-0">\n' +
            '                                    <div class="row align-items-center">\n' +
            '                                        <img\n' +
            '                                            src="https://is5-ssl.mzstatic.com/image/thumb/Purple112/v4/80/13/3a/80133a1a-acd7-3ee4-9290-d29edf61e1c9/AppIcon-1x_U007emarketing-0-7-0-sRGB-85-220.png/246x0w.webp"\n' +
            '                                            width="40px" style="border-radius: 13px" alt="">\n' +
            '                                        <div class="ml-2">\n' +
            '                                            AloLine\n' +
            '                                            <p>aloline.vn</p>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                                <div class="col-sm-5 pr-0 text-right">\n' +
            '                                    <h4 class="text-uppercase mb-0" style="width: 120px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden" id="name-template-membership-card-' + value.id + '">' + value.name + '</h4>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="row d-flex align-items-center mt-3">\n' +
            '                                <div class="col-lg-6 pl-0 text-left">\n' +
            '                                    <p class="card-point text-uppercase mr-0">Điểm \n' +
            '                                    </p>\n' +
            '                                    <h4 class="mb-0" id="point-template-membership-card-' + value.id + '">' + formatNumber(value.total_amount_to_level_up) + '</h4>\n' +
            '                                </div>\n' +
            '                                <div class="col-sm-6 text-right pr-0">\n' +
            '                                    <p class="mb-0">Ngày tạo\n' +
            '                                    </p>\n' +
            '                                    <span id="date-template-membership-card-' + value.id + '">' + value.created_at + '</span>\n' +
            '                                </div>\n' +
            '<span class="d-none" id="percent-template-membership-card-' + value.id + '">' + value.percent + '</span>\n' +
            '<span class="d-none" id="month-template-membership-card-' + value.id + '">' + value.month_to_expire_promotion_point + '</span>\n' +
            '<span class="d-none" id="color-template-membership-card-' + value.id + '">' + value.color_hex_code + '</span>\n' +
            '                            </div>\n' +
            '</div>');
    });
    if($('#content-template-membership-card').text() === ''){
        $('#content-template-membership-card').append(`<div class="empty-datatable-custom" style="width: 100%;text-align: center;"><img src="../../../../files/assets/images/nodata-datatable2.png"></div>`);
        $('#next-modal-create-membership-card').addClass('d-none');
    }
}

function selectTemplateMemberShipCard(id,r) {
    $('.btn-renew').removeClass('d-none');
    $('#id-template-selected-membership-card').text(id);
    $('.checkbox-membership-card').removeClass('custom-card-membership');
    r.addClass('custom-card-membership');
    $('.show-card-name-membership-card').text($('#name-template-membership-card-' + id).text());
    $('#show-card-name-membership-card').val($('#name-template-membership-card-' + id).text());
    $('.show-card-create-membership-card').text($('#date-template-membership-card-' + id).text());
    $('.show-card-point-membership-card').text($('#point-template-membership-card-' + id).text());
    $('#show-card-point-membership-card').val($('#point-template-membership-card-' + id).text());
    $('#show-card-color-membership-card').attr('style', 'background-color:' + $('#color-template-membership-card-' + id).text());
    $('#card-color-membership-card').val($('#color-template-membership-card-' + id).text()).trigger('change');
    $('#card-color-membership-card').parent().find('span').find('span').attr('style', 'background-color:' + $('#color-template-membership-card-' + id).text());
    $('.show-card-percent-membership-card').text($('#percent-template-membership-card-' + id).text() + '%');
    $('#show-card-percent-membership-card').val($('#percent-template-membership-card-' + id).text());
    $('.show-card-month-membership-card').text($('#month-template-membership-card-' + id).text() + ' tháng');
}

function backModalCreateMemberShipCard() {
    shortcut.remove("F4");
    shortcut.remove("tab");
    $('#tab2-membership-card').addClass('d-none');
    $('#back-modal-create-membership-card').addClass('d-none');
    $('#save-modal-create-membership-card').addClass('d-none');
    $('#next-modal-create-membership-card').removeClass('d-none');
    $('#tab1-membership-card').removeClass('d-none');
}

function nextModalCreateMemberShipCard() {
    if ($('#id-template-selected-membership-card').text() === '') {
        let text = 'Vui lòng chọn thẻ muốn thêm mới!';
        ErrorNotify(text);
        return false;
    }
    shortcut.add('F4', function () {
        saveModalCreateMemberShipCard();
    });
    shortcut.add('tab', function () {
        backModalCreateMemberShipCard();
    });
    $('.btn-renew').addClass('d-none');
    $('#next-modal-create-membership-card').addClass('d-none');
    $('#tab1-membership-card').addClass('d-none');
    $('#tab2-membership-card').removeClass('d-none');
    $('#back-modal-create-membership-card').removeClass('d-none');
    $('#save-modal-create-membership-card').removeClass('d-none');
}

async function saveModalCreateMemberShipCard() {
    if(checkSaveCreateMemberShipCard === 1) return false;
    if(!checkValidateSave($('#modal-create-membership-card'))) return false;
    let name = $('#show-card-name-membership-card').val(),
        percent = $('#show-card-percent-membership-card').val(),
        month_to_expire_promotion_point = $('#show-card-month-membership-card').val(),
        color_hex_code = $('#card-color-membership-card').val(),
        total_to_level_up = removeformatNumber($('#show-card-point-membership-card').val());
    if ($('#type-month-membership-card input[name="duration"]:checked').val() === '0') month_to_expire_promotion_point = '0';
    checkSaveCreateMemberShipCard = 1;
    let method = 'post',
        url = 'restaurant-membership-card.create',
        id = $('#id-template-selected-membership-card').text(),
        params = null,
        data = {
            id: id,
            name: name,
            color_hex_code: color_hex_code,
            total_amount_to_level_up: total_to_level_up,
            month_to_expire_promotion_point: 0,
            cashback_to_point_percent: percent,
        };
    let res = await axiosTemplate(method, url, params, data,[$("#load-modal-content")]);
    checkSaveCreateMemberShipCard = 0;
    switch (res.data.status ) {
        case 200:
            closeModalCreateMemberShipCard();
            SuccessNotify($('#success-create-data-to-server').text());
            addRowDatatableTemplate(tableListMemberShipCard, {
                'name': res.data.data.name,
                'color': `<div class="waves-effect waveclassNameht w-75 h-1rem m-auto"
                              style="background-color: ${res.data.data.color_hex_code}"></div>`,
                'total_amount_to_level_up': formatNumber(res.data.data.total_amount_to_level_up),
                'cashback_to_point_percent': formatNumber(res.data.data.cashback_to_point_percent) + "%",
                'month_to_expire_promotion_point': `<div class="seemt-orange seemt-border-orange status-new" style="display: inline !important; max-width: max-content;"> <i class="fi-rr-time-quarter-to" style=" font-size: 14px; vertical-align: middle; "></i> <label class="m-0" style="margin-left: -12px !important;">Vĩnh viễn</label></div>`,
                'action': `<div class="btn-group btn-group-sm text-center">
                <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange  waves-effect waves-light" data-id="${res.data.data.id}" data-name="${res.data.data.name}" data-color="${res.data.data.color_hex_code}" data-point="${formatNumber(res.data.data.total_amount_to_level_up)}" data-discount="${res.data.data.cashback_to_point_percent}" data-month="${formatNumber(res.data.data.month_to_expire_promotion_point)}" data-create="${res.data.data.created_at}" onclick="openModalUpdateMemberShipCard($(this))">
            <i class="fi-rr-pencil" style="display: contents"></i></button></div>`,
            });
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalCreateMemberShipCard() {
    backModalCreateMemberShipCard();
    $('#modal-create-membership-card').modal('hide');
    shortcut.remove("F4");
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateMemberShipCard();
    });
    reloadModalCreateMemberShipCard();
}

function reloadModalCreateMemberShipCard() {
    $('.checkbox-membership-card').removeClass('custom-card-membership');
    $('#id-template-selected-membership-card').text('');
    $('#card-color-membership-card').val()
    $('#show-card-name-membership-card').val('')
    $('#show-card-point-membership-card').val(100)
    $('#show-card-percent-membership-card').val(0)
    $('#show-card-month-membership-card').val(1)
    $('#type-month-membership-card input[name="duration"][value="0"]').prop('checked', true);
    $('#div-show-card-month-membership-card').addClass('d-none');
}
