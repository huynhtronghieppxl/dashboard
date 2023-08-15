let dataTableUnitOrder, checkSaveDeleteUnitOrderData = 0;
$(function () {
    loadData();
});

async function loadData() {
    let method = "get",
        url = "unit-order-data.data",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-unit-order-data"),
    ]);
    dataTableUnitOrderData(res);
}

async function dataTableUnitOrderData(data) {
    let id = $("#table-unit-order-data"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", class: "text-center", width: "5%",},
            {data: "name", name: "name", class: "text-left"},
            {data: "total_material_unit_map", name: "total_material_unit_map", class: "text-center"},
            {data: "action", name: "action", class: "text-right", width: '10%'},
            {data: "keysearch", name: "keysearch", className: "d-none"},
        ],
        option = [
            {
                title: "Thêm mới",
                icon: "fa fa-plus text-primary",
                class: "",
                function: "openModalCreateUnitOrderData",
            },
        ];
    dataTableUnitOrder = await DatatableTemplateNew(id, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

async function deleteUnitOrderData(r) {
    if (checkSaveDeleteUnitOrderData === 1) return false;
    let title = 'Xoá đơn vị bán ?',
        content = 'Đơn vị bán nếu không còn sử dụng được phép xoá, sau khi xoá không thể khôi phục !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                checkSaveDeleteUnitOrderData = 1;
                let method = 'post',
                    url = 'unit-order-data.delete',
                    params = null,
                    data = {id: r.data('id')};
                let res = await axiosTemplate(method, url, params, data);
                checkSaveDeleteUnitOrderData = 0;
                switch (res.data.status) {
                    case 200:
                        SuccessNotify('Xóa đơn vị bán thành công');
                        removeRowDatatableTemplate(dataTableUnitOrder, r, true);
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        if (res.data.message !== null) {
                            WarningNotify(res.data.data.message);

                        }
                }
            }
        }
    )
}
