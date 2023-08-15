let checkSaveCreateUnitData = 0,
    checkSaveCreateSpecificationsData = 0,
    loadDataSpecificationUnitData = 0,
    loadDataCreateSpecificationsData = 0,
    tableCreateSpecificationUnitData,
    tableCreateSpecificationUnitDataSelected,
    loadSpecificationsCreateData,
    dataArraySpecificationsUnitData= [];
    checkDataSpecificationsUnitData = 0;
$(function () {
    shortcut.add('F2', function () {
        openModalCreateUnitData();
    });
    $('#select-specifications-create-unit-data').on('change', function () {
        $('#modal-create-unit-data .btn-renew').removeClass('d-none')
    })
    $('#create-unit-data input, #create-unit-data textarea').on('input', function () {
        $('#modal-create-unit-data .btn-renew').removeClass('d-none')
    })
    $('#create-specifications-data input').on('input', function () {
        $('#modal-create-unit-data .btn-renew').removeClass('d-none')
    })
    $('#code-create-unit-data').on('input', function () {
        $('#code-create-unit-data').val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    })

    $('#name-create-unit-data').on('keydown keyup input paste', function (e) {
        if (e.keyCode === 13) {
            $('#select-specifications-create-unit-data').select2('open');
        }
        if ($('#code-create-unit-data').val() != '') {
            $('#code-create-unit-data').parent().removeClass('validate-error');
            $('#code-create-unit-data').parent().find('.error').remove();
            removeErrorInput($('#code-create-unit-data'));
        }
        if (removeVietnameseStringLowerCase($(this).val()).length > 50) {
            $('#code-create-unit-data').val($(this).val().slice(0, 50))
        }
        $('#code-create-unit-data').val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    });
})

async function openModalCreateUnitData() {
    $('#modal-create-unit-data').modal('show');
    shortcut.remove("F2");
    shortcut.add('F4', function () {
        saveModalCreateUnitData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateUnitData();
    });
    checkSaveCreateUnitData = 0;
    $('#modal-create-unit-data text, #modal-create-unit-data textarea').val('');
    $('#select-specifications-create-unit-data,#value-name-create-specifications-data').select2({
        dropdownParent: $('#modal-create-unit-data'),
    })
    if(dataArraySpecificationsUnitData.length > 0) {
        drawTableSpecificationsCreateUnitData(dataArraySpecificationsUnitData)
        loadSpecificationsCreateData = dataArraySpecificationsUnitData;
    } else {
        dataSpecificationsUnitData()
    }
}

async function dataSpecificationsUnitData() {
        let url = 'unit-data.specifications',
            method = 'get',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#table-create-unit-data')]);
        dataArraySpecificationsUnitData = res.data[1].original.data;
        drawTableSpecificationsCreateUnitData(res.data[1].original.data)
        loadSpecificationsCreateData =res.data[1].original.data;
}

async function drawTableSpecificationsCreateUnitData(data) {
    let id = $('#table-create-unit-data'),
        id_selected = $('#table-create-unit-data-selected'),
        fixed_left = 2,
        fixed_right = 2,
        column1 = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'check-box', name: 'check-box', className: 'text-right', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ],
        column2 = [
            {data: 'check-box', name: 'check-box', className: 'text-left', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none', width: '5%'},
        ];

    tableCreateSpecificationUnitData = await DatatableTemplateNew(id, data, column1, '30vh', fixed_left, fixed_right);
    tableCreateSpecificationUnitDataSelected = await DatatableTemplateNew(id_selected, [], column2, '30vh', fixed_left, fixed_right);
}

async function checkSpecifications(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(0)').html(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-left  pointer"  onclick="unCheckSpecifications($(this))"  data-id="' + r.attr('data-id') + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.parents('tr').find('td:eq(2)').text(),
    };

    addRowDatatableTemplate(tableCreateSpecificationUnitDataSelected, item);
    tableCreateSpecificationUnitData.row(r.parents('tr')).remove().draw(false);
}

async function unCheckSpecifications(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(1)').html(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-left  pointer"  onclick="checkSpecifications($(this))"  data-id="' + r.attr('data-id') + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.parents('tr').find('td:eq(2)').text(),
    };

    addRowDatatableTemplate(tableCreateSpecificationUnitData, item);
    tableCreateSpecificationUnitDataSelected.row(r.parents('tr')).remove().draw(false);
}

async function checkAllSpecifications() {
    addAllRowDatatableTemplate(tableCreateSpecificationUnitData, tableCreateSpecificationUnitDataSelected, itemSpecificationsSelected);
}

async function unCheckAllSpecifications() {
    addAllRowDatatableTemplate(tableCreateSpecificationUnitDataSelected, tableCreateSpecificationUnitData, itemSpecifications);
}

function itemSpecificationsSelected(r) {

    return {
        'name': r.find('td:eq(0)').text(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-right  pointer"  onclick="unCheckSpecifications($(this))"  data-id="' + r.find('td:eq(1) button').attr('data-id') + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
            '</div>',
        'keysearch': r.find('td:eq(2)').text(),
    };
}

function itemSpecifications(r) {
    return {
        'name': r.find('td:eq(1)').text(),
        'check-box': '<div class="btn-group btn-group-sm">\n' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-right-to-left  pointer"  onclick="checkSpecifications($(this))"  data-id="' + r.find('td:eq(0) button').attr('data-id') + '" ><i class="fi-rr-arrow-small-right" ></i></button>\n' +
            '</div>',
        'keysearch': r.find('td:eq(2)').text(),
    };
}

async function saveCreateUnitData() {
    if (checkSaveCreateUnitData === 1) return false;
    if (!checkValidateSave($('#create-unit-data'))) return false;
    if (tableCreateSpecificationUnitDataSelected.rows().count() < 1) {
        WarningNotify('Vui lòng chọn quy cách ');
        return false;
    }
    let name = $('#name-create-unit-data').val(),
        code = $('#code-create-unit-data').val(),
        specifications = [],
        description = $('#description-create-unit-data').val();
    checkSaveCreateUnitData = 1;
    await tableCreateSpecificationUnitDataSelected.rows().every(function () {
        let x = $(this.node());
        specifications.push(x.find('td:eq(0) button').attr('data-id'))
    })
    let url = 'unit-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
            code: code,
            specifications: specifications,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#create-unit-data')]);
    checkSaveCreateUnitData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateUnitData();
            $('#select-specifications-create-unit-data').val('').trigger('change.select2');
            drawDataTableUnit(res.data.data);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function saveCreateSpecificationsData() {
    if (checkSaveCreateSpecificationsData === 1) return false;
    let name = $('#name-create-specifications-data').val(),
        value_ex = removeformatNumber($('#value-exchange-create-specifications-data').val()),
        name_ex = $('#value-name-create-specifications-data').val();
    if (!checkValidateSave($('#create-specifications-data'))) {
        return false
    }
    checkSaveCreateSpecificationsData = 1;
    let url = 'specifications-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
            name_ex: name_ex,
            value_ex: value_ex,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#create-specifications-data')]);
    checkSaveCreateSpecificationsData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            let item = {
                'name': `${res.data.data.name} (${res.data.data.exchange_value} ${res.data.data.material_unit_specification_exchange_name})`,
                'check-box': '<div class="btn-group btn-group-sm">\n' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light  btn-convert-left-to-left  pointer"  onclick="unCheckSpecifications($(this))"  data-id="' + res.data.data.id + '" ><i class="fi-rr-arrow-small-left" ></i></button>\n' +
                    '</div>',
                'keysearch': res.data.data.name,
            };
            addRowDatatableTemplate(tableCreateSpecificationUnitDataSelected, item);
            // dataSpecificationsUnitData()
            //xóa value input
            $('#name-create-specifications-data').val('');
            $('#value-exchange-create-specifications-data').val(1)
            $('#value-name-create-specifications-data').val('').trigger('change.select2');
            //đóng xóa value input
            $('#btn-prev-create-specifications').addClass('d-none')
            $('#btn-close-create-specifications').removeClass('d-none')
            $('.create-specifications-data').addClass('d-none')
            $('.create-unit-data').removeClass('d-none')
            $('#select-specifications-create-unit-data').prepend('<option value="' + res.data.data.id + '" data-unit-id="' + res.data.data.material_unit_specification_exchange_name_id + '" selected>' + res.data.data.name + ' ' + '(' + res.data.data.exchange_value + res.data.data.material_unit_specification_exchange_name + ')' + '</option>');
            $('#select-specifications-create-unit-data option[value="-1"]').remove();
            $('#modal-create-unit-data').children('.modal-dialog').addClass('modal-xl')
            $('#modal-create-unit-data').children('.modal-dialog').removeClass('modal-md')
            $('#btn-create-specifications').removeClass('d-none')
            // $('#select-specifications-create-unit-data [data-unit-id!="'+ $('#select-specifications-create-unit-data option:selected').attr('data-unit-id') +'"]').remove();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function saveModalCreateUnitData() {
    if ($('.create-specifications-data').hasClass('d-none')) {
        saveCreateUnitData()
    } else {
        saveCreateSpecificationsData()
    }
}

function drawDataTableUnit(data) {
    addRowDatatableTemplate(dataTableUnitEnable, {
        'name': data.name,
        'specifications': data.specifications,
        'description': data.description,
        'action': data.action,
        'keysearch': data.keysearch,
    });
    $('#total-record-enable').text(formatNumber(removeformatNumber($('#total-record-enable').text()) + 1));
}

function prevCreateSpecifications() {
    $('#value-name-create-specifications-data').find('option:first').trigger('change.select2');
    $('#btn-prev-create-specifications').addClass('d-none')
    $('.create-specifications-data').addClass('d-none')
    $('.create-unit-data').removeClass('d-none')
    $('#btn-close-create-specifications').removeClass('d-none')
    if ($('#create-unit-data input').val() == '' && $('#create-unit-data textarea').val() == '') {
        $('.btn-renew').addClass('d-none')
    } else {
        $('.btn-renew').removeClass('d-none')
    }
    $('#modal-create-unit-data').children('.modal-dialog').removeClass('modal-md')
    $('#modal-create-unit-data').children('.modal-dialog').addClass('modal-xl')
    $('#btn-create-specifications').removeClass('d-none')

}

function openCreateSpecificationsData() {
    removeAllValidate();
    $('#modal-create-unit-data').children('.modal-dialog').removeClass('modal-xl')
    $('#modal-create-unit-data').children('.modal-dialog').addClass('modal-md')
    $('#btn-create-specifications').addClass('d-none')
    $('#btn-prev-create-specifications').addClass('d-none')
    $('.create-specifications-data').addClass('d-none')
    $('.create-unit-data').removeClass('d-none')
    $('#btn-close-create-specifications').removeClass('d-none')
    dataServerCreateSpecificationsData()
    $('.create-specifications-data').removeClass('d-none')
    $('.create-unit-data').addClass('d-none')
    $('#btn-prev-create-specifications').removeClass('d-none')
    if ($('#name-create-specifications-data').val() == '' && $('#create-specifications-data select').val() == null && $('#value-exchange-create-specifications-data').val() == '1') {
        $('#modal-create-unit-data .btn-renew').addClass('d-none')
    } else {
        $('#modal-create-unit-data .btn-renew').removeClass('d-none')
    }
}

async function dataServerCreateSpecificationsData() {
    if (loadDataCreateSpecificationsData === 0) {
        let url = 'specifications-data.data-server',
            method = 'get',
            params = null,
            data = null;
        let res = await axiosTemplate(method, url, params, data, [$('#value-name-create-specifications-data')]);
        loadDataCreateSpecificationsData = 1;
        $('#value-name-create-specifications-data').html(res.data[0]);
    }
}

function closeModalCreateUnitData() {
    $('#modal-create-unit-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateUnitData();
    });
    prevCreateSpecifications();
    $('#modal-create-unit-data input').val('');
    $('#description-create-unit-data').val('');
    $('#value-exchange-create-specifications-data').val('1');
    $('#btn-prev-create-specifications').addClass('d-none')
    $('.create-specifications-data').addClass('d-none')
    $('.create-unit-data').removeClass('d-none')
    $('#btn-close-create-specifications').removeClass('d-none')
    $('#select-specifications-create-unit-data').val('').trigger('change');
    $('#name-create-specifications-data').val('')
    $('#value-name-create-specifications-data').val(null).trigger('change')
    $('#modal-create-unit-data .btn-renew').addClass('d-none')
    tableCreateSpecificationUnitData.clear().draw();
    tableCreateSpecificationUnitDataSelected.clear().draw();
    countCharacterTextarea()
}

function resetModalCreateUnitData() {
    if ($('.create-specifications-data').hasClass('d-none')) {
        removeAllValidate();
        $('#modal-create-unit-data input').val('');
        $('#description-create-unit-data').val('');
        $('#value-exchange-create-specifications-data').val('1');
        $('#btn-prev-create-specifications').addClass('d-none')
        $('.create-specifications-data').addClass('d-none')
        $('.create-unit-data').removeClass('d-none')
        $('#btn-close-create-specifications').removeClass('d-none')
        $('#select-specifications-create-unit-data').val('').trigger('change');
        $('#modal-create-unit-data .btn-renew').addClass('d-none')
    } else if ($('.create-unit-data').hasClass('d-none')) {
        $('#name-create-specifications-data').val('')
        $('#value-exchange-create-specifications-data').val('1');
        $('#value-name-create-specifications-data').val(null).trigger('change')
        $('#modal-create-unit-data .btn-renew').addClass('d-none')

    }


}

