let listFood = null;
async function openModalImportExcelFoodManage() {
    $('#import-food-data-modal').modal('show');
}

$(document).on('click', '#check_file', async function (e) {
    if ($('#files-upload-food-data').val() == '') {
        ErrorNotify('Vui chọn file Excel !');
        return false;
    }
    let restaurant_brand_id = $('.select-brand').val();
    let form_data = new FormData();
    let file = $('#files-upload-food-data')[0].files[0];
    if ($('#edit-review-food-import tbody tr').length != 0) {
        $('#edit-review-food-import').DataTable().draw();
    }
    form_data.append('file', file);
    let method = 'post',
        url = 'food-manage.check-import-excel',
        params = {
            restaurant_brand_id : restaurant_brand_id
        },
        data = form_data;
    let res = await axiosTemplate(method, url, params, data);
    listFood = res.data[2];
    if (res.data[0].status == 200) {
        $('#tab1').addClass('d-none');
        $('#tab2').removeClass('d-none');
        $('.next-tab').removeClass('d-none');
        $('.previous-tab').removeClass('d-none');
        dataTableFoodManageExcel(res);
    } else {
        $('#tab1').addClass('d-none');
        $('#tab2').removeClass('d-none');
        $('.previous-tab').removeClass('d-none');
        dataTableFoodManageExcelErorr(res);
    }
});

$(document).on('click', '.previous-tab', function () {
    $('#tab1').removeClass('d-none');
    $('#tab2').addClass('d-none');
    $('.previous-tab').addClass('d-none');
    $('#files-upload-quantitative-data').val('');
});

async function savefood() {
    let method = 'post',
    url = 'food-manage.import-excel',
    params = null,
    data = {
        food: listFood
    };
    let res = await axiosTemplate(method, url, params, data);
    if (res.status == 200) {
        let success = $('#success-create-data-to-server').text();
        SuccessNotify(success);
        closeModalImportFoodManage();
        loadData();
    } else {
        ErrorNotify(res.data.message)
    }
}

async function downloadTemplate(){
    let restaurant_brand_id = $('.select-brand').val(),
    method = 'get',
    url = 'food-manage.template',
    params = null,
    data = {
        restaurant_brand_id :restaurant_brand_id
    };
    return false;
    let res = await axiosTemplate(method, url, params, data);
}

function dataTableFoodManageExcel(data) {
    let id =  $('#edit-review-food-import'),
    scroll_Y = '60vh',
    fixed_left = 0,
    fixed_right = 0,
    column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-center'},
        {data: 'price', name: 'name', className: 'text-center'},
        {data: 'unit', name: 'unit', className: 'text-center'},
        {data: 'point_to_purchase', name: 'point_to_purchase', className: 'text-center'},
        {data: 'error' , name: 'error' , className: 'text-center'},
    ];
    DatatableTemplate(id, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
}

function dataTableFoodManageExcelErorr(data) {
    let id =  $('#edit-review-food-import'),
    scroll_Y = '60vh',
    fixed_left = 0,
    fixed_right = 0,
    column = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
        {data: 'name', name: 'name', className: 'text-center'},
        {data: 'price', name: 'name', className: 'text-center'},
        {data: 'unit', name: 'unit', className: 'text-center'},
        {data: 'point_to_purchase', name: 'point_to_purchase', className: 'text-center'},
        {data: 'error' , name: 'error' , className: 'text-center text-danger'},
    ];
    DatatableTemplate(id, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
}

function closeModalImportFoodManage() {
    $('#import-food-data-modal').modal('hide');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateFoodManage();
    });
    shortcut.add('F3', function () {
        openModalUploadImgFoodManage();
    });
}
