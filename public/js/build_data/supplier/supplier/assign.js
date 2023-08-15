let drawTableSelectedSupplierMaterial, dataMaterialAssigned = [], dataMaterialNotAssign = [],
    saveSupplierMaterialData = 0, drawTableAllMaterial, idSupplierData, checkDeleteMaterialBookSupplier = 0;

$(function () {
    $('#select-supplier-in-supplier-material-data').on('change', function () {
        loadSupplierHandBookMaterial($(this).val());
        dataTableAllMaterial(dataMaterialNotAssign)

    });
})

async function openModalUpdateSupplierMaterialData() {
    idSupplierData = $('#table-enable-supplier-data tbody tr:first-child').find('td:eq(3)').find('.seemt-btn-hover-green').attr('data-id');
    loadRestaurantMaterial(dataMaterialNotAssign);
    $('#modal-assign-system-supplier-data').modal('show');
    addLoading('supplier-material-data.get-restaurant-material');
    addLoading('supplier-material-data.assign-restaurant-material');
    shortcut.add('F4', function () {
        assignRestaurantMaterialData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateSupplierMaterialData();
    });
    $('#modal-assign-system-supplier-data .js-example-basic-single').select2({
        dropdownParent: $('#modal-assign-system-supplier-data')
    });
    await getSupplierData();
    $('#select-supplier-in-supplier-material-data').val(idSupplierData).trigger('change.select2');
    loadSupplierHandBookMaterial(idSupplierData);
}

async function loadRestaurantMaterial() {
    let method = 'get',
        url = 'supplier-material-data.get-restaurant-material',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-restaurant-material-body')]);
    dataTableAllMaterial(res.data[0].original.data);
    dataMaterialNotAssign = res.data[0].original.data;
    if (res.data[0].original.data.length > 0) {
        $('#btn-check-all-material-supplier-data').removeClass('d-none')
    }

}

async function loadSupplierHandBookMaterial(id) {
    let method = 'get',
        url = 'supplier-material-data.get-supplier-book-hand-material',
        params = {
            supplier_id: id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-supplier-in-supplier-material-data'), $('#table-supplier-material-data')]);
    dataTableSelectedMaterialBySupplier(res.data[0].original.data)
    if (res.data[0].original.data.length > 0) {
        $('#btn-uncheck-all-material-supplier-data').addClass('d-none')
    }

}


async function dataTableAllMaterial(data) {
    let id = $('#table-restaurant-material-data'), scroll_Y = '40vh', fixed_left = 0, fixed_right = 2,
        column = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'unit_full_name', name: 'unit_full_name', className: 'text-left'},
            {data: 'checkbox', name: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},
        ];
    let option = [];
    drawTableAllMaterial = await DatatableTemplateNew(id, data, column, scroll_Y, fixed_left, fixed_right, option, '', false);
}

async function getSupplierData() {
    let method = 'get',
        url = 'supplier-material-data.get-supplier',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-supplier-in-supplier-material-data').html(res.data[0]);
}

async function dataTableSelectedMaterialBySupplier(data) {
    let id = $('#table-supplier-material-data'),
        vh_of_table = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'checkbox', name: 'checkbox', className: 'text-center', width: '1%'},
            {data: 'name', name: 'name', className: 'text-left py-2', width: '30%'},
            {data: 'price', name: 'price', className: 'text-center', width: '25%'},
            {data: 'retail_price', name: 'retail_price', className: 'text-center', width: '25%'},
            {data: 'out_stock', name: 'out_stock', className: 'text-center', width: '1%'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    let option = [];
    drawTableSelectedSupplierMaterial = await DatatableTemplateNew(id, data, column, vh_of_table, fixed_left, fixed_right, option, '', false);
}

async function checkRestaurantMaterialBySupplier(r) {
    let item = {
        'checkbox': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" data-type="' + r.data('type') + '"  data-id="' + r.data('id') + '" data-price="' + r.data('price') + '" data-name="' + r.data('name') + '" data-unit-specification="' + r.data('unit-specification') + '" data-unit-id="' + r.data('unit-id') + '" data-unit-full-name="' + r.data('unit-full-name') + '" data-category="' + r.data('category') + '" onclick="unCheckRestaurantMaterialBySupplier($(this))" >' +
            '<i class="fi-rr-arrow-small-left"></i>'
            + '</button> </div>',
        'name': '<label>' + r.data('name') + '</label>',
        'price': '<div class="input-group border-group validate-table-validate">\n' +
            '        <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-max="100000000" data-type="currency-edit" value="' + r.data('price') + '"></div>',
        'retail_price': '<div class="input-group border-group validate-table-validate">' +
            '               <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-max="100000000" data-type="currency-edit" value="' + r.data('price') + '"></div>',
        'wholesale_price': '<div class="input-group border-group validate-table-validate">' +
            '                   <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-type="currency-edit" value="' + r.data('price') + '"></div>',
        'quantity': '<div class="input-group border-group validate-table-validate">' +
            '           <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-max="999999" data-type="currency-edit" value="1"></div>',
        'out_stock': '<div class="input-group border-group validate-table-validate">' +
            '           <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-max="100000" data-type="currency-edit" value="1"></div>',
        'action': '',
        'keysearch': r.data('name') + removeformatNumber(r.data('price')) + removeVietnameseStringLowerCase(String(r.data('name') + removeformatNumber(r.data('price')))),
    };
    addRowDatatableTemplate(drawTableSelectedSupplierMaterial, item);
    drawTableAllMaterial.row(r.parents('tr')).remove().draw(false);
    $('#btn-uncheck-all-material-supplier-data').removeClass('d-none')
    if (!checkCountRecordTableAllMaterial()) $('#btn-check-all-material-supplier-data').addClass('d-none')
}

function unCheckRestaurantMaterialBySupplier(r) {
    let item = {
        'name': '<label>' + r.data('name') + '</label>',
        'unit_full_name': r.data('unit-full-name'),
        'checkbox': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantMaterialBySupplier($(this))" data-price="' + removeformatNumber(r.data('price')) + '" data-name="' + r.data('name') + '" data-id="' + r.data('id') + '" data-unit-full-name="' + r.data('unit-full-name') + '" data-unit-specification="' + r.data('unit-specification') + '" data-unit-id="' + r.data('unit-id') + '" data-category="' + r.data('category') + '"  data-type="' + r.data('type') + '">' +
            '<i class="fi-rr-arrow-small-right"></i>'
            + '</button> </div>',
        'keysearch': r.parents('tr').find('td:eq(5)').text(),
    };
    addRowDatatableTemplate(drawTableAllMaterial, item);
    drawTableSelectedSupplierMaterial.row(r.parents('tr')).remove().draw(false);
    if (checkClassD_noneTableSelectedSupplierMaterial()) $('#btn-uncheck-all-material-supplier-data').addClass('d-none')
    if (checkCountRecordTableAllMaterial()) $('#btn-check-all-material-supplier-data').removeClass('d-none')


}

function checkClassD_noneTableSelectedSupplierMaterial() {
    var allHaveDNoneClass = true;
    drawTableSelectedSupplierMaterial.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('button').attr('data-type') == 0) {
            allHaveDNoneClass = false;
            return false;
        }
    });
    return allHaveDNoneClass;
}

function checkCountRecordTableAllMaterial() {
    if (drawTableAllMaterial.rows().count() > 0) return true;
    else return false
}

function itemMaterialCompany(r) {
    if (r.find('td:eq(0)').find('button').data('type') == 0) {
        return {
            'name': '<label>' + r.find('td:eq(0)').find('button').data('name') + '</label>',
            'unit_full_name': r.find('td:eq(0)').find('button').data('unit-full-name'),
            'checkbox': '<div class="btn-group btn-group-sm">' +
                '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantMaterialBySupplier($(this))" data-price="' + removeformatNumber(r.find('td:eq(0)').find('button').data('price')) + '" data-name="' + r.find('td:eq(0)').find('button').data('name') + '" data-id="' + r.find('td:eq(0)').find('button').data('id') + '" data-unit-specification="' + r.find('td:eq(0)').find('button').data('unit-specification') + '" data-unit-full-name="' + r.find('td:eq(0)').find('button').data('unit-full-name') + '"  data-unit-id="' + r.find('td:eq(0)').find('button').data('unit-id') + '" data-category="' + r.find('td:eq(0)').find('button').data('category') + '">' +
                '<i class="fi-rr-arrow-small-right"  data-type="1"></i>'
                + '</button> </div>',
            'keysearch': r.find('td:eq(7)').text(),
        };
    }
}

function itemMaterialSupplier(r) {
    return {
        'checkbox': '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckRestaurantMaterialBySupplier($(this))" data-type="' + r.find('td:eq(2) button').data('type') + '" data-id="' + r.find('td:eq(2) button').data('id') + '" data-price="' + r.find('td:eq(2) button').data('price') + '" data-name="' + r.find('td:eq(2) button').data('name') + '" data-unit-specification="' + r.find('td:eq(2) button').data('unit-specification') + '" data-unit-id="' + r.find('td:eq(2) button').data('unit-id') + '" data-unit-full-name="' + r.find('td:eq(2) button').data('unit-full-name') + '" data-category="' + r.find('td:eq(2) button').data('category') + '">' +
            '<i class="fi-rr-arrow-small-left" ></i>'
            + '</button> </div>',
        'name': '<label>' + r.find('td:eq(2) button').data('name') + '</label>',
        'price': '<div class="input-group border-group validate-table-validate">\n' +
            '        <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-max="100000000" data-type="currency-edit" value="' + r.find('td:eq(2) button').data('price') + '"></div>',
        'retail_price': '<div class="input-group border-group validate-table-validate">' +
            '               <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-max="10000000" data-type="currency-edit" value="' + r.find('td:eq(2) button').data('price') + '"></div>',
        'wholesale_price': '<div class="input-group border-group validate-table-validate">' +
            '                   <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-money="1" data-type="currency-edit" value="' + r.find('td:eq(2) button').data('price') + '"></div>',
        'quantity': '<div class="input-group border-group validate-table-validate">' +
            '           <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-max="999999" data-type="currency-edit" value="1"></div>',
        'out_stock': '<div class="input-group border-group validate-table-validate">' +
            '           <input class="form-control rounded text-center border-0 w-100 seemt-fz-14" data-max="100000" data-type="currency-edit" value="1"></div>',
        'action': '',
        'keysearch': r.find('td:eq(2) i').data('name') + removeformatNumber(r.find('td:eq(2) i').data('price')) + removeVietnameseStringLowerCase(String(r.find('td:eq(2) i').data('name') + removeformatNumber(r.find('td:eq(2) i').data('price')))),
    }
}

async function checkAllSupplierMaterialData() {
    addAllRowDatatableTemplate(drawTableAllMaterial, drawTableSelectedSupplierMaterial, itemMaterialSupplier);
    $('#btn-check-all-material-supplier-data').addClass('d-none')
    $('#btn-uncheck-all-material-supplier-data').removeClass('d-none')
}

async function unCheckAllSupplierMaterialData() {
    let listRow = []
    await drawTableSelectedSupplierMaterial.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('button').attr('data-type') == 0) {
            listRow.push(row)
            let item = {
                'name': '<label>' + row.find('td:eq(0)').find('button').data('name') + '</label>',
                'unit_full_name': row.find('td:eq(0)').find('button').data('unit-full-name'),
                'checkbox': '<div class="btn-group btn-group-sm">' +
                    '<button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light" onclick="checkRestaurantMaterialBySupplier($(this))" data-price="' + removeformatNumber(row.find('td:eq(0)').find('button').data('price')) + '" data-name="' + row.find('td:eq(0)').find('button').data('name') + '" data-id="' + row.find('td:eq(0)').find('button').data('id') + '" data-unit-full-name="' + row.find('td:eq(0)').find('button').data('unit-full-name') + '" data-unit-specification="' + row.find('td:eq(0)').find('button').data('unit-specification') + '" data-unit-id="' + row.find('td:eq(0)').find('button').data('unit-id') + '" data-category="' + row.find('td:eq(0)').find('button').data('category') + '"  data-type="' + row.find('td:eq(0)').find('button').data('type') + '">' +
                    '<i class="fi-rr-arrow-small-right"></i>'
                    + '</button> </div>',
                'keysearch': row.find('td:eq(5)').text(),
            };
            addRowDatatableTemplate(drawTableAllMaterial, item);
        }
    });
    for (let i = 0; i < listRow.length; i++) {
        drawTableSelectedSupplierMaterial.row(listRow[i]).remove().draw(false);
    }
    $('#btn-uncheck-all-material-supplier-data').addClass('d-none')
    $('#btn-check-all-material-supplier-data').removeClass('d-none')
}

async function assignRestaurantMaterialData() {
    if (saveSupplierMaterialData !== 0) return false;
    if (!checkValidateSave($('#table-supplier-material-data'))) return false;
    if (!drawTableSelectedSupplierMaterial.data().any()) {
        WarningNotify('Vui lòng chọn nguyên liệu');
        return false;
    }
    let list_material = [];
    await drawTableSelectedSupplierMaterial.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('button').attr('data-type') == 0) {
            list_material.push({
                name: row.find('td:eq(1)').find('label').text(),
                cost_price: removeformatNumber(row.find('td:eq(2)').find('input').val()),
                retail_price: removeformatNumber(row.find('td:eq(3)').find('input').val()),
                wholesale_price: 0,
                wholesale_price_quantity: 0,
                out_stock_alert_quantity: removeformatNumber(row.find('td:eq(4)').find('input').val()),
                material_unit_id: row.find('td:eq(0)').find('button').data('unit-id'),
                material_unit_specification_id: row.find('td:eq(0)').find('button').data('unit-specification'),
                material_category_id: row.find('td:eq(0)').find('button').data('category')
            })
        }
    });
    saveSupplierMaterialData = 1;
    let supplier = $('#select-supplier-in-supplier-material-data').val(),
        method = 'post',
        url = 'supplier-material-data.assign-restaurant-material',
        params = null,
        data = {
            supplier_id: supplier,
            list_material: list_material,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#table-supplier-material-body')]);
    saveSupplierMaterialData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalUpdateSupplierMaterialData();
            loadData();
            $('#supplier-material-supplier-data').val($('#select-supplier-in-supplier-material-data').val()).trigger('change.select2');
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        case 205:
            await drawTableSelectedSupplierMaterial.rows().every(function (i1, v1) {
                let x = $(this.node());
                $('.border-group').removeClass('border-danger')
                WarningNotify(res.data.message)
                for (let i = 0; i < res.data.data.length; i++) {
                    x.parent().find('tr:eq(' + res.data.data[i].index + ')').find('td:eq(1)').children().addClass('border-danger');
                }
                if ($('.border-group').hasClass('border-danger')) {
                    $(".border-danger")[0].scrollIntoView();
                } else if ($('.form-validate-input').hasClass('validate-error')) {
                    $(".validate-error")[0].scrollIntoView();
                }
            });
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function changeStatusMaterialSupplierOrder(r, status) {
    if (checkDeleteMaterialBookSupplier === 1) return false;
    let title = ``, content = status ? 'Bật hoạt động nguyên liệu này' : 'Tạm ngưng nguyên liệu này', icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkDeleteMaterialBookSupplier = 1;
            let method = 'post',
                url = 'supplier-material-data.remove-material-book-supplier',
                params = null,
                data = {
                    id: r.data('id'),
                    status: status,
                };
            let res = await axiosTemplate(method, url, params, data);
            checkDeleteMaterialBookSupplier = 0;
            switch (res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    r.parents('td').html(status === 1
                        ? '<button class="tabledit-edit-button btn seemt-btn-hover-red waves-effect waves-light" onclick="changeStatusMaterialSupplierOrder($(this), 0)" data-id="' + r.data('id') + '" data-toggle="tooltip" data-placement="top" data-original-title="Tạm ngưng"><i class="fi-rr-cross"></i></button>'
                        : '<button class="tabledit-edit-button seemt-green btn seemt-btn-hover-green waves-effect waves-light" onclick="changeStatusMaterialSupplierOrder($(this), 1)" data-id="' + r.data('id') + '" data-toggle="tooltip" data-placement="top" data-original-title="Bật hoạt động"><i class="fi-rr-check"></i></button>'
                    );
                    // loadSupplierHandBookMaterial($('#select-supplier-in-supplier-material-data').val());
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message)
            }
        }
    })
}

function closeModalUpdateSupplierMaterialData() {
    $('#modal-assign-system-supplier-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    drawTableSelectedSupplierMaterial.clear().draw(false);
    reloadModalUpdateSupplierMaterialData()
}

function reloadModalUpdateSupplierMaterialData() {
    $('#loading-modal-update-supplier-material input').val()
    $('#loading-modal-update-supplier-material select').val($('#loading-modal-update-supplier-material select').val('option:first')).trigger('change.select2')
}






