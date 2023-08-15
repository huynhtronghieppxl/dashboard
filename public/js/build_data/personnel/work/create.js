let checkSaveCreateWorkData = 0,
    checkSaveCategoryCreateWorkData = 0,
    countItemInSelectCategoryWorkData;
function openModalCreateWorkData() {
    checkSaveCreateWorkData = 0;
    checkSaveCategoryCreateWorkData = 0;
    $('#modal-create-work-data').modal('show');
    shortcut.remove('F4');
    shortcut.add('F4', function () {
        saveCreateWorkData();
    });
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalCreateWorkData();
    });
    $('#modal-create-work-category-work-data').on('hidden.bs.modal', function () {
        shortcut.remove('ESC');
        shortcut.add('ESC', function () {
            closeModalCreateWorkData();
        });
    });

    $('#category-create-work-data, #kpi-create-work-data').select2({
        dropdownParent: $('#modal-create-work-data'),
    });
    $('#modal-create-work-data .btn-renew').addClass('d-none');

    $('#modal-create-work-data input, #modal-create-work-data textarea').on('input', function (){
        $('#modal-create-work-data .btn-renew').removeClass('d-none');
    });
    $('#modal-create-work-data select').on('change', function (){
        $('#modal-create-work-data .btn-renew').removeClass('d-none');
    });
}

async function saveCreateWorkData() {
    if (checkSaveCreateWorkData === 1) return false;
    if (!checkValidateSave($('#modal-create-work-data'))) return false;
    checkSaveCreateWorkData = 1;
    let method = 'post',
        url = 'work-data.create',
        brand_id = $('.select-brand.work-data').val(),
        role = $('#category-create-work-data option:selected').data('employee-role-id'),
        category = $('#category-create-work-data').val(),
        name = $('#name-create-work-data').val(),
        description = $('#description-create-work-data').val(),
        kpi_point = $('#kpi-create-work-data').val(),
        params = null,
        data = {
            brand_id: brand_id,
            role: role,
            name: name,
            description: description,
            category: category,
            base_point: kpi_point
        };
    let res = await axiosTemplate(method, url, params, data, [$('#create-work-data')]);
    checkSaveCreateWorkData = 0;
    let text = '';
    switch (res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            dataWorkData();
            closeModalCreateWorkData();
            $('.empty-datatable-custom').remove();
            break;
        case 500:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            ErrorNotify(text);
            break;
        default:
            text = $('#error-post-data-to-server').text();
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
}

function closeModalCreateWorkData() {
    $('#modal-create-work-data').modal('hide');
    shortcut.remove('F4');
    reloadModalCreateWorkData();
}

function reloadModalCreateWorkData(){
    removeAllValidate();
    $('#category-create-work-data').val($('#category-create-work-data').find('option:first-child').val()).trigger('change.select2');
    $('#modal-create-work-data input').val('');
    $('#modal-create-work-data textarea').val('');
    $('#kpi-create-work-data').val(1).trigger('change');
    $('#modal-create-work-data .btn-renew').addClass('d-none');
    countCharacterTextarea()
}
