let checkUpdatePartnerInvoice = 0, idPartnerInvoiceContact, accountPartnerInvoiceUpdate = '',
    idBranchPartnerInvoiceContact, idPartnerInvoice, isCheckChangeAccountPartnerInvoice;
$(function(){
    $('#select-update-partner-invoice').on('change', function(){
        if($(this).val() != idPartnerInvoice){
            $('#form-group-password-update-partner-invoice').removeClass('d-none');
            $('#modal-update-info-partner-invoice input').val('');
            isCheckChangeAccountPartnerInvoice = 0;
            accountPartnerInvoiceUpdate = '';
        }else{
            getDetailPartnerInvoice();
            $('#form-group-password-update-partner-invoice').addClass('d-none');
            isCheckChangeAccountPartnerInvoice = 1;
        }
    })

    $('#account-update-partner-invoice').on('input paste', function(e){
        if(accountPartnerInvoiceUpdate == $(this).val()){
            $('#form-group-password-update-partner-invoice').addClass('d-none');
            isCheckChangeAccountPartnerInvoice = 1;
            e.preventDefault();
        }
        if(isCheckChangeAccountPartnerInvoice == 1){
            if($(this).val() != accountPartnerInvoiceUpdate){
                let title = 'Thay đổi tài khoản?', content = 'Bạn buộc phải nhập mật khẩu mới!', icon = 'question';
                sweetAlertComponent(title, content, icon).then(async (result) => {
                    if (result.value) {
                        $('#form-group-password-update-partner-invoice').removeClass('d-none');
                        $('#form-group-password-update-partner-invoice input').val('');
                        $('#password-update-partner-invoice').attr('type', 'password');
                        $('#form-group-password-update-partner-invoice i').attr('class', 'fi-rr-eye-crossed')
                        isCheckChangeAccountPartnerInvoice = 0;
                    }else{
                        $(this).val(accountPartnerInvoiceUpdate)
                        $('#form-group-password-update-partner-invoice').addClass('d-none');
                    }
                })
            }
        }
    })

    $(document).on('click', '#form-group-password-update-partner-invoice i', function () {
        if ($('#password-update-partner-invoice').attr('type') == 'password') {
            $('#password-update-partner-invoice').attr('type', 'text');
            $('#form-group-password-update-partner-invoice i').attr('class', 'fi-rr-eye')
        } else {
            $('#password-update-partner-invoice').attr('type', 'password');
            $('#form-group-password-update-partner-invoice i').attr('class', 'fi-rr-eye-crossed')
        }
    });
})

async function openModalUpdatePartnerInvoice(r){
    $('#modal-update-info-partner-invoice').modal('show');
    isCheckChangeAccountPartnerInvoice = 1;
    idPartnerInvoiceContact = r;
    await getDetailPartnerInvoice(idPartnerInvoiceContact.data('id'));
    dataListPartnerInvoiceUpdate();
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalUpdatePartnerInvoice();
    });
    shortcut.add('F4', function () {
        savePartnerInvoiceUpdate();
    });
    idBranchPartnerInvoiceContact = r.data('branch-id')
    $('#content-form-partner-invoice-contact .js-example-basic-single').select2({
        dropdownParent: $('#modal-update-info-partner-invoice'),
    })
}

async function dataListPartnerInvoiceUpdate() {
    let method = 'get',
        url = 'partner-invoice.list-partner',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-update-partner-invoice')]);
    $('#select-update-partner-invoice').html(res.data[0]);
    $('#select-update-partner-invoice').val(idPartnerInvoice).trigger('change.select2')
}

async function getDetailPartnerInvoice(){
    let method = 'get',
        url = 'partner-invoice.data-update',
        params = {id: idPartnerInvoiceContact.data('id')},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#form-update-partner-invoice')]);
    $('#name-update-branch-partner-invoice-contact').text(idPartnerInvoiceContact.parents('tr').find('td:eq(2)').text())
    $('#tax-code-update-partner-invoice').val(res.data.data.tax_code)
    $('#account-update-partner-invoice').val(res.data.data.username)
    $('#denominator-update-partner-invoice').val(res.data.data.invoice_denominator)
    $('#symbol-bill-update-partner-invoice').val(res.data.data.invoice_series)
    idPartnerInvoice = res.data.data.partner_invoice_id;
    accountPartnerInvoiceUpdate = res.data.data.username;
}

async function savePartnerInvoiceUpdate(){
    if (!checkValidateSave($('#form-update-partner-invoice'))) return false;
    if (checkUpdatePartnerInvoice === 1) return false;
    let method = 'post',
        url = 'partner-invoice.update',
        params = {
            id: idPartnerInvoiceContact.data('id'),
            branch_id : idBranchPartnerInvoiceContact,
            tax_code: $('#tax-code-update-partner-invoice').val(),
            username: $('#form-group-password-update-partner-invoice').hasClass('d-none') ? '' : $('#account-update-partner-invoice').val(),
            partner_identify_name : $('#select-update-partner-invoice option:selected').text().toLowerCase(),
            partner_electronic_invoice_type: $('#select-update-partner-invoice option:selected').data('type'),
            password: $('#form-group-password-update-partner-invoice').hasClass('d-none') ? '' : $('#password-update-partner-invoice').val(),
            invoice_denominator: $('#denominator-update-partner-invoice').val(),
            invoice_series: $('#symbol-bill-update-partner-invoice').val(),
            partner_invoice_id: $('#select-update-partner-invoice').val()
},
        data = null;
    checkUpdatePartnerInvoice = 1;
    let res = await axiosTemplate(method, url, params, data, $('#partner-invoice-content'));
    checkUpdatePartnerInvoice = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify('Cập nhật thành công!');
            closeModalUpdatePartnerInvoice();
            loadData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalUpdatePartnerInvoice(){
    isCheckChangeAccountPartnerInvoice = 0;
    $('#modal-update-info-partner-invoice').modal('hide');
    $('#form-group-password-update-partner-invoice').addClass('d-none');
    $('#form-update-partner-invoice input').val('');
    $('#select-update-partner-invoice').val('').trigger('change.select2');
}
