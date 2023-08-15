let tableKitchenFoodBranchManage, previousValFoodBranchManage = '', previousTextFoodBranchManage = '',
    checkSaveFoodKitchenBranchManage = 0;

async function openModalChangeKitchenFoodManage() {
    $('#modal-change-kitchen-food-manage').modal('show');
    addLoading('food-manage.data-food-kitchen', '#loading-modal-change-kitchen-food-manage');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.add('F4', function () {
        saveModalChangeKitchenFoodManage();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalChangeKitchenFoodManage();
    });
    $('#modal-change-kitchen-food-manage .js-example-basic-single').select2({
        dropdownParent: $('#modal-change-kitchen-food-manage')
    });

    $('#current-kitchen-food-manage').unbind('select2:selecting').on('select2:selecting', function (evt) {
        previousValFoodBranchManage = $('#current-kitchen-food-manage option:selected').val();
        previousTextFoodBranchManage = $('#current-kitchen-food-manage option:selected').text();
    });

    $('#current-kitchen-food-manage').unbind('select2:select').on('select2:select', function () {
        $('#check-all-kitchen-food-manage').prop('checked', false);
        dataFoodKitchenFoodManage();
        let current_val = $('#current-kitchen-food-manage option:selected').val();
        $('#target-kitchen-food-manage option[value=' + current_val + ']').remove();
        $('#target-kitchen-food-manage').find('option:first').trigger('change.select2');
        if(previousValFoodBranchManage !== '' &&  previousValFoodBranchManage != '-1'){
            $('#target-kitchen-food-manage').find('option').val(null).remove();
            $('#target-kitchen-food-manage').append('<option value="' + previousValFoodBranchManage + '">' + previousTextFoodBranchManage + '</option>');
            $('#target-kitchen-food-manage').find('option:first').trigger('change');
        }else if ($('#target-kitchen-food-manage').val() === null){
            $('#target-kitchen-food-manage').html('<option disabled selected>Dữ liệu rỗng</option>')
        }

    });
    $('#type-kitchen-food-manage').on('change', function () {
        if ($(this).find('input[type=radio]:checked').val() === '0') {
            $('#type-true-kitchen-employee-manage').addClass('d-none');
            $('#type-false-kitchen-employee-manage').removeClass('d-none');
        } else {
            $('#type-false-kitchen-employee-manage').addClass('d-none');
            $('#type-true-kitchen-employee-manage').removeClass('d-none');
        }
    });


    $('#data-kitchen-food-manage').append('')
    await dataKitchenFoodManage();
}

async function dataKitchenFoodManage() {
    let method = 'get',
        url = 'food-branch-manage.data-kitchen',
        restaurant_brand_id = $('.select-brand').val(),
        branch_id = $('.select-branch').val(),
        params = {restaurant_brand_id: restaurant_brand_id,branch_id:branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#current-kitchen-food-manage'),
        $('#target-kitchen-food-manage')
    ]);
    $('#current-kitchen-food-manage').html(res.data[0]);
    $('#target-kitchen-food-manage').html(res.data[1]);
    dataFoodKitchenFoodManage();
}

async function dataFoodKitchenFoodManage() {
    let method = 'get',
        url = 'food-branch-manage.data-food-kitchen',
         restaurant_brand_id = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        kitchen = $('#current-kitchen-food-manage').val(),
        params = {restaurant_brand_id: restaurant_brand_id,branch: branch, kitchen: kitchen},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-kitchen-food-manage')
    ]);
    dataTableKitchenData(res.data[0].original.data);
}

async function checkChangeKitchenFoodManage() {
    let i = 0;
    let x = 0;
    await tableKitchenFoodBranchManage .rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            i++;
        }
        x++;
    });
    if (i === x) {
        $('#check-all-kitchen-food-manage').prop('checked', true);
    } else {
        $('#check-all-kitchen-food-manage').prop('checked', false);
    }
}

async function checkAllChangeKitchenFoodManage(r) {
    if (r.is(':checked') === true) {
        await tableKitchenFoodBranchManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(1)').find('input').prop('checked', true);
        });
    } else {
        await tableKitchenFoodBranchManage.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(1)').find('input').prop('checked', false);
        });
    }
}

async function dataTableKitchenData(data) {
    let tableDataKitchenFoodBranchManage = $('#table-kitchen-food-manage'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'checkbox', name: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'white-space-normal'},
            {data: 'category_name', name: 'category_name', className: 'text-center'},
        ],
        scroll_Y = "45vh",
        fixed_left = 0,
        fixed_right = 0;
    tableKitchenFoodBranchManage = await DatatableTemplateNew(tableDataKitchenFoodBranchManage, data, column, scroll_Y, fixed_left, fixed_right);

}

async function saveModalChangeKitchenFoodManage() {
    if($('#current-kitchen-food-manage').val() === null){
        ErrorNotify('Vui lòng chọn bếp');
        return false;
    }
    if($('#target-kitchen-food-manage').val() === null){
        ErrorNotify('Vui lòng chọn bếp');
        return false;
    }
    if(checkSaveFoodKitchenBranchManage !== 0) return false;
    addLoading('food-manage.change-kitchen', '#loading-modal-change-kitchen-food-manage');
    let branch = $('.select-branch').val(),
         restaurant_brand_id = $('.select-brand').val(),
        is_move_urgently = $('#type-kitchen-food-manage').find('input[type="radio"]:checked').val(),
        kitchen_place_id = $('#target-kitchen-food-manage').val(),
        food_ids = [];
    await tableKitchenFoodBranchManage.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            food_ids.push(row.find('td:eq(1)').find('input').val());
        }
    });
    let method = 'post',
        url = 'food-branch-manage.change-kitchen',
        params = null,
        data = {
            branch: branch,
            restaurant_brand_id: restaurant_brand_id,
            is_move_urgently: is_move_urgently,
            kitchen_place_id: kitchen_place_id,
            food_ids: food_ids,
        };
    checkSaveFoodKitchenBranchManage = 1;
    let res = await axiosTemplate(method, url, params, data,[
        $('#loading-modal-change-kitchen-food-manage')
    ]);
    checkSaveFoodKitchenBranchManage = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalChangeKitchenFoodManage();
            // loadData();
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}

function closeModalChangeKitchenFoodManage() {
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateFoodManage();
    });
    $('#modal-change-kitchen-food-manage').modal('hide');
    $('#check-all-kitchen-food-manage').prop('checked', false);
    $('#type-kitchen-food-manage input[type="radio"][value="0"]').click();
    $('#current-kitchen-food-manage').val('-1').trigger('change');
    previousValFoodBranchManage = '';
    previousTextFoodBranchManage = '';
}
