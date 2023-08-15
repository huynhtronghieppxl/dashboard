let checkCreateCategoryWorkData;

function openModalCreateWorkCategoryWorkData() {
    checkCreateCategoryWorkData = 0;
    $('#modal-create-work-category-work-data').modal('show');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateCategoryWorkData();
    });
    shortcut.add('F4', function () {
        saveModalCreateCategoryWorkData();
    });
    $('#name-create-category-work-data').focus();
    $('#modal-create-work-category-work-data .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-work-category-work-data'),
    });
    $('.btn-renew').addClass('d-none');
    $('#loading-modal-create-category-work-data input').on('input', function (){
        $('#modal-create-work-category-work-data .btn-renew').removeClass('d-none');
    });
}

async function saveModalCreateCategoryWorkData() {
    if (checkCreateCategoryWorkData === 1) return false;
    if (!checkValidateSave($("#modal-create-work-category-work-data"))) return false;
    checkCreateCategoryWorkData = 1;
    let role = $('#select-role-work-data-employee').val(),
        name = $('#name-create-category-work-data').val(),
        brand = $('.select-brand.work-data').val(),
        description = '',
        method = 'post',
        url = 'category-work-data.create',
        params = null,
        data = {
            role: role,
            brand: brand,
            name: name,
            description: description,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-category-work-data')]);
    checkCreateCategoryWorkData = 0;
    let text = '';
    switch (res.data[1].status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            closeModalCreateCategoryWorkData();
            await $('#category-create-work-data').append('<option value="' + res.data[1].data.id + '" data-employee-role-id="' + res.data[1].data.employee_role.id + '">' + res.data[1].data.name + '</option>');
            await $('#category-update-work-data').append('<option value="' + res.data[1].data.id + '">' + res.data[1].data.name + '</option>');
            $('#category-create-work-data').val(res.data[1].data.id).trigger('change.select2');
            $('#category-create-work-data').find('option[value=""]').remove();
            $('#category-update-work-data').find('option[value=""]').remove();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data[1].message !== null) {
                text = res.data[1].message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data[1].message !== null) {
                text = res.data[1].message;
            }
            WarningNotify(text);
    }
}

function closeModalCreateCategoryWorkData() {
    $('#modal-create-work-category-work-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    reloadModalCreateCategoryWorkData();
}

function reloadModalCreateCategoryWorkData(){
    $('#name-create-category-work-data').val('');
    $('#modal-create-work-category-work-data .btn-renew').addClass('d-none')
}
