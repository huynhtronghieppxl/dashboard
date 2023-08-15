let checkSaveCreateGoodsPurchase = 0,
    tableMaterialCreateGoodsPurchase,
    tableGoodsCreateGoodsPurchase,
    tableInternalCreateGoodsPurchase,
    tableOtherCreateGoodsPurchase,
    dataMaterialCreateGoodsPurchase = [],
    dataGoodsCreateGoodsPurchase = [],
    dataInternalCreateGoodsPurchase = [],
    dataOtherCreateGoodsPurchase = [];
$(function () {
    $(document).on('change dp.change',`#date-create-goods-purchase, #select-material-create-goods-purchase, #select-goods-create-goods-purchase,
                                       #select-internal-create-goods-purchase, #select-other-create-goods-purchase`, () => $('.btn-renew').removeClass('d-none'));
    $('.btn-renew').on('click', () => $('.btn-renew').addClass('d-none'));
    $('#select-material-create-goods-purchase').unbind('select2:select').on('select2:select', function () {
        generateMaterial(dataMaterialCreateGoodsPurchase, tableMaterialCreateGoodsPurchase, $(this), $('#table-material-create-goods-purchase'), 1);
    });
    $('#select-goods-create-goods-purchase').unbind('select2:select').on('select2:select', function () {
        generateMaterial(dataGoodsCreateGoodsPurchase, tableGoodsCreateGoodsPurchase, $(this), $('#table-goods-create-goods-purchase'), 2);
    });
    $('#select-internal-create-goods-purchase').unbind('select2:select').on('select2:select', function () {
        generateMaterial(dataInternalCreateGoodsPurchase, tableInternalCreateGoodsPurchase, $(this), $('#table-internal-create-goods-purchase'), 3);
    });
    $('#select-other-create-goods-purchase').unbind('select2:select').on('select2:select', function () {
        generateMaterial(dataOtherCreateGoodsPurchase, tableOtherCreateGoodsPurchase, $(this), $('#table-other-create-goods-purchase'), 4);
    });
    $(document).on('input', `#table-material-create-goods-purchase input.adjustment, #table-goods-create-goods-purchase input.adjustment,
                            #table-internal-create-goods-purchase input.adjustment, #table-other-create-goods-purchase input.adjustment`, function () {
        let quantity = removeformatNumber($(this).val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(4)').find(':selected').data('price'));
        $(this).removeClass('border border-danger');
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(Math.ceil(quantity * price)));
        sumMaterialCreateGoodsPurchase();
    });
    $(document).on('select2:select', '.select-supplier-create-goods-purchase', async function () {
        $(this).parents('tr').find('td:eq(5)').text(formatNumber($(this).find('option:selected').data('price')));
        let quantity = removeformatNumber($(this).parents('tr').find('td:eq(3)').find('input').val()),
            price = removeformatNumber($(this).find('option:selected').data('price'));
        $(this).removeClass('border border-danger');
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(Math.ceil(quantity * price)));
        sumMaterialCreateGoodsPurchase();
    })

})
function openCreateGoodsPurchase () {
    $('#modal-create-goods-purchase').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', closeModalCreateGoodsPurchase);
    shortcut.remove("F4");
    shortcut.add('F4', saveModalCreateGoodsPurchase);
    $('#modal-create-goods-purchase .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-goods-purchase')
    });

    drawTableCreateGoodsPurchase();
    dateTimePickerTemplate($('#date-create-goods-purchase'), null, moment().add(6, 'months'));
    dataMaterialGoodsPurchase();
    $('.btn-renew').addClass('d-none');
}

async function drawTableCreateGoodsPurchase() {
    let table_material = $('#table-material-create-goods-purchase'),
        table_goods = $('#table-goods-create-goods-purchase'),
        table_internal = $('#table-internal-create-goods-purchase'),
        table_other = $('#table-other-create-goods-purchase'),
        fixed_left = 2,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'restaurant_quantity', name: 'restaurant_quantity', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'supplier', name: 'supplier', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ];
    tableMaterialCreateGoodsPurchase = await DatatableTemplateNew(table_material, [], column, '40vh ', fixed_left, fixed_right);
    tableGoodsCreateGoodsPurchase = await DatatableTemplateNew(table_goods, [], column, '40vh', fixed_left, fixed_right );
    tableInternalCreateGoodsPurchase = await DatatableTemplateNew(table_internal, [], column, '40vh', fixed_left, fixed_right );
    tableOtherCreateGoodsPurchase = await DatatableTemplateNew(table_other, [], column, '40vh', fixed_left, fixed_right );

    // $(document).on('input paste', '#table-material-create-supplier-order_filter', async function () {
    //     $('#total-record-material-create-supplier-order').text(tableMaterialCreateSupplierOrder.rows({'search': 'applied'}).count());
    // })
    //
    // $(document).on('input paste', '#table-goods-create-supplier-order_filter', async function () {
    //     $('#total-record-goods-create-supplier-order').text(tableGoodsCreateSupplierOrder.rows({'search': 'applied'}).count());
    // })
    //
    // $(document).on('input paste', '#table-internal-create-supplier-order_filter', async function () {
    //     $('#total-record-internal-create-supplier-order').text(tableInternalCreateSupplierOrder.rows({'search': 'applied'}).count());
    // })
    //
    // $(document).on('input paste', '#table-other-create-supplier-order_filter', async function () {
    //     $('#total-record-other-create-supplier-order').text(tableOtherCreateSupplierOrder.rows({'search': 'applied'}).count());
    // })
}

async function dataMaterialGoodsPurchase () {
    let branch = $('.select-total-warehouse').val(),
        method = 'get',
        url = 'goods-purchase-warehouse.material',
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [ $('#modal-create-goods-purchase select')]);
    $('#select-material-create-goods-purchase').html(res.data[0]);
    $('#select-goods-create-goods-purchase').html(res.data[1]);
    $('#select-internal-create-goods-purchase').html(res.data[2]);
    $('#select-other-create-goods-purchase').html(res.data[3]);
    dataMaterialCreateGoodsPurchase = res.data[4].material;
    dataGoodsCreateGoodsPurchase = res.data[4].goods;
    dataInternalCreateGoodsPurchase = res.data[4].internal;
    dataOtherCreateGoodsPurchase = res.data[4].other;
}

function generateMaterial (data, table, r, selector, type) {
    let provide = '';
    for (const v of Object.keys(data)) {
        if (data[v].restaurant_material_id === parseInt(r.val())) {
            jQuery.each(data[v].suppliers, function (i1, v1) {
                let selected = '';
                if (v1.last_order_supplier_id === 1) selected = 'selected';
                provide += '<option value="' + v1.id + '" data-type="' + v1.restaurant_id + '" data-price="' + formatNumber(v1.cost_price) + '" data-wholesale-price="' + v1.wholesale_price + '" data-wholesale-quantity="' + v1.wholesale_price_quantity + '" ' + selected + '>' + v1.name + ' (' + formatNumber(v1.cost_price) + ') </option>'
            })
        }
    }
    let row = {
        'id': r.find(':selected').val(),
        'DT_RowIndex': table.length,
        'restaurant_material_name': r.find(':selected').text() + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                                                 <i class="fi-rr-hastag"></i>
                                                                                 <label class="m-0">${r.find(':selected').data('unit')}</label>
                                                                            </div>`,
        'restaurant_quantity': r.find(':selected').data('remain-quantity'),
        'quantity': `<div class="input-group border-group validate-table-validate">
                         <input class="form-control adjustment text-center rounded border-0" data-type="currency-edit" data-max="9999" data-value-min-value-of="0" data-float="1" value="1" >
                    </div>`,
        'supplier': ' <select class="js-example-basic-single" style="width:max-content !important;" onchange="selectMaterialOrder($(this))">' + provide + '</select>',
        'price': r.find(':selected').data('price'),
        'action': '<div class="btn-group-sm">' +
            '<button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' + r.val() +')" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
            '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeRowTableGoodsPurchase($(this), ' + type + ')" data-id="' + r.find(':selected').val() + '" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
            '</div>',
        'keysearch': r.find(':selected').data('keysearch'),
    };
    addRowTableGoodsPurchase(selector, row);
    $('[data-toggle="tooltip"]').tooltip();
    $('.js-example-basic-single').select2({
        dropdownParent: $('#modal-create-goods-purchase')
    });
    r.val('').trigger('change.select2');
    sumMaterialCreateGoodsPurchase();
}

function addRowTableGoodsPurchase(el, data) {
    el.find('.empty-datatable-custom').parents('tr').remove();
    // el.find('tbody').append(`<tr>
    //                             <td class="text-center" style="width: 5%">${el.find('tbody tr').length + 1}</td>
    //                             <td class="text-left" style="width: 20%">${data.restaurant_material_name}</td>
    //                             <td class="text-center">${data.restaurant_quantity}</td>
    //                             <td class="text-center"  style="width: 20%">${data.quantity}</td>
    //                             <td class="text-right"  style="width: 20%">${data.supplier}</td>
    //                             <td class="text-right"  style="width: 10%">${data.price}</td>
    //                             <td class="text-right"  style="width: 8%">${data.price}</td>
    //                             <td class="text-right"  style="width: 8%">${data.action}</td>
    //                         </tr>`);
    addRowDatatableTemplateNew(el, data);
    el.find('tbody').scrollTop(el.find('tbody').get(0).scrollHeight);
}

function removeRowTableGoodsPurchase(r, i) {
    switch (+i) {
        case 1:
            removeRowDatatableTemplate(tableMaterialCreateGoodsPurchase, r , true);
            break;
        case 2:
            removeRowDatatableTemplate(tableGoodsCreateGoodsPurchase, r , true);
            break;
        case 3:
            removeRowDatatableTemplate(tableInternalCreateGoodsPurchase, r , true);
            break;
        case 4:
            removeRowDatatableTemplate(tableOtherCreateGoodsPurchase, r , true);
            break;
    }
    sumMaterialCreateGoodsPurchase();
}

async function sumMaterialCreateGoodsPurchase() {
    let totalMaterial = 0, totalGoods = 0, totalInternal = 0, totalOther = 0;
    let table_material = $('#table-material-create-goods-purchase'),
        table_goods = $('#table-goods-create-goods-purchase'),
        table_internal = $('#table-internal-create-goods-purchase'),
        table_other = $('#table-other-create-goods-purchase');

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
    $('#total-material-create-goods-purchase').text(formatNumber(totalMaterial));
    $('#total-goods-create-goods-purchase').text(formatNumber(totalGoods));
    $('#total-internal-create-goods-purchase').text(formatNumber(totalInternal));
    $('#total-other-create-goods-purchase').text(formatNumber(totalOther));
    $('#total-create-goods-purchase').text(formatNumber(totalMaterial + totalGoods + totalInternal + totalOther));

    $('#total-record-material-create-goods-purchase').text(formatNumber(table_material.find('tbody tr:not(":has(td.dataTables_empty)")').length));
    $('#total-record-goods-create-goods-purchase').text(formatNumber(table_goods.find('tbody tr:not(":has(td.dataTables_empty)")').length));
    $('#total-record-internal-create-goods-purchase').text(formatNumber(table_internal.find('tbody tr:not(":has(td.dataTables_empty)")').length));
    $('#total-record-other-create-goods-purchase').text(formatNumber(table_other.find('tbody tr:not(":has(td.dataTables_empty)")').length));
}
function selectMaterialOrder(r) {
    r.parents('tr').find('td:eq(5)').text(r.parents('tr').find('td:eq(4)').find(':selected').data('price'));
    let quantity = removeformatNumber(r.parents('tr').find('td:eq(3)').find('input').val()),
        price = removeformatNumber(r.parents('tr').find('td:eq(4)').find(':selected').data('price'));
    r.parents('tr').find('td:eq(6)').text(formatNumber(quantity * price));
    sumMaterialCreateGoodsPurchase();
}

async function saveModalCreateGoodsPurchase () {
    if (checkSaveCreateGoodsPurchase !== 0) return false;
    let brand = $('.select-total-warehouse').find(':selected').data('brand-id'),
        branch = $('.select-total-warehouse').val(),
        material = [];
    let table_material = $('#table-material-create-goods-purchase'),
        table_goods = $('#table-goods-create-goods-purchase'),
        table_internal = $('#table-internal-create-goods-purchase'),
        table_other = $('#table-other-create-goods-purchase');
    table_material.find('tbody tr').each(function () {
        let row = $(this);
        material.push({
            "supplier_id": row.find('td:eq(4)').find(':selected').val(),
            "restaurant_material_id": row.find('td:eq(7)').find('.seemt-btn-hover-red').data('id'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "expected_delivery_time_string": $('#date-create-goods-purchase').val() + ' 00:00',
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
            "expected_delivery_time_string": $('#date-create-goods-purchase').val() + ' 00:00',
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
            "expected_delivery_time_string": $('#date-create-goods-purchase').val() + ' 00:00',
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
            "expected_delivery_time_string": $('#date-create-goods-purchase').val() + ' 00:00',
            "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            "restaurant_material_order_request_detail_id": 0,
            "sort": material.length,
        })
    })

    if (material.length === 0) {
        WarningNotify('Vui lòng chọn nguyên liệu !');
        return false;
    } else {
        removeErrorInput($('.form-control.adjustment'))
    }
    if (!checkValidateSave($('#modal-create-supplier-order'))) return false;

    checkSaveCreateGoodsPurchase = 1;
    let method = 'post',
        url = 'goods-purchase-warehouse.create',
        params = null,
        data = {
            brand: brand,
            branch: branch,
            material: material,
            date: $('#date-create-goods-purchase').val()
        };
    let res = await axiosTemplate(method, url, params, data, $('#modal-create-goods-purchase'));
    checkSaveCreateGoodsPurchase = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            resetModalCreateGoodsPurchase();
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
function closeModalCreateGoodsPurchase () {
    $('#modal-create-goods-purchase').modal('hide');
}

function resetModalCreateGoodsPurchase() {
    tableMaterialCreateGoodsPurchase.clear().draw(false);
    tableGoodsCreateGoodsPurchase.clear().draw(false);
    tableInternalCreateGoodsPurchase.clear().draw(false);
    tableOtherCreateGoodsPurchase.clear().draw(false);
    sumMaterialCreateGoodsPurchase();
    $('#modal-create-goods-purchase .nav-link:first').click();
    $('#modal-create-goods-purchase .btn-renew').addClass('d-none');
    $('#date-create-goods-purchase').val(moment().format('DD/MM/YYYY'));
}
