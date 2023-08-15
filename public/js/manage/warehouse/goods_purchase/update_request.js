let checkSaveUpdateRequestWarehouse = 0,
    idUpdateRequestWarehouse,
    brandUpdateRequestWarehouse,
    branchUpdateRequestWarehouse,
    tableMaterialUpdateRequestWarehouse,
    arrayMaterialUpdateRequestWarehouse, idEmployeeUpdateRequestWarehouse;

async function openUpdateRequestWarehouse(id, branch, brand, export_inventory) {
    $('#modal-update-request-warehouse').modal('show');
    $('#create-update-request-warehouse').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#date-update-request-warehouse').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    checkSaveUpdateRequestWarehouse = 0;
    idUpdateRequestWarehouse = id;
    brandUpdateRequestWarehouse = brand;
    branchUpdateRequestWarehouse = branch;
    $('#modal-update-request-warehouse .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-request-warehouse'),
    });
    shortcut.add('ESC', function () {
        closeModalUpdateRequestWarehouse();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalUpdateRequestWarehouse();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalUpdateRequestWarehouse();
        });
    });
    shortcut.add('F4', function () {
        saveModalUpdateRequestWarehouse();
    });
    $(document).on('select2:select', '#table-material-update-request-warehouse .js-example-basic-single', function () {
        let quantity = removeformatNumber($(this).parents('tr').find('td:eq(3) input').val()),
            price = $(this).find(':selected').data('price');
        $(this).parents('tr').find('td:eq(5)').text(formatNumber(price));
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(quantity * price));
        sumMaterialUpdateRequestWarehouse();
    });
    $(document).on('input', '#table-material-update-request-warehouse input.adjustment', function () {
        let quantity = removeformatNumber($(this).val()),
            price = $(this).parents('tr').find('td:eq(4)').find(':selected').data('price');
        $(this).parents('tr').find('td:eq(5)').text(formatNumber(price));
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(quantity * price));
        sumMaterialUpdateRequestWarehouse();
    });
    $('#select-material-update-request-warehouse').unbind('select2:select').on('select2:select', async function () {
        let item = await arrayMaterialUpdateRequestWarehouse.filter(el => el.restaurant_material_id === parseInt($(this).val()))[0];
        let supplier = '';
        jQuery.each(item.suppliers, function (i, v) {
            let select = (i === 0) ? 'selected' : '';
            supplier += `<option ${select} value="${v.id}" data-type="${v.restaurant_id}" data-price="${v.retail_price}" data-wholesale-price="${v.wholesale_price}" data-wholesale-quantity="${v.wholesale_price_quantity}">${v.name} (${formatNumber(v.retail_price)})</option>`;
        })
        let data = {
            'DT_RowIndex': tableMaterialUpdateRequestWarehouse.length,
            // 'restaurant_material_name': item.name + `<br><label class="m-t-2 label label-info">${item.material_unit_full_name}</label>`,
            'restaurant_material_name': item.name + `<div class="tag seemt-blue seemt-bg-blue d-flex" style="width: fit-content !important;">
                                                         <i class="fi-rr-hastag"></i>
                                                         <label class="m-0">${item.material_unit_full_name}</label>
                                                     </div>`,
            'system_last_quantity': item.system_last_quantity,
            'quantity': '<div class="input-group border-group validate-table-validate">\n' +
                '  <input class="form-control adjustment text-center rounded border-0 w-100" data-type="currency-edit" data-max="9999" data-value-min-value-of="0" data-float="1" value="1" >\n' +
                '</div>',
            'suppliers': ' <select class="js-example-basic-single" style="width:max-content !important;" onchange="selectSupplierMaterialOrder($(this))">' + supplier + ' </select>',
            'price': formatNumber(item.suppliers[0].cost_price),
            'total_price': formatNumber(item.suppliers[0].cost_price),
            'action': '<div class="btn-group-sm">' +
                '<button class="tabledit-edit-button btn seemt-btn-hover-blue waves-effect waves-light" onclick="openModalDetailMaterialData(' + item.restaurant_material_id + ')" data-id="' + item.restaurant_material_id + '" data-toggle="tooltip" data-placement="top" data-original-title="Chi tiết"><i class="fi-rr-eye"></i></button>' +
                '<button class="tabledit-edit-button btn seemt-red seemt-btn-hover-red waves-effect waves-light" onclick="removeMaterialUpdateRequestWarehouse($(this))" data-id="' + item.restaurant_material_id + '" data-toggle="tooltip" data-placement="top" data-original-title="Xoá"><i class="fi-rr-trash"></i></button>' +
                '</div>',
            'keysearch': '',
        }
        await addRowDatatableTemplate(tableMaterialUpdateRequestWarehouse, data);
        $('#modal-update-request-warehouse .js-example-basic-single').select2({
            dropdownParent: $('#modal-update-request-warehouse'),
        });
        $('#select-material-update-request-warehouse').val('').trigger('change');
        tableMaterialUpdateRequestWarehouse.draw();
        sumMaterialUpdateRequestWarehouse();
    })
    await dataUpdateRequestWarehouse(id, branch, brand, export_inventory);
    $('#table-material-update-request-warehouse .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-request-warehouse'),
    });
    $('#employee-update-request-warehouse').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeUpdateRequestWarehouse)
    })
    $('[data-toggle="tooltip"]').tooltip();
    $('#send-update-request-warehouse').on('change', function () {
        $(this).tooltip('hide');
    })
}

async function dataUpdateRequestWarehouse(id, branch, brand, export_inventory) {
    let method = 'get',
        url = 'supplier-order.data-update-request',
        params = {brand: brand, branch: branch, id: id, export: export_inventory},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-update-request-warehouse'),
        $('#box-list-update-request-warehouse'),
    ]);
    drawTableUpdateRequestWarehouse(res.data[3].original.data);
    idEmployeeUpdateRequestWarehouse = res.data[0].employee_create_id;
    $('#image-supplier-update-request-order-supplier-order').attr('src', res.data[0].employee_create_avatar);
    $('#branch-update-request-warehouse').text(res.data[0].branch_name);
    $('#inventory-update-request-warehouse').text(res.data[0].inventory);
    $('#date-update-request-warehouse').text(res.data[0].date);
    $('#employee-update-request-warehouse').text(res.data[0].employee_create_full_name);
    $('#create-update-request-warehouse').text(res.data[0].created_at);
    $('#select-material-update-request-warehouse').html(res.data[1]);
    $('#total-amount-update-request-warehouse').html(res.data[4]);
    arrayMaterialUpdateRequestWarehouse = res.data[2];
}

async function drawTableUpdateRequestWarehouse(data) {
    let id = $('#table-material-update-request-warehouse'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'system_last_quantity', name: 'system_last_quantity', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'suppliers', name: 'suppliers', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total_price', name: 'total_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
            ];
    tableMaterialUpdateRequestWarehouse = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

function removeMaterialUpdateRequestWarehouse(r) {
    removeRowDatatableTemplate(tableMaterialUpdateRequestWarehouse, r, true);
    sumMaterialUpdateRequestWarehouse();
}

async function sumMaterialUpdateRequestWarehouse() {
    let total = 0;
    await tableMaterialUpdateRequestWarehouse.rows().every(function () {
        let row = $(this.node());
        total += removeformatNumber(row.find('td:eq(6)').text())
    });
    $('#total-amount-update-request-warehouse').text(formatNumber(total));
}

async function saveModalUpdateRequestWarehouse() {


    if (!checkValidateSave($('#modal-update-request-warehouse'))) return false;
    if (checkSaveUpdateRequestWarehouse !== 0) return false;
    let material = [];
    tableMaterialUpdateRequestWarehouse.rows().every(function () {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(3)').find('input').val()) > 0) {
            material.push({
                "supplier_id": row.find('td:eq(4)').find(':selected').val(),
                "restaurant_material_order_request_detail_id": row.find('td:eq(1) label').data('detail-order-id'),
                "restaurant_material_id": row.find('td:eq(7)').find('button').data('id'),
                "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
                "expected_delivery_time_string": moment().format('DD/MM/YYYY HH:mm'),
                "is_handbook_supplier": (row.find('td:eq(4)').find(':selected').data('type') == 0) ? 0 : 1,
            });
        }
    });
    if (material.length === 0) {
        WarningNotify('Không có nguyên liệu nào có số lượng !');
        return false;
    }
    checkSaveUpdateRequestWarehouse = 1;
    let method = 'post',
        url = 'supplier-order.update-request',
        params = null,
        data = {
            id: idUpdateRequestWarehouse,
            brand: brandUpdateRequestWarehouse,
            branch: branchUpdateRequestWarehouse,
            send: Number($('#send-update-request-warehouse').is(':checked')),
            date: $('#date-update-request-warehouse').text(),
            material: material,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#modal-update-request-warehouse')
    ]);
    checkSaveUpdateRequestWarehouse = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            loadingData();
            closeModalUpdateRequestWarehouse();
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

function cancelRequestWarehouse() {
    let title = 'Hủy phiếu ?',
        icon = 'question',
        element = 'id-cancel-update-order-request';
    sweetAlertInputComponent(title, element, '', icon).then(async (result) => {
        if (result.value) {
            if (checkSaveUpdateRequestWarehouse !== 0) return false;
            checkSaveUpdateRequestWarehouse = 1;
            let method = 'post',
                url = 'supplier-order.cancel-request',
                params = null,
                data = {id: idUpdateRequestWarehouse, reason: result.value};
            let res = await axiosTemplate(method, url, params, data);
            checkSaveUpdateRequestWarehouse = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-cancel-data-to-server').text();
                    SuccessNotify(text);
                    loadingData();
                    closeModalUpdateRequestWarehouse();
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
    })
}

function closeModalUpdateRequestWarehouse() {
    $('#modal-update-request-warehouse').modal('hide');
    $('#send-update-request-warehouse').prop('checked', true);
    shortcut.remove('ESC');
    shortcut.remove('F3');
    shortcut.remove('F4');
    resetModalUpdateRequestWarehouse();
}

function resetModalUpdateRequestWarehouse() {
    $('#branch-update-request-warehouse').text('---');
    $('#inventory-update-request-warehouse').text('---');
    $('#employee-update-request-warehouse').text('---');
    $('#create-update-request-warehouse').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#date-update-request-warehouse').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#send-update-request-warehouse').text('---');
    $('#total-amount-update-request-warehouse').text(0);
    tableMaterialUpdateRequestWarehouse.clear().draw(false);
}

