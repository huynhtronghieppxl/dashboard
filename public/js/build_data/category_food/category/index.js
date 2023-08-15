function getdata_category() {
    axios({
        method:'get',
        url:'/category-data.datatable'
    }).then(function (res) {
             tableData(res.data);
     })
}
function tableData(data){
    $('#base-style').DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        serverSide: false,
        language: {
            processing: 'Đang tải ....'
        },
        ordering: false,
        scrollX: true,
        data:data.data,
        columns: [
            {data: 'DT_RowIndex',name: 'DT_RowIndex',className: 'text-center'},
            {data: 'code', name: 'code', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'description', name: 'description',className: "text-center"},
            {data: 'status', name: 'status', className: 'text-center'},
            // {data: 'action', name: 'action', className: 'text-center'}
        ],
        scrollY: "65vh",
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 3,
            rightColumns: 1,
        },
    });
}

function changeStatus(id, status){
    if(status == '0'){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
                cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Đổi trạng thái thành hoạt động?',
            text: "",
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            reverseButtons: true,
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: '/category-material.change-status',
                    data: {id:id},
                    SuccessNotify(data){
                        $('#base-style').DataTable().ajax.reload(null, false);
                    }
                })
            }
        });
    } else {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary btn-sweet-alert',
                cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Tắt trạng thái hoạt động',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            reverseButtons: true,
            focusConfirm: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'GET',
                    url: '/category-material.change-status',
                    data: {id:id},
                    SuccessNotify(data){
                        $('#base-style').DataTable().ajax.reload(null, false);
                    }
                })
            }
        });
    }
}

$(function () {
    shortcut.remove("F2");
    shortcut.remove("F4");
    shortcut.add("F2", function () {
        openCreate();
    });
    shortcut.add("F4", function () {});
    getdata_category()
});
