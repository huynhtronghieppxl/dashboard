let idFoodManage;
let tableMaterialFoodManage, saveTableQuantityData = 0, chooseFoodQuantitative;
let  checkSavaCreateQuantityFoodManage = 0, optionUnitFood, dataUnSelectedMaterialManage;
$(function () {
    $(document).on('change', '#select-material-food', async function () {
        optionUnitFood = '';
        for (let i = 0; i < dataUnSelectedMaterialManage.length; i++) {
            if ($(this).find(':selected').val() == dataUnSelectedMaterialManage[i].id) {
                for (let j = 0; j < dataUnSelectedMaterialManage[i].material_unit_quantifications.length; j++) {
                    optionUnitFood += '<option value="' + dataUnSelectedMaterialManage[i].material_unit_quantifications[j].id + '" data-exchange-value="' + dataUnSelectedMaterialManage[i].material_unit_quantifications[j].value + '"    >' + dataUnSelectedMaterialManage[i].material_unit_quantifications[j].name + '</option>'
                }
                break
            }
        }
        let unit_id = $(this).find(':selected').data('unit-id');
        let data = {
            'name': '<label>' + $(this).find(':selected').text() + '</label><input class="d-none"   value="' + $(this).find(':selected').val() + '"    />',
            'price': '<label data-price="' + $(this).find(':selected').attr('data-price') + '" data-material-unit-specification-exchange-value="' + $(this).find(':selected').attr('data-material-unit-specification-exchange-value') + '" data-wastage-rate="' + $(this).find(':selected').attr('data-wastage-rate') + '">' +
                '<div style="font-size: 14px">' + +'</div>' +
                '</label>',
            'quantity':
                '<div class="input-group border-group validate-table-validate">' +
                '    <input\n' +
                '        class="form-control text-center border-0 w-100 " style="font-size: 14px !important;"'  +
                '        name="quantity"' +
                '        value="1"' +
                '        data-max="999999999" data-float="1" data-type="currency-edit-number" data-number-currency="6" data-value-min-value-of="0" value="0"' +
                '    />' +
                '</div>',
            'unit-name': `<div class="pr-0">
                            <select class="js-example-basic-single select-material-unit-food">
                                ${optionUnitFood}
                            </select>
                            <div class="line"></div>
                        </div>`,
            'total': formatNumber(removeformatNumber($(this).find(':selected').data('price'))),
            'wastage_rate': ' <div class="input-group border-group validate-table-validate">\n' +
                '                                <input class="form-control text-center border-0 w-100" style="font-size: 14px !important;" name="wastage-rate" value="' + $(this).find(':selected').data('wastage-rate') + '" data-max="99.9" data-float="1" />\n' +
                '                            </div> ',
            'total_wastage_rate': '',
            'action': `<div class="btn-group btn-group-sm ">
                            <button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalDetailQuantitativeData($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Công thức"><span class="fi-rr-exclamation"></span></button>
                            <button type="button" class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterial($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xoá" ><i class="fi-rr-trash"></i></button>
                        </div>`,
        }
        await addRowDatatableTemplate(tableMaterialFoodManage, data);
        let price_original = formatNumber(Math.round(removeformatNumber($(this).find(':selected').attr('data-price')) / removeformatNumber($(this).find(':selected').attr('data-material-unit-specification-exchange-value')) * removeformatNumber($('.select-material-unit-food:last option:selected').attr('data-exchange-value'))))
        $('.select-material-unit-food:last').parents('tr').find('td:eq(4)').find('label div').text(price_original)
        let quantity = removeformatNumber($('.select-material-unit-food:last option:selected').parents('tr').find('td:eq(2) input').val());
        $('.select-material-unit-food:last').parents('tr').find('td:eq(5)').text(price_original)
        let wastage_rate = parseFloat($('.select-material-unit-food:last').parents('tr').find('td:eq(6)').find('input').val()) / 100;
        $('.select-material-unit-food:last').parents('tr').find('td:eq(7)').text(formatNumber(Math.round(removeformatNumber(price_original) / (1 - wastage_rate) * quantity)))

        $('#select-material-food').find(':selected').remove();
        $('#select-material-food').val('').trigger('change.select2');
        $('#select-material-food').select2('close');
        sumTotalpriceMerial();
    })
    $(document).on('input paste', 'input[name=wastage-rate]', async function (e) {
        let value = e.target.value;
        if (value.includes('.')) {
            $(this).val(value.split('.')[0] + '.' + value.split('.')[1].slice(0, 1))
        }
        let price = removeformatNumber($(this).parents('tr').find('td:eq(4)').text());
        let quantity = removeformatNumber($(this).parents('tr').find('td:eq(2) input').val());
        if (isNaN(value)) {
            $(this).parents('tr').find('td:eq(7)').text(formatNumber(Math.round(price * quantity)))
        }
        else $(this).parents('tr').find('td:eq(7)').text(formatNumber(Math.round(price / (1 - parseFloat($(this).parents('tr').find('td:eq(6)').find('input').val()) / 100) * quantity)))
        sumTotalpriceMerial();
    });
    $(document).on('input paste ', 'input[name=quantity]', function () {
        if ($(this).val().length > 11) {
            $(this).val('999,999,999')
        }
        let price = removeformatNumber($(this).parents('tr').find('td:eq(4)').text());
        let quantity = removeformatNumber($(this).parents('tr').find('td:eq(2) input').val());
        $(this).parents('tr').find('td:eq(5)').text(formatNumber(price * quantity))
        $(this).parents('tr').find('td:eq(7)').text(formatNumber(Math.round(price / (1 - parseFloat($(this).parents('tr').find('td:eq(6)').find('input').val()) / 100) * quantity)))
        sumTotalpriceMerial();
    });
    $(document).on('change', '.select-material-unit-food', function () {
        $(this).select2('close');
        let exchange_value = $(this).find('option:selected').data('exchange-value'),
            quantity = removeformatNumber($(this).parents('tr').find('td:eq(2) input').val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(4) label').data('price')),
            data_material_unit_specification_exchange_value = removeformatNumber($(this).parents('tr').find('td:eq(4) label').data('material-unit-specification-exchange-value')),
            wastage_rate = parseFloat($(this).parents('tr').find('td:eq(6)').find('input').val()) / 100,
            price_original = price / data_material_unit_specification_exchange_value * exchange_value;
        $(this).parents('tr').find('td:eq(4)').find('label div').text(formatNumber(price_original))
        $(this).parents('tr').find('td:eq(5)').text(formatNumber(price_original * quantity))
        $(this).parents('tr').find('td:eq(7)').text(formatNumber(Math.round(price_original / (1 - wastage_rate) * quantity)))
        tableMaterialFood.draw(false)
        sumTotalpriceMerial();
    })
})

async function openModalCreateQuantityFoodManage(r) {
    $('#modal-create-quantity-food-mange').modal('show');//get cookie
    if (getCookieShared('quantitative-data-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('quantitative-data-data-user-id-' + idSession));
        chooseFoodQuantitative = dataCookie.food
    } else {
        optionUnitFood;
    }
    dataUnSelectedMaterialManage = []
    idFoodManage = r.data('id');
    $('#modal-create-quantity-food-mange .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-quantity-food-mange'),
    })
    shortcut.add('F4', function () {
        saveTableQuantitative();
    })
    $('#name-food-in-quantitative').text(r.parents('tr').find('td:eq(1) .name-inline-data-table').attr('data-name'));
    $('#unit-food').text(r.data('quantity'));
    $('#price-food').text(formatNumber(r.data('price')));
    $('#category-food').text(r.parents('tr').find('td:eq(2  )').text());
    $('#category-food').text(r.parents('tr').find('td:eq(2  )').text());

    $('#brand-name-detail').text($('.select-brand').text());
    $('#change_branch').on('change', function () {
        $('#brand-name-detail').text($(this).find('option:selected').text());
    })
    dataTableMaterialData([]);

    loadMaterialData(r.data('id'))
}

async function saveCreateQuantityFoodManage() {
    if (!checkValidateSave($('#table-detail-material'))) return false
    let Table = [],
        id = idFoodManage,
        restaurant_brand_id = $('.select-brand').val();
    $('#table-detail-material tbody tr').each(function (row, el) {
        if ($(this).find('td:eq(1)').find('input').val() !== undefined) {
            Table[row] = {
                material_id: $(this).find('td:eq(1)').find('input').val(),
                quantity: removeformatNumber($(this).find('td:eq(2)').find('input').val()),
                material_unit_quantification_id: $(this).find('td:eq(3)').find('select option:selected').val(),
                wastage_rate: parseFloat($(this).find('td:eq(6)').find('input').val()),
                is_use_waste_rate_private: 1
            }
        } else {
            Table = []
        }
    })
    if (checkSavaCreateQuantityFoodManage === 1) return false;
    checkSavaCreateQuantityFoodManage = 1;
    let method = 'post',
        url = 'quantitative-data.create',
        params = null,
        data = {
            id: id,
            restaurant_brand_id: restaurant_brand_id,
            material: Table
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-food-quantitative-v2')]);
    checkSavaCreateQuantityFoodManage = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            loadData();
            closeModalCreateQuantityFoodManage();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text)
    }
}

// Đóng popup
function closeModalCreateQuantityFoodManage() {
    $('#table-quantity-food-manage tbody tr').remove();
    $('#select-quantity-food-manage').find('option:first').prop('selected', true).trigger('change.select2');
    $('#modal-create-quantity-food-mange').modal('hide');
    $('#modal-create-quantity-food-mange input').val('');
    dataTableMaterialData([])
    $('#select-material-food').off('change')

}

function updateCookieQuantitative() {
    saveCookieShared('quantitative-data-data-user-id-' + idSession, JSON.stringify({
        'food': chooseFoodQuantitative,
    }))
}


// Danh sách nguyên liệu định lượng
async function loadMaterialData(id_food) {
    let method = 'get',
        url = 'quantitative-data.material-data',
        restaurant_brand_id = $('.select-brand').val(),
        params = {
            restaurant_brand_id: restaurant_brand_id,
            id_food: id_food
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-material-food'), $('#table-detail-material')]);
    $('#select-material-food').html(res.data[1]);
    optionUnitFood = res.data[2];
    dataUnSelectedMaterialManage = res.data[4]
    await dataTableMaterialData(res.data[0].original.data);
    sumTotalpriceMerial();

}

// Tổng tất cả thành tiền
function sumTotalpriceMerial() {
    let total = 0,
        price = $('#price-food').text();
    tableMaterialFoodManage.rows().every(function () {
        let row = $(this.node());
        total += removeformatNumber(row.find('td:eq(7)').text());
    });
    $('#price-original-food').text(formatNumber(checkTrunc(total)));
    $('#revenu-food').text(formatNumber(checkTrunc((removeformatNumber(price) - removeformatNumber(total)))));
}


//  table danh sách nguyên liệu
async function dataTableMaterialData(data) {
    let id = $('#table-detail-material'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'unit-name', name: 'unit-name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total', name: 'total', className: 'text-right'},
            {data: 'wastage_rate', name: 'wastage_rate', className: 'text-center'},
            {data: 'total_wastage_rate', name: 'total', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [{
            'title': 'Công thức',
            'icon': 'icofont icofont-info text-waring font-weight-bold',
            'class': '',
            'function': 'modalGuidelQuantitativeData',
        }];
    tableMaterialFoodManage = await DatatableTemplateNew(id, data, column, '50vh', fixedLeft, fixedRight, option);
    tableMaterialFoodManage.rows().every(function () {
        let row = $(this.node());
        let value_select_material_unit_food = row.find('td:eq(3) option[data-selected="1"]').val();
        row.find('td:eq(3)').find('.select-material-unit-food').val(value_select_material_unit_food).trigger('change.select2')
    });
}

// Click select chọn nguyên liệu  định lượng
async function saveTableQuantitative() {
    // if (!checkValidateSave($('#table-detail-material'))) return false
    // if ($('#select-food').val() === null) {
    //     $('#select-food').parent().addClass('validate-error');
    //     $('#select-material-food').select2('close');
    //     let text = 'Vui lòng chọn món ăn';
    //     ErrorNotify(text);
    //     return false;
    // }
    // let Table = [],
    //     id = $('#select-food').val(),
    //     restaurant_brand_id = $('.select-brand').val();
    // $('#table-detail-material tbody tr').each(function (row, el) {
    //     if ($(this).find('td:eq(1)').find('input').val() !== undefined) {
    //         Table[row] = {
    //             material_id: $(this).find('td:eq(1)').find('input').val(),
    //             quantity: removeformatNumber($(this).find('td:eq(2)').find('input').val()),
    //             material_unit_food_map_id :  $(this).find('td:eq(3)').find('select option:selected').val()
    //         }
    //     } else {
    //         Table = []
    //     }
    // })
    // if (saveTableQuantityData === 1) return false;
    // saveTableQuantityData = 1;
    // let method = 'post',
    //     url = 'quantitative-data.create',
    //     params = null,
    //     data = {
    //         id: id,
    //         restaurant_brand_id: restaurant_brand_id,
    //         material: Table
    //     };
    // let res = await axiosTemplate(method, url, params, data, [$('#loading-food-quantitative-v2')]);
    // saveTableQuantityData = 0;
    // let text = '';
    // switch (res.data.status) {
    //     case 200:
    //         text = $('#success-create-data-to-server').text();
    //         SuccessNotify(text);
    //         shortcut.add('F4', function () {
    //             saveTableQuantitative();
    //         })
    //         break;
    //     case 500:
    //         text = $('#error-post-data-to-server').text();
    //         ErrorNotify(text);
    //         break;
    //     default:
    //         text = $('#error-post-data-to-server').text();
    //         if (res.data.message !== null) {
    //             text = res.data.message;
    //         }
    //         WarningNotify(text)
    // }
    if (!checkValidateSave($('#table-detail-material'))) return false
    let Table = [],
        id = $('#select-food').val(),
        restaurant_brand_id = $('.select-brand-quantitative-data').val();
    $('#table-detail-material tbody tr').each(function (row, el) {
        if ($(this).find('td:eq(1)').find('input').val() !== undefined) {
            Table[row] = {
                material_id: $(this).find('td:eq(1)').find('input').val(),
                quantity: removeformatNumber($(this).find('td:eq(2)').find('input').val()),
                material_unit_quantification_id: $(this).find('td:eq(3)').find('select option:selected').val(),
                wastage_rate: parseFloat($(this).find('td:eq(6)').find('input').val()),
                is_use_waste_rate_private: 1
            }
        } else {
            Table = []
        }
    })

    if (saveTableQuantityData === 1) return false;
    saveTableQuantityData = 1;
    let method = 'post',
        url = 'quantitative-data.create',
        params = null,
        data = {
            id: id,
            restaurant_brand_id: restaurant_brand_id,
            material: Table
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-food-quantitative-v2')]);
    saveTableQuantityData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            shortcut.add('F4', function () {
                saveTableQuantitative();
            })
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text)
    }
}

function resetFormQuantity() {
    $('#avatar-food-in-quantitative').attr('src', '');
    $('#name-food-in-quantitative').text('---');
    $('#type-food-in-quantitative').text('---');
    $('#category-food').text('');
    $('#price-food').text('');
    $('#price-original-food').text('---');
    $('#unit-food').text('---');
    $('#revenu-food').text('---');
    dataTableMaterialData([]);
    dataUnSelectedMaterialManage = []
    $('#select-material-food').off('change')
}


// Xoá nguyên liệu để định lượng
function removeMaterial(r) {
    let data_material_unit_specification_exchange_value = r.parents('tr').find('td:eq(4)').find('label').data('material-unit-specification-exchange-value'),
        value = r.parents('tr').find('td:eq(1)').find('input').val(),
        price = r.parents('tr').find('td:eq(4)').find('label').data('price'),
        wastage_rate = r.parents('tr').find('td:eq(4)').find('label').data('wastage-rate'),
        name = r.parents('tr').find('td:eq(1)').find('label').text()
    $('#select-material-food').append('<option data-material-unit-specification-exchange-value="' + data_material_unit_specification_exchange_value + '" value="' + value + '" data-price="' + price + '" data-wastage-rate="' + wastage_rate + '">' + name + '</option> ')
    tableMaterialFoodManage.row(r.parents('tr')).remove().draw(false);
    sumTotalpriceMerial();
    removeRowDatatableTemplate(tableMaterialFoodManage, r, true);
}
