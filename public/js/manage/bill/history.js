function openModalHistory() {
    $('#modal-history-bill').modal('show');
    loadDataHistory();
    shortcut.remove('ESC');
    shortcut.add('ESC', function (e) {
        closeModalHistory();
    })
}

async function loadDataHistory() {
    let method = 'get',
        params = {id: idBillDetailBillManage},
        data = null,
        url1 = 'bill-manage.history';
    let res = await axiosTemplate(method, url1, params, data, [
        $('#table-history-bill-manage')
    ]);
    let id = $('#table-history-bill-manage'),
        fixedLeft = 0,
        fixedRight = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'employee', name: 'employee', className: 'text-left'},
            {data: 'content', name: 'content', className: 'text-left white-space-normal'},
            {data: 'keysearch', className: 'd-none'},
        ], option = [];
    await DatatableTemplateNew(id, res.data[0].original.data, column, '40vh', fixedLeft, fixedRight, option);
}


function closeModalHistory() {
    $('#modal-history-bill').modal('hide');
}
