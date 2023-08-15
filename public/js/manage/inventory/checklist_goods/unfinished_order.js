
async function openModalListUnfinishedOrder(data){
    $('#modal-list-unfinished_order').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', closeModalListUnfinishedOrder);
    await drawTableListUnfinishedOrder(data);
}

async function drawTableListUnfinishedOrder(data) {
    let tableOrder = $('#table-list-unfinished_order'),
        scroll_Y = '300px',
        fixed_left = 1,
        fixed_right = 1,
        columnTable = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    await DatatableTemplateNew(tableOrder, data, columnTable, scroll_Y, fixed_left, fixed_right, []);
}

function closeModalListUnfinishedOrder(){
    $('#modal-list-unfinished_order').modal('hide')
    shortcut.remove('ESC');
}
