let dataAllTakeAway = [],
    dataSelectedTakeAway = [],
    drawAllTakeAway,
    drawSelectedTakeAway,
    saveTakeAway = 0;

async function openModalUpdateTakeAway() {
    $('#modal-update-take-away').modal('show');
    addLoading('take-away.data-update', '#loading-modal-update-take-away');
    addLoading('take-away.update', '#loading-modal-update-take-away');
    shortcut.add('F4', function () {
        saveModalUpdateTakeAway();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateTakeAway();
    });
    dataUpdateTakeAway();
}

async function dataUpdateTakeAway() {
    let method = 'get',
        url = 'take-away.data-update',
        params = {branch: branch_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataAllTakeAway = res.data[0].original.data;
    dataSelectedTakeAway = res.data[1].original.data;
    dataTableAllTakeAway(res);
}

async function dataTableAllTakeAway(data) {
    let table_all = $('#table-all-take-away'),
        table_selected = $('#table-selected-take-away'),
        scroll_Y = '45vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        columns1 = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'amount', name: 'amount', className: 'text-center'},
        ];
    drawAllTakeAway = await DatatableTemplate(table_all, data.data[0].original.data , columns, scroll_Y, fixed_left, fixed_right);
    drawSelectedTakeAway = await DatatableTemplate(table_selected, data.data[1].original.data , columns1, scroll_Y, fixed_left, fixed_right);

}

async function checkTakeAway() {
    dataSelectedTakeAway = [];
    await drawAllTakeAway.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(1)').find('input').is(':checked') === true) {
            let item = {
                'id': row.find('td:eq(1)').find('input').val(),
                'name': row.find('td:eq(1)').find('input').data('name'),
                'avatar': '<label><img src="' + row.find('td:eq(1)').find('input').data('avatar') + '" class="img-data-table" onclick="modalImageComponent(' + "'" + row.find('td:eq(1)').find('input').data('avatar') + "'" + ')"/></label><input value="' + row.find('td:eq(1)').find('input').val() + '" class="d-none"/>',
                'amount': row.find('td:eq(1)').find('input').data('amount'),
                'DT_RowIndex': dataSelectedTakeAway.length + 1,
            };
            dataSelectedTakeAway.push(item);
        }
    });
    dataTableSelectedTakeAway(dataSelectedTakeAway);
}

async function saveModalUpdateTakeAway() {
    if (saveTakeAway !== 0) {
        return false;
    }
    saveTakeAway = 1;
    let branch = $('#change_branch').val(),
        foods = [];
    await drawSelectedTakeAway.rows().every(function (index, element) {
        let row = $(this.node());
        foods.push(row.find('td:eq(1)').find('input').val());
    });
    let method = 'post',
        url = 'take-away.update',
        params = null,
        data = {branch: branch, foods: foods};
    let res = await axiosTemplate(method, url, params, data);
    saveTakeAway = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateTakeAway();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
    }
}

async function checkFoodTakeAway(r){
    let name = r.parents('tr').find('td:eq(2)').text(),
        id = r.data('id'),
        avatar = r.parents('tr').find('td:eq(1)').find('img').attr('src'),
        amount = removeformatNumber(r.parents('tr').find('td:eq(3)').text());

    let item = {
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-id="' + id +'" data-name="'+ name +'" data-avatar="'+ avatar +'" data-amount="' + amount + '" onclick="unCheckFoodTakeAway($(this))"></i>',
        'avatar': avatar,
        'name': name,
        'amount': amount,
    };
    addRowDatatableTemplate(drawSelectedTakeAway, item);
    drawAllTakeAway.row(r.parents('tr')).remove().draw(false);
}

async function unCheckFoodTakeAway(){
    let item = {
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-action="' + r.parents('tr').find('td:eq(2)').find('i').data('action') + '" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('i').data('id') + '" data-supplier="' + r.parents('tr').find('td:eq(1)').text() + '"></i>',
        'avatar': r.parents('tr').find('td:eq(2)').find('i').data('category'),
        'name': r.parents('tr').find('td:eq(2)').find('i').data('unit'),
        'amount': r.parents('tr').find('td:eq(0)').text(),
    };

    addRowDatatableTemplate(drawAllTakeAway, item);
    drawSelectedTakeAway.row(r.parents('tr')).remove().draw(false);
}

function closeModalUpdateTakeAway() {
    shortcut.remove('F4');
    shortcut.remove('ESC');
    $('#modal-update-take-away').modal('hide');
}


