let checkSaveRemovePointData = 0, drawTablePointData;

$(function () {
    rolePointData();
    $(document).on('click', '#table-role-point-data tbody tr', async function () {
        if($(this).hasClass('selected')) return false
        let table = $('#table-role-point-data').DataTable();
        table.$('tr.selected').removeClass('selected');
        await $(this).addClass('selected');
        await dataPointData();
    });
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreatePointData()
    })
    $('.select-role-point-data').on('change', function (){
        loadData();
    })
});

async function loadData() {
    dataPointData();
}

async function dataPointData() {
    let method = 'get',
        url = 'point-data.data',
        params = {
            role : $('.select-role-point-data').val()
        },
        data = null;
    let res = await (axiosTemplate(method, url, params, data, [$('#loading-table-point-data')]));
    tablePointData(res.data[0].original.data)
}

async function rolePointData() {
    let method = 'get',
        url = 'point-data.role',
        params = {},
        data = null;
    let res = await (axiosTemplate(method, url, params, data, [$('#loading-table-point-data')]));
    $('.select-role-point-data').html(res.data[0]);
    dataPointData();
}

async function tableRolePointData(data) {
    let idTableRolePointData = $('#table-role-point-data'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', className: 'text-center py-2'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [],
        fixedLeft = 0,
        fixedRight = 0;
    DatatableTemplateNew(idTableRolePointData, data, column, vh_of_table, fixedLeft, fixedRight,option)
}

async function tablePointData(data) {
    let idTablePointData = $('#table-point-data'),
        fixedLeft = 0,
        fixedRight = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'point', name: 'point', className: 'text-center'},
            {data: 'salary', name: 'salary', className: 'text-right'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'}
        ],
        option = [{
            'title': 'Thêm mới (F2)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePointData',
        }];
    drawTablePointData = await DatatableTemplateNew(idTablePointData, data, columns, vh_of_table, fixedLeft, fixedRight,option);
}

function removePointData(r) {
    if (checkSaveRemovePointData === 1) return false;
    let title = 'Xóa thang điểm thưởng ?',
        content = 'Xóa thang điểm thưởng sẽ không thể lấy lại được !',
        icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            checkSaveRemovePointData = 1;
            let url = 'point-data.remove',
                method = 'post',
                params = null,
                data = {
                    id: r.data('id'),
                };
            let res = await axiosTemplate(method, url, params, data, [$('#table-point-data')]);
            checkSaveRemovePointData = 0;
            let text = '';
            switch (res.data.status ) {
                case 200:
                    text = $('#success-delete-data-to-server').text();
                    SuccessNotify(text);
                    removeRowDatatableTemplate(drawTablePointData, r, true);
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    WarningNotify(text);
            }
        }
    })
}


