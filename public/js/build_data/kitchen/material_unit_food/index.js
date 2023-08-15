let checkSaveChangeMaterialUnitFoodData = 0;
$(function (){
    loadData();
})

async function loadData(){
    let method = 'get',
        restaurant_brand_id = $('.select-branch').val(),
        url = 'material-unit-food.data',
        params = {
            restaurant_brand_id : restaurant_brand_id
        },
        data = null;
        let res = await axiosTemplate(method, url, params,data, [$('#table-material-unit-food-data')])
        await drawDataTableMaterialUnitFood(res)
}

async function drawDataTableMaterialUnitFood(data){
    let idEnable = $('#table-material-unit-food-data'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'material_unit_name', name: 'name', class: 'text-center', width: '30%'},
            {data: 'value_exchange', name: 'value_exchange', class: 'text-center', width: '30%'},
            {data: 'material_unit_specification_exchange_name', name: 'unit_exchange', class: 'text-center', width: '7%'},
            {data: 'action', name: 'action', class: 'text-center', width: '7%'},
            {data : 'keysearch',name:'keysearch',className:'d-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateMaterialUnitFoodData',
        }];
    dataTableUnitEnable = await DatatableTemplateNew(idEnable, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

function changeStatusMaterialUnitFoodData(r){
    let title = 'Tắt đơn vị định lượng này này ?',
        content = '',
        icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if(checkSaveChangeMaterialUnitFoodData !== 0) return false;
            if (result.value) {
                let method = 'post',
                    url = 'material-unit-food-data.change-status',
                    params = null,
                    data = {id: r.data('id')};
                checkSaveChangeMaterialUnitFoodData = 1;
                let res = await axiosTemplate(method, url, params, data, [$('#table-material-unit-food-data')]);
                checkSaveChangeMaterialUnitFoodData = 0;
                switch(res.data.status) {
                    case 200:
                        SuccessNotify($('#success-status-data-to-server').text());
                        loadData();
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message);
                }
            }
        })
}
