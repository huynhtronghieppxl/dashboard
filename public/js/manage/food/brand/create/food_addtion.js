let checkSaveAddtionFoodManage = 0, dataCreateFoodAdditionImageUpload, restaurant_material_id_addtion,checkVatFoodCreateFoodManage;


$(function (){
     $(document).on('input', '#modal-create-food-addition-brand-manage input[type="text"]', function () {
        $('#modal-create-food-addition-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('input', '#modal-create-food-addition-brand-manage textarea', function () {
        $('#modal-create-food-addition-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-addition-brand-manage select', function () {
        $('#modal-create-food-addition-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-addition-brand-manage input[type="checkbox"]', function () {
        $('#modal-create-food-addition-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-addition-brand-manage input[type="radio"]', function () {
        $('#modal-create-food-addition-brand-manage .btn-renew').removeClass('d-none');
    })
    $('#quantitative-create-addition-food-brand-manage').on('click', async function () {
        $('#original-create-addition-food-brand-manage').val(0);
        $('#profit-create-addition-food-brand-manage').val(formatNumber(removeformatNumber($('#price-create-addition-food-brand-manage').val()) - removeformatNumber($('#original-create-addition-food-brand-manage').val())));
        let giaBan = Number(removeformatNumber($('#price-create-addition-food-brand-manage').val()))
        let giaVon = Number(removeformatNumber($('#original-create-addition-food-brand-manage').val()))
        $('#profit-margin-create-addition-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
        if ($(this).is(':checked')) {
            $('#show-div-quantitative-create-addition-food-brand-manage').removeClass('d-none');
            $('#original-create-addition-food-brand-manage').attr('disabled',true);
            await materialQuantitative();
            $('#material-create-addition-food-brand-manage').html(dataFoodQuantitative);
        } else {
            $('#original-create-addition-food-brand-manage').attr('disabled',false);
            $('#show-div-quantitative-create-addition-food-brand-manage').addClass('d-none');
            $('#material-create-addition-food-brand-manage').val(null).trigger('change.select2');
            $('#show-div-material-unit-create-addtion-brand-manage').addClass('d-none');
            $('#profit-create-addition-food-brand-manage').val(formatNumber(removeformatNumber($('#price-create-addition-food-brand-manage').val()) - removeformatNumber($('#original-create-addition-food-brand-manage').val())));
        }
    });
})
async function openModalCreateFoodAdditionManage(){
    resetModalCreateFoodAdditionManage()
    $('#title-create-info-food-addition-brand-manage').text('Thông tin món bán kèm')
    shortcut.remove('F2');
    $('#modal-create-food-addition-brand-manage').modal('show');
    shortcut.add('F4', function () {
        saveAdditionFoodCreateFoodBrandManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateFoodAdditionManage();
    });
    $('#unit-create-food-addition-brand-manage, #category-create-food-addition-brand-manage, #note-addition-food-brand-manage, #vat-create-addition-food-brand-manage, #material-create-addition-food-brand-manage, #material-create-addition-food-brand-manage, #material-unit-create-addtion-brand-manage').select2({
        dropdownParent:$('#modal-create-food-addition-brand-manage')
    })
    if(checkVatFoodCreateFoodManage == 1) return false;
    await vatFoodCreateFoodManage();
    checkVatFoodCreateFoodManage = 1;
    await foodNote();
    $('#vat-create-addition-food-brand-manage').html(dataVatFoodData)
    $('#note-addition-food-brand-manage').html(dataFoodNote)
    $('#unit-create-food-addition-brand-manage').html(dataUnitFoodData);
    $('#category-create-food-addition-brand-manage').html(dataCategoryFoodNotDrinkOtherData);
    $('#material-create-addition-food-brand-manage').unbind('select2:select').on('select2:select', function () {
         $('#show-div-material-unit-create-addtion-brand-manage').removeClass('d-none')
        restaurant_material_id_addtion = $(this).val()
        $('#original-create-addition-food-brand-manage').attr('disabled', 'true');
        $('#profit-create-addition-food-brand-manage').val(formatNumber(removeformatNumber($('#price-create-addition-food-brand-manage').val()) - removeformatNumber($('#original-create-addition-food-brand-manage').val())));
        loadDataMaterialUnitFoodDataAddtion();
        $('#material-unit-create-addtion-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
    })
    $('#material-unit-create-addtion-brand-manage').on('change', function () {
        $('#material-unit-create-addtion-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
    })
    $('#material-unit-create-addtion-brand-manage').unbind('select2:select').on('select2:select', function () {
        $('#original-create-addition-food-brand-manage').val(formatNumber(Math.round($('#material-create-addition-food-brand-manage').find('option:selected').attr('data-price')/ $('#material-create-addition-food-brand-manage').find('option:selected').attr('data-material-unit-specification-exchange-value')*$(this).find('option:selected').attr('data-exchange-value'))))
        let giaBan = Number(removeformatNumber($('#price-create-addition-food-brand-manage').val()))
        let giaVon = Number(removeformatNumber($('#original-create-addition-food-brand-manage').val()))
        $('#profit-margin-create-addition-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")
    })
    $('#price-create-addition-food-brand-manage').on('input paste', function () {
         $('#point-create-addition-food-brand-manage').text(formatNumber((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(0).replace('.00' , '')));
        $('#profit-create-addition-food-brand-manage').val(formatNumber(removeformatNumber($(this).val()) - removeformatNumber($('#original-create-addition-food-brand-manage').val())));
        if (removeformatNumber($(this).val()) > 0) {
            let giaBan = Number(removeformatNumber($(this).val()))
            let giaVon = Number(removeformatNumber($('#original-create-addition-food-brand-manage').val()))
            $('#profit-margin-create-addition-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")

        } else {
            $('#profit-margin-create-addition-food-brand-manage').text("0%")
        }
    });
    $('#original-create-addition-food-brand-manage').on('input paste', function () {
        $('#profit-create-addition-food-brand-manage').val(formatNumber(Number(removeformatNumber($('#price-create-addition-food-brand-manage').val())) - Number(removeformatNumber($(this).val()))));
        if (removeformatNumber($('#price-create-addition-food-brand-manage').val()) > 0) {
            let giaBan = Number(removeformatNumber($('#price-create-addition-food-brand-manage').val()))
            let giaVon = Number(removeformatNumber($(this).val()))
            $('#profit-margin-create-addition-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ "%")

        }
    })
    $(document).on('input', '#price-create-addition-food-brand-manage', function () {
        $('#profit-create-addition-food-brand-manage').val(formatNumber(removeformatNumber($(this).val()) - removeformatNumber($('#original-create-addition-food-brand-manage').val())));
    })
    $('#input-picture-create-food-addition-brand-manage').on('change', async function () {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        dataCreateFoodAdditionImageUpload = $(this).prop('files')[0];
        switch((dataCreateFoodAdditionImageUpload.type).slice(6)) {
            case 'png':
                break;
            case 'jpeg':
                break;
            case 'jpg':
                break;
            case 'webp':
                break;
            default:
                WarningNotify('Bạn chỉ được chọn đuôi ảnh là JPEG, JPG, PNG, WEBP!');
                return false;
        }
        if (dataCreateFoodAdditionImageUpload.size <= (5 * 1024 * 1024)) {
            $('#picture-create-food-addition-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
            let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
            urlAvatarCreateFood = data.data[0]
            $('#picture-create-food-addition-brand-manage').attr('data-url-thumb', data.data[1]);
            $(this).replaceWith($(this).val('').clone(true));
        } else {
            WarningNotify('Ảnh vượt quá kích thước 5MB !');
        }
    });
    $('#time-create-addition-food-brand-manage').val('0');
    $('#category-create-food-addition-brand-manage').on('change', function (){
        switch ($(this).find('option:selected').attr('data-id-category')) {
            case "1":
                $('#cook-create-addition-food-branch-manage').prop('checked', true);
                $('#cook-create-addition-food-branch-manage').attr('disabled', true);
                $('#cook-create-addition-food-branch-manage').parent().find('span').addClass('disabled');
                $('#time-create-addition-food-brand-manage').attr('disabled', false);
                $('#time-create-addition-food-brand-manage').val('0');
                $('#option-addition-not-cook-drink').addClass('d-none');
                $('#option-addition-not-cook-other').addClass('d-none');
                $('#option-addition-not-cook-food').removeClass('d-none');
                $('#option-addition-not-cook-seafood').addClass('d-none');
                break;
            case "2":
                $('#cook-create-addition-food-branch-manage').prop('checked', false);
                $('#cook-create-addition-food-branch-manage').attr('disabled', true);
                $('#cook-create-addition-food-branch-manage').parent().find('span').addClass('disabled');
                $('#time-create-addition-food-brand-manage').attr('disabled', true);
                $('#time-create-addition-food-brand-manage').val('0');
                $('#option-addition-not-cook-drink').removeClass('d-none');
                $('#option-addition-not-cook-other').addClass('d-none');
                $('#option-addition-not-cook-food').addClass('d-none');
                $('#option-addition-not-cook-seafood').addClass('d-none');
                break;
            case "3":
                $('#cook-create-addition-food-branch-manage').prop('checked', false);
                $('#cook-create-addition-food-branch-manage').attr('disabled', true);
                $('#cook-create-addition-food-branch-manage').parent().find('span').addClass('disabled');
                $('#time-create-addition-food-brand-manage').attr('disabled',true);
                $('#time-create-addition-food-brand-manage').val('0');
                $('#option-addition-not-cook-drink').addClass('d-none');
                $('#option-addition-not-cook-other').removeClass('d-none');
                $('#option-addition-not-cook-food').addClass('d-none');
                $('#option-addition-not-cook-seafood').addClass('d-none');
                break;
            case "4":
                $('#cook-create-addition-food-branch-manage').prop('checked',true);
                $('#cook-create-addition-food-branch-manage').attr('disabled', true);
                $('#cook-create-addition-food-branch-manage').parent().find('span').addClass('disabled');
                $('#time-create-addition-food-brand-manage').attr('disabled',false);
                $('#time-create-addition-food-brand-manage').val('1');
                $('#option-addition-not-cook-drink').addClass('d-none');
                $('#option-addition-not-cook-other').addClass('d-none');
                $('#option-addition-not-cook-food').addClass('d-none');
                $('#option-addition-not-cook-seafood').removeClass('d-none');
                break;
            default:
                $('#time-create-addition-food-brand-manage').val('1');
                $('#cook-create-addition-food-branch-manage').prop('checked', false);
                $('#cook-create-addition-food-branch-manage').attr('disabled', false);
                $('#cook-create-addition-food-branch-manage').parent().find('span').removeClass('disabled');
                $('#time-create-addition-food-brand-manage').attr('disabled',false);
                $('#option-addition-not-cook-drink').addClass('d-none');
                $('#option-addition-not-cook-other').addClass('d-none');
                $('#option-addition-not-cook-food').addClass('d-none');
                $('#option-addition-not-cook-seafood').addClass('d-none');
        }
    })
    $('#name-create-food-addition-brand-manage').on('input paste', function () {
        let code = removeVietnameseStringLowerCase($(this).val());
        $('#code-create-food-addition-brand-manage').val(code.toUpperCase());
        $('#code-create-food-addition-brand-manage').parent().removeClass('validate-error');
        $('#code-create-food-addition-brand-manage').parents('.form-group').find('.error').remove();
    });

    $('#unit-create-food-addition-brand-manage').on('change', function (){
        if($(this).val() !== null){
            $('#unit-create-food-addition-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

    $('#vat-create-addition-food-brand-manage').on('change', function (){
        if($(this).val() !== null){
            $('#vat-create-addition-food-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })

    $('#category-create-food-addition-brand-manage').on('change', function (){
        if($(this).val() !== null){
            $('#category-create-food-addition-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
        }
    })
    $('#code-create-food-addition-brand-manage').on('input paste keyup', function () {
        let code = removeVietnameseStringLowerCase($(this).val());
        $(this).val(code.toUpperCase());
    })
    $('#print-create-addition-food-brand-manage').on('click', function () {
        if($('#print-create-addition-food-brand-manage').is(':checked')) {
            $('.print-stamp-addition-food-brand-manage-div').removeClass('disabled');
            $('.print-stamp-addition-food-brand-manage-span').removeClass('disabled');
            $('#print-stamp-addition-food-brand-manage').prop('disabled', false);
            $('#print-stamp-addition-food-brand-manage').parents('.form-validate-checkbox').removeClass('disabled')
        } else {
            $('.print-stamp-addition-food-brand-manage-div').addClass('disabled');
            $('.print-stamp-addition-food-brand-manage-span').addClass('disabled');
            $('#print-stamp-addition-food-brand-manage').prop('disabled', true);
            $('#print-stamp-addition-food-brand-manage').prop('checked', false);
            $('#print-stamp-addition-food-brand-manage').parents('.form-validate-checkbox').addClass('disabled')
        }
    })
}
function closeModalCreateFoodAdditionManage() {
    $('#modal-create-food-addition-brand-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateFoodAdditionManage();
    });
    resetModalCreateFoodAdditionManage()
    countCharacterTextarea()
}
function resetModalCreateFoodAdditionManage(){
    $('#name-create-food-addition-brand-manage').val('');
    $('#code-create-food-addition-brand-manage').val('');
    $('#description-create-food-addition-brand-manage').val('');
    $('#original-create-addition-food-brand-manage').val('0');
    $('#original-create-addition-food-brand-manage').attr('disabled',false);
    $('#price-create-addition-food-brand-manage').val('0');
    $('#point-create-addition-food-brand-manage').text('0');
    $("#take-away-addition-create-food-brand-manage input[type='radio'][value='0']").prop('checked', true);
    $('#unit-create-food-addition-brand-manage').val(null).trigger("change");
    $('#category-create-food-addition-brand-manage').val(null).trigger("change");
    $('#vat-create-combo-food-brand-manage').val(null).trigger("change");
    $('#note-combo-food-brand-manage').val(null).trigger("change");
    $('#time-create-addition-food-brand-manage').val('0');
    $('#show-div-quantitative-create-addition-food-brand-manage').addClass('d-none');
    $('#show-div-material-unit-create-addtion-brand-manage').addClass('d-none');
    $('#quantitative-create-addition-food-brand-manage').prop('checked', false);
    $('#profit-create-addition-food-brand-manage').val('0');
    $('#note-addition-food-brand-manage').html('');
    $('#vat-create-addition-food-brand-manage').html(dataVatFoodData);
    $("#review-create-addition-food-brand-manage").prop('checked', false);
    $("#print-create-addition-food-brand-manage").prop('checked', false);
    $("#is-like-addition-food-brand-manage").prop('checked', false);
    if (!$('#note-addition-food-brand-manage option').length)
        $('#note-addition-food-brand-manage').html(dataFoodNote);
    $('.btn-renew').addClass('d-none')
    $('#picture-create-food-addition-brand-manage').attr('src','/images/food_file.jpg')
    $('#print-stamp-addition-food-brand-manage').parents('.form-validate-checkbox').addClass('disabled')
    $("#print-stamp-addition-food-brand-manage").prop('checked', false);
}

function drawTableCreateFoodAdditionManage(data) {
    let table = '';
    if (data.is_addition == 1) {
        $('#total-record-addition').text(formatNumber(Number($('#total-record-addition').text()) + 1));
        $('#tab-food-addition-data-7').click();
        table = dataTableFoodAddition;
    }
    addRowDatatableTemplate(table, {
        'name_avatar': '<img onerror="imageDefaultOnLoadError($(this))" src="' + url_image + '" class="img-inline-name-data-table">' +
            '<label class="name-inline-data-table">' + data.name + '<br>' +
            '<label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' + data.code + '</label>' +
            '</label>',
        'unit_type': data.unit_type,
        'category_name': data.category_name,
        'price': '<label class="font-weight-bold">' + formatNumber(data.price) +'</label></br>'+
            '<label class="number-order"> Gốc: '+ data.original_price +
            '</label>',
        'vat': data.restaurant_vat_config_percent + '%',
        'original_revenue': '<label class="font-weight-bold">' + formatNumber(data.original_revenue_percent) + '%</label></br>' +
            '<label class="number-order">TT: '+data.original_revenue + '</label>',
        'profit_rate_by_original_price': data.profit_rate_by_original_price,
        'profit_rate_by_price': data.profit_rate_by_price,
        'action': data.action,
        'keysearch': data.keysearch,
    });
}

async function saveAdditionFoodCreateFoodBrandManage(){
    if ($('#category-create-food-addition-brand-manage option:selected').data('id-category') === 2 ||
        $('#category-create-food-addition-brand-manage option:selected').data('id-category') === 3){
        $('#time-create-addition-food-brand-manage').attr('data-min', '');
        $('#time-create-addition-food-brand-manage').attr('data-max', '');
    }else if ($('#category-create-food-addition-brand-manage option:selected').data('id-category') === 1 ||
        $('#category-create-food-addition-brand-manage option:selected').data('id-category') === 4){
        $('#time-create-addition-food-brand-manage').data('number', '1');
        $('#time-create-addition-food-brand-manage').data('min', '1');
        $('#time-create-addition-food-brand-manage').data('max', '1440');
        $('#time-create-addition-food-brand-manage').data('value', '0');
    }
    if(!checkValidateSave($('#tab-setting-food-addition-create-food-manager'))) return false;
    if(checkSaveAddtionFoodManage !== 0) return false;
    let  material  = [];
    material.push({
        'material_id': $('#material-create-addition-food-brand-manage').val(),
        'material_unit_quantification_id': $('#material-unit-create-addtion-brand-manage').val(),
        'quantity' : 1,
        'wastage_rate': 0,
        'is_use_waste_rate_private':1,
    })
    let restaurant_vat_config_id = ($('#vat-create-addition-food-brand-manage').val() !== null) ? $('#vat-create-addition-food-brand-manage').val() : 0;
    let method = 'post',
        url = 'food-brand-manage.create',
        params = null,
        data = {
            brand: $('.select-brand').val(),
            list_branch_kitchen: [],
            type_food: 3,
            category_id: $('#category-create-food-addition-brand-manage').val(),
            category_type: $('#category-create-food-addition-brand-manage option:selected').attr('data-id-category'),
            avatar: urlAvatarCreateFood,
            avatar_thumb: $('#picture-create-food-addition-brand-manage').data('url-thumb'),
            description: $('#description-create-food-addition-brand-manage').val(),
            name: $('#name-create-food-addition-brand-manage').val(),
            price: removeformatNumber($('#price-create-addition-food-brand-manage').val()),
            point_to_purchase: removeformatNumber($('#point-create-addition-food-brand-manage').text()),
            time_to_completed: removeformatNumber($('#time-create-addition-food-brand-manage').val()),
            unit: $('#unit-create-food-addition-brand-manage').find('option:selected').text(),
            is_allow_print: Number($('#print-create-addition-food-brand-manage').is(':checked')),
            is_allow_print_stamp: Number($('#print-create-stamp-food-brand-manage').is(':checked')),
            code: $('#code-create-food-addition-brand-manage').val(),
            is_special_claim_point: Number($('#print-create-food-brand-manage').is(':checked')),
            is_sell_by_weight: 0,
            is_allow_review: Number($('#review-create-addition-food-brand-manage').is(':checked')),
            is_allow_purchase_by_point: Number($('#party-create-food-brand-manage').is(':checked')),
            is_take_away: $('#take-away-addition-create-food-brand-manage').find('input[type="radio"]:checked').val(),
            is_addition: 1,
            food_material_type: 0,
            food_addition_ids: [],
            is_combo: 0,
            food_in_combo: [],
            is_special_gift: 0,
            all_brand: $('#brand-create-food-combo-manage').find('input[type="radio"]:checked').val(),
            is_quantitative: Number($('#quantitative-create-addition-food-brand-manage').is(':checked')),
            material:  material,
            note_food : $('#note-addition-food-brand-manage').val(),
            original_price : removeformatNumber($('#original-create-addition-food-brand-manage').val()),
            restaurant_vat_config_id : restaurant_vat_config_id,
            is_like_addtion_food_brand_manage : Number($('#is-like-addition-food-brand-manage').is(':checked')),
        };
    checkSaveAddtionFoodManage = 1 ;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-food-addition-brand-manage')]);
    checkSaveAddtionFoodManage = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            drawTableCreateFoodAdditionManage(res.data.data);
            closeModalCreateFoodAdditionManage();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }

}
async function loadDataMaterialUnitFoodDataAddtion() {
    let method = 'get',
        url = 'food-brand-manage.material-unit-food-map',
        brand = $('.select-brand').val(),
        params = {
            restaurant_material_id: restaurant_material_id_addtion,
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#material-unit-create-addtion-brand-manage')]);
    $('#material-unit-create-addtion-brand-manage').html(res.data[0]);
}
