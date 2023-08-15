let idCategoryUpdate , materials , thisCategoryMaterial;
function openModalUpdateCategoryMaterial(r){
    $('#modal-update-category-data').modal('show');
    $('#select-branch-update-category-group-material').select2({
        dropdownParent: $('#modal-update-category-data'),
    });

    idCategoryUpdate = r.data('id');
    thisCategoryMaterial = r;
    $('#select-branch-update-category-group-material').val(r.data('branch')).trigger('change');
    $('#name-update-category-group-material').val(r.data('name'));
    $('#note-update-category-group-material').val(r.data('description'));

}

async function dataUpdate(){
    let method = 'get',
        url = 'category-group-material.data-update',
        params = {
            id: idCategoryUpdate,
            branch : $('#select-branch-update-category-group-material').val(),
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data);
     $('#select-branch-update-category-group-material').val(res.data[0].branch_id).trigger('change');
    $('#name-update-category-group-material').val(res.data[0].name);
    $('#note-update-category-group-material').val(res.data[0].description);
    materials = res.data[0].materials;
}

async function updateCategoryGroupMaterial(){
    let name = $('#name-update-category-group-material').val(),
        note = $('#note-update-category-group-material').val(),
        branch_id = $('#select-branch-update-category-group-material').val();
    let method = 'post',
        url = 'category-group-material.update',
        params = null,
        data = {
            id : idCategoryUpdate,
            name: name,
            note: note,
            materials : materials
        };
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
         thisCategoryMaterial.parents('tr').find('td:eq(1)').text(res.data['name']);
        thisCategoryMaterial.parents('tr').find('td:eq(2)').text(res.data['description']);
        closeModalUpdateCategoryMaterial()
        // loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
        shortcut.add('F4', function () {
            updateCategoryGroupMaterial();
        });
    }
}


function closeModalUpdateCategoryMaterial(){
    $('#modal-update-category-data').modal('hide');
}
