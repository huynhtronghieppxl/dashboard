let tableKitchenFoodBranchManage, previousValFoodBranchManage = '', previousTextFoodBranchManage = '',
    checkSaveFoodKitchenBranchManage = 0, currentOptionKitchenFoodManage;


$(async function () {
    shortcut.add('F4', function () {
        saveModalChangeKitchenFoodManage();
    });

    $('#current-kitchen-food-manage').on('select2:select', function () {
        $('#check-all-kitchen-food-manage').prop('checked', false);
        $('#target-kitchen-food-manage').append('<option value="' + previousValFoodBranchManage + '">' + previousTextFoodBranchManage + '</option>');
        $('#target-kitchen-food-manage').find('option[value=""]').remove();
        dataFoodKitchenFoodManage();
        let current_val = $('#current-kitchen-food-manage option:selected').val();
        previousValFoodBranchManage = $('#current-kitchen-food-manage option:selected').val();
        previousTextFoodBranchManage = $('#current-kitchen-food-manage option:selected').text();
        $('#target-kitchen-food-manage option[value=' + current_val + ']').remove();
        $('#target-kitchen-food-manage').find('option:first').trigger('change.select2');
        if (previousValFoodBranchManage !== '' && previousValFoodBranchManage != '-1') {
            $('#target-kitchen-food-manage').find('option:first').trigger('change');
        } else if ($('#target-kitchen-food-manage').val() === null) {
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
    $('#select-branch-setting select').on('change', function () {
        dataKitchenFoodManage();
    });
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
})

function loadData() {
    dataKitchenFoodManage();
}

async function dataKitchenFoodManage() {
    let method = 'get',
        url = 'food-branch-manage.data-kitchen',
        restaurant_brand_id = $('.select-brand').attr('data-value'),
        branch_id = $('.select-branch').val(),
        params = {restaurant_brand_id: restaurant_brand_id, branch_id: branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#current-kitchen-food-manage'),
        $('#target-kitchen-food-manage')
    ]);
    $('#current-kitchen-food-manage').html(res.data[0]);
    res.data[2].data.length == 0 ? $('#target-kitchen-food-manage').html('<option>Dữ liệu rỗng</option>') : $('#target-kitchen-food-manage').html(res.data[1]);
    dataFoodKitchenFoodManage();

}

async function dataFoodKitchenFoodManage() {
    let method = 'get',
        url = 'food-branch-manage.data-food-kitchen',
        restaurant_brand_id = $('.select-brand').val(),
        branch = $('.select-branch').val(),
        kitchen = $('#current-kitchen-food-manage').val(),
        type_kitchen = $('#target-kitchen-food-manage').find('option:selected').data('type'), // lấy type lọc bếp đến
        params = {
            restaurant_brand_id: restaurant_brand_id,
            branch: branch,
            kitchen: kitchen,
            type_kitchen: type_kitchen
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-kitchen-food-manage')
    ]);
    dataTableKitchenData(res.data[0].original.data);
}

async function checkChangeKitchenFoodManage() {
    let i = 0;
    let x = 0;
    await tableKitchenFoodBranchManage.rows().every(function (index, element) {
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
            {data: 'name', name: 'name', className: 'white-space-normal', className: 'text-left', width: '15%'},
            {data: 'category_name', name: 'category_name', className: 'text-left'},
            {data: 'category_type', name: 'category_type', className: 'text-center d-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveModalChangeKitchenFoodManage',
            }
        ],
        scroll_Y = "45vh",
        fixed_left = 0,
        fixed_right = 0;
    tableKitchenFoodBranchManage = await DatatableTemplateNew(tableDataKitchenFoodBranchManage, data, column, scroll_Y, fixed_left, fixed_right, option);
}

async function saveModalChangeKitchenFoodManage() {
    if ($('#current-kitchen-food-manage').val() === null) {
        WarningNotify('Vui lòng chọn bếp');
        return false;
    }
    if ($('#target-kitchen-food-manage').val() === null) {
        WarningNotify('Vui lòng chọn bếp');
        return false;
    }
    if ($('#table-kitchen-food-manage').find('tbody tr').find('td:eq(1)').find('input').is(':checked') === false) {
        WarningNotify('Vui lòng chọn món ăn');
        return false;
    }
    if (checkSaveFoodKitchenBranchManage !== 0) return false;
    let branch = $('.select-branch').val(),
        restaurant_brand_id = $('.select-brand').val(),
        is_move_urgently = $('#type-kitchen-food-manage').find('input[type="radio"]:checked').val(),
        kitchen_place_id = $('#target-kitchen-food-manage').val(),
        food_ids = [];
    $('#table-kitchen-food-manage').find('tbody tr').each(function (index, element) {
        if ($(this).find('td:eq(1)').find('input').is(':checked')) {
            food_ids.push($(this).find('td:eq(1)').find('input').val());
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

    let res = await axiosTemplate(method, url, params, data, [
        $('#table-kitchen-food-manage')
    ]);
    checkSaveFoodKitchenBranchManage = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            $('#check-all-kitchen-food-manage').prop('checked', false);
           await tableKitchenFoodBranchManage.rows().every(function () {
                let row = $(this.node());
                if (row.find('td:eq(1)').find('input').is(':checked')) {
                    row.remove()
                }
            })
            break;
        case 205:
            openModalNotifyAssignKitchenData()
            $('#message-change-status-assign-kitchen-data').text(res.data.message)
            dataTableAssignKitchen(res);
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text());
    }
}


async function dataTableAssignKitchen(data) {
    let table_un_assign = $('#table-cannot-assign-kitchen'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'category_name', name: 'category_name', className: 'text-left', width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    await DatatableTemplateNew(table_un_assign, data.data.data.original.data, column, scroll_Y, fixed_left, fixed_right, []);
}
