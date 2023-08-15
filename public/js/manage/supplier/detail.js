let lastIdDetailSupplierManage,
    lastBranchDetailSupplierManage,
    idDetailSupplierManage,
    dataTableDetailMaterialUsingSupplierManage,
    dataTableDetailAllMaterialSupplierManage,
    dataTableDetailWaitingBillAllSupplierManage,
    dataTableDetailDebtSupplierManage,
    dataTableDetailContactSupplierManage, brand_id_supplier = $('.select-brand').val(), branch = $('.select-branch').val();

function openDetailSupplierManage(id) {
    $('#modal-detail-supplier-manage').modal('show');
    reloadModalDetailSupplierManage();
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalDetailSupplierManage();
    });
    $('#modal-detail-order-supplier-order').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailSupplierManage();
        });
    });
    $('#modal-detail-material-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalDetailOrderSupplierOrder();
        });
    });
    idDetailSupplierManage = id;
    dataDetailSupplierManage(id);
}

async function dataDetailSupplierManage(id) {
    if (id !== lastIdDetailSupplierManage || $('.select-branch').val() !== lastBranchDetailSupplierManage) {
        let method = 'get',
            url = 'supplier-manage.detail',
            params = {
                supplier: id,
                brand: brand_id_supplier,
                branch: branch == undefined ? -1 : $('.select-branch').val(),
            },
            data = null;
        let res = await axiosTemplate(method, url, params, data,[$('#loading-modal-detail-supplier-manage')]);
        lastIdDetailSupplierManage = res.data[0].id;
        lastBranchDetailSupplierManage = res.data[0].branch;
        $('#name-detail-supplier-manage').text(res.data[0].name);
        $('#avatar-detail-supplier-manage').attr('src',res.data[0].avatar)
        $('#type-detail-supplier-manage').text(res.data[0].type);
        $('#create-detail-supplier-manage').text(res.data[0].created_at);
        $('#phone-detail-supplier-manage').text(res.data[0].phone);
        $('#address-detail-supplier-manage').text(res.data[0].address);
        if (res.data[0].tax_code){
            $('#code-detail-supplier-manager').text(res.data[0].tax_code);
        }
        if (res.data[0].email){
            $('#email-detail-supplier-manage').text(res.data[0].email);
        }
        if(res.data[0].website){
            $('#website-detail-supplier-manage').addClass('class-link-status')
            $('#website-detail-supplier-manage').text(res.data[0].website);
            $('#website-detail-supplier-manage').attr('href',res.data[0].website)
        }
        if(res.data[0].description){
            $('#description-detail-supplier-manage').text(res.data[0].description);
        }
        $('#total-order-detail-supplier-manage').text(res.data[0].count_total_order);
        $('#total-amount-detail-supplier-manage').text(res.data[0].total_order_amount);
        $('#done-order-detail-supplier-manage').text(res.data[0].count_total_order_complete);
        $('#done-amount-detail-supplier-manage').text(res.data[0].total_order_amount_complete);
        $('#return-order-detail-supplier-manage').text(res.data[0].count_total_order_return);
        $('#return-amount-detail-supplier-manage').text(res.data[0].total_order_amount_return);
        $('#debt-order-detail-supplier-manage').text(res.data[0].count_total_order_debt);
        $('#debt-amount-detail-supplier-manage').text(res.data[0].total_order_amount_debt);
        $('#waiting-order-detail-supplier-manage').text(res.data[0].count_total_order_processing);
        $('#waiting-amount-detail-supplier-manage').text(res.data[0].total_order_amount_processing);
        $('#total-amount-in-waiting-detail-supplier').text(formatNumber( res.data[8]. total_amount_in_waiting ));
        $('#total-amount-return-waiting-detail-supplier').text(formatNumber(res.data[8].total_amount_out_waiting));
        $('#total-amount-payment-waiting-detail-supplier').text(formatNumber(res.data[8].total_amount_payment_waiting));
        $('#total-amount-in-debt-detail-supplier').text(formatNumber(res.data[9].total_amount_in_debt));
        $('#total-amount-return-debt-detail-supplier').text(formatNumber(res.data[9].total_amount_out_debt));
        $('#total-amount-payment-debt-detail-supplier').text(formatNumber(res.data[9].total_amount_payment_debt));

        dataTableDetailSupplierData(res);
        dataTotalDetailSupplierData(res.data[6]);

        hideTextTooLong($('#description-detail-supplier-manage'));

    }
}

async function dataTableDetailSupplierData(data) {
    let tableMaterialUsingSupplierManage = $('#table-material-using-supplier-manage'),
        tableAllMaterialSupplierManage = $('#table-material-supplier-manage'),
        tableWaitingBillSupplierManage = $('#table-waiting-bill-supplier-manage'),
        tableDebtSupplierManage = $('#table-debt-supplier-manage'),
        tableContactDetailSupplierManage = $('#table-contact-detail-supplier-manage'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        column1 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'supplier_material_name', name: 'supplier_material_name', className: 'text-left'},
            {data: 'material_unit_conversion_rate', name: 'material_unit_conversion_rate', className: 'text-center'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-left'},
            {
                data: 'supplier_material_category_name',
                name: 'supplier_material_category_name',
                className: 'text-left'
            },
            {data: 'supplier_cost_price', name: 'supplier_cost_price', className: 'text-right'},
            {data: 'keysearch', className: 'd-none'},
        ],

        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'supplier_material_name', name: 'supplier_material_name', className: 'text-left'},
            {
                data: 'supplier_material_category_name',
                name: 'supplier_material_category_name',
                className: 'text-left'
            },
            {data: 'supplier_cost_price', name: 'supplier_cost_price', className: 'text-right'},
            {data: 'keysearch', className: 'd-none'},
        ],

        column3 = [
            {data: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'code', name: 'code', className: 'text-left'},
            {data: 'employee_created_full_name', name: 'employee_created_full_name',className: 'text-left'},
            {data: 'total_material', name: 'total_material', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'return_amount', name: 'return_amount', className: 'text-right'},
            {data: 'total_amount_reality', name: 'total_amount_reality', className: 'text-right'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],
        column4 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'contact_name', name: 'contact_name', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-left'},
            {data: 'email', name: 'email', className: 'text-left'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [];
    dataTableDetailMaterialUsingSupplierManage = await DatatableTemplateNew(tableMaterialUsingSupplierManage, data.data[1].original.data, column1, scroll_Y, fixed_left, fixed_right,option);
    dataTableDetailAllMaterialSupplierManage = await DatatableTemplateNew(tableAllMaterialSupplierManage, data.data[2].original.data, column2, scroll_Y, fixed_left, fixed_right,option);
    dataTableDetailWaitingBillAllSupplierManage = await DatatableTemplateNew(tableWaitingBillSupplierManage, data.data[3].original.data, column3, scroll_Y, fixed_left, fixed_right,option);
    dataTableDetailDebtSupplierManage = await DatatableTemplateNew(tableDebtSupplierManage, data.data[4].original.data, column3, scroll_Y, fixed_left, fixed_right,option);
    dataTableDetailContactSupplierManage = await DatatableTemplateNew(tableContactDetailSupplierManage, data.data[5].original.data, column4, scroll_Y, fixed_left, fixed_right,option);

    // Tab liên hệ
    $(document).on('input paste','#table-contact-detail-supplier-manage_filter input[type="search"]', function (){
        let indexTabContact = 1
        $('#total-record-tab-contact').text(dataTableDetailContactSupplierManage.rows({'search':'applied'}).count())
        dataTableDetailContactSupplierManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(indexTabContact)
            indexTabContact++
        })
    })
    // Tab NL sử dụng
    $(document).on('input paste keyup','#table-material-using-supplier-manage_filter input[type="search"]', function (){
        let indexMaterialUsing = 1
        $('#total-record-tab-material-using').text(dataTableDetailMaterialUsingSupplierManage.rows({'search':'applied'}).count())
        dataTableDetailMaterialUsingSupplierManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(indexMaterialUsing)
            indexMaterialUsing++
        })
    })
    // Tab tổng NL NCC
    $(document).on('input paste keyup','#table-material-supplier-manage_filter input[type="search"]', function (){
        let indexAllMaterial = 1 ;
        $('#total-record-tab-material').text(dataTableDetailAllMaterialSupplierManage.rows({'search':'applied'}).count())
        dataTableDetailAllMaterialSupplierManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            row.find('td:eq(0)').text(indexAllMaterial)
            indexAllMaterial++
        })
    })
    // Tab đơn hàng chờ thanh toán
    $(document).on('input paste keyup','#lastBranchDetailSupplierManage input[type="search"]', function (){
        let indexWaitingBill = 1 , totalInWaitingBill = 0, totalReturnWaitingBill = 0, totalPaymentWaitingBill = 0;
        $('#total-record-tab-waiting-bill').text(dataTableDetailWaitingBillAllSupplierManage.rows({'search':'applied'}).count())
        dataTableDetailWaitingBillAllSupplierManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            totalInWaitingBill += removeformatNumber(row.find('td:eq(4)').text())
            totalReturnWaitingBill += removeformatNumber(row.find('td:eq(5)').text())
            totalPaymentWaitingBill += removeformatNumber(row.find('td:eq(6)').text())
            row.find('td:eq(0)').text(indexWaitingBill)
            indexWaitingBill++
        })
        $('#total-amount-in-waiting-detail-supplier').text(formatNumber(totalInWaitingBill));
        $('#total-amount-return-waiting-detail-supplier').text(formatNumber(totalReturnWaitingBill));
        $('#total-amount-payment-waiting-detail-supplier').text(formatNumber(totalPaymentWaitingBill ));
    })
    // Tab đơn hàng chờ công nợ
    $(document).on('input paste keyup','#table-debt-supplier-manage_filter input[type="search"]', function (){
        let indexDebtBill = 1, totalInDebtBill = 0, totalReturnDebtBill = 0, totalPaymentDebtBill = 0
        $('#total-record-tab-debt').text(dataTableDetailDebtSupplierManage.rows({'search':'applied'}).count())
        dataTableDetailDebtSupplierManage.rows({'search':'applied'}).every(function (){
            let row = $(this.node())
            totalInDebtBill += removeformatNumber(row.find('td:eq(4)').text())
            totalReturnDebtBill += removeformatNumber(row.find('td:eq(5)').text())
            totalPaymentDebtBill += removeformatNumber(row.find('td:eq(6)').text())
            row.find('td:eq(0)').text(indexDebtBill)
            indexDebtBill++
        })
        $('#total-amount-in-debt-detail-supplier').text(formatNumber(totalInDebtBill));
        $('#total-amount-return-debt-detail-supplier').text(formatNumber(totalReturnDebtBill));
        $('#total-amount-payment-debt-detail-supplier').text(formatNumber(totalPaymentDebtBill));
    })

}

function dataTotalDetailSupplierData(data) {
    $('#total-record-tab-material-using').text(data.total_material_using);
    $('#total-record-tab-material').text(data.total_all_material);
    $('#total-record-tab-waiting-bill').text(data.total_waiting);
    $('#total-record-tab-debt').text(data.total_debt);
    $('#total-record-tab-contact').text(data.total_contact);
}

function closeModalDetailSupplierManage() {
    $('#modal-detail-supplier-manage').modal('hide');
    dataTableDetailMaterialUsingSupplierManage.clear().draw(false);
    dataTableDetailAllMaterialSupplierManage.clear().draw(false);
    dataTableDetailWaitingBillAllSupplierManage.clear().draw(false);
    dataTableDetailDebtSupplierManage.clear().draw(false);
    dataTableDetailContactSupplierManage.clear().draw(false);
    reloadModalDetailSupplierManage();
}

function reloadModalDetailSupplierManage(){
    $('#tab-Detail').click();
    $('#name-detail-supplier-manage').text('---');
    $('#type-detail-supplier-manage').text('---');
    $('#create-detail-supplier-manage').text('---');
    $('#phone-detail-supplier-manage').text('---');
    $('#address-detail-supplier-manage').text('---');
    $('#code-detail-supplier-manager').text('---');
    $('#email-detail-supplier-manage').text('---');
    $('#website-detail-supplier-manage').text('---');
    $('#description-detail-supplier-manage').text('---');
    $('#total-order-detail-supplier-manage').text(0);
    $('#total-amount-detail-supplier-manage').text(0);
    $('#done-order-detail-supplier-manage').text(0);
    $('#done-amount-detail-supplier-manage').text(0);
    $('#return-order-detail-supplier-manage').text(0);
    $('#return-amount-detail-supplier-manage').text(0);
    $('#waiting-order-detail-supplier-manage').text(0);
    $('#waiting-amount-detail-supplier-manage').text(0);
    $('#debt-order-detail-supplier-manage').text(0);
    $('#debt-amount-detail-supplier-manage').text(0);
}
