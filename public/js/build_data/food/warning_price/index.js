let tableWarningFoodData, tableWarningDrinkData,
tableWarningOtherData, tableWarningComboData,
tableWarningAdditionData, category_type = $('#tabs-warning-price-food-data .nav-link.active').data('category-type');
$(function (){
    loadData()
    $('#tabs-warning-price-food-data .nav-link').on('click', function (){
        category_type = $(this).data('category-type');
        loadData();
    })
})


async function loadData(){
    let method = 'get',
        url = 'warning-price-food.data',
        params = {
            restaurant_brand_id : $('.select-brand').val(),
            category_type : category_type
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    dataTableWarningFoodData(res.data[0].original.data);
}

async function dataTableWarningFoodData(data) {
    let id1 = $('#table-food-food-warning-price-data'),
        id2 = $('#table-food-drink-warning-price-data'),
        id3 = $('#table-food-other-warning-price-data'),
        id4 = $('#table-food-combo-warning-price-data'),
        id5 = $('#table-food-addition-warning-price-data'),
        scroll_Y = vh_of_table,
        fixed_left = 0,
        fixed_right = 2,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-center'},
            {data: 'percent', name: 'percent', class: 'text-center'},
            {data: 'action', name: 'action', class: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [];
    tableWarningFoodData = await DatatableTemplateNew(id1, data, columns, scroll_Y, fixed_left, fixed_right, option);
    tableWarningDrinkData = await DatatableTemplateNew(id2, data, columns, scroll_Y, fixed_left, fixed_right, option);
    tableWarningOtherData = await DatatableTemplateNew(id3, data, columns, scroll_Y, fixed_left, fixed_right, option);
    tableWarningComboData = await DatatableTemplateNew(id4, data, columns, scroll_Y, fixed_left, fixed_right, option);
    tableWarningAdditionData = await DatatableTemplateNew(id5, data, columns, scroll_Y, fixed_left, fixed_right, option);

}


function openModalUpdateWarningPriceFoodData(r){
    if($('.new-table').find('.seemt-btn-hover-red.d-none').length == 20){
        r.parent().find('.seemt-btn-hover-green').removeClass('d-none');
        r.parent().find('.seemt-btn-hover-red').removeClass('d-none');
        r.addClass('d-none');
        let max = '';
        let min = '';
        switch (r.parents('tr').index()){
            case 0:
                max = r.parents('tbody').find('tr:eq(1)').find('td:eq(3)').find('.seemt-btn-hover-orange').data('to');
                r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').attr('data-max', max )
                r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').attr('data-min', min )
                r.parents('tr').find('td:eq(2)').find('.box-group span:last').addClass('d-none');
                r.parents('tr').find('td:eq(2)').find('.border-group:last').removeClass('d-none');
                break;
            case 1:
                max = 100;
                min = r.parents('tbody').find('tr:eq(0)').find('td:eq(3)').find('.seemt-btn-hover-orange').data('to');
                r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').attr('data-max', max )
                r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').attr('data-min', min )
                r.parents('tr').find('td:eq(2)').find('.box-group:last span').addClass('d-none');
                r.parents('tr').find('td:eq(2)').find('.border-group:last').removeClass('d-none');
                break;
            case 2:
                max = 100;
                min = r.parents('tbody').find('tr:eq(0)').find('td:eq(3)').find('.seemt-btn-hover-orange').data('to');
                r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').attr('data-max', max )
                r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').attr('data-min', min )
                r.parents('tr').find('td:eq(2)').find('.box-group:last span').addClass('d-none');
                r.parents('tr').find('td:eq(2)').find('.border-group:last').removeClass('d-none');
        }
    }else {
        WarningNotify('Vui lòng lưu lại!!');
    }
}

function closeWarningPriceFoodData(r){
    r.parent().find('.seemt-btn-hover-green').addClass('d-none');
    r.parent().find('.seemt-btn-hover-red').addClass('d-none');
    r.parent().find('.seemt-btn-hover-orange').removeClass('d-none');
    switch (r.parents('tr').index()){
        case 0:
            r.parents('tr').find('td:eq(2)').find('.box-group span:last').removeClass('d-none');
            r.parents('tr').find('td:eq(2)').find('.border-group:last').addClass('d-none');
            break;
        case 1:
            r.parents('tr').find('td:eq(2)').find('.box-group span').removeClass('d-none');
            r.parents('tr').find('td:eq(2)').find('.border-group').addClass('d-none');
            r.parents('tr').find('td:eq(2)').find('.box-group:first').find('.border-group input').val(r.data('from'))
            r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').val(r.data('to'));
            r.parents('tr').find('td:eq(2)').find('.box-group:first').find('span').text(r.data('from') + '%')
            r.parents('tr').find('td:eq(2)').find('.box-group:last').find('span').text(r.data('to') + '%');
            break;
        case 2:
            r.parents('tr').find('td:eq(2)').find('.box-group span').removeClass('d-none');
            r.parents('tr').find('td:eq(2)').find('.border-group').addClass('d-none');
            r.parents('tr').find('td:eq(2)').find('.box-group:first').find('.border-group input').val(r.data('from'))
            r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').val(r.data('to'));
            r.parents('tr').find('td:eq(2)').find('.box-group:first').find('span').text(r.data('from') + '%')
            r.parents('tr').find('td:eq(2)').find('.box-group:last').find('span').text(r.data('to') + '%');
    }
}

async function saveWarningPriceFoodData(r){
    if (!checkValidateSave($('#table-warning-food-data'))) return false;
    let from = r.data('status') == 0 ? 0 : r.parents('tr').find('td:eq(2)').find('.box-group:first').find('.border-group input').val()
    let method = 'post',
        url = 'warning-price-food.update',
        params = null,
        data = {
            id : r.data('id'),
            from : from,
            to : r.parents('tr').find('td:eq(2)').find('.box-group:last').find('.border-group input').val(),
            name : r.parents('tr').find('td:eq(1)').text(),
            category_type: category_type,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeWarningPriceFoodData(r);
            loadData()
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


