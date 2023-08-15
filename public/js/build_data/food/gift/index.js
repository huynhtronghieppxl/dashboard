let tableFoodData, tableFoodGiftData, checkSaveAssignFoodGiftData, selectCategory = -1;
$(function () {
    shortcut.add('F4', function () {
        saveAssignFoodGiftData();
    });

    $('#select-category-gift-food-brand-manage').on('change', function () {
        selectCategory = $(this).val()
        loadData()
    })
    $('.select-brand-gift-food').on('change', function () {
        category()
        selectCategory=-1;
        loadData()
    })
    category()
    loadData()
})

async function loadData() {
    let method = 'get',
        restaurant_brand_id = $('.select-brand-gift-food').val(),
        params = {brand: restaurant_brand_id, category : selectCategory},
        data = null,
        url1 = 'gift-food-data.data';
    let res = await axiosTemplate(method, url1, params, data, [$('#body-list-food-data'), $('#body-list-food-gift-data')]);
    dataTableFoodData(res);
    checkSaveAssignFoodGiftData = 0;
}

async function category(){
    let method = 'get',
        params = {brand: $('.select-brand-gift-food').val()},
        data = null,
        url = 'gift-food-data.category';
    let res = await axiosTemplate(method, url, params, data, [$('#select-category-gift-food-brand-manage')]);
    $('#select-category-gift-food-brand-manage').html(res.data[0]);
}

async function dataTableFoodData(data) {
    let id = $('#table-food-data'),
        id2 = $('#table-gift-food-data'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name_avatar', name: 'name_avatar', width: '5%',  className: 'text-left'},
            {data: 'category_name', name: 'category_type_name', className: 'text-left'},
            {data: 'detail', name: 'detail', className: 'text-center', width: '5%'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},
        ],
        column1 = [
            {data: 'action', name: 'action', width: '5%'},
            {data: 'name_avatar', name: 'name_avatar', width: '5%', className: 'text-left'},
            {data: 'category_name', name: 'category_type_name', className: 'text-left'},
            {data: 'detail', name: 'detail', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'text-center d-none'},
        ];
    let  option = [
        {
            'title': 'Cập nhật',
            'icon' : 'fa fa-upload',
            'class' : '',
            'function' : 'saveAssignFoodGiftData'
        }
    ];
    tableFoodData = await DatatableTemplateNew(id, data.data[0].original.data, column, vh_of_table, fixed_left, 2,[], '', false);
    tableFoodGiftData = await DatatableTemplateNew(id2, data.data[1].original.data, column1, vh_of_table, 1, fixed_right,option, '', false);
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"transition" : "all .2s linear","opacity": "0.5", "pointer-events": "none"});

}
function checkFoodGiftData(r){
    let item = {
        'id': r.data('id'),
        'name_avatar': r.parents('tr').find('td:eq(0)').html(),
        'category_name': r.parents('tr').find('td:eq(1)').text(),
        'detail': r.parents('tr').find('td:eq(2)').html(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckFoodGiftData($(this))" data-id="' + r.data('id') + '" data-type="0"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch' : r.parents('tr').find('td:eq(1)').text(),
    };
    addRowDatatableTemplate(tableFoodGiftData, item);
    tableFoodData.row(r.parents('tr')).remove().draw(false);
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});
}
function unCheckFoodGiftData(r){
    let item = {
        'id': r.data('id'),
        'name_avatar': r.parents('tr').find('td:eq(1)').html(),
        'category_name': r.parents('tr').find('td:eq(2)').text(),
        'detail': r.parents('tr').find('td:eq(3)').html(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkFoodGiftData($(this))" data-id="' + r.data('id') + '" data-type="1"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch' : r.parents('tr').find('td:eq(4)').text(),
    };
    addRowDatatableTemplate(tableFoodData, item);
    tableFoodGiftData.row(r.parents('tr')).remove().draw(false);
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});

}

async function checkAllFoodGiftData() {
    await addAllRowDatatableTemplate(tableFoodData, tableFoodGiftData, itemFoodGiftDraw);
    tableFoodGiftData.page('last').draw(false);
    $(tableFoodGiftData.table().node()).parent().scrollTop($(tableFoodGiftData.table().node()).parent().get(0).scrollHeight);
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});

}
async function unCheckAllFoodGiftData() {
    await addAllRowDatatableTemplate(tableFoodGiftData, tableFoodData, itemFoodDraw);
        tableFoodData.page('last').draw(false);
    $(tableFoodData.table().node()).parent().scrollTop($(tableFoodData.table().node()).parent().get(0).scrollHeight);
    $('#body-brand-supplier-data .toolbar-button-datatable').css({"transition" : "","opacity": "", "pointer-events": ""});

}


function itemFoodGiftDraw(r) {
    return {
        'id': r.find('td:eq(3)').find('button').data('id'),
        'name_avatar': r.find('td:eq(0)').html(),
        'category_name': r.find('td:eq(1)').text(),
        'detail': r.find('td:eq(2)').html(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckFoodGiftData($(this))" data-id="' + r.find('td:eq(3)').find('button').data('id') + '" data-type="0"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch' : r.find('td:eq(1)').text(),
    };
}
function itemFoodDraw(r) {
    return {
        'id': r.find('td:eq(0)').find('button').data('id'),
        'name_avatar': r.find('td:eq(1)').html(),
        'category_name': r.find('td:eq(2)').text(),
        'detail': r.find('td:eq(3)').html(),
        'action': '<div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkFoodGiftData($(this))" data-id="' + r.find('td:eq(0)').find('button').data('id') + '" data-type="1"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch' : r.find('td:eq(3)').text(),
    };
}

async function saveAssignFoodGiftData() {
    if (checkSaveAssignFoodGiftData === 1) return false;
    let foods = [],
        foods_gift = [],
        restaurant_brand_id = $('.select-brand-gift-food').val();
    tableFoodGiftData.rows().every(function (){
       let x = $(this.node());
       if(x.find('td:eq(0)').find('button').data('type') === 0){
            foods.push(x.find('td:eq(0)').find('button').data('id'))
        }
    })

    tableFoodData.rows().every(function (){
        let x = $(this.node());
        if(x.find('td:eq(3)').find('button').data('type') === 1){
            foods_gift.push(x.find('td:eq(3)').find('button').data('id'))
        }
    })
    checkSaveAssignFoodGiftData = 1;
    let method = 'post',
        url = 'gift-food-data.assign-gift-food',
        params = null,
        data = {
            restaurant_brand_id: restaurant_brand_id,
            food_ids: foods,
            food_gift_ids: foods_gift,
        };
    let res = await axiosTemplate(method, url, params, data,[$('#content-body-techres')]);
    checkSaveAssignFoodGiftData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify('Cập nhật thành công!');
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}
