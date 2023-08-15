let dataDisableFoodBranchManage,categoryFoodBranchManage, indexDataTabFoodBranchManage = 0;

$(function () {
    shortcut.add('F4',function (){
        openModalChangeKitchenFoodManage();
    })
    $('.select-category-food-branch-manage').on('select2:select', function () {
        $('.select-category-food-branch-manage').val($(this).val()).trigger('change.select2');
        categoryFoodBranchManage = $(this).val();
        updateCookieFoodBranchManage();
        loadDataEnableFoodBranchManage()
    });
    $('#tabs-food-branch-manage a').on('click',function (){
        indexDataTabFoodBranchManage = $(this).data('index');
        updateCookieFoodBranchManage();
    })
    loadData();
    if(getCookieShared('cookieFoodBranchManage')){
        let dataCookie = JSON.parse(getCookieShared('cookieFoodBranchManage'));
        indexDataTabFoodBranchManage = dataCookie.index
        categoryFoodBranchManage = dataCookie.idCategoryFoodBranchManage
    }
    $('#tabs-food-branch-manage a[data-index="' + indexDataTabFoodBranchManage + '"]').click()
});

async function loadData(){
    await sortCategoryFoodBranchManage()
    loadDataEnableFoodBranchManage();
    loadDataDisableFoodBranchManage();
    loadDataTableAreaByFoodBranchManage();
    $(document).on('select2:select', '#select-food-branch',function () {
        loadDataPriceByAreaFoodBranchManage();
    })
}

async function loadDataTableAreaByFoodBranchManage(){
    await loadDataEnableFoodBranchManage();
    loadDataPriceByAreaFoodBranchManage();
}

async function loadDataEnableFoodBranchManage() {
    let brand = $('.select-brand').val(),
        branch = $('#change_branch').val(),
        url = 'food-branch-manage.data',
        method = 'get',
        params = {
            brand: brand,
            branch: branch,
            category_id: categoryFoodBranchManage,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres'),
    ]);
    dataTableFoodBranchManage(res);
    dataTotalFoodBranchManage(res.data[7]);
    $('#select-food-branch').html(res.data[8]);
}

async function sortCategoryFoodBranchManage() {
    let brand = $('.select-brand').val(),
        url = 'food-branch-manage.category',
        method = 'get',
        params = {
            brand: brand,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('.select-category-food-branch-manage').html(res.data[0])
    $('.select-category-food-branch-manage').val(categoryFoodBranchManage).trigger('change.select2')
}

function dataTableFoodBranchManage(data) {
    let idFoodFood = $('#table-food-food-branch-manage'),
        idDrinkFood = $('#table-drink-food-branch-manage'),
        idSeaFood = $('#table-sea-food-food-branch-manage'),
        idOtherFood = $('#table-other-food-branch-manage'),
        idComboFood = $('#table-combo-food-branch-manage'),
        idAdditionFood = $('#table-addition-food-branch-manage'),
        columnNormalFood = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'white-space-normal', width: '20%'},
            {data: 'unit_type', name: 'unit_type', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'original_percent', name: 'original_percent', className: 'text-center'},
            {data: 'total_temporary_price', name: 'total_temporary_price', className: 'text-center'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-center'},
            {data: 'material_count', name: 'material_count', className: 'text-center'},
            {data: 'restaurant_kitchen_place_name', name: 'restaurant_kitchen_place_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        columnFoodCombo = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'white-space-normal', width: '20%'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'original_percent', name: 'original_percent', className: 'text-center'},
            {data: 'total_temporary_price', name: 'total_temporary_price', className: 'text-center'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Chuyển bếp',
                'icon': 'fa fa-exchange text-info',
                'class': '',
                'function': 'openModalChangeKitchenFoodManage',
            }
        ],
        fixed_left = 0,
        fixed_right = 0;
    DatatableTemplateNew(idFoodFood, data.data[0], columnNormalFood, vh_of_table, fixed_left, fixed_right, option);
    DatatableTemplateNew(idDrinkFood, data.data[1], columnNormalFood, vh_of_table, fixed_left, fixed_right, option);
    DatatableTemplateNew(idSeaFood, data.data[2], columnNormalFood, vh_of_table, fixed_left, fixed_right, option);
    DatatableTemplateNew(idOtherFood, data.data[3], columnNormalFood, vh_of_table, fixed_left, fixed_right, option);
    DatatableTemplateNew(idComboFood, data.data[4], columnFoodCombo, vh_of_table, fixed_left, fixed_right, option);
    DatatableTemplateNew(idAdditionFood, data.data[6], columnNormalFood, vh_of_table, fixed_left, fixed_right, option);

}
async function loadDataDisableFoodBranchManage() {
    if (dataDisableFoodBranchManage === 1) return false;
    let brand = $('.select-brand').val(),
        branch = $('#change_branch').val(),
        url = 'food-branch-manage.data-disable',
        method = 'get',
        params = {brand: brand, branch: branch},
        data = null;
    dataDisableFoodBranchManage = 1;
    let res = await axiosTemplate(method, url, params, data,[
        $('#content-body-techres'),
    ]);
    dataDisableFoodBranchManage = 0;
    $('#total-record-disable').text(formatNumber(res.data[1]));
    let id = $('#table-disable-food-branch-manage'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'white-space-normal', width: '20%'},
            {data: 'unit_type', name: 'unit_type', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'original_percent', name: 'original_percent', className: 'text-center'},
            {data: 'total_temporary_price', name: 'total_temporary_price', className: 'text-center'},
            {data: 'original_revenue', name: 'original_revenue', className: 'text-center'},
            {data: 'material_count', name: 'material_count', className: 'text-center'},
            {data: 'restaurant_kitchen_place_name', name: 'restaurant_kitchen_place_name', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Chuyển bếp',
                'icon': 'fa fa-exchange text-info',
                'class': '',
                'function': 'openModalChangeKitchenFoodManage()',
            }
        ],
        fixed_left = 0,
        fixed_right = 0;
    await DatatableTemplateNew(id, res.data[0], column, vh_of_table, fixed_left, fixed_right, option);
}

async function loadDataPriceByAreaFoodBranchManage() {
    let brand = $('.select-brand').val(),
        branch = $('#change_branch').val(),
        food = $('#select-food-branch').val(),
        url = 'food-branch-manage.data-price-by-area',
        method = 'get',
        params = {brand: brand, branch: branch, food: food},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-price-by-area-branch-manage'),
    ]);
    let id = $('#table-price-by-area-branch-manage'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'area_name', name: 'area_name', className: 'white-space-normal', width: '30%'},
            {data: 'price', name: 'price', className: 'text-center white-space-normal'},
            {data: 'action', name: 'action', className: 'text-center', width: '10%'},
        ],
        fixed_left = 0,
        fixed_right = 0;
    await DatatableTemplateNew(id, res.data[0], column, vh_of_table, fixed_left, fixed_right);
}

function dataTotalFoodBranchManage(data) {
    $('#total-record-food').text(formatNumber(data.total_record_food));
    $('#total-record-drink').text(formatNumber(data.total_record_drink));
    $('#total-record-sea-food').text(formatNumber(data.total_record_seafood));
    $('#total-record-other').text(formatNumber(data.total_record_other));
    $('#total-record-combo').text(formatNumber(data.total_record_combo));
    $('#total-record-gift').text(formatNumber(data.total_record_gift));
    $('#total-record-addition').text(formatNumber(data.total_record_addition));
}

function changeStatusFoodBranchManage(food_id, status, brand_id, branch_id) {
    let title = (status === 1) ? 'Tạm ngưng ' : 'Bật ',
        content = '',
        icon = 'question';

    sweetAlertComponent(title + 'hoạt động món ăn này?', content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'food-branch-manage.change-status',
                params = null,
                data = {
                    food_id: food_id,
                    brand_id: brand_id,
                    branch_id: branch_id,
                };
            let res = await axiosTemplate(method, url, params, data,[
                $('#content-body-techres'),
            ]);
            switch (res.data.status){
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    await loadData();
                    break;
                case 500:
                    (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text())
            }
        }
    })
}

$('#id-table td:eq(1) input:checked').length; // số lượng checked đang có bên trong table
$('#id-table tr').length; // số lượng record bên trong table

function updateCookieFoodBranchManage(){
    saveCookieShared('cookieFoodBranchManage', JSON.stringify({
        'index' : indexDataTabFoodBranchManage,
        'idCategoryFoodBranchManage': categoryFoodBranchManage
    }))
}
