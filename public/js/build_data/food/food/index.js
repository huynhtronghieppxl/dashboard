let dataCodeUploadLogoFood = [],
    dataUnitFoodData,
    dataCategoryFoodData,
    dataVatFoodData,
    dataCategoryFoodNotDrinkOtherData,
    dataCategoryFood,
    dataCategoryDrink,
    dataCategoryOther,
    dataMaxUploadLogoFood = [],
    categoryFoodData, isCombo, isSpecialGift, isAddition,
    dataListFood, indexDataTabFoodData = 0, categoryTypeId, categoryData, categoryDataDefault,
    dataTableFood, dataTableFoodDrink, dataTableFoodSea, dataTableFoodOther, dataTableFoodCombo, dataTableFoodAddition;
$(async function () {
    loadData();
    $('#tabs-food-data a').on('click',function (){
        $('.select-category-food-data').html(categoryData);
        indexDataTabFoodData = $(this).data('index');
        if(indexDataTabFoodData == 4) {
            shortcut.remove('F2');
            shortcut.add('F2', function () {
                openModalCreateFoodComboManage();
            });
        } else if(indexDataTabFoodData == 5) {
            shortcut.remove('F2');
            shortcut.add('F2', function () {
                openModalCreateFoodAdditionManage();
            });
        } else {
            shortcut.remove('F2');
            shortcut.add('F2', function () {
                openModalCreateFoodManage();
            });
        }
        categoryTypeId = $(this).data('category-type');
        isCombo = $(this).data('combo');
        isSpecialGift = $(this).data('special_gift');
        isAddition = $(this).data('addition')
        categoryFoodData = -1
        switch (categoryTypeId){
            case 1:
                $('.select-category-food-data-food').val(-1).trigger('change.select2');
                break
            case 2:
                $('#select-category-food-data-drink').val(-1).trigger('change.select2');
                break
            case 3:
                $('#select-category-food-data-other').val(-1).trigger('change.select2');
                break;
            default:
                $('.select-category-food-data').html(categoryDataDefault);

        }
        foodBuildData()
        updateCookieFoodData();
    })
    $('.select-category-food-data-food').on('select2:select', function () {
        categoryFoodData = $(this).val();
        updateCookieFoodData()
        foodBuildData();
    });
    $('#select-category-food-data-drink').on('select2:select', function () {
        categoryFoodData = $(this).val();
        updateCookieFoodData()
        foodBuildData();
    });
    $('#select-category-food-data-other').on('select2:select', function () {
        categoryFoodData = $(this).val();
        updateCookieFoodData()
        foodBuildData();
    });

    if(getCookieShared('food-data-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('food-data-id-' + idSession));
        indexDataTabFoodData = dataCookie.index
        categoryFoodData = dataCookie.idCategoryFoodData
    }
    $('#tabs-food-data a[data-index="' + indexDataTabFoodData + '"]').click()
});
async function loadData(){
    await loadDataCreateUpdateFoodManage();
    foodBuildData();
}

async function loadDataUpdateFood(){
    let brand = $('.select-brand').val(),
        url = 'food-brand-manage.data-update',
        method = 'get',
        params = {brand: brand},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataUnitFoodBrandManage = res.data[0];
    dataCategoryFoodBrandManage = res.data[1];
    dataVatFoodBrandManage = res.data[2];
    dataFoodNoteFoodBrandManage = res.data[3];
    dataCategoryComboFoodBrandManage = res.data[5];
}

async function foodBuildData() {
    let brand = $('.select-brand').val(),
        url = 'food-data.data',
        method = 'get',
        params = {
            brand: brand,
            category_id :categoryFoodData
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-food-food-data'), $('#table-drink-food-data'), $('#table-sea-food-food-data'), $('#table-other-food-data'), $('#table-combo-food-data'), $('#table-gift-food-data'), $('#table-addition-food-data')]);
    dataTableFoodBrandManage(res);
    dataTotalFoodBrandManage(res.data[7]);
    dataCodeUploadLogoFood = res.data[8];
    dataListFood = res.data[9];
}

async function loadDataCreateUpdateFoodManage(){
    let brand = $('.select-brand').val(),
        url = 'food-data-manage.data-create',
        method = 'get',
        params = {
            brand: brand,
            category_type: categoryTypeId,
            },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    loadDataUpdateFood();
    dataUnitFoodData = res.data[0];
    dataCategoryFoodData = res.data[1];
    dataVatFoodData = res.data[2];
    dataCategoryFoodNotDrinkOtherData = res.data[4];
    dataCategoryFood = res.data[5];
    dataCategoryDrink = res.data[6];
    dataCategoryOther = res.data[7];
    $('.select-category-food-data-food').html(res.data[5])
    $('#select-category-food-data-drink').html(res.data[6])
    $('#select-category-food-data-other').html(res.data[7])
}

async function dataTableFoodBrandManage(data) {
    let id1 = $('#table-food-food-data'),
        id2 = $('#table-drink-food-data'),
        id3 = $('#table-sea-food-food-data'),
        id4 = $('#table-other-food-data'),
        id5 = $('#table-combo-food-data'),
        id7 = $('#table-addition-food-data'),
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name_avatar', name: 'name_avatar', class: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'vat', name: 'vat', className: 'text-right'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-right'},
            {data: 'profit_rate_by_original_price', name: 'profit_rate_by_original_price', className: 'text-right'},
            {data: 'profit_rate_by_price', name: 'profit_rate_by_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name_avatar', name: 'name_avatar', class: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-right'},
            {data: 'vat', name: 'vat', className: 'text-right'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-right'},
            {data: 'profit_rate_by_original_price', name: 'profit_rate_by_original_price', className: 'text-right'},
            {data: 'profit_rate_by_price', name: 'profit_rate_by_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        fixed_left = 3,
        fixed_right = 1,
        option = [
            {
                'title': 'Cập nhật ảnh',
                'icon': 'fa fa-image  ',
                'class': '',
                'function': 'openModalUploadImageFoodManage',
            },{
                'title': 'Tạo món thường',
                'icon': 'icofont icofont-burger  ',
                'class': '',
                'function': 'openModalCreateFoodManage',
            }
        ],
        option1 = [
            {
                'title': 'Cập nhật ảnh',
                'icon': 'fa fa-image ',
                'class': '',
                'function': 'openModalUploadImageFoodManage',
            },{
                'title': 'Tạo món combo',
                'icon': 'icofont icofont-fast-food  ',
                'class': '',
                'function': 'openModalCreateFoodComboManage',
            },
        ],
        option2 = [
            {
                'title': 'Cập nhật ảnh',
                'icon': 'fa fa-image  ',
                'class': '',
                'function': 'openModalUploadImageFoodManage',
            },
            {
                'title': 'Tạo món bán kèm',
                'icon': 'fa fa-plus  ',
                'class': '',
                'function': 'openModalCreateFoodAdditionManage',
            },
        ]

    dataTableFood = await DatatableTemplateNew(id1, data.data[0], column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodDrink = await DatatableTemplateNew(id2, data.data[1], column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodSea = await DatatableTemplateNew(id3, data.data[2], column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodOther = await DatatableTemplateNew(id4, data.data[3], column1, vh_of_table, fixed_left, fixed_right, option);
    dataTableFoodCombo = await  DatatableTemplateNew(id5, data.data[4], column2, vh_of_table, fixed_left, fixed_right, option1);
    dataTableFoodAddition = await  DatatableTemplateNew(id7, data.data[6], column1, vh_of_table, fixed_left, fixed_right, option2);
    $(document).on('input paste keyup','input[type="search"]', function (){
        $('#total-record-food').text(formatNumber(dataTableFood.rows({'search': 'applied'}).count()))
        $('#total-record-drink').text(formatNumber(dataTableFoodDrink.rows({'search': 'applied'}).count()))
        $('#total-record-other').text(formatNumber(dataTableFoodOther.rows({'search': 'applied'}).count()))
        $('#total-record-combo').text(formatNumber(dataTableFoodCombo.rows({'search': 'applied'}).count()))
        $('#total-record-addition').text(formatNumber(dataTableFoodAddition.rows({'search': 'applied'}).count()))
        searchUpdateIndexDataTable(dataTableFood)
        searchUpdateIndexDataTable(dataTableFoodDrink)
        searchUpdateIndexDataTable(dataTableFoodSea)
        searchUpdateIndexDataTable(dataTableFoodOther)
        searchUpdateIndexDataTable(dataTableFoodCombo)
        searchUpdateIndexDataTable(dataTableFoodAddition)

    })
}

function dataTotalFoodBrandManage(data) {
    $('#total-record-food').text(data.total_record_food);
    $('#total-record-drink').text(data.total_record_drink);
    $('#total-record-sea-food').text(data.total_record_seafood);
    $('#total-record-other').text(data.total_record_other);
    $('#total-record-combo').text(data.total_record_combo);
    $('#total-record-gift').text(data.total_record_gift);
    $('#total-record-addition').text(data.total_record_addition);
    $('#total-record-disable').text(data.total_record_disable);
}
function updateCookieFoodData(){
    saveCookieShared('food-data-id-' + idSession, JSON.stringify({
        'index' : indexDataTabFoodData,
        'idCategoryFoodData': categoryFoodData
    }))
}

