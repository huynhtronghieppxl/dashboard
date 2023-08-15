let checkSaveUpdateCategoryFoodData = 0,
    idUpdateCategoryFoodData,
    statusUpdateCategoryFoodData,
    dataUpdate,
    thisUpdateCategoryFoodData, code;

function openModalUpdateCategoryFoodData(res) {



    $('#modal-update-category-food-data').modal('show');
    $('#type-update-category-food-data').select2({
        dropdownParent: $('#modal-update-category-food-data'),
    });

    $('#name-update-category-food-data').on('input', function () {
        $('#code-update-category-food-data').val(removeVietnameseStringLowerCase($(this).val()).toUpperCase());
    });

    thisUpdateCategoryFoodData = res;
    dataUpdate = {
        id: res.data('id'),
        name: res.attr('data-name'),
        type: res.attr('data-type'),
        status: res.attr('data-status'),
        description: res.attr('data-description'),
    }
    code = res.attr('data-code')

    $('#type-update-category-food-data').val(dataUpdate.type).trigger('change.select2');
    $('#modal-update-category-food-data input').on('keyup', function () {
        $('#modal-update-category-food-data .btn-renew').removeClass('d-none')
    })
    $('#modal-update-category-food-data textarea').on('keyup', function () {
        $('#modal-update-category-food-data .btn-renew').removeClass('d-none')
    })

    idUpdateCategoryFoodData = dataUpdate.id;
    statusUpdateCategoryFoodData = dataUpdate.status;

    $('#name-update-category-food-data').val(dataUpdate.name);
    $('#code-update-category-food-data').val(dataUpdate.code);
    $('#description-update-category-food-data').val(dataUpdate.description);
    countCharacterTextarea()

    shortcut.add('F4', function () {
        saveModalUpdateCategoryFoodData();
    });
    shortcut.add('ESC', function () {
        closeModalUpdateCategoryFoodData();
    });
}

async function saveModalUpdateCategoryFoodData() {
    if (checkSaveUpdateCategoryFoodData === 1) return false;
    if (!checkValidateSave($('#modal-update-category-food-data'))) return false
    let name = $('#name-update-category-food-data').val(),
        description = $('#description-update-category-food-data').val(),
        type = $('#type-update-category-food-data').val(),
        restaurant_brand_id = $('.select-brand-category-food-data').val()
    checkSaveUpdateCategoryFoodData = 1;
    let url = 'category-food-data.update',
        method = 'post',
        params = null,
        data = {
            id: idUpdateCategoryFoodData,
            name: name,
            code: code,
            restaurant_brand_id: restaurant_brand_id,
            description: description,
            category_type: type,
            status: statusUpdateCategoryFoodData,
        };

    if (data.name == dataUpdate.name && data.code == code && data.description == dataUpdate.description && data.category_type == dataUpdate.type && data.status == dataUpdate.status) {
        SuccessNotify($('#success-update-data-to-server').text());
        closeModalUpdateCategoryFoodData()
        checkSaveUpdateCategoryFoodData = 0;
        return;
    }

    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-category-food-data')]);
    checkSaveUpdateCategoryFoodData = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            drawDataUpdateCategoryData(res.data.data);
            closeModalUpdateCategoryFoodData()
            break;
        case 500:
            (res.data.message !== null) ? ErrorNotify(res.data.message) : ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            (res.data.message !== null) ? WarningNotify(res.data.message) : WarningNotify($('#error-post-data-to-server').text())
    }
}

function closeModalUpdateCategoryFoodData() {
    $('#modal-update-category-food-data').modal('hide');
    resetModalUpdateCategoryFoodData();
    countCharacterTextarea()
    shortcut.remove('ESC');
    shortcut.remove('F4');
}

function resetModalUpdateCategoryFoodData() {
    removeAllValidate();
    $('#name-update-category-food-data').val(thisUpdateCategoryFoodData.attr('data-name'));
    $('#description-update-category-food-data').val(thisUpdateCategoryFoodData.attr('data-description'));
    $('#modal-update-category-food-data .btn-renew').addClass('d-none')
}

function drawDataUpdateCategoryData(data) {
    thisUpdateCategoryFoodData.parents('tr').find('td:eq(1)').text(data.name);
    thisUpdateCategoryFoodData.parents('tr').find('td:eq(2)').html(data.category_type_name);
    thisUpdateCategoryFoodData.parents('tr').find('td:eq(3)').text(data.description);
    thisUpdateCategoryFoodData.parents('tr').find('td:eq(4)').html(data.action);
    thisUpdateCategoryFoodData.parents('tr').find('td:eq(5)').html(data.keysearch);
}

