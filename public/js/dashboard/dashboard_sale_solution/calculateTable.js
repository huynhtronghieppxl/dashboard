function sumCard11(data) {
    $('#before-amount').html(data.total_before_amount);
    $('#in-amount').html(data.total_in_amount);
    $('#out-amount').html(data.total_out_amount);
    $('#after-amount').html(data.total_after_amount);
    $('#wastage-rate').html(data.total_deficiency_amount);
}

function sumCard12(data) {
    $('#sum-quantity-card12').html(data.sum_quatity);
    $('#sum-total-card12').html(data.sum_total);
    $('#sum-total-original-card12').html(data.sum_total_original);
    $('#sum-profit-card12').html(data.sum_profit);
}

function table_card11(data) {
    // console.log(data);
    $('#table-card11').DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        serverSide: false,
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            processing: themeLoading($('#table-card11').height(),'')
        },
        data: data,
        ordering: false,
        scrollX: true,
        scrollY: "65vh",
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 2,
            rightColumns: 1,
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'material_name', name: 'material_name', class: 'text-center'},
            {data: 'before_quantity_converted', name: 'before_quantity_converted', class: 'text-center'},
            {data: 'before_amount', name: 'before_amount', class: 'text-center'},
            {data: 'in_quantity_converted', name: 'in_quantity_converted', class: 'text-center'},
            {data: 'in_amount', name: 'in_amount', class: 'text-center'},
            {data: 'out_quantity_converted', name: 'out_quantity_converted', class: 'text-center'},
            {data: 'out_amount', name: 'out_amount', class: 'text-center'},
            // {data: 'after_quantity_converted', name: 'after_quantity_converted', class: 'text-center'},
            // {data: 'after_amount', name: 'after_amount', class: 'text-center'},
            {data: 'deficiency_amount', name: 'deficiency_amount', class: 'text-center'},
        ]
    });
}

function table_card12(data) {
    $('#table-card12').DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        serverSide: false,
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            processing: themeLoading($('#table-card12').height(),'')
        },
        // ajax: JSON.parse(''),
        data: data,
        ordering: false,
        scrollX: true,
        scrollY: "65vh",
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 2,
            rightColumns: 1,
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-center'},
            {data: 'unit', name: 'unit', class: 'text-center'},
            {data: 'quantity', name: 'quantity', class: 'text-center'},
            {data: 'total', name: 'total', class: 'text-center'},
            {data: 'total_original', name: 'total_original', class: 'text-center'},
            {data: 'profit', name: 'profit', class: 'text-center'},
            {data: 'unit_profit', name: 'unit_profit', class: 'text-center'},
            {data: 'profit_rate', name: 'profit_rate', class: 'text-center'},
        ]
    });
}

async function table2Card2(data) {
    $('#employees-revenue-rank-table').DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            processing: themeLoading($('#employees-revenue-rank-table').height(),'')
        },
        serverSide: false,
        ordering: false,
        data: data,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', class: 'text-center', width: '5%'},
            {data: 'employee.name', name: 'name', class: 'text-center'},
            {data: 'employee.role_name', name: 'role_name', class: 'text-center'},
            {data: 'revenue', name: 'revenue', class: 'text-center'}
        ],
        scrollY: null,
        scrollX: true,
        scrollCollapse: true,
        "initComplete": 'initComplete',
        "dom": 'brt'
    });
}

async function table1Card2(data) {
    $('#food-revenue-rank-table').DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        language: {
            emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            processing: themeLoading($('#food-revenue-rank-table').height(),'')
        },
        serverSide: false,
        ordering: false,
        data: data,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-center'},
            {data: 'quantity', name: 'quantity', class: 'text-center'},
            {data: 'total', name: 'total', class: 'text-center'}
        ],
        scrollY: null,
        scrollX: true,
        scrollCollapse: true,
        "initComplete": 'initComplete',
        "dom": 'brt'
    });
    datatableDraw();
}
