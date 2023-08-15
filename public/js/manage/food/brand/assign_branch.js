let id = '1',
    tableFoodDrinkAssignFood = '',
    tableFoodAssignFood = '',
    tableFoodSeaAssignFood = '',
    tableFoodOrtherAssignFood = '',
    loading_tab1 = 0, loading_tab2 = 0,loading_tab3 = 0,
    restaurant_brand_id = '',
    branch_id = '';
    tabCurrent = 1;

$(function () {
    $('#name_branch_food').text($('#change_branch_food').find('option:selected').text());
    restaurant_brand_id = $('.select-brand').val();
    branch_id = $('#change_branch_food').val();

    // Thay đổi chi nhánh
    $('#change_branch_food').unbind('change').on('change', function () {
        $('#name_branch_food').text($(this).find('option:selected').text());
        branch_id = $(this).val();
        dataKitchenFoodManageAsign(branch_id);
        loadDataFood();
    });

    // Thay đổi giá trị khi nhấn tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(){
        tabCurrent = $(this).data('type');
    })
})

// Mở popup gán món ăn xuống chi nhánh
async function openModalChangeFoodManage(){
    $('#modal-change-food-manage').modal('show');
    $('#data-kitchen-food-manage, #change_branch_food').select2({
        dropdownParent: $('#modal-change-food-manage'),
    })
    loadDataFood();
    dataKitchenFoodManageAsign(branch_id)
}

// lẩy danh sách món ăn theo thương hiệu chưa được gán xuống cho chi nhánh
async function loadDataFood(){
    let method = 'get',
        url = 'food-brand-manage.data-food-unexist-category',
        restaurant_brand_id = $('.select-brand').val(),
        branch_id = $('#change_branch_food').val(),
        params = {
            restaurant_brand_id: restaurant_brand_id,
            branch_id:branch_id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableFoodManage(res);
    $('#total-record-assign-food').text(res.data[5].data.total_record_food);
    $('#total-record-assign-drink').text(res.data[5].data.total_record_drink);
    $('#total-record-sea-assign-food').text(res.data[5].data.total_record_seafood);
    $('#total-record-assign-other').text(res.data[5].data.total_record_other);
}

// DataTable danh sách món ăn chưa được gán xuống chi nhánh
async function dataTableFoodManage(data) {
    let id1 = $('#table-kitchen-food-assign-manage'),
        id2 = $('#table-drink-food-assign-data'),
        id3 = $('#table-other-food-assign-data'),
        id4 = $('#table-sea-food-food-assign-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'action', name: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar    ', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
        ],
        fixed_left = 0,
        fixed_right = 0,
        scroll_Y = '30vh';
    tableFoodAssignFood = await DatatableTemplate(id1, data.data[0], column, scroll_Y, fixed_left, fixed_right);
    tableFoodDrinkAssignFood = await  DatatableTemplate(id2, data.data[1], column, scroll_Y, fixed_left, fixed_right);
    tableFoodOrtherAssignFood = await DatatableTemplate(id3, data.data[2], column, scroll_Y, fixed_left, fixed_right);
    tableFoodSeaAssignFood = await DatatableTemplate(id4, data.data[3], column, scroll_Y, fixed_left, fixed_right);
}

// Danh sách bếp
async function dataKitchenFoodManageAsign(id) {
    let method = 'get',
        url = 'food-brand-manage.data-kitchen',
        restaurant_brand_id = $('.select-brand').val(),
        branch_id = id,
        params = {restaurant_brand_id: restaurant_brand_id,branch_id:branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#data-kitchen-food-manage').html(res.data[0]);
}

// Chọn tất cả các món ăn để gán xuống cho chi nhánh
async function checkAllChangeFoodManage(r) {
    let table = '';
    if( tabCurrent === 1){
        table = tableFoodAssignFood;
    }else if(tabCurrent === 2){
        table = tableFoodDrinkAssignFood;
    }else if(tabCurrent === 3){
        table = tableFoodOrtherAssignFood;
    }else{
        table = tableFoodSeaAssignFood;
    }
    let rows = table.rows({ 'search': 'applied' }).nodes();
    if (r.is(':checked') === true) {
        $('input[type="checkbox"]', rows).prop('checked', true);
    } else {
        $('input[type="checkbox"]', rows).prop('checked', false);
    }
}

// sự kiện chọn món ăn để gán
async function checkChangeFoodBrandManage() {
    let table;
    $('#check-all-drink-food-assign-manage').prop('checked', false);
    $('#check-all-kitchen-food-assign-manage').prop('checked', false);
    $('#check-all-other-food-assign-manage').prop('checked', false);
    $('#check-all-sea-food-assign-manage').prop('checked', false);

    if( tabCurrent === 1){
        table = tableFoodAssignFood;
    }else if(tabCurrent === 2){
        table = tableFoodDrinkAssignFood;
    }else if(tabCurrent === 3){
        table = tableFoodOrtherAssignFood;
    }else{
        table = tableFoodSeaAssignFood;
    }

    let i = 0;
    let x = 0;
    await table.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            i++;
        }
        x++;
    });
    if (i === x) {
        $('#check-all-kitchen-food-assign-manage').prop('checked', true);
    } else {
        $('#check-all-kitchen-food-assign-manage').prop('checked', false);
    }
}

// Gán xuống cho chi nhánh và chọn tiếp
async function saveAssignBranchFoodAndSave() {
    let table = '';
    if ($('#change_branch_food').val() === '') {
        ErrorNotify('Vui lòng chọn chi nhánh');
        return false;
    } else if ($('#data-kitchen-food-manage').val() === null) {
        ErrorNotify('Vui lòng chọn bếp');
        return false;
    }

    if (tabCurrent === 1) {
        table = tableFoodAssignFood;
    } else if (tabCurrent === 2) {
        table = tableFoodDrinkAssignFood;
    } else if (tabCurrent === 3) {
        table = tableFoodOrtherAssignFood;
    } else {
        table = tableFoodSeaAssignFood;
    }

    let restaurant_kitchen_place_id = $('#data-kitchen-food-manage').val(),
        food_ids = [];

    await table.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            food_ids.push(row.find('td:eq(1)').find('input').val());
        }
    });

    let method = 'post',
        url = 'food-brand-manage.assign-food',
        data = {
            restaurant_brand_id: restaurant_brand_id,
            branch_id: branch_id,
            foodIds: food_ids,
            restaurant_kitchen_place_id: restaurant_kitchen_place_id
        },
        params = null;
    let res = await axiosTemplate(method, url, params, data);

    if (res.data.status === 200) {
        SuccessNotify($('#success-update-data-to-server').text());
        $('#check-all-kitchen-food-assign-manage').prop('checked', false);
        loadDataFood();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

// Gán xuống cho chi nhánh và đóng popup
async function saveAssignBranchFood(){
    let table;
    if($('#change_branch_food').val() === ''){
        ErrorNotify('Vui lòng chọn chi nhánh');
        return false;
    }

    if($('#data-kitchen-food-manage').val() === null){
        ErrorNotify('Vui lòng chọn bếp');
        return false;
    }

    if( tabCurrent === 1){
        table = tableFoodAssignFood;
    }else if(tabCurrent === 2){
        table = tableFoodDrinkAssignFood;
    }else if(tabCurrent === 3){
        table = tableFoodOrtherAssignFood;
    }else{
        table = tableFoodSeaAssignFood;
    }

    let restaurant_kitchen_place_id = $('#data-kitchen-food-manage').val(),
        food_ids = [];

    await table.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            food_ids.push(row.find('td:eq(1)').find('input').val());
        }
    });

    let method = 'post',
    url = 'food-brand-manage.assign-food',
    data = {
        restaurant_brand_id: restaurant_brand_id,
        branch_id:branch_id,
        foodIds:food_ids,
        restaurant_kitchen_place_id:restaurant_kitchen_place_id
    },
    params = null;
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalChangeFoodManage();
        await loadData();
    } else {
        ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}

// Đóng popup
function closeModalChangeFoodManage(){
    $('#modal-change-food-manage').modal('hide');
    $('#check-all-kitchen-food-assign-manage').prop('checked', false);
}
