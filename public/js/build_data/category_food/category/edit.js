var check_category = 0;

$(document).on('keydown', '#name-edit-category', function (e) {
    if(e.keyCode !== 115 && e.keyCode !== 27)
    {
        check_category = 1;
    }
});

$(document).on('keydown', '#des-edit-category', function () {
    if(e.keyCode !== 115 && e.keyCode !== 27)
    {
        check_category = 1;
    }
});

function editCategory(id) {
    $.ajax({
        type: 'GET',
        url: '/category-material.form-edit',
        data: {id:id},
        SuccessNotify(data){
            $('#content-edit-category').html(data);
            $('#edit-category').modal('show');
            $('#edit-category').on('shown.bs.modal', function() {
                $('#name-edit-category').select();
                $(document).off('focusin.modal');
            });
            addShortCut();
        }
    })
}

function updateCategoryMaterial() {
    if(check_category === 0)
    {
        var text_check = 'Dữ liệu chỉnh sửa chưa thay đổi, vui lòng thay đổi trước khi lưu lại !';
        ErrorNotify(text_check);
        return false;
    }
    $('#update-category-btn').addClass('btn-disabled');
    $('#update-category-btn').prop('disabled', true);
    var id = $('#id-category-material').val();
    var name = $('#name-edit-category').val();
    var des = $('#des-edit-category').val();
    var status = $('#status-category').val();
    var name_text = 'Tên danh mục';
    var checkName = checkRequire(name_text, name);
    if(checkName === false){
        $('#update-category-btn').removeClass('btn-disabled');
        $('#update-category-btn').prop('disabled', false);
        return false;
    }
    axios({
        method: 'post',
        url: '/category-material.update',
        data: {name:name, description:des, status:status, id:id}
    }).then(function (res) {
        $('#update-category-btn').removeClass('btn-disabled');
        $('#update-category-btn').prop('disabled', false);
        if (res.data.status === 200) {
            check_category = 0;
            $('#edit-category').modal('hide');
            $('#base-style').DataTable().ajax.reload(null, false);
            var text = 'Chỉnh sửa danh mục thành công !';
            SuccessNotify(text);
            removeShortCut();
        } else {
            var text2 = 'Chỉnh sửa danh mục thất bại !';
            if(res.data.message !== null){
                text2 = res.data.message;
            }
            ErrorNotify(text2);
        }
    });
}

function closeModalUpdate(){
    if(check_category === 1){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
                cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Đóng tạo danh mục?',
            text: "Bạn đã nhập dữ liệu vào form, đóng sẽ mất dữ liệu đã nhập !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            reverseButtons: true,
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $('#edit-category').modal('hide');
                removeShortCut();
                check_category = 0;
            }
        });
    } else {
        $('#edit-category').modal('hide');
        removeShortCut();
        check_category = 0;
    }
}

function removeShortCut(){
    shortcut.remove("ESC");
    shortcut.remove("F2");
    shortcut.remove("F4");
    shortcut.add("F2", function () {
        openCreate();
    });
    shortcut.add("F4", function () {});
    shortcut.add("ESC", function () {});
}

function addShortCut(){
    shortcut.remove("F2");
    shortcut.remove("ESC");
    shortcut.remove("F4");
    shortcut.add("F2", function () {});
    shortcut.add("F4", function () {
        updateCategoryMaterial();
    });
    shortcut.add("ESC", function () {
        closeModalUpdate();
    });
}
