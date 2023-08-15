let idUpdateCategoryWorkData,
    checkUpdateCategoryWorkData,
    thisUpdateCategoryWorkData;
function openModalUpdateCategoryWorkData(r) {
    checkUpdateCategoryWorkData= 0;
    thisUpdateCategoryWorkData = r;
    idUpdateCategoryWorkData = r.data('id');
    $('#name-update-category-work-data').val(r.data('name'));
    $('#modal-update-category-work-data').modal('show');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalUpdateCategoryWorkData();
    });
    shortcut.add('F4', function () {
        saveModalUpdateCategoryWorkData();
    });
    $('#category-create-work-data').select2({
        dropdownParent: $('#modal-update-category-work-data'),
    })
}


async function saveModalUpdateCategoryWorkData() {
    if (checkUpdateCategoryWorkData === 1) return false;
    if (!checkValidateSave($("#modal-update-category-work-data"))) return false;
    checkUpdateCategoryWorkData = 1;
        let name = $('#name-update-category-work-data').val(),
            brand = $('.select-brand.category-work-data').val(),
            role = $('#select-role-work-data').val(),
            method = 'post',
            url = 'category-work-data.update',
            params = null,
            data = {
                id: idUpdateCategoryWorkData,
                name: name,
                role: role,
                brand : brand,
            };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-update-category-work-data')]);
    checkUpdateCategoryWorkData = 0;
    let text = ''
    switch (res.data.status) {
        case 200:
            text = $('#success-update-data-to-server').text();
            SuccessNotify(text);
            closeModalUpdateCategoryWorkData();
            shortcut.remove('F4');
            shortcut.remove('ESC');
            shortcut.add('F2', function () {
                openModalCreateCategoryWorkData()
            })
            thisUpdateCategoryWorkData.data('name', res.data.data.name);
            thisUpdateCategoryWorkData.parents('.sortable-moves').find('p').text(res.data.data.name);
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
function closeModalUpdateCategoryWorkData() {
    $('#modal-update-category-work-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateCategoryWorkData()
    })
    reloadModalUpdateCategoryWorkData();
}

function reloadModalUpdateCategoryWorkData(){
    $('#name-update-category-work-data').val('');
}
