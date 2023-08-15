let checkSaveUpdateWorkData,
    idUpdateWorkData,
    roleUpdateWorkData,
    thisUpdateWorkData;

async function openModalUpdateWorkData(r) {
    checkSaveUpdateWorkData = 0;
    thisUpdateCategoryWorkData = r;
    $('#modal-update-work-data').modal('show');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('ESC', function () {
        closeModalUpdateWorkData();
    });
    shortcut.add("F4", function () {
        saveUpdateWorkData();
    });
    $('#category-update-work-data, #kpi-update-work-data').select2({
        dropdownParent: $('#modal-update-work-data'),
    });
    thisUpdateWorkData = r;
    idUpdateWorkData = r.data('id');
    roleUpdateWorkData = r.data('role');
    $('#role-update-work-data').text(r.data('role-name'));
    $('#category-update-work-data').val(r.data('category')).trigger('change.select2');
    $('#name-update-work-data').val(r.parents('.sortable-moves').find('p').text());
    $('#description-update-work-data').val(r.parents('span').find('label').text());
    countCharacterTextarea()
    if (r.data('kpi') > 4) {
        $('#kpi-update-work-data').html(`
        <option selected disabled>Chọn trọng số</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        `)
    } else {
        $('#kpi-update-work-data').val(r.data('kpi')).trigger('change.select2');
    }
}

async function saveUpdateWorkData() {
    if (checkSaveUpdateWorkData === 1) return false;
    if (!checkValidateSave($('#modal-update-work-data'))) return false
    checkSaveUpdateWorkData = 1;
    let name = $('#name-update-work-data').val(),
        description = $('#description-update-work-data').val(),
        role = $('#select-role-work-data-employee :selected').val(),
        base_point = removeformatNumber($('#kpi-update-work-data').val()),
        category = $('#category-update-work-data').val(),
        method = 'post',
        url = 'work-data.update',
        params = null,
        data = {
            id: idUpdateWorkData,
            role: role,
            category: category,
            name: name,
            description: description,
            base_point: base_point,
            restaurant_brand_id: $('.select-brand.work-data').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('.update-work-data')]);
    checkSaveUpdateWorkData = 0;
    let text = '';
    switch (res.data.status ) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateWorkData();
            dataWorkData();
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

function closeModalUpdateWorkData() {
    shortcut.remove("F4");
    $('#modal-update-work-data').modal('hide');
    reloadModalUpdateWorkData();
}

function reloadModalUpdateWorkData(){
    $('#modal-update-work-data input').val('');
    $('#modal-update-work-data textarea').val('');
}
