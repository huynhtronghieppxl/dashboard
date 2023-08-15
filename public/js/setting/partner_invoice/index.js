let drawTablePartnerInvoice, checkChangeStatusPartnerInvoice = 0;
$(async function(){
    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }

    $(document).on('click', '#partner-invoice-content .nav-link h3', function(){
        $('#name-partner-invoice-contact').text($(this).text())
    })

    $(document).on('change', '#select-branch-partner-invoice', function(){
        $('#name-branch-partner-invoice-contact').text($('#select-branch-partner-invoice option:selected').text())
    })

    $('#name-branch-partner-invoice-contact').text($('#select-branch-partner-invoice option:selected').text())
})

async function loadData() {
    let method = 'get',
        url = 'partner-invoice.data',
        params = {
            restaurant_brand_id: $('.select-brand').val(),
            branch: $('.select-branch').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $("#partner-invoice-table"),
    ]);
    dataTablePartnerInvoice(res)
}


async function dataTablePartnerInvoice(data) {
    let id = $('#partner-invoice-table'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-left', width: '5%'},
            {data: 'partner_invoice_name', name: 'partner_invoice_name', className: 'text-left'},
            {data: 'branch_name', name: 'branch_name', className: 'text-left'},
            {data: 'tax_code', name: 'tax_code', className: 'text-left'},
            {data: 'username', name: 'username', className: 'text-left'},
            {data: 'invoice_denominator', name: 'invoice_denominator', className: 'text-left'},
            {data: 'invoice_series', name: 'invoice_series', className: 'text-left'},
            {data: 'action', name: 'action',},
            // {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ],
        option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreatePartnerInvoice',
        }];
    drawTablePartnerInvoice = await DatatableTemplateNew(id, data.data[0].original.data, column, vh_of_table, fixed_left, fixed_right, option);
    $('#partner-invoice-table_filter').addClass('d-none')
}


function changeStatusPartnerInvoice(r){
    let id = r.data('id');
    let title = 'Đổi trạng thái thành tạm ngưng ? ',
            content = '',
            icon = 'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            if(checkChangeStatusPartnerInvoice === 1) return false;
            let method = 'post',
                url = 'partner-invoice.change-status',
                params = null,
                data = {id: id};
            let res = await axiosTemplate(method, url, params, data, [$('#table-enable-unit-data'), $('#table-disable-unit-data')]);
            checkChangeStatusPartnerInvoice = 0;
            switch(res.data[1].status) {
                case 200:
                    SuccessNotify($('#msg-success-status-unit-data').text());
                    loadData();
                    drawChangeUnitStatus(res.data[1].data);
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }
    })
}


