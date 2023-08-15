let dataAdditionFoodCreateFoodManage = '',
    url_image,
    dataMaterialCreateFoodManage = '',
    dataFoodNote = '',
    dataFoodQuantitative = '',
    dataTableComboFoodBrandManage,
    optionVatFoodManageData = '',
    optionSetUpVatFoodManage = '', urlAvatarCreateFood = '',
    loadDataMaterial = 0, restaurant_material_id,
    dataCreateImageUpload,
    checkAdditionalCreateFoodBrandManage = 0;
    checkNoteFoodBrandManage = 0;
$(function () {
    if (window.location.href.includes('/food-data')) {
        shortcut.add('F2', function () {
            openModalCreateFoodManage();
        });
    }

    $(document).on('input', '#modal-create-food-brand-manage input[type="text"]', function () {
        $('#modal-create-food-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('input', '#modal-create-food-brand-manage textarea', function () {
        $('#modal-create-food-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-brand-manage select', function () {
        $('#modal-create-food-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-brand-manage input[type="checkbox"]', function () {
        $('#modal-create-food-brand-manage .btn-renew').removeClass('d-none');
    })

    $(document).on('change', '#modal-create-food-brand-manage input[type="radio"]', function () {
        $('#modal-create-food-brand-manage .btn-renew').removeClass('d-none');
    })

    $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').css('cursor', 'no-drop');

    $('#sell-by-create-food-brand-manage input[name=sell-by]').on('click', function () {
        if ($('#sell-by-create-food-brand-manage input[name=sell-by]:checked').val() == 1) {
            $('#print-lake-create-food-brand-manage-div').removeClass('d-none')
            if(!$('#print-kitchen-create-food-brand-manage').is(':checked')) $('#print-lake-create-food-brand-manage').css('cursor', 'no-drop');
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('disabled', true);

        } else {
            $('#print-lake-create-food-brand-manage-div').addClass('d-none')
        }
        if($('#print-kitchen-create-food-brand-manage').is(':checked')){
            $('#print-tem-create-food-brand-manage-div, #print-lake-create-food-brand-manage-div').removeClass('disabled')
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('disabled', false);
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').css('cursor', 'pointer');
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').removeClass('disabled')
        }

    })

    $($('#print-kitchen-create-food-brand-manage')).on('change', function () {
        if ($(this).is(':checked')) {
            $('#print-tem-create-food-brand-manage-div, #print-lake-create-food-brand-manage-div').removeClass('disabled')
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('disabled', false);
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').css('cursor', 'pointer');
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').removeClass('disabled')
        } else {
            $('#print-tem-create-food-brand-manage-div, #print-lake-create-food-brand-manage-div').addClass('disabled')
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('disabled', true);
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').css('cursor', 'no-drop');
            $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('checked', false);
        }
    })
    $('#description-create-food-brand-manage').on('input', function () {
        if ($(this).val().length > 300) {
            $(this).val($(this).val().substring(0, 300));
        }
        $('#modal-create-food-brand-manage').find('#char-count > span:eq(0)').text($('#description-create-food-brand-manage').val().length);
    });
    $('#description-create-food-brand-manage').on('paste', function (e) {
        let pasteData = e.originalEvent.clipboardData.getData('text/plain');
        if ($(this).val().length + pasteData.length > 300) {
            e.preventDefault();
            WarningNotify('Ghi chú dài tối đa 300 ký tự !');
        }
        setTimeout(function () {
            $('#modal-create-food-brand-manage').find('#char-count > span:eq(0)').text($('#description-create-food-brand-manage').val().length);
        },100);
    });
    $('#quantitative-create-food-brand-manage').on('click', async function () {
        $('#original-create-food-brand-manage').val(0);
        calculateProfitCreateFoodData()
        let giaBan = Number(removeformatNumber($('#price-create-food-brand-manage').val()))
        let giaVon = Number(removeformatNumber($('#original-create-food-brand-manage').val()))
        $('#profit-margin-create-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ '%')
        if ($(this).is(':checked')) {
            $('#show-div-quantitative-create-food-brand-manage').removeClass('d-none');
            $('#original-create-food-brand-manage').attr('disabled', true);
            await materialQuantitative();
            $('#material-create-food-brand-manage').html(dataFoodQuantitative);
        } else {
            $('#original-create-food-brand-manage').attr('disabled', false);
            $('#show-div-quantitative-create-food-brand-manage').addClass('d-none');
            $('#material-create-food-brand-manage').val(null).trigger('change.select2');
            $('#show-div-material-unit-create-food-brand-manage').addClass('d-none');
        }
    });
})

async function openModalCreateFoodManage() {
    shortcut.remove('F2');
    let tab_index = $('#tabs-food-data .nav-link.active').data('index')
    if (tab_index == 1 || tab_index == 3 || tab_index==2) {
        $('#div-review-create-food-brand-manage').addClass('d-none')
    } else {
        $('#div-review-create-food-brand-manage').removeClass('d-none')
    }
    $('#modal-create-food-brand-manage').modal('show');
    shortcut.add('F4', function () {
        saveFoodCreateFoodBrandManage();
    });
    shortcut.add('ESC', function () {
        closeModalCreateFoodManage();
    });
    $('#category-create-food-brand-manage ,#material-create-food-brand-manage ,.select-option-create-food-brand-manage ,#unit-create-food-brand-manage,#additional-create-food-brand-manage, #note-food-brand-manage, #material-create-food-brand-manage, #vat-create-food-brand-manage, #material-unit-create-food-brand-manage').select2({
        dropdownParent: $('#modal-create-food-brand-manage'),
    });
    $("#take-away-create-food-brand-manage input[type='radio'][value='0']").prop('checked', true);
    loadDataMaterial = 0;
    let type_category = $('#tabs-food-data .nav-link.active').data('category-type');
    switch (type_category) {
        case 1:
            $('#category-create-food-brand-manage').html(dataCategoryFood);
            $('#title-create-food-brand-manage').text('Thêm mới món ăn')
            $('#title-create-info-food-brand-manage').text('Thông tin món ăn')
            $('#sell-by-create-food-brand-manage').find('.form-validate-checkbox:eq(1)').removeClass('d-none')
            $('#time-create-food-brand-manage').attr('disabled', false);
            break;
        case 2:
            $('#category-create-food-brand-manage').html(dataCategoryDrink);
            $('#title-create-food-brand-manage').text('Thêm mới nước uống')
            $('#title-create-info-food-brand-manage').text('Thông tin nước uống')
            $('#sell-by-create-food-brand-manage').find('.form-validate-checkbox:eq(1)').addClass('d-none')
            $('#time-create-food-brand-manage').attr('disabled', true);
            break;
        case 3:
            $('#category-create-food-brand-manage').html(dataCategoryOther);
            $('#title-create-food-brand-manage').text('Thêm mới món ăn khác')
            $('#title-create-info-food-brand-manage').text('Thông tin món ăn khác')
            $('#sell-by-create-food-brand-manage').find('.form-validate-checkbox:eq(1)').removeClass('d-none')
            $('#time-create-food-brand-manage').attr('disabled', false);
            break;
    }
    $(document).on('click', '.class-check-food-create-brand-manage', function () {
        let bien = "";
        if ($('.class-check-food-create-brand-manage:checked').val() === "2") {
            $('#category-create-food-brand-manage option').each(function () {
                if ($(this).attr('data-id-category') != 2 && $(this).attr('data-id-category') != 3) {
                    bien += `<option value="${$(this).val()}">${$(this).text()} </option>`
                }
            })
            $('#category-create-food-brand-manage').html(bien)
        } else if ($('.class-check-food-create-brand-manage:checked').val() === "3") {
            $('#category-create-food-brand-manage').html(dataCategoryFoodNotDrinkOtherData)
        } else {
            $('#category-create-food-brand-manage').html(dataCategoryFoodData)
        }
    })
    $('.class-food-create-food-manage').removeClass('d-none');
    $('#vat-create-food-brand-manage').on('select2:open', function () {
        if (vatFoodCreateFoodManage === '') {
            $('#vat-create-food-brand-manage').html(vatFoodCreateFoodManage());
        } else {
            if ($('#vat-create-food-brand-manage').length === 0)
                $('#vat-create-food-brand-manage').html(vatFoodCreateFoodManage);
        }
    });
    $('#original-create-food-brand-manage').on('click', function () {
        let el = $('#original-create-food-brand-manage').get(0);
        let length = $('#original-create-food-brand-manage').val().length;
        el.selectionStart = 0;
        el.selectionEnd = length;
        el.focus();
    })
    $('#name-create-food-brand-manage').on('input paste', function () {
        let code = removeVietnameseStringLowerCase($(this).val());
        code=code.replace(/[`~!@#$%^*|\=?;:'",.<>\[\]\\\/]/gi, '');
        $('#code-create-food-brand-manage').val(code.toUpperCase());
        $('#code-create-food-brand-manage').parent().removeClass('validate-error');
        $('#code-create-food-brand-manage').parents('.form-group').find('.error').remove();
    });
    $('#code-create-food-brand-manage').on('input paste keyup', function () {
        let code = removeVietnameseStringLowerCase($(this).val());
        $(this).val(code.toUpperCase());
    });
    $('.price-create-food-brand-manage').on('input paste keyup', function () {
        $('#point-create-food-brand-manage').text(formatNumber((parseFloat(removeformatNumber($(this).val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(2).replace('.00' , '')));
        calculateProfitCreateFoodData()
    });
    $('#original-create-food-brand-manage').on('input paste keyup', function () {
        $('#profit-create-food-brand-manage').val(formatNumber(Number(removeformatNumber($('.price-create-food-brand-manage').val())) - Number(removeformatNumber($(this).val()))));
        calculateProfitCreateFoodData()
    });

    $('#original-create-food-brand-manage').on('input paste keyup', function () {
        if (removeformatNumber($('.price-create-food-brand-manage').val()) > 0) {
            let giaBan = Number(removeformatNumber($('.price-create-food-brand-manage').val()))
            let giaVon = Number(removeformatNumber($(this).val()))
            $('#profit-margin-create-food-brand-manage').text((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '') + "%");
            $('#profit-margin-create-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+'%')
        }
    });
    $('.price-create-food-brand-manage').on('input paste keyup', function () {
        if (removeformatNumber($(this).val()) > 0) {
            let giaBan = Number(removeformatNumber($(this).val()))
            let giaVon = Number(removeformatNumber($('#original-create-food-brand-manage').val()))
            $('#profit-margin-create-food-brand-manage').text(formatNumber(((giaBan - giaVon) / giaBan * 100).toFixed(2).replace('.00', ''))+ '%')
        } else {
            $('#profit-margin-create-food-brand-manage').text("0%")
        }
    });
    $('#input-picture-create-food-brand-manage').unbind('change').on('change', async function () {
        url_image = URL.createObjectURL($(this).prop('files')[0]);
        dataCreateImageUpload = $(this).prop('files')[0];
        switch ((dataCreateImageUpload.type).slice(6)) {
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
        if (dataCreateImageUpload.size <= (5 * 1024 * 1024)) {
            $('#picture-create-food-brand-manage').attr('src', URL.createObjectURL($(this).prop('files')[0]));
            let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
            urlAvatarCreateFood = data.data[0]
            $('#picture-create-food-brand-manage').attr('data-url-thumb', data.data[1]);
            $(this).replaceWith($(this).val('').clone(true));
        } else {
            WarningNotify('Ảnh vượt quá kích thước 5MB !');
        }
    });

    $('#material-create-food-brand-manage').unbind('select2:select').on('select2:select', function () {
        $('#show-div-material-unit-create-food-brand-manage').removeClass('d-none')
        restaurant_material_id = $(this).val()
        $('#original-create-food-brand-manage').attr('disabled', 'true');
        calculateProfitCreateFoodData();
        loadDataMaterialUnitFoodData();
        $('#material-create-food-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
    })
    $('#material-unit-create-food-brand-manage').unbind('select2:select').on('select2:select', function () {
        $('#original-create-food-brand-manage').val(formatNumber(Math.round($('#material-create-food-brand-manage').find('option:selected').attr('data-price')/ $('#material-create-food-brand-manage').find('option:selected').attr('data-material-unit-specification-exchange-value')*$(this).find('option:selected').attr('data-exchange-value'))))
        let giaBan = Number(removeformatNumber($('.price-create-food-brand-manage').val()))
        let giaVon = Number(removeformatNumber($('#original-create-food-brand-manage').val()))
        $('#profit-margin-create-food-brand-manage').text((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '') + "%");
    })

    $('#material-unit-create-food-brand-manage').on('change', function () {
        $('#material-unit-create-food-brand-manage').find('option[value=""]').text('Vui lòng chọn').remove();
    })
    if(type_category== 2){
        $('#check-additional-create-food-brand-manage').addClass('d-none')
    }
    else{
        $('#check-additional-create-food-brand-manage').removeClass('d-none')
        if(checkAdditionalCreateFoodBrandManage == 0) {
            let option = await foodOptionAdditionCreate(-1);
            $('#additional-create-food-brand-manage').html(option);
        }
    }
    if(checkNoteFoodBrandManage == 0) {
        await foodNote();
    }
    $('#unit-create-food-brand-manage').html(dataUnitFoodData);
    $('#vat-create-food-brand-manage').html(dataVatFoodData);
    $('#note-food-brand-manage').html(dataFoodNote);
    $('#category-create-food-brand-manage').on('change', function () {
         switch (Number($('#category-create-food-brand-manage').find('option:selected').attr('data-category-type'))) {
            case 1:
                $('.cook-create-food-brand-manage').prop('checked', true);
                $('.cook-create-food-brand-manage').attr('disabled', true);
                $('.cook-create-food-brand-manage').parent().find('span').addClass('disabled');
                $('#time-create-food-brand-manage').attr('disabled', false);
                $('#time-create-food-brand-manage').val('0');
                $('#check-additional-create-food-brand-manage').removeClass('d-none');
                $('#check-note-create-food-brand-manage').removeClass('col-lg-12');
                $('#check-note-create-food-brand-manage').addClass('col-lg-6');
                $('#option-not-cook-drink').addClass('d-none');
                $('#option-not-cook-other').addClass('d-none');
                $('#option-not-cook-food').removeClass('d-none');
                $('#option-not-cook-seafood').addClass('d-none');
                $("#sell-by-create-food-brand-manage div:nth-child(2)").removeClass('d-none');
                break;
            case 2:
                $('.cook-create-food-brand-manage').prop('checked', false);
                $('.cook-create-food-brand-manage').attr('disabled', true);
                $('.cook-create-food-brand-manage').parent().find('span').addClass('disabled');
                $('#time-create-food-brand-manage').attr('disabled', true);
                $('#time-create-food-brand-manage').val('0');
                $('#check-additional-create-food-brand-manage').addClass('d-none');
                $('#check-note-create-food-brand-manage').addClass('col-lg-12');
                $('#check-note-create-food-brand-manage').removeClass('col-lg-6');
                $('#option-not-cook-drink').removeClass('d-none');
                $('#option-not-cook-other').addClass('d-none');
                $('#option-not-cook-food').addClass('d-none');
                $('#option-not-cook-seafood').addClass('d-none');
                $("#sell-by-create-food-brand-manage div:nth-child(2)").addClass('d-none');
                break;
            case 3:
                $('.cook-create-food-brand-manage').prop('checked', false);
                $('.cook-create-food-brand-manage').attr('disabled', true);
                $('.cook-create-food-brand-manage').parent().find('span').addClass('disabled');
                $('#time-create-food-brand-manage').attr('disabled', true);
                $('#time-create-food-brand-manage').val('0');
                $('#check-additional-create-food-brand-manage').addClass('d-none');
                $('#check-note-create-food-brand-manage').addClass('col-lg-12');
                $('#check-note-create-food-brand-manage').removeClass('col-lg-6');
                $('#option-not-cook-drink').addClass('d-none');
                $('#option-not-cook-other').removeClass('d-none');
                $('#option-not-cook-food').addClass('d-none');
                $('#option-not-cook-seafood').addClass('d-none');
                $("#sell-by-create-food-brand-manage div:nth-child(2)").addClass('d-none');
                break;
            case 4:
                $('.cook-create-food-brand-manage').prop('checked', true);
                $('.cook-create-food-brand-manage').attr('disabled', true);
                $('.cook-create-food-brand-manage').parent().find('span').addClass('disabled');
                $('#time-create-food-brand-manage').attr('disabled', false);
                $('#time-create-food-brand-manage').val('0');
                $('#check-additional-create-food-brand-manage').removeClass('d-none');
                $('#check-note-create-food-brand-manage').removeClass('col-lg-12');
                $('#check-note-create-food-brand-manage').addClass('col-lg-6');
                $('#option-not-cook-drink').addClass('d-none');
                $('#option-not-cook-other').addClass('d-none');
                $('#option-not-cook-food').addClass('d-none');
                $('#option-not-cook-seafood').removeClass('d-none');
                $("#sell-by-create-food-brand-manage div:nth-child(2)").removeClass('d-none');
                break;
            default:
                $('#time-create-food-brand-manage').val('0');
                $('.cook-create-food-brand-manage').prop('checked', false);
                $('.cook-create-food-brand-manage').attr('disabled', false);
                $('.cook-create-food-brand-manage').parent().find('span').removeClass('disabled');
                $('#time-create-food-brand-manage').attr('disabled', false);
                $('#option-not-cook-drink').addClass('d-none');
                $('#option-not-cook-other').addClass('d-none');
                $('#option-not-cook-food').addClass('d-none');
                $('#option-not-cook-seafood').addClass('d-none');
                $("#sell-by-create-food-brand-manage div:nth-child(2)").removeClass('d-none');
        }
    })
    $('#category-create-food-brand-manage').find('option[value="-1"]').remove();
    if ($('#category-create-food-brand-manage').val() !== null) {
        $('#category-create-food-brand-manage').prepend('<option value="" selected disabled>Vui lòng chọn</option>');
    }

    if ($('#tabs-food-data li ').find('a').data('type') === 1) {
        $('#original-create-food-brand-manage').attr('data-min', '0');
    }
    $('#price-create-food-brand-manage').val('1,000')
    calculateProfitCreateFoodData()
    $('#point-create-food-brand-manage').text((parseFloat(removeformatNumber($('#price-create-food-brand-manage').val())) / parseFloat($('#point-ratio-food-server').val())).toFixed(2).replace('.00' , ''));
    let giaBan = Number(removeformatNumber($('.price-create-food-brand-manage').val()))
    let giaVon = Number(removeformatNumber($('#original-create-food-brand-manage').val()))
    $('#profit-margin-create-food-brand-manage').text((((giaBan - giaVon) / giaBan) * 100).toFixed(2).replace('.00', '') + "%");
    checkNoteFoodBrandManage = 1;
    checkAdditionalCreateFoodBrandManage = 1;
}

// Danh sách món ăn
async function foodNote() {
    let method = 'get',
        url = 'food-brand-manage.food-note',
        brand = $('.select-brand').val(),
        params = {
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#note-food-brand-manage'),
        $('#note-combo-food-brand-manage'),
        $('#note-addition-food-brand-manage'),
    ]);
    dataFoodNote = res.data[0];
}

async function materialQuantitative() {
    if (loadDataMaterial === 0) {
        let method = 'get',
            url = 'food-brand-manage.material-quantitative',
            params = {
                brand: $('.select-brand').val(),
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#material-create-food-brand-manage'), $('#material-create-addition-food-brand-manage')]);
        dataFoodQuantitative = res.data[0]
        loadDataMaterial = 1;
    }
}

// Tính lợi nhuận
function calculateProfitCreateFoodData() {
    $('#profit-create-food-brand-manage').val(formatNumber(removeformatNumber($('#price-create-food-brand-manage').val()) - removeformatNumber($('#original-create-food-brand-manage').val())));
}

function calculateProfitMarginCreateFoodData() {
    let giaBan = Number(removeformatNumber($('.price-create-food-brand-manage').val()))
    let giaVon = Number(removeformatNumber($('#original-create-food-brand-manage').val()))
    $('#profit-margin-create-food-brand-manage').val(formatNumber(((giaBan - giaVon) / giaBan)) * 100);
}

async function dataCreateFoodManage() {
    let method = 'get',
        url = 'food-brand-manage.data-create',
        brand = $('.select-brand').val(),
        params = {
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-create-food-combo-brand-manage'),
    ]);
    dataMaterialCreateFoodManage = res.data[0];
    $('#select-food-in-combo-create-food-brand-manage').html(dataMaterialCreateFoodManage);
}

// Draw tạo món ăn bên phần xây dựng dữ liệu
function drawTableCreateFoodManage(data) {
    let category_id = data.category_type_id,
        table = '';
    switch (category_id) {
        case 1:
            $('#total-record-food').text(formatNumber(Number($('#total-record-food').text()) + 1));
            table = dataTableFood;
            break;
        case 2:
            $('#total-record-drink').text(formatNumber(Number($('#total-record-drink').text()) + 1));
            table = dataTableFoodDrink;
            break;
        case 3:
            $('#total-record-other').text(formatNumber(Number($('#total-record-other').text()) + 1));
            table = dataTableFoodOther;
            break;
        case 4:
            $('#total-record-sea-food').text(formatNumber(Number($('#total-record-sea-food').text()) + 1));
            table = dataTableFoodSea;
            break;
    }
    addRowDatatableTemplate(table, {
        'name_avatar': '<img onerror="imageDefaultOnLoadError($(this))" src="' + url_image + '" class="img-inline-name-data-table">' +
            '<label class="name-inline-data-table">' + data.name + '<br>' +
            '<label class="department-inline-name-data-table"><i class="fa fa-cutlery"></i>' + data.code + '</label>' +
            '</label>',
        'category_name': data.category_name,
        'price': '<label class="font-weight-bold">' + formatNumber(data.price) + '</label></br>' +
            '<label class="number-order"> Gốc: ' + data.original_price +
            '</label>',
        'vat': data.restaurant_vat_config_percent + '%',
        'original_revenue': formatNumber(data.original_revenue),
        'profit_rate_by_original_price': data.profit_rate_by_original_price,
        'profit_rate_by_price': data.profit_rate_by_price,
        'keysearch': data.keysearch,
        'action': data.action,
    });
}

// Danh sách móm bán kèm
async function foodOptionAdditionCreate(type) {
    let restaurant_brand_id = $('.select-brand').val(),
        branch_id = $('change_branch').val();
    let method = 'get',
        url = 'food-brand-manage.option-food-addition',
        params = {
            restaurant_brand_id: restaurant_brand_id,
            branch_id: branch_id,
            id: $('#additional-create-food-brand-manage').val(),
            category_type_id: -1,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#additional-create-food-brand-manage')]);
    dataAdditionFoodCreateFoodManage = res.data[0];
    return res.data[0];
}


async function vatFoodCreateFoodManage() {
    if (optionVatFoodManageData === '') {
        let method = 'get',
            url = 'food-brand-manage.vat',
            brand = $('#select-brand-food-brand-manage').val(),
            params = {
                brand: brand
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data, [
            $('#vat-create-addition-food-brand-manage'),
            $('#vat-create-food-brand-manage'),
            $('#vat-create-combo-food-combo-brand-manage'),
            $('#vat-setup-vat-food-brand-manage'),
        ]);
        optionVatFoodManageData = res.data[0];
        optionSetUpVatFoodManage = res.data[2];
        return res.data[0];
    } else {
        return optionVatFoodManageData;
    }
}

function closeModalCreateFoodManage() {
    $('#modal-create-food-brand-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateFoodManage();
    });
    $('#modal-create-food-brand-manage .btn-renew').addClass('d-none');
    resetModalCreateFoodManage()
    countCharacterTextarea()

}

function resetModalCreateFoodManage() {
    let text = '';
    $('#modal-create-food-brand-manage .modal-body').find('input[type="text"], textarea').each(function () {
        text = text + $.trim($(this).val());
    });
    $("input[type=text]").val('');
    $('#description-create-food-brand-manage').val('');
    $('#tab-info-create-food-manager').removeClass('d-none');
    $("#cook-create-food-brand-manage input[type='radio'][value='0']").prop('checked', true);
    $("#sell-by-create-food-brand-manage input[type='radio'][value='0']").prop('checked', true);
    $("#point-method-create-food-brand-manage input[type='radio'][value='0']").prop('checked', true);
    $("#print-create-food-brand-manage").prop('checked', false);
    $("#review-create-food-brand-manage").prop('checked', false);
    $("#party-create-food-brand-manage").prop('checked', false);
    $("#print-kitchen-create-food-brand-manage").prop('checked', false);
    $("#print-lake-create-food-brand-manage").prop('disabled', true);
    $("#print-lake-create-food-brand-manage-div, .print-lake-create-food-brand-manage-span").addClass('disabled');
    $("#take-away-create-food-brand-manage input[type='radio'][value='0']").prop('checked', true);
    $("input[name=point][type='radio'][value='0']").prop('checked', true);
    $("#modal-create-food-brand-manage .js-example-basic-single").find('option:first').prop('selected', true).trigger('change.select2');
    $("#additional-create-food-brand-manage").val([]).trigger("change");
    $('#note-food-brand-manage').val(null).trigger("change");
    $('#vat-create-food-brand-manage').val(null).trigger("change");
    $('#quantitative-create-food-brand-manage').prop('checked', false);
    $('#modal-create-food-brand-manage img').attr('src', '/images/food_file.jpg');
    $('#show-div-quantitative-create-food-brand-manage').addClass('d-none');
    $('#show-div-material-unit-create-food-brand-manage').addClass('d-none');
    $('#point-create-food-brand-manage').text('0');
    $('input[name="cook"][value="0"]').prop('checked', true);
    $('#profit-create-food-brand-manage').val(0);
    $("input[type=radio]").first().click();
    $('#time-create-food-brand-manage').val(0);
    $('input[type=checkbox]').prop('checked', false);
    $('#check-additional-create-food-brand-manage').removeClass('d-none');
    $('#original-create-food-brand-manage').val('0');
    $('#price-create-food-brand-manage').val('1,000');
    $('#original-create-food-brand-manage').attr('disabled', false);
    $('#option-not-cook-drink').addClass('d-none');
    $('#option-not-cook-other').addClass('d-none');
    $('#option-not-cook-food').addClass('d-none');
    $('#option-not-cook-seafood').addClass('d-none');
    $('#price-create-food-brand-manage').val('0');
    $('#original-create-food-brand-manage').attr('disabled', false);
    $('.cook-create-food-brand-manage').attr('disabled', false);
    $('.cook-create-food-brand-manage').parent().find('span').removeClass('disabled');
    $('#check-note-create-food-brand-manage').removeClass('col-lg-12');
    $('#check-note-create-food-brand-manage').addClass('col-lg-6');
    $("#sell-by-create-food-brand-manage div:nth-child(2)").removeClass('d-none');
    $('#modal-create-food-brand-manage .btn-renew').addClass('d-none');
    $('#picture-create-food-brand-manage').attr('src', '/images/food_file.jpg')
    $('#profit-margin-create-food-brand-manage').text('0%')
    $('#print-tem-create-food-brand-manage-div, #print-lake-create-food-brand-manage-div').addClass('disabled')
    $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('disabled', true);
    $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').css('cursor', 'no-drop');
    $('#print-tem-create-food-brand-manage, #print-lake-create-food-brand-manage').prop('checked', false);
}

async function loadDataMaterialUnitFoodData() {
    let method = 'get',
        url = 'food-brand-manage.material-unit-food-map',
        brand = $('.select-brand').val(),
        params = {
            restaurant_material_id: restaurant_material_id,
            brand: brand
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#material-unit-create-food-brand-manage')]);
    $('#material-unit-create-food-brand-manage').html(res.data[0]);
}
