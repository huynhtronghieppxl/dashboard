let checkSaveCreateContactSupplier = 0;
let checkRoleSupplier = 0;
function openModalCreateContactSupplier(){
    $('#modal-create-contact-supplier-data').modal('show');
    $('#modal-create-contact-supplier-data').on('shown.bs.modal', function () {
        $('#name-contact-supplier-data').focus();
    })
    $('#name-contact-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#phone-contact-supplier-data').select();
        }
    });
    $('#phone-contact-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#email-contact-supplier-data').select();
        }
    });

    $('#email-contact-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#select-role-contact-supplier').select2('open');
        }
    });
    $('#email-contact-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $("#save-create-btn-kitchen-data").click();

        }

    });
    $('#select-role-contact-supplier').select2({
        dropdownParent: $('#modal-create-contact-supplier-data'),
    });
    getRoleSupplier();
    $('#modal-create-contact-supplier-data input').val('');
    $('#modal-create-contact-supplier-data input').on('input', function (){
        $('.btn-renew').removeClass('d-none')
    })
    $('#modal-create-contact-supplier-data select').on('change', function (){
        $('.btn-renew').removeClass('d-none')
    })
    shortcut.add("F4", function () {
        saveCreateContactSupplier();
    });
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalCreateContactSupplier();
    });
}

async function getRoleSupplier(){
    if(checkRoleSupplier === 1) return false;
    let method = 'get',
        url = 'list-supplier-data.get-role',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-role-contact-supplier')]);
    checkRoleSupplier = 1;
     $('#select-role-contact-supplier').html(res.data['0']);
}

async function saveCreateContactSupplier(){
    if (checkSaveCreateContactSupplier === 1) return false;
    if (!checkValidateSave($('#modal-create-contact-supplier-data'))) return false;
    let name = $('#name-contact-supplier-data').val(),
        phone = $('#phone-contact-supplier-data').val(),
        email = $('#email-contact-supplier-data').val(),
        role = $('#select-role-contact-supplier').val();
    let method = 'post',
        url = 'list-supplier-data.create-contact',
        params = {
            id   : idContactSupplierData,
            name: name,
            phone : phone,
            email : email,
            role : role
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#load-modal-create-contact-supplier-data')]);
    checkSaveCreateContactSupplier = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalCreateContactSupplier();
            addRowDatatableTemplate(tableContactSupplierData, {
                'contact_name': res.data.data.contact_name,
                'phone': res.data.data.phone,
                'email': res.data.data.email,
                'supplier_role_name': res.data.data.supplier_role_name,
                'status': res.data.data.status,
                'action': res.data.data.action,
                'keysearch': res.data.data.keysearch
            })
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}



function closeModalCreateContactSupplier(){
    shortcut.remove('F4');
    $('#modal-create-contact-supplier-data').modal('hide');
    reloadModalCreateContactSupplier();
}

function reloadModalCreateContactSupplier(){
    removeAllValidate();
    $('#modal-create-contact-supplier-data .btn-renew').addClass('d-none')
    $('#name-contact-supplier-data').val('');
    $('#phone-contact-supplier-data').val('');
    $('#email-contact-supplier-data').val('');
    $('#select-role-contact-supplier').val($('#select-role-contact-supplier option:first').val()).trigger('change.select2');
}
