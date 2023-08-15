let checkCreateSupplierData = 0;
$(function(){
    $('#loading-modal-create-supplier-data .profile-image-avatar').on('click', function(){
         $('#input-picture-create-supplier-list-supplier').click();
    })

    $('#input-picture-create-supplier-list-supplier').on('change', async function () {
        $('#picture-create-supplier-list-supplier').attr('src', URL.createObjectURL($(this).prop('files')[0]));
        let data = await uploadMediaTemplate($(this).prop('files')[0], 0);
        $('#picture-create-supplier-list-supplier').attr('data-url-avt', data.data[0]);
        $('#picture-create-supplier-list-supplier').attr('data-url-thumb', data.data[1]);
        $(this).replaceWith($(this).val('').clone(true));
    });
})
function openModalCreateSupplierData() {
    $('#modal-create-supplier-data').modal('show');
    $('#modal-create-supplier-data').on('shown.bs.modal', function() {
        $('#name-create-supplier-data').first().focus();
    });

    $('#name-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#tax-create-supplier-data').select();
        }
    });

    $('#tax-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#phone-create-supplier-data').select();
        }
    });

    $('#phone-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#website-create-supplier-data').select();
        }
    });

    $('#website-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#email-create-supplier-data').select();
        }
    });

    $('#email-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#address-create-supplier-data').select();
        }
    });

    $('#address-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $('#note-create-supplier-data').select();

        }
    });

    $('#note-create-supplier-data').on('keydown', function (e) {
        if (e.keyCode === 13) {
            $("#btn-create-supplier-data").click();

        }

    });
    e.preventDefault();
    shortcut.add("ESC", function () {
        closeModalCreateSupplierData();
    });
    shortcut.add("F4", function () {
        saveModalCreateSupplierData();
    });
    $('#modal-create-supplier-data input, #modal-create-supplier-data textarea').val('');
    $('#modal-create-supplier-data input, #modal-create-supplier-data textarea').on('input', function (){
        $('.btn-renew').removeClass('d-none')
    })

    checkCreateSupplierData = 0;
}

async function saveModalCreateSupplierData() {
    if (checkCreateSupplierData !== 0) return false;
    if (!checkValidateSave($('#modal-create-supplier-data'))) return false;
    let name = $('#name-create-supplier-data').val();
    let phone = $('#phone-create-supplier-data').val();
    let address = $('#address-create-supplier-data').val();
    let tax = $('#tax-create-supplier-data').val();
    let email = $('#email-create-supplier-data').val();
    let website = $('#website-create-supplier-data').val();
    let note = $('#note-create-supplier-data').val();
    checkCreateSupplierData = 1;
    let method = 'post',
        url = 'list-supplier-data.create',
        params = null,
        data = {
            name: name,
            phone: phone,
            address: address,
            tax: tax,
            email: email,
            website: website,
            des: note,
            avatar: $('#picture-create-supplier-list-supplier').attr('data-url-avt')
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-supplier-data')]);
    checkCreateSupplierData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            $('#tab-supplier-data-use').click();
            drawDataTableSupplier(res.data.data);
            closeModalCreateSupplierData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalCreateSupplierData() {
    $('#modal-create-supplier-data').modal('hide');
    resetModalCreateSupplierData();
}

function resetModalCreateSupplierData() {
    removeAllValidate();
    $('#modal-create-supplier-data input, #modal-create-supplier-data textarea').val('');
    $('#modal-create-supplier-data .btn-renew').addClass('d-none')
    $('#picture-create-supplier-list-supplier').attr('src','http://127.0.0.1:8000/images/tms/default.jpeg')
    countCharacterTextarea()
}

