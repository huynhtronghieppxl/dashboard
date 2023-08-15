let idPaymentDebt, idSupplier, dataTableDetailPaymentDebtTreasurer;
function openModalDetailPaymentDebtTreasurer(r){
    shortcut.remove('ESC');
    shortcut.add('ESC',function (){
        closeModalDetailPaymentDebtTreasurer();
    })
    $('#modal-detail-payment-debt').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailPaymentDebtTreasurer();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOrderSupplierOrder();
        });
    });
    $('#modal-detail-supplier-payment-debt-treasurer').modal('show');
    idPaymentDebt = r.data('id');
    idSupplier = r.data('supplier');
    detail();
}

async function detail(){
     let method = 'get',
        url = 'supplier-payment-debt-treasurer.detail',
        params = {
            id : idPaymentDebt,
            supplier : idSupplier,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#table-order-payment-debt-treasurer'),
        $('#boxlist-detail-payment-debt')
    ]);
    $('#name-detail-payment-debt').text(res.data[1].supplier_name);
    $('#branch-name-detail-payment-debt').text(res.data[1].branch_name);
    $('#payment-amount-detail-payment-debt').text(formatNumber(Number(res.data[1].total_amount)));
    $('#date-detail-payment-debt').text(res.data[1].from_date + ' - ' + res.data[1].to_date);

    let id = $('#table-order-payment-debt-treasurer'),
        fixed_left = 1,
        fixed_right = 1,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', className: 'text-left'},
            {data: 'total_amount_reality', className: 'text-right'},
            {data: 'date', className: 'text-center'},
            {data: 'status_text', className: 'text-center'},
            {data: 'action', className: 'text-center', width: '5%'},
        ],
        option = [];
    dataTableDetailPaymentDebtTreasurer = await DatatableTemplateNew(id, res.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
}

function closeModalDetailPaymentDebtTreasurer(){
    dataTableDetailPaymentDebtTreasurer.clear().draw(false);
    $('#modal-detail-supplier-payment-debt-treasurer').modal('hide');
    $('#name-detail-payment-debt').text('---');
    $('#total-amount-detail-payment-debt').text('0');
    $('#date-detail-payment-debt').val(moment().format('DD/MM/YYYY'));
}
