let checkUploadExcelCategoryWorkData, checkSaveWorkExcel;
function openModalImportWorkData() {
    checkUploadExcelCategoryWorkData = 0;
    checkSaveWorkExcel = 0;
    $('#import-work-data-modal').modal('show');
    addLoading('work-data.select-role', '#import-work-data-modal');
    $('#role-import-work-data').select2({
        dropdownParent: $('#import-work-data-modal')
    });
    dataRole();
}

async function dataRole(){
    let method = 'get',
    url = 'work-data.select-role',
    branch = $('#branch-create-work-data').val(),
    params = {branch: branch},
    data = null;
    let res = await axiosTemplate(method, url, params, data);
    $('#role-import-work-data').html(res.data);
}
//  Check file excel
$(document).on('click', '#check_file_work', async function (e) {
    if ($('#files-upload-work-data').val() == '') {
        ErrorNotify('Vui chọn file Excel !');
        return false;
    }
    let branch_id = $('#change_branch').val();
    let employee_role_id = $('#role-import-work-data').val();
    let form_data = new FormData();
    let file = $('#files-upload-work-data')[0].files[0];
    if ($('#edit-review-work-import tbody tr').length != 0) {
        $('#edit-review-work-import').DataTable().draw();
    }
    if(checkUploadExcelCategoryWorkData === 1 ) return false;
    form_data.append('file', file);
    checkUploadExcelCategoryWorkData = 1;
    let method = 'post',
        url = 'work-data.check_excel',
        params = {
            branch_id : branch_id,
            employee_role_id : employee_role_id
        },
        data = form_data;
    let res = await axiosTemplate(method, url, params, data);
    checkUploadExcelCategoryWorkData = 0;
    if (res.status === 200) {
        let text = $('#success-create-data-to-server').text();
        $('#tab2').removeClass('d-none');
        $('#tab1').addClass('d-none');
        $('.next-tab').removeClass('d-none');
        dataTableFoodManageExcel(res);
    }
});


async function saveworkexcel(){

    let obj = [];
    $('#edit-review-work-import tbody tr').each(function () {
        let name = $(this).find('td').eq(0).html();
        let description = $(this).find('td').eq(2).html();
        let employee_role_id = $('#role-import-work-data').val();
        let item = {};
        item.name = name;
        item.content = $(this).find('td').eq(1).html() ;
        item.description = description;
        item.employee_role_id = employee_role_id;
        item.id = '0';
        item.base_point = removeformatNumber($(this).find('td').eq(3).html());
        obj.push(item);
    });
    if (checkSaveWorkExcel !== 0) return false;
    let branch_id = $('#change_branch').val();
    checkSaveWorkExcel = 1;
    let method = 'post',
        url = 'work-data.import_work_excel',
        params = {
            branch_id : branch_id,
            obj: obj
        },
        data = '';
    let res = await axiosTemplate(method, url, params, data);
    checkSaveWorkExcel = 0;
    if (res.status === 200) {
        SuccessNotify('Thêm thành công');
        closeModalImportWorkData();
    }
}

function dataTableFoodManageExcel(data) {
        $('#edit-review-work-import').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            destroy: true,
            ordering: false,
            scrollX: true,
            fixedHeader: true,
            scrollCollapse: true,
            scrollY: '40vh',
            language: {
                emptyTable: "<div class='empty-datatable-custom'><img src='../../../../files/assets/images/nodata-datatable2.png'></div>",
            },
            data: data.data,
            "createdRow": function (row, data, dataIndex) {
                if (data.status == undefined) {
                    $(row).removeClass('text-danger');
                } else {
                    $(row).addClass('text-danger');
                }
            },
            columns: [
                {
                    data: null, orderable: true, className: 'text-center', render: function (data, type, row) {
                        let name = data.name;
                        return name.toUpperCase();
                    }
                },
                {
                    data: null, orderable: true, className: 'text-center', render: function (data, type, row) {
                        let content = data.content;
                        return content.toUpperCase();
                    }
                },
                {
                    data: null, className: 'text-center', render: function (data, type, row) {
                        return data.description;
                    }
                },
                {
                    data: null, className: 'text-center', render: function (data, type, row) {
                        return data.base_point;
                    }
                },
                {
                    data: null, className: 'text-center', render: function (data, type, row) {
                        let textAction;
                        if (data.error == undefined) {
                            textAction = '<label class="text-success">Có thể nhập định lượng</label>';
                        } else {
                            textAction = '<label class="text-danger">' + data.error + '</label>';
                        }
                        return textAction;
                    }
                },
            ]
        })
}

function closeModalImportWorkData() {
    $('#import-work-data-modal').modal('hide');
    reloadModalImportWorkData();
}

function reloadModalImportWorkData(){
    $('#tab2').addClass('d-none');
    $('#tab1').removeClass('d-none');
    $('.file-upload-name-js').text('');
}


