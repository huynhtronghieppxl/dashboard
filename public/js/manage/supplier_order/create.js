let checkSaveCreateSupplierOrder = 0,
    thisRowDataTableCreateSupplierOrder,
    tableMaterialCreateSupplierOrder = [],
    tableGoodsCreateSupplierOrder = [],
    tableInternalCreateSupplierOrder = [],
    tableOtherCreateSupplierOrder = [],
    dataMaterialCreateSupplierOrder = [],
    dataGoodsCreateSupplierOrder = [],
    dataInternalCreateSupplierOrder = [],
    dataOtherCreateSupplierOrder = [],
    branchCreateSupplierOrder,
    dataMaterialMaterialInventory = '',
    dataMaterialGoodsInventory = '',
    dataMaterialInternalInventory = '',
    dataMaterialOtherInventory = '';

async function openCreateSupplierOrder() {
    $('#modal-create-supplier-order').modal('show');
    checkSaveCreateSupplierOrder = 0;
    branchCreateSupplierOrder = $('.select-branch').val();
    shortcut.remove("ESC");
    shortcut.add('ESC', closeModalCreateSupplierOrder);
    shortcut.remove("F4");
    shortcut.add('F4', function () {
        saveModalCreateSupplierOrder();
    });
    shortcut.remove("F3");
    shortcut.add('F3', openSelectMaterialSupplierOrder);
    shortcut.remove("F6");
    console.log($('#tab-inventory-supplier-order a.active').data('id'))
    shortcut.add('F6', function () {
        openModalSelectMultipleMaterial($('#tab-inventory-supplier-order a.active').data('id'));
    });
    $('#modal-create-supplier-order .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-supplier-order'),
    });
    $(document).on('focus', 'input, textarea', function () {
        $(this).select();
    });

    $('#select-material-create-supplier-order').unbind('select2:select').on('select2:select', async function () {
        let provide = '';
        for (const v of Object.keys(dataMaterialCreateSupplierOrder)) {
            if (dataMaterialCreateSupplierOrder[v].restaurant_material_id === parseInt($(this).val())) {
                jQuery.each(dataMaterialCreateSupplierOrder[v].suppliers, function (i1, v1) {
                    let selected = '';
                    if (v1.last_order_supplier_id === 1) selected = 'selected';
                    provide += '<option value="' + v1.id + '" data-type="' + v1.restaurant_id + '" data-price="' + formatNumber(v1.cost_price) + '" data-wholesale-price="' + v1.wholesale_price + '" data-wholesale-quantity="' + v1.wholesale_price_quantity + '" ' + selected + '>' + v1.name + ' (' + formatNumber(v1.cost_price) + ') </option>'
                })
            }
        }
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableMaterialCreateSupplierOrder.length,
            'restaurant_material_name': $(this).find(':selected').text() + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                                 <i class="fi-rr-hastag"></i>
                                                                                 <label class="m-0">${$(this).find(':selected').data('unit')}</label>
                                                                            </div>`,
            'restaurant_quantity': $(this).find(':selected').data('remain-quantity'),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0" data-type="currency-edit" data-max="9999" data-value-min-value-of="0" data-float="1" value="1" >\n' +
                '</div>',
            'supplier': $(this).find(':selected').data('is-office') ? 'Nhập từ kho tổng' :
                ' <select class="js-example-basic-single" style="width:max-content !important;" onchange="selectSupplierMaterialOrder($(this))">' + provide + '</select>',
            'price': $(this).find(':selected').data('price'),
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' + $(this).find(':selected').val() + ')" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateSupplierOrder($(this), 1)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': $(this).find(':selected').data('keysearch'),
        }
        addRowTableSupplierOrder(tableMaterialCreateSupplierOrder, $('#table-material-create-supplier-order'), data);
        $('[data-toggle="tooltip"]').tooltip();
        $('#table-material-create-supplier-order .js-example-basic-single:last').select2({
            dropdownParent: $('#modal-create-supplier-order'),
        });
        $('#select-material-create-supplier-order').val('').trigger('change');
        sumMaterialCreateSupplierOrder();
    })
    $('#select-goods-create-supplier-order').unbind('select2:select').on('select2:select', async function () {
        let provide = '';
        for (const v of Object.keys(dataGoodsCreateSupplierOrder)) {
            if (dataGoodsCreateSupplierOrder[v].restaurant_material_id === parseInt($(this).val())) {
                jQuery.each(dataGoodsCreateSupplierOrder[v].suppliers, function (i1, v1) {
                    let selected = '';
                    if (v1.last_order_supplier_id === 1) selected = 'selected';
                    provide += '<option value="' + v1.id + '" data-type="' + v1.restaurant_id + '" data-price="' + formatNumber(v1.cost_price) + '" data-wholesale-price="' + v1.wholesale_price + '" data-wholesale-quantity="' + v1.wholesale_price_quantity + '" ' + selected + '>' + v1.name + ' (' + formatNumber(v1.cost_price) + ') </option>'
                })
            }
        }
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableGoodsCreateSupplierOrder.length,
            'restaurant_material_name': $(this).find(':selected').text() + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                                 <i class="fi-rr-hastag"></i>
                                                                                 <label class="m-0">${$(this).find(':selected').data('unit')}</label>
                                                                            </div>`,
            'restaurant_quantity': $(this).find(':selected').data('remain-quantity'),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0 " data-max="9999" data-value-min-value-of="0" data-float="1" data-type="currency-edit" value="1" >\n' +
                '</div>',
            'supplier': $(this).find(':selected').data('is-office') ? 'Nhập từ kho tổng' :
                ' <select class="js-example-basic-single" style="width:max-content !important;" onchange="selectSupplierMaterialOrder($(this))">' + provide + '</select>',
            'price': $(this).find(':selected').data('price'),
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' + $(this).find(':selected').val() + ')"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateSupplierOrder($(this), 2)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': $(this).find(':selected').data('keysearch'),

        }
        addRowTableSupplierOrder(tableGoodsCreateSupplierOrder , $('#table-goods-create-supplier-order'), data);
        $('[data-toggle="tooltip"]').tooltip();
        $('#table-goods-create-supplier-order .js-example-basic-single:last').select2({
            dropdownParent: $('#modal-create-supplier-order'),
        });
        // await addRowDatatableTemplate(tableGoodsCreateSupplierOrder, data);
        $('#select-goods-create-supplier-order').val('').trigger('change');
        sumMaterialCreateSupplierOrder();
    })
    $('#select-internal-create-supplier-order').unbind('select2:select').on('select2:select', async function () {
        let provide = '';
        for (const v of Object.keys(dataInternalCreateSupplierOrder)) {
            if (dataInternalCreateSupplierOrder[v].restaurant_material_id === parseInt($(this).val())) {
                jQuery.each(dataInternalCreateSupplierOrder[v].suppliers, function (i1, v1) {
                    let selected = '';
                    if (v1.last_order_supplier_id === 1) selected = 'selected';
                    provide += '<option value="' + v1.id + '" data-type="' + v1.restaurant_id + '" data-price="' + formatNumber(v1.cost_price) + '" data-wholesale-price="' + v1.wholesale_price + '" data-wholesale-quantity="' + v1.wholesale_price_quantity + '" ' + selected + '>' + v1.name + ' (' + formatNumber(v1.cost_price) + ') </option>'
                })
            }
        }
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableInternalCreateSupplierOrder.length,
            'restaurant_material_name': $(this).find(':selected').text() + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                                 <i class="fi-rr-hastag"></i>
                                                                                 <label class="m-0">${$(this).find(':selected').data('unit')}</label>
                                                                            </div>`,
            'restaurant_quantity': $(this).find(':selected').data('remain-quantity'),
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0" data-max="9999" data-value-min-value-of="0" data-float="1" data-type="currency-edit" value="1" >\n' +
                '</div>',
            'supplier': $(this).find(':selected').data('is-office') ? 'Nhập từ kho tổng' :
                ' <select class="js-example-basic-single" style="width:max-content !important;" onchange="selectSupplierMaterialOrder($(this))">' + provide + '</select>',
            'price': $(this).find(':selected').data('price'),
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' + $(this).find(':selected').val() + ')"  data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateSupplierOrder($(this), 3)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': $(this).find(':selected').data('keysearch'),

        }
        // await addRowDatatableTemplate(tableInternalCreateSupplierOrder, data);
        // $('#modal-create-supplier-order .js-example-basic-single').select2({
        //     dropdownParent: $('#modal-create-supplier-order'),
        // });

        addRowTableSupplierOrder(tableInternalCreateSupplierOrder, $('#table-internal-create-supplier-order'), data);
        $('[data-toggle="tooltip"]').tooltip();
        $('#table-internal-create-supplier-order .js-example-basic-single:last').select2({
            dropdownParent: $('#modal-create-supplier-order'),
        });

        $('#select-internal-create-supplier-order').val('').trigger('change.select2');
        sumMaterialCreateSupplierOrder();
    })
    $('#select-other-create-supplier-order').unbind('select2:select').on('select2:select', async function () {
        let provide = '';
        for (const v of Object.keys(dataOtherCreateSupplierOrder)) {
            if (dataOtherCreateSupplierOrder[v].restaurant_material_id === parseInt($(this).val())) {
                jQuery.each(dataOtherCreateSupplierOrder[v].suppliers, function (i1, v1) {
                    let selected = '';
                    if (v1.last_order_supplier_id === 1) selected = 'selected';
                    provide += '<option value="' + v1.id + '" data-type="' + v1.restaurant_id + '" data-price="' + formatNumber(v1.cost_price) + '" data-wholesale-price="' + v1.wholesale_price + '" data-wholesale-quantity="' + v1.wholesale_price_quantity + '" ' + selected + '>' + v1.name + ' (' + formatNumber(v1.cost_price) + ') </option>'
                })
            }
        }
        let data = {
            'id': $(this).find(':selected').val(),
            'DT_RowIndex': tableOtherCreateSupplierOrder.length,
            'restaurant_material_name': $(this).find(':selected').text() + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                                 <i class="fi-rr-hastag"></i>
                                                                                 <label class="m-0">${$(this).find(':selected').data('unit')}</label>
                                                                            </div>`,
            'restaurant_quantity': $(this).find(':selected').data('remain-quantity'),
            'quantity': '<div class="input-group border-group validate-table-validate">' +
                '<input class="form-control adjustment text-center rounded border-0" data-max="9999" data-type="currency-edit" data-value-min-value-of="0" data-float="1" value="1">' +
                '</div>',
            'supplier': $(this).find(':selected').data('is-office') ? 'Nhập từ kho tổng' :
                ' <select class="js-example-basic-single select2-hidden-accessible select-supplier-create-supplier-order" style="width:max-content !important;" onchange="selectSupplierMaterialOrder($(this))">' + provide + '</select>',
            'price': $(this).find(':selected').data('price'),
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' + $(this).find(':selected').val() + ')" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialCreateSupplierOrder($(this), 4)" data-id="' + $(this).find(':selected').val() + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': $(this).find(':selected').data('keysearch'),
        }
        // await addRowDatatableTemplate(tableOtherCreateSupplierOrder, data);
        addRowTableSupplierOrder(tableOtherCreateSupplierOrder, $('#table-other-create-supplier-order'), data);
        $('[data-toggle="tooltip"]').tooltip();
        $('#table-other-create-supplier-order .js-example-basic-single:last').select2({
            dropdownParent: $('#modal-create-supplier-order'),
        });
        $('#select-other-create-supplier-order').val('').trigger('change.select2');
        sumMaterialCreateSupplierOrder();
    })
    $(document).on('input', '#table-material-create-supplier-order input.adjustment, #table-goods-create-supplier-order input.adjustment, #table-internal-create-supplier-order input.adjustment, #table-other-create-supplier-order input.adjustment', function () {
        let quantity = removeformatNumber($(this).val()),
            // price = removeformatNumber($(this).parents('tr').find('td:eq(4)').find(':selected').data('price'));
            price = removeformatNumber($(this).parents('tr').find('td:eq(5)').text());
        $(this).removeClass('border border-danger');
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(Math.ceil(quantity * price)));
        sumMaterialCreateSupplierOrder();
    });
    $(document).on('select2:select', '.select-supplier-create-supplier-order', async function () {
        $(this).parents('tr').find('td:eq(5)').text(formatNumber($(this).find('option:selected').data('price')));
        let quantity = removeformatNumber($(this).parents('tr').find('td:eq(3)').find('input').val()),
            price = removeformatNumber($(this).find('option:selected').data('price'));
        $(this).removeClass('border border-danger');
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(Math.ceil(quantity * price)));
        sumMaterialCreateSupplierOrder();
    })
    $('#modal-create-supplier-order').on('change, dp.change, select2:select', 'select, input', () => $('#modal-create-supplier-order .btn-renew').removeClass('d-none'))
    getDataMaterialCreateSupplierOrder()
    dateTimePickerTemplateNotPassDayCurrent($('#date-create-supplier-order'), null, moment().add(6, 'months'));
    drawTableCreateSupplierOrder();
    $('.btn-renew').addClass('d-none');
}

function openSelectMaterialSupplierOrder() {
    let index = $('#tab-inventory-supplier-order a.active').attr('data-type');
    switch (Number(index)) {
        case 0:
            $('#select-material-create-supplier-order').select2('open');
            break;
        case 1:
            $('#select-goods-create-supplier-order').select2('open');
            break;
        case 2:
            $('#select-internal-create-supplier-order').select2('open');
            break;
        case 3:
            $('#select-other-create-supplier-order').select2('open');
            break;
    }
}

function selectSupplierMaterialOrder(r) {
    r.parents('tr').find('td:eq(5)').text(r.parents('tr').find('td:eq(4)').find(':selected').data('price'));
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(3)').find('input').val()),
        price = removeformatNumber(r.parents('tr').find('td:eq(4)').find(':selected').data('price'));
    r.parents('tr').find('td:eq(6)').text(formatNumber(quantity * price));
    sumMaterialCreateSupplierOrder();
}

async function getDataMaterialCreateSupplierOrder() {
    $('#select-material-create-supplier-order').prop('disabled', true);
    $('#select-goods-create-supplier-order').prop('disabled', true);
    $('#select-internal-create-supplier-order').prop('disabled', true);
    $('#select-other-create-supplier-order').prop('disabled', true);
    let branch = $('.select-branch').val(),
        method = 'get',
        url = 'supplier-order.material-supplier',
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#select-material-create-supplier-order'),
        $('#select-goods-create-supplier-order'),
        $('#select-internal-create-supplier-order'),
        $('#select-other-create-supplier-order'),
        $('#loading-select-multiple-material')]);
    $('#select-material-create-supplier-order').html(res.data[0]);
    $('#select-goods-create-supplier-order').html(res.data[1]);
    $('#select-internal-create-supplier-order').html(res.data[2]);
    $('#select-other-create-supplier-order').html(res.data[3]);
    dataMaterialMaterialInventory = res.data[6].original.data;
    dataMaterialGoodsInventory = res.data[7].original.data;
    dataMaterialInternalInventory = res.data[8].original.data;
    dataMaterialOtherInventory = res.data[9].original.data;

    $('#select-material-create-supplier-order').prop('disabled', false);
    $('#select-goods-create-supplier-order').prop('disabled', false);
    $('#select-internal-create-supplier-order').prop('disabled', false);
    $('#select-other-create-supplier-order').prop('disabled', false);
    dataMaterialCreateSupplierOrder = res.data[4].material;
    dataGoodsCreateSupplierOrder = res.data[4].goods;
    dataInternalCreateSupplierOrder = res.data[4].internal;
    dataOtherCreateSupplierOrder = res.data[4].other;
}

async function drawTableCreateSupplierOrder() {
    let table_material = $('#table-material-create-supplier-order'),
        table_goods = $('#table-goods-create-supplier-order'),
        table_internal = $('#table-internal-create-supplier-order'),
        table_other = $('#table-other-create-supplier-order'),
        fixed_left = 2,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center', width: '5%'},
            {data: 'supplier', name: 'supplier', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableMaterialCreateSupplierOrder = await DatatableTemplateNew(table_material, [], column, '40vh', fixed_left, fixed_right );
    tableGoodsCreateSupplierOrder = await DatatableTemplateNew(table_goods, [], column, '40vh', fixed_left, fixed_right );
    tableInternalCreateSupplierOrder = await DatatableTemplateNew(table_internal, [], column, '40vh', fixed_left, fixed_right );
    tableOtherCreateSupplierOrder = await DatatableTemplateNew(table_other, [], column, '40vh', fixed_left, fixed_right );

    $(document).on('input paste', '#table-material-create-supplier-order_filter', async function () {
        $('#total-record-material-create-supplier-order').text(tableMaterialCreateSupplierOrder.rows({'search': 'applied'}).count());
    })

    $(document).on('input paste', '#table-goods-create-supplier-order_filter', async function () {
        $('#total-record-goods-create-supplier-order').text(tableGoodsCreateSupplierOrder.rows({'search': 'applied'}).count());
    })

    $(document).on('input paste', '#table-internal-create-supplier-order_filter', async function () {
        $('#total-record-internal-create-supplier-order').text(tableInternalCreateSupplierOrder.rows({'search': 'applied'}).count());
    })

    $(document).on('input paste', '#table-other-create-supplier-order_filter', async function () {
        $('#total-record-other-create-supplier-order').text(tableOtherCreateSupplierOrder.rows({'search': 'applied'}).count());
    })
}

function removeMaterialCreateSupplierOrder(r, index) {
    thisRowDataTableCreateSupplierOrder = r;
    switch (index) {
        case 1:
            removeRowDatatableTemplate(tableMaterialCreateSupplierOrder, r , true)
            break;
        case 2:
            removeRowDatatableTemplate(tableGoodsCreateSupplierOrder, r , true)
            break;
        case 3:
            removeRowDatatableTemplate(tableInternalCreateSupplierOrder, r , true)
            break;
        case 4:
            removeRowDatatableTemplate(tableOtherCreateSupplierOrder, r , true)
            break;
    }
    sumMaterialCreateSupplierOrder();
}

async function sumMaterialCreateSupplierOrder() {
    let totalMaterial = 0, totalGoods = 0, totalInternal = 0, totalOther = 0;
    let table_material = $('#table-material-create-supplier-order'),
        table_goods = $('#table-goods-create-supplier-order'),
        table_internal = $('#table-internal-create-supplier-order'),
        table_other = $('#table-other-create-supplier-order');

    table_material.find('tbody tr').each(function () {
        let row = $(this);
        totalMaterial += removeformatNumber(row.find('td:eq(6)').text())
    })

    table_goods.find('tbody tr').each(function () {
        let row = $(this);
        totalGoods += removeformatNumber(row.find('td:eq(6)').text())
    })

    table_internal.find('tbody tr').each(function () {
        let row = $(this);
        totalInternal += removeformatNumber(row.find('td:eq(6)').text())
    })

    table_other.find('tbody tr').each(function () {
        let row = $(this);
        totalOther += removeformatNumber(row.find('td:eq(6)').text())
    })


    $('#total-material-create-supplier-order').text(formatNumber(totalMaterial));
    $('#total-goods-create-supplier-order').text(formatNumber(totalGoods));
    $('#total-internal-create-supplier-order').text(formatNumber(totalInternal));
    $('#total-other-create-supplier-order').text(formatNumber(totalOther));
    $('#total-create-supplier-order').text(formatNumber(totalMaterial + totalGoods + totalInternal + totalOther));

    $('#total-record-material-create-supplier-order').text(formatNumber(table_material.find('tbody tr:not(":has(td.dataTables_empty)")').length));
    $('#total-record-goods-create-supplier-order').text(formatNumber(table_goods.find('tbody tr:not(":has(td.dataTables_empty)")').length));
    $('#total-record-internal-create-supplier-order').text(formatNumber(table_internal.find('tbody tr:not(":has(td.dataTables_empty)")').length));
    $('#total-record-other-create-supplier-order').text(formatNumber(table_other.find('tbody tr:not(":has(td.dataTables_empty)")').length));
}

async function saveNewModalCreateSupplierOrder() {
    if (checkSaveCreateSupplierOrder !== 0) return false;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        material = [];
    let table_material = $('#table-material-create-supplier-order'),
        table_goods = $('#table-goods-create-supplier-order'),
        table_internal = $('#table-internal-create-supplier-order'),
        table_other = $('#table-other-create-supplier-order');
    table_material.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    table_goods.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    table_internal.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    table_other.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    if (material.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    } else {
        removeErrorInput($('#select-material-create-supplier-order'))
    }
    if (!checkValidateSave($('#modal-create-supplier-order'))) return false;

    checkSaveCreateSupplierOrder = 1;
    let method = 'post',
        url = 'supplier-order.create',
        params = null,
        data = {
            brand: brand,
            branch: branch,
            material: material,
            date: $('#date-create-supplier-order').val()
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-supplier-order')]);
    checkSaveCreateSupplierOrder = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            resetModalCreateSupplierOrder();
            loadingData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }

}

async function saveModalCreateSupplierOrder() {
    let table_material = $('#table-material-create-supplier-order'),
        table_goods = $('#table-goods-create-supplier-order'),
        table_internal = $('#table-internal-create-supplier-order'),
        table_other = $('#table-other-create-supplier-order');
    if (checkSaveCreateSupplierOrder !== 0) return false;
    let brand = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        material = [];

    table_material.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    table_goods.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    table_internal.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    table_other.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-supplier-order').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    if (material.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    } else {
        removeErrorInput($('#select-material-create-supplier-order'))
    }
    if (!checkValidateSave($('#modal-create-supplier-order'))) return false;

    checkSaveCreateSupplierOrder = 1;
    let method = 'post',
        url = 'supplier-order.create',
        params = null,
        data = {
            brand: brand,
            branch: branch,
            material: material,
            date: $('#date-create-supplier-order').val()
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-create-supplier-order')]);
    checkSaveCreateSupplierOrder = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateSupplierOrder();
            loadingData();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }

}
function addRowTableSupplierOrder(table, el, data) {
    el.find('.empty-datatable-custom').parents('tr').remove();
    addRowDatatableTemplateNew(table,el, data);
    el.find('tbody').scrollTop(el.find('tbody').get(0).scrollHeight);
}

function closeModalCreateSupplierOrder() {
    $('#modal-create-supplier-order').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F6');
    resetModalCreateSupplierOrder();
}

function resetModalCreateSupplierOrder() {
    tableMaterialCreateSupplierOrder.clear().draw(false);
    tableGoodsCreateSupplierOrder.clear().draw(false);
    tableInternalCreateSupplierOrder.clear().draw(false);
    tableOtherCreateSupplierOrder.clear().draw(false);
    sumMaterialCreateSupplierOrder();
    $('#modal-create-supplier-order .nav-link:first').click();
    $('#modal-create-supplier-order .btn-renew').addClass('d-none');
    $('#date-create-supplier-order').val(moment().format('DD/MM/YYYY'));
}
