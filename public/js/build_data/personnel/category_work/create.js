let checkCreateCategoryWorkData;

function openModalCreateCategoryWorkData() {
    checkCreateCategoryWorkData = 0;
    $('#modal-create-category-work-data').modal('show');
    shortcut.remove('F2');
    shortcut.add('ESC', function () {
        closeModalCreateCategoryWorkData();
    });
    shortcut.add('F4', function () {
        saveModalCreateCategoryWorkData();
    });
    $('#name-create-category-work-data').focus();
    $('#category-create-work-data').select2({
        dropdownParent: $('#modal-create-category-work-data'),
    });
    $('#loading-modal-create-category-work-data input').on('input', function (){
        $('#modal-create-category-work-data .btn-renew').removeClass('d-none');
    });
    $('.btn-renew').on('click', function (){
        $('#modal-create-category-work-data .btn-renew').addClass('d-none');
    })
}

async function saveModalCreateCategoryWorkData() {
    if (checkCreateCategoryWorkData === 1) return false;
    if (!checkValidateSave($("#modal-create-category-work-data"))) return false;
    checkCreateCategoryWorkData = 1;
    let role = $('#select-role-work-data').val(),
        name = $('#name-create-category-work-data').val(),
        brand = $('.select-brand.category-work-data').val(),
        method = 'post',
        url = 'category-work-data.create',
        params = null,
        data = {
            role: role,
            brand: brand,
            name: name,
            count: countItemCategoryWorkData
    };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-create-category-work-data')]);
    checkCreateCategoryWorkData = 0;
    let text = $('#error-post-data-to-server').text();
    if (res.data[1].status === 200) {
        text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateCategoryWorkData();
        shortcut.remove('F4');
        shortcut.remove('ESC');
        shortcut.add('F2', function () {
            openModalCreateCategoryWorkData()
        })
        $('.empty-datatable-custom').remove();
        await $('#draggableMultiple').append(res.data[0]);
        countItemCategoryWorkData++;
        eventCategoryWorkData();
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    } else {
            if (res.data[1].message !== null) {
                text = res.data[1].message;
            }
            WarningNotify(text);
    }
}

function closeModalCreateCategoryWorkData() {
    $('#modal-create-category-work-data').modal('hide');
    shortcut.remove('F4');
    shortcut.remove('ESC');
    shortcut.add('F2', function (){
        openModalCreateCategoryWorkData();
    })
    reloadModalCreateCategoryWorkData()
}

function reloadModalCreateCategoryWorkData(){
    $('#name-create-category-work-data').val('');
    $('.btn-renew').addClass('d-none')
}
