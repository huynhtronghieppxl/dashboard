let idMaterialUnitOrderData;
function openModalMaterialUnitOrderData(id) {
    $('#modal-material-unit-order-data').modal('show');
    idMaterialUnitOrderData = id.data('id');
    addLoading('unit-order-data.material', '#loading-modal-material-unit-order-data');
    shortcut.add('ESC', function () {
        closeModalMaterialUnitOrderData();
    });
    loadDataMaterial()
}

async function loadDataMaterial() {
    let method = "get",
        url = "unit-order-data.material",
        params = {id: idMaterialUnitOrderData},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-material-unit-order-data"),
    ]);
    dataTableMaterialUnitOrderData(res);
}

async function dataTableMaterialUnitOrderData(data) {
    let id = $("#table-material-unit-order-data"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", class: "text-center", width: "5%",},
            {data: "restaurant_material_name", name: "restaurant_material_name", class: "text-left"},
            {data: "material_unit_quantification_name", name: "material_unit_quantification_name", class: "text-left"},
            {data: "material_unit_specification_name", name: "material_unit_specification_name", class: "text-left"},
            {data: "exchange_value", name: "exchange_value", class: "text-center"},
            {data: "action", name: "action", class: "text-right", width: '5%'},
            {data: "keysearch", name: "keysearch", className: "d-none"},
        ],
        option = [];
    DatatableTemplateNew(id, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

function closeModalMaterialUnitOrderData() {
    $('#modal-material-unit-order-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
}

