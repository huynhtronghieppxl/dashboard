let checkSaveUpdateOrderWaitingSupplier = 0,
    checkCancelUpdateOrderWaitingSupplier = 0,
    idOrderWaitingSupplierConfirm,
    brandUpdateOrderWaitingSupplier,
    branchUpdateOrderWaitingSupplier,
    tableMaterialUpdateOrderWaitingSupplier,
    typeUpdateOrderWaitingSupplier;

function openUpdateOrderWaitingSupplier(id, branch, brand) {
    $('#modal-update-order-waiting-supplier').modal('show');
    idOrderWaitingSupplierConfirm = id;
    brandUpdateOrderWaitingSupplier = brand;
    branchUpdateOrderWaitingSupplier = branch;
    shortcut.add('ESC', closeModalUpdateOrderWaitingSupplier);
    shortcut.add('F4', saveModalUpdateOrderWaitingSupplier);
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', closeModalUpdateOrderWaitingSupplier);
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', closeModalUpdateOrderWaitingSupplier);
    });
    // $(document).on('input', '#table-material-update-order-waiting-supplier input.adjustment', function () {
    //     let quantity = removeformatNumber($(this).val()),
    //         price = removeformatNumber($(this).parents('tr').find('td:eq(3)').text());
    //     $(this).parents('tr').find('td:eq(4)').text(formatNumber(quantity * price));
    //     sumMaterialUpdateRestaurantSupplierOrder();
    // });
    //
    dataUpdateRestaurantSupplierOrder(id);
}

async function sumMaterialUpdateRestaurantSupplierOrder() {
    let total = 0;
    await tableMaterialUpdateOrderWaitingSupplier.rows().every(function (index, element) {
        let row = $(this.node());
        total += removeformatNumber(row.find('td:eq(4)').text())
    });
    $('#total-amount-update-order-waiting-supplier').text(formatNumber(total));
}

async function dataUpdateRestaurantSupplierOrder(id) {
    let method = 'get',
        url = 'goods-purchase-warehouse.data-update-order-waiting-supplier',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-update-order-waiting-supplier'),
        $('#boxlist-update-order-waiting-supplier')
    ]);
    $('#branch-update-order-waiting-supplier').text(res.data[0].branch_name);
    $('#supplier-update-order-waiting-supplier').text(res.data[0].supplier_name);
    $('#image-supplier-update-order-waiting-supplier').attr('src',res.data[0].supplier_avatar);
    $('#date-update-order-waiting-supplier').text(res.data[0].expected_delivery_time);
    $('#employee-update-order-waiting-supplier').text(res.data[0].employee_created_full_name);
    $('#employee-update-order-waiting-supplier').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[0].employee_created_id +')');
    $('#image-employee-update-order-waiting-supplier').attr('src',res.data[0].employee_created_avatar);
    $('#create-update-order-waiting-supplier').text(res.data[0].created_at);
    drawTableUpdateRestaurantSupplierOrder(res.data[1].original.data);
    $('#total-amount-update-order-waiting-supplier').text(res.data[0].supplier_amount);
    typeUpdateOrderWaitingSupplier = res.data[0].type;
}

async function drawTableUpdateRestaurantSupplierOrder(data) {
    let id = $('#table-material-update-order-waiting-supplier'),
        fixed_left = 2,
        fixed_right = 2,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center', width: '10%'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'total_price', name: 'total_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    tableMaterialUpdateOrderWaitingSupplier = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

async function saveModalUpdateOrderWaitingSupplier() {
    if (!checkValidateSave($('#modal-update-order-waiting-supplier'))) return false;
    if (checkSaveUpdateOrderWaitingSupplier === 1) return false;
    let material = [];
    tableMaterialUpdateOrderWaitingSupplier.rows().every(function (index, element) {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(2)').find('input').val()) > 0) {
            material.push({
                "supplier_order_request_detail_id": row.find('td:eq(5)').find('button').data('id'),
                "supplier_id": row.find('td:eq(5)').find('button').data('supplier'),
                "restaurant_material_id": row.find('td:eq(5)').find('button').data('id-restaurant'),
                "supplier_material_id": row.find('td:eq(5)').find('button').data('id-supplier'),
                "quantity": removeformatNumber(row.find('td:eq(2)').find('input').val()),
                "is_handbook_supplier": typeUpdateOrderWaitingSupplier,
            });
        }
    });
    if (material.length === 0) {
        WarningNotify('Không có nguyên liệu nào có số lượng !');
        return false;
    }
    checkSaveUpdateOrderWaitingSupplier = 1;
    let method = 'post',
        url = 'supplier-order.update-restaurant',
        params = null,
        data = {
            id: idOrderWaitingSupplierConfirm,
            brand: brandUpdateOrderWaitingSupplier,
            branch: branchUpdateOrderWaitingSupplier,
            material: material,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-order-waiting-supplier')
    ]);
    checkSaveUpdateOrderWaitingSupplier = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            loadData();
            closeModalUpdateOrderWaitingSupplier();
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

function  cancelRestaurantSupplierOrder() {
    let title = 'Hủy phiếu ?',
        icon = 'question',
        element = 'input-reason-alert-cancel-restaurant-order';
    sweetAlertInputComponent(title, element, '' ,icon).then(async (result) => {
        if (result.value) {
            if (checkCancelUpdateOrderWaitingSupplier === 1) return false;
            checkCancelUpdateOrderWaitingSupplier = 1;
            let method = 'post',
                url = 'goods-purchase-warehouse.cancel-order-waiting-supplier',
                reason = result.value,
                params = null,
                data = {id: idOrderWaitingSupplierConfirm, reason: reason};
            let res = await axiosTemplate(method, url, params, data);
            checkCancelUpdateOrderWaitingSupplier = 0;
            let text = '';
            switch (res.data.status) {
                case 200:
                    text = $('#success-cancel-data-to-server').text();
                    SuccessNotify(text);
                    loadData();
                    closeModalUpdateOrderWaitingSupplier();
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

function closeModalUpdateOrderWaitingSupplier() {
    $('#modal-update-order-waiting-supplier').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F3');
    shortcut.remove('F4');
    resetModalUpdateRestaurantSupplierOrder();
    tableMaterialUpdateOrderWaitingSupplier.clear().draw(false);
}

function resetModalUpdateRestaurantSupplierOrder() {
    $('#branch-update-order-waiting-supplier').text('---');
    $('#supplier-update-order-waiting-supplier').text('---');
    $('#employee-update-order-waiting-supplier').text('---');
    $('#date-update-order-waiting-supplier').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#create-update-order-waiting-supplier').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-amount-update-order-waiting-supplier').text(0);
}
