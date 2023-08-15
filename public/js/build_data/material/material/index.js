let dataTableMaterial,
    dataTableGoods,
    dataTableInternal,
    dataTableOther,
    dataTableDisable,
    dataMaterialServer,
    dataGoodsServer,
    dataInternalServer,
    dataOtherServer,
    inventoryCurrentMaterialData = 1,
    thisStatusMaterialData,
    checkChangeStatusMaterialData = 0,
    tabMaterialDataChange = 0;

$(function () {
    if (getCookieShared('material-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('material-data-user-id-' + idSession));
        tabMaterialDataChange = dataCookie.tabMaterialDataChange;
    }

    $('#nav-material-data .nav-link').on('click', function () {
        tabMaterialDataChange = $(this).data('tab');
        updateCookieMaterialData()
    })

    $('#nav-material-data .nav-link[data-tab="' + tabMaterialDataChange + '"]').click();
    $(document).on('input paste keyup keydown', '#table-material-material-data_filter input', function () {
        $('#total-record-material').text(dataTableMaterial.rows({'search': 'applied'}).count());
        searchUpdateIndex(dataTableMaterial)
    })
    $(document).on('input paste keyup keydown', '#table-goods-material-data_filter  input', function () {
        $('#total-record-goods').text(dataTableGoods.rows({'search': 'applied'}).count());
        searchUpdateIndex(dataTableGoods)
    })
    $(document).on('input paste keyup keydown', '#table-internal-material-data_filter  input', function () {
        $('#total-record-material-internal').text(dataTableInternal.rows({'search': 'applied'}).count());
        searchUpdateIndex(dataTableInternal)
    })
    $(document).on('input paste keyup keydown', '#table-other-material-data_filter input', function () {
        $('#total-record-other').text(dataTableOther.rows({'search': 'applied'}).count());
        searchUpdateIndex(dataTableOther)
    })
    $(document).on('input paste keyup keydown', '#table-off-material-data_filter input', function () {
        $('#total-record-off').text(dataTableDisable.rows({'search': 'applied'}).count());
        searchUpdateIndex(dataTableDisable)
    })
    loadData();
});

function updateCookieMaterialData() {
    saveCookieShared('material-data-user-id-' + idSession, JSON.stringify({
        tabMaterialDataChange: tabMaterialDataChange
    }))
}

async function searchUpdateIndex(datatable) {
    let index = 1;
    await datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

async function loadData() {
    let method = 'get',
        url = 'material-data.data',
        params = {
            'type_material': $('#select-material-type-material-data').val(),
            'type_goods': $('#select-goods-type-material-data').val(),
            'type_internal': $('#select-internal-type-material-data').val(),
            'type_other': $('#select-other-type-material-data').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-material-material-data'), $('#table-goods-material-data'), $('#table-internal-material-data'), $('#table-other-material-data'), $('#table-off-material-data')]);
    dataMaterialServer = res.data[0].original.data;
    dataGoodsServer = res.data[1].original.data;
    dataInternalServer = res.data[2].original.data;
    dataOtherServer = res.data[3].original.data;
    dataTableMaterialData(res);
    dataTotalMaterialData(res.data[5]);
}

async function dataTableMaterialData(data) {
    let table_material = $('#table-material-material-data'),
        table_good = $('#table-goods-material-data'),
        table_internal = $('#table-internal-material-data'),
        table_other = $('#table-other-material-data'),
        table_off = $('#table-off-material-data'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'is_office_material', name: 'is_office_material', className: 'text-center'},
            {data: 'category_type_name', name: 'category_type_name', className: 'text-left'},
            {data: 'material_category.name', name: 'material_category.name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'is_office_material', name: 'is_office_material', className: 'text-center'},
            {data: 'category_type_parent_name', name: 'category_type_parent_name', className: 'text-left'},
            {data: 'category_type_name', name: 'category_type_name', className: 'text-left'},
            {data: 'material_category.name', name: 'material_category.name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        fixed_left = 1,
        fixed_right = 0,
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateMaterial',
        }];
    dataTableMaterial = await DatatableTemplateNew(table_material, data.data[0].original.data, column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableGoods = await DatatableTemplateNew(table_good, data.data[1].original.data, column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableInternal = await DatatableTemplateNew(table_internal, data.data[2].original.data, column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableOther = await DatatableTemplateNew(table_other, data.data[3].original.data, column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableDisable = await DatatableTemplateNew(table_off, data.data[4].original.data, column2, vh_of_table, fixed_left, fixed_right, option);

    $('#select-material-type-material-data').on('change', function () {
        dataTableMaterial.column(3).search($(this).find('option:selected').val()).draw(false);
        $('#total-record-material').text(dataTableMaterial.rows({'search': 'applied'}).count());
        $('input[type=search]').val('')
    })

    $('#select-goods-type-material-data').on('change', function () {
        dataTableGoods.column(3).search($(this).find('option:selected').val()).draw(false);
        $('#total-record-goods').text(dataTableGoods.rows({'search': 'applied'}).count());
        $('input[type=search]').val('')
    })


    $('#select-internal-type-material-data').on('change', function () {
        dataTableInternal.column(3).search($(this).find('option:selected').val()).draw(false);
        $('#total-record-material-internal').text(dataTableInternal.rows({'search': 'applied'}).count());
        $('input[type=search]').val('')
    })

    $('#select-other-type-material-data').on('change', function () {
        dataTableOther.column(3).search($(this).find('option:selected').val()).draw(false);
        $('#total-record-other').text(dataTableOther.rows({'search': 'applied'}).count());
        $('input[type=search]').val('')
    })

    $('#select-type-off-material-data').on('change', function () {
        dataTableDisable.search($(this).find('option:selected').val()).draw(false);
        $('#total-record-off').text(dataTableDisable.rows({'search': 'applied'}).count());
        $('input[type=search]').val('')
    })
}

function changeActiveTabMaterialData(tab) {
    if (tab == 4) {
        inventoryCurrentMaterialData = inventoryCurrentMaterialData
        $('.toolbar-button-datatable').addClass('d-none')

    } else {
        inventoryCurrentMaterialData = tab;
        $('.toolbar-button-datatable').removeClass('d-none')
    }
}

function dataTotalMaterialData(data) {
    $('#total-record-material').text(data.total_material);
    $('#total-record-goods').text(data.total_goods);
    $('#total-record-material-internal').text(data.total_material_internal);
    $('#total-record-other').text(data.total_other);
    $('#total-record-off').text(data.total_off);
}

function changeStatusMaterialData(r) {
    thisStatusMaterialData = r;
    if (checkChangeStatusMaterialData === 1) return false;
    let title = '',
        content = '',
        icon = 'question';
    if (r.data('status') === 0) {
        title = 'Bật hoạt động nguyên liệu này ?';
        content = 'Nguyên liệu được phục hồi vào kho ' + r.data('inventory').toLowerCase();
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                let method = 'post',
                    url = 'material-data.change-status',
                    params = null,
                    data = {id: r.data('id'), status: r.data('status')};
                checkChangeStatusMaterialData = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#table-off-material-data')]);
                checkChangeStatusMaterialData = 0;
                switch (res.data.status) {
                    case 200:
                        SuccessNotify($('#success-status-data-to-server').text());
                        drawTableEnableMaterialData(res.data.data);
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message);
                }
            }
        })
    } else {
        title = 'Tạm ngưng nguyên liệu này ?';
        content = '';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                let method = 'post',
                    url = 'material-data.change-status',
                    params = null,
                    data = {id: r.data('id'), is_confirmed: 0, status: r.data('status')};
                checkChangeStatusMaterialData = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#table-material-material-data'), $('#table-goods-material-data'), $('#table-internal-material-data'), $('#table-other-material-data')]);
                checkChangeStatusMaterialData = 0;
                switch (res.data.status) {
                    case 200:
                        SuccessNotify($('#success-status-data-to-server').text());
                        drawTableDisableMaterialData(res.data.data);
                        break;
                    case 205:
                        openModalNotifyMaterialData();
                        $('#message-change-status-material-order-data').text(res.data.message);
                        $('#title-change-status-material-food-data').addClass('d-none');
                        $('#title-change-status-material-order-data').removeClass('d-none');
                        drawTableChangeStatusMaterialOrderData(res);
                        break;
                    case 300:
                        openModalNotifyMaterialData();
                        $('#message-change-status-material-food-data').text(res.data.message);
                        $('#title-change-status-material-food-data').removeClass('d-none');
                        $('#title-change-status-material-order-data').addClass('d-none');
                        drawTableChangeStatusMaterialFoodData(res)
                        break;
                    default:
                        WarningNotify(res.data.message);
                }
            }
        })
    }
}

async function changeStatusMaterialConfirm() {
    let method = 'post',
        url = 'material-data.change-status',
        params = null,
        data = {id: thisStatusMaterialData.data('id'), is_confirmed: 1};
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = $('#success-status-data-to-server').text();
        SuccessNotify(text);
        drawTableDisableMaterialData(res.data.data);
        closeModalNotifyMaterialData()
    } else if (res.data.status === 205) {
        closeModalNotifyMaterialData()
        openModalNotifyMaterialData();
        $('#message-change-status-material-order-data').text(res.data.message);
        $('#title-change-status-material-food-data').addClass('d-none');
        $('#title-change-status-material-order-data').removeClass('d-none');
        drawTableChangeStatusMaterialOrderData(res);
        closeModalNotifyMaterialData()
    }
}

async function drawTableChangeStatusMaterialFoodData(data) {
    $('#table-change-status-enable-material-food-data').removeClass('d-none')
    let tableChangeStatusMaterialFood = $('#table-change-status-material-food-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnFood = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableFood = await DatatableTemplateNew(tableChangeStatusMaterialFood, data.data.data.original.data, columnFood, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste', '#table-change-status-material-order-data_filter input', function () {
        let indexFood = 1;
        dataTableFood.rows({'search': 'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexFood)
            indexFood++;
        });
    })
}

async function drawTableChangeStatusMaterialOrderData(data) {
    $('#table-change-status-enable-material-order-data').removeClass('d-none')
    let tableChangeStatusMaterialOrder = $('#table-change-status-material-order-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnOrder = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-left', width: '10%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'supplier_name', name: 'supplier_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableOrder = await DatatableTemplateNew(tableChangeStatusMaterialOrder, data.data.data.original.data, columnOrder, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste', '#table-change-status-material-order-data_filter input', function () {
        let indexOrder = 1;
        dataTableOrder.rows({'search': 'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexOrder)
            indexOrder++;
        });
    })
}

function drawTableDisableMaterialData(data) {
    switch (data.category_type_parent_id) {
        case 1:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) + 1));
            $('#total-record-material').text(formatNumber(removeformatNumber($('#total-record-material').text()) - 1));
            removeRowDatatableTemplate(dataTableMaterial, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableDisable, {
                'name': data.name,
                'category_type_parent_name': data.category_type_parent_name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 2:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) + 1));
            $('#total-record-goods').text(formatNumber(removeformatNumber($('#total-record-goods').text()) - 1));
            removeRowDatatableTemplate(dataTableGoods, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableDisable, {
                'name': data.name,
                'category_type_parent_name': data.category_type_parent_name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 3:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) + 1));
            $('#total-record-material-internal').text(formatNumber(removeformatNumber($('#total-record-material-internal').text()) - 1));
            removeRowDatatableTemplate(dataTableInternal, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableDisable, {
                'name': data.name,
                'category_type_parent_name': data.category_type_parent_name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 12:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) + 1));
            $('#total-record-other').text(formatNumber(removeformatNumber($('#total-record-other').text()) - 1));
            removeRowDatatableTemplate(dataTableOther, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableDisable, {
                'name': data.name,
                'category_type_parent_name': data.category_type_parent_name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}

function drawTableEnableMaterialData(data) {
    switch (data.category_type_parent_id) {
        case 1:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) - 1));
            $('#total-record-material').text(formatNumber(removeformatNumber($('#total-record-material').text()) + 1));
            removeRowDatatableTemplate(dataTableDisable, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableMaterial, {
                'name': data.name,
                'is_office_material': data.is_office_material,
                'category_type_name': data.category_type_name,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 2:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) - 1));
            $('#total-record-goods').text(formatNumber(removeformatNumber($('#total-record-goods').text()) + 1));
            removeRowDatatableTemplate(dataTableDisable, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableGoods, {
                'name': data.name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 3:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) - 1));
            $('#total-record-material-internal').text(formatNumber(removeformatNumber($('#total-record-material-internal').text()) + 1));
            removeRowDatatableTemplate(dataTableDisable, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableInternal, {
                'name': data.name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
        case 12:
            $('#total-record-off').text(formatNumber(removeformatNumber($('#total-record-off').text()) - 1));
            $('#total-record-other').text(formatNumber(removeformatNumber($('#total-record-other').text()) + 1));
            removeRowDatatableTemplate(dataTableDisable, thisStatusMaterialData, true);
            addRowDatatableTemplate(dataTableOther, {
                'name': data.name,
                'category_type_name': data.category_type_name,
                'is_office_material': data.is_office_material,
                'material_category': data.material_category,
                'price': formatNumber(data.price),
                'action': data.action,
                'keysearch': data.keysearch,
            });
            break;
    }
}


