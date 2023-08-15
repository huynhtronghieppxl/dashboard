let checkSaveUpdateRestaurantSupplierOrder = 0,
    idUpdateRestaurantSupplierOrder,
    brandUpdateRestaurantSupplierOrder,
    branchUpdateRestaurantSupplierOrder,
    typeUpdateRestaurantSupplierOrder,
    tableMaterialUpdateRestaurantSupplierOrder, idEmployeeUpdateDetailRestaurant;

function openUpdateRestaurantSupplierOrder(id, branch, brand) {
    $('#modal-update-restaurant-supplier-order').modal('show');
    $('#date-update-restaurant-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#create-update-restaurant-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-amount-update-restaurant-supplier-order').text(0);
    checkSaveUpdateRestaurantSupplierOrder = 0;
    idUpdateRestaurantSupplierOrder = id;
    brandUpdateRestaurantSupplierOrder = brand;
    branchUpdateRestaurantSupplierOrder = branch;
    shortcut.add('ESC', function () {
        closeModalUpdateRestaurantSupplierOrder();
    });
    shortcut.add('F4', function () {
        saveModalUpdateRestaurantSupplierOrder();
    });

    $(document).on('input', '#table-material-update-restaurant-supplier-order input.adjustment', function () {
        let quantity = removeformatNumber($(this).val()),
            price = removeformatNumber($(this).parents('tr').find('td:eq(3)').text());
        $(this).parents('tr').find('td:eq(4)').text(formatNumber(Math.round(quantity * price)));
        sumMaterialUpdateRestaurantSupplierOrder();
    });

    dataUpdateRestaurantSupplierOrder(id);
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalUpdateRestaurantSupplierOrder();
        });
    });
    $('#modal-detail-employee-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalUpdateRestaurantSupplierOrder();
        });
    });
    $('#employee-update-restaurant-supplier-order').on('click', function () {
        openModalInfoEmployeeManage(idEmployeeUpdateDetailRestaurant);
    })
}

async function sumMaterialUpdateRestaurantSupplierOrder() {
    let total = 0;
    await tableMaterialUpdateRestaurantSupplierOrder.rows().every(function (index, element) {
        let row = $(this.node());
        total += removeformatNumber(row.find('td:eq(4)').text())
    });
    $('#total-amount-update-restaurant-supplier-order').text(formatNumber(total));
}

async function dataUpdateRestaurantSupplierOrder(id) {
    let method = 'get',
        url = 'supplier-order.data-update-restaurant',
        params = {id: id, branch: $('.select-branch').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-material-update-restaurant-supplier-order'),
        $('#boxlist-update-restaurant-supplier-order')
    ]);
    $('#branch-update-restaurant-supplier-order').text(res.data[0].branch_name);
    $('#supplier-update-restaurant-supplier-order').text(res.data[0].supplier_name);
    $('#image-supplier-update-restaurant-supplier-order').attr('src',res.data[0].supplier_avatar);
    $('#date-update-restaurant-supplier-order').text(res.data[0].expected_delivery_time);
    $('#employee-update-restaurant-supplier-order').text(res.data[0].employee_created_full_name);
    $('#image-employee-update-restaurant-supplier-order').attr('src',res.data[0].employee_created_avatar);
    $('#create-update-restaurant-supplier-order').text(res.data[0].created_at);
    drawTableUpdateRestaurantSupplierOrder(res.data[1].original.data);
    $('#total-amount-update-restaurant-supplier-order').text(res.data[0].supplier_amount);
    idEmployeeUpdateDetailRestaurant = res.data[0].employee_created_id;
    typeUpdateRestaurantSupplierOrder = res.data[0].type;

}

async function drawTableUpdateRestaurantSupplierOrder(data) {
    let id = $('#table-material-update-restaurant-supplier-order'),
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
    tableMaterialUpdateRestaurantSupplierOrder = await DatatableTemplateNew(id, data, column, '40vh', fixed_left, fixed_right);
}

async function saveModalUpdateRestaurantSupplierOrder() {
    if (!checkValidateSave($('#modal-update-restaurant-supplier-order'))) return false;
    if (checkSaveUpdateRestaurantSupplierOrder !== 0) return false;
    let material = [];
    tableMaterialUpdateRestaurantSupplierOrder.rows().every(function (index, element) {
        let row = $(this.node());
        if (removeformatNumber(row.find('td:eq(2)').find('input').val()) > 0) {
            material.push({
                "supplier_order_request_detail_id": row.find('td:eq(5)').find('button').data('id'),
                "supplier_id": row.find('td:eq(5)').find('button').data('supplier'),
                "restaurant_material_id": row.find('td:eq(5)').find('button').data('id-restaurant'),
                "supplier_material_id": row.find('td:eq(5)').find('button').data('id-supplier'),
                "quantity": removeformatNumber(row.find('td:eq(2)').find('input').val()),
                "is_handbook_supplier": typeUpdateRestaurantSupplierOrder,
            });
        }
    });
    if (material.length === 0) {
        WarningNotify('Không có nguyên liệu nào có số lượng !');
        return false;
    }
    checkSaveUpdateRestaurantSupplierOrder = 1;
    let method = 'post',
        url = 'supplier-order.update-restaurant',
        params = null,
        data = {
            id: idUpdateRestaurantSupplierOrder,
            brand: brandUpdateRestaurantSupplierOrder,
            branch: branchUpdateRestaurantSupplierOrder,
            material: material,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-restaurant-supplier-order')
    ]);
    checkSaveUpdateRestaurantSupplierOrder = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
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

function  cancelRestaurantSupplierOrder() {
    let title = 'Hủy phiếu ?',
        icon = 'question',
        element = 'input-reason-alert-cancel-restaurant-order';
    sweetAlertInputComponent(title, element, '' ,icon).then(async (result) => {
        if (result.value) {
            if (checkSaveUpdateRestaurantSupplierOrder !== 0) return false;
            checkSaveUpdateRestaurantSupplierOrder = 1;
            let method = 'post',
                url = 'supplier-order.cancel-restaurant',
                reason = result.value,
                params = null,
                data = {id: idUpdateRestaurantSupplierOrder, reason: reason};
            let res = await axiosTemplate(method, url, params, data);
            checkSaveUpdateRestaurantSupplierOrder = 0;
            let text = '';
            switch (res.data.status) {
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

function closeModalUpdateRestaurantSupplierOrder() {
    $('#modal-update-restaurant-supplier-order').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F3');
    shortcut.remove('F4');
    resetModalUpdateRestaurantSupplierOrder();
    tableMaterialUpdateRestaurantSupplierOrder.clear().draw(false);
}

function resetModalUpdateRestaurantSupplierOrder() {
    $('#branch-update-restaurant-supplier-order').text('---');
    $('#supplier-update-restaurant-supplier-order').text('---');
    $('#employee-update-restaurant-supplier-order').text('---');
    $('#date-update-restaurant-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#create-update-restaurant-supplier-order').text(moment().format('DD/MM/YYYY') + ' ' + moment().format('HH:mm'));
    $('#total-amount-update-restaurant-supplier-order').text(0);
}
