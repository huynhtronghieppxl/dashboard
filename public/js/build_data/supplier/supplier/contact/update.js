let idUpdateContactSupplierDataContactSupplierData = 0 , checkUpdateContact = 0;
function openModalUpdateContactSupplier(r){
    $('#modal-update-contact-supplier-data').modal('show');
    $('#select-role-update-contact-supplier').select2({
        dropdownParent: $('#modal-update-contact-supplier-data'),
    });
    dataUpdate(r.data('id'));
    idUpdateContactSupplierDataContactSupplierData = r.data('id');
    shortcut.remove("ESC");
    shortcut.add("ESC", function () {
        closeModalUpdateContactSupplier();
    });
    shortcut.add('F4', function () {
        updateContact();
    });
}
async function dataUpdate(id){
    let method = 'get',
        url = 'list-supplier-data.data-update-contact',
        params = {
            id:id
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-role-update-contact-supplier')]);
    $('#name-update-contact-supplier-data').val(res.data[0].data['contact_name']);
    $('#phone-update-contact-supplier-data').val(res.data[0].data['phone']);
    $('#email-update-contact-supplier-data').val(res.data[0].data['email']);
    $('#select-role-update-contact-supplier').html(res.data[1]);
}

async function updateContact(){
    if (checkUpdateContact === 1) return false;
    if (!checkValidateSave($('#modal-update-contact-supplier-data'))) return false;
    let name = $('#name-update-contact-supplier-data').val(),
        phone = $('#phone-update-contact-supplier-data').val(),
        email = $('#email-update-contact-supplier-data').val(),
        role = $('#select-role-update-contact-supplier').val();
    checkUpdateContact = 1;
    let method = 'post',
        url = 'list-supplier-data.update-contact',
        params = {
            id: idUpdateContactSupplierDataContactSupplierData,
            name: name,
            email:email,
            role:role,
            phone: phone
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#load-modal-update-contact-supplier-data')]);
            checkUpdateContact = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalUpdateContactSupplier();
            loadData();
            dataListContact(idContactSupplierData);
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalUpdateContactSupplier(){
    $('#modal-update-contact-supplier-data').modal('hide');
    reloadModalUpdateContactSupplier();
}

function reloadModalUpdateContactSupplier(){
    $('#modal-update-contact-supplier-data input').val('');
    $('#picture-update-supplier-list-supplier').attr('src','http://127.0.0.1:8000/images/tms/default.jpeg')
}
