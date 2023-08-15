function openCreate() {
   axios({
        method: 'GET',
        url: 'category-data.form-create',
   }).then(function (res) {
       $('#content-edit-category').html(res.data);
       $('#edit-category').modal('show');
       $('#edit-category').on('shown.bs.modal', function() {
           $('#name-create-material').focus();
           $(document).off('focusin.modal');
       });
       addShortCutCreate();
   })
}

function createCategoryMaterial() {
    $('#create-category-btn').addClass('btn-disabled');
    $('#create-category-btn').prop('disabled', true);
    var name = $('#name-create-material').val();
    var des = $('#des-create-material').val();
    var status = '';
    var name_text = 'Tên danh mục';
    var checkName = checkRequire(name_text, name);
    if(checkName === false){
        $('#create-category-btn').removeClass('btn-disabled');
        $('#create-category-btn').prop('disabled', false);
        return false;
    }
    axios({
        method: 'post',
        url: '/category-material.create',
        data: {name:name, description:des, status:status}
    }).then(function (res) {
        $('#create-category-btn').removeClass('btn-disabled');
        $('#create-category-btn').prop('disabled', false);
        if (res.data.status === 200) {
            $('#edit-category').modal('hide');
            $('#base-style').DataTable().ajax.reload(null, false);
            var text = 'Thêm danh mục thành công !';
            SuccessNotify(text);
            removeShortCut();
        } else {
            var text2 = 'Thêm danh mục thất bại !';
            if(res.data.message !== null){
                text2 = res.data.message;
            }
            ErrorNotify(text2);
        }
    });
}

function closeModalCreate(){
    var name = $('#name-create-material').val();
    var des = $('#des-create-material').val();
    if(name !== '' || des !== ''){
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
            }
        });
    } else {
        $('#edit-category').modal('hide');
        removeShortCut();
        removeAll();
        removeAllValidate();
    }
}

function removeShortCutCreate(){
    shortcut.remove("ESC");
    shortcut.remove("F2");
    shortcut.remove("F4");
    shortcut.add("F2", function () {
        openCreate();
    });
    shortcut.add("F4", function () {});
    shortcut.add("ESC", function () {});
}

function addShortCutCreate(){
    shortcut.remove("F2");
    shortcut.remove("ESC");
    shortcut.remove("F4");
    shortcut.add("F2", function () {});
    shortcut.add("F4", function () {
        createCategoryMaterial();
    });
    shortcut.add("ESC", function () {
        closeModalCreate();
    });
}
