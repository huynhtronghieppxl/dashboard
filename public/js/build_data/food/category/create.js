let checkSaveCreateCategoryFoodData = 0;

$(function () {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateCategoryFoodData();
    });
})

function openModalCreateCategoryFoodData() {
    $('#modal-create-category-food-data').modal('show');
    $('#type-create-category-food-data').select2({
        dropdownParent: $('#modal-create-category-food-data'),
    });
    $('#type-create-category-food-data').val('1').trigger('change.select2');

    $('#name-create-category-food-data').on('input paste keyup', function () {
        let code = removeVietnameseStringLowerCase($(this).val()).toUpperCase();
        $('#code-create-category-food-data').val(code);
        $('#code-create-category-food-data').parent().removeClass('validate-error');
        $('#code-create-category-food-data').parent().parent().find('.error').remove();
    });

    $('#name-create-category-food-data').on('input paste keyup', function () {
        if ($('#code-create-category-food-data').val() != '') {
            $('#code-create-category-food-data').parent().removeClass('validate-error');
            $('#code-create-category-food-data').parent().find('.error').remove();
        }
    })
    $('#code-create-category-food-data').on('input paste keyup', function () {
        $(this).val( removeVietnameseStringLowerCase($(this).val()).trim().toUpperCase());
    })
    $('#name-create-category-food-data').on('change', function () {
    })
    $('#modal-create-category-food-data input').on('keyup', function () {
        $('#modal-create-category-food-data .btn-renew').removeClass('d-none')
    })
    $('#modal-create-category-food-data textarea').on('keyup', function () {
        $('#modal-create-category-food-data .btn-renew').removeClass('d-none')
    })
    $('#modal-create-category-food-data select').on('change', function () {
        $('#modal-create-category-food-data .btn-renew').removeClass('d-none')
    })

    shortcut.add('F4', function () {
        saveModalCreateCategoryFoodData();
    });
    shortcut.add('ESC', function () {
        closeModalCreateCategoryFoodData();
    });

    shortcut.remove('F2')
}

async function saveModalCreateCategoryFoodData() {
    if (checkSaveCreateCategoryFoodData !== 0) {
        return false;
    }
    if (!checkValidateSave($('#modal-create-category-food-data'))) return false
    let name = $('#name-create-category-food-data').val(),
        code = $('#code-create-category-food-data').val(),
        description = $('#description-create-category-food-data').val(),
        type = $('#type-create-category-food-data').val(),
        restaurant_brand_id = $('.select-brand-category-food-data').val();
    checkSaveCreateCategoryFoodData = 1;
    let url = 'category-food-data.create',
        method = 'post',
        params = null,
        data = {
            name: name,
            code: code,
            description: description,
            type: type,
            restaurant_brand_id: restaurant_brand_id,
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-category-food-data')]);
    checkSaveCreateCategoryFoodData = 0;
    let text = '';
    switch (res.data.status){
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            drawTableCreateCategoryData(res.data.data)
            closeModalCreateCategoryFoodData()
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
            WarningNotify(text)
    }
}

function drawTableCreateCategoryData(data) {
    $('#total-record-tab1-category-food-data').text(Number($('#total-record-tab1-category-food-data').text()) + 1);
    addRowDatatableTemplate(tableDataEnableCategoryFood, {
        'name': data.name,
        'category_type_name': data.category_type_name,
        'material_category': data.material_category,
        'description': data.description,
        'action': data.action,
        'keysearch': data.keysearch
    });
}

function closeModalCreateCategoryFoodData() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    shortcut.add('F2', function () {
        openModalCreateCategoryFoodData();
    });
    $('#modal-create-category-food-data').modal('hide');
    reloadModalCreateCategoryFoodData();
    countCharacterTextarea()
}

function reloadModalCreateCategoryFoodData() {
    removeAllValidate();
    $('#modal-create-category-food-data input').val('');
    $('#modal-create-category-food-data textarea').val('');
    $('#modal-create-category-food-data .btn-renew').addClass('d-none');
    $('#type-create-category-food-data').val(1).trigger('change.select2');
}


