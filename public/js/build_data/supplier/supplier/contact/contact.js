let idContactSupplierData = 0,
    statusSupplierContact = $('.select-reason-contact-supplier').find(':selected').val(),
    checkChangeStatusContactSupplierData = 0, test, tableContactSupplierData, idDetailContactSupplier;

function openModalContactSupplierData(r) {
    $('#modal-contact-supplier-data').modal('show');
    idContactSupplierData = r.data('id');
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalContactSupplierData();
    });
    $('#modal-update-contact-supplier-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalContactSupplierData();
        });
    })
    $('#modal-create-contact-supplier-data').on('hidden.bs.modal', function (e) {
        shortcut.remove("ESC");
        shortcut.add("ESC", function () {
            closeModalContactSupplierData();
        });
    })
    $('#select-contact-supplier').select2({
        dropdownParent: $('#modal-contact-supplier-data'),
    });
    $('#select-contact-supplier').on('select2:select', function () {
        $('#select-contact-supplier').val($(this).val()).trigger('change.select2');
        statusSupplierContact = $(this).val();
        dataListContact(r.data('id'));
    });

    dataListContact(r.data('id'));
}

async function dataListContact(id) {
    let method = 'get',
        url = 'list-supplier-data.data-contact',
        params = {
            supplier_id: id,
            status: statusSupplierContact,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-contact-supplier-data')]);
    dataTableContactSupplierData(res);
}

async function dataTableContactSupplierData(data) {
    let id_table_contact = $('#table-contact-supplier'),
        scroll_Y = '40vh',
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'contact_name', name: 'name', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'email', name: 'email', className: 'text-center'},
            {data: 'supplier_role_name', name: 'supplier_role_name', className: 'text-center'},
            {data: 'status', name: 'status', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', name: 'keysearch', className: 'd-none'},
        ], option = [{
            'title': 'Thêm mới',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateContactSupplier',
        }];
    tableContactSupplierData = await DatatableTemplateNew(id_table_contact, data.data[0].original.data, columns, scroll_Y, fixed_left, fixed_right,option);
    $(document).on('input paste','#table-contact-supplier_filter input[type="search"]', function (){
        searchUpdateIndexDatatable(tableContactSupplierData)
    })
    $('#select-contact-supplier').find('option:first').trigger('change.select2')

}

function changeStatusContactSupplierData(r) {
    test = r;
    if(checkChangeStatusContactSupplierData === 1) return false;
    if (r.data('status') === 0) {
        let title = 'Đổi sang trạng thái hoạt động ?', content = '', icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                checkChangeStatusContactSupplierData = 1;
                let method = 'post',
                    url = 'list-supplier-data.change-status-contact',
                    params = null,
                    data = {id: r.data('id')};
                let res = await axiosTemplate(method, url, params, data);
                checkChangeStatusContactSupplierData = 0;
                switch(res.data.status) {
                    case 200:
                        SuccessNotify($('#success-status-data-to-server').text());
                        test.parents('tr').find('td:eq(5)').html(res.data.data.status);
                        test.parents('tr').find('td:eq(6)').html(res.data.data.action);
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message)
                }
            }
        })
    } else {
        let title = 'Đổi sang trạng thái tạm ngưng ?', content = '', icon = 'question';
        sweetAlertComponent(title, content, icon).then(async (result) => {
            if (result.value) {
                checkChangeStatusContactSupplierData = 1;
                let method = 'post', url = 'list-supplier-data.change-status-contact', params = null, data = {id: r.data('id')};
                let res = await axiosTemplate(method, url, params, data);
                checkChangeStatusContactSupplierData = 0;
                switch(res.data.status) {
                    case 200:
                        SuccessNotify($('#success-status-data-to-server').text());
                        test.parents('tr').find('td:eq(5)').html(res.data.data.status);
                        test.parents('tr').find('td:eq(6)').html(res.data.data.action);
                        break;
                    case 500:
                        ErrorNotify($('#error-post-data-to-server').text());
                        break;
                    default:
                        WarningNotify(res.data.message)
                }
            }
        })
    }
}

function closeModalContactSupplierData() {
    $('#tab-Contact').click()
    $('#modal-contact-supplier-data').modal('hide');
}
