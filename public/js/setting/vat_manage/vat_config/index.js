let checkSaveUpdateVAT = 0;
$(function () {
    loadData();
})
async function loadData() {
    let method = 'get',
        url = ' vat-setting.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-not-update-vat-setting')]);
    drawDataTableVatSetting(res.data[0].original.data);
}

function drawDataTableVatSetting(data) {
    let
        idTableNotUpdateVatSetting = $('#table-not-update-vat-setting'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center border-resize-datatable', width: '4%'},
            {data: 'vat_config_name', name: 'vat_config_name', className: 'text-left', width:'24%' },
            {data: 'percent', name: 'percent', className: 'text-center f-w-600' , width:'24%'},
            {data: 'detail_food',name:'detail_food', className: 'text-center' , width:'24%'},
            {data: 'keysearch', className:'d-none'}
        ],
        option = []
    DatatableTemplateNew(idTableNotUpdateVatSetting, data, column, vh_of_table, fixed_left, fixed_right, option);
}
