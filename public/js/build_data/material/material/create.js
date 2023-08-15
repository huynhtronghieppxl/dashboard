let checkCreateMaterialData = 0,
    saveCreateMaterialData = 0,
    checkSupplierCreateMaterialData = 0,
    checkSaveCreateUnitData = 0,
    checkDataUnitMaterialData = 0,
    checkDataUnitOrderMaterialData = 0,
    checkDataUnitCreateUnitMaterialData = 0,
    checkDataSupplierMaterialData = 0,
    checkSaveCreateSpecificationsData = 0,
    checkCreateSupplierCreateMaterialData = 0,
    optionsCategoryCreateMaterialData = {'material': [], 'goods': [], 'internal': [], 'orther': []},
    checkCreateDataUnitMaterialData = 0,
    checkCreateDataUnitOrderMaterialData = 0,
    dataSpecificationMaterialData, isSaveUpdateMaterialData = 0,
    loadSpecificationCreateUnitMaterialData,
    optionRestaurantUnitMaterialDataCreateTemplate,
    optionRestaurantUnitMaterialDataCreateTemplateCurrent, selectUnitMaterialOption,
    optionRestaurantUnitOrderData,
    unitCreateSpecificationExchangeValue, unitSpecificationCreateExchangeValueOld,
    materialId, optionUnitCreateMaterial, optionSpecificationCreateMaterial, tableSellingUnit, optionUnitQuantity,
    unit_Sup;
$(function () {
    $(document).on('select2:open', '#material-supplier-create-material-data', function () {
        if ($('#supplier-create-material-data').val() == '' || $('#supplier-create-material-data').val() == null) {
            $('#supplier-create-material-data').parent().addClass('validate-error');
            $('#material-supplier-create-material-data').select2('close');
        }
    })
    $(document).on('select2:open', '#specifications-create-material-data', function () {
        if ($('#unit-create-material-data').val() == '' || $('#unit-create-material-data').val() == null) {
            $('#unit-create-material-data').parent().addClass('validate-error');
            $('#specifications-create-material-data').select2('close');
        }
    })
    $(document).on('change', '.select-unit-material-name', function (e) {
        let r = $(this);
        /**
         * Kiểm tra có phải vừa chọn để thêm vào option khác khi không chọn nữa
         */
        if (r.find('option:selected').attr('disabled') !== undefined) {
            r.parents('tr').find('td:eq(2)').text('---');
            return false;
        }
        if (r.find('option.check').val() !== undefined) {
            $('.select-unit-material-name').append('<option value="' + r.find('option.check').val() + '" >' + r.find('option.check').text() + '</option>');
            r.find('option.check').remove();
        }

        /**
         * Thêm class nhận biết cho thằng vừa chọn
         */
        r.find('option:selected').addClass('check');
        $('.select-unit-material-name').find('option[value="' + $(this).val() + '"]:not(:selected)').remove();
        let option = '';
        $('.select-unit-material-name:last option').each(function (v, e) {
            // if ($(this).val() !== r.val()) {
            if (!$(this).hasClass('check')) {
                option += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
            }
        });
        optionRestaurantUnitMaterialDataCreateTemplate = option;
        selectUnitMaterial($(this));
    })

    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateMaterial();
    });
})

async function openModalCreateMaterial() {
    $('#modal-create-material-data').modal('show');
    $('#select-specifications-create-unit-material-data ,#sub-inventory-create-material-data, #value-name-create-specifications-material-data ,#category-create-material-data,#unit-create-material-data,#specifications-create-material-data,#supplier-create-material-data,#material-supplier-create-material-data ').select2({
        dropdownParent: $('#modal-create-material-data'),
    });

    $('#specifications-create-material-data').on('change', function () {
        unitCreateSpecificationExchangeValue = $('#specifications-create-material-data').find('option:selected').attr('data-unit-value');
        unitSpecificationCreateExchangeValueOld = $('#specifications-create-material-data').find('option:selected').attr('data-unit-value');
        ;
        tableSellingUnit.rows().every(function () {
            let x = $(this.node());
            selectUnitMaterial(x.find('td:eq(0)').find('select'))
        })
    })

    $('#modal-calc-create-material-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalCreateMaterialData();
        });
    });

    $('#name-create-material-data').on('focusout', function () {
        if ($('#code-create-material-data').val() !== '') {
            removeErrorInput($('#code-create-material-data'));
        }
    });

    $('#category-create-material-data').on('select2:select', function () {
        checkCreateMaterialData = 1;
    });

    $('#name-create-material-data').on('change paste', function () {
        checkCreateMaterialData = 1;
        showRateCreateMaterialData();
        $('#code-create-material-data').val(removeVietnameseString($(this).val()).toUpperCase());
        $('#code-create-material-data').parents('.form-group').find('.error').remove()

    });

    $('#unit-create-material-data').unbind('select2:select').on('select2:select', async function () {
        if (tableSellingUnit.data().any()) {
            let title = 'Đổi đơn vị ?',
                content = 'Bạn có chắc chắn muốn đổi sang đơn vị khác ?',
                icon = 'question';
            sweetAlertComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    tableSellingUnit.clear().draw(false);
                    await dataSpecificationsCreateMaterialData();
                } else {
                    $(this).val(selectUnitMaterialOption).trigger('change.select2');
                }
            });
        } else {
            selectUnitMaterialOption = $(this).val()
            checkCreateMaterialData = 1;
            showRateCreateMaterialData();
            await dataSpecificationsCreateMaterialData();
            tableSellingUnit.rows().every(function () {
                let r = $(this.node());
                selectUnitMaterial(r);
            })
        }
        unitCreateSpecificationExchangeValue = $('#specifications-create-material-data').find('option:selected').attr('data-unit-value');
        unitSpecificationCreateExchangeValueOld = $('#specifications-create-material-data').find('option:selected').attr('data-unit-value');
    });

    $('#supplier-create-material-data').unbind('select2:select').on('select2:select', async function () {
        checkCreateMaterialData = 1;
        showRateCreateMaterialData();
        dataMaterialSupplierCreateMaterialData();
    });

    $('#material-supplier-create-material-data').on('change', async function () {
        unit_Sup = $(this).find('option:selected').attr('data-unit-specification');
        showRateCreateMaterialData();
    });

    $('#rate-supplier-create-material-data').on('input', async function () {
        checkCreateMaterialData = 1;
        showRateCreateMaterialData();
    });

    $('#supplier-create-material-data').on('select2:select', function () {
        $('#not-supplier-create-material').removeClass('d-none');
        $('#sub-title-brand-create-material-data').removeClass('d-none');
        $('#input-brand-create-material-data').removeClass('d-none');
        $('#rate-supplier-create-material-data-form').removeClass('d-none');
        $('#text-rate-supplier-create-material-data-form').removeClass('d-none');
    })

    $('#name-create-material-data').on('input keyup keydown', function () {
        if ($('#code-create-material-data').val() != '') {
            $('#code-create-material-data').parent().removeClass('validate-error');
            $('#code-create-material-data').parent().find('.error').remove();
        }
        $('#code-create-material-data').val(removeVietnameseStringLowerCase($(this).val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '')).toUpperCase());
        $('#code-create-material-data').parents('.form-group').find('.error').remove()
    })

    $('#code-create-material-data').on('input', function () {
        $(this).val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    })

    $('#name-create-unit-material-data').on('input', function () {
        if ($('#code-create-unit-material-data').val() != '') {
            $('#code-create-unit-material-data').parent().removeClass('validate-error');
            $('#code-create-unit-material-data').parent().find('.error').remove();
        }
    })
    $('#price-create-material-data').on('input', function () {
        tableSellingUnit.rows().every(function () {
            let x = $(this.node());
            selectUnitMaterial(x.find('td:eq(0)').find('select'))
        })
    })
    $('#price-create-material-data').on('paste', function (event) {
        event.preventDefault();
        let clipboardData = event.originalEvent.clipboardData || window.clipboardData;
        let pastedData = clipboardData.getData('text');
        let formattedVal = removeformatNumber(pastedData);
        $(this).val(formattedVal);
        tableSellingUnit.rows().every(function () {
            let x = $(this.node());
            selectUnitMaterial(x.find('td:eq(0)').find('select'))
        })
    });
    $('#name-create-specifications-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#value-exchange-create-specifications-data').select();
        }
    });

    $('#value-exchange-create-specifications-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#value-name-create-specifications-data').select2('open');
        }
    });

    $('#code-create-unit-material-data').on('input paste', function () {
        $(this).val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    })

    $('#modal-create-material-data input, #modal-create-material-data textarea').on('input', function () {
        $('#modal-create-material-data .btn-renew').removeClass('d-none')
    })

    $('#modal-create-material-data select').on('change', function () {
        $('#modal-create-material-data .btn-renew').removeClass('d-none')
    })

    shortcut.add('ESC', function () {
        closeModalCreateMaterialData();
    });
    shortcut.add('F4', function () {
        saveModalCreateMaterialData();
    });
    shortcut.remove('F2');

    // xử lý text của loại kho
    switch (parseInt($('#nav-material-data .nav-link.active').attr('data-tab'))) {
        case 0 :
            $('.sub-inventory-create-material-data').parents('.select-material-box').find('label div').html('Loại nguyên liệu');
            break;
        case 1 :
            $('.sub-inventory-create-material-data').parents('.select-material-box').find('label div').html('Loại hàng hoá')
            break;
        case 2 :
            $('.sub-inventory-create-material-data').parents('.select-material-box').find('label div').html('Loại nội bộ')
            break;
        case 3 :
            $('.sub-inventory-create-material-data').parents('.select-material-box').find('label div').html('Loại khác')
            break;
        default :
            $('.sub-inventory-create-material-data').parents('.select-material-box').find('label div').html('Loại nguyên liệu')
    }

    $('#not-supplier-create-material').addClass('d-none');
    $('#sub-title-brand-create-material-data').addClass('d-none');
    $('#input-brand-create-material-data').addClass('d-none');


    $('#btn-prev-create-material').addClass('d-none');
    $('#btn-next-create-material').removeClass('d-none');

    //reset modal
    $('#tab-size').addClass('modal-lg')
    $('#tab-size').removeClass('modal-md')
    $('#tab-info-create-material').removeClass('d-none');
    $('#tab-select-create-material').addClass('d-none');
    $('.modal-body-create-unit-material-data').addClass('d-none')
    $('.modal-body-create-specifications-material-data').addClass('d-none')
    $('#modal-body-create-material').removeClass('d-none')
    let opt4 = $('#opt4-sub-inventory-create-material-data').html(),
        opt5 = $('#opt5-sub-inventory-create-material-data').html(),
        opt14 = $('#opt14-sub-inventory-create-material-data').html(),

        opt8 = $('#opt8-sub-inventory-create-material-data').html(),
        opt9 = $('#opt9-sub-inventory-create-material-data').html(),
        opt10 = $('#opt10-sub-inventory-create-material-data').html(),
        opt15 = $('#opt15-sub-inventory-create-material-data').html(),

        opt11 = $('#opt11-sub-inventory-create-material-data').html(),
        opt16 = $('#opt16-sub-inventory-create-material-data').html(),

        opt6 = $('#opt6-sub-inventory-create-material-data').html(),
        opt13 = $('#opt13-sub-inventory-create-material-data').html(),
        opt17 = $('#opt17-sub-inventory-create-material-data').html(),
        opt18 = $('#opt18-sub-inventory-create-material-data').html(),
        opt19 = $('#opt19-sub-inventory-create-material-data').html(),
        opt20 = $('#opt20-sub-inventory-create-material-data').html(),
        opt21 = $('#opt21-sub-inventory-create-material-data').html(),
        opt22 = $('#opt22-sub-inventory-create-material-data').html(),
        opt23 = $('#opt23-sub-inventory-create-material-data').html();
    switch (inventoryCurrentMaterialData) {
        case 1:
            $('#sub-inventory-create-material-data').html(opt4 + opt5 + opt14);
            break;
        case 2:
            $('#sub-inventory-create-material-data').html(opt8 + opt9 + opt10 + opt15);
            break;
        case 3:
            $('#sub-inventory-create-material-data').html(opt11 + opt16);
            break;
        case 12:
            $('#sub-inventory-create-material-data').html(opt6 + opt17 + opt18 + opt19 + opt20 + opt21 + opt22 + opt23 + opt13);
            break;
    }

    // dataUnitCreateMaterialUnitFoodData();
    drawTableSellingUnit([]);
    dataSupplierCreateMaterialData();
    dataCategoryCreateMaterialData();
    await dataUnitCreateMaterialData();
    dataUnitOrderCreateMaterialData()
    saveCreateMaterialData = 0;
    dataSpecificationMaterialData = '';

}

async function drawTableSellingUnit(data) {
    let table = $('#table-selling-unit'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnOrder = [
            {data: 'material_unit_name', name: 'unit_name', className: 'text-center', width: "30%"},
            {data: 'exchange_value', name: 'exchange_value', className: 'text-center', width: "15%"},
            {
                data: 'material_unit_specification_exchange_name',
                name: 'material_unit_specification_exchange_name',
                className: 'text-left',
                width: "40%"
            },
            {
                data: 'material_unit_price_original',
                name: 'material_unit_price_original',
                className: 'text-right',
                width: "15%"
            },
            {data: 'action', name: 'action', className: 'text-center', width: "5%"},
        ],
        option = [{
            'title': 'Thêm đơn vị bán',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'addRowUnitPriceQuantity',
        }];
    tableSellingUnit = await DatatableTemplateNew(table, [], columnOrder, scroll_Y, fixed_left, fixed_right, option);
    $('#table-selling-unit').on('input', '.input-quantity-unit', function () {
        let quantity = removeformatNumber($(this).val());
        let price_sell = removeformatNumber($('#price-create-material-data').val());
        let ratio = removeformatNumber($('#specifications-create-material-data option:selected').attr('data-unit-value'));
        let price = Math.round((quantity * price_sell) / ratio);
        $(this).parents('tr').find('td:eq(3)').text(formatNumber(price));
    })
}

function selectUnitMaterial(r) {
    let unit = r.parents('tr').find('td:eq(0) select').find('option:selected').text();
    let quatity = r.parents('tr').find('td:eq(1) input').val();
    let description = '1 ' + unit + ' = ' + quatity + ' ' + $('#specifications-create-material-data option:selected').attr('data-unit-exchange-name')
    if (description.length > 27) description = description.substring(0, 27) + '...';
    let price = Math.round(removeformatNumber(quatity) * removeformatNumber($('#price-create-material-data').val()) / $('#specifications-create-material-data option:selected').attr('data-unit-value'))
    // price = price.toFixed(3).replace(/\.?0+$/, '');
    r.parents('tr').find('td:eq(3)').text(formatNumber(price))
    r.parents('tr').find('td:eq(2)').text(description)
}

async function dataCategoryCreateMaterialData() {
    let tab = '';
    switch (inventoryCurrentMaterialData) {
        case 1:
            tab = 'material'
            break;
        case 2:
            tab = 'goods'
            break;
        case 3:
            tab = 'internal'
            break;
        case 12:
            tab = 'orther'
            break;
    }

    if (optionsCategoryCreateMaterialData[tab].length <= 0) {
        let method = 'get',
            url = 'material-data.category',
            params = {inventory: inventoryCurrentMaterialData},
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#sub-inventory-create-material-data'), $('#category-create-material-data')]);
        optionsCategoryCreateMaterialData[tab] = res.data[0];
    }

    $('#category-create-material-data').html(optionsCategoryCreateMaterialData[tab]);
}

function addRowUnitPriceQuantity() {
    if (!checkValidateSave($('#modal-body-create-material'))) {
        $('#modal-body-create-material').scrollTop(0)
        return false
    }
    if(!tableSellingUnit.data().count()) {
        optionRestaurantUnitMaterialDataCreateTemplate = optionRestaurantUnitMaterialDataCreateTemplateCurrent
    }
    addRowDatatableTemplate(tableSellingUnit, {
        'material_unit_name': `<select class="js-example-basic-single select-unit-material-name" data-select="1">${optionRestaurantUnitMaterialDataCreateTemplate}</select>`,
        'exchange_value': `<div class="input-group border-group validate-table-validate">
                                <input class="form-control adjustment text-center rounded border-0 input-quantity-unit" data-type="currency-edit" data-max="999999" data-value-min-value-of="0" data-float="1" value="1">
                            </div>`,
        'material_unit_specification_exchange_name': '---',
        'material_unit_price_original': '0',
        'action': '<div class="btn-group btn-group-sm float-center">\n' +
            '     <button type="button" class="tabledit-edit-button seemt-red btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeRecordMaterialFood($(this))" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>\n' +
            '</div>',
    })
    let disabled_opt_first = $('.select-unit-material-name').last().find('option:first-child').attr('disabled');
    if (disabled_opt_first === undefined) {
        $('.select-unit-material-name').last().find('option:first-child').prop('disabled', true);
    }
    $('.select-unit-material-name').find('option[value="' + $('#unit-create-material-data').val() + '"]').remove();

    $(".select-unit-material-name:last").val($(".select-unit-material-name:last option:eq(1)").val()).trigger('change.select2');
    let option = '';
    $('.select-unit-material-name:last option').each(function (v, e) {
        if ($(this).val() !== $(".select-unit-material-name:last option:eq(1)").val()) {
            option += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
        }
    });
    if ($('.select-unit-material-name:last').find('option.check').val() !== undefined) {
        $('.select-unit-material-name').append('<option value="' + r.find('option.check').val() + '" >' + r.find('option.check').text() + '</option>');
        $('.select-unit-material-name:last').find('option.check').remove();
    }

    /**
     * Thêm class nhận biết cho thằng vừa chọn
     */
    $('.select-unit-material-name:last').find('option:selected').addClass('check');
    $('.select-unit-material-name').find('option[value="' + $('.select-unit-material-name:last').val() + '"]:not(:selected)').remove();

    optionRestaurantUnitMaterialDataCreateTemplate = option;
    selectUnitMaterial($('.select-unit-material-name').last())
    if ($(".select-unit-material-name:last option").length == 2) {
        $('#modal-body-create-material .toolbar-button-datatable').css({
            "transition": "all .2s linear",
            "opacity": "0.5",
            "pointer-events": "none"
        });
    }

}

function removeRecordMaterialFood(r) {

    tableSellingUnit.row(r.parents('tr')).remove().draw(false);
    $('#modal-body-create-material .toolbar-button-datatable').css({
        "transition": " ",
        "opacity": " ",
        "pointer-events": ""
    });
    if (tableSellingUnit.data().count() == 0) {
        optionRestaurantUnitMaterialDataCreateTemplate = optionRestaurantUnitMaterialDataCreateTemplateCurrent
    } else {
        let option = '<option value="' + r.parents('tr').find('td:eq(0)').find('select option:selected').val() + '">' + r.parents('tr').find('td:eq(0)').find('select option:selected').text() + '</option>';
        if (r.parents('tr').find('td:eq(0)').find('select option:selected').val() !== "") {
            $('.select-unit-material-name').append(option);
            optionRestaurantUnitMaterialDataCreateTemplate += option;
        }
    }

}

async function dataUnitCreateMaterialUnitFoodData() {
    let method = 'get',
        url = 'material-unit-food-data.unit',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#modal-create-material-unit-food-data')]);
    optionUnitQuantity = res.data[0];
}

async function dataUnitCreateMaterialData() {
    if (checkDataUnitMaterialData === 0) {
        if (checkCreateDataUnitMaterialData === 1) {
            return;
        }
        let method = 'get',
            url = 'material-data.unit',
            params = {
                id_material: $('#unit-create-material-data').val()
            },
            data = null;
        checkDataUnitMaterialData = 1;
        let res = await axiosTemplate(method, url, params, data, [$('#unit-create-material-data')]);
        checkDataUnitMaterialData = 0;
        checkCreateDataUnitMaterialData = 1
        optionUnitCreateMaterial = res.data[0];
        $('#unit-create-material-data').html(res.data[0]);
    }
}

async function dataUnitOrderCreateMaterialData() {
    if (checkDataUnitOrderMaterialData === 0) {
        if (checkCreateDataUnitOrderMaterialData === 1) {
            return
        }
            let method = 'get',
                url = 'material-data.unit-order',
                params = {},
                data = null;
            checkDataUnitOrderMaterialData = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#unit-create-material-data')]);
            checkDataUnitOrderMaterialData = 0;
        checkCreateDataUnitOrderMaterialData = 1
        optionRestaurantUnitOrderData = res.data[0]
        optionRestaurantUnitMaterialDataCreateTemplateCurrent = res.data[0]
        optionRestaurantUnitMaterialDataCreateTemplate = res.data[0]
    }
}


async function dataSpecificationsCreateMaterialData() {
    let method = 'get',
        url = 'material-data.specifications',
        unit = $('#unit-create-material-data').val(),
        params = {unit: unit},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#specifications-create-material-data')]);
    $('#specifications-create-material-data').html(res.data[0]);
    optionSpecificationCreateMaterial = res.data[0]
    $('#specifications-create-material-data').parent().removeClass('validate-error');
}

async function dataSupplierCreateMaterialData() {
    if (checkSupplierCreateMaterialData === 0) {
        if (checkCreateSupplierCreateMaterialData === 1) {
            return
        }

        let method = 'get',
            url = 'material-data.supplier',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#supplier-create-material-data')]);
        checkCreateSupplierCreateMaterialData = 1;
        $('#supplier-create-material-data').html(res.data[0]);
        checkSupplierCreateMaterialData = 1;
    }
}

async function dataSpecificationsUnitMaterialData(id) {
    if (checkDataUnitCreateUnitMaterialData === 0) {
        let url = 'unit-data.specifications',
            method = 'get',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#select-specifications-create-unit-material-data')]);
        checkDataUnitCreateUnitMaterialData = 1;
        $(`${id} #select-specifications-create-unit-material-data`).html(res.data[0]);
        loadSpecificationCreateUnitMaterialData = res.data[0];
    }
}

async function dataMaterialSupplierCreateMaterialData() {
    let method = 'get',
        url = 'material-data.material-supplier',
        supplier = $('#supplier-create-material-data').val(),
        params = {supplier: supplier},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#material-supplier-create-material-data')]);
    checkDataSupplierMaterialData = 1;
    $('#material-supplier-create-material-data').html(res.data[0]);
}

function showRateCreateMaterialData() {
    let nameRestaurant = $('#name-create-material-data').val(),
        unitRestaurant = $('#unit-create-material-data option:selected').text(),
        rate = $('#rate-supplier-create-material-data').val().replace(/[^0-9]/g, ''),
        nameSupplier = $('#material-supplier-create-material-data option:selected').text(),
        unitSupplier = unit_Sup;
    if (nameRestaurant === '' || $('#unit-create-material-data').val() === null || $('#material-supplier-create-material-data').val() === null) {
        $('#text-rate-supplier-create-material-data').text('---');
    } else {
        if (Number(rate) > 100) {
            rate = '100';
        } else if (rate === '') {
            rate = '0';
        }
        $('#text-rate-supplier-create-material-data').text('1 ' + nameRestaurant + '(' + unitRestaurant + ') = ' + rate + ' ' + nameSupplier + '[' + unitSupplier + ']');
    }
}

async function dataServerCreateSpecificationsData() {
    let url = 'specifications-data.data-server',
        method = 'get',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#value-name-create-specifications-material-data')]);
    $('.value-name-create-specifications-material-data').html(res.data[0]);
}


function closeModalCreateMaterialData() {
    $('#modal-create-material-data').modal('hide');
    $('#modal-create-material-data .btn-renew').addClass('d-none')
    // reset gán nguyên liệu
    $('#supplier-create-material-data').val('').trigger('change.select2');
    $('#material-supplier-create-material-data').val('').trigger('change.select2');

    $('#not-supplier-create-material').addClass('d-none');
    $('#sub-title-brand-create-material-data').addClass('d-none');
    $('#input-brand-create-material-data').addClass('d-none');
    $('#rate-supplier-create-material-data-form').addClass('d-none');
    $('#text-rate-supplier-create-material-data-form').addClass('d-none');
    shortcut.remove('ESC');
    resetModalCreateMaterialData();
    reloadModalCreateMaterial();
    countCharacterTextarea()
    optionRestaurantUnitMaterialDataCreateTemplate = optionUnitCreateMaterial

    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateMaterial();
    });
}

function resetModalCreateMaterialData() {
    $('.select-specifications-create-unit-material-data').val('').trigger('change');
    $('#category-create-material-data').val('').trigger('change.select2');
    $('#supplier-create-material-data').val('').trigger('change.select2');
    $('#unit-create-material-data').val(null).trigger('change');
    $('#specifications-create-material-data').html('<option disabled selected> Dữ liệu rỗng </option>');
    $('#material-supplier-create-material-data').html('<option disabled selected> Dữ liệu rỗng </option>');
    $('#tab-material-data-' + inventoryCurrentMaterialData).click();
    $('#modal-create-material-data input').val('');
    $('#modal-create-material-data textarea').val('');
    $('#rate-supplier-create-material-data').val('1');
    $('#price-create-material-data').val('100');
    $('#min-create-material-data').val('0');
    $('#loss-create-material-data').val('0');
    $('#map-create-material-data').prop('checked', false);
    $('#assign-brand-create-material-data').prop('checked', false);
    $('#div-assign-brand-create-material-data').addClass('d-none');
    $('#div-map-create-material-data').addClass('d-none');
    $('#text-rate-supplier-create-material-data').text('---');
    $('.title-h5-create-material').removeClass('d-none')
    $('.title-h5-create-unit').addClass('d-none')
    $('.title-h5-create-specifications').addClass('d-none')
    $('.title-h5-create-map').addClass('d-none');
    $('.calc-percent').remove();
    $('#btn-add-input-calc-quantity-loss').removeClass('d-none');
    $('#loss-average-all-create-material-data').text(0);
    $('#title-calc-loss-material').addClass('d-none');
    $('#modal-calc-create-material-data .btn-renew').addClass('d-none');
    removeAllValidate();
}

function prevModalCreateMaterial() {
    removeAllValidate();
    reloadModalCreateMaterial()
    if (!$('.modal-body-create-unit-material-data').hasClass('d-none') || !$('.modal-body-create-specifications-material-data').hasClass('d-none')) {  //dang o tao qc,dv
        $('.modal-body-create-unit-material-data').addClass('d-none');
        $('#modal-body-create-material').removeClass('d-none');
        $('.modal-body-create-specifications-material-data').addClass('d-none');
        $('#btn-next-create-material').removeClass('d-none');
        $('#btn-prev-create-material').addClass('d-none');

        //xóa input khi quay lại
        $('.modal-body-create-unit-material-data input').val('')
        $('.modal-body-create-unit-material-data textarea').val('')
        $('.modal-body-create-unit-material-data select').val(null).trigger('change');

        $('.modal-body-create-specifications-material-data input').val('')
        $('.modal-body-create-specifications-material-data textarea').val('')
        $('.modal-body-create-specifications-material-data #value-exchange-create-specifications-material-data').val(1)
        $('.modal-body-create-specifications-material-data select').val(null).trigger('change');

        //Đổi tiêu để modal
        $('#modal-create-material-data .title-h5-create-material').removeClass('d-none')
        $('#modal-create-material-data .title-h5-create-unit').addClass('d-none')
        $('#modal-create-material-data .title-h5-create-specifications').addClass('d-none')
        //--
    } else {
        // dang o gan nl
        $('#tab-info-create-material').removeClass('d-none');
        $('#tab-select-create-material').addClass('d-none');
        $('#btn-next-create-material').removeClass('d-none');
        $('#btn-prev-create-material').addClass('d-none');
        $('#tab-size').addClass('modal-lg')
        $('#tab-size').removeClass('modal-md')
        $('#modal-create-material-data .title-h5-create-material').removeClass('d-none')
        $('#modal-create-material-data .title-h5-create-map').addClass('d-none');
        $('#modal-create-material-data .btn-renew').removeClass('d-none');
    }

    if ($('#name-create-material-data').val() == '' && $('#code-create-material-data').val() == '' && $('#sub-inventory-create-material-data').val() == '4' && $('#category-create-material-data').val() == null && $('#unit-create-material-data').val() == null && $('#specifications-create-material-data').val() == null && $('#loss-create-material-data').val() == 0 && $('#min-create-material-data').val() == 0 && $('#min-create-material-data').val() == 100 && $('#des-create-material-data').val() == '') {
        $('.btn-renew').addClass('d-none')
    } else {
        $('.btn-renew').removeClass('d-none')
    }

}

function prevModalUpdateMaterial() {
    removeAllValidate();
    if (!$('.modal-body-create-unit-material-data').hasClass('d-none') || !$('.modal-body-create-specifications-material-data').hasClass('d-none')) {  //dang o tao qc,dv
        $('.modal-body-create-unit-material-data').addClass('d-none');
        $('#modal-body-update-material').removeClass('d-none');
        $('.modal-body-create-specifications-material-data').addClass('d-none');
        $('#btn-next-update-material').removeClass('d-none');
        $('#btn-prev-update-material').addClass('d-none');
        $('.modal-body-create-unit-material-data input').val('')
        $('.modal-body-create-unit-material-data textarea').val('')
        $('.modal-body-create-unit-material-data select').val(null).trigger('change');
        $('#modal-update-material-data .title-h5-update-material').removeClass('d-none')
        $('#modal-update-material-data .title-h5-create-unit').addClass('d-none')
        $('#modal-update-material-data .title-h5-create-specifications').addClass('d-none')
        $('#modal-update-material-data .title-h5-create-map').addClass('d-none')
        $('#modal-update-material-data .btn-renew').addClass('d-none');
        $('.name-create-specifications-material-data').val('');
        $('.value-exchange-create-specifications-material-data').val('');
        $('.value-name-create-specifications-material-data').val('').trigger('change.select2');
    }
}


function drawTableCreateMaterialData(data) {
    switch (data.category_type_parent_id) {
        case 1:
            addRowDatatableTemplate(dataTableMaterial, {
                'name': data.name,
                'is_office_material': data.is_office_material,
                'category_type_name': data.category_type_name,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            $('#total-record-material').text(parseInt($('#total-record-material').text()) + 1);
            break;
        case 2:
            addRowDatatableTemplate(dataTableGoods, {
                'name': data.name,
                'is_office_material': data.is_office_material,
                'category_type_name': data.category_type_name,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': '<div class="btn-group btn-group-sm text-center">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' + data.id + '" data-status="' + data.status + '" data-inventory="' + data.category_type_parent_name + '"  data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button><br>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' + data.id + '"  data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><i class="fi-rr-pencil"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' + data.id + ')"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                    '</div>',
                'keysearch': data.keysearch,
            });
            $('#total-record-goods').text(parseInt($('#total-record-goods').text()) + 1);
            break;
        case 3:
            addRowDatatableTemplate(dataTableInternal, {
                'name': data.name,
                'is_office_material': data.is_office_material,
                'category_type_name': data.category_type_name,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': '<div class="btn-group btn-group-sm text-center">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' + data.id + '" data-status="' + data.status + '" data-inventory="' + data.category_type_parent_name + '"  data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' + data.id + '"  data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><i class="fi-rr-pencil"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' + data.id + ')"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                    '</div>',
                'keysearch': data.keysearch,
            });
            $('#total-record-material-internal').text(parseInt($('#total-record-material-internal').text()) + 1);
            break;
        case 12:
            addRowDatatableTemplate(dataTableOther, {
                'name': data.name,
                'is_office_material': data.is_office_material,
                'category_type_name': data.category_type_name,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': '<div class="btn-group btn-group-sm text-center">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialData($(this))" data-id="' + data.id + '" data-status="' + data.status + '" data-inventory="' + data.category_type_parent_name + '"  data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-orange waves-effect waves-light" onclick="openModalUpdateMaterialData($(this))" data-id="' + data.id + '"  data-toggle="tooltip" data-placement="top" data-original-title="Chỉnh sửa"><i class="fi-rr-pencil"></i></button>' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light"  onclick="openModalDetailMaterialData(' + data.id + ')"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                    '</div>',
                'keysearch': data.keysearch,
            });
            $('#total-record-other').text(parseInt($('#total-record-other').text()) + 1);
            break;
    }
}

async function nextModalCreateMaterial() {
    if (checkValidateSave($('#tab-info-create-material'))) {
        $('#tab-info-create-material').addClass('d-none');
        $('#tab-select-create-material').removeClass('d-none');
        $('#btn-next-create-material').addClass('d-none');
        $('#btn-prev-create-material').removeClass('d-none');
        $('#tab-size').removeClass('modal-lg')
        $('#tab-size').addClass('modal-lg');
        $('#modal-create-material-data .title-h5-create-material').addClass('d-none')
        $('#modal-create-material-data .title-h5-create-map').removeClass('d-none')
        $('#modal-create-material-data .btn-renew').addClass('d-none');
    }
}

function openModalBodyCreate(type) {
    $('#value-exchange-create-specifications-material-data').val(1);
    switch (Number(type)) {
        case 1:
            $('#btn-next-create-material').addClass('d-none');
            $('.modal-body-create-unit-material-data').removeClass('d-none');
            $('#modal-body-create-material').addClass('d-none');
            $('.modal-body-create-specifications-material-data').addClass('d-none');
            $('#btn-prev-create-material').removeClass('d-none');
            $('#modal-create-material-data .title-h5-create-material').addClass('d-none')
            $('#modal-create-material-data .title-h5-create-unit').removeClass('d-none')
            dataSpecificationsUnitMaterialData('#modal-create-material-data');
            $('#name-create-unit-material-data').on('input paste keyup keydown', function () {
                $('#code-create-unit-material-data').val(removeVietnameseString($(this).val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '')).toUpperCase());
                removeErrorInput($('#code-create-unit-material-data'));
            });
            break;
        case 2:
            if ($('#unit-create-material-data').val() == '' || $('#unit-create-material-data').val() == null) {
                $('#unit-create-material-data').parent().addClass('validate-error');
                $('#specifications-create-material-data').select2('close');

                WarningNotify('Vui lòng chọn đơn vị');
            } else {

                let unit = $('#unit-create-material-data').val();
                $('#modal-create-material-data .unit-id-dnone-input').val(unit);

                $('#btn-next-create-material').addClass('d-none');
                $('.modal-body-create-unit-material-data').addClass('d-none');
                $('#modal-body-create-material').addClass('d-none');
                $('.modal-body-create-specifications-material-data').removeClass('d-none');

                $('#btn-prev-create-material').removeClass('d-none');

                $('#modal-create-material-data .title-h5-create-material').addClass('d-none')
                $('#modal-create-material-data .title-h5-create-specifications').removeClass('d-none')
                dataServerCreateSpecificationsData('#modal-create-material-data');
            }
            break;

        case 3: //tao don vi trong update
            $('#btn-save-update-material').removeClass('d-none');
            $('#btn-next-update-material').addClass('d-none');
            $('.modal-body-create-unit-material-data').removeClass('d-none');
            $('#modal-body-update-material').addClass('d-none');
            $('.modal-body-create-specifications-material-data').addClass('d-none');
            $('#btn-prev-update-material').removeClass('d-none');
            $('.name-create-unit-material-data').on('input paste', function () {
                $('.code-create-unit-material-data').val(removeVietnameseStringLowerCase($(this).val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '')).toUpperCase());
            });
            $('.code-create-unit-material-data').on('input paste', function () {
                $('.code-create-unit-material-data').val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
            });
            $('#modal-update-material-data .title-h5-update-material').addClass('d-none')
            $('#modal-update-material-data .title-h5-create-unit').removeClass('d-none')
            $('#modal-update-material-data .btn-renew').addClass('d-none');
            checkDataUnitCreateUnitMaterialData = 0
            dataSpecificationsUnitMaterialData('#modal-update-material-data');
            break;
        case 4:
            if ($('#unit-update-material-data').val() == '' || $('#unit-update-material-data').val() == null) {
                $('#unit-update-material-data').parent().addClass('validate-error');
                $('#specifications-create-material-data').select2('close');

                WarningNotify('Vui lòng chọn đơn vị');
            } else {

                $('.value-exchange-create-specifications-material-data').val(1);

                let unit = $('#unit-update-material-data').val();
                $('#modal-update-material-data .unit-id-dnone-input').val(unit);

                $('#btn-save-update-material').removeClass('d-none');
                $('#btn-next-update-material').addClass('d-none');
                $('.modal-body-create-unit-material-data').addClass('d-none');
                $('#modal-body-update-material').addClass('d-none');
                $('.modal-body-create-specifications-material-data').removeClass('d-none');

                $('#btn-prev-update-material').removeClass('d-none');

                $('#modal-update-material-data .title-h5-update-material').addClass('d-none')
                $('#modal-update-material-data .title-h5-create-specifications').removeClass('d-none')
                dataServerCreateSpecificationsData('#modal-update-material-data');
            }
            break;
        default:
    }

    if ($('#load-modal-body-create-unit-material-data input').val() == '' && $('#load-modal-body-create-unit-material-data textarea').val() == '') {
        $('.btn-renew').addClass('d-none')
    } else {
        $('.btn-renew').removeClass('d-none')
    }
}

async function saveModalCreateMaterial(r, next) {
    if ($('#modal-create-material-data #modal-body-create-material').hasClass('d-none')) {
        if ($('#modal-create-material-data .modal-body-create-specifications-material-data').hasClass('d-none')) {
            saveModalCreateUnitMaterialData(r);
        } else {
            saveModalCreateSpecificationsMaterialData(r);
        }
    } else {
        saveModalCreateMaterialData(next);
    }
}

async function saveModalUpdateMaterialData(r) {
    if ($('#modal-update-material-data #modal-body-update-material').hasClass('d-none')) {
        if ($('#modal-update-material-data .modal-body-create-specifications-material-data').hasClass('d-none')) {
            saveModalCreateUnitMaterialData(r);
        } else {
            saveModalCreateSpecificationsMaterialData(r);
        }

    } else {
        saveUpdateMaterialData();
    }
}

async function drawTableUpdateMaterialData(data) {
    let tableUpdateMaterialData = $('#table-update-material-order-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnOrder = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'supplier_name', name: 'supplier_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableOrder = await DatatableTemplateNew(tableUpdateMaterialData, data.data.data.original.data, columnOrder, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste', '#table-update-material-order-data_filter input', function () {
        let indexOrder = 1;
        dataTableOrder.rows({'search': 'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexOrder)
            indexOrder++;
        });
    })
}


async function saveModalCreateUnitMaterialData(r) {
    if (checkSaveCreateUnitData !== 0) return false;
    if (!checkValidateSave(r.parents('.modal').find('.modal-body-create-unit-material-data'))) {
        return false
    }
    let name = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data #name-create-unit-material-data').val() : $('#modal-update-material-data #name-create-unit-material-data').val(),
        code = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data #code-create-unit-material-data').val() : $('#modal-update-material-data #code-create-unit-material-data').val(),
        specifications = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data .select-specifications-create-unit-material-data').val() : $('#modal-update-material-data .select-specifications-create-unit-material-data').val(),
        description = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data #description-create-unit-material-data').val() : $('#modal-update-material-data #description-create-unit-material-data').val();
    checkSaveCreateUnitData = 1;
    let url = 'unit-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
            code: code,
            specifications: specifications,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#load-modal-body-create-unit-material-data')]);
    checkSaveCreateUnitData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            let idModal = r.parents('.modal').attr('id')
            if (idModal === 'modal-create-material-data') {
                $(`#unit-create-material-data`).find('option:first').removeAttr('selected');
                $(`#unit-create-material-data`).append('<option selected value="' + res.data.data.id + '">' + res.data.data.name + '</option>')
                await dataSpecificationsCreateMaterialData()
                $('.modal-body-create-unit-material-data').addClass('d-none');
                $('#modal-body-create-material').removeClass('d-none');
                $('.modal-body-create-specifications-material-data').addClass('d-none');
                $('#btn-next-create-material').removeClass('d-none');
                $('#btn-prev-create-material').addClass('d-none');
                $('#specifications-create-material-data').select2('open');

                //reset title modal
                $('#modal-create-material-data .title-h5-create-material').removeClass('d-none')
                $('#modal-create-material-data .title-h5-create-unit').addClass('d-none')
                $('#modal-create-material-data .title-h5-create-specifications').addClass('d-none')
            } else {
                $(`#unit-update-material-data`).find('option:first').removeAttr('selected');
                $(`#unit-update-material-data`).append('<option selected value="' + res.data.data.id + '">' + res.data.data.name + '</option>')
                await dataSpecificationsUpdateMaterialData()
                $('.modal-body-create-unit-material-data').addClass('d-none');
                $('#modal-body-update-material').removeClass('d-none');
                $('.modal-body-create-specifications-material-data').addClass('d-none');
                $('#btn-next-update-material').removeClass('d-none');
                $('#btn-prev-update-material').addClass('d-none');

                //reset title modal
                $('#modal-update-material-data .title-h5-update-material').removeClass('d-none')
                $('#modal-update-material-data .title-h5-create-unit').addClass('d-none')
                $('#modal-update-material-data .title-h5-create-specifications').addClass('d-none')
            }
            changeListUnitOrder()
            $('.modal-body-create-unit-material-data input').val('')
            $('.modal-body-create-unit-material-data textarea').val('')
            $('.modal-body-create-unit-material-data select').val(null).trigger('change');
            $('.modal-body-create-specifications-material-data input').val('')
            $('.modal-body-create-specifications-material-data textarea').val('')
            $('.modal-body-create-specifications-material-data select').val(null).trigger('change');
            r.parents('.modal').find('.modal-body-create-unit-material-data').find('select').find('option:firt').trigger('change.select2');
            r.parents('.modal').find('.modal-body-create-unit-material-data input').val('');
            r.parents('.modal').find('.modal-body-create-unit-material-data').find('textarea').val('');
            removeAllValidate();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function saveModalCreateSpecificationsMaterialData(r) {
    if (checkSaveCreateSpecificationsData !== 0) return false;
    let name = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data #name-create-specifications-material-data').val() : $('#modal-update-material-data #name-create-specifications-material-data').val(),
        unit = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data .unit-id-dnone-input').val() : $('#modal-update-material-data .unit-id-dnone-input').val(),
        value_ex = $('#modal-create-material-data').hasClass('show') ? removeformatNumber($('#modal-create-material-data #value-exchange-create-specifications-material-data').val()) : removeformatNumber($('#modal-update-material-data #value-exchange-create-specifications-material-data').val()),
        name_ex = $('#modal-create-material-data').hasClass('show') ? $('#modal-create-material-data #value-name-create-specifications-material-data').val() : $('#modal-update-material-data #value-name-create-specifications-material-data').val();
    if (!checkValidateSave(r.parents('.modal').find('.modal-body-create-specifications-material-data'))) {
        return false
    }
    checkSaveCreateSpecificationsData = 1;
    let url = 'material-data.create-specifications',
        method = 'post',
        params = null,
        data = {
            name: name,
            name_ex: name_ex,
            value_ex: value_ex,
            unit: unit
        };
    let res = await axiosTemplate(method, url, params, data, [$('#load-modal-body-create-specifications-material-data')]);
    checkSaveCreateSpecificationsData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            let idModal = r.parents('.modal').attr('id')
            if (idModal === 'modal-create-material-data') {
                $('#specifications-create-material-data').find('option:first').removeAttr('selected');
                $('#specifications-create-material-data').prepend('<option data-unit-exchange-name="' + res.data.data.material_unit_specification_exchange_name + '" data-unit-exchange-id="' + res.data.data.material_unit_specification_exchange_name_id + '" data-unit-value="' + res.data.data.exchange_value + '" selected value="' + res.data.data.id + '">' + res.data.data.name + ' ( ' + res.data.data.exchange_value + ' ' + res.data.data.material_unit_specification_exchange_name + ' )</option>')
                $('.modal-body-create-unit-material-data').addClass('d-none');
                $('#modal-body-create-material').removeClass('d-none');
                $('.modal-body-create-specifications-material-data').addClass('d-none');
                $('#btn-next-create-material').removeClass('d-none');
                $('#btn-prev-create-material').addClass('d-none');

                //reset title modal
                $('#modal-create-material-data .title-h5-create-material').removeClass('d-none')
                $('#modal-create-material-data .title-h5-create-unit').addClass('d-none')
                $('#modal-create-material-data .title-h5-create-specifications').addClass('d-none')
            } else {
                $('#specifications-create-material-data').find('option:first').removeAttr('selected');
                $('#specifications-create-material-data').prepend('<option data-unit-exchange-name="' + res.data.data.material_unit_specification_exchange_name + '" data-unit-exchange-id="' + res.data.data.material_unit_specification_exchange_name_id + '" data-unit-value="' + res.data.data.exchange_value + '" selected value="' + res.data.data.id + '">' + res.data.data.name + ' ( ' + res.data.data.exchange_value + ' ' + res.data.data.material_unit_specification_exchange_name + ')</option>')
                $('.modal-body-create-unit-material-data').addClass('d-none');
                $('#modal-body-update-material').removeClass('d-none');
                $('.modal-body-create-specifications-material-data').addClass('d-none');
                $('#btn-next-update-material').removeClass('d-none');
                $('#btn-prev-update-material').addClass('d-none');

                //reset title modal
                $('#modal-update-material-data .title-h5-update-material').removeClass('d-none')
                $('#modal-update-material-data .title-h5-create-unit').addClass('d-none')
                $('#modal-update-material-data .title-h5-create-specifications').addClass('d-none')
                //--
                $('#specifications-update-material-data').append('<option data-unit-exchange-name="' + res.data.data.material_unit_specification_exchange_name + '" data-unit-exchange-id="' + res.data.data.material_unit_specification_exchange_name_id + '" data-unit-value="' + res.data.data.exchange_value + '" selected value="' + res.data.data.id + '">' + res.data.data.name + ' ( ' + res.data.data.exchange_value + ' ' + res.data.data.material_unit_specification_exchange_name + ' )</option>')
                changeListUnitOrder()
            }

            //xóa input sau khi thêm
            $('.modal-body-create-unit-material-data input').val('')
            $('.modal-body-create-unit-material-data textarea').val('')
            $('.modal-body-create-unit-material-data select').val(null).trigger('change');

            $('.modal-body-create-specifications-material-data input').val('')
            $('.modal-body-create-specifications-material-data textarea').val('')
            $('.modal-body-create-specifications-material-data select').val(null).trigger('change');
            //--
            removeAllValidate();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function saveModalCreateMaterialData(next) {
    if (saveCreateMaterialData !== 0) {
        return false;
    }
    if (tableSellingUnit.rows().count() == 0) {
        WarningNotify('Vui lòng thêm đơn vị bán');
        return false;
    }
    let id, is_office_material;
    let category = $('#category-create-material-data').val(),
        unit = $('#unit-create-material-data').val(),
        material_category_type_id = $('#sub-inventory-create-material-data').val(),
        specifications = $('#specifications-create-material-data').val(),
        name = $('#name-create-material-data').val(),
        code = $('#code-create-material-data').val(),
        price = removeformatNumber($('#price-create-material-data').val()),
        min = removeformatNumber($('#min-create-material-data').val()),
        lose = removeformatNumber($('#loss-create-material-data').val()),
        status = 1,
        des = $('#des-create-material-data').val(),
        supplier = $('#supplier-create-material-data').val(),
        supplier_material = $('#material-supplier-create-material-data').val(),
        rate = removeformatNumber($('#rate-supplier-create-material-data').val())
    if ($('#tab-select-create-material').hasClass('d-none')) { //step 1
        id = $('#tab-info-create-material')
        supplier = null;
        supplier_material = null;
        rate = 1;
    } else {
        id = $('#tab-select-create-material')
    }
    if (!checkValidateSave(id)) {
        return false
    }
    if ($('#is-office-create-material-data').is(':checked')) {
        is_office_material = 1;
    } else is_office_material = 0;
    saveCreateMaterialData = 1;

    let dataUnitFood = [];
    await tableSellingUnit.rows().every(function () {
        let r = $(this.node());
        dataUnitFood.push({
            "id": r.find('td:eq(0) select').find('option:selected').val(),
            "exchange_value": removeformatNumber(r.find('td:eq(1) input').val())
        })
    })
    let method = 'post',
        url = 'material-data.create',
        params = null,
        data = {
            price: price,
            name: name,
            code: code,
            material_unit_id: unit,
            material_unit_specification_id: specifications,
            material_category_id: category,
            out_stock_alert_quantity: min,
            wastage_rate: lose,
            description: des,
            material_category_type_id: material_category_type_id,
            status: status,
            supplier: supplier,
            supplier_material: supplier_material,
            rate: rate,
            data_unit: dataUnitFood,
            is_office_material: is_office_material
        };
    let res = await axiosTemplate(method, url, params, data, [$('#modal-body-create-material')]);

    saveCreateMaterialData = 0;
    switch (res.data[0].status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            if (next === 1) {
                recreateModalCreateMaterial()
            } else {
                closeModalCreateMaterialData()
            }
            drawTableCreateMaterialData(res.data[0].data)
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data[0].message);
    }
}

function reloadModalCreateMaterial() {
    if (!$('#modal-body-create-material').hasClass('d-none')) {
        if (!$('#tab-info-create-material').hasClass('d-none')) {
            $('#name-create-material-data').val('')
            $('#code-create-material-data').val('')
            $('#loss-create-material-data').val('0')
            $('#price-create-material-data').val('100')
            $('#min-create-material-data').val('0')
            $('#des-create-material-data').val('')
            $('#sub-inventory-create-material-data').val($('#sub-inventory-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#category-create-material-data').val($('#category-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#unit-create-material-data').val($('#category-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#specifications-create-material-data').html('<option disabled selected>Dữ liệu rỗng</option>');
            $('#supplier-create-material-data').val($('#supplier-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#material-supplier-create-material-data').val($('#material-supplier-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#rate-supplier-create-material-data').val('1');
            tableSellingUnit.clear().draw(false);
        }
    }

    if (!$('#load-modal-body-create-specifications-material-data').hasClass('d-none')) {
        $('#name-create-specifications-material-data').val('');
        $('#value-exchange-create-specifications-material-data').val('1');
        $('#value-name-create-specifications-material-data').val($('#value-name-create-specifications-material-data').find('option:first-child').val()).trigger('change.select2');
    }

    if (!$('#load-modal-body-create-unit-material-data').hasClass('d-none')) {
        $('#name-create-unit-material-data').val('');
        $('#code-create-unit-material-data').val('');
        $('#select-specifications-create-unit-material-data').val('').trigger('change');
        $('#description-create-unit-material-data').val('');
    }
    $('#modal-create-material-data .btn-renew').addClass('d-none');
    $('#is-office-create-material-data').prop('checked', false);
    removeAllValidate();
    $('#modal-body-create-material').scrollTop(0)
}

function recreateModalCreateMaterial() {
    if (!$('.modal-body-create-unit-material-data').hasClass('d-none') || !$('.modal-body-create-specifications-material-data').hasClass('d-none')) {  //dang o tao qc,dv
        $('.modal-body-create-unit-material-data').addClass('d-none');
        $('#modal-body-create-material').removeClass('d-none');
        $('.modal-body-create-specifications-material-data').addClass('d-none');
        $('#btn-next-create-material').removeClass('d-none');
        $('#btn-prev-create-material').addClass('d-none');

        //xóa input khi quay lại
        $('.modal-body-create-unit-material-data input').val('')
        $('.modal-body-create-unit-material-data textarea').val('')
        $('.modal-body-create-unit-material-data select').val(null).trigger('change');

        $('.modal-body-create-specifications-material-data input').val('')
        $('.modal-body-create-specifications-material-data textarea').val('')
        $('.modal-body-create-specifications-material-data #value-exchange-create-specifications-material-data').val(1)
        $('.modal-body-create-specifications-material-data select').val(null).trigger('change');

        //Đổi tiêu để modal
        $('#modal-create-material-data .title-h5-create-material').removeClass('d-none')
        $('#modal-create-material-data .title-h5-create-unit').addClass('d-none')
        $('#modal-create-material-data .title-h5-create-specifications').addClass('d-none')
        //--
    } else {
        // dang o gan nl
        $('#tab-info-create-material').removeClass('d-none');
        $('#tab-select-create-material').addClass('d-none');
        $('#btn-next-create-material').removeClass('d-none');
        $('#btn-prev-create-material').addClass('d-none');
        $('#tab-size').addClass('modal-lg')
        $('#tab-size').removeClass('modal-md')
        $('#modal-create-material-data .title-h5-create-material').removeClass('d-none')
        $('#modal-create-material-data .title-h5-create-map').addClass('d-none');
        $('#modal-create-material-data .btn-renew').removeClass('d-none');
    }

    if ($('#name-create-material-data').val() == '' && $('#code-create-material-data').val() == '' && $('#sub-inventory-create-material-data').val() == '4' && $('#category-create-material-data').val() == null && $('#unit-create-material-data').val() == null && $('#specifications-create-material-data').val() == null && $('#loss-create-material-data').val() == 0 && $('#min-create-material-data').val() == 0 && $('#min-create-material-data').val() == 100 && $('#des-create-material-data').val() == '') {
        $('.btn-renew').addClass('d-none')
    } else {
        $('.btn-renew').removeClass('d-none')
    }

    if (!$('#modal-body-create-material').hasClass('d-none')) {
        if (!$('#tab-info-create-material').hasClass('d-none')) {
            $('#name-create-material-data').val('')
            $('#code-create-material-data').val('')
            $('#loss-create-material-data').val('0')
            $('#price-create-material-data').val('100')
            $('#min-create-material-data').val('0')
            $('#des-create-material-data').val('')
            $('#sub-inventory-create-material-data').val($('#sub-inventory-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#category-create-material-data').val($('#category-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#unit-create-material-data').val($('#category-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#specifications-create-material-data').html('<option disabled selected>Dữ liệu rỗng</option>');
            $('#supplier-create-material-data').val($('#supplier-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#material-supplier-create-material-data').val($('#material-supplier-create-material-data').find('option:first-child').val()).trigger('change.select2');
            $('#rate-supplier-create-material-data').val('1');
            tableSellingUnit.clear().draw(false);
        }
    }
    $('#modal-create-material-data .btn-renew').addClass('d-none')

}
