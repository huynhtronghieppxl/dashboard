let checkSaveReceivedOrderSupplierOrder = 0,
    idReceivedOrderSupplierOrder,
    supplierReceivedOrderSupplierOrder,
    brandReceivedOrderSupplierOrder,
    branchReceivedOrderSupplierOrder,
    idOrderRequestReceivedOrderSupplierOrder,
    tableMaterialReceivedOrderSupplierOrder,
    dataOrderRequestCompare;

function openReceivedOrderSupplierOrder(id, supplier, branch, brand) {
    $('#modal-received-order-supplier-order').modal('show');
    checkSaveReceivedOrderSupplierOrder = 0;
    supplierReceivedOrderSupplierOrder = supplier;
    idReceivedOrderSupplierOrder = id;
    brandReceivedOrderSupplierOrder = brand;
    branchReceivedOrderSupplierOrder = branch;
    shortcut.add('ESC', function () {
        closeModalReceivedOrderSupplierOrder();
    });
    shortcut.add('F4', function () {
        saveModalReceivedOrderSupplierOrder();
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalReceivedOrderSupplierOrder();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalReceivedOrderSupplierOrder();
        });
    });
    dateTimePickerTemplate($('#date-received-supplier-order'), '', moment().format('MM/DD/YYYY'));
    $(document).on('input', '#table-material-received-order-supplier-order input.adjustment', function () {
        let quantity = removeformatNumber($(this).val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(5) input').val());
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(Math.round(quantity * price)));
        sumTotalReceivedOrderSupplierOrder();
    });
    $('#select-type-discount-employee-manage').select2({
        dropdownParent: $('#modal-received-order-supplier-order'),
    })
    $('#select-type-discount-employee-manage').on('change', function (){
        if($('#select-type-discount-employee-manage').find('option:selected').val() == 1){
            $('#discount-received-order-supplier-order').parents('.form-group').removeClass('d-none');
            $('#discount-price-received-order-supplier-order').parents('.form-group').addClass('d-none');
            // $('#discount-price-received-order-supplier-order').val(0);
            $('#text-discount-received-order-supplier-order').removeClass('d-none');
        }else {
            $('#discount-price-received-order-supplier-order').parents('.form-group').removeClass('d-none');
            $('#discount-received-order-supplier-order').parents('.form-group').addClass('d-none');
            // $('#discount-received-order-supplier-order').val(0);
            $('#text-discount-received-order-supplier-order').addClass('d-none');
        }
        sumTotalReceivedOrderSupplierOrder();
    })

    $(document).on('input', '#table-material-received-order-supplier-order input.price', function () {
        let price = removeformatNumber($(this).val()),
            quantity = removeformatNumber($(this).parents('tr').find('td:eq(3) input').val());
        $(this).parents('tr').find('td:eq(6)').text(formatNumber(quantity * price));
        sumTotalReceivedOrderSupplierOrder();
    });
    $('#vat-received-order-supplier-order, #discount-received-order-supplier-order , #discount-price-received-order-supplier-order').on('input', function () {
        sumTotalReceivedOrderSupplierOrder();
    });
    dataReceivedOrderSupplierOrder(id, supplier, branch, brand);
}

async function sumTotalReceivedOrderSupplierOrder() {
    let total = 0;
    await tableMaterialReceivedOrderSupplierOrder.rows().every(function (index, element) {
        let row = $(this.node());
        total += removeformatNumber(row.find('td:eq(6)').text());
    });
    $('#discount-price-received-order-supplier-order').attr('data-max', total)
    let discountPercent =0;
    let discount = 0;
    if($('#select-type-discount-employee-manage').find('option:selected').val() == 1){
        discountPercent = removeformatNumber($('#discount-received-order-supplier-order').val());
        let amount = removeformatNumber($('#amount-received-order-supplier-order').text());
        if (parseFloat(discountPercent) > 100) discountPercent = 100;
        discount = Math.round((discountPercent / 100) * amount * 100) /100;
        $('#text-discount-received-order-supplier-order').text(formatNumber(discount));
    }else {
        discount = removeformatNumber($('#discount-price-received-order-supplier-order').val());
        if(discount > total){
            discount = total;
        }
    }

    let vatPercent = removeformatNumber($('#vat-received-order-supplier-order').val());
    if (parseFloat(vatPercent) > 100) vatPercent = 100;
    let vat = (vatPercent / 100) * (total - discount);
    $('#amount-received-order-supplier-order').text(formatNumber(total));
    $('#text-vat-received-order-supplier-order').text(formatNumber(vat.toFixed()));
    $('#total-amount-received-order-supplier-order').text(formatNumber(total - discount + vat));
}

async function dataReceivedOrderSupplierOrder(id, supplier, branch, brand) {
    let method = 'get',
        url = 'supplier-order.data-received-order',
        params = {id: id, supplier: supplier, brand: brand, branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-received-order-supplier-order'),
        $('#box-list-received-order-supplier-order'),
    ]);
    if (res.data[0].restaurant_id === 0) {
        $('#discount-received-order-supplier-order').prop('disabled', true);
        $('#vat-received-order-supplier-order').prop('disabled', true);
    } else {
        $('#discount-received-order-supplier-order').prop('disabled', false);
        $('#vat-received-order-supplier-order').prop('disabled', false);
    }
    $('#date-received-supplier-order').val(moment().format('DD/MM/YYYY'))
    $('#branch-received-order-supplier-order').text(res.data[0].branch_name);
    $('#code-received-order-supplier-order').text(res.data[0].code);
    $('#supplier-received-order-supplier-order').text(res.data[0].supplier_name);
    $('#image-supplier-received-order-supplier-order').attr('src', res.data[0].supplier_avatar);
    $('#date-received-order-supplier-order').text(res.data[0].delivery_at);
    $('#employee-received-order-supplier-order').text(res.data[0].employee_created_full_name);
    $('#image-employee-received-order-supplier-order').attr('src', res.data[0].employee_created_avatar);
    $('#create-received-order-supplier-order').text(res.data[0].created_at);
    $('#amount-received-order-supplier-order').text(formatNumber(res.data[0].amount));
    if(res.data[0].discount_percent != 0){
        $('#discount-received-order-supplier-order').parents('.form-group').removeClass('d-none');
        $('#discount-price-received-order-supplier-order').parents('.form-group').addClass('d-none');
        $('#text-discount-received-order-supplier-order').removeClass('d-none');
        $('#discount-price-received-order-supplier-order').val(0);
        $('#discount-received-order-supplier-order').val(res.data[0].discount_percent);
        $('#text-discount-received-order-supplier-order').text(formatNumber(res.data[0].discount_amount));
        $('#select-type-discount-employee-manage').val(1).trigger('change.select2');
    }else {
        $('#discount-received-order-supplier-order').parents('.form-group').addClass('d-none');
        $('#discount-price-received-order-supplier-order').parents('.form-group').removeClass('d-none');
        $('#text-discount-received-order-supplier-order').addClass('d-none');
        $('#discount-price-received-order-supplier-order').val(formatNumber(res.data[0].discount_amount));
        $('#select-type-discount-employee-manage').val(0).trigger('change.select2');
    }
    $('#vat-received-order-supplier-order').val(res.data[0].vat);
    $('#text-vat-received-order-supplier-order').text(formatNumber(res.data[0].vat_amount));
    $('#total-amount-received-order-supplier-order').text(formatNumber(res.data[0].total_amount));
    idOrderRequestReceivedOrderSupplierOrder = res.data[0].restaurant_material_order_request_id;
    drawTableReceivedOrderSupplierOrder(res.data[1].original.data);
}

async function drawTableReceivedOrderSupplierOrder(data) {
    let id = $('#table-material-received-order-supplier-order'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'request_quantity', name: 'request_quantity', className: 'text-center'},
            {data: 'accept_quantity', name: 'accept_quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'price_reality', name: 'price_reality', className: 'text-center'},
            {data: 'total_price_reality', name: 'total_price_reality', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tableMaterialReceivedOrderSupplierOrder = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

async function saveModalReceivedOrderSupplierOrder() {
    if (checkSaveReceivedOrderSupplierOrder !== 0) return false;
    if (!checkValidateSave($('#modal-received-order-supplier-order'))) return false;
    let material = [],
        vat = $('#vat-received-order-supplier-order').val(),
        discount = ($('#select-type-discount-employee-manage option:selected').val() == 1) ? $('#discount-received-order-supplier-order').val() : 0,
        discountAmount = ($('#select-type-discount-employee-manage option:selected').val() == 0) ? $('#discount-price-received-order-supplier-order').val() : 0,
        received = $('#date-received-supplier-order').val() + ' 00:00';
    await tableMaterialReceivedOrderSupplierOrder.rows().every(function (index, element) {
        let row = $(this.node());
        material[index] = {
            "supplier_order_detail_id": row.find('td:eq(7)').find('button').data('id'),
            "supplier_material_id": row.find('td:eq(7)').find('button').data('material'),
            "quantity": removeformatNumber(row.find('td:eq(3)').find('input').val()),
            "price_reality": removeformatNumber(row.find('td:eq(5)').find('input').val()),
        };
    });
    checkSaveReceivedOrderSupplierOrder = 1;
    let method = 'post',
        url = 'supplier-order.received-order',
        params = null,
        data = {
            id: idReceivedOrderSupplierOrder,
            supplier: supplierReceivedOrderSupplierOrder,
            brand: brandReceivedOrderSupplierOrder,
            branch: branchReceivedOrderSupplierOrder,
            material: material,
            vat: vat,
            discount: $('#select-type-discount-employee-manage').find('option:selected').val() == 0 ? 0 : discount,
            discount_amount : $('#select-type-discount-employee-manage').find('option:selected').val() == 1 ? 0 : removeformatNumber(discountAmount),
            received: received,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-received-order-supplier-order')]);
    checkSaveReceivedOrderSupplierOrder = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-status-data-to-server').text();
            closeModalReceivedOrderSupplierOrder();
            SuccessNotify(text);
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

async function dataOrderRequestReceivedOrderSupplierOrder() {
    let method = 'get',
        url = 'supplier-order.data-request',
        params = {
            brand: brandReceivedOrderSupplierOrder,
            branch: branchReceivedOrderSupplierOrder,
            id: idOrderRequestReceivedOrderSupplierOrder
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#select-branch-create-out-inventory-manage').val(res.data[0].branch_id).trigger('change.select2');
    await $('#select-inventory-create-out-inventory-manage').val(res.data[0].material_category_type_parent_id).trigger('change.select2');
    if (res.data[0].material_category_type_parent_id === 1) {
        $('#select-inventory-target-create-out-inventory-manage').val(2).trigger('change.select2');
    } else {
        $('#select-inventory-target-create-out-inventory-manage').val(1).trigger('change.select2');
    }
    dataOrderRequestCompare = res.data[1];
}

function cancelOrderSupplierOrder(id) {
    if (id === undefined) id = idReceivedOrderSupplierOrder;
    if (checkSaveReceivedOrderSupplierOrder !== 0) return false;
    let title = 'Hủy phiếu ?',
        icon = 'question',
        element = 'id-cancel-order-supplier';
    sweetAlertInputComponent(title, element, '', icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'supplier-order.cancel-order',
                params = null,
                data = {id: id, reason: result.value};
            checkSaveReceivedOrderSupplierOrder = 1;
            let res = await axiosTemplate(method, url, params, data);
            checkSaveReceivedOrderSupplierOrder = 0;
            let text = '';
            switch(res.data.status) {
                case 200:
                    text = $('#success-cancel-data-to-server').text();
                    SuccessNotify(text);
                    loadingData();
                    closeModalUpdateRestaurantSupplierOrder();
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

function closeModalReceivedOrderSupplierOrder() {
    $('#modal-received-order-supplier-order').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
    tableMaterialReceivedOrderSupplierOrder.clear().draw(false);
    resetModalReceivedOrderSupplierOrder();
}

function resetModalReceivedOrderSupplierOrder() {
    $('#branch-received-order-supplier-order').text('---');
    $('#code-received-order-supplier-order').text('---');
    $('#employee-received-order-supplier-order').text('---');
    $('#supplier-received-order-supplier-order').text('---');
    $('#date-received-order-supplier-order').text(moment().format('DD/MM/YYYY'));
    $('#date-received-supplier-order').text(moment().format('DD/MM/YYYY'));
    $('#total-amount-received-order-supplier-order').text(0);
    $('#amount-received-order-supplier-order').text(0);
    $('#text-discount-received-order-supplier-order').text(0);
    $('#text-vat-received-order-supplier-order').text(0);
    $('#select-type-discount-employee-manage').find('option:first').trigger('change.select2');
    $('#discount-received-order-supplier-order').val(0);
    $('#discount-price-received-order-supplier-order').val(0);
}
