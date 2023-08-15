$(function () {
    addLoading('game-marketing.data');
    loadData();
});

async function loadData() {
    let method = 'get',
        url = 'game-marketing.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableGameMarketing(res);
    dataTotalGameMarketing(res.data[2]);
}

function dataTableGameMarketing(data) {
    let scroll_Y = '50vh',
        fixed_left = 0,
        fixed_right = 0,
        id1 = $('#table1-game-marketing'),
        id2 = $('#table2-game-marketing'),
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', className: 'text-center', width: '10%'},
            {data: 'name', className: 'text-center'},
            {data: 'description', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
        ];
    DatatableTemplate(id1, data.data[0].original.data, column, scroll_Y, fixed_left, fixed_right);
    DatatableTemplate(id2, data.data[1].original.data, column, scroll_Y, fixed_left, fixed_right);
}

function dataTotalGameMarketing(data) {
    $('#total-tab1-game-marketing').text(data.total_tab1);
    $('#total-tab2-game-marketing').text(data.total_tab2);
}
