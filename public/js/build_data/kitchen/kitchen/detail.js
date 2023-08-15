let dataTableFoodKitchenDataDetail;
let checkdataDetailKitchenData =0;
function openModalDetailKitchenData(r){
    $('#modal-detail-kitchen-data').modal('show');
    shortcut.remove('F2');
    shortcut.remove('F4');
    dataDetailKitchenData(r);
    shortcut.add('ESC', function () {
        closeModalDetailKitchenData();
    });
}

async function dataDetailKitchenData(r){
    let branch_id = $('.select-branch').val();
    let restaurant_brand_id = $('.select-brand').val();
    if(checkdataDetailKitchenData ===1) return false;

    let method = 'get',
        url = 'kitchen-data.detail',
        data = null,
        params = {
            id: r.data('id'),
            restaurant_brand_id: restaurant_brand_id,
            branch_id: branch_id,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-detail-kitchen-data')]);
    console.log('alo',res.data)

    $('#name-detail-kitchen-data').html(res.data[0].name);
    $('#type-detail-kitchen-data').text(res.data[0].type);
    $('#description-detail-kitchen-data').text(res.data[0].description);

    dataTableFoodKitchenData(res);
    $('#total-record-food-kitchen-data').text(formatNumber(res.data[2]))
    $('#create-at-detail-kitchen-data').text(res.data[0].created_at.slice(0, 10))
    $('#update-at-detail-kitchen-data').text(res.data[0].updated_at.slice(0, 10))
    $('#printer-paper-size-detail-kitchen-data').text(res.data[0].printer_paper_size)
    if(res.data[0].printer_type !== 0 || res.data[0].printer_name === ''){
        $('#printer-name-detail-kitchen-data').text('---')
        $('#printer-IP-detail-kitchen-data').text('---')
        $('#printer-port-detail-kitchen-data').text('---')
    }else{
        $('#printer-name-detail-kitchen-data').text(res.data[0].printer_name)
        $('#printer-IP-detail-kitchen-data').text(res.data[0].printer_ip_address)
        $('#printer-port-detail-kitchen-data').text(res.data[0].printer_port)
    }
}

async function dataTableFoodKitchenData(data) {
    let idTableFoodKitchen = $('#table-food-kitchen-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'type_text', className: 'text-left'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [],
        fixedLeft = null,
        fixedRight = null;
    dataTableFoodKitchenDataDetail= await DatatableTemplateNew(idTableFoodKitchen, data.data[1].original.data, column, vh_of_table, fixedLeft, fixedRight,option);
    $(document).on('input paste', '#table-food-kitchen-data_filter input', async function () {
        $('#total-record-food-kitchen-data').text(dataTableFoodKitchenDataDetail.rows({'search': 'applied'}).count())
    })
}


function closeModalDetailKitchenData() {
    $('#modal-detail-kitchen-data').modal('hide');
    shortcut.add('F2', function (){
        openModalCreateKitchenData()
    })
    resetModalDetailKitchenData()
}

function resetModalDetailKitchenData() {
    $('#modal-detail-kitchen-data h6').text('---');
}
