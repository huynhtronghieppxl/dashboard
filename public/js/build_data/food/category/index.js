let tableDataEnableCategoryFood,
    thisChangeStatusCategoryFoodData,
    tableDataDisableCategoryFood,
    checkChangeStatusCategoryFood = 0,
    indexDataTabCategoryFoodData = 0;

$(function () {
    $('#tab-category-data a').on('click', function () {
        indexDataTabCategoryFoodData = $(this).data('index')
        updateCookieCategoryFoodData();
    })
    if (getCookieShared('category-food-data-user-id-' + idSession)) {
        let dataCookie = JSON.parse(getCookieShared('category-food-data-user-id-' + idSession));
        indexDataTabCategoryFoodData = dataCookie.index
    }

    $('.select-brand-category-food-data').on('change', function (){
        loadData();
    })

    $('#tab-category-data a[data-index="' + indexDataTabCategoryFoodData + '"]').click()
    $(document).on('input paste keyup keydown','#table-enable-category-food-data_filter, #table-disable-category-food-data_filter input', function (){
        let indexEnable = 1;
        let indexDisable = 1;
        tableDataEnableCategoryFood.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(indexEnable)
            indexEnable++;
        })
        tableDataDisableCategoryFood.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(indexDisable)
            indexDisable++;
        })
        $('#total-record-tab1-category-food-data').text(tableDataEnableCategoryFood.rows({'search':'applied'}).count());
        $('#total-record-tab2-category-food-data').text(tableDataDisableCategoryFood.rows({'search':'applied'}).count());
    })

    loadData();
});

function updateCookieCategoryFoodData() {
    saveCookieShared('category-food-data-user-id-' + idSession, JSON.stringify({
        'index': indexDataTabCategoryFoodData,
    }))
}

async function loadData() {
    let restaurant_brand_id = $('.select-brand-category-food-data').val();
    let method = 'get',
        url = 'category-food-data.data',
        params = {
            restaurant_brand_id: restaurant_brand_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableCategoryFoodData(res);
    dataTotalCategoryFoodData(res.data[2]);
}

async function dataTableCategoryFoodData(data) {
    let tableEnable = $('#table-enable-category-food-data'),
        tableDisable = $('#table-disable-category-food-data'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-left'},
            {data: 'category_type_name', name: 'category_type_name', class: 'text-left'},
            {data: 'description', name: 'description', class: 'text-left'},
            {data: 'action', name: 'action', class: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateCategoryFoodData'
        }];
    tableDataEnableCategoryFood = await DatatableTemplateNew(tableEnable, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableDataDisableCategoryFood = await DatatableTemplateNew(tableDisable, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
}

function dataTotalCategoryFoodData(data) {
    $('#total-record-tab1-category-food-data').text(data.total_record_enable);
    $('#total-record-tab2-category-food-data').text(data.total_record_disable);
}

function changeStatusCategoryFoodData(r) {
    thisChangeStatusCategoryFoodData = r;
    if (checkChangeStatusCategoryFood === 1) return false;
    let id = r.data('id');
    let status = r.data('status');
    let title, content;
    if (status === 0) {
        title = $('#notify-on-update-status-component').text();
    } else {
        title = $('#notify-off-update-status-component').text();
    }
    let icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'category-food-data.change-status',
                params = null,
                data = {id: id};
            checkChangeStatusCategoryFood = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkChangeStatusCategoryFood = 0
            switch (res.data.status) {
                case 200:
                    if(status === 1){
                        text = $('#success-status-cancle').text();
                    }
                    else {
                        text = $('#success-status-active').text();
                    }
                    SuccessNotify(text);
                    drawDataChangeStatus(res.data.data);
                    break;
                case 300:
                    openModalNotifyFoodCategoryData()
                    $('#message-change-status-food-category-data').text(res.data.message)
                    drawTableChangeStatusCategoryFoodData(res.data.data)
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    ErrorNotify(text);
                default:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}

async function drawTableChangeStatusCategoryFoodData(data) {
    let tableChangeStatusCategoryFood = $('#table-change-status-food-category-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnFood = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-left', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-left', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableFood = await DatatableTemplateNew(tableChangeStatusCategoryFood, data.original.data, columnFood, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste', '#table-change-status-material-order-data_filter input', function () {
        let indexFood = 1;
        dataTableFood.rows({'search': 'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexFood)
            indexFood++;
        });
    })
}

async function drawDataChangeStatus(data) {
    if (data.status === 1) {
        $('#total-record-tab1-category-food-data').text(formatNumber(removeformatNumber($('#total-record-tab1-category-food-data').text()) + 1));
        $('#total-record-tab2-category-food-data').text(formatNumber(removeformatNumber($('#total-record-tab2-category-food-data').text()) - 1));
        removeRowDatatableTemplate(tableDataDisableCategoryFood, thisChangeStatusCategoryFoodData, true);
        addRowDatatableTemplate(tableDataEnableCategoryFood, {
            'name': data.name,
            'category_type_name': data.category_type_name,
            'material_category': data.material_category,
            'description': data.description,
            'action': data.action,
            'keysearch': data.keysearch,
        });
    } else {
        $('#total-record-tab1-category-food-data').text(formatNumber(removeformatNumber($('#total-record-tab1-category-food-data').text()) - 1));
        $('#total-record-tab2-category-food-data').text(formatNumber(removeformatNumber($('#total-record-tab2-category-food-data').text()) + 1));
        removeRowDatatableTemplate(tableDataEnableCategoryFood, thisChangeStatusCategoryFoodData, true);
        addRowDatatableTemplate(tableDataDisableCategoryFood, {
            'name': data.name,
            'category_type_name': data.category_type_name,
            'material_category': data.material_category,
            'description': data.description,
            'action': data.action,
            'keysearch': data.keysearch,
        });
    }
}

