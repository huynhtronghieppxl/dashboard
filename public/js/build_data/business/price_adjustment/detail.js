let tableDetailPriceAdjustment,
    idDetailPriceAdjustment, idEmployeeDetailPriceAdjustment;

async function openModalDetailPriceAdjustment(r) {
    idDetailPriceAdjustment = r.data('id');
    $('#modal-detail-price-adjustment').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalDetailPriceAdjustment();
    });
    $('#modal-detail-food-brand-manage').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailPriceAdjustment();
        });
    });
    $('#employee-detail-price-adjustment').on('click', function (){
        openModalInfoEmployeeManage(idEmployeeDetailPriceAdjustment);
    })
    dataDetailPriceAdjustment();
}

async function dataDetailPriceAdjustment() {
    let method = 'get',
        url = 'price-adjustment-data.detail',
        params = {id: idDetailPriceAdjustment},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-detail-price-adjustment'), $('#info-detail-price-adjustment')]);
    idEmployeeDetailPriceAdjustment = res.data[0].employee_create.id;
    (res.data[0].status === 2) ? $('#confirmed-detail-price-adjustment-div').removeClass('d-none') : $('#confirmed-detail-price-adjustment-div').addClass('d-none');
    if (res.data[0].status === 3) {
        $('#cancel-detail-price-adjustment-div').removeClass('d-none')
    } else {
        $('#cancel-detail-price-adjustment-div').addClass('d-none');
    }
    $('#total-detail-price-adjustment').text(res.data[0].number_food);
    $('#branch-detail-price-adjustment').text(res.data[0].restaurant_brand.name);
    $('#code-detail-price-adjustment').text(res.data[0].code);
    $('#employee-detail-price-adjustment').text(res.data[0].employee_create.name);
    $('#created-detail-price-adjustment').text(res.data[0].created_at);
    $('#updated-detail-price-adjustment').text(res.data[0].updated_at);
    $('#employee-apply-detail-price-adjustment').text(res.data[0].employee_confirm.name);
    $('#apply-detail-price-adjustment').text(res.data[0].apply_time);
    $('#employee-cancel-detail-price-adjustment').text(res.data[0].employee_confirm.name);
    $('#cancel-detail-price-adjustment').text(res.data[0].cancel_reason);
    $('#note-detail-price-adjustment').text(res.data[0].note === '' ? '---' : res.data[0].note);
    dataTableDetailPriceAdjustment(res.data[1].original.data);
}

async function dataTableDetailPriceAdjustment(data) {
    let id = $('#table-detail-price-adjustment'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'food.name', name: 'name', className: 'text-left'},
            {data: 'old_price', name: 'old_price', className: 'text-right'},
            {data: 'price_difference', name: 'price_difference', className: 'text-right'},
            {data: 'new_price', name: 'new_price', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data:'keysearch', name:'keysearch', className:'d-none'}
        ],
        scroll_Y = "65vh",
        fixedLeft = 2,
        fixedRight = 1;
    tableDetailPriceAdjustment = await DatatableTemplateNew(id, data, column, scroll_Y, fixedLeft, fixedRight)

    $(document).on('input paste keyup','input[type="search"]', async function (){
        let index = 1;
        tableDetailPriceAdjustment.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(index)
            index++;
        })
    })
}

function closeModalDetailPriceAdjustment() {
    $('#modal-detail-price-adjustment').modal('hide');
    resetModalDetailPriceAdjustment();
}

function resetModalDetailPriceAdjustment(){
    tableDetailPriceAdjustment.clear().draw(false);
    $('#label-status-price-adjustment-detail').html('');
    $('#total-detail-price-adjustment').text('0');
    $('#branch-detail-price-adjustment').text('---');
    $('#code-detail-price-adjustment').text('---');
    $('#employee-detail-price-adjustment').text('---');
    $('#created-detail-price-adjustment').val(moment().format('DD/MM/YYYY'));
    $('#updated-detail-price-adjustment').val(moment().format('DD/MM/YYYY'));
    $('#employee-apply-detail-price-adjustment').text('---');
    $('#apply-detail-price-adjustment').text('---');
    $('#note-detail-price-adjustment').text('---');
    $('#button-item-detail-price-adjustment-data button:eq(0)').click();
}
