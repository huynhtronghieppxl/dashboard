let checkSaveReasonsCancelFoodData = 0, tableReasonsCancelFoodData;

$(function () {
    shortcut.add("F2",function() {
        openModalCreateReasonsCancelFoodData();
    });
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'reasons-cancel-food-data.data',
        restaurant_brand_id = $('#select-brand-reasons-cancel-food-data').val(),
        params = {restaurant_brand_id: restaurant_brand_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-reasons-cancel-food')]);
    dataTableReasonsCancelFoodData(res.data[0].original.data)
}

async function dataTableReasonsCancelFoodData(data) {
    let id = $('#table-reasons-cancel-food'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'content', name: 'content', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center px-3', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateReasonsCancelFoodData',
        }],
        scroll_Y = "65vh",
        fixedLeft = 2,
        fixedRight = 1;
    tableReasonsCancelFoodData = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight,option)

    $(document).on('input paste keyup','input[type="search"]', async function (){
        let index = 1;
        await tableReasonsCancelFoodData.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
}

function removeReasonsCancelFoodData(r) {
    if (checkSaveReasonsCancelFoodData === 1) return false;
    let title = 'Xóa lý do huỷ món ?',
        content = 'Xóa lý do huỷ món sẽ không thể lấy lại được !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkSaveReasonsCancelFoodData = 1;
            let url = 'reasons-cancel-food-data.remove',
                method = 'post',
                params = null,
                data = {
                    id: r.data('id'),
                    restaurant_brand_id: $('.select-brand').val()
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-point-data')]);
            checkSaveReasonsCancelFoodData = 0;
            let text = '';
            switch(res.data.status) {
                case 200:
                    text = $('#success-delete-data-to-server').text();
                    SuccessNotify(text);
                    removeRowDatatableTemplate(tableReasonsCancelFoodData, r, true);
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



