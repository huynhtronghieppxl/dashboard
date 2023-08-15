// let tableDetailSellingUnit;
async function openModalDetailMaterialData(id) {
     $('.swal2-container').addClass('d-none');
    $('#modal-detail-material-data').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function() {
        closeModalDetailMaterialData();
    });
    addLoading('material-data.detail', '#loading-modal-detail-material');
    let method = 'get',
        url = 'material-data.detail',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-material')]);
    drawTableDetailSellingUnit(res.data[1])
    $('#category-detail-material-data').text(res.data[0].category_name);
    $('#unit-detail-material-data').text(res.data[0].unit);
    $('#name-detail-material-data').text(res.data[0].name);
    $('#code-detail-material-data').text(res.data[0].code);
    $('#specifications-detail-material-data').text(res.data[0].specifications);
    $('#price-detail-material-data').text(res.data[0].price);
    $('#min-detail-material-data').text(res.data[0].out_stock);
    $('#loss-detail-material-data').text(res.data[0].wastage_rate);
    $('#type-detail-material-data').text(res.data[0].category_type_name);
    if(res.data[0].description === '') {
        $('#des-detail-material-data').text('---');
    } else {
        $('#des-detail-material-data').text(res.data[0].description);
    }
    $('#status-detail-material-data').html(res.data[0].status_text);
    $('#status-id-detail-material-data').text(res.data[0].status);
}
async function drawTableDetailSellingUnit(data) {
    let table = $('#table-selling-unit-detail'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'name', name: 'unit_name', className: 'text-center'},
            {data: 'exchange_value', name: 'exchange_value', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'rate', name: 'rate', className: 'text-center'},
        ],
    tableDetailSellingUnit = await DatatableTemplateNew(table, data.original.data, column, scroll_Y, fixed_left, fixed_right);
}

async function closeModalDetailMaterialData() {
    shortcut.remove('ESC');
    $('#modal-detail-material-data').modal('hide')
    shortcut.remove('F4');
    reloadModalDetailMaterialData();
}

function reloadModalDetailMaterialData(){
    $('.swal2-container').removeClass('d-none');
    $('#min-detail-material-data').text(0);
    $('#price-detail-material-data').text(0);
    $('#loss-detail-material-data').text(0);
    $('#name-detail-material-data').text('---');
    $('#unit-detail-material-data').text('---');
    $('#specifications-detail-material-data').text('---');
    $('#code-detail-material-data').text('---');
    $('#category-detail-material-data').text('---');
    $('#des-detail-material-data').text('---');
}
