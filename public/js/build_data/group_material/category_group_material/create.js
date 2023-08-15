let idCategory = 0 ;
function openModalCreateCategoryMaterial(){
    $('#modal-create-category-data').modal('show');

    $('#select-branch-create-category-group-material').select2({
        dropdownParent: $('#modal-create-category-data'),
    });
}

async function createCategoryGroupMaterial(){
    let name = $('#name-category-group-material').val(),
        note = $('#note-category-group-material').val(),
        branch_id = $('#select-branch-create-category-group-material :selected').val();

    let method = 'post',
        url = 'category-group-material.create',
        params = null,
        data = {
            name: name,
            note: note,
            branch_id : branch_id,
        };
    let res = await axiosTemplate(method, url, params, data);
    if (res.data.status === 200) {
        let text = $('#success-create-data-to-server').text();
        SuccessNotify(text);
        closeModalCreateCategoryMaterial();
        loadData();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        ErrorNotify(text);
        shortcut.add('F4', function () {
            createCategoryGroupMaterial();
        });
    }
}


function closeModalCreateCategoryMaterial(){
    $('#modal-create-category-data').modal('hide');
}
