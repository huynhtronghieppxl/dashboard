let tableUnitFoodData, checkSaveUnitFoodData;
$(function () {
    loadData();
    $(document).on('input paste keyup keydown','#table-unit-food-data_filter input', function (){
        let indexUnit = 1;
        tableUnitFoodData.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(indexUnit)
            indexUnit++;
        })
    })
});

async function loadData() {
    let method = 'get',
        url = 'unit-food-data.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableUnitFoodData(res.data[0].original.data);
    checkSaveUnitFoodData = 0;
}

async function dataTableUnitFoodData(data) {
    let id = $('#table-unit-food-data'),
        scroll_Y = vh_of_table,
        fixed_left = 1,
        fixed_right = 2,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-left', width: '45%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'action', name: 'action', class: 'text-right', width: '45%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [
            {
                'title': 'Thêm mới',
                'icon' : 'fa fa-plus text-primary',
                'class' : '',
                'function' : 'openModalCreateUnitFoodData'
            }
        ]
    ;
    tableUnitFoodData = await DatatableTemplateNew(id, data, columns, scroll_Y, fixed_left, fixed_right, option);
}

function removeUnitFoodData(r) {
    let title = 'Xóa đơn vị món ăn ?',
        content = 'Xóa đơn vị món ăn sẽ không thể lấy lại được !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            if(checkSaveUnitFoodData === 1) return false;
            let url = 'unit-food-data.remove',
                method = 'post',
                params = null,
                data = {
                    id: r.data('id'),
                };
            checkSaveUnitFoodData = 1 ;
            let res = await axiosTemplate(method, url, params,data,[$('#table-unit-food-data')]);
            checkSaveUnitFoodData = 0;
            let text = '';
            switch(res.data.status) {
                case 200:
                    text = $('#success-delete-data-to-server').text();
                    SuccessNotify(text);
                    removeRowDatatableTemplate(tableUnitFoodData, r, true);
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

