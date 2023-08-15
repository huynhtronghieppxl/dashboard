let checkCreatePartnerInvoice = 0;
$(function () {
    $(document).on('click', '#form-group-password-create-partner-invoice i', function () {
        if ($('#password-create-partner-invoice').attr('type') == 'password') {
            $('#password-create-partner-invoice').attr('type', 'text');
            $('#form-group-password-create-partner-invoice i').attr('class', 'fi-rr-eye')
        } else {
            $('#password-create-partner-invoice').attr('type', 'password');
            $('#form-group-password-create-partner-invoice i').attr('class', 'fi-rr-eye-crossed')
        }
    });
})

function openModalCreatePartnerInvoice(r) {
    $('#modal-create-info-partner-invoice').modal('show')
    $('#modal-create-info-partner-invoice .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-info-partner-invoice'),
    })
    dataListPartnerInvoice();
    getBrach($('.select-brand').val())

    shortcut.add("F4", function () {
        savePartnerInvoiceCreate();
    });
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalCreatePartnerInvoice();
    });
}

async function dataListPartnerInvoice() {
    let method = 'get',
        url = 'partner-invoice.list-partner',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#select-create-partner-invoice').html(res.data[0]);
}

async function getBrach(restaurant_brands_id){
    let method = 'get',
        url = 'get-list-branch',
        params = {restaurant_brand_id: restaurant_brands_id},
        data = null;
    let res = await axiosTemplate(method, url, params, data);

    $('#select-branch-create-partner-invoice').html('<option value="-1">Tất cả chi nhánh</option>' + res.data[0]);
}

async function savePartnerInvoiceCreate() {
    if (!checkValidateSave($('.form-create-partner-invoice'))) return false;
    if (checkCreatePartnerInvoice === 1) return false;
    let method = 'post',
        url = 'partner-invoice.create',
        params = {
            brand_id: $('.select-brand').val(),
            branch_id: $('#select-branch-create-partner-invoice').val(),
            partner_electronic_invoice_type: $('#select-create-partner-invoice option:selected').data('type'),
            partner_identify_name: $('#select-create-partner-invoice option:selected').text().toLowerCase(),
            tax_code: $('#tax-code-create-partner-invoice').val(),
            username: $('#account-create-partner-invoice').val(),
            password: $('#password-create-partner-invoice').val(),
            invoice_denominator: $('#denominator-create-partner-invoice').val(),
            invoice_series: $('#symbol-bill-create-partner-invoice').val(),
            partner_invoice_id: $('#select-create-partner-invoice').val()
        },
        data = null;
    checkCreatePartnerInvoice = 1;
    let res = await axiosTemplate(method, url, params, data);
    checkCreatePartnerInvoice = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server'));
            closeModalCreatePartnerInvoice();
            loadData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalCreatePartnerInvoice() {
    $('#modal-create-info-partner-invoice').modal('hide');
    $('#password-create-partner-invoice').attr('type', 'password');
    $('#form-group-password-create-partner-invoice i').attr('class', 'fi-rr-eye-crossed')

    $('#tax-code-create-partner-invoice').val('');
    $('#account-create-partner-invoice').val('');
    $('#password-create-partner-invoice').val('');
    $('#denominator-create-partner-invoice').val('');
    $('#symbol-bill-create-partner-invoice').val('');
}
