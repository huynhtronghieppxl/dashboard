let loading_tab1 = 0, loading_tab2 = 0, tab_current = 1, table_detail_cashbook1, table_detail_cashbook2;
let limit, branch_id, type_tab1, type_tab2, page_tab1, page_tab2, from, to;

function openModalDetailCashBookManage(r) {
    $('#modal-detail-cash-book-manage').modal('show');
    addLoading('cash-book-manage.detail', '#loading-modal-detail-cash-book-manage');
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalDetailCashBookManage();
    });
    $('#name-detail-cash-book-manage').text(r.data('name'));
    $('#from-detail-cash-book-manage').text(r.data('from'));
    $('#to-detail-cash-book-manage').text(r.data('to'));
    $('#employee-detail-cash-book-manage').text(r.data('employee'));
    $('#employee-complete-detail-cash-book-manage').text(r.data('employee-complete'));
    $('#open-detail-cash-book-manage').text(r.data('openning'));
    $('#in-detail-cash-book-manage').text(r.data('in'));
    $('#out-detail-cash-book-manage').text(r.data('out'));
    $('#order-detail-cash-book-manage').text(r.data('order'));
    $('#closing-detail-cash-book-manage').text(r.data('closing'));
    $('#changing-detail-cash-book-manage').text(r.data('changing'));
    $('#note-detail-cash-book-manage').val(r.data('note'));
    switch (r.data('status')) {
        case 0:
            $('#status-detail-cash-book-manage').html('<label class="label label-lg label-warning">' + r.data('status-name') + '</label>');
            break;
        case 1:
            $('#status-detail-cash-book-manage').html('<label class="label label-lg label-warning">' + r.data('status-name') + '</label>');
            break;
        case 2:
            $('#status-detail-cash-book-manage').html('<label class="label label-lg label-success">' + r.data('status-name') + '</label>');
            break;
        case 3:
            $('#status-detail-cash-book-manage').html('<label class="label label-lg label-danger">' + r.data('status-name') + '</label>');
            break;
    }
    table_detail_cashbook1 = '';
    table_detail_cashbook2 = '';
    limit = $('#data-table-length').val();
    branch_id = r.data('branch');
    type_tab1 = 1;
    type_tab2 = 0;
    page_tab1 = 1;
    page_tab2 = 1;
    from = r.data('from');
    to = r.data('to');
    loadData1();
}

async function changeTabDetailCashBook(tab) {
    tab_current = tab;
    if (tab === 1) {
        if (table_detail_cashbook1 === '') {
            loadData1();
            loading_tab1 = 1;
        } else if (loading_tab1 === 0) {
            table_detail_cashbook1.ajax.url("cash-book-manage.detail?from=" + from + "&to=" + to + "&branch_id=" + branch_id + "&type=" + type_tab1 + "&page=" + page_tab1 + "&limit=" + limit).load();
        }
    } else if (tab === 0) {
        if (table_detail_cashbook2 === '') {
            loadData2();
            loading_tab2 = 1;
        } else if (loading_tab2 === 0) {
            table_detail_cashbook2.ajax.url("cash-book-manage.detail?from=" + from + "&to=" + to + "&branch_id=" + branch_id + "&type=" + type_tab2 + "&page=" + page_tab2 + "&limit=" + limit).load();
        }
    }
}

function loadData1() {
    table_detail_cashbook1 = $('#table-payment-detail-cash-book-manage').DataTable({
        responsive: false,
        processing: true,
        serverSide: true,
        ordering: false,
        scrollCollapse: true,
        lengthMenu: [[100], [100]],
        pageLength: 100,
        scrollY: vh_of_table,
        scrollX: true,
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            processing: 'Đang tải ....'
        },
        ajax: {
            url: "cash-book-manage.detail?from=" + from + "&to=" + to + "&branch_id=" + branch_id + "&type=" + type_tab1 + "&page=" + page_tab1 + "&limit=" + limit,
        },
        columns: [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee.name', className: 'text-center'},
            {data: 'object_name', className: 'text-center'},
            {data: 'reason_name', className: 'text-center'},
            {data: 'date', className: 'text-center'},
            {data: 'amount', className: 'text-center'},
            {data: 'status_text', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '10%'},
        ],
        "drawCallback": function (settings) {
            let response = settings.json;
            $('#total-record-tab1-detail').text(response.out_count);
            $('#total-record-tab2-detail').text(response.in_count);
            $('#total-payment-detail-cash-book-manage').text(response.total_out_amount);
        },
    });
}

function loadData2() {
    table_detail_cashbook2 = $('#table-receipt-detail-cash-book-manage').DataTable({
        responsive: false,
        processing: true,
        serverSide: true,
        ordering: false,
        scrollCollapse: true,
        lengthMenu: [[100], [100]],
        pageLength: 100,
        scrollY: vh_of_table,
        scrollX: true,
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            processing: 'Đang tải ....'
        },
        ajax: {
            url: "cash-book-manage.detail?from=" + from + "&to=" + to + "&branch_id=" + branch_id + "&type=" + type_tab2 + "&page=" + page_tab2 + "&limit=" + limit,
        },
        columns: [
            {data: 'index', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'employee.name', className: 'text-center'},
            {data: 'object_name', className: 'text-center'},
            {data: 'reason_name', className: 'text-center'},
            {data: 'date', className: 'text-center'},
            {data: 'amount', className: 'text-center'},
            {data: 'status_text', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '10%'},
        ],
        "drawCallback": function (settings) {
            let response = settings.json;
            $('#total-record-tab1-detail').text(response.out_count);
            $('#total-record-tab2-detail').text(response.in_count);
            $('#total-receipt-detail-cash-book-manage').text(response.total_in_amount);
        },
    });
}

// async function dataDetailCashBookManage(from, to, branch) {
//     let method = 'get',
//         url = 'cash-book-manage.detail',
//         params = {from: from, to: to, branch: branch},
//         data = null;
//     let res = await axiosTemplate(method, url, params, data);
//     dataTableDetailCashBookManage(res);
//     dataTotalDetailCashBookManage(res.data[2]);
// }

// function dataTableDetailCashBookManage(data) {
//     let id1 = $('#table-payment-detail-cash-book-manage'),
//         id2 = $('#table-receipt-detail-cash-book-manage'),
//         columns = [
//             {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
//             {data: 'code', name: 'code', className: 'text-center'},
//             {data: 'employee.name', className: 'text-center'},
//             {data: 'object_name', className: 'text-center'},
//             {data: 'reason_name', className: 'text-center'},
//             {data: 'date', className: 'text-center'},
//             {data: 'amount', className: 'text-center'},
//             {data: 'status_text', className: 'text-center'},
//             {data: 'action', className: 'text-center', width: '10%'},
//         ],
//         scroll_Y = '40vh',
//         fixed_left = 2,
//         fixed_right = 1;
//     DatatableTemplate(id1, data.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right);
//     DatatableTemplate(id2, data.data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);
// }
//
// function dataTotalDetailCashBookManage(data) {
//     $('#total-record-tab1-detail').text(data.total_record_payment);
//     $('#total-record-tab2-detail').text(data.total_record_receipt);
//     $('#total-payment-detail-cash-book-manage').text(data.total_payment);
//     $('#total-receipt-detail-cash-book-manage').text(data.total_receipt);
// }

function closeModalDetailCashBookManage() {
    shortcut.remove("ESC");
    $('#modal-detail-cash-book-manage').modal('hide');

}
